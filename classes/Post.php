<?php
require_once __DIR__ . '/../config/database.php';

class Post {
    private $conn;
    private $table = "posts";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    public function getAllPosts() {
        $query = "SELECT p.id, p.title, p.content, p.created_at, 
                         u.username, 
                         (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id) AS comment_count
                  FROM " . $this->table . " p
                  LEFT JOIN users u ON p.user_id = u.id
                  ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPostById($id) {
        $query = "SELECT p.id, p.title, p.content, p.created_at, 
                         u.username, 
                         (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id) AS comment_count
                  FROM " . $this->table . " p
                  LEFT JOIN users u ON p.user_id = u.id
                  WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function create($title, $content) {
        if (empty($title) || empty($content)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (title, content, created_at) 
                  VALUES (:title, :content, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function update($id, $title, $content) {
        if (empty($title) || empty($content)) {
            return false; 
        }

        $query = "UPDATE " . $this->table . " 
                  SET title = :title, content = :content 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }

  
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getPostsPaginated($limit, $offset) {
        $query = "SELECT p.id, p.title, p.content, p.created_at, 
                         u.username, 
                         (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id) AS comment_count
                  FROM " . $this->table . " p
                  LEFT JOIN users u ON p.user_id = u.id
                  ORDER BY p.created_at DESC
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTotalPostsCount() {
        $query = "SELECT COUNT(*) AS total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>
