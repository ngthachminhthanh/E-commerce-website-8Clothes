<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/loginAndRegister.css">
    <title>Đăng nhập</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            include("config.php");
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $result = mysqli_query($con, "SELECT * FROM customer WHERE Email='$email'") or die("Select Error");
                $row = mysqli_fetch_assoc($result);
 
                if ($row && password_verify($password, $row['Password'])) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['phone'] = $row['Phone'];
                    $_SESSION['id'] = $row['Id'];

                    if($email === "admin@gmail.com" && $password === "admin"){
                        header("Location: ./admin_/quantri.php");
                        exit();
                    }
                    
                    if($_GET['passToCart'] && $_GET['passToCart'] == 1){
                        header("Location: cart.php");
                    } else {
                        header("Location: ./index.php");
                    }
                    exit();
                } else {
                    echo "<div class='message'>
                                    <p>Sai tài khoản hoặc mật khẩu!</p>
                                </div> <br>";
                    if(isset($_GET['passToCart']) && $_GET['passToCart'] == 1){
                        echo "<a href='login.php?passToCart=1'><button class='btn'>Quay lại</button>";
                    } else {
                        echo "<a href='login.php'><button class='btn'>Quay lại</button>";
                    }
                }
            } else {
                ?>
                <header>Đăng nhập</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email" style="margin: 7px;">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password" style="margin: 7px;">Mật khẩu</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Đăng nhập">
                    </div>
                    <div class="links">
                        Chưa có tài khoản? <a href="#" onclick="passToCart_login()">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

<script>
    function passToCart_login() {
        let currLink = window.location.href;
        if(currLink.includes("passToCart=1")){
            window.location.href = "register.php?passToCart=1";
        }else{
            window.location.href = "register.php";
        }
    }
</script>

</html>