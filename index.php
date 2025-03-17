<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once 'app/controllers/SinhVienController.php';
    require_once 'app/controllers/NganhHocController.php';
    require_once 'app/controllers/HocPhanController.php';

    // Kết nối CSDL
    $controller_SV = new SinhVienController();
    $controller_NH = new NganhHocController();
    $controller_hp = new HocPhanController();


    // Xử lý request
    $action = $_GET['action'] ?? 'index';
    $id = $_GET['id'] ?? null;

    if ($action === 'add') {
        $controller_SV->add();
    } elseif ($action === 'edit' && $id) {
        $controller_SV->edit($id);
    } elseif ($action === 'update') {
        $controller_SV->update();
    }elseif ($action === 'save') {
        $controller_SV->save();
    } elseif ($action === 'delete' && $id) {
        $controller_SV->delete($id);
    }else if($action === 'show' && $id) {
        $controller_SV->show($id);
    }else if($action === 'login') {
        $controller_SV->login();
    }else if($action === 'kiemtra' && $id) {
        $controller_SV->kiemtra($id);
    }
    
    elseif ($action === 'add_hp') {
        $controller_hp->add();
    } elseif ($action === 'edit_hp' && $id) {
        $controller_hp->edit($id);
    } elseif ($action === 'update_hp') {
        $controller_hp->update();
    }elseif ($action === 'save_hp') {
        $controller_hp->save();
    } elseif ($action === 'delete_hp' && $id) {
        $controller_hp->delete($id);
    } elseif ($action === 'show_hp') {
        $controller_hp->index();
    }
    
    
    else {
        $controller_SV->index();
    }
?>
