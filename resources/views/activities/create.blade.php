@extends('layouts.back')

@section('title', 'สร้างกิจกรรมใหม่')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="card-title">ฟอร์มสร้างกิจกรรม</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('activities.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- ชื่อกิจกรรม -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="name">ชื่อกิจกรรม</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="ชื่อกิจกรรม" required>
                        </div>
                    </div>

                    <!-- ประเภท -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="type">ประเภท</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="แบบเดียว">แบบเดียว</option>
                                <option value="แบบทีม">แบบทีม</option>
                            </select>
                        </div>
                    </div>

                    <!-- จำนวนสมาชิกในทีม -->
                    <div class="col-md-6 col-lg-4" id="team-limit-group">
                        <div class="form-group">
                            <label for="team_limit">จำนวนสมาชิกในทีม</label>
                            <input type="number" name="team_limit" class="form-control" id="team_limit"
                                placeholder="จำนวน">
                        </div>
                    </div>
                    <!-- จำนวนโรงเรียนที่สมัครได้ -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="school_limit">จำนวน/โรงเรียน</label>
                            <input type="number" name="school_limit" class="form-control" id="school_limit" placeholder="จำนวนโรงเรียนที่สมัครได้" required>
                        </div>
                    </div>

                    <!-- ปีการศึกษา -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="year">ปีการศึกษา</label>
                            <input type="text" name="year" class="form-control" id="year" placeholder="ปี"
                                required>
                        </div>
                    </div>

                    <!-- ระดับ -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="level">ระดับชั้น</label>
                            <select name="level" class="form-control" id="level" required>
                                <option value="">-- เลือกระดับชั้น --</option>
                                <option value="ประถมศึกษาตอนต้น (ป.1-ป.3)">ประถมศึกษาตอนต้น (ป.1-ป.3)</option>
                                <option value="ประถมศึกษาตอนปลาย (ป.4-ป.6)">ประถมศึกษาตอนปลาย (ป.4-ป.6)</option>
                                <option value="มัธยมศึกษาตอนต้น (ม.1-ม.3)">มัธยมศึกษาตอนต้น (ม.1-ม.3)</option>
                                <option value="มัธยมศึกษาตอนต้น (ม.4-ม.6)">มัธยมศึกษาตอนต้น (ม.4-ม.6)</option>
                                <option value="อุดมศึกษา">อุดมศึกษา</option>
                            </select>
                        </div>
                    </div>


                    <!-- วันที่ -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="date">วันที่แข่งขัน</label>
                            <input type="date" name="date" class="form-control" id="date" required>
                        </div>
                    </div>
                    <!-- สิ้นสุดวันที่สมัคร -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="registration_end_date">สิ้นสุดวันที่สมัคร</label>
                            <input type="date" name="registration_end_date" class="form-control"
                                id="registration_end_date" required>
                        </div>
                    </div>


                    <!-- เวลาเริ่มต้น -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="start_time">เริ่มเวลา</label>
                            <input type="time" name="start_time" class="form-control" id="start_time" required>
                        </div>
                    </div>

                    <!-- เวลาสิ้นสุด -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="end_time">เวลาสิ้นสุด</label>
                            <input type="time" name="end_time" class="form-control" id="end_time" required>
                        </div>
                    </div>

                    <!-- ชื่ออาจาร์ย -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="teacher_name">ติดต่อ (ชื่อ-สกุล พร้อมเบอร์ติดต่อ)</label>
                            <input type="text" name="teacher_name" class="form-control" id="teacher_name"
                                placeholder="ชื่อ-สกุล พร้อมเบอร์ติดต่อ" required>
                        </div>
                    </div>

                    <!-- จำนวนที่รับ -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="registration_limit">จำนวนที่รับ</label>
                            <input type="number" name="registration_limit" class="form-control" id="registration_limit"
                                placeholder="จำนวนที่รับ" required>
                        </div>
                    </div>

                      <!-- รูปแบบเกียรติบัตร-->
                 <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="Certificate_type">รูปแบบเกียรติบัตร</label>
                        <select name="Certificate_type" class="form-control" id="Certificate_type" required>
                            <option value="">-- เลือกรูปแบบเกียรติบัตร --</option>
                            <option value="รูปแบบที่ 1">รูปแบบที่ 1</option>
                            <option value="รูปแบบที่ 2 (ไม่มีที่ปรึกษา)">รูปแบบที่ 2 (ไม่มีที่ปรึกษา)</option>
                           
                        </select>
                    </div>
                </div>
                </div>

               

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="{{ route('activities.index') }}" class="btn btn-danger">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var teamLimitGroup = document.getElementById('team-limit-group');
            var teamLimitInput = document.getElementById('team_limit');

            function handleTypeChange() {
                if (typeSelect.value === 'แบบเดียว') {
                    teamLimitGroup.style.display = 'none'; // ซ่อนฟิลด์จำนวนสมาชิกในทีม
                    teamLimitInput.value = 1; // ตั้งค่า team_limit เป็น 1
                } else {
                    teamLimitGroup.style.display = 'block'; // แสดงฟิลด์จำนวนสมาชิกในทีม
                    teamLimitInput.value = ''; // เคลียร์ค่าเก่า
                }
            }

            typeSelect.addEventListener('change', handleTypeChange);
            handleTypeChange(); // เรียกใช้ครั้งแรกเพื่อกำหนดค่าเบื้องต้น
        });
    </script>

@endsection
