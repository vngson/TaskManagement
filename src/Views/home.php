<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Các thẻ khác như link tới CSS, JavaScript, ... -->
</head>
<body>
    <div class="Home">
        <?php
            $namepage = "Trang chủ";
            include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/layout/header.php'); 
        ?>
        <div class="Home__content">
            <!-- <form class="Home__add_task" action="/src/Views/task/add.php" method="get">
                    <img src="/public/assets/images/add-task.png" alt="" class="add_task__img">
                    <button type="submit" class="add_task__btn">Thêm công việc mới</button>
            </form> -->
            <a href="/src/Views/task/add.php" class="Home__add_task">
                <img src="/public/assets/images/add-task.png" alt="" class="add_task__img">
                <h2 class="add_task__title">Thêm công việc mới</h2>
            </a>
            <a href="/src/Views/task/list.php" class="Home__list_task">
                <img src="/public/assets/images/survey.png" alt="" class="list_task__img">
                <h2 class="list_task__title">Xem danh sách công việc</h2>
            </a>
            <!-- <form method="get"  action="/src/Views/task/list.php" class="Home__list_task">
                <img src="/public/assets/images/survey.png" alt="" class="list_task__img">
                <button type="submit" class="list_task__btn">Xem danh sách công việc</button>
            </form> -->
            <!-- <a href="/src/Views/task/update.php" class="Home__update_task">
                <img src="/public/assets/images/repair.png" alt="" class="update_task__img">
                <h2 class="update_task__title">Cập nhật công việc</h2>
            </a> -->
        </div>
    </div>
</body>
</html>
