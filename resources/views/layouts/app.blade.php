<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ระบบลงทะเบียนงานสัปดาห์วิทยาศาสตร์</title>
    
    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<style>
    /* พื้นหลังของ sidebar */
    .bg-gradient-pink {
        background: #FFC300;
    }

    /* ปรับแต่งข้อความของแทบเมนู */
    .navbar-nav .nav-item {
        margin-bottom: 15px; /* ลดระยะห่างระหว่าง nav item */
    }

    /* สีและสไตล์ของลิงก์ในเมนู */
    /* ปรับแต่งสีของข้อความในแทบเมนู */
.navbar-nav .nav-link {
    color: #000000 !important; /* กำหนดสีข้อความเป็นสีดำ */
    font-weight: 600; /* กำหนดความหนาของข้อความ */
    padding: 10px 15px; /* เพิ่มพื้นที่รอบๆข้อความ */
    border-radius: 5px; /* ทำมุมโค้งเล็กๆ ให้กับแทบเมนู */
    transition: background-color 0.3s ease;
}

/* ปรับแต่งสีของไอคอนในแทบเมนู */
.navbar-nav .nav-link i {
    color: #000000 !important; /* กำหนดสีไอคอนเป็นสีดำ */
}

/* เอฟเฟกต์เมื่อชี้เมาส์บนลิงก์ */
.navbar-nav .nav-link:hover {
    background-color: #fffffe; /* เปลี่ยนสีพื้นหลังเมื่อชี้เมาส์ */
    color: #070707 !important; /* กำหนดสีข้อความเป็นสีขาว */
}


    

    /* ปรับแต่งสไตล์รูปผู้ใช้ */
    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px; /* เพิ่มระยะห่างระหว่างรูปภาพและชื่อผู้ใช้ */
    }

    /* ปรับแต่งแทบเมนูด้านบน (Topbar) */
    .topbar {
        background-color: #999696; /* สีพื้นหลังของ Topbar */
        box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1); /* เพิ่มเงาให้ดูมีมิติ */
    }

    /* สไตล์การค้นหา */
    .navbar-search .form-control {
        border: 1px solid #cccccc; /* ขอบของช่องค้นหา */
        border-radius: 30px; /* ทำมุมโค้งให้ช่องค้นหา */
    }

    .navbar-search .btn {
        background-color: #5e5f57; /* สีพื้นหลังของปุ่มค้นหา */
        border-radius: 30px; /* ทำมุมโค้งให้ปุ่ม */
    }

</style>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-pink sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- Optionally, you can add an icon here if needed -->
        </div>
        <div class="sidebar-brand-text mx-3">YRU Academic</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('announcements.index') }}">
            <i class="fas fa-home"></i> <!-- Home Icon -->
            <span>หน้าแรก</span>
        </a>
    </li>

    <!-- Nav Item - Register Activity -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('registrations.index') }}">
            <i class="fas fa-calendar-plus"></i> <!-- Calendar Plus Icon -->
            <span>ลงทะเบียนกิจกรรม</span>
        </a>
    </li>
   

    <!-- Nav Item - Registration Results -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('registrations.results') }}">
            <i class="fas fa-list-alt"></i> <!-- List Alt Icon -->
            <span>ผลของการลงทะเบียน</span>
        </a>
    </li>

    <!-- Nav Item - Print Certificates -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('certificates.index') }}">
            <i class="fas fa-certificate"></i> <!-- Certificate Icon -->
            <span>พิมพ์เกียติบัตร</span>
        </a>
    </li>

    <!-- Nav Item - Contact Us -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact.form') }}">
            <i class="fas fa-envelope"></i> <!-- Envelope Icon -->
            <span>ติดต่อเรา</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                   
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
    
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        

                       
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler - 58m ago</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month.</div>
                                        <div class="small text-gray-500">Jae Chun - 1d ago</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">The report is ready to be reviewed.</div>
                                        <div class="small text-gray-500">Morgan Alvarez - 2d ago</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="user-info">
                                    @if (Auth::check())
                                        <span class="full_name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                                    @endif
                                    <img src="{{ asset('images/user.jpg') }}" alt="user" class="user-image">
                                </div>
                            </a>
                        
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">คุณแน่ใจที่จะออกจากระบบหรือไหม?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">"เลือก 'ออกจากระบบ' ด้านล่างหากคุณพร้อมที่จะสิ้นสุดการใช้งานในครั้งนี้"</div>
        <div class="modal-footer">
            <!-- ปุ่ม Logout ที่ทำการ submit ฟอร์ม logout -->
            <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ออกจากระบบ
            </button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
        </div>
    </div>
</div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>

                
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
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


   <!-- Page level plugins -->
   <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

   <!-- Page level custom scripts -->
   <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
