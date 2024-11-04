@extends('layouts.back')

@section('title', 'รายละเอียดการติดต่อ')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>รายละเอียดการติดต่อ</h3>
        </div>
        <div class="card-body">
            <p><strong>ชื่อ:</strong> {{ $contact->name }}</p>
            <p><strong>หัวข้อ:</strong> {{ $contact->subject }}</p>
            <p><strong>อีเมล:</strong> {{ $contact->email }}</p>
            <p><strong>ข้อความ:</strong> {{ $contact->message }}</p>
            <p><strong>วันที่ส่ง:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">กลับ</a>
        </div>
    </div>
@endsection
