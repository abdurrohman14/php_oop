<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/product.css">
    <title>Daftar Produk</title>
</head>
<body>
    <div class="header">
        <h2>Produk List</h2>
    </div>
    <div class="product-container">
        <?php
        $products = [
            [
                'nama' => 'Pajero Sport',
                'harga' => 100,
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'gambar' => 'pajero.png',
            ],
            [
                'nama' => 'Pajero Sport',
                'harga' => 150,
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'gambar' => 'pajero.png',
            ],
            [
                'nama' => 'Pajero Sport',
                'harga' => 200,
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'gambar' => 'pajero.png',
            ],
            [
                'nama' => 'Pajero Sport',
                'harga' => 120,
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'gambar' => 'pajero.png',
            ],
        ];

        foreach ($products as $product) {
            echo '<div class="product-card">';
            echo '<img src="../assets/img/' . $product['gambar'] . '" alt="' . $product['nama'] . '">';
            echo '<h3>' . $product['nama'] . '</h3>';
            echo '<p class="price">$' . $product['harga'] . '</p>';
            echo '<p>' . $product['deskripsi'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
    <script src="../assets/js/product.js"></script>
</body>
</html>