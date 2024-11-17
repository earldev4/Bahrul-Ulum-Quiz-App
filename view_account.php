<?php
    session_start();
    include 'includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pondok Bahrul Ulum Quiz App - Lihat Data Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Murid</h1>
        <a href="admin_dashboard.php" class="bg-danger text-white px-3 py-2 rounded text-decoration-none">Kembali</a>
        <!-- Tabel Data Murid -->
        <table class="table table-bordered table-striped mt-4">
            <thead class="table-secondary">
                <tr>
                    <th>NIS</th>
                    <th>Username</th>
                    <th>Tanggal Pembuatan Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $db->query("SELECT user_nis, username, created_at FROM akun_users ORDER BY created_at DESC");
                $no = 1;
                while ($row = $stmt->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['user_nis']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='edit_account.php?user_nis={$row['user_nis']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_account.php?user_nis={$row['user_nis']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus user ini?\")'>Hapus</a>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>