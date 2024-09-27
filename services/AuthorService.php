<?php 
include("configs/DBConnection.php");
include("models/AuthorModel.php");

class AuthorService {
    private static $conn = null;

    private static function getConnection() {
        if (self::$conn === null) {
            $dbConn = new DBConnection();
            self::$conn = $dbConn->getConnection();
        }
        return self::$conn;
    }

    public function getAllAuthors() {
        // 4 bước thực hiện
        $conn = self::getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM tacgia ORDER BY ma_tgia DESC";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $authors = [];
        while ($row = $stmt->fetch()) {
            $author = new Author($row['ma_tgia'], $row['ten_tgia']);
            $authors[] = $author;
        }
        // Mảng (danh sách) các đối tượng Author Model

        return $authors;
    }

    public function isAuthorExist($ten_tgia) {
        $conn = self::getConnection();

        $query = "SELECT COUNT(*) as count FROM tacgia WHERE ten_tgia = :ten_tgia";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':ten_tgia', $ten_tgia);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    public function addAuthor($ten_tgia) {
        $conn = self::getConnection();

        $sql = "INSERT INTO tacgia(ten_tgia) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ten_tgia]);

        return $conn->lastInsertId();
    }

    // Lấy thông tin tác giả theo mã
    public function getAuthorById($ma_tgia) {
        $conn = self::getConnection();
    
        $sql = "SELECT * FROM tacgia WHERE ma_tgia = :ma_tgia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $ma_tgia);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new Author($result['ma_tgia'], $result['ten_tgia']); // Trả về đối tượng Author
        }
        
        return null; // Trả về null nếu không tìm thấy
    }

    public function updateAuthor($ma_tgia, $ten_tgia) {
        $conn = self::getConnection();

        $stmt = $conn->prepare("UPDATE tacgia SET ten_tgia = ? WHERE ma_tgia = ?");
        $stmt->execute([$ten_tgia, $ma_tgia]);
    }

    public function deleteAuthor($ma_tgia) {
        $conn = self::getConnection();

        $stmt = $conn->prepare("DELETE FROM tacgia WHERE ma_tgia = ?");
        $stmt->execute([$ma_tgia]);
    }
}
?>
