@extends('layouts.app')

@section('title', 'ลงทะเบียนกิจกรรม')

@section('content')
<div class="container-fluid">
    <div class="card" style="background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: black; text-align: center;">กิจกรรม: {{ $activity->name }}</h2>
        <h5 style="color: black; text-align: center;">ระดับ: {{ $activity->level }} | ประเภท: {{ $activity->type }}</h5>
        <h5 style="color: black; text-align: center;">วันที่: {{ $activity->date }} | เวลา: {{ $activity->time }}</h5>

         {{-- แสดงข้อความแจ้งเตือนข้อผิดพลาด --}}
        @if (session('error') || session('success'))
        <script>
            Swal.fire({
                icon: '{{ session('error') ? 'error' : 'success' }}',
                title: '{{ session('error') ? 'เกิดข้อผิดพลาด!' : 'ลงทะเบียนสำเร็จ!' }}',
                text: '{{ session('error') ?? session('success') }}',
                confirmButtonText: 'ตกลง'
            });
        </script>
        @endif

        <form action="{{ route('registrations.store') }}" method="POST" class="body-cade">
            @csrf
            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
            <input type="hidden" name="level" value="{{ $activity->level }}">
            <input type="hidden" name="type" value="{{ $activity->type }}">
            <input type="hidden" id="team_limit" value="{{ $activity->team_limit }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <div class="row">
                <!-- ข้อมูลโรงเรียน -->
                <div class="col-md-6">
                    <div class="card mb-4 body-cade" style="border: 1px solid #6c757d; border-radius: 10px;">
                        <div class="card-header" style="color: black; background-color: #6c757d; border-radius: 10px 10px 0 0;">
                            <h5 style="color: white; margin: 0;">ข้อมูลโรงเรียน/สถาบัน/มหาลัย</h5>
                        </div>
                        <div class="card-body" style="color: black;">
                            <div class="form-group">
                                <label for="school_name" style="color: black;">ชื่อโรงเรียน/สถาบัน/มหาลัย</label>
                                <input type="text" name="school_name" class="form-control" id="school_name" placeholder="กรอกชื่อโรงเรียน" value="{{ Auth::user()->school_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address" style="color: black;">ที่อยู่</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="กรอกที่อยู่" value="{{ Auth::user()->address }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลอาจารย์ที่ปรึกษา -->
                    <div class="card mb-4 body-cade" style="border: 1px solid #6c757d; border-radius: 10px;">
                        <div class="card-header" style="color: black; background-color: #6c757d; border-radius: 10px 10px 0 0;">
                            <h5 style="color: white; margin: 0;">ข้อมูลอาจารย์ที่ปรึกษา</h5>
                        </div>
                        <div class="card-body" style="color: black;">
                            <div class="form-group">
                                <label for="title" style="color: black;">คำนำหน้า</label>
                                <select name="title" id="title" class="form-control" required>
                                    <option value="">เลือกคำหน้า</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="supervisor_name" style="color: black;">ชื่อ-สกุล</label>
                                <input type="text" name="supervisor_name" class="form-control" id="supervisor_name" placeholder="กรอกชื่อ-สกุล" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="supervisor_phone" style="color: black;">โทรศัพท์</label>
                                <input type="text" name="supervisor_phone" class="form-control" id="supervisor_phone" placeholder="กรอกโทรศัพท์" value="{{ Auth::user()->phone }}" required>
                            </div>
                            <div class="form-group">
                                <label for="supervisor_email" style="color: black;">อีเมล</label>
                                <input type="email" name="supervisor_email" class="form-control" id="supervisor_email" placeholder="กรอกอีเมล" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ข้อมูลนักเรียน -->
                <div class="col-md-6">
                    <div class="card mb-4 body-cade" style="border: 1px solid #6c757d; border-radius: 10px;">
                        <div class="card-header" style="color: black; background-color:#6c757d; border-radius: 10px 10px 0 0;">
                            <h5 style="color: white; margin: 0;">ชื่อชิ้นงาน (ถ้ามี)</h5>
                        </div>
                        <div class="card-body" style="color: black;">
                            <div class="form-group">
                                <label for="project_name" style="color: black;">ชื่อชิ้นงาน</label>
                                <input type="text" name="project_name" class="form-control" id="project_name" placeholder="กรอกชื่อชิ้นงาน (ถ้ามี)">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 body-cade" style="border: 1px solid #6c757d; border-radius: 10px;">
                        <div class="card-header" style="color: black; background-color: #6c757d; border-radius: 10px 10px 0 0;">
                            <h5 style="color: white; margin: 0;">
                                ข้อมูลนักเรียน <span id="student-count">0/{{ $activity->team_limit }}</span>
                                <button type="button" class="btn btn-success btn-sm float-right" id="add-student-btn">+</button>
                            </h5>
                        </div>
                        <div class="card-body" style="color: black;">
                            <div id="student-names">
                                <div class="form-group student-entry">
                                    <label for="registrant_name" style="color: black;">คำนำหน้า ชื่อ-สกุล นักเรียน</label>
                                    <div class="input-group">
                                        <input type="text" name="registrant_names[]" class="form-control" placeholder="กรอกชื่อ" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-student-btn">&times;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-1 body-cade">สมัคร</button>
                        <a href="{{ route('registrations.index') }}" class="btn btn-danger mt-1 body-cade">ยกเลิก</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let studentLimit = {{ $activity->team_limit }}; // ใช้ค่าจาก activity->team_limit
    let studentCount = 1; // เริ่มต้นที่ 1 นักเรียน

    // อัพเดทจำนวนข้อมูลนักเรียน
    function updateStudentCount() {
        document.getElementById('student-count').textContent = `${studentCount}/${studentLimit}`;
    }

    // ฟังก์ชันเพิ่มข้อมูลนักเรียนใหม่
    document.getElementById('add-student-btn').addEventListener('click', function () {
        if (studentCount < studentLimit) {
            const studentNamesContainer = document.getElementById('student-names');

            const newStudentEntry = document.createElement('div');
            newStudentEntry.classList.add('form-group', 'student-entry');
            newStudentEntry.innerHTML = `
                <label for="registrant_name" style="color: black;">คำนำหน้า ชื่อ-สกุล นักเรียน</label>
                <div class="input-group">
                    <input type="text" name="registrant_names[]" class="form-control" placeholder="กรอกชื่อ" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-student-btn">&times;</button>
                    </div>
                </div>
            `;
            
            studentNamesContainer.appendChild(newStudentEntry);
            studentCount++;
            updateStudentCount();
        } else {
            alert('คุณเพิ่มนักเรียนครบตามจำนวนที่กำหนดแล้ว');
        }
    });

    // ฟังก์ชันลบข้อมูลนักเรียน
    document.getElementById('student-names').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-student-btn')) {
            const studentEntry = e.target.closest('.student-entry');
            studentEntry.remove();
            studentCount--;
            updateStudentCount();
        }
    });

    // อัพเดทจำนวนเริ่มต้น
    updateStudentCount();
});

</script>

@endsection
