<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกียรติบัตรเข้าร่วม</title>
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');

body {
    font-family: 'Sarabun', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #ffffff;
}

.certificate {
    width: 100%;
    height: 100vh;
    padding: 10px;
    box-sizing: border-box;
    text-align: center;
    position: relative;
}

/* จัดตำแหน่งลำดับและปีการศึกษาที่มุมขวาบน */
.certificate-header {
    position: absolute;
    top: 0px; /* ปรับให้ขึ้นด้านบนสุด */
    right: 20px;
    text-align: right;
    font-size: 18px;
    font-weight: 600;
    color: #000000;
    font-family: 'Sarabun', sans-serif;
}

/* จัดการแสดงผลอื่นๆ */
.logos {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    margin-bottom: 5px;
}

.logos img {
    height: 120px; /* ลดขนาดโลโก้ */
}

h2.faculty-name {
    font-size: 32px; /* ลดขนาดฟอนต์ของชื่อคณะ */
    margin: 3px 0;
    font-weight: 600;
    color: #000000;
}

p {
    font-size: 24px; /* ลดขนาดฟอนต์ของข้อความทั่วไป */
    margin: 1px 0;
    line-height: 1.0; /* ลด line-height เพื่อลดช่องว่างระหว่างบรรทัด */
}

.recipient-name {
    font-weight: bold;
    font-size: 30px; /* ลดขนาดฟอนต์ของชื่อผู้รับ */
    margin: 10px 0;
}

.signature-table {
    width: 100%;
    margin-top: 60px; /* ลดระยะห่างระหว่างข้อความและลายเซ็น */
    table-layout: fixed;
}

.signature-table td {
    width: 50%;
    padding: 0 10px;
    vertical-align: top;
    text-align: center; /* จัดให้อยู่ตรงกลาง */
}

.signature-line {
    border-top: 1px solid black;
    width: 80%;
    margin: 0 auto;
    margin-bottom: 5px;
}

.name-position {
    text-align: center;
    font-size: 16px; /* ลดขนาดฟอนต์ของชื่อและตำแหน่งผู้ลงนาม */
}

/* Signature images */
.signature-img {
    height: 50px; /* ลดขนาดลายเซ็น */
    display: block;
    margin: 0 auto 5px; /* จัดให้อยู่ตรงกลาง */
}

img {
    display: block;
    margin: 5px auto; /* จัดให้อยู่กลาง */
}
    </style>
</head>

<body>

@php
    // ฟังก์ชันแปลงเลขอารบิกเป็นเลขไทย
    function convertToThaiNumerals($number) {
        $thai_num = ['0' => '๐', '1' => '๑', '2' => '๒', '3' => '๓', '4' => '๔', '5' => '๕', '6' => '๖', '7' => '๗', '8' => '๘', '9' => '๙'];
        return strtr($number, $thai_num);
    }

    // แปลงเลขให้เป็นเลขไทย
    $orderNumber = convertToThaiNumerals($registration->id);
    $academicYear = convertToThaiNumerals($activity->year);
@endphp

@if ($registration->type === 'team')
    @php
        $teamMembers = json_decode($registration->team_members, true);
    @endphp

    @if ($teamMembers && is_array($teamMembers))
        @foreach ($teamMembers as $member)
            <div class="certificate">
                {{-- ลำดับและปีการศึกษาที่มุมขวาบน --}}
                <div class="certificate-header">
                    STA {{ $orderNumber }}/{{ $academicYear }}
                </div>

                {{-- เนื้อหาหลักของเกียรติบัตร --}}
                <div class="logos">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Resizer.png'))) }}" alt="Resizer Logo">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo">
                </div>
                
                <h2 class="faculty-name">คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร มหาวิทยาลัยราชภัฏยะลา</h2>

                <p>เกียรติบัตรฉบับนี้ให้ไว้เพื่อแสดงว่า</p>
                <h2 class="recipient-name">{{ $member }}</h2>

                <p>{{ $registration->school_name }}</p>
                <p>ได้เข้าร่วมกิจกรรม<strong> {{ $registration->activity->name }}</strong></p>
                <p>ระดับ {{ $activity->level }}</p>

                {{-- เงื่อนไข: แสดงที่ปรึกษาเฉพาะ template1 เท่านั้น --}}
                @if($activity->certificate_type !== 'รูปแบบที่ 2 (ไม่มีที่ปรึกษา)')
                    <p>โดยมี {{ $registration->title }} {{ $registration->supervisor_name }} เป็นที่ปรึกษา</p>
                @endif

                <p>ให้ไว้ ณ วันที่ </strong>{{ \Carbon\Carbon::parse($activity->date)->translatedFormat('j F Y') }}</p>

                <table class="signature-table">
                    <tr>
                        <td>
                            @if ($certificate->signature1)
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/signature1.png'))) }}" class="signature-img" alt="Signature 1">
                            @endif
                            <div class="name-position">
                                <p>({{ $certificate->name1 }})</p>
                                <p>{{ $certificate->position1 }}</p>
                            </div>
                        </td>
                        <td>
                            @if ($certificate->signature2)
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/signature2.png'))) }}" class="signature-img" alt="Signature 2">
                            @endif
                            <div class="name-position">
                                <p>({{ $certificate->name2 }})</p>
                                <p>{{ $certificate->position2 }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            {{-- เพิ่มการแบ่งหน้า --}}
            <div style="page-break-after: always;"></div>
        @endforeach
    @endif
@else
    <div class="certificate">
        {{-- ลำดับและปีการศึกษาที่มุมขวาบน --}}
        <div class="certificate-header">
            STA {{ $orderNumber }}/{{ $academicYear }}
        </div>

        {{-- เนื้อหาหลักของเกียรติบัตร --}}
        <div class="logos">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Resizer.png'))) }}" alt="Resizer Logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo">
        </div>
        
        <h2 class="faculty-name">คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร มหาวิทยาลัยราชภัฏยะลา</h2>

        <p>เกียรติบัตรฉบับนี้ให้ไว้เพื่อแสดงว่า</p>
        <h2 class="recipient-name">{{ $registration->registrant_name }}</h2>

        <p>{{ $registration->school_name }}</p>
        <p>ได้เข้าร่วมกิจกรรม<strong> {{ $registration->activity->name }}</strong></p>
        <p>ระดับ {{ $activity->level }}</p>

        {{-- เงื่อนไข: แสดงที่ปรึกษาเฉพาะ template1 เท่านั้น --}}
        @if($activity->certificate_type !== 'รูปแบบที่ 2 (ไม่มีที่ปรึกษา)')
            <p>โดยมี {{ $registration->title }} {{ $registration->supervisor_name }} เป็นที่ปรึกษา</p>
        @endif

        <p>ให้ไว้ ณ วันที่ </strong>{{ \Carbon\Carbon::parse($activity->date)->translatedFormat('j F Y') }}</p>

        <table class="signature-table">
            <tr>
                <td>
                    @if ($certificate->signature1)
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/signature1.png'))) }}" class="signature-img" alt="Signature 1">
                    @endif
                    <div class="name-position">
                        <p>({{ $certificate->name1 }})</p>
                        <p>{{ $certificate->position1 }}</p>
                    </div>
                </td>
                <td>
                    @if ($certificate->signature2)
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/signature2.png'))) }}" class="signature-img" alt="Signature 2">
                    @endif
                    <div class="name-position">
                        <p>({{ $certificate->name2 }})</p>
                        <p>{{ $certificate->position2 }}</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
@endif

</body>

</html>
