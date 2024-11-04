@extends('layouts.back')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-secondary text-white"> <!-- เปลี่ยนเป็นสีเทา -->
            <h2 class="text-center">สร้างข่าวสารใหม่</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="form-label">หัวข้อ</label>
                    <input type="text" name="title" class="form-control" placeholder="ใส่หัวข้อข่าว" required>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label">รายละเอียด</label>
                    <textarea name="content" class="form-control" rows="5" placeholder="รายละเอียดข่าว" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="announcement_date" class="form-label">วันที่</label>
                    <input type="date" name="announcement_date" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label for="file" class="form-label">แนบไฟล์ (ถ้ามี)</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-block">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .container {
        max-width: 600px;
    }

    .card {
        border-radius: 1rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        background-color: #6c757d; /* เปลี่ยนเป็นสีเทา */
        padding: 1.25rem;
        text-align: center;
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.75rem;
        font-size: 1rem;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .btn-block {
        width: 100%;
        padding: 0.75rem;
        font-size: 1.25rem;
        border-radius: 0.5rem;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>
@endpush
