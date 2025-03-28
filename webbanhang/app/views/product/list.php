<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="banner mb-5">
        <div class="card border-0 shadow-lg overflow-hidden position-relative">
            <div class="row g-0 align-items-center">
                <div class="col-md-6 order-md-1 order-2">
                    <div class="card-body p-5 text-center text-md-start">
                        <h1 class="display-5 fw-bold text-dark mb-3 animate__animated animate__fadeIn">
                            Khám Phá Công Nghệ Đỉnh Cao Nhất Thế Giới
                        </h1>
                        <p class="lead text-muted mb-4 animate__animated animate__fadeIn animate__delay-1s">
                            Điện thoại, laptop và phụ kiện hiện đại với giá tốt nhất - 
                            chất lượng vượt trội, dịch vụ tận tâm!
                        </p>
                        <a href="/Product/" 
                           class="btn btn-primary btn-lg px-5 py-3 transition-all animate__animated animate__fadeIn animate__delay-2s">
                            <i class="fas fa-shopping-cart me-2"></i>Khám Phá Ngay
                        </a>
                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-1">
                    <img src="https://file3.qdnd.vn/data/images/0/2024/02/10/upload_2301/gia-vang-the-gioi-10-2.jpg?dpi=150&quality=100&w=870" 
                         class="img-fluid w-100 banner-img" 
                         alt="Tech Products"
                         style="height: 400px; object-fit: cover;">
                </div>
            </div>
            <div class="banner-overlay"></div>
        </div>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center py-2">
                <h2 class="h4 mb-0">Danh sách sản phẩm</h2>
                <a href="/Product/add" class="btn btn-light">
                    <i class="fas fa-plus"></i> Thêm sản phẩm
                </a>
            </div>
            
            <!-- Search Form -->
            <div class="search-form bg-white p-3 mt-3 rounded-3">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-start-0" 
                           placeholder="Tìm kiếm theo tên sản phẩm, mô tả hoặc danh mục...">
                    <button class="btn btn-outline-secondary border-start-0 d-none" type="button" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- Loading Spinner -->
            <div id="loadingSpinner" class="text-center py-5 d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Đang tải...</span>
                </div>
                <p class="mt-2 text-muted">Đang tìm kiếm sản phẩm...</p>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-5 d-none">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <p class="h5 text-muted">Không tìm thấy sản phẩm nào</p>
            </div>

            <div class="row g-4 p-4" id="product-list">
                <!-- Products will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const productList = document.getElementById('product-list');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const noResults = document.getElementById('noResults');

    // Function to show loading state
    function showLoading() {
        loadingSpinner.classList.remove('d-none');
        productList.classList.add('d-none');
        noResults.classList.add('d-none');
    }

    // Function to render products
    function renderProducts(products) {
        productList.innerHTML = '';
        loadingSpinner.classList.add('d-none');
        
        if (products.length === 0) {
            noResults.classList.remove('d-none');
            productList.classList.add('d-none');
            return;
        }

        noResults.classList.add('d-none');
        productList.classList.remove('d-none');

        products.forEach(product => {
            const productItem = document.createElement('div');
            productItem.className = 'col-12 col-sm-6 col-md-4 col-lg-3';
            productItem.innerHTML = `
                <div class="card h-100 border-0 shadow-sm hover-card product-card">
                    <div class="position-relative">
                        ${product.image ? 
                            `<img src="/${product.image}" class="card-img-top" alt="${product.name}" style="height: 200px; object-fit: cover;">` :
                            `<div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>`
                        }
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-primary">${product.category_name || 'Chưa phân loại'}</span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2">
                            <a href="/Product/show/${product.id}" class="text-decoration-none text-dark product-name">
                                ${product.name}
                            </a>
                        </h5>
                        <div class="product-content mb-3">
                            <p class="text-muted small content-text">${product.content || 'Chưa có nội dung chi tiết'}</p>
                        </div>
                        <p class="card-text text-muted small flex-grow-1">${product.description}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-danger fw-bold h5 mb-0">
                                    ${new Intl.NumberFormat('vi-VN').format(product.price)} VND
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="btn-group w-100">
                                    <a href="/Product/edit/${product.id}" class="btn btn-outline-warning btn-sm" title="Sửa sản phẩm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm" onclick="deleteProduct(${product.id})" title="Xóa sản phẩm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a href="/Product/addToCart/${product.id}" class="btn btn-primary btn-sm flex-grow-1" title="Thêm vào giỏ hàng">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            productList.appendChild(productItem);
        });
    }

    // Function to perform search
    const debounce = (fn, delay) => {
        let timeoutId;
        return function (...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => fn.apply(this, args), delay);
        };
    };

    async function performSearch() {
        const keyword = searchInput.value.trim();
        clearSearch.classList.toggle('d-none', !keyword);

        showLoading();

        try {
            const response = await fetch(`/Product/search?keyword=${encodeURIComponent(keyword)}`);
            const products = await response.json();
            renderProducts(products);
        } catch (error) {
            console.error('Error:', error);
            productList.innerHTML = '<div class="text-center p-4 text-danger">Có lỗi xảy ra khi tìm kiếm</div>';
            loadingSpinner.classList.add('d-none');
        }
    }

    // Initial load
    performSearch();

    // Search input event handler
    searchInput.addEventListener('input', debounce(performSearch, 300));

    // Clear search button handler
    clearSearch.addEventListener('click', () => {
        searchInput.value = '';
        performSearch();
    });
});

// Global function for deleting products
function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        fetch(`/Product/delete/${id}`, {
            method: 'GET'
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Xóa sản phẩm thất bại');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa sản phẩm');
        });
    }
}
</script>

<style>
.card {
    border-radius: 15px;
    overflow: hidden;
}

.search-form {
    transition: all 0.3s ease;
}

.search-form:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.form-control {
    border-radius: 8px;
}

.form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}

.input-group-text {
    background-color: transparent;
}

.product-card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.product-name {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 48px;
}

.card-text {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 60px;
}

.btn-group .btn {
    padding: 0.5rem;
    border-radius: 6px !important;
    margin: 0 1px;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
}

/* Animation for loading and transitions */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.product-card {
    animation: fadeIn 0.3s ease;
}

.banner .card {
    background: linear-gradient(135deg, #ffffff, #f1f3f5);
}

.banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0, 123, 255, 0.1), transparent);
    pointer-events: none;
}

.btn-primary {
    background: #007bff;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.content-text {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 60px;
    line-height: 1.5;
    margin-bottom: 0;
}

.product-content {
    border-left: 3px solid #007bff;
    padding-left: 10px;
    margin: 10px 0;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?php include 'app/views/shares/footer.php'; ?>
