<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-black d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Thêm sản phẩm mới</h1>
            <a href="/Product" class="btn btn-outline-dark btn-sm">Quay lại</a>
        </div>
        <div class="card-body p-4 bg-dark text-white">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form id="add-product-form" method="POST" action="/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Tên sản phẩm" required>
                            <label for="name">Tên sản phẩm</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="price" name="price" class="form-control" 
                                   placeholder="Giá" required 
                                   pattern="[0-9,]*"
                                   title="Vui lòng chỉ nhập số"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <label for="price">Giá (VNĐ)</label>
                            <div class="form-text">Chỉ nhập số, không nhập dấu chấm hoặc phẩy</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea id="description" name="description" class="form-control" placeholder="Mô tả" style="height: 100px" required></textarea>
                            <label for="description">Mô tả sản phẩm</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="" selected disabled>Chọn danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>">
                                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="category_id">Danh mục</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-warning text-black">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS tối ưu và thêm hiệu ứng -->
<style>
body {
    background-color: #f8f9fa;
}

.card {
    border-radius: 12px;
    overflow: hidden;
    background-color: #000;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.card-header {
    padding: 1rem;
    background-color: #FFC107;
    color: #000;
    border-bottom: none;
}

.card-body {
    background-color: #212529;
    color: #fff;
    padding: 1.5rem !important;
}

.form-control, .form-select {
    border-radius: 8px;
    padding: 0.75rem;
    background-color: #fff;
    color: #000;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 8px rgba(255, 193, 7, 0.5);
    border-color: #FFC107;
    transform: scale(1.01);
}

.form-floating label {
    padding-left: 1rem;
    color: #666;
    transition: all 0.3s ease;
}

.form-floating input:focus ~ label,
.form-floating textarea:focus ~ label,
.form-floating select:focus ~ label {
    color: #FFC107;
}

.btn-warning {
    background-color: #FFC107;
    border-color: #FFC107;
    color: #000;
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-warning:hover {
    background-color: #e0a800;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(224, 168, 0, 0.4);
}

.btn-outline-dark {
    border-color: #000;
    color: #000;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-dark:hover {
    background-color: #000;
    color: #fff;
    transform: translateY(-2px);
}

.alert {
    border-radius: 8px;
    background-color: #dc3545;
    color: #fff;
    margin-bottom: 1.5rem;
    opacity: 0;
    animation: fadeIn 0.5s ease forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-group label {
    color: #fff;
    margin-bottom: 0.5rem;
}
</style>

<!-- JavaScript thêm hiệu ứng -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hiệu ứng khi click vào button
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            const x = e.clientX - this.getBoundingClientRect().left;
            const y = e.clientY - this.getBoundingClientRect().top;
            
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Hiệu ứng khi focus vào input
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Validate form
    window.validateForm = function() {
        let isValid = true;
        const name = document.getElementById('name').value.trim();
        const price = document.getElementById('price').value.trim();
        const description = document.getElementById('description').value.trim();
        const category = document.getElementById('category_id').value;
        const image = document.getElementById('image').value;

        // Validate name
        if (name.length < 3) {
            alert('Tên sản phẩm phải có ít nhất 3 ký tự');
            isValid = false;
        }

        // Validate price
        if (!price || price <= 0) {
            alert('Giá sản phẩm phải lớn hơn 0');
            isValid = false;
        }

        // Validate description
        if (description.length < 10) {
            alert('Mô tả sản phẩm phải có ít nhất 10 ký tự');
            isValid = false;
        }

        // Validate category
        if (!category) {
            alert('Vui lòng chọn danh mục');
            isValid = false;
        }

        // Validate image if uploaded
        if (image) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const fileInput = document.getElementById('image');
            const file = fileInput.files[0];
            
            if (!allowedTypes.includes(file.type)) {
                alert('Chỉ chấp nhận file ảnh định dạng JPG, PNG hoặc GIF');
                isValid = false;
            }
            
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert('Kích thước file không được vượt quá 5MB');
                isValid = false;
            }
        }

        return isValid;
    };

    // Preview image before upload
    const imageInput = document.getElementById('image');
    imageInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Fetch categories
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
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            alert('Không thể tải danh mục sản phẩm');
        });

    // Handle form submission
    document.getElementById('add-product-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('/Product/save', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.href = '/Product';
            } else {
                alert(data.message || 'Thêm sản phẩm thất bại');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi thêm sản phẩm');
        });
    });
});
</script>

<!-- CSS cho hiệu ứng ripple -->
<style>
.ripple {
    position: absolute;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    width: 10px;
    height: 10px;
    animation: rippleEffect 0.6s ease-out;
    pointer-events: none;
    transform: translate(-50%, -50%);
}

@keyframes rippleEffect {
    to {
        transform: translate(-50%, -50%) scale(20);
        opacity: 0;
    }
}

.form-floating.focused label {
    color: #FFC107;
    transform: scale(0.85) translateY(-1.5rem);
}
</style>

<?php include 'app/views/shares/footer.php'; ?>