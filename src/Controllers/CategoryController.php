<?php
namespace MyProject\Controllers;

include($_SERVER['DOCUMENT_ROOT'] . '/src/Models/CategoryModel.php');
use MyProject\Models\CategoryModel;
use PDO;

class CategoryController {

    public function getAllCategories() {
        $categoryModel = new CategoryModel();
        return $categoryModel->getAllCategories();
    }
    

    public function categoryDetail($id) {
        $categoryModel = new CategoryModel();
        // Lấy thông tin chi tiết của công việc từ Model
        $category = $categoryModel->getCategoryById($id);
        // Hiển thị trang chi tiết công việc
        return $category;
    }
}
?>
