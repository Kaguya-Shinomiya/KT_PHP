<?php
    require_once(__DIR__ . '/../config/database.php');
    require_once(__DIR__ . '/../models/HocPhanModel.php');

    class HocPhanController
    {
        private $hocPhanModel;
        private $db;

        public function __construct()
        {
            $this->db = (new Database())->getConnection();
            $this->hocPhanModel = new HocPhanModel($this->db);
        }

        // Hiển thị danh sách học phần
        public function index()
        {
            $hocPhans = $this->hocPhanModel->getAllHocPhan();
            include __DIR__ . '/../views/hocphan/list.php';
        }

        // Hiển thị thông tin chi tiết của một học phần
        public function show($MaHP)
        {
            $hocPhan = $this->hocPhanModel->getHocPhanById($MaHP);
            if ($hocPhan) {
                include __DIR__ . '/../views/hocphan/show.php';
            } else {
                echo "Không tìm thấy học phần.";
            }
        }

        // Form thêm học phần
        public function add()
        {
            include_once __DIR__ . '/../views/hocphan/add.php';
        }

        // Lưu thông tin học phần mới
        public function save()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MaHP = $_POST['MaHP'] ?? '';
                $TenHP = $_POST['TenHP'] ?? '';
                $SoTinChi = $_POST['SoTinChi'] ?? 0;

                // Gọi model để thêm dữ liệu học phần
                $result = $this->hocPhanModel->addHocPhan($MaHP, $TenHP, $SoTinChi);

                if (is_array($result)) {
                    $errors = $result;
                    include __DIR__ . '/../views/hocphan/add.php';
                } else {
                    header('Location: /KT_PHP/index.php?action=index');
                }
            }
        }

        // Form chỉnh sửa học phần
        public function edit($MaHP)
        {
            $hocPhan = $this->hocPhanModel->getHocPhanById($MaHP);
            if ($hocPhan) {
                include __DIR__ . '/../views/hocphan/edit.php';
            } else {
                echo "Không tìm thấy học phần.";
            }
        }

        // Cập nhật thông tin học phần
        public function update()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MaHP = $_POST['MaHP'];
                $TenHP = $_POST['TenHP'];
                $SoTinChi = $_POST['SoTinChi'];

                // Gọi model để cập nhật dữ liệu học phần
                $edit = $this->hocPhanModel->updateHocPhan($MaHP, $TenHP, $SoTinChi);

                if ($edit) {
                    header('Location: /KT_PHP/index.php?action=index');
                } else {
                    echo "Đã xảy ra lỗi khi cập nhật học phần.";
                }
            }
        }

        // Xóa học phần theo MaHP
        public function delete($MaHP)
        {
            if ($this->hocPhanModel->deleteHocPhan($MaHP)) {
                header('Location: /KT_PHP/index.php?action=index');
            } else {
                echo "Đã xảy ra lỗi khi xóa học phần.";
            }
        }
    }
?>
