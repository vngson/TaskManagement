<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        $category = $categoryController->categoryDetail($task["category_id"]);

    ?>
    <div class="Task_detail">
        <?php include '../../Views/layout/header.php'; ?>
        <h2 class="Task_detail__title">Chi tiết công việc</h2>
        <ul class="Task_detail__task">
            <li class="Task_detail__infor">Tên: <?php echo $task['name']; ?></li>
            <li class="Task_detail__infor">Mô tả: <?php echo $task['description']; ?></li>
            <li class="Task_detail__infor">Ngày bắt đầu: <?php echo $task['start_date']; ?></li>
            <li class="Task_detail__infor">Ngày kết thúc: <?php echo $task['due_date']; ?></li>
            <li class="Task_detail__infor">Loại công việc: <?php echo $category['name']; ?></li>
        </ul>
    </div>
</body>
</html>
