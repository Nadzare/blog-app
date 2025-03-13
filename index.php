<?php
session_start(); 

require 'classes/Post.php';
require 'views/header.php';

$Post = new Post();
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$posts = $Post->getPostsPaginated($limit, $offset);
$totalPosts = $Post->getTotalPostsCount();
$totalPages = ceil($totalPosts / $limit);
?>

<div class="container mt-4">
    <h2 class="text-center">Daftar Artikel</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="posts/create.php" class="btn btn-primary">Buat Artikel</a>

     
        <?php if (isset($_SESSION['user_id'])): ?>
            <div>
                <span class="me-3">👤 <?= htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        <?php endif; ?>
    </div>

    <table id="articleTable" class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Konten</th>
                <th>Komentar</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['title']); ?></td>
                    <td><?= substr(htmlspecialchars($post['content']), 0, 50); ?>...</td>
                    <td><?= $post['comment_count']; ?></td>
                    <td><?= $post['created_at']; ?></td>
                    <td>
                        <a href="posts/view.php?id=<?= $post['id']; ?>" class="btn btn-info btn-sm">View</a>
                        <a href="posts/edit.php?id=<?= $post['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="posts/delete.php?id=<?= $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= max(1, $page - 1); ?>">Sebelumnya</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= min($totalPages, $page + 1); ?>">Selanjutnya</a>
            </li>
        </ul>
    </nav>
</div>

<?php require 'views/footer.php'; ?>
