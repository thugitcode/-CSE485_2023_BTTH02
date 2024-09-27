<?php
include("configs/DBConnection.php");
include("models/ArticleModel.php");
class ArticleService{
    private $conn = null;

    public function getConnection() {
        if (self::$conn == null){
        // Thiết lập kết nối cơ sở dữ liệu
        $dbConn = new DBConnection();
        self::$conn = $dbConn->getConnection();
        }
        return self::$conn;
    }

    public function getAllArticles(){
        // B2. Truy vấn
        $conn = self::getConnection();
        $sql = "SELECT ma_bviet, tieude, ten_bhat, theloai.ten_tloai, tomtat, tacgia.ten_tgia, ngayviet
                FROM baiviet
                JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
                JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
                ORDER BY ma_bviet DESC";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $articles = [];
        while ($row = $stmt->fetch()) {
            $article = new Article (
                $row['ma_bviet'],
                $row['tieude'],
                $row['ten_bhat'],
                $row['ten_tloai'],
                $row['tomtat'],
                $row['ten_tgia'],
                $row['ngayviet']
            );
            $articles[] = $article;
        }
        return $articles;
    }
    public function isArticleExist($tieude) {
        $conn = self::getConnection();

        $query = "SELECT COUNT(*) as count 
                  FROM baiviet 
                  WHERE tieude = :tieude";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tieude', $tieude);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    // Hàm thêm bài viết
    public function addArticle($tieude, $ten_bhat, $ma_tloai, $tomtat, $ma_tgia, $ngayviet) {
        $conn = self::getConnection();
    
        $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$tieude, $ten_bhat, $ma_tloai, $tomtat, $ma_tgia, $ngayviet]);
    }

    // Hàm cập nhật bài viết
    public function updateArticle($ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat,  $ma_tgia, $ngayviet) {
        $sql = "UPDATE baiviet 
                SET ma_bviet = '$ma_bviet', tieude = '$tieude', ten_bhat = '$ten_bhat', ma_tloai = '$ma_tloai', tomtat = '$tomtat', ma_tgia = '$ma_tgia', ngayviet = '$ngayviet'
                WHERE ma_bviet = $ma_bviet;";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tieude, $ten_bhat, $ma_tloai, $tomtat, $ma_tgia, $ngayviet, $ma_bviet]);
    }
    public function getArticleById($ma_bviet) {
        $conn = self::getConnection();
    
        $sql = "SELECT ma_bviet, tieude, ten_bhat, theloai.ten_tloai, tomtat, tacgia.ten_tgia, ngayviet
                FROM baiviet
                JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
                JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
                WHERE ma_bviet = :ma_bviet";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_bviet', $ma_bviet);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new Article($result['ma_bviet'], $result['tieude'], $result['ten_bhat'], $result['ten_tloai'], $result['tomtat'], $result['ten_tgia'], $result['ngayviet']); 
        }
        
        return null; // Trả về null nếu không tìm thấy
    }
    
    // Hàm xóa bài viết
    public function deleteArticle($ma_bviet) {
        $conn = self::getConnection();

        $sql = "DELETE FROM baiviet WHERE ma_bviet = $ma_bviet";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute([$ma_bviet]);
    }
    
    public function getAllCategories() {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM theloai");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAuthors() {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM tacgia");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>