<?php
// delete_product.php
include 'koneksi.php';
include 'product_deleter.php';

$productDeleter = new ProductDeleter($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = $productDeleter->deleteProduct($id);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Gagal menghapus produk";
    }

    $conn->close();
}
?>