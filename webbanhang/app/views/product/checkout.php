<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-dark text-white text-center">
            <h1 class="h4 mb-0 fw-bold">Thanh Toán</h1>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="/Product/processCheckout">
                <!-- Họ tên -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Họ tên:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ và tên" required>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                </div>

                <!-- Địa chỉ -->
                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Địa chỉ:</label>
                    <textarea id="address" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" rows="3" required></textarea>
                </div>

                <!-- Nút Thanh toán -->
                <div class="d-flex justify-content-between">
                    <a href="/Product/cart" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i> Quay lại giỏ hàng
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-credit-card me-2"></i> Thanh toán ngay
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .card {
        border-radius: 20px;
        overflow: hidden;
    }

    .bg-gradient-dark {
        background: linear-gradient(90deg, #212529, #343a40);
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
        font-size: 1rem;
    }

    .btn-primary {
        background: #007bff;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 10px 20px;
    }

    .form-label {
        font-size: 1rem;
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>
