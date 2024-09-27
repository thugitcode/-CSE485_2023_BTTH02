<?php
class AdminModel {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function getUserCount() {
        // Thực hiện truy vấn SQL để lấy số lượng người dùng
        $query = "SELECT COUNT(*) FROM users";
        $result = $this->dbConnection->query($query);
        return $result->fetchColumn();
    }

    public function getCategoryCount() {
        // Thực hiện truy vấn SQL để lấy số lượng thể loại
        $query = "SELECT COUNT(*) FROM categories";
        $result = $this->dbConnection->query($query);
        return $result->fetchColumn();
    }

    public function getAuthorCount() {
        // Thực hiện truy vấn SQL để lấy số lượng tác giả
        $query = "SELECT COUNT(*) FROM authors";
        $result = $this->dbConnection->query($query);
        return $result->fetchColumn();
    }

    public function getArticleCount() {
        // Thực hiện truy vấn SQL để lấy số lượng bài viết
        $query = "SELECT COUNT(*) FROM articles";
        $result = $this->dbConnection->query($query);
        return $result->fetchColumn();
    }
}
?>
