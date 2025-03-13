<?php
require '../classes/Comment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $content = trim($_POST['content']);

    $user_id = 1;

    $Comment = new Comment();
    if ($Comment->addComment($post_id, $user_id, $content)) {
        header("Location: view.php?id=" . $post_id);
        exit();
    } else {
        echo "<script>alert('Komentar tidak boleh kosong!'); window.history.back();</script>";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
