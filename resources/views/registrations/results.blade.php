@extends('layouts.app')

@section('title', 'ผลของการลงทะเบียน')

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

    @auth
    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">ผลของการลงทะเบียน</h2>
                <form action="{{ route('registrations.results') }}" method="GET" class="form-inline mb-4">
                    <label for="year" class="mr-2">เลือกปีการศึกษา:</label>
                    <select name="year" id="year" class="form-control">
                        @foreach($years as $year)
                            <option value="{{ $year->year }}" {{ request()->get('year') == $year->year || (!request()->has('year') && $year->year == '2567') ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                </form>
                
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                @forelse ($registrations as $registration)
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-4 shadow-sm" style="border-radius: 15px; background-color: #f8f9fa; border: 1px solid #ccc; min-height: 350px;">
                            <div class="card-body">
                                <h5 class="card-title text-primary" style="font-weight: bold;">กิจกรรม: {{ $registration->activity->name ?? 'ไม่มีข้อมูล' }}</h5>
                                <p class="card-text" style="color: #555;">
                                    <strong>ชื่อนักเรียน:</strong> 
                                    @if($registration->type === 'team')
                                        @php
                                            // แปลง team_members จาก JSON เป็น array
                                            $teamMembers = json_decode($registration->team_members, true);
                                        @endphp
                                        @if ($teamMembers && is_array($teamMembers))
                                            <ul>
                                                @foreach ($teamMembers as $member)
                                                    <li>{{ $member }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>ไม่มีข้อมูลสมาชิกทีม</p>
                                        @endif
                                    @else
                                        {{ $registration->registrant_name ?? 'ไม่มีข้อมูล' }}
                                    @endif
                                    <br>
                                    <strong>โรงเรียน:</strong> {{ $registration->school_name ?? 'ไม่มีข้อมูล' }}<br>
                                    <strong>ที่อยู่:</strong> {{ $registration->address ?? 'ไม่มีข้อมูล' }}<br>
                                    <strong>ประเภทกิจกรรม:</strong> {{ $registration->activity->type ?? 'ไม่มีข้อมูล' }}<br>
                                    <strong>ระดับ:</strong> {{ $registration->activity->level ?? 'ไม่มีข้อมูล' }}<br>
                                    @if($registration->type === 'team')
                                        <strong>ชื่อผลงาน:</strong> {{ $registration->project_name ?? '-' }}<br>
                                    @endif
                                    <strong>คุณครู/ผู้ควบคุม:</strong> {{ $registration->title ?? '' }} {{ $registration->supervisor_name ?? '' }}<br>
                                    <strong>วันที่แข่งขัน:</strong>{{ \Carbon\Carbon::parse($registration->activity->date)->format('d-m-Y') ?? 'ไม่มีข้อมูล'  }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">ไม่มีข้อมูลการลงทะเบียน</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @endauth

@endsection
