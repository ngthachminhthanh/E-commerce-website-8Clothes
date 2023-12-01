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
              $phone = mysqli_real_escape_string($con, $_POST['phone']);
              $password = mysqli_real_escape_string($con, $_POST['password']);
          

                $verify_query = mysqli_query($con,"SELECT Email FROM customer WHERE Email='$email'");

                if(mysqli_num_rows($verify_query) != 0 ){
                    echo "<div class='message'>
                              <p>Email này đã được sử dụng, vui lòng thử Email khác!</p>
                          </div> <br>";

                    if(isset($_GET['passToCart']) && $_GET['passToCart'] == 1){
                        echo "<a href='register.php?passToCart=1'><button class='btn'>Quay lại</button>";
                    } else {
                        echo "<a href='register.php'><button class='btn'>Quay lại</button>";
                    }
                }
                else{
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    mysqli_query($con,"INSERT INTO customer(Username,Email,Phone,Password) VALUES('$username','$email','$phone','$hashed_password')") or die("Error Occured");
                    

                    echo "<div class='message'>
                              <p style=\"color: green;\">Đăng ký thành công!</p>
                          </div> <br>";

                    if(isset($_GET['passToCart']) && $_GET['passToCart'] == 1){
                        echo "<a href='login.php?passToCart=1'><button class='btn'>Đăng nhập ngay</button>";
                    } else {
                        echo "<a href='login.php'><button class='btn'>Đăng nhập ngay</button>";
                    }
                }
            }else{
            ?>

            <header>Đăng ký</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Họ tên</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" pattern="[0-0]{1}[0-9]{3}[0-9]{3}[0-9]{3}"  autocomplete="off" required min="0">
                </div>
                <div class="field input">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Đăng ký">
                </div>
                <div class="links">
                    Đã là thành viên? <a href="#" onclick="passToCart_register()">Đăng nhập</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</body>

<script>
    function passToCart_register() {
        let currLink = window.location.href;
        if(currLink.includes("passToCart=1")){
            window.location.href = "login.php?passToCart=1";
        }else{
            window.location.href = "login.php";
        }
    }
</script>

</html>