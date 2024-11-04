<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ล็อกอิน</title>

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
        }
        .card-header {
            background: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }
        .form-control-user {
            border-radius: 10px;
        }
        .btn-user {
            border-radius: 10px;
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
    </style>
</head>

<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">ยินดีต้อนรับ!</h1>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="กรอกอีเมล" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="รหัสผ่าน" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">จดจำฉัน</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            เข้าสู่ระบบ
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register.form') }}">สร้างบัญชีใหม่!</a>
                                
                                    </div>
                                    
                                    @php
                                    $http_build_query = http_build_query([
                                        'client_id' => env('OAUTH_CLIENT_ID'),
                                        'redirect_uri' => env('OAUTH_CLIENT_REDIRECT_URI'),
                                        'response_type' => 'code',
                                        'scope' => '*',
                                    ]);
                                    $URI = 'https://passport.yru.ac.th/oauth/authorize?'.$http_build_query;
                                @endphp
                                <div class="text-center">
                                    <a href="{{ $URI }}" class="button">
                                        <span>Login with YRU Passport</span>
                                    </a>
                                </div>
                            
                                </div>
                            </div>
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
