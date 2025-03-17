<?php
    class NganhHocModel
    {
        private $conn;
        private $table_name = "NganhHoc";

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAllNganhHoc()
        {
            $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getNganhHocById($maNganh)
        {
            $query = "SELECT MaNganh, TenNganh FROM " . $this->table_name . " WHERE MaNganh = :maNganh";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':maNganh', $maNganh);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function addNganhHoc($maNganh, $tenNganh)
        {
            $errors = [];
            if (empty($maNganh)) {
                $errors['maNganh'] = 'Mã ngành không được để trống';
            }
            if (empty($tenNganh)) {
                $errors['tenNganh'] = 'Tên ngành không được để trống';
            }
            if (count($errors) > 0) {
                return $errors;
            }

            $query = "INSERT INTO " . $this->table_name . " (MaNganh, TenNganh) VALUES (:maNganh, :tenNganh)";
            $stmt = $this->conn->prepare($query);

            $maNganh = htmlspecialchars(strip_tags($maNganh));
            $tenNganh = htmlspecialchars(strip_tags($tenNganh));

            $stmt->bindParam(':maNganh', $maNganh);
            $stmt->bindParam(':tenNganh', $tenNganh);

            return $stmt->execute();
        }

        public function updateNganhHoc($maNganh, $tenNganh)
        {
            $query = "UPDATE " . $this->table_name . " SET TenNganh = :tenNganh WHERE MaNganh = :maNganh";
            $stmt = $this->conn->prepare($query);

            $tenNganh = htmlspecialchars(strip_tags($tenNganh));

            $stmt->bindParam(':maNganh', $maNganh);
            $stmt->bindParam(':tenNganh', $tenNganh);

            return $stmt->execute();
        }

        public function deleteNganhHoc($maNganh)
        {
            $query = "UPDATE " . $this->table_name . " 
                            SET isDelete=true
                            WHERE MaNganh=:maNganh";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':maNganh', $maNganh);
            
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }

    // require_once(__DIR__ . '/../config/database.php');
    // $db = (new Database())->getConnection();
    // $nganhHoc = new NganhhocModel($db);
    // echo json_encode($nganhHoc->getAllNganhHoc());
?>
