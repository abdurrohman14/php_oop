<?php
// product_deleter.php
class ProductDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Penghapusan berhasil
        } else {
            return false; // Penghapusan gagal
        }
    }
}
?>