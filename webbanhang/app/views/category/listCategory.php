<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Danh sách danh mục</h2>
            <a href="/Category/add_category" class="btn btn-light">
                <i class="fas fa-plus"></i> Thêm danh mục mới
            </a>
        </div>
        <div class="card-body">
            <?php if (!empty($categories)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th width="200">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?php echo $category->id; ?></td>
                                    <td><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                        <a href="/Category/edit_category/<?php echo $category->id; ?>" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="/Category/delete_category/<?php echo $category->id; ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                            <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Không có danh mục nào.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-3">
        <a href="/" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại trang chủ
        </a>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.table th {
    background-color: #f8f9fa;
}

.btn {
    border-radius: 5px;
    margin: 0 2px;
}

.btn i {
    margin-right: 5px;
}
</style>

<?php include 'app/views/shares/footer.php'; ?>