<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="shortcut icon" href="../Image/title-icon.png" type="image/x-icon">
  <link rel="stylesheet" href="./Font/zhcn.ttf">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }


    a,
    button {
      text-decoration: none !important;
      color: inherit;
      cursor: revert;
    }

    ol,
    ul,
    menu {
      list-style: none !important;
      margin: 0 !important;
    }
  </style>
  <title>Online eStore</title>
</head>

<body>
  <!-- <header class="w-[100vw] h-[80px] px-8 bg-[#25ecec] flex justify-between items-center">
    <div id="header__logo">
      <img src="./Image/logo_shopping.png" alt="logo">
    </div>

    <div class="searchBar">
      <input type="text" id="input" name="input" placeholder="Nhập sản phẩm cần tìm...">
      <div class="searchIcon">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
    </div>

    <ul id="header__nav" class="flex justify-between items-center">
      <li><a href="#content" class="">SẢN PHẨM</a></li>
      <li><a href="#">GIỎ HÀNG</a></li>
      <li><a href="#">ĐĂNG XUẤT</a></li>
    </ul>
  </header> -->

  <header>
        <div id="header__logo">
            <img src="./Image/logo_shopping.png" alt="logo">
        </div>

        <div class="searchBar">
            <div class="searchIcon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="text" id="input" name="input" placeholder="Nhập sản phẩm cần tìm...">
        </div>

        <ul id="header__nav">
            <?php 
                if(isset($_SESSION['username'])){
                    echo '<i class="fa-regular fa-user"></i>';
                    echo '<li style="padding: 0 10px;">' . $_SESSION['username'] . '</li>';
                    session_destroy();
                }
            ?>
            
            <li><a href="cart.php">GIỎ HÀNG</a></li>
            
            <?php
                if(isset($_SESSION['valid'])){
                    echo '<li><a href="index.php">ĐĂNG XUẤT</a></li>';
                }
                else {
                    echo '<li><a href="./php/login.php">ĐĂNG NHẬP</a></li>';
                }
            ?>

        </ul>
    </header>