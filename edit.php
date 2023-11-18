<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    
    <?php
        require('./config/db.php');

        if(isset($_GET['id'])) {
            $product_id = $_GET['id'];

            $result = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $product_id");

            if ($result && $row = mysqli_fetch_assoc($result)) {
    ?>
                <h1>Edit Produk</h1>
                <a type="button" class="btn btn-info" href="show.php">Lihat data produk</a>
                <form action="./backend/edit.php" method="post" enctype="multipart/form-data">
                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Input nama produk" value="<?=$row['name'];?>">
                    <input class="form-control form-control-sm" type="number" name="price" placeholder="Input harga produk" value="<?=$row['price'];?>">
                    <p>Gambar Saat Ini: <?=$row['image'];?></p>
                    <img src="<?=$row['image'];?>" alt="Gambar Produk" width="100">
                    <input type="file" name="new_image">
                    <input type="hidden" name="old_image" value="<?=$row['image'];?>">
                    <input type="hidden" name="product_id" value="<?=$product_id;?>">
                    <div class="d-flex justify-content-start align-items-start mb-3">
                        <button type="submit" class="btn btn-info" name="edit">Simpan</button>

                    </div>
                </form>
    <?php
            } else {
                echo "Produk tidak ditemukan.";
            }
        } else {
            echo "ID produk tidak diberikan.";
        }
    ?>
</body>
</html>
