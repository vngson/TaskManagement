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
    $category = $categoryController->categoryDetail($task["category_id"]);

    ?>
    <div class="Task_detail">
        <?php
        $namepage = "Chi tiết công việc";
        include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/layout/header.php');
        ?>
        <a href="/src/Views/task/list.php" class="Return_btn__wrapper">
            <button class="Return_btn">Trở về</button>
        </a>
        <h2 class="Task_detail__title">Chi tiết công việc</h2>
        <ul class="Task_detail__task">
            <li class="Task_detail__infor">Tên: <?php echo $task['name']; ?></li>
            <li class="Task_detail__infor">Mô tả: <?php echo $task['description']; ?></li>
            <li class="Task_detail__infor">Ngày bắt đầu: <?php echo $task['start_date']; ?></li>
            <li class="Task_detail__infor">Ngày kết thúc: <?php echo $task['due_date']; ?></li>
            <li class="Task_detail__infor">Loại công việc: <?php echo $category['name']; ?></li>
            <li class="Task_detail__infor">Ngày hoàn thành: <?php echo $task['finished_date']; ?></li>
            <li class="Task_detail__infor">Trạng thái: <?php
                                                        switch ($task['status']) {
                                                            case 'TODO':
                                                            case 'TO DO':
                                                                echo "Chưa làm";
                                                                break;
                                                            case 'IN PROGRESS':
                                                                echo "Đang làm";
                                                                break;
                                                            case 'FINISHED':
                                                                echo "Hoàn thành";
                                                                break;
                                                        }
                                                        ?></li>
        </ul>
    </div>
</body>

</html>