<?php
class User {
    private $users = [
        'user1' => ['password' => '123', 'role' => 'user'],
        'user2' => ['password' => '456', 'role' => 'user'],
        'admin' => ['password' => 'admin123', 'role' => 'admin']
    ];

    public function getUser($username) {
        if (isset($this->users[$username])) {
            return $this->users[$username];
        }
        return null;
    }
}
?>
