<?php include __DIR__ . '/../shares/header.php'; ?>

<h1>Chi tiết Sinh Viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="student-detail">
    <h2><?php echo htmlspecialchars($sinhVien->HoTen, ENT_QUOTES, 'UTF-8'); ?></h2>
    
    <?php if (!empty($sinhVien->Hinh)): ?>
    <img src="<?php echo htmlspecialchars('/KT_PHP/app' . $sinhVien->Hinh, ENT_QUOTES, 'UTF-8'); ?>"
         alt="Hình ảnh sinh viên"
         style="width: 100px; height: 100px; object-fit: cover;">
    <?php else: ?>
        <p><em>Không có hình ảnh</em></p>
    <?php endif; ?>

    <p><strong>Mã sinh viên:</strong> <?php echo htmlspecialchars($sinhVien->MaSV, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Giới tính:</strong> <?php echo htmlspecialchars($sinhVien->GioiTinh, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Ngày sinh:</strong> <?php echo htmlspecialchars($sinhVien->NgaySinh, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Ngành học:</strong> <?php echo htmlspecialchars($nganhHoc->TenNganh ?? 'Không xác định', ENT_QUOTES, 'UTF-8'); ?></p>
</div>

<a href="/KT_PHP/index.php?action=index" class="btn btn-secondary mt-2">Quay lại danh sách sinh viên</a>

<?php include __DIR__ . '/../shares/footer.php'; ?>
