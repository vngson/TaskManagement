<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <!-- Các thẻ khác như link tới CSS, JavaScript, ... -->
</head>
<body>
    <?php
    // Include các file cần thiết
    include($_SERVER['DOCUMENT_ROOT'] . '/src/Config/database.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/TaskController.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/HomeController.php');
    use MyProject\Controllers\TaskController;

    // Lấy tên action từ URL (nếu có)
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';

    // Tạo một đối tượng TaskController
    $taskController = new TaskController();
    $homeController = new HomeController();


    // Điều hướng dựa trên action
    switch ($action) {
        case 'add_task':
            include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/task/add.php');
            break;
        // case 'list':
        //     $taskController->list();
        //     break;
        // case 'detail':
        //     // Lấy ID công việc từ URL
        //     $task_id = isset($_GET['id']) ? $_GET['id'] : die('ID công việc không được cung cấp.');
        //     $taskController->detail($task_id);
        //     break;
        // case 'update':
        //     // Lấy ID công việc từ URL
        //     $task_id = isset($_GET['id']) ? $_GET['id'] : die('ID công việc không được cung cấp.');
        //     $taskController->update($task_id);
        //     break;
        default:
            $homeController->index();
    }
    ?>
</body>
</html>
