<?php
require '../classes/Post.php';

$Post = new Post();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($Post->delete($id)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Gagal menghapus artikel.";
    }
}
?>
