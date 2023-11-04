<?php
// save_product.php
include 'koneksi.php';
include 'product_repository.php';

$productRepository = new ProductRepository($conn);

if (isset($_POST['product_code']) && isset($_POST['product_name']) && 
    isset($_POST['kategori']) && isset($_POST['price']) && isset($_POST['stock']) 
    && isset($_POST['description'])) {
    $productCode = $_POST['product_code'];
    $productName = $_POST['product_name'];
    $categoryId = $_POST['kategori'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $imagePaths = [];

    if (!empty($_FILES['image']['name'][0])) {
        $targetDirectory = "../files/";
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        foreach ($_FILES['image']['name'] as $key => $name) {
            $targetFile = $targetDirectory . basename($name);
            if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetFile)) {
                $imagePaths[] = $targetFile;
            }
        }
    }

    // Simpan path gambar dalam bentuk JSON
    $imagePathsJSON = json_encode($imagePaths);

    $result = $productRepository->addProduct($productCode, $imagePathsJSON, $productName, $categoryId, $description, $price, $stock);

    if ($result) {
        header('location: index.php');
    } else {
        echo "Error: Gagal menyimpan produk";
    }

    $conn->close();
}
?>
