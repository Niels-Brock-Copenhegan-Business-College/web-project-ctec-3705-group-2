<?php
declare(strict_types=1);
/**
 * AdminModel — Data access layer for the admins table.
 * Provides admin authentication via username lookup and password verification.
 */
class AdminModel {
    private PDO $db;
    public function __construct(){$this->db=getDatabase();}
    public function findByUsername(string $u): array|false {
        $s=$this->db->prepare('SELECT * FROM admins WHERE username=?');
        $s->execute([$u]);return $s->fetch();
    }
}
