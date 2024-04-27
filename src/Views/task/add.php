 
<?php
    
    
    include($_SERVER['DOCUMENT_ROOT'] . '/src/Controllers/CategoryController.php');
    use MyProject\Controllers\CategoryController;
    // Tạo đối tượng của CategoryController
    $categoryController = new CategoryController();

    // Gọi phương thức getAllCategories từ CategoryController để lấy danh sách các loại công việc
    $categories = $categoryController->getAllCategories();

?>

<?php
    // Create a new date object
    $date = new DateTime();

    // Format the date object in the desired format
    $date_formatted = $date->format('Y-m-d H:i:s');
?>

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
            <?php echo '<input class="Add_task__form--input" id="task-start-date" type="datetime-local" name="start_date" value="' . $date_formatted . '">'; ?>
            <!-- <div class="input-group date" id="datetimepicker-start" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-start" name="start_date"/>
                <div class="input-group-append" data-target="#datetimepicker-start" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div> -->
            <label class="Add_task__form--label" for="task-due-date">Ngày kết thúc: </label>
            <?php echo '<input class="Add_task__form--input" id="task-due-date" type="datetime-local" name="due_date" value="' . $date_formatted . '">'; ?>
            <!-- <div class="input-group date" id="datetimepicker-end" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-end" name="due_date"/>
                <div class="input-group-append" data-target="#datetimepicker-end" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            <input type="text" class="form-control datetimepicker" id="datetimepicker" name="datetime"> -->
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
            echo "<script>
                setTimeout(function() {
                    location.href = '/public/index.php';
                }, 1000);
            </script>";
            exit;
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

    <script src="/public/js/script.js"></script>

    </body>
</html>