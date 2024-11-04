<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ผลการลงทะเบียน</title>
    
    <style>
        .header {
            text-align: center;
        }

        .header h3 {
            margin: 0;
            padding: 0;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 50px;
        }

        .info div {
            margin-bottom: 10px;
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
            padding: 10px;
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
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo b.png'))) }}" alt="โลโก้" width="20">
    </div>
    
    <div class="header">
        <h3>ผลการแข่งขันงานสัปดาห์วิทยาศาสตร์แห่งชาติ ประจำปี {{ $activity->year }}</h3>
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
                <th>ชื่อ-นามสกุล</th>
                <th>โรงเรียน</th>
                <th>ผู้ควบคุม</th>
                <th>ผลการแข่งขัน</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $index => $registration)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $registration->registrant_name }}</td>
                    <td>{{ $registration->school_name }}</td>
                    <td>{{ $registration->title }} {{ $registration->supervisor_name }}</td>
                    <td>{{ $registration->result }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
