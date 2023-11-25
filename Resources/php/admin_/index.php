<?php
session_start();
include('ketnoi.php');

if (isset($_POST['submit'])) {
    $username_ = mysqli_real_escape_string($conn, $_POST['username_']);
    $password_ = mysqli_real_escape_string($conn, $_POST['password_']);
    // $hashed_password = password_hash($password_, PASSWORD_BCRYPT);
    echo $username_;
    echo $password_;

    $query = "SELECT * FROM customer WHERE Username ='$username_' LIMIT 1";
    ///*************** 
    // user type = 1: admin
    ///***************
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

            ;
        if ($row && password_verify($password_, $row['Password'])) {
        // if ($row && $password_ == $row['Password']) {
            $_SESSION['username_'] = $row['Username'];
            $_SESSION['password_'] = $row['Password'];
            header('location: quantri.php');
            exit();
        } else {
            $error = 'Tài khoản hoặc mật khẩu chưa đúng';
        }
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vietpro Mobile Shop - Đăng nhập hệ thống</title>
    <link rel="stylesheet" type="text/css" href="css/dangnhap.css" />
</head>
<body>
    <?php if (!isset($_SESSION['username_'])) { ?>
        <form method="post">
            <div id="form-login">
                <h2>Đăng nhập hệ thống quản trị</h2>
                <span style="color:red;"><?php echo isset($error) ? $error : ''; ?></span>
                <ul>
                    <li><label>Tài khoản</label><input type="text" name="username_" /></li>
                    <li><label>Mật khẩu</label><input type="password" name="password_" /></li>
                    <li><label>Ghi nhớ</label><input type="checkbox" name="check" checked="checked" /></li>
                    <li><input type="submit" name="submit" value="Đăng nhập" /> <input type="reset" name="reset" value="Làm mới" /></li>
                </ul>
            </div>
        </form>
    <?php } else {
        header('location: quantri.php');
        exit();
    } ?>
</body>
</html>
