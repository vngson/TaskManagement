MSSV: 20120566
Tên: Võ Ngọc Sơn
# TaskManagement
**Các bước chạy ứng dụng quản lý công việc:**
1. Cấu hình host, tên database, tài khoản, mật khẩu truy cập vào MySQL chưa database quản lý công việc.
2. Nếu đã cài đặt các công cụ cần thiết để chạy ứng dụng php thì có thể đến bước tiếp theo, nếu chưa thì cần tải các công cụ hổ trợ chạy ứng dụng php.
3. Chọn file public/index.php, nhấp chuột phải, sử dụng công cụ PHP server: Serve project để chạy ứng dụng
**Mô tả ứng dụng:**
- Ban đầu khi chạy ứng dụng lên sẽ hiện lên trang chủ, trong trang chủ gồm có 2 ô dẫn đến 2 trang là trang thêm công việc và trang danh sách công việc
- Với trang thêm công việc, ta cần nhập các thông tin cần thiết của công việc, lưu ý đối với ngày bắt đầu và ngày kết thúc, ta sẽ nhập theo dạng dd/mm/yyyy, sau khi nhập hết các thông tin ấn thêm công việc để thêm công việc
- Với trang danh sách công việc, sẽ có 1 bảng gồm tên các công việc, bên cạnh sẽ có các nút là: xem chi tiêt, chỉnh sửa và xóa
    - Khi ấn nút xem chi tiết, trang sẽ chuyển hướng đến trang chi tiết công việc, trang này có chưa tất cả thông tin về công việc đó trừ id
    - Khi ấn nút chỉnh sửa, trang sẽ chuyển hướng đến trang chỉnh sửa công việc, chúng ta sẽ chỉnh sửa các thông tin của công việc và ấn xác nhận để chỉnh sửa công việc
    - Khi ấn nút xóa, công việc sẽ được xóa trong db

