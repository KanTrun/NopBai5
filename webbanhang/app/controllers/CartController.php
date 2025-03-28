<?php

class CartController
{
    // Phương thức hiển thị giỏ hàng
    public function index()
    {
        // Lấy giỏ hàng từ session
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        
        // Hiển thị trang giỏ hàng với giỏ hàng
        include 'app/views/cart/index.php';
    }

    // Phương thức xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($productId)
    {
        // Kiểm tra nếu giỏ hàng có sản phẩm này
        if (isset($_SESSION['cart'][$productId])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$productId]);
            
            // Trả về JSON thành công khi dùng AJAX
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            // Trả về JSON lỗi nếu không tìm thấy sản phẩm
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
        }
        exit();
    }
}