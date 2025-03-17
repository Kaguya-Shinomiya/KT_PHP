<?php include __DIR__ . '/../shares/header.php'; ?>

<h1 class="mt-4">TRANG HỌC PHẦN</h1>
<a href="/KT_PHP/index.php?action=add" class="btn btn-primary mb-3">Thêm Học Phần</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($hocPhans as $hp): ?>
            <tr>
                <td><?php echo htmlspecialchars($hp->MaHP, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($hp->TenHP, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($hp->SoTinChi, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="/KT_PHP/index.php?action=edit&id=<?php echo $hp->MaHP; ?>" class="btn btn-warning">Sửa</a>
                    <a href="/KT_PHP/index.php?action=show&id=<?php echo $hp->MaHP; ?>" class="btn btn-info">Chi tiết</a>
                    <a href="/KT_PHP/index.php?action=delete&id=<?php echo $hp->MaHP; ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa học phần này?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../shares/footer.php'; ?>
