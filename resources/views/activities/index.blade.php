@extends('layouts.back')

@section('title', 'กิจกรรมทั้งหมด')

@section('content')

<style>
    /* จัดการตำแหน่งของการกรองปีให้อยู่ทางซ้าย */
    .dataTables_filter {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 20px;
    }

    .year-filter {
        display: flex;
        align-items: center;
        margin-right: auto;
        position: relative; /* ใช้เพื่อจัดการตำแหน่งไอคอน */
    }

    .year-filter select {
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ddd;
        appearance: none; /* ซ่อนลูกศรเริ่มต้น */
    }

    .year-filter .select-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    /* ซ่อนลูกศร sorting ที่ซ้ำ */
    .dataTables_wrapper .sorting:after,
    .dataTables_wrapper .sorting_desc:after,
    .dataTables_wrapper .sorting_asc:after {
        display: none !important;
    }

    /* ปรับขนาดและจัดวางส่วนหัวของการ์ด */
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f8f9fa;
        padding: 15px;
        border-bottom: 1px solid #e3e6f0;
    }

    .card-header h3 {
        margin: 0;
        font-size: 20px;
    }

   
//* จัดการให้คอลัมน์ Action และคอลัมน์อื่นๆ มีความกว้างเท่ากัน */
.table th, .table td {
    width: auto;
    text-align: center;
    vertical-align: middle;
}

/* ปรับขนาดปุ่ม Action และจัดตำแหน่งให้กึ่งกลาง */
.action-btns {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px; /* เพิ่มระยะห่างระหว่างปุ่ม */
}

/* ปรับความกว้างของคอลัมน์ Action */
.table th:nth-child(6), .table td:nth-child(6) {
    width: 120px; /* ปรับขนาดความกว้างของคอลัมน์ Action */
}

/* กำหนดขนาดของปุ่มในคอลัมน์ Action */
.action-btns .btn {
    width: 35px;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5px;
    margin: 0 auto; /* จัดปุ่มให้อยู่ตรงกลาง */
}

/* ปรับความสูงของแถวให้เท่ากัน */
.table td {
    height: 110px; /* ปรับความสูงของแถวให้เท่ากัน */
    vertical-align: middle; /* จัดให้เนื้อหาอยู่กึ่งกลาง */
}


    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-edit {
        color: #007bff;
        background-color: transparent;
    }

    .btn-edit:hover {
        color: #0056b3;
    }

    .btn-delete {
        color: #dc3545;
        background-color: transparent;
    }

    .btn-delete:hover {
        color: #c82333;
    }

  
    .table td.activity-details {
    white-space: nowrap; /* ไม่ตัดบรรทัดใหม่ */
    overflow: hidden; /* ซ่อนข้อความที่เกิน */
    text-overflow: ellipsis; /* ตัดข้อความด้วย "..." */
    max-width: 300px; /* กำหนดความกว้างสูงสุดของคอลัมน์ */
    text-align: left; /* จัดข้อความให้อยู่ทางซ้าย */
}

    .activity-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    
    /* กรอบรอบข้อความผู้สมัคร */
.registration-count-box {
    padding: 5px;
    border: 2px solid #00ccff;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 10px; /* เพิ่มระยะห่างระหว่างผู้สมัครกับปุ่มรายชื่อ */
    color: #00ccff;
    font-weight: bold;
}

/* ปรับแต่งปุ่มรายชื่อให้มีไอคอนตา */
.btn-primary i {
    margin-right: 5px; /* เพิ่มระยะห่างระหว่างไอคอนกับข้อความ */
}

/* ปรับขนาดไอคอนตา */
.fas.fa-eye {
    font-size: 16px;
}
/* กรอบรอบข้อความผู้สมัคร */
.registration-count-box {
    padding: 5px;
    border: 2px solid #007bff;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 10px;
    color: #007bff;
    font-weight: bold;
}

