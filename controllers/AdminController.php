<?php
include("services/AdminService.php");

class AdminController {
    private $adminService;

    public function __construct($adminService) {
        $this->adminService = $adminService;
    }

    public function index($data) {
        // Fetch dashboard data
        $data = $this->adminService->getDashboardData();

        // Include the view file
        include 'views/admin/index.php';
    }
}



?>
