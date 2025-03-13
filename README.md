<h1>📜 Dokumentasi Struktur Proyek BLOG-APP</h1>

👤 Nama: Nadzare Kafah Alfatiha
📆 NIM: H1D023014
📚 Mata Kuliah: Pemrograman Webiste II

1️⃣ PENDAHULUAN
BLOG-APP adalah aplikasi berbasis web yang memungkinkan pengguna untuk melakukan manajemen artikel (CRUD), memberikan komentar, serta melakukan autentikasi (login/logout). Aplikasi ini dibangun menggunakan PHP OOP, PDO, jQuery, DataTables, dan Bootstrap untuk tampilan yang responsif dan interaktif.

2️⃣ STRUKTUR DIREKTORI & PENJELASAN FILE
bash
Copy
Edit
BLOG-APP/
│── classes/        # Folder berisi kelas-kelas utama (Object-Oriented PHP)
│   ├── Comment.php    # Kelas untuk mengelola komentar
│   ├── Database.php   # Kelas untuk koneksi database menggunakan PDO
│   ├── Post.php       # Kelas untuk mengelola artikel (CRUD)
│   ├── User.php       # Kelas untuk manajemen pengguna (login/logout)
│
│── config/         # Folder untuk konfigurasi aplikasi
│   ├── database.php   # File koneksi ke database menggunakan PDO
│
│── posts/          # Folder untuk fitur CRUD artikel
│   ├── add_comment.php # Proses menambahkan komentar ke artikel
│   ├── create.php      # Form dan proses untuk membuat artikel baru
│   ├── delete.php      # Menghapus artikel dari database
│   ├── edit.php        # Mengedit artikel yang sudah ada
│   ├── view.php        # Menampilkan detail artikel dan komentarnya
│
│── views/          # Folder untuk tampilan website
│   ├── footer.php  # Footer halaman (bagian bawah)
│   ├── header.php  # Header halaman (bagian atas), termasuk navigasi
│
│── blog_db.sql     # Skrip SQL untuk membuat tabel database
│── index.php       # Halaman utama yang menampilkan daftar artikel dengan pagination
│── login.php       # Halaman login menggunakan username dan email
│── logout.php      # Proses logout dan menghapus sesi pengguna


3️⃣ PENJELASAN FUNGSI SETIAP FILE
📂 1. Folder classes/ (Model – PHP OOP)
Berisi kelas-kelas utama untuk mengelola data di aplikasi.

Database.php

Kelas untuk koneksi ke database menggunakan PDO.
Menggunakan metode singleton pattern agar koneksi hanya dibuat satu kali.
User.php

Mengelola autentikasi pengguna (login/logout).
Metode:
login($username, $email): Autentikasi pengguna berdasarkan username & email.
logout(): Menghapus sesi pengguna dan mengarahkan ke halaman login.
isLoggedIn(): Mengecek apakah pengguna sedang login.
Post.php

Mengelola artikel (CRUD).
Metode:
createPost($title, $content): Menambahkan artikel baru.
getPostsPaginated($limit, $offset): Mengambil daftar artikel dengan pagination.
updatePost($id, $title, $content): Mengedit artikel.
deletePost($id): Menghapus artikel.
getTotalPostsCount(): Menghitung total artikel.
Comment.php

Mengelola komentar pada artikel.
Metode:
addComment($postId, $username, $content): Menambahkan komentar.
getCommentsByPostId($postId): Mengambil daftar komentar untuk suatu artikel.
📂 2. Folder config/ (Konfigurasi Database)
database.php
Koneksi ke database menggunakan PDO.
Memastikan keamanan koneksi menggunakan prepared statements.
📂 3. Folder posts/ (Manajemen Artikel - CRUD)
Berisi file untuk melakukan operasi CRUD terhadap artikel.

add_comment.php

Menambahkan komentar pada artikel yang dipilih.
create.php

Menyediakan form untuk membuat artikel baru.
Menggunakan metode POST untuk menyimpan data ke database.
delete.php

Menghapus artikel berdasarkan id yang dipilih.
Memastikan hanya pengguna yang berwenang yang dapat menghapus artikel.
edit.php

Menyediakan form untuk mengedit artikel yang sudah ada.
Data diambil dari database berdasarkan id.
view.php

Menampilkan detail artikel beserta daftar komentar terkait.
Menggunakan metode GET untuk mengambil data berdasarkan id.
📂 4. Folder views/ (Tampilan Header & Footer)
header.php

Menampilkan header halaman, termasuk menu navigasi.
Jika pengguna sudah login, tombol logout akan muncul.
footer.php

Menampilkan footer halaman.
📌 File Utama di Root Directory
blog_db.sql

Skrip SQL untuk membuat database dan tabel:
users (id, username, email)
posts (id, title, content, created_at)
comments (id, post_id, username, content, created_at)
index.php

Halaman utama yang menampilkan daftar artikel.
Menggunakan pagination untuk membagi artikel menjadi beberapa halaman.
login.php

Form login yang meminta username dan email.
Jika berhasil, pengguna diarahkan ke index.php.
logout.php

Menghapus sesi pengguna dan mengarahkan ke halaman login.


4️⃣ FITUR UTAMA
✅ Manajemen Pengguna (Login & Logout)
✅ Manajemen Artikel (CRUD - Create, Read, Update, Delete)
✅ Pagination untuk Daftar Artikel
✅ Komentar pada Artikel
✅ Autentikasi dengan Session


5️⃣ TEKNOLOGI YANG DIGUNAKAN
Backend: PHP (OOP, PDO)
Frontend: Bootstrap, jQuery, DataTables
Database: MySQL
Keamanan: Session, Prepared Statements


6️⃣ PENUTUP
Aplikasi BLOG-APP dikembangkan untuk menyediakan sistem manajemen artikel yang sederhana namun fungsional. Dengan fitur CRUD artikel, komentar, serta autentikasi pengguna, aplikasi ini dapat digunakan sebagai dasar untuk proyek pengembangan lebih lanjut.