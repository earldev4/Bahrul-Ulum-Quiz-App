<?php
include 'includes/db.php'; // Pastikan path ke file db.php benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $_POST['subject_id'];
    $question_text = $_POST['question_text'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];
    $duration = $_POST['duration'];

    // Query untuk memasukkan soal baru ke database
    $query = "INSERT INTO questions (subject_id, question_text, option_a, option_b, option_c, option_d, correct_option, duration) 
              VALUES ('$subject_id', '$question_text', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option', '$duration')";

    if (mysqli_query($db, $query)) {
        header("Location: admin_dashboard.php?success=Soal berhasil ditambahkan");
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal</title>
</head>
<body>
    <h1>Tambah Quiz Baru</h1>
    <form method="POST" action="add_question.php">
        <label for="subject_id">Mata Pelajaran:</label>
        <select name="subject_id" required>
            <option value="" disabled selected>Pilih Mata Pelajaran</option>
            <?php
            // Query untuk mengambil data mata pelajaran dari tabel subjects
            $subjects = mysqli_query($db, "SELECT * FROM subject");

            if ($subjects && mysqli_num_rows($subjects) > 0) {
                while ($row = mysqli_fetch_assoc($subjects)) {
                    echo "<option value='{$row['subject_id']}'>{$row['subject_name']}</option>";
                }
            } else {
                echo "<option value='' disabled>Tidak ada mata pelajaran</option>";
            }
            ?>
        </select>

        <label for="question_text">Pertanyaan:</label>
        <textarea name="question_text" required></textarea>

        <label for="option_a">Pilihan A:</label>
        <input type="text" name="option_a" required>

        <label for="option_b">Pilihan B:</label>
        <input type="text" name="option_b" required>

        <label for="option_c">Pilihan C:</label>
        <input type="text" name="option_c" required>

        <label for="option_d">Pilihan D:</label>
        <input type="text" name="option_d" required>

        <label for="correct_option">Jawaban Benar (A/B/C/D):</label>
        <input type="text" name="correct_option" required maxlength="1" pattern="[A-Da-d]" title="Harap masukkan A, B, C, atau D saja">

        <label for="duration">Durasi (menit):</label>
        <input type="number" name="duration" required min="1">

        <button type="submit">Tambahkan</button>
    </form>
</body>
</html>
