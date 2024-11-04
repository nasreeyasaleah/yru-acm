@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-dark mb-5">ข่าวประชาสัมพันธ์</h2>

    <div class="announcement-list">
        @foreach ($announcements as $announcement)
        <div class="announcement-item mb-4 p-3 shadow-sm bg-white rounded">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="announcement-title text-primary mb-2">{{ $announcement->title }}</h5>
                <small class="text-muted">
                    {{ \Carbon\Carbon::parse($announcement->announcement_date)->locale('th')->translatedFormat('d M ') . (\Carbon\Carbon::parse($announcement->announcement_date)->year + 543) }}
                </small>
            </div>
            <p class="announcement-content mb-2">{{ Str::limit($announcement->content, 100) }}</p>
            <div class="d-flex justify-content-between align-items-center">
                @if($announcement->file_path)
                <a href="{{ Storage::url($announcement->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-download"></i> ดาวน์โหลดไฟล์แนบ
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f4f4f9;
    }

    .announcement-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .announcement-item {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        padding: 1.5rem;
        transition: box-shadow 0.3s ease;
    }

    .announcement-item:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .announcement-title {
        font-size: 1.25rem;
        color: #007bff;
    }

    .announcement-content {
        font-size: 1rem;
        color: #333;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    /* ไอคอนดาวน์โหลด */
    .fas.fa-download {
        margin-right: 0.5rem;
    }

    /* สำหรับหน้าจอเล็ก */
    @media (max-width: 768px) {
        .announcement-title {
            font-size: 1rem;
        }

        .announcement-item {
            padding: 1rem;
        }
    }
</style>
@endpush
