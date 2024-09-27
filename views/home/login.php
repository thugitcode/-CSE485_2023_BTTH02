<?php
require_once './configs/DBConnection.php'; 

$db = new DBConnection();
$conn = $db->getConnection(); // Lấy kết nối từ lớp DBConnection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Kiểm tra xem username và password có được nhập hay không
    if (empty($username) || empty($password)) {
        echo "Vui lòng nhập tên đăng nhập và mật khẩu.";
    } else {
        // Giả sử bạn có bảng 'users' trong DB với cột 'username' và 'passwordHash'
        $sql = "SELECT * FROM Users WHERE Username = :username"; // Chỉ lấy username
        $stmt = $conn->prepare($sql);
        
        // Ràng buộc tham số
        $stmt->bindParam(':username', $username);
        
        // Thực thi câu lệnh
        $stmt->execute();
        
        // Lấy kết quả
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy một bản ghi

        if ($user && password_verify($password, $user['PasswordHash'])) { // Kiểm tra mật khẩu
            // Đăng nhập thành công
            echo "Đăng nhập thành công!";
            // Bạn có thể chuyển hướng hoặc thực hiện các thao tác khác
        } else {
            echo "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }

    // Kết thúc kết nối
    $conn = null;
}
?>





<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style_login.css">
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="./assets/images/logo2.png" alt="" class="img-fluid">
                    </a>
                </div>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="index.php?controller=login">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Nội dung cần tìm" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header text-center ">
                        <h3>Sign In</h3>
                        
                    </div>
                    <div class="card-body">
                    <form method="POST" action="login.php">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="username" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="password" required>
                            </div>
                            
                            <div class="row align-items-center remember">
                                <input type="checkbox" name="remember"> Remember Me
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login" class="btn float-end login_btn">
                            </div>
                        </form>

                    </form>
                    <div class="d-flex justify-content-center social_icon">
                            <span><i class="fa-brands fa-square-facebook"></i></span>
                            <span><i class="fab fa-google-plus-square"></i></span>
<span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center ">
                        Don't have an account? &nbsp <a href="#" class="text-decoration-none">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>