@extends('layouts.app')

@section('title', 'กิจกรรมทั้งหมด')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<!-- Filter Year -->
<div class="card shadow mb-4">
    <div class="card-header bg-warning text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-black">กิจกรรมทั้งหมด</h4>
            <form action="{{ route('registrations.index') }}" method="GET" class="form-inline">
                <label for="year" class="mr-2">เลือกปีการศึกษา:</label>
                    <select name="year" id="year" class="form-control">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request()->get('year') == $year || (!request()->has('year') && $year == '2567') ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
            </form>
        </div>
    </div>

    <!-- Custom Table Example -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">ลำดับ</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">ปี</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">ชื่อกิจกรรม</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">ระดับ</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">ประเภท</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">วันที่</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">เวลา</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">ติดต่อ</th>
                        <th style="text-align: center; background-color: rgb(238, 231, 167); color: black;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($activities) && $activities->isNotEmpty())
                        @foreach ($activities as $activity)
                        <tr style="color: black;">
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: center;">{{ $activity->year }}</td>
                            <td style="text-align: center;">{{ $activity->name }}</td>
                            <td style="text-align: center;">{{ $activity->level }}</td>
                            <td style="text-align: center;">{{ $activity->type }}</td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse($activity->date)->format('d-m-Y') }}</td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse($activity->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($activity->end_time)->format('H:i') }}</td>
                            <td style="text-align: center;">{{ $activity->teacher_name }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('registrations.create', ['activity' => $activity->id]) }}" class="btn btn-sm btn-primary">
                                    ลงทะเบียน
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">ไม่มีข้อมูลกิจกรรม</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
