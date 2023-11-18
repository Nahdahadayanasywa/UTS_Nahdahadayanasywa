<?php
require './../config/db.php';

if(isset($_POST['edit'])) {
    global $db_connect;

    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $old_image = $_POST['old_image'];
    
    // Cek apakah file baru diunggah
    if ($_FILES['new_image']['error'] == 0) {
        // Jika ya, proses file baru
        $image = $_FILES['new_image']['name'];
        $tempImage = $_FILES['new_image']['tmp_name'];

        $randomFilename = time().'-'.md5(rand()).'-'.$image;
        $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$randomFilename;

        $upload = move_uploaded_file($tempImage, $uploadPath);

        if($upload) {
            // Hapus gambar lama jika berhasil diunggah
            unlink($_SERVER['DOCUMENT_ROOT'].$old_image);

            // Perbarui data produk di database termasuk gambar baru
            $updateQuery = "UPDATE products SET name='$name', price='$price', image='/upload/$randomFilename' WHERE id=$product_id";
            $updateResult = mysqli_query($db_connect, $updateQuery);

            if ($updateResult) {
                echo "Berhasil memperbarui data produk.";
            } else {
                echo "Gagal memperbarui data produk: " . mysqli_error($db_connect);
            }
        } else {
            echo "Gagal mengupload gambar baru.";
        }
    } else {
        // Jika tidak, hanya perbarui data produk (tanpa mengganti gambar)
        $updateQuery = "UPDATE products SET name='$name', price='$price' WHERE id=$product_id";
        $updateResult = mysqli_query($db_connect, $updateQuery);

        if ($updateResult) {
            echo "Berhasil memperbarui data produk.";
        } else {
            echo "Gagal memperbarui data produk: " . mysqli_error($db_connect);
        }
    }
}
?>
