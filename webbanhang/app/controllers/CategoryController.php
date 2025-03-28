<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/Category/listCategory.php';
    }

    // Xóa danh mục
    public function delete_category($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /Category/index');
            exit;
        } else {
            echo "Đã xảy ra lỗi khi xóa danh mục.";
        }
    }

    // Cập nhật danh mục
    public function update_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên danh mục không được để trống';
            }
            if (empty($description)) {
                $errors['description'] = 'Mô tả không được để trống';
            }

            if (!empty($errors)) {
                $category = (object) ['id' => $id, 'name' => $name, 'description' => $description];
                include 'app/views/Category/editCategory.php';
            } else {
                if ($this->categoryModel->updateCategory($id, $name, $description)) {
                    header('Location: /Category/index');
                    exit;
                } else {
                    echo "Đã xảy ra lỗi khi cập nhật danh mục.";
                }
            }
        }
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit_category($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            echo "Danh mục không tồn tại.";
            return;
        }
        include 'app/views/Category/editCategory.php';
    }

    // Hiển thị form thêm danh mục
    public function add_category()
    {
        include 'app/views/Category/addCategory.php';
    }

    // Lưu danh mục mới
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên danh mục không được để trống';
            }
            if (empty($description)) {
                $errors['description'] = 'Mô tả không được để trống';
            }

            if (!empty($errors)) {
                include 'app/views/Category/addCategory.php';
            } else {
                if ($this->categoryModel->addCategory($name, $description)) {
                    header('Location: /Category/index');
                    exit;
                } else {
                    echo "Đã xảy ra lỗi khi lưu danh mục.";
                }
            }
        }
    }
}
?>