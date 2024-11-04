<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('images/backkul.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9); /* เพิ่มพื้นหลังโปร่งใส */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
            max-width: 600px; /* กำหนดความกว้างสูงสุด */
            width: 100%; /* ทำให้การ์ดเต็มความกว้างของคอนเทนเนอร์ */
        }
        .card-header {
            background: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }
        .form-control-user {
            border-radius: 10px;
            padding: 1rem;
        }
        .btn-user {
            border-radius: 10px;
            padding: 0.75rem;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .btn-primary:hover {
            background-color: #224abe;
            border-color: #224abe;
        }
        .text-gray-900 {
            color: #4e73df;
        }
        .bg-register-image {
            background-image: url('{{ asset('images/register-bg-img.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100%;
            border-radius: 15px 0 0 15px;
        }
    </style>
</head>

<body>
    
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">สร้างบัญชีผู้ใช้ใหม่</h1>
                            </div>
                            <form class="user" action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="first_name" class="form-control form-control-user" id="first_name" placeholder="ชื่อ" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control form-control-user" id="last_name" placeholder="สกุล" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="อีเมล" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="รหัสผ่าน" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user" id="password-confirm" placeholder="ยันยืนรหัสผ่าน" required>
                                    </div>
                                </div>
                                <!-- Additional Fields -->
                                <div class="form-group">
                                    <input type="text" name="school_name" class="form-control form-control-user" id="school_name" placeholder="ชื่อโรงเรียน" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control form-control-user" id="address" placeholder="ที่อยู่โรงเรียน" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control form-control-user" id="phone" placeholder="โทรศัพท์" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    สมัครสมาชิก
                                </button>
                                <hr>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
