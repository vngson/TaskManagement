<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bao gồm các tập tin CSS của Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bao gồm các tập tin CSS của DateTimePicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">
    <title>List task</title>
</head>
<body>   
    <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/TaskController.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/CategoryController.php');

        use MyProject\Controllers\TaskController;
        use MyProject\Controllers\CategoryController;

        // require_once __DIR__ . '/vendor/autoload.php';
        // Lấy id của task từ URL
        $id = $_GET['id'] ?? null;

        // Gọi phương thức hiển thị chi tiết task từ controller
        $taskController = new TaskController();
        $task = $taskController->detail($id);

        $categoryController = new CategoryController();
        // Gọi phương thức getAllCategories từ CategoryController để lấy danh sách các loại công việc
        $categories = $categoryController->getAllCategories();

        $statuses = array(
            "TODO" => "Chưa làm",
            "IN PROGRESS" => "Đang làm",
            "FINISHED" => "Hoàn thành"
        );

    ?>
    <div class="Task_detail">
        <?php
            $namepage = "Cập nhật công việc";
            include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/layout/header.php'); 
        ?>
        <a href="/src/Views/task/list.php" class="Return_btn__wrapper">
            <button class="Return_btn">Trở về</button>
        </a>
        <h2 class="Task_detail__title">Chỉnh sửa thông tin công việc</h2>
        <form method="post" class="Add_task__form">
            <label class="Add_task__form--label" for="task-name">Tên công việc: </label>
            <input class="Add_task__form--input" type="text" id="task-name" name="name" value="<?php echo $task['name']; ?>">
            <label class="Add_task__form--label" for="task-description">Mô tả công việc: </label>
            <input class="Add_task__form--input" type="text" id="task-description" name="description" value="<?php echo $task['description']; ?>">
            <label class="Add_task__form--label" for="task-start-date">Ngày bắt đầu: </label>
            <?php echo '<input class="Add_task__form--input" id="task-start-date" type="datetime-local" name="start_date" value="' . $task["start_date"]. '">'; ?>
            <label class="Add_task__form--label" for="task-due-date">Ngày kết thúc: </label>
            <?php echo '<input class="Add_task__form--input" id="task-due-date" type="datetime-local" name="due_date" value="' . $task["due_date"]. '">'; ?>
            <label class="Add_task__form--label" for="category-id">Loại công việc: </label>
            <select class="Add_task__form--input" name="category_id" id="category-id">
                <?php foreach ($categories as $catelogy): ?>
                    <option value="<?php echo $catelogy['id']; ?>"><?php echo $catelogy['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label class="Add_task__form--label" for="task-finish-date">Ngày hoàn thành: </label>
            <?php echo '<input class="Add_task__form--input" id="task-due-date" type="datetime-local" name="finished_date" value="' . $task["finished_date"]. '">'; ?>
            <label class="Add_task__form--label" for="task-status">Trạng thái: </label>
            <select class="Add_task__form--input" name="status_<?php echo $task['id']; ?>" id="task-status">
                <option value="TODO" <?php echo $task['status'] === 'TODO' ? 'selected' : ''; ?>>Chưa làm</option>
                <option value="IN PROGRESS" <?php echo $task['status'] === 'IN PROGRESS' ? 'selected' : ''; ?>>Đang làm</option>
                <option value="FINISHED" <?php echo $task['status'] === 'FINISHED' ? 'selected' : ''; ?>>Hoàn thành</option>
            </select>
            <!-- <input class="Add_task__form--input" type="text" id="task-due-date" name="due_date" value="<?php echo $task['status']; ?>"> -->
            <button type="submit"  name="update_task" class="Add_task__form--button">Xác nhận</button>
        </form>
    </div>
    
    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskController->update($id);
            echo "<script>
                setTimeout(function() {
                    location.href = '/src/Views/task/list.php';
                }, 1000);
            </script>";
            exit;
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
    $(document).ready(function(){
        $('.datetimepicker').datepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        autoclose: true
        });
    });
    </script>
    </body>
</body>
</html>
