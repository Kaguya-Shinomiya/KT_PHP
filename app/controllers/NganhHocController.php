<?php
    // Import các file cần thiết
    require_once(__DIR__ . '/../config/database.php');
    require_once(__DIR__ . '/../models/NganhHocModel.php');

    class NganhHocController
    {
        private $nganhHocModel;
        private $db;

        public function __construct()
        {
            $this->db = (new Database())->getConnection();
            $this->nganhHocModel = new NganhHocModel($this->db);
        }

        public function list()
        {
            $nganhHocs = $this->nganhHocModel->getAllNganhHoc();
            include __DIR__ . '/../views/nganhhoc/list.php';
        }

        public function add()
        {
            include_once __DIR__ . '/../views/nganhhoc/add.php';
        }

        public function edit($maNganh)
        {
            $nganhHoc = $this->nganhHocModel->getNganhHocById($maNganh);

            if ($nganhHoc) {
                include __DIR__ . '/../views/nganhhoc/edit.php';
            } else {
                echo "Không tìm thấy ngành học.";
            }
        }

        public function update()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $maNganh = $_POST['maNganh'] ?? '';
                $tenNganh = $_POST['tenNganh'] ?? '';

                $update = $this->nganhHocModel->updateNganhHoc($maNganh, $tenNganh);

                if ($update) {
                    header('Location: /KT_PHP/index.php?action=show_nganhhoc');
                } else {
                    echo "Đã xảy ra lỗi khi cập nhật ngành học.";
                }
            }
        }

        public function save()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $maNganh = $_POST['maNganh'] ?? '';
                $tenNganh = $_POST['tenNganh'] ?? '';

                $result = $this->nganhHocModel->addNganhHoc($maNganh, $tenNganh);

                if (is_array($result)) {
                    include __DIR__ . '/../views/nganhhoc/add.php';
                } else {
                    header('Location: /KT_PHP/index.php?action=show_nganhhoc');
                }
            }
        }

        public function delete($maNganh)
        {
            if ($this->nganhHocModel->deleteNganhHoc($maNganh)) {
                header('Location: /KT_PHP/index.php?action=show_nganhhoc');
            } else {
                echo "Đã xảy ra lỗi khi xóa ngành học.";
            }
        }
    }
?>
