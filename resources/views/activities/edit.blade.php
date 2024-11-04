@extends('layouts.back')

@section('title', 'แก้ไขกิจกรรม')

@section('content')
    <h2 ></h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('activities.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="card-title">ฟอร์มแก้ไขกิจกรรม</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- ชื่อกิจกรรม -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="name">ชื่อกิจกรรม</label>
                            <input type="text" name="name" value="{{ $activity->name }}" class="form-control" id="name" placeholder="กรอกชื่อกิจกรรม" required>
                        </div>
                    </div>

                    
                    <!-- ประเภท -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="type">ประเภท</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="แบบเดียว" {{ $activity->type == 'แบบเดียว' ? 'selected' : '' }}>แบบเดียว</option>
                                <option value="แบบทีม" {{ $activity->type == 'แบบทีม' ? 'selected' : '' }}>แบบทีม</option>
                            </select>
                        </div>
                    </div>

                     <!-- จำนวนสมาชิกในทีม -->
                     <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="team_limit">จำนวนทีมที่รับ</label>
                            <input type="number" name="team_limit" value="{{ $activity->team_limit }}" class="form-control" id="team_limit" placeholder="กรอกจำนวน" required>
                        </div>
                    </div>

                      <!-- จำนวนโรงเรียนที่สมัครได้ -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="school_limit">จำนวน/โรงเรียน</label>
                            <input type="number" name="school_limit" value="{{ $activity->school_limit }}" class="form-control" id="school_limit" placeholder="กรอกจำนวนโรงเรียนที่สมัครได้" required>
                        </div>
                    </div>


                    <!-- ปีการศึกษา -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="year">ปีการศึกษา</label>
                            <input type="text" name="year" value="{{ $activity->year }}" class="form-control" id="year" placeholder="กรอกปี" required>
                        </div>
                    </div>

                    <!-- ระดับ -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="level">ระดับชั้น</label>
                            <select  type="text" name="level" value="{{ $activity->level }}" class="form-control" id="level" required>
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
                            <label for="date">วันที่</label>
                            <input type="date" name="date" value="{{ $activity->date }}" class="form-control" id="date" required>
                        </div>
                    </div>
                     <!-- วันที่ -->
                     <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="registration_end_date">สิ้นสุดวันที่สมัคร</label>
                            <input type="date" name="registration_end_date" value="{{ $activity->registration_end_date }}" class="form-control" id="registration_end_date" required>
                        </div>
                    </div>

                    <!-- เวลา -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="start_time">เวลาเริ่มต้น</label>
                            <input type="time" name="start_time" value="{{ $activity->start_time }}" class="form-control" id="start_time">
                        </div>
                    </div>
                     <!-- เวลา -->
                     <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="end_time">เวลาสิ้นสุด</label>
                            <input type="time" name="end_time" value="{{ $activity->end_time }}" class="form-control" id="end_time">
                        </div>
                    </div>
                    
                    <!-- ชื่ออาจาร์ย -->
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="teacher_name">ติดต่อ</label>
                            <input type="text" name="teacher_name" value="{{ $activity->teacher_name }}" class="form-control" id="teacher_name" placeholder="กรอกรายละเอียด" required>
                        </div>
                    </div>

                     <!-- จำนวนสมาชิกในทีม -->
                     <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="registration_limit">จำนวนทั้งหมดที่รับ</label>
                            <input type="number" name="registration_limit" value="{{ $activity->registration_limit }}" class="form-control" id="registration_limit" placeholder="จำนวนที่รับ" required>
                        </div>
                    </div>

                      <!-- รูปแบบเกียรติบัตร -->
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="Certificate_type">รูปแบบเกียรติบัตร</label>
                            <select  type="text" name="Certificate_type" value="{{ $activity->Certificate_type }}" class="form-control" id="Certificate_type" required>
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
            </div>
        </div>
    </form>
@endsection
