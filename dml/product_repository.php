<?php
// product_repository.php
class ProductRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addProduct($productCode, $imagePaths, $productName, $categoryId, $description, $price, $stock) {
        // Query untuk memasukkan data produk ke dalam tabel products
        $query = "INSERT INTO products (product_code, image, product_name, category_id, description, price, stock) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssissii", $productCode, $imagePaths, $productName, $categoryId, $description, $price, $stock);

        if ($stmt->execute()) {
            return true; // Penyimpanan berhasil
        } else {
            return false; // Penyimpanan gagal
        }
    }
}
?>