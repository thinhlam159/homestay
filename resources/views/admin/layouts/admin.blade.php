<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Quản lý Homestay/Villa</title>
    <!-- Thêm CSS của bạn vào đây (ví dụ: Bootstrap, Tailwind CSS, hoặc CSS tùy chỉnh) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif; /* Hoặc font chữ bạn muốn */
        }
        #wrapper {
            display: flex;
        }
        #sidebar {
            width: 250px; /* Độ rộng sidebar */
            background-color: #f8f9fa; /* Màu nền sidebar */
            padding-top: 20px;
            min-height: 100vh; /* Sidebar full chiều cao màn hình */
        }
        #content-wrapper {
            flex: 1; /* Content chiếm phần còn lại */
            padding: 20px;
        }
        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .list-group-item {
            border: none;
            background-color: transparent;
            padding: 0.75rem 1.25rem;
        }
        .list-group-item:hover {
            background-color: #e9ecef; /* Màu hover sidebar item */
        }
    </style>
</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-heading">
            Admin Menu
        </div>
        <div class="list-group list-group-flush">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
{{--            <a href="#" class="list-group-item list-group-item-action">Quản lý Tỉnh/Thành phố</a>--}}
{{--            <a href="#" class="list-group-item list-group-item-action">Quản lý Quận/Huyện</a>--}}
{{--            <a href="#" class="list-group-item list-group-item-action">Quản lý Phường/Xã</a>--}}
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Quản lý Danh mục</a>
            <a href="{{ route('admin.properties.index') }}" class="list-group-item list-group-item-action">Quản lý Homestay</a>
            <a href="#" class="list-group-item list-group-item-action">Quản lý Tags</a>
            <a href="#" class="list-group-item list-group-item-action">Quản lý Đánh giá</a>
            <a href="#" class="list-group-item list-group-item-action">Quản lý Đặt phòng</a>
            <a href="#" class="list-group-item list-group-item-action">Quản lý Khách hàng</a>
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Quản lý Người dùng</a>
            <a href="{{ route('admin.roles.index') }}" class="list-group-item list-group-item-action">Quản lý Vai trò</a>
            <a href="{{ route('admin.permissions.index') }}" class="list-group-item list-group-item-action">Quản lý Quyền</a>
        </div>
    </nav>

    <!-- Content Wrapper -->
    <div id="content-wrapper">
        <!-- Header (có thể thêm navbar ở đây nếu cần) -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Xin chào, Admin</a> <!-- Thay bằng tên người dùng -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <div class="container-fluid">
            @yield('content') {{-- Nội dung trang con sẽ được chèn vào đây --}}
        </div>

        <!-- Footer (tùy chọn) -->
        <footer>
            <hr>
            <div class="text-center py-3">
                © {{ date('Y') }} Quản lý Homestay/Villa - Backend Admin
            </div>
        </footer>
    </div>
    <!-- End Content Wrapper -->
</div>
<!-- End Wrapper -->

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Thêm JS của bạn vào đây nếu cần -->
</body>
</html>
