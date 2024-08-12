<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "xss_lab"); // Sesuaikan dengan konfigurasi Anda

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Menyimpan komentar (Stored XSS)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $stmt = $mysqli->prepare("INSERT INTO comments (comment) VALUES (?)");
    $stmt->bind_param("s", $comment);
    $stmt->execute();
    $stmt->close();
}

// Menampilkan komentar (Stored XSS)
$comments = [];
$result = $mysqli->query("SELECT comment FROM comments");
while ($row = $result->fetch_assoc()) {
    $comments[] = $row['comment'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>XSS Lab</title>
    <
</head>
<body>
    <h1>XSS Lab</h1>

    <!-- Form untuk komentar (Stored XSS) -->
    <h2>Tambahkan Komentar</h2>
    <form method="post" action="">
        <textarea name="comment" placeholder="Tulis komentar Anda"></textarea>
        <button type="submit">Kirim</button>
    </form>

    <!-- Menampilkan komentar (Stored XSS) -->
    <h2>Komentar</h2>
    <?php foreach ($comments as $comment): ?>
        <div><?php echo $comment; ?></div>
    <?php endforeach; ?>

    <!-- Form pencarian (Reflected XSS) -->
    <h2>Pencarian</h2>
    <form method="get" action="">
        <input type="text" name="q" placeholder="Masukkan query pencarian" />
        <button type="submit">Cari</button>
    </form>

    <!-- Menampilkan hasil pencarian (Reflected XSS) -->
    <?php if (isset($_GET['q'])): ?>
        <h2>Hasil Pencarian</h2>
        <p>Hasil pencarian untuk: <?php echo $_GET['q']; ?></p>
    <?php endif; ?>

    <!-- Link ke halaman DOM XSS -->
    <h2>DOM XSS Example</h2>
    <p><a href="dom.html">Lihat DOM XSS Lab</a></p>
</body>
</html>
