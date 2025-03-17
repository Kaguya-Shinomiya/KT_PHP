<?php
    class HocPhanModel
    {
        private $conn;
        private $table_name = "HocPhan";

        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Lấy tất cả học phần
        public function getAllHocPhan()
        {
            $query = "SELECT MaHP, TenHP, SoTinChi FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Lấy học phần theo ID
        public function getHocPhanById($maHP)
        {
            $query = "SELECT MaHP, TenHP, SoTinChi FROM " . $this->table_name . " WHERE MaHP = :maHP";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':maHP', $maHP);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        // Thêm học phần mới
        public function addHocPhan($maHP, $tenHP, $soTinChi)
        {
            $errors = [];
            if (empty($maHP)) {
                $errors['maHP'] = 'Mã học phần không được để trống';
            }
            if (empty($tenHP)) {
                $errors['tenHP'] = 'Tên học phần không được để trống';
            }
            if (!is_numeric($soTinChi) || $soTinChi < 0) {
                $errors['soTinChi'] = 'Số tín chỉ phải là số nguyên dương';
            }
            if (count($errors) > 0) {
                return $errors;
            }

            $query = "INSERT INTO " . $this->table_name . " (MaHP, TenHP, SoTinChi) VALUES (:maHP, :tenHP, :soTinChi)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':maHP', $maHP);
            $stmt->bindParam(':tenHP', $tenHP);
            $stmt->bindParam(':soTinChi', $soTinChi, PDO::PARAM_INT);

            return $stmt->execute();
        }

        // Cập nhật thông tin học phần
        public function updateHocPhan($maHP, $tenHP, $soTinChi)
        {
            $query = "UPDATE " . $this->table_name . " SET TenHP = :tenHP, SoTinChi = :soTinChi WHERE MaHP = :maHP";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':maHP', $maHP);
            $stmt->bindParam(':tenHP', $tenHP);
            $stmt->bindParam(':soTinChi', $soTinChi, PDO::PARAM_INT);

            return $stmt->execute();
        }

        // Xóa học phần theo MaHP
        public function deleteHocPhan($maHP)
        {
            $query = "DELETE FROM " . $this->table_name . " WHERE MaHP = :maHP";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':maHP', $maHP);

            return $stmt->execute();
        }
    }
?>
