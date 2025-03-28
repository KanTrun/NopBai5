<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 product-edit-card">
        <div class="card-header bg-tgdd-primary text-dark text-center py-4">
            <h1 class="h4 mb-0 fw-bold">Sửa sản phẩm</h1>
        </div>
        <div class="card-body p-4 p-md-5">
            <!-- Hiển thị thông báo lỗi -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Form chỉnh sửa sản phẩm -->
            <form method="POST" action="/Product/update" enctype="multipart/form-data" id="productEditForm" onsubmit="return validateForm();">
                <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                <div class="row g-4">
                    <!-- Tên sản phẩm -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="name" name="name" class="form-control" 
                                   value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                   placeholder="Tên sản phẩm" required>
                            <label for="name">Tên sản phẩm</label>
                        </div>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="price" name="price" class="form-control" 
                                   value="<?php echo number_format($product->price, 0, ',', '.'); ?>" 
                                   placeholder="Giá" required>
                            <label for="price">Giá (VNĐ)</label>
                        </div>
                    </div>

                    <!-- Mô tả sản phẩm -->
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea id="description" name="description" class="form-control" 
                                      placeholder="Mô tả sản phẩm" style="height: 150px" required><?php 
                                      echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                            <label for="description">Mô tả sản phẩm</label>
                        </div>
                    </div>

                    <!-- Danh mục -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="" disabled>Chọn danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>" 
                                            <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="category_id">Danh mục</label>
                        </div>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" class="form-label fw-semibold">Hình ảnh sản phẩm</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                            <?php if ($product->image): ?>
                                <div class="mt-3 position-relative image-preview">
                                    <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                         alt="Product Image" class="img-thumbnail" style="max-width: 200px;">
                                    <button type="button" class="btn btn-sm btn-danger remove-image position-absolute top-0 end-0">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="mt-2 image-preview-placeholder d-none">
                                <img src="" alt="Image Preview" class="img-thumbnail" style="max-width: 200px;">
                                <button type="button" class="btn btn-sm btn-danger remove-image position-absolute top-0 end-0">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="col-12 mt-5 text-end">
                        <button type="submit" class="btn btn-tgdd-primary btn-lg me-2 px-5 py-3">
                            <i class="fas fa-save me-2"></i>Lưu thay đổi
                        </button>
                        <a href="/Product" class="btn btn-outline-secondary btn-lg px-5 py-3">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Thêm CSS tùy chỉnh -->
<style>
/* Base Styles */
body {
    font-family: 'Roboto', sans-serif;
    line-height: 1.6;
    background-color: #f5f5f5;
}

.product-edit-card {
    border-radius: 15px;
    overflow: hidden;
}

.bg-tgdd-primary {
    background: #f5f5f5; /* Đổi nền thành màu xám nhạt để chữ đen nổi bật */
    border-bottom: 3px solid #e0e0e0;
}

.text-dark {
    color: #333 !important; /* Đảm bảo chữ màu đen đậm */
}

/* Form Elements */
.form-control, .form-select {
    border-radius: 8px;
    padding: 0.75rem;
    border: 1px solid #ced4da;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.form-floating label {
    padding-left: 1rem;
    color: #666;
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #d0021b;
}

.invalid-feedback {
    font-size: 0.875rem;
    color: #d0021b;
}

/* Image Preview */
.image-preview, .image-preview-placeholder {
    position: relative;
    display: inline-block;
}

