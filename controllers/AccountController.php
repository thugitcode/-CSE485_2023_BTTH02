<?php
include('services/UserService.php');

class AccountController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService(); // Khởi tạo UserService
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Gọi UserService để kiểm tra đăng nhập
            $user = $this->userService->login($username, $password);

            if ($user) {
                // Khởi tạo session cho người dùng đã đăng nhập
                session_start();
                $_SESSION['user'] = $user;  // Lưu thông tin người dùng vào session

                // Xử lý đăng nhập thành công
                if ($user['role'] === 'user') {
                    header('Location: /views/home/index.php');  // Trang của user
                    exit; // Đảm bảo không còn mã nào chạy sau khi chuyển hướng
                } elseif ($user['role'] === 'admin') {
                    header('Location: /views/admin/index.php');  // Trang của admin
                    exit; // Đảm bảo không còn mã nào chạy sau khi chuyển hướng
                }
            } else {
                $error = "Thông tin đăng nhập không chính xác. Vui lòng thử lại.";
            }
        }

        // Gọi view để hiển thị form đăng nhập và truyền thông báo lỗi
        include 'views/admin/login.php';
    }
}
