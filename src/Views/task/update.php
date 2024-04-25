<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
            <input class="Add_task__form--input" type="text" id="datetimepicker" name="start_date" value="<?php echo $task['start_date']; ?>">
            <label class="Add_task__form--label" for="task-due-date">Ngày kết thúc: </label>
            <input class="Add_task__form--input" type="text" id="task-due-date" name="due_date" value="<?php echo $task['due_date']; ?>">
            <label class="Add_task__form--label" for="category-id">Loại công việc: </label>
            <select class="Add_task__form--input" name="category_id" id="category-id">
                <?php foreach ($categories as $catelogy): ?>
                    <option value="<?php echo $catelogy['id']; ?>"><?php echo $catelogy['name']; ?></option>
                <?php endforeach; ?>
            </select>
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
    </body>
</body>
</html>
