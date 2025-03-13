<?php
require '../classes/Post.php';
require '../classes/Comment.php';
require '../views/header.php';

$Post = new Post();
$Comment = new Comment();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Artikel tidak ditemukan!</div></div>";
    require '../views/footer.php';
    exit();
}

$post_id = $_GET['id'];
$post = $Post->getPostById($post_id);
$comments = $Comment->getCommentsByPostId($post_id);

if (!$post) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Artikel tidak ditemukan!</div></div>";
    require '../views/footer.php';
    exit();
}
?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($post['title']); ?></h2>
    <p><small>Diposting pada <?= $post['created_at']; ?></small></p>
    <p><?= nl2br(htmlspecialchars($post['content'])); ?></p>

    <hr>

    <h4>Komentar</h4>
    <ul class="list-group">
        <?php if (count($comments) > 0): ?>
            <?php foreach ($comments as $comment): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($comment['username'] ?? 'Anonim'); ?>:</strong>
                    <?= htmlspecialchars($comment['content']); ?>
                    <br><small><?= $comment['created_at']; ?></small>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item">Belum ada komentar.</li>
        <?php endif; ?>
    </ul>

    <hr>

    <h4>Tambahkan Komentar</h4>
    <form action="add_comment.php" method="POST">
        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Kirim</button>
    </form>

    <br>
    <a href="../index.php" class="btn btn-secondary">Kembali</a>
</div>

<?php require '../views/footer.php'; ?>
