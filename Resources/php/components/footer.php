
<footer class="footer absolute bottom-0 dark:bg-gray-800">
	<div class="container row">
		<div class="footer-col">
			<h4>Liên hệ với chúng tôi</h4>
			<ul>
				<li><a href="#">Số điện thoại +84-XXX-XXX-XXX</a></li>
				<li><a href="#">Địa chỉ TPHCM</a></li>
			</ul>
		</div>
		<div class="footer-col">
			<h4>Theo dõi chúng tôi qua</h4>
			<div class="social-links">
					<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="#"><i class="fa-brands fa-x-twitter"></i></a>
					<a href="#"><i class="fa-brands fa-instagram"></i></a>
					<a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
				</div>
			</div>
		</div>
	</footer>
	<?php
    include_once("./components/cartToast.php");
		?>
</div>
</body>
<script src='../JS/index.js'></script>
<script src="../JS/tailwind.config.js"></script>
<script src="../JS/app.js"></script>
<script>
    $(document).ready(function () {
        // Sự kiện click nút áo nữ
        $("#searchButton").click(function () {
            // Lấy giá trị từ trường input
            var keyword = $("#input").val().trim();
            // Gửi yêu cầu AJAX để tìm kiếm sản phẩm
            $.ajax({
                url: "./filter.php", // Đường dẫn đến file xử lý tìm kiếm
                method: "POST",
                data: { category: keyword },
                success: function (data) {
                    // Cập nhật nội dung trang với kết quả tìm kiếm
                    $("#content").html(data);
                }
            });
        });

    });
</script>
</html>