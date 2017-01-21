<?php

namespace Service;

use PDO;
use Entity\Tweet;

class TweetsService
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getLastByUser(string $user): array
    {
        return $this->db->query(
            "SELECT LOWER(HEX(id)) AS id, ts, user_id AS userId, message FROM tweet WHERE user_id = " . $this->db->quote($user) .
            " ORDER BY ts DESC LIMIT 20"
        )->fetchAll(PDO::FETCH_CLASS, Tweet::class);
    }

    public function getTweetsCount(string $user): int
    {
        return $this->db->query(
            "SELECT COUNT(*) FROM tweet WHERE user_id = " . $this->db->quote($user)
        )->fetchColumn();
    }

    public function getById(string $id): ?Tweet
    {
        $result = $this->db->query(
            "SELECT LOWER(HEX(id)) AS id, ts, user_id AS userId, message FROM tweet WHERE id = UNHEX(" . $this->db->quote($id) . ")"
        )->fetchObject(Tweet::class);

        if ($result === false) {
            return null;
        }

        return $result;
    }
}
