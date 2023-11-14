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
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

         //verifying the unique email

         $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) != 0 ){
            echo "<div class='message'>
                      <p>Email này đã được sử dụng, vui lòng thử Email khác!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Quay lại</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p style=\"color: green;\">Đăng ký thành công!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Đăng nhập ngay</button>";
         }

        }else{
         
        ?>

            <header>Đăng ký</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Tên người dùng</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Tuổi</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Đăng ký" required>
                </div>
                <div class="links">
                    Đã là thành viên? <a href="login.php">Đăng nhập</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>