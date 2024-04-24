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
        use MyProject\Controllers\TaskController;
        // Tạo đối tượng của CategoryController
        $taskController = new TaskController();

        // Gọi phương thức getAllCategories từ CategoryController để lấy danh sách các loại công việc
        $tasks = $taskController->list();
    ?>
    <div class="List_task">
        <?php include '../../Views/layout/header.php'; ?>
        <h2 class="List_task__title">Danh sách công việc</h2>
        <table class="List_task__list" cellspacing=0 cellpading=0>
            <thead>
                <tr class="Table__row">
                    <th class="Table__title--name_job">Tên công việc</th>
                    <th class="Table__title--action">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                <tr class="Table__row">
                    <td class="Task_name"><?php echo $task['name']; ?></td>
                    <td class="Task_action">
                        <!-- Thêm các nút hoặc liên kết hành động ở đây -->
                        <a class="Task_action--link" href="detail.php?id=<?php echo $task['id']; ?>">Xem chi tiết</a>
                        <a class="Task_action--link" href="update.php?id=<?php echo $task['id']; ?>">Chỉnh sửa</a>
                        <form class="Task_action--link" method="post">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" name="delete_task">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task_id = $_POST['task_id'];
            $taskController->delete($task_id);
        }
    ?>
</body>
</html>
