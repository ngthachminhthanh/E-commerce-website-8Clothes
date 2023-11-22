<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/loginAndRegister.css">
    <title>Đăng ký</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

            <?php
            include("config.php");
            if(isset($_POST['submit'])){
              $username = mysqli_real_escape_string($con, $_POST['username']);
              $email = mysqli_real_escape_string($con, $_POST['email']);
              $age = mysqli_real_escape_string($con, $_POST['age']);
              $password = mysqli_real_escape_string($con, $_POST['password']);
          

                $verify_query = mysqli_query($con,"SELECT Email FROM customer WHERE Email='$email'");

                if(mysqli_num_rows($verify_query) != 0 ){
                    echo "<div class='message'>
                              <p>Email này đã được sử dụng, vui lòng thử Email khác!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Quay lại</button>";
                }
                else{
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    mysqli_query($con,"INSERT INTO customer(Username,Email,Age,Password) VALUES('$username','$email','$age','$hashed_password')") or die("Error Occured");
                    

                    echo "<div class='message'>
                              <p style=\"color: green;\">Đăng ký thành công!</p>
                          </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Đăng nhập ngay</button>";
                }
            }else{
            ?>

            <header>Đăng ký</header>
            <form action="" method="post" onsubmit="return validateForm()">
                <div class="field input">
                    <label for="username">Tên người dùng</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Tuổi</label>
                    <input type="number" name="age" id="age" autocomplete="off" required min="0">
                </div>
                <div class="field input">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Đăng ký">
                </div>
                <div class="links">
                    Đã là thành viên? <a href="login.php">Đăng nhập</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</body>
<script>
function validateForm() {
    let ageInput = document.getElementById("age");
    // Thực hiện kiểm tra độ tuổi, ở đây là kiểm tra đủ 16 tuổi hay không
    if (!isOldEnough(ageInput.value)) {
        alert("Bạn phải đủ 16 tuổi để đăng ký!")
        return false; // Ngăn chặn biểu mẫu được gửi đi
    }
    // Nếu mọi thứ đều hợp lệ, cho phép gửi biểu mẫu
    return true;
}
function isOldEnough(age) {
    // Lấy ngày hiện tại
    return (age >= 16);
}
</script>
</html>