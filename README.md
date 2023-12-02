# NMCNPM_WebBanHang
* Môn học: Nhập môn công nghệ phần mềm 
* Lớp: SE104.O11
* Ngày bắt đầu: 11/09/2023
* Ngày kết thúc: 02/12/2023
* Giảng viên lý thuyết: Võ Tấn Khoa
* Giảng viên thực hành: Nguyễn Ngọc Quí/
  
#### Website quản lý bán hàng trực truyến cung cấp:
-	Xây dựng hệ thống quản lý sản phẩm.
-	Xây dựng hệ thống quản lý đơn hàng.
-	Xây dựng hệ thống website bán hàng.

#### Chuẩn bị
-	Xampp: 
  -	MySQL: lưu trữ và quản lý dữ liệu.
  - Apache: dịch vụ websever để chạy trang web.
-	SQL: thực hiện các truy vấn dữ liệu như SELECT, INSERT, UPDATE, DELETE.
-	VS Code: tạo môi phát triển tích hợp với đa dạng các ngôn ngữ, dùng để viết và chạy mã nguồn.
-	Git: theo dõi lịch sử, quản lý, hợp nhất mã nguồn.
-	Github: chia sẻ mã nguồn, làm việc cộng tác, theo dõi vấn đề và quản lý dự án.
-	PHP: xử lý mã nguồn trên máy chủ, tạo và thao tác dữ liệu, tương tác với cơ sở dữ liệu, và tạo nội dung động.
-	JavaScript: thực hiện các tác vụ trên trình duyệt người dùng, tương tác với DOM (Document Object Model), và tạo trải nghiệm người dùng động trên trang web.

#### Khó khăn và hướng phát triển
- Khó khăn
  - Thời gian và nguồn lực còn hạn chế nên một số chức năng vẫn chưa thực sự hoàn thiện, rất nhiều chức năng đã tạo được logic xử lý nhưng chưa hiện thực được ra bên ngoài.
  -	Giao diện đơn giản và dễ dùng nhưng cần thiết kế thêm để ngày càng sinh động và gây được nhiều ấn tượng hơn cho người dùng.
  -	Chưa thật sự đảm bảo được tính bảo mật và an toàn cho dữ liệu.
- Hướng phát triển
  -	Thiết kế responsive cho website (hiển thị nội dung co giãn phù hợp trên tất cả các màn hình thiết bị như desktop, laptop, tablet, smartphone, với mọi độ phân giải màn hình) để duy trì sự hiển thị nội dung nhất quán, tối ưu giao diện và trải nghiệm người dùng.
  -	Thêm chức năng 'Quên mật khẩu' với phương thức xác thực bằng mã OTP được gửi qua tin nhắn hoặc gmail. Giúp người dùng lấy/đặt lại mật khẩu nếu bị mất/quên.
  -	Thêm chức năng đăng nhập được với nhiều nền tảng mạng xã hội khác như Facebook, Gmail hoặc bằng số điện thoại.
  -	Thêm chức năng đánh giá, bình luận với mỗi sản phẩm (có thể đính kèm ảnh/video minh hoạ, đánh sao, bình luận văn bản).
  -	Thêm chức năng xem lại thông tin đơn hàng đã đặt.
  -	Thêm phương thức thanh toán (Momo, chuyển khoản ngân hàng, quét QR).
  -	Thêm chức năng tạo mã giảm giá (voucher) ưu đãi cho khách hàng, thu hút người mua hàng và nâng cao chất lượng thương mại điện tử.
  -	Thêm chức năng hỗ trợ người dùng để người dùng có trải nghiệm tốt hơn như: trung tâm hỗ trợ (chứa các câu hỏi và câu trả lời thường gặp), LiveChat (trò chuyện trực tuyến theo thời gian thực).
  -	Bổ sung thêm những ràng buộc và cải thiện logic những chức năng để trang website trở nên chất lượng hơn. (Ví dụ: người dùng đặt sản phẩm với số lượng đặt nhiều hơn số lượng tồn kho thì thông báo để người dùng biết hết hàng hoặc không bán)
  -	Hoàn thiện thêm màu sắc, bố cục và hình ảnh cho giao diện thêm bắt mắt.
  -	Nâng cao tính bảo mật website và đảm bảo bảo mật thông tin người dùng hơn (xác thực, mật khẩu có độ khó)
  -	Cải thiện tốc độ website, giúp website trở nên mượt mà và giúp người dùng có trải nghiệm tốt hơn.