.img-thumbnail {
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.img-thumbnail:hover {
    transform: scale(1.05);
}

.remove-image {
    padding: 5px;
    line-height: 1;
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

.btn-outline-secondary {
    border-width: 2px;
    color: #333;
    font-weight: 500;
}

.btn-outline-secondary:hover {
    background: #f5f5f5;
    color: #333;
}

/* Alerts */
.alert {
    border-radius: 10px;
    border-left: 5px solid #d0021b;
}

/* Responsive */
@media (max-width: 767px) {
    .card-body {
        padding: 2rem !important;
    }
    .btn-lg {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
}
</style>

<!-- Thêm JavaScript để xử lý validation và preview hình ảnh -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('productEditForm');
    
    // Validation form
    window.validateForm = function () {
        let isValid = true;
        const priceInput = document.getElementById('price');
        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const categoryInput = document.getElementById('category_id');

        // Xóa trạng thái lỗi cũ
        [priceInput, nameInput, descriptionInput, categoryInput].forEach(input => {
            input.classList.remove('is-invalid');
            const feedback = input.nextElementSibling?.classList.contains('invalid-feedback') 
                            ? input.nextElementSibling : null;
            if (feedback) feedback.remove();
        });

        // Kiểm tra tên
        if (nameInput.value.trim().length < 3) {
            isValid = false;
            nameInput.classList.add('is-invalid');
            nameInput.insertAdjacentHTML('afterend', 
                '<div class="invalid-feedback">Tên sản phẩm phải có ít nhất 3 ký tự.</div>');
        }

        // Kiểm tra giá
        if (priceInput.value <= 0) {
            isValid = false;
            priceInput.classList.add('is-invalid');
            priceInput.insertAdjacentHTML('afterend', 
                '<div class="invalid-feedback">Giá phải lớn hơn 0.</div>');
        }

        // Kiểm tra mô tả
        if (descriptionInput.value.trim().length < 10) {
            isValid = false;
            descriptionInput.classList.add('is-invalid');
            descriptionInput.insertAdjacentHTML('afterend', 
                '<div class="invalid-feedback">Mô tả phải có ít nhất 10 ký tự.</div>');
        }

        // Kiểm tra danh mục
        if (!categoryInput.value) {
            isValid = false;
            categoryInput.classList.add('is-invalid');
            categoryInput.insertAdjacentHTML('afterend', 
                '<div class="invalid-feedback">Vui lòng chọn danh mục.</div>');
        }

        return isValid;
    };
    
    // Xử lý preview ảnh
    const imageInput = document.getElementById('image');
    const imagePreviewPlaceholder = document.querySelector('.image-preview-placeholder');
    const existingImagePreview = document.querySelector('.image-preview');
    
    imageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                if (existingImagePreview) {
                    existingImagePreview.classList.add('d-none');
                }
                imagePreviewPlaceholder.querySelector('img').src = event.target.result;
                imagePreviewPlaceholder.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Xử lý xóa ảnh
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function () {
            const preview = this.closest('.image-preview') || this.closest('.image-preview-placeholder');
            preview.classList.add('d-none');
            imageInput.value = '';
            if (preview === existingImagePreview) {
                document.querySelector('input[name="existing_image"]').value = '';
            }
        });
    });

    // Xử lý submit form
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Validate form trước khi submit
        if (!validateForm()) {
            return;
        }

        // Xử lý giá trị giá trước khi submit
        const priceInput = document.getElementById('price');
        const price = priceInput.value.replace(/[^\d]/g, ''); // Loại bỏ tất cả ký tự không phải số
        priceInput.value = price;

        // Submit form
        this.submit();
    });
});

document.addEventListener("DOMContentLoaded", function() {
// const urlParams = new URLSearchParams(window.location.search);
const productId = <?= $editId ?>;
fetch(`/api/product/${productId}`)
.then(response => response.json())
.then(data => {
document.getElementById('id').value = data.id;
document.getElementById('name').value = data.name;
document.getElementById('description').value = data.description;
document.getElementById('price').value = data.price;
document.getElementById('category_id').value = data.category_id;
});
fetch('/api/category')
.then(response => response.json())
.then(data => {
const categorySelect = document.getElementById('category_id');
data.forEach(category => {
const option = document.createElement('option');
option.value = category.id;
option.textContent = category.name;
categorySelect.appendChild(option);
});
});
document.getElementById('edit-product-form').addEventListener('submit',
function(event) {
    event.preventDefault();
const formData = new FormData(this);
const jsonData = {};
formData.forEach((value, key) => {
jsonData[key] = value;
});
fetch(`/api/product/${jsonData.id}`, {
method: 'PUT',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify(jsonData)
})
.then(response => response.json())
.then(data => {
if (data.message === 'Product updated successfully') {
location.href = '/Product';
} else {
alert('Cập nhật sản phẩm thất bại');
}
});
});
});

</script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<?php include 'app/views/shares/footer.php'; ?>