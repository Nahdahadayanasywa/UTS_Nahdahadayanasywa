<?php

require './../config/db.php';

if(isset($_POST['submit'])) {
    global $db_connect;

    $name = mysqli_real_escape_string($db_connect, $_POST['name']);
    $price = mysqli_real_escape_string($db_connect, $_POST['price']);

    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;

    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

    // Ensure the upload directory exists
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $uploadPath = $uploadDirectory . $randomFilename;

    if(move_uploaded_file($tempImage, $uploadPath)) {
        $imagePath = '/upload/' . $randomFilename;

        $insertQuery = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$imagePath')";

        if(mysqli_query($db_connect, $insertQuery)) {
            echo "Berhasil upload";
        } else {
            echo "Gagal melakukan query: " . mysqli_error($db_connect);
        }
    } else {
        echo "Gagal upload file";
    }
}

?>
<?php

require './../config/db.php';

if(isset($_POST['submit'])) {
    global $db_connect;

    $name = mysqli_real_escape_string($db_connect, $_POST['name']);
    $price = mysqli_real_escape_string($db_connect, $_POST['price']);

    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;

    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

    // Ensure the upload directory exists
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $uploadPath = $uploadDirectory . $randomFilename;

    if(move_uploaded_file($tempImage, $uploadPath)) {
        $imagePath = '/upload/' . $randomFilename;

        $insertQuery = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$imagePath')";

        if(mysqli_query($db_connect, $insertQuery)) {
            echo "Berhasil upload";
        } else {
            echo "Gagal melakukan query: " . mysqli_error($db_connect);
        }
    } else {
        echo "Gagal upload file";
    }
}

?>