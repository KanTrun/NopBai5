<?php include 'app/views/shares/header.php'; ?>

<?php if (!empty($cart)): ?>
<div class="container">
    <div class="row">
        <?php 
        $totalPrice = 0;
        foreach ($cart as $id => $item): 
            $itemTotal = $item['price'] * $item['quantity'];
            $totalPrice += $itemTotal;
        ?>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <?php if ($item['image']): ?>
                <img src="/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" 
                     class="card-img-top" 
                     alt="Product Image" 
                     style="height: 200px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    <p class="card-text">
                        Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                    </p>
                    <div class="input-group mb-3 quantity-control">
                        <button class="btn btn-outline-secondary decrease-quantity" 
                                type="button" 
                                data-id="<?php echo $id; ?>"
                                data-price="<?php echo $item['price']; ?>">-</button>
                        <input type="text" 
                               class="form-control text-center quantity" 
                               value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" 
                               readonly>
                        <button class="btn btn-outline-secondary increase-quantity" 
                                type="button" 
                                data-id="<?php echo $id; ?>"
                                data-price="<?php echo $item['price']; ?>">+</button>
                    </div>
                    <p class="item-total">
                        Tổng: <span class="item-total-amount"><?php echo number_format($itemTotal, 0, ',', '.'); ?></span> VND
                    </p>
                    <!-- Thêm nút Xóa sản phẩm -->
                    <div class="cart-actions">
                        <button class="btn btn-danger remove-item" 
                                data-id="<?php echo $id; ?>">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="row mt-4">
        <div class="col-12 text-end">
            <h4>Tổng tiền: <span id="cart-total"><?php echo number_format($totalPrice, 0, ',', '.'); ?></span> VND</h4>
        </div>
    </div>
    
    <div class="row mt-2">
        <div class="col-12 text-end">
            <a href="/Product" class="btn btn-secondary">Tiếp tục mua sắm</a>
            <a href="/Product/checkout" class="btn btn-primary">Thanh Toán</a>
        </div>
    </div>
</div>

<?php else: ?>
<p class="text-center">Giỏ hàng của bạn đang trống.</p>
<div class="text-center">
    <a href="/Product" class="btn btn-secondary">Tiếp tục mua sắm</a>
</div>
<?php endif; ?>

<?php include 'app/views/shares/footer.php'; ?>

<!-- Thêm CSS và JavaScript -->
<style>
.quantity-control {
    max-width: 150px;
    margin: 0 auto;
}

.quantity {
    max-width: 50px;
}

.card {
    transition: all 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.cart-actions {
    margin-top: 10px;
    text-align: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const decreaseButtons = document.querySelectorAll('.decrease-quantity');
    const increaseButtons = document.querySelectorAll('.increase-quantity');
    const removeButtons = document.querySelectorAll('.remove-item');
    
    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('.item-total-amount').forEach(amount => {
            total += parseInt(amount.textContent.replace(/\./g, ''));
        });
        document.getElementById('cart-total').textContent = 
            new Intl.NumberFormat('vi-VN').format(total);
    }

    // Hàm gửi dữ liệu cập nhật số lượng lên server
    function updateServer(productId, quantity) {
        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('quantity', quantity);

        fetch('/Product/ajaxUpdateCart', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật tổng tiền của sản phẩm
                const card = document.querySelector(`[data-id="${productId}"]`).closest('.card-body');
                const itemTotalElement = card.querySelector('.item-total-amount');
                itemTotalElement.textContent = data.formattedSubtotal;

                // Cập nhật tổng tiền giỏ hàng
                document.getElementById('cart-total').textContent = data.formattedTotal;

                if (data.removed) {
                    // Nếu số lượng = 0, xóa sản phẩm khỏi giao diện
                    card.closest('.col-md-4').remove();
                    if (document.querySelectorAll('.card').length === 0) {
                        window.location.reload();
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
        });
    }

    // Xử lý giảm số lượng
    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const quantityInput = this.nextElementSibling;
            let quantity = parseInt(quantityInput.value);
            
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                updateServer(id, quantity);
            }
        });
    });

    // Xử lý tăng số lượng
    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const quantityInput = this.previousElementSibling;
            let quantity = parseInt(quantityInput.value);
            
            quantity++;
            quantityInput.value = quantity;
            updateServer(id, quantity);
        });
    });

    // Xử lý xóa sản phẩm
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                const id = this.getAttribute('data-id');
                updateServer(id, 0); // Gửi số lượng 0 để xóa sản phẩm
            }
        });
    });
});
</script>