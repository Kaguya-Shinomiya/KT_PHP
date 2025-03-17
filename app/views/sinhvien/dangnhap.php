<?php include __DIR__ . '/../shares/header.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">ĐĂNG NHẬP</h2>
        
        <form action="/KT_PHP/index.php?action=kiemtra" method="POST">
            <div class="mb-3">
                <label for="MaSV" class="form-label">MaSV</label>
                <input type="text" class="form-control" id="MaSV" name="MaSV" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>

        <br>
        <a href="/KT_PHP/index.php?action=index">Back to List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include __DIR__ . '/../shares/footer.php'; ?>
