@extends('layouts.back')

@section('title', 'รายชื่อผู้ลงทะเบียนสำหรับกิจกรรม: ' . $activity->name)

@section('content')
<style>.card-header h3 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; /* จัดให้ชื่อกิจกรรมถูกตัดถ้ามีความยาวเกินไป */
    max-width: 60%; /* จำกัดความกว้างของชื่อกิจกรรม */
}

.card-header div {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

@media screen and (max-width: 768px) {
    .card-header h3 {
        max-width: 100%; /* สำหรับจอเล็ก ให้ชื่อกิจกรรมใช้พื้นที่ได้เต็ม */
    }
    .card-header div {
        flex-direction: column; /* จัดปุ่มเป็นแนวตั้งสำหรับจอเล็ก */
        align-items: flex-end;
    }
}
.form-group{
    position: relative;
}
.form-group > div {
    position: absolute;
    top: 0;
    right: 50px;
}
</style>

<form action="{{ route('registrations.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h3 class="card-title">รายชื่อผู้ลงทะเบียนสำหรับกิจกรรม {{ $activity->name }}</h3>
            <div>
                <a href="{{ route('generate.registration.pdf', ['activityId' => $activity->id]) }}" class="btn btn-primary mb-3 ml-2">
                    <i class="fas fa-file-pdf"></i> พิมพ์ใบลงทะเบียน
                </a>
                
                <a href="{{ route('generate.results.pdf', ['activityId' => $activity->id]) }}" class="btn btn-success mb-3 ml-2">
                    <i class="fas fa-print"></i> พิมพ์ใบผลการแข่งขัน
                </a>
                
                <a href="{{ route('generate.result.pdf', ['activityId' => $activity->id]) }}" class="btn btn-secondary mb-3 ml-2">
                    <i class="fas fa-print"></i> ส่งออกผลการแข่งขัน
                </a>
            </div>
        </div>
        
        
 <!-- ปุ่มหลักเพื่อเลือก 'เข้า' ทั้งหมด -->
 <div class="form-group">
    <div class="">
        <input type="checkbox" id="checkAllAttendance" name="all_attendance" value="เข้า">เลือก 'เข้า' ทั้งหมด</div>
        
</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>โรงเรียน/สถาบัน</th>
                            <th>ผู้ควบคุม</th>
                            <th>การเข้าร่วม</th>
                            <th>ผลการแข่งขัน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $index => $registration)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            {{-- ชื่อผู้รับ --}}
                            <td>
                                @if($registration->type === 'team')
                                    @php
                                        $teamMembers = json_decode($registration->team_members, true);
                                    @endphp
                                    @foreach($teamMembers as $memberIndex => $member)
                                        <input type="text" name="registrations[{{ $registration->id }}][team_members][{{ $memberIndex }}]" value="{{ $member }}" class="form-control mb-1">
                                    @endforeach
                                @else
                                    <input type="text" name="registrations[{{ $registration->id }}][registrant_name]" value="{{ $registration->registrant_name }}" class="form-control">
                                @endif
                            </td>

                            {{-- โรงเรียน/สถาบัน --}}
                            <td>
                                <input type="text" name="registrations[{{ $registration->id }}][school_name]" value="{{ $registration->school_name }}" class="form-control">
                            </td>

                            {{-- ผู้ควบคุม --}}
                            <td>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <select name="registrations[{{ $registration->id }}][title]" class="form-control">
                                            <option value="นาย" {{ $registration->title == 'นาย' ? 'selected' : '' }}>นาย</option>
                                            <option value="นาง" {{ $registration->title == 'นาง' ? 'selected' : '' }}>นาง</option>
                                            <option value="นางสาว" {{ $registration->title == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="registrations[{{ $registration->id }}][supervisor_name]" value="{{ $registration->supervisor_name }}" class="form-control">
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <input type="radio" name="registrations[{{ $registration->id }}][attendance]" value="เข้า" class="radio-attendance" {{ $registration->attendance == 'เข้า' ? 'checked' : '' }}> เข้า<br>
                                    <input type="radio" name="registrations[{{ $registration->id }}][attendance]" value="ไม่เข้า" {{ $registration->attendance == 'ไม่เข้า' ? 'checked' : '' }}> ไม่เข้า
                                </div>
                            </td>

                            {{-- ผลการแข่งขัน --}}
                            <td>
                                <select name="registrations[{{ $registration->id }}][result]" class="form-control">
                                    <option value="เข้าร่วมกิจกรรม" {{ $registration->result == 'เข้าร่วมกิจกรรม' ? 'selected' : '' }}>เข้าร่วมกิจกรรม</option>
                                    <option value="รับรางวัลชนะเลิศ" {{ $registration->result == 'รับรางวัลชนะเลิศ' ? 'selected' : '' }}>รางวัลชนะเลิศ</option>
                                    <option value="รับรางวัลรองชนะเลิศอันดับ 1" {{ $registration->result == 'รับรางวัลรองชนะเลิศอันดับ 1' ? 'selected' : '' }}>รางวัลรองชนะเลิศอันดับ 1</option>
                                    <option value="รับรางวัลรองชนะเลิศอันดับ 2" {{ $registration->result == 'รับรางวัลรองชนะเลิศอันดับ 2' ? 'selected' : '' }}>รางวัลรองชนะเลิศอันดับ 2</option>
                                    <option value="รับรางวัลชมเชย" {{ $registration->result == 'รับรางวัลชมเชย' ? 'selected' : '' }}>รางวัลชมเชย</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('checkAllAttendance').addEventListener('click', function() {
        // เมื่อคลิก 'ติ๊กเข้า' ทั้งหมด
        let radioButtons = document.querySelectorAll('.radio-attendance');
        radioButtons.forEach(function(radio) {
            radio.checked = true; // ติ๊กเข้าให้ทุกคน
        });
    });
</script>

@endsection
