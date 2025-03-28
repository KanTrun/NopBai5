<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <div class="card border-0 shadow-sm product-detail-card">
        <div class="card-body p-4 p-md-5">
            <?php if ($product): ?>
                <div class="row g-4 align-items-start">
                    <!-- Product Image Section -->
                    <div class="col-md-5 col-lg-4">
                        <div class="position-relative overflow-hidden rounded-3 shadow-sm image-container">
                            <?php if ($product->image): ?>
                                <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                     class="img-fluid w-100 object-fit-contain transition-scale hover-scale" 
                                     alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                                     style="max-height: 400px; height: 400px;">
                            <?php else: ?>
                                <div class="w-100 bg-light d-flex align-items-center justify-content-center"
                                     style="max-height: 400px; height: 400px;">
                                    <span class="text-muted fw-bold fs-4">Không có ảnh</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Thumbnails (nếu có nhiều ảnh) -->
                        <div class="d-flex gap-2 mt-3 justify-content-center flex-wrap">
                            <?php if ($product->image): ?>
                                <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                     class="thumbnail-img rounded border p-1" 
                                     alt="Thumbnail"
                                     style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Product Details Section -->
                    <div class="col-md-7 col-lg-8">
                        <h1 class="product-title mb-3 fw-bold text-dark">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </h1>

                        <!-- Price and Promotion -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <span class="price text-danger fw-bold display-6">
                                    <?php echo number_format($product->price, 0, ',', '.'); ?>₫
                                </span>
                                <?php if (!empty($product->discount)): ?>
                                    <span class="old-price text-muted text-decoration-line-through fs-5">
                                        <?php echo number_format($product->price + $product->discount, 0, ',', '.'); ?>₫
                                    </span>
                                    <span class="badge bg-danger text-white px-3 py-1">
                                        Giảm <?php echo number_format($product->discount, 0, ',', '.'); ?>₫
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <span class="stock-status text-success fw-semibold">
                                    <i class="fas fa-check-circle me-1"></i>Còn hàng
                                </span>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="short-desc bg-light p-3 rounded-3 mb-4">
                            <p class="text-dark mb-0 lh-base">
                                <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                            </p>
                        </div>

                        <!-- Category -->
                        <p class="mb-4">
                            <strong class="text-muted fs-5">Danh mục:</strong>
                            <span class="badge bg-primary text-white px-4 py-2 ms-2">
                                <?php echo !empty($product->category_name) ? 
                                    htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 
                                    'Chưa có danh mục'; ?>
                            </span>
                        </p>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="/Product/addToCart/<?php echo $product->id; ?>" 
                               class="btn btn-tgdd-primary btn-lg px-5 py-3 transition-all hover-shadow flex-grow-0">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                            </a>
                            <a href="/Product/buyNow/<?php echo $product->id; ?>" 
                               class="btn btn-tgdd-secondary btn-lg px-5 py-3 transition-all hover-shadow flex-grow-0">
                                <i class="fas fa-bolt me-2"></i>Mua ngay
                            </a>
                            <a href="/Product" 
                               class="btn btn-outline-secondary btn-lg px-4 py-3 transition-all hover-shadow">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại
                            </a>
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-4">
                            <span class="fw-semibold text-muted">Chia sẻ:</span>
                            <div class="d-flex gap-2 mt-2">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle share-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm rounded-circle share-btn">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle share-btn">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Full Description -->
                <div class="row mt-5">
                    <div class="col-12">
                        <h3 class="fw-bold mb-4">Thông tin chi tiết</h3>
                        <div class="bg-light p-4 rounded-3 shadow-sm">
                            <p class="text-dark lh-base">
                                <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger text-center py-5 my-4 rounded-3 shadow-sm">
                    <h4 class="alert-heading fw-bold mb-3">Không tìm thấy sản phẩm!</h4>
                    <p class="mb-4 fs-5">Vui lòng kiểm tra lại hoặc quay về danh sách sản phẩm.</p>
                    <a href="/Product/list" 
                       class="btn btn-outline-danger btn-lg px-5 py-2 transition-all hover-shadow">
                        Quay lại
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
/* Reset and Base Styles */
body {
    font-family: 'Roboto', sans-serif;
    line-height: 1.6;
}

.product-detail-card {
    border-radius: 12px;
    overflow: hidden;
}

/* Product Title */
.product-title {
    font-size: 1.8rem;
    line-height: 1.3;
    color: #333;
}

/* Image Container */
.image-container {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 10px;
}

.transition-scale {
    transition: transform 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.03);
}

.thumbnail-img {
    transition: all 0.3s ease;
}

.thumbnail-img:hover {
    border-color: #28a745;
    transform: scale(1.05);
}

/* Price and Promotion */
.price {
    font-size: 2.2rem;
    font-weight: 700;
    color: #d0021b;
}

.old-price {
    font-size: 1.2rem;
    color: #666;
}

.stock-status {
    font-size: 1rem;
}

/* Short Description */
.short-desc {
    border-left: 4px solid #28a745;
}

/* Buttons */
.btn-tgdd-primary {
    background: #28a745;
    border: none;
    color: white;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-tgdd-primary:hover {
    background: #218838;
    color: white;
}

.btn-tgdd-secondary {
    background: #d0021b;
    border: none;
    color: white;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(208, 2, 27, 0.3);
}

.btn-tgdd-secondary:hover {
    background: #b0021a;
    color: white;
}

.btn-outline-secondary {
    border-width: 2px;
    color: #333;
}

.btn-outline-secondary:hover {
    background: #f5f5f5;
    color: #333;
}

.transition-all {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

/* Share Buttons */
.share-btn {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.share-btn:hover {
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 767px) {
    .product-title {
        font-size: 1.5rem;
    }
    .price {
        font-size: 1.8rem;
    }
    .btn-lg {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
    .image-container img {
        height: 300px;
    }
}
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<?php include 'app/views/shares/footer.php'; ?>