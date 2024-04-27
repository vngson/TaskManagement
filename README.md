# MSSV: 20120566
# Tên: Võ Ngọc Sơn
# Task Management
**Các bước chạy ứng dụng quản lý công việc:**
1. Cấu hình host, tên database, tài khoản, mật khẩu truy cập vào MySQL chưa database quản lý công việc.
2. Nếu đã cài đặt các công cụ cần thiết để chạy ứng dụng php thì có thể đến bước tiếp theo, nếu chưa thì cần tải các công cụ hổ trợ chạy ứng dụng php.
3. Chọn file public/index.php, nhấp chuột phải, sử dụng công cụ PHP server: Serve project để chạy ứng dụng
**Các phần đã làm được**
• Trang 1: Trang chủ
    • Liên kết tới các trang con
• Trang 2: Thêm mới công việc
    • Khi thêm có kiểm tra dữ liệu bắt buộc phải nhập (javasript)
• Trang 3: Xem danh sách công việc / xoá
    • Có ô nhập liệu để tìm kiếm công việc (theo tên và mô tả) để tìm công việc cần thiết. Ngoài ra có thể lọc các các công việc sắp hết hạn, các công việc đã hoàn thành, các
    công việc đang thực hiện, ...
    • Có thể xem chi tiết công việc ở một trang riêng
    • Có thể xoá công việc trong trang xem danh sách
    • Có thể chọn nhiều công việc và xoá (sử dụng check box), có thể chọn tất cả công việc để xoá
    • Khi xoá phải báo lỗi nếu loại công việc bị tham chiếu bởi công việc
    • Có nút để liên kết tới trang cập nhật thông tin công việc.
    • Cập nhật thay đổi trạng thái công việc trong trang danh sách
    • Quản lý danh mục loại công việc
• Trang 4: Cập nhật công việc
    • Hiển thị nội dung công việc từ trang 2 khi người dùng chọn cập nhật
    • Sau khi cập nhật sẽ quay về trang danh sách công việc
**Mô tả ứng dụng:**
- Ban đầu khi chạy ứng dụng lên sẽ hiện lên trang chủ, trong trang chủ gồm có 2 ô dẫn đến 2 trang là trang thêm công việc và trang danh sách công việc
- Với trang thêm công việc, ta cần nhập các thông tin cần thiết của công việc, lưu ý đối với ngày bắt đầu và ngày kết thúc, ta sẽ nhập theo dạng dd/mm/yyyy, sau khi nhập hết các thông tin ấn thêm công việc để thêm công việc
- Với trang danh sách công việc, sẽ có 1 bảng gồm tên các công việc, bên cạnh sẽ có các nút là: xem chi tiêt, chỉnh sửa và xóa
    - Khi ấn nút xem chi tiết, trang sẽ chuyển hướng đến trang chi tiết công việc, trang này có chưa tất cả thông tin về công việc đó trừ id
    - Khi ấn nút chỉnh sửa, trang sẽ chuyển hướng đến trang chỉnh sửa công việc, chúng ta sẽ chỉnh sửa các thông tin của công việc và ấn xác nhận để chỉnh sửa công việc
    - Khi ấn nút xóa, công việc sẽ được xóa trong db, nếu thành công sẽ hiển thị thông báo trên màn hình, reload lại trang sẽ thấy công việc đã bị xóa đi
- Ở trên header sẽ có thông tin như logo app, tên app, tên trang hiện tại, avatar người dùng, khi hover vào avatar người dùng sẽ có tên được hiển thị ở phía dưới
    - Khi chúng ta ấn vào logo app hoặc tên app, nó sẽ điều hướng về trang chủ
- Ở mỗi trang đều có nút trở về, khi ấn vào nó sẽ trở về trang trước

