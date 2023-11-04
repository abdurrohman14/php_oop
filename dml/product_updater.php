<?php
// product_updater.php
class ProductUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateProduct($id, $productCode, $productName, $categoryId, $description, $price, $stock, $imagePaths) {
        $query = "UPDATE products SET product_code = ?, product_name = ?, category_id = ?, price = ?, stock = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssissisi", $productCode, $productName, $categoryId, $price, $stock, $description, $imagePaths, $id);

        if ($stmt->execute()) {
            return true; // Pembaruan berhasil
        } else {
            return false; // Pembaruan gagal
        }
    }
}
?>