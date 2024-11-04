@extends('layouts.app')

@section('title', 'ติดต่อเรา')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 mb-4 bg-white rounded">
                <h2 class="text-warning">ติดต่อเรา</h2>
                <p>หากคุณมีคำถามหรือข้อสงสัยใด ๆ โปรดอย่าลังเลที่จะติดต่อเราโดยใช้แบบฟอร์มด้านล่าง</p>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">ชื่อของคุณ</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">อีเมลของคุณ</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">หัวข้อ</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">ข้อความของคุณ</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">ส่งข้อความ</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4 mb-4 bg-white rounded">
                <h2 class="text-warning">ข้อมูลการติดต่อ</h2>
                <p>
                    <strong>ที่อยู่:</strong> 133 ถนน เทศบาล 3 ตำบล สะเตง, อำเภอ เมืองยะลา, ยะลา 95000<br>
                    <strong>โทรศัพท์:</strong>073299699<br>
                    <strong>อีเมล:</strong> example@example.com
                </p>
                <h2 class="text-warning">แผนที่</h2>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe 
                    class="embed-responsive-item" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.944499850468!2d101.274575!3d6.544574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31b4bdc1603e5c21%3A0x40100b25de28040!2zMTMzIOC4iOC4p-C4q-C4reC4p-C4tOC5jOC4seC4iuC5iOC4reC5gOC4suC4quC5gOC4peC5jCDguKvguKPguLTguJnguJXguK3guKPguLLguK3guLLguKXguKLguKkg4LiXIOC4peC4t-C4oeC4uOC5gOC4peC4qOC5hOC5hOC4geC5guC4nA!5e0!3m2!1sth!2sth!4v1693501234567!5m2!1sth!2sth" 
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    h2 {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
</style>
@endsection
