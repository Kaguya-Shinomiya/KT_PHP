<?php
    require_once(__DIR__ . '/../config/database.php');
    require_once(__DIR__ . '/../models/SinhVienModel.php');
    require_once(__DIR__ . '/../models/NganhHocModel.php');

    class SinhVienController
    {
        private $sinhVienModel;
        private $db;

        public function __construct()
        {
            $this->db = (new Database())->getConnection();
            $this->sinhVienModel = new SinhVienModel($this->db);
        }

        // Hiển thị danh sách sinh viên
        public function index()
        {
            $sinhViens = $this->sinhVienModel->getAllSinhVien();
            include __DIR__ . '/../views/sinhvien/list.php';
        }

        // Hiển thị thông tin chi tiết của một sinh viên
        public function show($MaSV)
        {
            $sinhVien = $this->sinhVienModel->getSinhVienById($MaSV);
            $nganhHoc = (new NganhHocModel($this->db))->getNganhHocById($sinhVien->MaNganh);
            if ($sinhVien) {
                include __DIR__ . '/../views/sinhvien/show.php';
            } else {
                echo "Không tìm thấy sinh viên.";
            }
        }

        // Form thêm sinh viên
        public function add()
        {
            $nganhs = (new NganhHocModel($this->db))->getAllNganhHoc();
            include_once __DIR__ . '/../views/sinhvien/add.php';
        }

        // Lưu thông tin sinh viên mới
        public function save()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MaSV = $_POST['MaSV'] ?? '';
                $HoTen = $_POST['HoTen'] ?? '';
                $GioiTinh = $_POST['GioiTinh'] ?? '';
                $NgaySinh = $_POST['NgaySinh'] ?? '';
                $MaNganh = $_POST['MaNganh'] ?? '';
                $Hinh = ''; // Mặc định không có hình

                // Kiểm tra nếu có upload hình mới
                if (!empty($_FILES['Hinh']['name'])) {
                    $targetDir = __DIR__ . "/../../app/Content/images/"; // Đường dẫn tuyệt đối

                    // Tạo thư mục nếu chưa tồn tại
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    // Đổi tên file để tránh trùng lặp
                    $fileType = strtolower(pathinfo($_FILES["Hinh"]["name"], PATHINFO_EXTENSION));
                    $fileName = uniqid() . "." . $fileType;
                    $targetFilePath = $targetDir . $fileName;

                    // Kiểm tra định dạng ảnh hợp lệ
                    $allowedTypes = array("jpg", "jpeg", "png", "gif");
                    if (in_array($fileType, $allowedTypes)) {
                        // Upload file
                        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                            $Hinh = "/Content/images/" . $fileName; // Lưu đường dẫn tương đối vào database
                        } else {
                            echo "Lỗi khi tải ảnh lên!";
                            return;
                        }
                    } else {
                        echo "Chỉ chấp nhận file JPG, JPEG, PNG, GIF!";
                        return;
                    }
                }

                // Gọi model để thêm dữ liệu sinh viên
                $result = $this->sinhVienModel->addSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);

                if (is_array($result)) {
                    $errors = $result;
                    include __DIR__ . '/../views/sinhvien/add.php';
                } else {
                    header('Location: /KT_PHP/index.php?action=index');
                }
            }
        }


        // Form chỉnh sửa sinh viên
        public function edit($MaSV)
        {
            $sv = $this->sinhVienModel->getSinhVienById($MaSV);
            $nganhs = (new NganhHocModel($this->db))->getAllNganhHoc();
            if ($sv) {
                include __DIR__ . '/../views/sinhvien/edit.php';
            } else {
                echo "Không tìm thấy sinh viên.";
            }
        }

        // Cập nhật thông tin sinh viên
        public function update()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MaSV = $_POST['MaSV'];
                $HoTen = $_POST['HoTen'];
                $GioiTinh = $_POST['GioiTinh'];
                $NgaySinh = $_POST['NgaySinh'];
                $MaNganh = $_POST['MaNganh'];

                // Lấy thông tin hình cũ từ database
                $sv = $this->sinhVienModel->getSinhVienById($MaSV);
                $Hinh = $sv->Hinh; // Giữ nguyên hình cũ nếu không có ảnh mới

                // Kiểm tra nếu có upload hình mới
                if (!empty($_FILES['Hinh']['name'])) {
                    $targetDir = __DIR__ . "/../../app/Content/images/"; // Đường dẫn tuyệt đối

                    // Tạo thư mục nếu chưa tồn tại
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    // Đổi tên file để tránh trùng
                    $fileType = strtolower(pathinfo($_FILES["Hinh"]["name"], PATHINFO_EXTENSION));
                    $fileName = uniqid() . "." . $fileType;
                    $targetFilePath = $targetDir . $fileName;

                    // Kiểm tra định dạng ảnh hợp lệ
                    $allowedTypes = array("jpg", "jpeg", "png", "gif");
                    if (in_array($fileType, $allowedTypes)) {
                        // Upload file
                        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
                            $Hinh = "/Content/images/" . $fileName; // Lưu đường dẫn tương đối vào database
                        } else {
                            echo "Lỗi khi tải ảnh lên!";
                            return;
                        }
                    } else {
                        echo "Chỉ chấp nhận file JPG, JPEG, PNG, GIF!";
                        return;
                    }
                }

                // Gọi model để cập nhật dữ liệu sinh viên
                $edit = $this->sinhVienModel->updateSinhVien($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);

                if ($edit) {
                    header('Location: /KT_PHP/index.php?action=index');
                } else {
                    echo "Đã xảy ra lỗi khi cập nhật thông tin sinh viên.";
                }
            }
        }

        

        // Xóa sinh viên theo MaSV
        public function delete($MaSV)
        {
            if ($this->sinhVienModel->deleteSinhVien($MaSV)) {
                header('Location: /KT_PHP/index.php?action=index');
            } else {
                echo "Đã xảy ra lỗi khi xóa sinh viên.";
            }
        }
    }
?>
