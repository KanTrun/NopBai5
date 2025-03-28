<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductApiController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $db = new Database();
        $this->productModel = new ProductModel($db->getConnection());
        $this->categoryModel = new CategoryModel($db->getConnection());
    }

    public function index() {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }

    public function show($id) {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
        }
    }

    public function search() {
        header('Content-Type: application/json');
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $products = $this->productModel->searchProducts($keyword);
        echo json_encode($products);
    }

    public function delete($id) {
        header('Content-Type: application/json');
        if ($this->productModel->deleteProduct($id)) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete product']);
        }
    }

    public function create() {
        header('Content-Type: application/json');
        
        // Check if it's a POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        // Get POST data
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validate required fields
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['category_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            return;
        }

        // Handle image upload if present
        $image = null;
        if (isset($_FILES['image'])) {
            $uploadDir = 'uploads/products/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = time() . '_' . $_FILES['image']['name'];
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $targetPath;
            }
        }

        // Prepare product data
        $productData = [
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'description' => $data['description'] ?? '',
            'content' => $data['content'] ?? '',
            'image' => $image
        ];

        // Create product
        $productId = $this->productModel->createProduct($productData);
        
        if ($productId) {
            http_response_code(201);
            echo json_encode([
                'message' => 'Product created successfully',
                'product_id' => $productId
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create product']);
        }
    }

    public function store($id = null) {
        header('Content-Type: application/json');
        
        // Check if it's a POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        // Get POST data
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validate required fields
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['category_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            return;
        }

        // Handle image upload if present
        $image = null;
        if (isset($_FILES['image'])) {
            $uploadDir = 'uploads/products/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = time() . '_' . $_FILES['image']['name'];
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $targetPath;
            }
        }

        // Use ID from URL if available, otherwise use ID from request body
        $productId = $id ?? ($data['id'] ?? null);
        
        // Check if product with this ID already exists
        if ($productId) {
            $existingProduct = $this->productModel->getProductById($productId);
            if ($existingProduct) {
                http_response_code(400);
                echo json_encode(['error' => 'Product with this ID already exists']);
                return;
            }
        }

        // Create product using addProduct method
        $result = $this->productModel->addProduct(
            $data['name'],
            $data['description'] ?? '',
            $data['price'],
            $data['category_id'],
            $image,
            $productId
        );
        
        if ($result === true) {
            http_response_code(201);
            echo json_encode([
                'message' => 'Product created successfully',
                'product_id' => $productId
            ]);
        } else if (is_array($result)) {
            // Validation errors
            http_response_code(400);
            echo json_encode([
                'error' => 'Validation failed',
                'errors' => $result
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create product']);
        }
    }

    public function update($id) {
        header('Content-Type: application/json');
        
        // Check if it's a PUT request
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        // Get PUT data
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validate required fields
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['category_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            return;
        }

        // Handle image upload if present
        $image = null;
        if (isset($_FILES['image'])) {
            $uploadDir = 'uploads/products/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = time() . '_' . $_FILES['image']['name'];
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $targetPath;
            }
        }

        // Update product
        $result = $this->productModel->updateProduct(
            $id,
            $data['name'],
            $data['description'] ?? '',
            $data['price'],
            $data['category_id'],
            $image
        );
        
        if ($result === true) {
            http_response_code(200);
            echo json_encode([
                'message' => 'Product updated successfully'
            ]);
        } else if (is_array($result)) {
            // Validation errors
            http_response_code(400);
            echo json_encode([
                'error' => 'Validation failed',
                'errors' => $result
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update product']);
        }
    }

    public function destroy($id) {
        header('Content-Type: application/json');
        
        // Check if it's a DELETE request
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        // Check if product exists
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
            return;
        }

        // Delete product
        $result = $this->productModel->deleteProduct($id);
        
        if ($result) {
            http_response_code(200);
            echo json_encode([
                'message' => 'Product deleted successfully'
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete product']);
        }
    }
}
