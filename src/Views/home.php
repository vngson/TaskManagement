<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- Các thẻ khác như link tới CSS, JavaScript, ... -->
</head>
<body>
    <div class="Home">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/layout/header.php'); ?>
        <div class="Home__content">
            <form class="Home__add_task" action="/src/Views/task/add.php" method="get">
                    <img src="/public/assets/images/add-task.png" alt="" class="add_task__img">
                    <button type="submit" class="add_task__btn">Thêm công việc mới</button>
            </form>
            <!-- <a href="/add_task" class="Home__add_task">
                <img src="/public/assets/images/add-task.png" alt="" class="add_task__img">
                <h2 class="add_task__title">Thêm công việc mới</h2>
            </a> -->
            <form method="get"  action="/src/Views/task/list.php" class="Home__list_task">
                <img src="/public/assets/images/survey.png" alt="" class="list_task__img">
                <button type="submit" class="list_task__btn">Xem danh sách công việc</button>
            </form>
            <!-- <a href="/src/Views/task/update.php" class="Home__update_task">
                <img src="/public/assets/images/repair.png" alt="" class="update_task__img">
                <h2 class="update_task__title">Cập nhật công việc</h2>
            </a> -->
        </div>
    </div>
</body>
</html>
