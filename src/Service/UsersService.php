<?php

namespace Service;

use Entity\User;
use PDO;

class UsersService
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getLastJoined(): array
    {
        return $this->db->query(
            "SELECT id, joined, name FROM user ORDER BY joined DESC LIMIT 10"
        )->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function getById(string $id): ?User
    {
        $user = $this->db->query("SELECT id, joined, name FROM user WHERE id = " . $this->db->quote($id))->fetchObject(User::class);

        return ($user === false) ? null: $user;
    }
}
