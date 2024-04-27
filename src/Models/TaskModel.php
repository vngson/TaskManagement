<?php
namespace MyProject\Models;
// models/TaskModel.php
include_once($_SERVER['DOCUMENT_ROOT'] . '/src/Config/database.php');
use MyProject\Config\Database;
use PDO;
use DateTime;
class TaskModel {
    private $db;

    public function __construct() {
        // Khởi tạo đối tượng Database
        $database = new Database();
        // Lấy kết nối CSDL
        $this->db = $database->getConnection();
    }

    public function addTask($name, $description, $start_date, $due_date, $category_id) {
        // Xử lý dữ liệu từ form
        $name = $name;
        $description = $description;
        $start_date = $start_date;
        $due_date = $due_date;
        $category_id = $category_id;

        // Câu lệnh SQL để thêm công việc vào CSDL
        $query = "INSERT INTO task SET name=:name, description=:description, start_date=:start_date, due_date=:due_date, category_id=:category_id, status='TODO'";
        $stmt = $this->db->prepare($query);

        // Bind các tham số và thực thi câu lệnh SQL
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":due_date", $due_date);
        $stmt->bindParam(":category_id", $category_id);

        // Thực hiện câu lệnh SQL và kiểm tra kết quả
        return $stmt->execute();
    }

    public function getAllTasks() {
        // Truy vấn CSDL để lấy danh sách công việc
        $query = "SELECT * FROM task";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tasks; // Trả về danh sách công việc
    }

    public function getTasksForRange($offset, $limit) {
        // Truy vấn CSDL để lấy danh sách công việc với giới hạn và vị trí bắt đầu
        $query = "SELECT * FROM task LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $tasks; // Trả về danh sách công việc
    }

    public function getTasksForKeywordAndRange($keyword, $offset, $limit) {
        $decoded_keyword = urldecode($keyword);
        // Truy vấn CSDL để lấy danh sách công việc
        $query = "SELECT DISTINCT * FROM task WHERE name LIKE :keyword OR description LIKE :keyword LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':keyword', '%' . $decoded_keyword . '%', PDO::PARAM_STR);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $tasks; // Trả về danh sách công việc
    }
    

    public function getCount() {
        // Truy vấn CSDL để lấy danh sách công việc
        $query = "SELECT COUNT(*) FROM task";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count; // Trả về danh sách công việc
    }

    public function getCountForKeyword($keyword) {
            
        $decoded_keyword = urldecode($keyword);
        // Truy vấn CSDL để lấy danh sách công việc
        $query = "SELECT  COUNT(*) FROM task WHERE name LIKE :keyword OR description LIKE :keyword";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['keyword' => '%' . $decoded_keyword . '%']);
        $count = $stmt->fetchColumn();

        return $count; // Trả về danh sách công việc
    }

    public function getTaskById($id) {
        // Truy vấn CSDL để lấy thông tin chi tiết của công việc dựa trên ID
        $query = "SELECT * FROM task WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        return $task; // Trả về thông tin chi tiết của công việc
    }

    public function updateTask($id, $data) {
        // Xử lý dữ liệu từ form
        $name = $data['name'];
        $description = $data['description'];
        $start_date = $data['start_date'];
        $due_date = $data['due_date'];
        $category_id = $data['category_id'];
        $status = $data['status'];


        // Câu lệnh SQL để cập nhật thông tin của công việc vào CSDL
        if(strtotime($data['finished_date']) > strtotime('0000-00-00 00:00:00')){
            $finished_date = $data['finished_date'];
            $query = "UPDATE task SET name=:name, description=:description, start_date=:start_date, due_date=:due_date, category_id=:category_id, finished_date=:finished_date, status='FINISHED' WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":finished_date", $finished_date);
        }else if($status !== 'FINISHED'){
            $query = "UPDATE task SET name=:name, description=:description, start_date=:start_date, due_date=:due_date, category_id=:category_id, status=:status WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":status", $status);
        }

        // Bind các tham số và thực thi câu lệnh SQL
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":start_date", $start_date);
        $stmt->bindParam(":due_date", $due_date);
        $stmt->bindParam(":category_id", $category_id);

        $stmt->bindParam(":id", $id);

        // Thực hiện câu lệnh SQL và kiểm tra kết quả
        if ($stmt->execute()) {
            return true; // Trả về true nếu cập nhật công việc thành công
        } else {
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }

    public function updateStatusTask($id, $status) {
        $status = $status;


        // Câu lệnh SQL để cập nhật thông tin của công việc vào CSDL
        $query = "UPDATE task SET status=:status WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind các tham số và thực thi câu lệnh SQL
        $stmt->bindParam(":status", $status);

        $stmt->bindParam(":id", $id);

        // Thực hiện câu lệnh SQL và kiểm tra kết quả
        if ($stmt->execute()) {
            return true; // Trả về true nếu cập nhật công việc thành công
        } else {
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }

    

    public function deleteTask($id) {
        // Câu lệnh SQL để xóa công việc dựa trên ID
        $query = "DELETE FROM task WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Bind tham số và thực thi câu lệnh SQL
        $stmt->bindParam(":id", $id);

        // Thực hiện câu lệnh SQL và kiểm tra kết quả
        if ($stmt->execute()) {
            return true; // Trả về true nếu xóa công việc thành công
        } else {
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }
}
?>
