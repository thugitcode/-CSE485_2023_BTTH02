<?php
include("configs\DBConnection.php");
include("models\UserModel.php");

class UserService {
    private $userModel;

    public function __construct() {
        $this->userModel = new User(); // Khởi tạo Model User
    }

    public function login($username, $password) {
        $user = $this->userModel->getUser($username);
    
        if ($user && $user['password'] === $password) {
            return $user; // Trả về thông tin người dùng nếu đúng
        }
    
        return null; // Trả về null nếu không tìm thấy người dùng hoặc sai mật khẩu
    }
    
}
?>
