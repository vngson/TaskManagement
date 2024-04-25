<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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

    <script src="/public/js/script.js"></script>
</body>
</html>
