<?php
namespace MyProject\Controllers;

// controllers/TaskController.php
include($_SERVER['DOCUMENT_ROOT'] . '/src/Models/TaskModel.php');
use MyProject\Models\TaskModel;
use PDO;
class TaskController {

    public function addTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $start_date = $_POST['start_date'];
            $due_date = $_POST['due_date'];
            $category_id = $_POST['category_id'];

            $taskModel = new TaskModel();

            if ($taskModel->addTask($name, $description, $start_date, $due_date, $category_id)) {
                echo "<div class ='Add_task__success'>Công việc đã được thêm thành công.</div>";
            } else {
                echo "<div class ='Add_task__error'>Đã xảy ra lỗi, vui lòng thử lại sau.</div>";
            }
        }
    }

    public function listForRange($offset, $limit) {
        $taskModel = new TaskModel();
        // Lấy danh sách công việc từ Model
        $tasks = $taskModel->getTasksForRange($offset, $limit);
        // Hiển thị trang danh sách công việc
        return $tasks;
    }

    public function list() {
        $taskModel = new TaskModel();
        // Lấy danh sách công việc từ Model
        $tasks = $taskModel->getAllTasks();
        // Hiển thị trang danh sách công việc
        return $tasks;
    }

    public function findForRange($keyword, $offset, $limit) {
        $taskModel = new TaskModel();
        // Lấy danh sách công việc từ Model
        $tasks = $taskModel->getTasksForKeywordAndRange($keyword, $offset, $limit);
        // Hiển thị trang danh sách công việc
        return $tasks;
    }

    public function count() {
        $taskModel = new TaskModel();
        // Lấy danh sách công việc từ Model
        $count = $taskModel->getCount();
        // Hiển thị trang danh sách công việc
        return $count;
    }

    public function countForKeyword($keyword) {
        $taskModel = new TaskModel();
        // Lấy danh sách công việc từ Model
        $count = $taskModel->getCountForKeyword($keyword);
        // Hiển thị trang danh sách công việc
        return $count;
    }

    public function detail($id) {
        $taskModel = new TaskModel();
        // Lấy thông tin chi tiết của công việc từ Model
        $task = $taskModel->getTaskById($id);
        // Hiển thị trang chi tiết công việc
        return $task;
    }

    public function update($id) {
        $taskModel = new TaskModel();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_task'])) {
            // Xử lý cập nhật thông tin công việc khi người dùng gửi form
            if ($taskModel->updateTask($id, $_POST)) {
                echo "<div class ='Update_task__success'>Công việc đã được chỉnh sửa thành công.</div>";
            } else {
                echo "<div class ='Update_task__error'>Đã xảy ra lỗi, vui lòng thử lại sau.</div>";
            }

        }
    }

    public function updateStatus($id, $status) {
        $taskModel = new TaskModel();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
            // Xử lý cập nhật thông tin công việc khi người dùng gửi form
            if ($taskModel->updateStatusTask($id, $status)) {
                echo "<div class ='Update_task__success'>Công việc đã được chỉnh sửa thành công.</div>";
            } else {
                echo "<div class ='Update_task__error'>Đã xảy ra lỗi, vui lòng thử lại sau.</div>";
            }

        }
    }

    public function delete($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_task'])){


            $taskModel = new TaskModel();

            if ($taskModel->deleteTask($id)) {
                echo "<div class ='Delete_task__success'>Công việc đã được xóa thành công.</div>";
            } else {
                echo "<div class ='Delete_task__error'>Đã xảy ra lỗi, vui lòng thử lại sau.</div>";
            }
        }
    }
}
?>
