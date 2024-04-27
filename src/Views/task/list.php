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

    use MyProject\Controllers\TaskController;
    // Tạo đối tượng của TaskController
    $taskController = new TaskController();
    $keyword = $_GET['keyword'] ?? null;

    // Số lượng công việc trên mỗi trang
    $per_page = 10;

    // Lấy trang hiện tại từ tham số URL (nếu không có thì mặc định là trang 1)
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($keyword)
    {
        $tasks = $taskController->findForRange($keyword, ($current_page - 1) * $per_page, $per_page);
        // Tổng số công việc
        $total_tasks = $taskController->countForKeyword($keyword);
    }
    else{
        // Lấy danh sách công việc cho trang hiện tại
        $tasks = $taskController->listForRange(($current_page - 1) * $per_page, $per_page);
        // Tổng số công việc
        $total_tasks = $taskController->count();
    }

    $total_tasks = intval($total_tasks);
    $per_page = intval($per_page);

    // Tính toán tổng số trang
    if ($total_tasks < $per_page) {
        $total_pages = 1;
    } else {
        $total_pages =  ceil($total_tasks / $per_page);
    }
    ?>
    <div class="List_task">
        <?php
        $namepage = "Danh sách công việc";
        include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/layout/header.php');
        ?>
        <a href="/public/index.php" class="Return_btn__wrapper">
            <button class="Return_btn">Trở về</button>
        </a>
        <h2 class="List_task__title">Danh sách công việc</h2>
        <div class="container">
            <div class="search_filter">
                <form method="post" class="search">
                    <div class="input-group mb-3 col-xs-4" id="inputdefault">
                        <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Tìm kiếm công việc" id="search-input" value="<?php echo $keyword; ?>">
                        <div class="input-group-append">
                            <button class="btn_lg btn-outline-secondary" name="find" type="submit" id="search-button">Tìm</button>
                        </div>
                    </div>
                </form>
                <form method="post" class="filter">
                    <select class="Status_selection" name="status_filter">
                        <option value="">Tất cả</option>
                        <option value="TODO">Chưa làm</option>
                        <option value="IN PROGRESS">Đang làm</option>
                        <option value="FINISHED">Hoàn thành</option>
                    </select>
                    <button type="submit" name="filter" class="btn_custom_sm btn-outline-secondary">Lọc</button>
                </form>
            </div>
            <form method="post">
                <table class="table_ table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="table_th Table__col"><input type="checkbox" id="select-all"></th>
                            <th scope="col" class="table_th Table__col">Tên công việc</th>
                            <th scope="col" class="table_th Table__col">Mô tả</th>
                            <th scope="col" class="table_th Table__col">Trạng thái</th>
                            <th scope="col" class="table_th Table__col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task) : ?>
                            <tr>
                                <td class="Table__col checkbox"><input type="checkbox" name="selected_tasks[]" data-id="<?php echo $task['id']; ?>" value="<?php echo $task['id']; ?>"></td>
                                <td class="Table__col table_info"><?php echo $task['name']; ?></td>
                                <td class="Table__col table_info"><?php echo $task['description']; ?></td>
                                <td class="Table__col table_info">
                                    <select class="Status_selection" name="status_<?php echo $task['id']; ?>">
                                        <option value="TODO" <?php echo $task['status'] === 'TODO' ? 'selected' : ''; ?>>Chưa làm</option>
                                        <option value="IN PROGRESS" <?php echo $task['status'] === 'IN PROGRESS' ? 'selected' : ''; ?>>Đang làm</option>
                                        <option value="FINISHED" <?php echo $task['status'] === 'FINISHED' ? 'selected' : ''; ?>>Hoàn thành</option>
                                    </select>
                                </td>
                                <td class="Table__col table_action">
                                    <a class="btn_custom_sm btn-outline-primary" href="detail.php?id=<?php echo $task['id']; ?>">Xem chi tiết</a>
                                    <a class="btn_custom_sm btn-outline-warning" href="update.php?id=<?php echo $task['id']; ?>">Chỉnh sửa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="Table__action">
                    <input type="hidden" name="delete_selected_tasks">
                    <button type="submit" name="delete_task" class="btn_custom btn-outline-danger">Xóa</button>
                    <input type="hidden" name="update_status_submit">
                    <button type="submit" name="update_status_submit" class="btn_custom btn-outline-info">Thay đổi trạng thái</button>
                </div>
            </form>
            <!-- Phân trang -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item btn-per <?php echo $current_page == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" tabindex="-1">Trở lại</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item btn-next <?php echo $current_page == $total_pages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Tiếp theo</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_selected_tasks'])) {
                if (isset($_POST['selected_tasks'])) {
                    foreach ($_POST['selected_tasks'] as $task_id) {
                        // Thực hiện xóa công việc với ID tương ứng
                        $taskController->delete($task_id);
                    }
                }
                echo "<script>
                    setTimeout(function() {
                        location.href = '/src/Views/task/list.php';
                    }, 1000);
                </script>";
                exit;
            } elseif (isset($_POST['update_status_submit'])) {
                echo "1";
                // Kiểm tra xem đã chọn các công việc để cập nhật trạng thái hay không
                if (isset($_POST['selected_tasks'])) {
                    foreach ($_POST['selected_tasks'] as $task_id) {
                        $new_status = $_POST['status_' . $task_id];
                        $taskController->updateStatus($task_id, $new_status);
                    }
                    // echo "<script>
                    //     setTimeout(function() {
                    //         location.href = '/src/Views/task/list.php';
                    //     }, 1000);
                    // </script>";
                    exit;
                }
            } elseif (isset($_POST['find'])) {
                echo "2";
                echo "<script>
                    location.href = '/src/Views/task/list.php?keyword=" . urlencode($_POST['keyword']) . "';
                </script>";
                exit;
            } elseif (isset($_POST['filter'])) {
                echo "2";
                echo "<script>
                    location.href = '/src/Views/task/list.php?filter=" . urlencode($_POST['status_filter']) . "';
                </script>";
                exit;
            }
        }
    ?>
    <script src="/public/js/script.js"></script>
</body>

</html>