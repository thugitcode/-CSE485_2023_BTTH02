<?php
include("configs\DBConnection.php");
include("models\AdminModel.php");

class AdminService {
    private $adminModel;

    public function __construct($adminModel) {
        $this->adminModel = $adminModel;
    }

    public function getDashboardData() {
        // Giả sử bạn có một phương thức trong AdminModel để lấy dữ liệu
        return [
            'count_users' => $this->adminModel->getUserCount(),
            'count_categories' => $this->adminModel->getCategoryCount(),
            'count_authors' => $this->adminModel->getAuthorCount(),
            'count_articles' => $this->adminModel->getArticleCount()
        ];
    }
}
?>
