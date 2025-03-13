<?php
require '../classes/Post.php';
require '../views/header.php';

$Post = new Post();

if (!isset($_GET['id'])) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>ID tidak ditemukan.</div></div>";
    require '../views/footer.php';
    exit();
}

$id = $_GET['id'];


$article = $Post->getPostById($id);

if (!$article) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Artikel tidak ditemukan.</div></div>";
    require '../views/footer.php';
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        if ($Post->update($id, $title, $content)) {
            echo "<script>alert('Artikel berhasil diperbarui!'); window.location='../index.php';</script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Gagal mengupdate artikel.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Judul dan konten tidak boleh kosong!</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Edit Artikel</h2>
    <form action="edit.php?id=<?= $id ?>" method="POST">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($article['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea name="content" class="form-control" rows="5" required><?= htmlspecialchars($article['content']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
        <a href="../index.php" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>

<?php require '../views/footer.php'; ?>
