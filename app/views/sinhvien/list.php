<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="mt-4">TRANG SINH VIÊN</h1>
<a href="/KT_PHP/index.php?action=add" class="btn btn-primary mb-3">Thêm Sinh Viên</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình</th>
            <th>Mã Ngành</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sinhViens as $sv): ?>
            <tr>
                <td><?php echo htmlspecialchars($sv->MaSV, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($sv->HoTen, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($sv->GioiTinh, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo date("d/m/Y", strtotime($sv->NgaySinh)); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars('/KT_PHP/app' . $sv->Hinh, ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Hình ảnh sinh viên" style="width: 100px; height: 100px; object-fit: cover;">


                </td>

                <td><?php echo htmlspecialchars($sv->MaNganh, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="/KT_PHP/index.php?action=edit&id=<?php echo $sv->MaSV; ?>" class="btn btn-warning">Sửa</a>
                    <a href="/KT_PHP/index.php?action=show&id=<?php echo $sv->MaSV; ?>" class="btn btn-info">Chi tiết</a>
                    <a href="/KT_PHP/index.php?action=delete&id=<?php echo $sv->MaSV; ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../shares/footer.php'; ?>
