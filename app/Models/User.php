<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connection();
        $this->createTable();
    }

    public function authenticate($username, $password)
    {
        $user = $this->getMemberByUsername($username, true);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getMemberByUsername($username, $password = false)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            if (!$password) {
                unset($user['password']);
            }
            return $user;
        }
        return false;
    }

    public function createMember($username, $password, $roleId)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, roleId) VALUES (:username, :password, :roleId)");
        return $stmt->execute([
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':roleId' => $roleId
        ]);
    }

    public function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INT(10) NOT NULL AUTO_INCREMENT,
                `roleId` INT(10) NOT NULL DEFAULT '0' COMMENT '0 is member\r\n1 is admin',
                `username` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                `password` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`) USING BTREE,
                UNIQUE INDEX `username` (`username`) USING BTREE
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            AUTO_INCREMENT=1;
        ";

        try {
            $this->db->exec($sql);
        } catch (\PDOException $e) {
            return false;
        }
    }
}
