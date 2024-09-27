<?php
    include_once("services/ArticleService.php");

    class ArticleController{

    public function add(){
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý dữ liệu form từ POST và gọi service thêm bài viết
            $tieude = $_POST['txt_tieude']; // Check if key exists, then get value
            $ten_bhat = $_POST['txt_ten_bhat'];
            $ten_tloai = $_POST['txt_ten_tloai'];
            $tomtat = $_POST['txt_tomtat'];
            $ten_tgia = $_POST['txt_ten_tgia'];
            $ngayviet = $_POST['txt_ngayviet'];

            // Gọi service thêm bài viết (giả sử có ArticleService)
            $articleService = new ArticleService();
            if ($articleService->isArticleExist($tieude, $ten_bhat, $ten_tloai, $tomtat, $ten_tgia, $ngayviet)) {
                $error = 'Bai viet đã tồn tại.';
            } else {
                $article = $articleService->addArticle($tieude, $ten_bhat, $ten_tloai, $tomtat, $ten_tgia, $ngayviet);

                header('Location: http://localhost:3000/index.php?controller=Article&action=index'); // Chuyển hướng về danh sách thể loại
                exit();
            }
        } 
            // Hiển thị form thêm bài viết
            include("views/article/add_article.php");
        }

    public function index(){
        // Tạo đối tượng của ArticleService
        $articleService = new ArticleService();

        // Gọi hàm lấy danh sách tất cả các bài viết
        $articles = $articleService->getAllArticles();

        // Kiểm tra xem có bài viết nào được trả về hay không
        if ($articles === null || empty($articles)) {
            // Nếu không có bài viết nào, thông báo lỗi hoặc thiết lập biến rỗng
            $articles = [];
            $message = "Không có bài viết nào.";
        } else {
            $message = ""; // Không có lỗi
        }

        // Gửi danh sách bài viết và thông báo đến view để hiển thị
        include("views/article/index.php");
    }
    public function edit($ma_bviet) {
        if(isset($_GET['txt_ma_bviet']))
        $articleService = new ArticleService();
        $article = $articleService->getArticleById($ma_bviet);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý dữ liệu form từ POST và gọi service cập nhật bài viết
            $tieude = $_POST['txt_tieude']; // Check if key exists, then get value
            $ten_bhat = $_POST['txt_ten_bhat'];
            $ten_tloai = $_POST['txt_ten_tloai'];
            $tomtat = $_POST['txt_tomtat'];
            $noidung = $_POST['txt_noidung'];
            $ten_tgia = $_POST['txt_ten_tgia'];
            $ngayviet = $_POST['txt_ngayviet'];


            // Cập nhật bài viết
            $articleService->updateArticle($tieude, $ten_bhat, $ten_tloai, $tomtat, $noidung, $ten_tgia, $ngayviet);

            // Chuyển hướng về trang danh sách
            header("Location: index.php?controller=article&action=list");
        } else {
            // Lấy thông tin bài viết theo ID để hiển thị
            $article = $articleService->getArticleById($ma_bviet);

            // Hiển thị form chỉnh sửa bài viết
            include("views/article/edit_article.php");
        }
    }

    public function update(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleService = new ArticleService();
            // Xử lý dữ liệu form từ POST và gọi service cập nhật bài viết
            $articleService->updateArticle($_POST['txt_tieude'],
                                            $_POST['txt_ten_bhat'],
                                            $_POST['txt_ten_tloai'],
                                            $_POST['txt_tomtat'],
                                            $_POST['txt_noidung'],
                                            $_POST['txt_ten_tgia'],
                                            $_POST['txt_ngayviet']);
            header('Location: http://localhost:3000/index.php?controller=Article&action=index'); // Chuyển hướng về trang index sau khi cập nhật thành công
            exit();
        } else {
            include("views/article/update_article.php");
        }
    }

    // Hàm xóa bài viết
    public function delete($ma_bviet) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleService = new ArticleService();
            // Xử lý dữ liệu form từ POST và gọi service cập nhật bài viết
            $articleService->deleteArticle($_POST['txt_ma_bviet']);
                                            
            header('Location: http://localhost:3000/index.php?controller=Article&action=index'); // Chuyển hướng về trang index sau khi cập nhật thành công
            exit();
        } else {
            include("views/article/list_article.php");
        }
    }
}
?>