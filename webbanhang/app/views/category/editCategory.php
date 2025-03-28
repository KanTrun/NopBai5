<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Chỉnh sửa danh mục</h2>
            <a href="/Category/index" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
        <div class="card-body">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="/Category/update_category" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Tên danh mục</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control form-control-lg" 
                           value="<?php echo htmlspecialchars($category->name ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                           required>
                    <div class="invalid-feedback">
                        Vui lòng nhập tên danh mục
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Mô tả</label>
                    <textarea id="description" 
                              name="description" 
                              class="form-control" 
                              rows="4" 
                              required><?php echo htmlspecialchars($category->description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <div class="invalid-feedback">
                        Vui lòng nhập mô tả
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="/Category/index" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    padding: 1rem 1.5rem;
}

.card-body {
    padding: 2rem;
}

.btn {
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
}

.btn i {
    margin-right: 5px;
}

.form-control {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-label {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #495057;
}

.invalid-feedback {
    font-size: 0.875rem;
}
</style>

<script>
// Script để kích hoạt validation của Bootstrap
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>

<?php include 'app/views/shares/footer.php'; ?>