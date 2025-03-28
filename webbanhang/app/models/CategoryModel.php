<?php
class CategoryModel
{
    private $conn;
    private $table_name = "category";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả danh mục
    public function getCategories()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Thêm danh mục
    public function addCategory($name, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " (NAME, DESCRIPTION) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $description)
    {
        $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET NAME = ?, DESCRIPTION = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $id]);
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>