/* ปรับขนาดปุ่มรายชื่อให้เล็กลง */
.btn-sm {
    padding: 5px 10px; /* ลดขนาด padding */
    font-size: 8px;   /* ลดขนาดฟอนต์ */
}

/* ปรับขนาดไอคอน */
.fas.fa-eye {
    font-size: 14px;
}

/* ปรับความกว้างของคอลัมน์ให้กว้างขึ้น */
.table th:nth-child(6), .table td:nth-child(6) {
    text-align: center; /* จัดการให้ข้อความในคอลัมน์ตรงกลาง */
}



/* ซ่อนตัวเลือก Show entries */
.dataTables_length {
    display: none; /* ซ่อนตัวเลือก Show entries */
}
/* ทำให้การค้นหาและตารางเลื่อนซ้ายขวาไปพร้อมกัน */
.dataTables_wrapper {
    width: 100%;
    overflow-x: scroll; /* เปิดการเลื่อนในแนวนอน */
}

.dataTables_filter {
    white-space: nowrap;
}


</style>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header bg-light text-back">
        <div class="row w-100">
            <div class="col-md-10">
                <h3>กิจกรรมทั้งหมด</h3>
            </div>
            <div class="col-md-2 text-right">
                <a class="btn btn-primary" href="{{ route('activities.create') }}">
                    <i class="fas fa-plus"></i> เพิ่มกิจกรรม
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <div class="dataTables_filter">
                <form id="yearFilterForm" method="GET" action="{{ route('activities.index') }}" class="year-filter">
                    <div class="form-group">
                        <select name="year" id="yearFilter" class="form-control">
                            <option value="">-- เลือกปี --</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request()->get('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <!-- ไอคอน dropdown -->
                        <span class="select-icon">
                            <i class="fas fa-caret-down"></i>
                        </span>
                    </div>
                </form>
            </div>

            <table id="add-row" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ปี</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>ระดับ</th>
                        <th>ติดต่อ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($activities->isNotEmpty())
                    @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $activity->year }}</td>
                            <td class="activity-details">
                                <span class="activity-name">({{ $activity->type }})</span><br>
                                <span class="activity-name">{{ $activity->name }}</span><br>
                                
                              
                                <div class="registration-count-box">
                                    <span>ผู้สมัคร: {{ $activity->registrations_count }} ทีม</span>
                                </div>
                                
                                
                                <a href="{{ route('activities.showRegistrations', ['id' => $activity->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>ดูรายชื่อ
                                </a><br>
                                <span>วันที่: {{ \Carbon\Carbon::parse($activity->date)->format('d-m-Y') }} </span>
                                <span>เวลา:{{ \Carbon\Carbon::parse($activity->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($activity->end_time)->format('H:i') }}</span>
                            </td>
                            
                            
                            <td>{{ $activity->level }}</td>
                            <td>{{ $activity->teacher_name }}</td>
                            <td class="action-btns">
                                <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('คุณแน่ใจว่าต้องการลบกิจกรรมนี้?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9" class="text-center">ไม่มีกิจกรรมที่จะแสดง</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('yearFilter').addEventListener('change', function() {
        document.getElementById('yearFilterForm').submit();
    });

    $(document).ready(function() {
    $('#add-row').DataTable({
        "paging": true,       // เปิดการแบ่งหน้า
        "searching": true,    // เปิดการค้นหา
        "ordering": true,     // เปิดการเรียงลำดับ
        "info": true,         // แสดงข้อมูลการแบ่งหน้า
        "scrollX": true       // เปิดการเลื่อนในแนวนอน
    });
});

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    $(document).ready(function() {
        // ตรวจสอบว่าตารางถูกสร้างแล้วหรือยัง
        if (!$.fn.DataTable.isDataTable('#add-row')) {
            $('#add-row').DataTable({
                // กำหนดค่า DataTable ของคุณที่นี่
            });
        }
    });



</script>

@endsection
