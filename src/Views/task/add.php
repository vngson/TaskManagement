 
<?php
    
    
    include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/CategoryController.php');
    use MyProject\Controllers\CategoryController;
    // Tạo đối tượng của CategoryController
    $categoryController = new CategoryController();

    // Gọi phương thức getAllCategories từ CategoryController để lấy danh sách các loại công việc
    $categories = $categoryController->getAllCategories();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/public/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Add Task</title>

</head>
<body>

    <!-- Form thêm công việc -->
    <div class="Add_task">
        <?php
            $namepage = "Thêm công việc";
            include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/layout/header.php'); 
        ?>
        <a href="/public/index.php" class="Return_btn__wrapper">
            <button class="Return_btn">Trở về</button>
        </a>
        <h2 class="Add_task__title">Nhập thông tin công việc</h2>
        <form method="post" class="Add_task__form">
            <label class="Add_task__form--label" for="task-name">Tên công việc: </label>
            <input class="Add_task__form--input" type="text" id="task-name" name="name" placeholder="Nhập tên công việc">
            <label class="Add_task__form--label" for="task-description">Mô tả công việc: </label>
            <input class="Add_task__form--input" type="text" id="task-description" name="description" placeholder="Nhập mô tả">
            <label class="Add_task__form--label" for="task-start-date">Ngày bắt đầu: </label>
            <input class="Add_task__form--input" type="text" id="datetimepicker" name="start_date" placeholder="Nhập ngày bắt đầu">
            <label class="Add_task__form--label" for="task-due-date">Ngày kết thúc: </label>
            <input class="Add_task__form--input" type="text" id="task-due-date" name="due_date" placeholder="Nhập ngày kết thúc">
            <label class="Add_task__form--label" for="category-id">Loại công việc: </label>
            <!-- <input class="Add_task__form--input" type="text" id="category-id" name="category_id" placeholder="Nhập loại công việc"> -->
            <select class="Add_task__form--input" name="category_id" id="category-id">
                <?php foreach ($categories as $catelogy): ?>
                    <option value="<?php echo $catelogy['id']; ?>"><?php echo $catelogy['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="Add_task__form--button">Thêm công việc</button>
        </form>
    </div>

    <?php 
        include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/TaskController.php');
        use MyProject\Controllers\TaskController;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskController = new TaskController();
            $taskController->addTask();
        }
        // Xử lý dữ liệu khi người dùng gửi form
        // $name = $_POST['name'];
        // $description = $_POST['description'];
        // $start_date = date('Y-m-d', strtotime($_POST['start_date']));
        // $due_date = date('Y-m-d', strtotime($_POST['due_date']));
        // $category_id = $_POST['category_id'];

        // // Thực hiện thêm công việc vào CSDL
        // $query = "INSERT INTO task SET name=:name, description=:description, start_date=:start_date, due_date=:due_date, category_id=:category_id";
        // $stmt = $db->prepare($query);
        // $stmt->bindParam(":name", $name);
        // $stmt->bindParam(":description", $description);
        // $stmt->bindParam(":start_date", $start_date);
        // $stmt->bindParam(":due_date", $due_date);
        // $stmt->bindParam(":category_id", $category_id);

        // if ($stmt->execute()) {
        //     echo "<div class ='Add_task__success'>Công việc đã được thêm thành công.</div>";
        // } else {
        //     echo "<div class ='Add_task__error'>Đã xảy ra lỗi, vui lòng thử lại sau.</div>";
        // }
    ?>
    </body>
</html>