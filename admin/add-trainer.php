    <?php

    require_once '../config/db.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil data dari form
        $name = $_POST['name'];
        $position = $_POST['position'];
        $status = $_POST['status'];
        $specialties = $_POST['specialties'];
        
        // Cek upload gambar
        $cover_photo_url = 'default.jpg'; // Jika tidak ada gambar, gunakan gambar default
        if ($_FILES['cover_photo']['error'] == 0) {
            $target_dir = "../admin/uploads/trainers/";  // Tentukan folder tempat menyimpan file gambar
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);  // Buat folder jika belum ada
            }

            // Tentukan path file gambar yang akan disimpan
            $target_file = $target_dir . basename($_FILES["cover_photo"]["name"]);

            // Cek apakah file adalah gambar
            if (getimagesize($_FILES["cover_photo"]["tmp_name"])) {
                // Pindahkan file ke folder tujuan
                if (move_uploaded_file($_FILES["cover_photo"]["tmp_name"], $target_file)) {
                    $cover_photo_url = 'uploads/trainers/' . basename($_FILES["cover_photo"]["name"]); // Simpan path relatif
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    exit;
                }
            } else {
                echo "File is not an image.";
                exit;
            }
        }

        // Simpan data pelatih ke database
    $stmt = $conn->prepare("INSERT INTO trainers (name, position, status, specialties, cover_photo) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $name, $position, $status, $specialties, $cover_photo_url);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;
    }

    }
    ?>
