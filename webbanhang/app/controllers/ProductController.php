<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController 
{
    private $productModel;
    private $db;

    public function __construct() 
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function filter() 
{
    $category_id = isset($_GET['category']) ? $_GET['category'] : null;
    $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
    $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 10000000;
    $rating = isset($_GET['rating']) ? $_GET['rating'] : null;
    
    $products = $this->productModel->getFilteredProducts($category_id, $min_price, $max_price, $rating);
    $cartItems = isset($_SESSION['cart']) ? array_keys($_SESSION['cart']) : [];
    
    include 'app/views/product/list.php';
}
    private function isAdmin() {
        return SessionHelper::isAdmin();
    }
    public function index() {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
        }

    public function addToCart($id) 
    {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'category_id' => $product->category_id
            ];
        }

        header('Location: /Product');
    }

    public function cart() 
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $total = $this->calculateCartTotal($cart);
        include 'app/views/product/cart.php';
    }

    public function updateCart() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['quantity'])) {
                foreach ($_POST['quantity'] as $productId => $quantity) {
                    $productId = (int)$productId;
                    $quantity = (int)$quantity;

                    if (isset($_SESSION['cart'][$productId])) {
                        if ($quantity > 0) {
                            $_SESSION['cart'][$productId]['quantity'] = $quantity;
                        } else {
                            unset($_SESSION['cart'][$productId]);
                        }
                    }
                }
            } else if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
                $productId = (int)$_POST['product_id'];
                $quantity = (int)$_POST['quantity'];
                
                if (isset($_SESSION['cart'][$productId])) {
                    if ($quantity > 0) {
                        $_SESSION['cart'][$productId]['quantity'] = $quantity;
                        $subtotal = $quantity * $_SESSION['cart'][$productId]['price'];
                        $total = $this->calculateCartTotal($_SESSION['cart']);
                        
                        echo json_encode([
                            'success' => true,
                            'subtotal' => $subtotal,
                            'total' => $total,
                            'formattedSubtotal' => number_format($subtotal, 0, ',', '.') . ' ₫',
                            'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                        ]);
                        exit;
                    } else {
                        unset($_SESSION['cart'][$productId]);
                        $total = $this->calculateCartTotal($_SESSION['cart']);
                        echo json_encode([
                            'success' => true,
                            'removed' => true,
                            'total' => $total,
                            'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                        ]);
                        exit;
                    }
                }
            }
            
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
                header('Location: /Product/cart');
                exit;
            }
        }
    }

    public function removeFromCart($id) 
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: /Product/cart');
    }

    private function calculateCartTotal($cart) 
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
 
    public function show($id) 
    { 
        $product = $this->productModel->getProductById($id); 
        if ($product) { 
            include 'app/views/product/show.php'; 
        } else { 
            echo "Không thấy sản phẩm."; 
        } 
    } 
 
    public function add() {
        if (!$this->isAdmin()) {
        echo "Bạn không có quyền truy cập chức năng này!";
        exit;
        }
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
        } 
 
        public function save() {
            if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            
            // Xử lý upload hình ảnh
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "uploads/products/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                $target_file = $target_dir . uniqid() . '.' . $imageFileType;
                
                // Kiểm tra định dạng file
                $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($imageFileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image = $target_file;
                    }
                }
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
            
            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                header('Location: /Product');
            }
            }
        } 
 
            public function edit($id) {
                if (!$this->isAdmin()) {
                echo "Bạn không có quyền truy cập chức năng này!";
                exit;
                }
                $product = $this->productModel->getProductById($id);
                $categories = (new CategoryModel($this->db))->getCategories();
                if ($product) {
                include 'app/views/product/edit.php';
                } else {
                echo "Không thấy sản phẩm.";
                }
                } 
 
                public function update() {
                    if (!$this->isAdmin()) {
                    echo "Bạn không có quyền truy cập chức năng này!";
                    exit;
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category_id = $_POST['category_id'];
                $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                ? $this->uploadImage($_FILES['image'])
                : $_POST['existing_image'];
                $edit = $this->productModel->updateProduct($id, $name, $description,
                
                $price, $category_id, $image);
                if ($edit) {
                header('Location: /Product');
                } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
                }
                }
                } 
 
                public function delete($id) {
                    if (!$this->isAdmin()) {
                    echo "Bạn không có quyền truy cập chức năng này!";
                    exit;
                    }
                    if ($this->productModel->deleteProduct($id)) {
                    header('Location: /Product');
                    } else {
                    echo "Đã xảy ra lỗi khi xóa sản phẩm.";
                    }
                       
    } 
 
    private function uploadImage($file) 
    { 
        $target_dir = "uploads/products/"; 
        if (!is_dir($target_dir)) { 
            mkdir($target_dir, 0777, true); 
        } 
     
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $imageFileType;
     
        $check = getimagesize($file["tmp_name"]); 
        if ($check === false) { 
            throw new Exception("File không phải là hình ảnh."); 
        } 
     
        if ($file["size"] > 10 * 1024 * 1024) { 
            throw new Exception("Hình ảnh có kích thước quá lớn."); 
        } 
     
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") { 
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF."); 
        } 
     
        if (!move_uploaded_file($file["tmp_name"], $target_file)) { 
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh."); 
        } 
     
        return $target_file; 
    } 
 
    public function checkout() 
    { 
        include 'app/views/product/checkout.php'; 
    } 
 
    public function processCheckout() 
    { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $name = $_POST['name']; 
            $phone = $_POST['phone']; 
            $address = $_POST['address']; 
 
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { 
                echo "Giỏ hàng trống."; 
                return; 
            } 
 
            $this->db->beginTransaction(); 
 
            try { 
                $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)"; 
                $stmt = $this->db->prepare($query); 
                $stmt->bindParam(':name', $name); 
                $stmt->bindParam(':phone', $phone); 
                $stmt->bindParam(':address', $address); 
                $stmt->execute(); 
                $order_id = $this->db->lastInsertId(); 
 
                $cart = $_SESSION['cart']; 
                foreach ($cart as $product_id => $item) { 
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)"; 
                    $stmt = $this->db->prepare($query); 
                    $stmt->bindParam(':order_id', $order_id); 
                    $stmt->bindParam(':product_id', $product_id); 
                    $stmt->bindParam(':quantity', $item['quantity']); 
                    $stmt->bindParam(':price', $item['price']); 
                    $stmt->execute(); 
                } 
 
                unset($_SESSION['cart']); 
                $this->db->commit(); 
                header('Location: /Product/orderConfirmation'); 
            } catch (Exception $e) { 
                $this->db->rollBack(); 
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage(); 
            } 
        } 
    } 
 
    public function orderConfirmation() 
    { 
        include 'app/views/product/orderConfirmation.php'; 
    }
    
    public function ajaxUpdateCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $productId = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            $result = ['success' => false];
            
            if (isset($_SESSION['cart'][$productId])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$productId]['quantity'] = $quantity;
                    $subtotal = $quantity * $_SESSION['cart'][$productId]['price'];
                    $total = $this->calculateCartTotal($_SESSION['cart']);
                    
                    $result = [
                        'success' => true,
                        'subtotal' => $subtotal,
                        'total' => $total,
                        'formattedSubtotal' => number_format($subtotal, 0, ',', '.') . ' ₫',
                        'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                    ];
                } else {
                    unset($_SESSION['cart'][$productId]);
                    $total = $this->calculateCartTotal($_SESSION['cart']);
                    $result = [
                        'success' => true,
                        'removed' => true,
                        'total' => $total,
                        'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                    ];
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }

    public function search()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        
        $query = "SELECT p.*, c.name as category_name 
                 FROM product p 
                 LEFT JOIN category c ON p.category_id = c.id 
                 WHERE p.name LIKE :keyword 
                 OR p.description LIKE :keyword 
                 OR c.name LIKE :keyword";
                 
        $stmt = $this->db->prepare($query);
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        header('Content-Type: application/json');
        echo json_encode($products);
    }
}
?>
