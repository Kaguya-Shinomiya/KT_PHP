<?php include 'app/views/shares/header.php'; ?>

<h1>Thêm thông tin sinh viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/KT_PHP/index.php?action=save" enctype="multipart/form-data">
    <div class="form-group">
        <label for="MaSV">Mã số Sinh Viên:</label>
        <input type="text" id="MaSV" name="MaSV" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Giới Tính:</label><br>
        <input type="radio" id="Nam" name="GioiTinh" value="Nam" checked>
        <label for="Nam">Nam</label>
        
        <input type="radio" id="Nu" name="GioiTinh" value="Nữ">
        <label for="Nu">Nữ</label>
    </div>

    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="Hinh">Hình ảnh:</label>
        <input type="file" id="Hinh" name="Hinh" class="form-control">
    </div>

    <div class="form-group">
        <label for="MaNganh">Mã Ngành:</label>
        <select id="MaNganh" name="MaNganh" class="form-control" required>
            <?php foreach ($nganhs as $nganh): ?>
                <option value="<?php echo $nganh->MaNganh; ?>">
                    <?php echo htmlspecialchars($nganh->MaNganh, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
</form>

<a href="/KT_PHP/index.php?action=index" class="btn btn-secondary mt-2">Quay lại danh sách sinh viên</a>

<?php include 'app/views/shares/footer.php'; ?>