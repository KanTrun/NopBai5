<?php
class ProductModel
{
private $conn;
private $table_name = "product";
public function __construct($db)
{
$this->conn = $db;
}
public function getProducts()
{
$query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
FROM " . $this->table_name . " p
LEFT JOIN category c ON p.category_id = c.id";
$stmt = $this->conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
return $result;
}
public function getProductById($id)
{
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
    }
    public function addProduct($name, $description, $price, $category_id, $image = null, $id = null)
    {
        // Validate input
        $errors = [];
        
        if (empty($name)) {
            $errors[] = "Tên sản phẩm không được để trống";
        }
        
        if (empty($price) || !is_numeric($price) || $price <= 0) {
            $errors[] = "Giá sản phẩm không hợp lệ";
        }
        
        if (empty($category_id) || !is_numeric($category_id)) {
            $errors[] = "Danh mục không hợp lệ";
        }
        
        if (!empty($errors)) {
            return $errors;
        }
        
        // Sanitize input
        $name = htmlspecialchars(strip_tags($name ?? ''));
        $description = htmlspecialchars(strip_tags($description ?? ''));
        $price = floatval($price);
        $category_id = intval($category_id);
        $image = $image ? htmlspecialchars(strip_tags($image)) : null;
        
        // Prepare query
        if ($id) {
            $query = "INSERT INTO " . $this->table_name . " 
                    (id, name, description, price, category_id, image) 
                    VALUES 
                    (:id, :name, :description, :price, :category_id, :image)";
        } else {
            $query = "INSERT INTO " . $this->table_name . " 
                    (name, description, price, category_id, image) 
                    VALUES 
                    (:name, :description, :price, :category_id, :image)";
        }
        
        $stmt = $this->conn->prepare($query);
        
        // Bind values
        if ($id) {
            $stmt->bindParam(":id", $id);
        }
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":image", $image);
        
        try {
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            error_log("Error adding product: " . $e->getMessage());
            return false;
        }
    }
    public function updateProduct($id, $name, $description, $price, $category_id, $image = null)
    {
        // Validate input
        $errors = [];
        
        if (empty($name)) {
            $errors[] = "Tên sản phẩm không được để trống";
        }
        
        if (empty($price) || !is_numeric($price) || $price <= 0) {
            $errors[] = "Giá sản phẩm không hợp lệ";
        }
        
        if (empty($category_id) || !is_numeric($category_id)) {
            $errors[] = "Danh mục không hợp lệ";
        }
        
        if (!empty($errors)) {
            return $errors;
        }
        
        // Sanitize input
        $name = htmlspecialchars(strip_tags($name ?? ''));
        $description = htmlspecialchars(strip_tags($description ?? ''));
        $price = floatval($price);
        $category_id = intval($category_id);
        $image = $image ? htmlspecialchars(strip_tags($image)) : null;
        
        // Prepare query
        $query = "UPDATE " . $this->table_name . " 
                SET name = :name, 
                    description = :description, 
                    price = :price, 
                    category_id = :category_id" . 
                    ($image ? ", image = :image" : "") . 
                " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind values
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":category_id", $category_id);
        if ($image) {
            $stmt->bindParam(":image", $image);
        }
        
        try {
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $e) {
            error_log("Error updating product: " . $e->getMessage());
            return false;
        }
    }
public function deleteProduct($id)
{
$query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
$stmt = $this->conn->prepare($query);
$stmt->bindParam(':id', $id);
if ($stmt->execute()) {
return true;
}
return false;
}
public function createProduct($data) {
    $query = "INSERT INTO " . $this->table_name . " 
            (name, price, description, content, image, category_id) 
            VALUES 
            (:name, :price, :description, :content, :image, :category_id)";
    
    $stmt = $this->conn->prepare($query);
    
    // Sanitize values first
    $name = htmlspecialchars(strip_tags($data['name']));
    $description = htmlspecialchars(strip_tags($data['description']));
    $content = htmlspecialchars(strip_tags($data['content']));
    $price = $data['price'];
    $image = $data['image'];
    $category_id = $data['category_id'];
    
    // Bind values using variables
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":category_id", $category_id);
    
    try {
        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    } catch(PDOException $e) {
        error_log("Error creating product: " . $e->getMessage());
        return false;
    }
}
}
?>