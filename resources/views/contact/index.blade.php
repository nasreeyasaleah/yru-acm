@extends('layouts.back')

@section('title', 'รายการติดต่อจากผู้ใช้')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>รายการติดต่อจากผู้ใช้</h3>
        </div>
        <div class="card-body">
            @if($contacts->isEmpty())
                <p>ไม่มีการติดต่อจากผู้ใช้</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ชื่อ</th>
                            <th>หัวข้อ</th>
                            <th>อีเมล</th>
                            <th>ข้อความ</th>
                            <th>วันที่ส่ง</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ Str::limit($contact->message, 50) }}</td>
                                <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-primary">ดูรายละเอียด</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
