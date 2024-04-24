<?php
namespace MyProject\Models;

include_once($_SERVER['DOCUMENT_ROOT'] . '/src/Config/database.php');
use MyProject\Config\Database;
use PDO;
class CategoryModel {
    private $db;

    public function __construct() {
        // Khởi tạo đối tượng Database
        $database = new Database();
        // Lấy kết nối CSDL
        $this->db = $database->getConnection();
    }

    public function getAllCategories() {
        
        $query = "SELECT id, name FROM category";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        // Truy vấn CSDL để lấy thông tin chi tiết của công việc dựa trên ID
        $query = "SELECT * FROM category WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category; // Trả về thông tin chi tiết của công việc
    }

    public function addCategory($data) {
        // Thêm danh mục vào CSDL
    }

    public function updateCategory($id, $data) {
        // Cập nhật thông tin danh mục dựa trên ID
    }

    public function deleteCategory($id) {
        // Xoá danh mục dựa trên ID
    }
}
?>
