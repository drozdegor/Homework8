<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['file_name'])) {
        header('Location: index.html');
        exit;
    }

    if (empty($_FILES['content']) || $_FILES['content']['error'] !== UPLOAD_ERR_OK) {
        header('Location: index.html');
        exit;
    }

    $uploadedFile = $_FILES['content'];
    $fileName = $_POST['file_name'];
    $fileTmpPath = $uploadedFile['tmp_name'];
    $fileSize = $uploadedFile['size'];

    $uploadDir = 'upload/';
    $destinationPath = $uploadDir . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (move_uploaded_file($fileTmpPath, $destinationPath)) {
        echo '<h1>Файл успешно загружен!</h1>';
        echo '<p><strong>Полный путь:</strong> ' . realpath($destinationPath) . '</p>';
        echo '<p><strong>Размер файла:</strong> ' . $fileSize . ' байт</p>';
    } else {
        echo '<h1>Ошибка при сохранении файла!</h1>';
    }
} else {
    header('Location: index.html');
    exit;
}
?>
