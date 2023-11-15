// Xử lý sự kiện: Xóa Cookie khi người dùng đăng xuất 
// => Đặt hạn sử dụng của cookie là 1 thời điểm trong quá khứ => Cookie hết hạn => Trình duyệt tự động xóa Cookie đã hết hạn
const header__nav = document.getElementById("header__nav");
const btnDangNhap = header__nav.querySelectorAll('li')[1].querySelector('a');
btnDangNhap.onclick = function() {
    document.cookie = "PHPSESSID=;Path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}