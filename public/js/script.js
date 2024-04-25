
// Xử lý khi checkbox ở hàng tiêu đề được thay đổi
document.getElementById('select-all').addEventListener('change', function () {
    var checkboxes = document.querySelectorAll('input[name="selected_tasks[]"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = event.target.checked;
    });
});

var selectedIds = [];

// Hàm để thêm hoặc xóa ID khỏi mảng khi checkbox được chọn hoặc bỏ chọn
function toggleId(id) {
    var index = selectedIds.indexOf(id);
    if (index === -1) {
        selectedIds.push(id);
    } else {
        selectedIds.splice(index, 1);
    }
}

// Sự kiện khi checkbox được thay đổi
$(document).ready(function() {
    $('[data-id]').change(function() {
        var taskId = $(this).data('id');
        toggleId(taskId);
    });
});

var detailButtons = document.querySelectorAll('.btn_custom.btn-primary');
var editButtons = document.querySelectorAll('.btn_custom.btn-warning');

// Lặp qua mỗi nút "Xem chi tiết" và thêm hàm xử lý sự kiện click
detailButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút

        // Lấy ID của công việc từ checkbox được chọn
        var selectedTaskId = getSelectedTaskId();

        // Chuyển hướng đến trang chi tiết với ID tương ứng
        window.location.href = 'detail.php?id=' + selectedTaskId;
    });
});

// Lặp qua mỗi nút "Chỉnh sửa" và thêm hàm xử lý sự kiện click
editButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút

        // Lấy ID của công việc từ checkbox được chọn
        var selectedTaskId = getSelectedTaskId();

        // Chuyển hướng đến trang chỉnh sửa với ID tương ứng
        window.location.href = 'update.php?id=' + selectedTaskId;
    });
});

// Hàm để lấy ID của công việc từ checkbox được chọn
function getSelectedTaskId() {
    var checkboxes = document.querySelectorAll('input[name="selected_tasks[]"]:checked');
    if (checkboxes.length > 0) {
        return checkboxes[0].value;
    }
    return null; // Trả về null nếu không có checkbox nào được chọn
}

