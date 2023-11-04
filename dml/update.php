<?php
// update_product.php
include 'koneksi.php';
include 'product_updater.php';

$productUpdater = new ProductUpdater($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $productCode = $_POST['product_code'];
    $productName = $_POST['product_name'];
    $categoryId = $_POST['kategori'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    if (!empty($_FILES['image']['name'][0])) {
        $imagePaths = [];
        $targetDir = "../Files/"; // Direktori tempat menyimpan gambar
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

        foreach ($_FILES['image']['name'] as $key => $imageName) {
            $tempImageName = $_FILES['image']['name'][$key];
            $tempImageTmp = $_FILES['image']['tmp_name'][$key];
            $imageFileType = strtolower(pathinfo($tempImageName, PATHINFO_EXTENSION));
            $targetFile = $targetDir . $productCode . '_' . uniqid() . '.' . $imageFileType;

            if (in_array($imageFileType, $allowedExtensions)) {
                if (move_uploaded_file($tempImageTmp, $targetFile)) {
                    $imagePaths[] = $targetFile;
                }
            }
        }
        $imagePaths = json_encode($imagePaths);
    } else {
        $existingImages = json_decode($_POST['existing_images']);
        $imagePaths = json_encode($existingImages);
    }

    $result = $productUpdater->updateProduct($id, $productCode, $productName, $categoryId, $description, $price, $stock, $imagePaths);
    
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Gagal memperbarui produk";
    }

    $conn->close();
}
?>