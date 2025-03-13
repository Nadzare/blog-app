<?php
require '../classes/Post.php';
require '../views/header.php';

$Post = new Post();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($Post->create($title, $content)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Gagal menambahkan artikel.</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Buat Artikel Baru</h2>
    <form action="create.php" method="POST">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="../index.php" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>

<?php require '../views/footer.php'; ?>
