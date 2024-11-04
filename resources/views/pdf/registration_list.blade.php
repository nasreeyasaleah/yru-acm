<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ใบลงทะเบียนงานสัปดาห์วิทยาศาสตร์แห่งชาติ</title>
    
    <style>
        @page {
            size: A4 landscape;
            margin: 20mm;
        }
       

       

        .header {
            text-align: center;
            margin-bottom: 0.5px;
        }

        .header h3 {
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }

        .info {
            margin-top: 2px;
            margin-bottom: 10px;
        }

        .info div {
            margin-bottom: 3px;
            line-height: 1.0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 16px;
            text-align: left;
        }

        th {
            background-color: hsl(0, 0%, 95%);
        }

        .logo {
            margin-top: 20px;
            text-align: center;
        }

        .logo img {
            width: 90px;
        }
    </style>
</head>
<body>

    <div class="logo">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo b.png'))) }}" alt="โลโก้">
    </div>
    
    <div class="header">
        <h3>ใบลงทะเบียนงานสัปดาห์วิทยาศาสตร์แห่งชาติ ประจำปี {{ $activity->year }}</h3>
    </div>

    <center>
        <div class="info">
            <div>กิจกรรม: {{ $activity->name }}</div>
            <div>วันที่: {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('j F Y') }} เวลา: {{ \Carbon\Carbon::parse($activity->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($activity->end_time)->format('H:i') }}</div>
            <div>ณ: ..................................................................</div>
        </div>
    </center>

    <table>
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ-สกุล</th>
                <th>โรงเรียน</th>
                <th>ผู้ควบคุม</th>
                <th>ลงนาม</th>
                <th>หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $index => $registration)
                @if($registration->type === 'team')
                    @php
                        $teamMembers = json_decode($registration->team_members, true);
                    @endphp
                    @if(is_array($teamMembers) && !empty($teamMembers))
                        @foreach ($teamMembers as $memberIndex => $member)
                            <tr>
                                @if($memberIndex === 0)
                                    <td rowspan="{{ count($teamMembers) }}">{{ $index + 1 }}</td>
                                    <td>{{ $member }}</td>
                                    <td rowspan="{{ count($teamMembers) }}">{{ $registration->school_name }}</td>
                                    <td rowspan="{{ count($teamMembers) }}">{{ $registration->title }} {{ $registration->supervisor_name }}</td>
                                @else
                                    <td>{{ $member }}</td>
                                @endif
                                <td></td> <!-- Empty for signature -->
                                <td></td> <!-- Empty for note -->
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $registration->registrant_name }}</td>
                        <td>{{ $registration->school_name }}</td>
                        <td>{{ $registration->title }} {{ $registration->supervisor_name }}</td>
                        <td></td> <!-- Empty for signature -->
                        <td></td> <!-- Empty for note -->
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

</body>
</html>