## Mục lục

- [Thành viên](#thành-viên)
- [Cây thư mục](#cây-thư-mục)
- [Cài đặt và sử dụng](#cài-đặt-và-sử-dụng)
- [Tài liệu tham khảo](#tài-liệu-tham-khảo)
- [Đóng góp](#đóng-góp)

## Thành viên

| MSSV      | Họ và Tên               |
|   :---:   |   :---                  |
| 21522601  | Nguyễn Thạch Minh Thanh | 
| 21521811  | Nguyễn Thành An         | 
| 21522760  | Phan Thanh Tuấn         |
| 21522016  | Đặng Quỳnh Duyên        | 
| 21521521  | Lê Nguyễn Hương Tiên    | 
| 19520292  | Bùi Minh Thùy           | 
| 20520687  | Chu Tấn Phong           | 
| 19522036  | Nguyễn Đình Hoàng Phúc  |
| 20521980  | Lê Đình Thông           |

## Cây thư mục
 
 NMCNPM_WebBanHang\
        ├── Resources                   \
        │   ├── CSS                 # Folder chứa định dạng cho trang web.\
        │   ├── Database            # Folder thiết kế cơ sở dữ liệu.\
        │   ├── Font                # Chứa font chữ cần dùng trong trang web.\
        │   ├── JS                  # Folder thực hiện các tác vụ trên trình duyệt.\
        │   ├── php                 # Xử lý mã nguồn trên máy chủ, tạo và thao tác cơ sở dữ liệu\
        │   └── logo3.png             \
        └── README.md               # Hướng dẫn sử dụng project.

## Cài đặt và sử dụng

1. Tải [XAMPP](https://www.apachefriends.org/download.html) có khả năng tích hợp Web server và cơ sở dữ liệu.
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/a8bba7ba-986a-4533-9009-34919507b446)

2. Khởi động XAMPP Control Panel, chọn Start của Apache và MySQL để khởi chạy localhost và database.
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/47ea22a7-e0a2-47aa-96f6-9e5a0404e0f3)
3. Chọn Admin của MySQL để thiết lập
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/4af5f6ed-4525-4acb-be22-106cbbc778a5)
4. [1] Chọn tab Database, [2] Nhập tên database, [3] Chọn Tạo để tạo Database mới
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/b965f42c-a2c2-4e6b-a129-390e799c3a69)
5. Có 2 cách để chỉnh sửa database
   1. [1] Chọn tab SQL, [2] Copy nội dung file .sql [3] Chọn Thực hiện để thực hiện truy vấn dữ liệu
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/58d12be9-f23d-4d9e-9f6f-bba7f5f1495d)

   2. [1] Chọn tab Nhập, [2] Chọn file .sql cần nhập, [3] chọn Nhập để thực hiện truy vấn.
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/a560946c-d202-491b-aceb-f997270d5e52)
![image](https://github.com/ngthachminhthanh/NMCNPM_WebBanHang/assets/92619999/b21405c0-451c-449b-84b8-0e86a51020d9)

6. Clone repository\
        - Đến thư mục cài đặt XAMPP (mặc định là `C:\xampp\htdocs`)\
        - Sử dụng terminal, window shell hoặc cmd và clone repository: \
        ```
        git clone https://github.com/ngthachminhthanh/NMCNPM_WebBanHang.git
        ```
7. Sử dụng chương trình tại http://localhost + [tên thưc mục vừa clone về]

## Tài liệu tham khảo

- https://youtu.be/1zXqo2WcOew?si=N2CpRvz-DjRVgQ_V
- https://youtu.be/e4jqCtiZ1vU?si=rZR5pL7ipnvRLSmV
- https://youtu.be/0mAL4UuVWbU?si=68qkMWrb_rzYtR6O
- https://youtu.be/kNbDB1a0ZwA?si=Egol-dfrACJYRLkq
- https://youtu.be/G--75rS3KsA?si=zCwc2Ok-yDiyraAf
- https://www.w3schools.com/
- https://www.freecodecamp.org/news/how-to-write-a-good-readme-file/
- https://www.markdownguide.org/basic-syntax/

## Đóng góp

1. Fork (<https://github.com/ngthachminhthanh/NMCNPM_WebBanHang.gi)>)
2. Tạo branch (`git checkout -b feature/fooBar`)
3. Commit thay đổi (`git commit -am 'Add some fooBar'`)
4. Push lên branch (`git push origin feature/fooBar`)
5. Tạo Pull Request mới
