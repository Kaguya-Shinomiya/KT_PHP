<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header với Bootstrap</title>
    <!-- Link Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #1d1d1d; /* Màu nền đen */
        }
        .navbar-brand, .nav-link {
            color: white !important; /* Màu chữ trắng */
        }
        .nav-link:hover {
            color: gray !important; /* Hiệu ứng hover */
        }
    </style>
</head>
<body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Test1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/KT_PHP/index.php?action=index">Sinh Viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/KT_PHP/index.php?action=show_hp">Học Phần</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đăng Ký (<span id="cart-count">0</span>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Đăng Nhập</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
