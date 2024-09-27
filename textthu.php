<?php
require_once 'D:\Study\TLU\Năm ba_Kì 5\Công nghệ web\TH2\Demo_MVC_Simple\CSE485_2023_BTTH02\services\AdminService.php';

$categoryService = new CategoryService();
$categories = $categoryService->getAllCategories();

echo"<pre>";
print_r($categories);
echo "</pre>";

// <!-- Routing là gì? Định tuyến/Điều hướng -->
// <!-- Phân tích xem: URL của người dùng > Muốn gì -->
// <!-- Ví dụ: Trang chủ, Quản lý bài viết hay Thêm bài viết -->
// <!-- Chuyển quyền cho Controller tương ứng điều khiển tiếp -->
// <!-- URL của tôi thiết kế luôn có dạng: -->

// <!-- http://localhost/btth02v2/index.php?controller=A&action=B -->
// <!-- http://localhost/btth02v2/index.php -->
// <!-- http://localhost/btth02v2/index.php?controller=home&action=index -->

// <!-- Controller là tên của FILE controller mà chúng ta sẽ gọi -->
// <!-- Action là tên cả HÀM trong FILE controller mà chúng ta gọi -->

// model trước sau đó đến service rồi controller rồi view