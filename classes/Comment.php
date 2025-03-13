<?php
require_once __DIR__ . '/../config/database.php';

class Comment {
    private $conn;
    private $table = "comments";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getCommentsByPostId($post_id) {
        $query = "SELECT c.id, c.content, c.created_at, u.username 
                  FROM " . $this->table . " c
                  LEFT JOIN users u ON c.user_id = u.id
                  WHERE c.post_id = :post_id
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addComment($post_id, $user_id, $content) {
        if (empty($content)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (post_id, user_id, content, created_at) 
                  VALUES (:post_id, :user_id, :content, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function deleteComment($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
