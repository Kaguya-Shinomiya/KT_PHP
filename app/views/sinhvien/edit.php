<?php include 'app/views/shares/header.php'; ?>

<h1>Sửa thông tin sinh viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/KT_PHP/index.php?action=update" enctype="multipart/form-data">
    <input type="hidden" name="MaSV" value="<?php echo htmlspecialchars($sv->MaSV, ENT_QUOTES, 'UTF-8'); ?>">

    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" class="form-control" 
               value="<?php echo htmlspecialchars($sv->HoTen, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label>Giới Tính:</label><br>
        <input type="radio" id="Nam" name="GioiTinh" value="Nam" 
            <?php echo ($sv->GioiTinh == 'Nam') ? 'checked' : ''; ?>>
        <label for="Nam">Nam</label>

        <input type="radio" id="Nu" name="GioiTinh" value="Nữ" 
            <?php echo ($sv->GioiTinh == 'Nữ') ? 'checked' : ''; ?>>
        <label for="Nu">Nữ</label>
    </div>

    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" 
               value="<?php echo htmlspecialchars($sv->NgaySinh, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="Hinh">Hình ảnh:</label>
        <input type="file" id="Hinh" name="Hinh" class="form-control">
        <?php if (!empty($sv->Hinh)): ?>
            <img src="<?php echo htmlspecialchars('/KT_PHP/app' . $sv->Hinh, ENT_QUOTES, 'UTF-8'); ?>" 
                 alt="Hình sinh viên" style="width: 100px; height: 100px; object-fit: cover;">
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="MaNganh">Mã Ngành:</label>
        <select id="MaNganh" name="MaNganh" class="form-control" required>
            <?php foreach ($nganhs as $nganh): ?>
                <option value="<?php echo $nganh->MaNganh; ?>" 
                    <?php echo ($nganh->MaNganh == $sv->MaNganh) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($nganh->MaNganh, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>

<a href="/KT_PHP/index.php?action=index" class="btn btn-secondary mt-2">Quay lại danh sách sinh viên</a>

<?php include 'app/views/shares/footer.php'; ?>
