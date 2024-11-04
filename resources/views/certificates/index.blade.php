@extends('layouts.app')

@section('title', 'รายการเกียรติบัตร')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header bg-warning text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">รายการเกียรติบัตร</h2>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อผู้รับ</th>
                    <th>กิจกรรม</th>
                    <th>โรงเรียน/หน่วยงาน</th>
                    <th>เกียรติบัตรเข้าร่วม</th>
                    <th>เกียรติบัตรรางวัล</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($registration->type === 'team')
                            @php
                                $teamMembers = json_decode($registration->team_members, true);
                            @endphp
                            <ul>
                                @foreach ($teamMembers as $member)
                                    <li>{{ $member }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $registration->registrant_name ?? 'ไม่ระบุ' }}
                        @endif
                    </td>

                    <td>{{ $registration->activity->name ?? 'ไม่ระบุ' }}</td>

                    <td>{{ $registration->school_name ?? 'ไม่ระบุ' }}</td>

                    {{-- ปุ่มดาวน์โหลดเกียรติบัตรเข้าร่วม --}}
                    <td class="text-center">
                        <a href="{{ route('certificates.participate', ['id' => $registration->id]) }}" class="btn btn-success">
                            ดาวน์โหลด
                        </a>
                    </td>

                    {{-- ปุ่มดาวน์โหลดเกียรติบัตรรางวัล --}}
                    {{-- ตรวจสอบการแสดงปุ่มดาวน์โหลด --}}
<td class="text-center">
    @if(in_array($registration->result, ['รับรางวัลชนะเลิศ', 'รับรางวัลรองชนะเลิศอันดับ 1', 'รับรางวัลรองชนะเลิศอันดับ 2', 'รับรางวัลชมเชย']))
        <a href="{{ route('certificates.template', ['id' => $registration->id]) }}" class="btn btn-primary">
            ดาวน์โหลด
        </a>
    @else
        <p>คุณไม่ได้รับรางวัล</p>
    @endif
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
