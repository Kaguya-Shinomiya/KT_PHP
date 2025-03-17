<?php
    class SinhVienModel
    {
        private $conn;
        private $table_name = "SinhVien";

        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Lấy danh sách tất cả sinh viên
        public function getAllSinhVien()
        {
            $query = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh, nh.MaNganh
                      FROM " . $this->table_name . " sv
                      LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh
                      WHERE sv.isDelete = false";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Lấy thông tin sinh viên theo MaSV
        public function getSinhVienById($MaSV)
        {
            $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaSV', $MaSV);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        // Thêm sinh viên mới
        public function addSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)
        {
            $errors = [];
            if (empty($MaSV)) {
                $errors['MaSV'] = 'Mã sinh viên không được để trống';
            }
            if (empty($HoTen)) {
                $errors['HoTen'] = 'Họ tên không được để trống';
            }
            if (empty($NgaySinh)) {
                $errors['NgaySinh'] = 'Ngày sinh không được để trống';
            }
            if (empty($MaNganh)) {
                $errors['MaNganh'] = 'Mã ngành không được để trống';
            }
            if (count($errors) > 0) {
                return $errors;
            }

            $query = "INSERT INTO " . $this->table_name . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                      VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':MaSV', $MaSV);
            $stmt->bindParam(':HoTen', $HoTen);
            $stmt->bindParam(':GioiTinh', $GioiTinh);
            $stmt->bindParam(':NgaySinh', $NgaySinh);
            $stmt->bindParam(':Hinh', $Hinh);
            $stmt->bindParam(':MaNganh', $MaNganh);

            return $stmt->execute();
        }

        // Cập nhật thông tin sinh viên
        public function updateSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)
        {
            $query = "UPDATE " . $this->table_name . " 
                      SET HoTen=:HoTen, GioiTinh=:GioiTinh, NgaySinh=:NgaySinh, Hinh=:Hinh, MaNganh=:MaNganh 
                      WHERE MaSV=:MaSV";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':MaSV', $MaSV);
            $stmt->bindParam(':HoTen', $HoTen);
            $stmt->bindParam(':GioiTinh', $GioiTinh);
            $stmt->bindParam(':NgaySinh', $NgaySinh);
            $stmt->bindParam(':Hinh', $Hinh);
            $stmt->bindParam(':MaNganh', $MaNganh);

            return $stmt->execute();
        }

        // Xóa sinh viên theo MaSV
        public function deleteSinhVien($MaSV)
        {
            $query = "UPDATE " . $this->table_name . " 
                            SET isDelete=true
                            WHERE MaSV=:MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaSV', $MaSV);
            
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }
?>
