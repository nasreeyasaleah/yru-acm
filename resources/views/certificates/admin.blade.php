@extends('layouts.back')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h3 class="card-title">จัดการเกียรติบัตร</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('certificate.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="name1">ชื่อผู้ลงนามที่ 1</label>
                <input type="text" name="name1" class="form-control" placeholder="กรอกชื่อผู้ลงนามที่ 1" value="{{ $certificate->name1 ?? '' }}">
            </div>

            <div class="form-group mb-3">
                <label for="position1">ตำแหน่งผู้ลงนามที่ 1</label>
                <input type="text" name="position1" class="form-control" placeholder="กรอกตำแหน่งผู้ลงนามที่ 1" value="{{ $certificate->position1 ?? '' }}">
            </div>

            <div class="form-group mb-3">
                <label for="name2">ชื่อผู้ลงนามที่ 2</label>
                <input type="text" name="name2" class="form-control" placeholder="กรอกชื่อผู้ลงนามที่ 2" value="{{ $certificate->name2 ?? '' }}">
            </div>

            <div class="form-group mb-3">
                <label for="position2">ตำแหน่งผู้ลงนามที่ 2</label>
                <input type="text" name="position2" class="form-control" placeholder="กรอกตำแหน่งผู้ลงนามที่ 2" value="{{ $certificate->position2 ?? '' }}">
            </div>

            <div class="form-group mb-3">
                <label for="signature1">ลายเซ็นผู้ลงนามที่ 1</label>
                <input type="file" id="signature1" name="signature1" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="signature2">ลายเซ็นผู้ลงนามที่ 2</label>
                <input type="file" id="signature2" name="signature2" class="form-control">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>
@endsection
