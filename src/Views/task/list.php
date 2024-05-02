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
    $filter = $_GET['filter'] ?? null;


    // Số lượng công việc trên mỗi trang
    $per_page = 10;

    // Lấy trang hiện tại từ tham số URL (nếu không có thì mặc định là trang 1)
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($keyword || $filter)
    {
        $tasks = $taskController->filterForRange($keyword, $filter, ($current_page - 1) * $per_page, $per_page);
        // Tổng số công việc
        $total_tasks = $taskController->countForFilter($keyword, $filter);
    }
    else {
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

    function addOrUpdateUrlParam($url, $key, $value, $keyword, $filter) {
        // Phân tách URL thành mảng các phần tử
        $parts = parse_url($url);

        // Kiểm tra xem URL có chứa tham số không
        if ($keyword || $filter) {
            // Parse tham số thành mảng các cặp key-value
            parse_str($parts['query'], $query);
            echo($query);

            // Cập nhật hoặc thêm tham số mới vào mảng
            $query[$key] = $value;

            // Build lại chuỗi tham số từ mảng đã cập nhật
            $parts['query'] = http_build_query($query);
        } else {
            // Nếu không có tham số, thêm tham số mới vào URL
            $parts['query'] = urlencode($key) . '=' . urlencode($value);
        }

        // Build lại URL từ các phần tử đã cập nhật
        $new_url = $parts['path'] . '?' . $parts['query'];

        return $new_url;
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
                <a class="btn_custom btn-outline-primary" href="/src/Views/task/add.php">Thêm công việc</a>
                <form method="post" class="search">
                    <div class="input-group col-xs-4" id="inputdefault">
                        <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Tìm kiếm công việc" id="search-input" value="<?php echo $keyword; ?>" style="font-size: 1.6rem;">
                        <div class="input-group-append">
                            <button class="btn_lg btn-outline-secondary" name="find" type="submit" id="search-button" style="font-size: 1.6rem;">Tìm</button>
                        </div>
                    </div>
                </form>
                <form method="post" class="filter">
                    <select class="Status_selection" name="status_filter">
                        <option value="" <?php echo $filter === '' ? 'selected' : ''; ?>>Tất cả</option>
                        <option value="TODO" <?php echo $filter === 'TODO' ? 'selected' : ''; ?>>Chưa làm</option>
                        <option value="IN PROGRESS" <?php echo $filter === 'IN PROGRESS' ? 'selected' : ''; ?>>Đang làm</option>
                        <option value="FINISHED" <?php echo $filter === 'FINISHED' ? 'selected' : ''; ?>>Hoàn thành</option>
                    </select>
                    <button type="submit" name="filter" class="btn_custom_sm btn-outline-secondary">Lọc</button>
                </form>
            </div>
            <form method="post">
                <table class="table_ table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="table_th Table__col checkbox"><input type="checkbox" id="select-all"></th>
                            <th scope="col" class="table_th Table__col name">Tên công việc</th>
                            <th scope="col" class="table_th Table__col description">Mô tả</th>
                            <th scope="col" class="table_th Table__col status">Trạng thái</th>
                            <th scope="col" class="table_th Table__col table_action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task) : ?>
                            <tr>
                                <td class="Table__col checkbox"><input type="checkbox" name="selected_tasks[]" data-id="<?php echo $task['id']; ?>" value="<?php echo $task['id']; ?>"></td>
                                <td class="Table__col name"><?php echo $task['name']; ?></td>
                                <td class="Table__col description"><?php echo $task['description']; ?></td>
                                <td class="Table__col status">
                                    <form method="post" class="update_status_submit">
                                        <select class="Status_selection" name="status_<?php echo $task['id']; ?>">
                                            <option value="TODO" <?php echo $task['status'] === 'TODO' ? 'selected' : ''; ?>>Chưa làm</option>
                                            <option value="IN PROGRESS" <?php echo $task['status'] === 'IN PROGRESS' ? 'selected' : ''; ?>>Đang làm</option>
                                            <option value="FINISHED" <?php echo $task['status'] === 'FINISHED' ? 'selected' : ''; ?>>Hoàn thành</option>
                                        </select>
                                        <input type="hidden" name="task_id" class="input_id" value="<?php echo $task['id']; ?>">
                                        <button type="submit" name="update_status_submit" class="btn_custom btn-outline-info">Đổi trạng thái</button>
                                    </form>
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
                    <button type="submit" name="delete_task" class="btn_custom_sm btn-outline-danger">Xóa</button>
                    <input type="hidden" name="delete_all_task">
                    <button type="submit" name="delete_all_task" class="btn_custom_sm btn-outline-danger">Xóa tất cả</button>
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
                print_r($_POST);
                if (isset($_POST['task_id'])) {
                    $task_id = $_POST['task_id'];
                    $new_status = $_POST['status_' . $task_id]; // Lấy trạng thái mới từ select tương ứng với ID công việc
                    $taskController->updateStatus($task_id, $new_status);
                    // Sau khi cập nhật, chuyển hướng trang sau một khoảng thời gian
                    echo "<script>
                            setTimeout(function() {
                                location.href = '/src/Views/task/list.php';
                            }, 1000);
                        </script>";
                    exit;
                }
            } elseif (isset($_POST['find'])) {
                // Lấy URL hiện tại
                $current_url = strtok($_SERVER["REQUEST_URI"], '?');

                // Thêm hoặc cập nhật tham số filter trong URL hiện tại
                $new_url = addOrUpdateUrlParam($current_url, 'keyword', $_POST['keyword'], $keyword, $filter);

                // Chuyển hướng đến URL mới
                echo "<script>location.href = '$new_url';</script>";
                // echo "2";
                // echo "<script>
                //     location.href = '/src/Views/task/list.php?keyword=" . urlencode($_POST['keyword']) . "';
                // </script>";
                exit;
            } elseif (isset($_POST['filter'])) {
                
                // Lấy URL hiện tại
                $current_url = strtok($_SERVER["REQUEST_URI"], '?');

                // Thêm hoặc cập nhật tham số filter trong URL hiện tại
                $new_url = addOrUpdateUrlParam($current_url, 'filter', $_POST['status_filter'], $keyword, $filter);

                // Chuyển hướng đến URL mới
                echo "<script>location.href = '$new_url';</script>";
                // // Lấy URL hiện tại
                // $current_url = strtok($_SERVER["REQUEST_URI"],'?');

                // // Thêm tham số filter vào URL hiện tại
                // $new_url = $current_url . (strpos($current_url, '?') !== false ? '&' : '?') . 'filter=' . urlencode($_POST['status_filter']);

                // // Chuyển hướng đến URL mới
                // echo "<script>location.href = '$new_url';</script>";
                exit;
            } elseif (isset($_POST['delete_all_task'])) {
                $taskController->deleteAllTask();
                echo "<script>
                        setTimeout(function() {
                            location.href = '/src/Views/task/list.php';
                        }, 1000);
                    </script>";
                exit;
            }
        }
    ?>
    <script src="/public/js/script.js"></script>
</body>

</html>