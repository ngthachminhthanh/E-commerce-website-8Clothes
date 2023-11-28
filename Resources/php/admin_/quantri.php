<?php
session_start();
include_once('ketnoi.php');

if (!isset($_SESSION['username_'])) {
    header('location: index.php');
    exit();
}

?>

<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="nrQwIS2Cfns3sQPvKQT8Vq02cym0lhdjXFWlvmKM">
    <meta name="robots" content="noindex, nofollow">

    <title>Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- <script src="tailwind.config.js"></script> -->
    <!-- <script src="app.js"></script> -->
    <script>
        $(document).ready(function () {
  var themeToggleDarkIcon = $("#theme-toggle-dark-icon");
  var themeToggleLightIcon = $("#theme-toggle-light-icon");
  var themeToggleBtn = $("#theme-toggle");

  function setInitialTheme() {
    var currentTheme = localStorage.getItem("color-theme");

    if (currentTheme === "dark" || (!currentTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
      $("html").addClass("dark");
      themeToggleLightIcon.removeClass("hidden");
    } else {
      themeToggleDarkIcon.removeClass("hidden");
    }
  }

  setInitialTheme();

  function toggleTheme() {
    themeToggleDarkIcon.toggleClass("hidden");
    themeToggleLightIcon.toggleClass("hidden");

    var currentTheme = localStorage.getItem("color-theme");

    if (currentTheme === "light") {
      $("html").addClass("dark");
      localStorage.setItem("color-theme", "dark");
    } else {
      $("html").removeClass("dark");
      localStorage.setItem("color-theme", "light");
    }
  }

  themeToggleBtn.on("click", toggleTheme);
});
    </script>
</head>

<body id="main" class="antialiased font-sans h-full bg-white dark:bg-slate-900">
    <div>
        <div id="toggleNav" class="relative z-50 lg:hidden" role="dialog" aria-modal="true" style="display: none;">
            <div></div>

            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button onclick='document.querySelector("#toggleNav").style.display=document.querySelector("#toggleNav").style.display?"":"none"' type="button" class="-m-2.5 p-2.5">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg> </button>
                    </div>

                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 dark:bg-slate-900 dark:ring-1 dark:ring-white/10">
                        <div class="flex h-16 shrink-0 items-center">
                            <img src="../../logo3.png" alt="Admin" class="h-8 w-auto">
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-70">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="quantri.php?page_layout=gioithieu" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                                <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                                </svg> Trang chủ
                                            </a>
                                        </li>
                                        <li>
                                            <a href="quantri.php?page_layout=donhang" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                                <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"></path>
                                                </svg> Đơn hàng
                                            </a>
                                        </li>
                                        <li>
                                            <a href="quantri.php?page_layout=danhsachsp" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                                <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
                                                </svg> Sản phẩm
                                            </a>
                                        </li>
                                        <li>
                                            <a href="quantri.php?page_layout=danhmucsp" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white">
                                                <svg class="h-6 w-6 shrink-0 text-sky-600 dark:bg-slate-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122"></path>
                                                </svg> Danh mục
                                            </a>
                                        </li>
                                        <li>
                                            <a href="quantri.php?page_layout=khachhang" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                                <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                                </svg> Khách hàng
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                                <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
                                                </svg> Vận chuyển
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mt-auto">
                                    <a href="quantri.php?page_layout=caidat" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-sky-600 text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg> Cài đặt
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>





        <div class=" hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-slate-200 bg-white px-6 pb-4 dark:bg-slate-900 dark:border-white/10">
                <div class="flex h-16 shrink-0 items-center">
                    <img src="../../logo3.png" alt="Admin" class="h-8 w-auto">
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="quantri.php?page_layout=gioithieu" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                        </svg> Trang chủ
                                    </a>
                                </li>
                                <li>
                                    <a href="quantri.php?page_layout=donhang" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"></path>
                                        </svg> Đơn hàng
                                    </a>
                                </li>
                                <li>
                                    <a href="quantri.php?page_layout=danhsachsp" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
                                        </svg> Sản phẩm
                                    </a>
                                </li>
                                <li>
                                    <a href="quantri.php?page_layout=danhmucsp" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122"></path>
                                        </svg> Danh mục
                                    </a>
                                </li>
                                <li>
                                    <a href="quantri.php?page_layout=khachhang" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                        </svg> Khách hàng
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
                                        </svg> Vận chuyển
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="mt-auto">
                            <a href="quantri.php?page_layout=caidat" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-sky-600 text-slate-700 hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-sky-600 dark:group-hover:text-white dark:group-hover:bg-slate-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg> Cài đặt
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 dark:bg-slate-800 dark:ring-white/10 dark:shadow-inner ">
                <div class="flex h-16 items-center gap-x-4 border-b border-slate-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none dark:bg-slate-900 dark:border-white/10">
                    <button id='toggleBtn' onclick='document.querySelector("#toggleNav").style.display=document.querySelector("#toggleNav").style.display?"":"none"' type="button" class="-m-2.5 p-2.5 text-slate-700 lg:hidden dark:text-slate-400">
                        <span class="sr-only">Open sidebar</span>
                        <svg aria-hidden="true" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                        </svg> </button>

                    <div class="h-6 w-px bg-slate-200 lg:hidden dark:bg-white/5" aria-hidden="true"></div>

                    <div class="flex flex-1 gap-x-4 self-stretch justify-end lg:gap-x-6">
                        <div class=" hidden relative flex flex-1 ">
                            <button class="relative w-full">
                                <svg aria-hidden="true" class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-slate-400 dark:text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                </svg> <span class="hidden sm:flex items-center h-full w-full pl-8 pr-0 text-slate-400 focus:ring-0 sm:text-sm dark:bg-slate-900 dark:text-slate-500">
                                    Search the site (Press "/" to focus)
                                </span>
                            </button>
                        </div>
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            <div class="relative">
                            <button
            id="theme-toggle"
            type="button"
            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
          >
            <svg
              id="theme-toggle-light-icon"
              class="hidden w-5 h-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
              ></path>
            </svg>
            <svg
              id="theme-toggle-dark-icon"
              class="hidden w-5 h-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                fill-rule="evenodd"
                clip-rule="evenodd"
              ></path>
            </svg>
          </button>
                            </div>
                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-slate-200 dark:bg-white/10" aria-hidden="true"></div>
                            <div class="relative">
                                <div class="">
                                    <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" :aria-expanded="open.toString()" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 flex-shrink-0 rounded-full bg-slate-100 dark:bg-slate-800" src="/img/avatar.svg" alt="Admin">
                                        <span class="hidden lg:flex lg:items-center">
                                            <span class="ml-4 text-sm font-semibold leading-6 text-gray-900 dark:text-white" aria-hidden="true">
                                                Admin
                                            </span>
                                            <svg aria-hidden="true" class="ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"></path>
                                            </svg> </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['page_layout'])) {
                switch ($_GET['page_layout']) {
                    case 'themsp':
                        include_once('themsp.php');
                        break;
                    case 'suasp':
                        include_once('suasp.php');
                        break;
                    case 'suadanhmuc':
                        include_once('suadanhmuc.php');
                        break;
                    case 'themdanhmuc':
                        include_once('themdanhmuc.php');
                        break;
                    case 'danhsachsp':
                        include_once('danhsachsp.php');
                        break;
                    case 'danhmucsp':
                        include_once('danhmucsp.php');
                        break;
                    case 'khachhang':
                        include_once('khachhang.php');
                        break;
                    case 'caidat':
                        include_once('caidat.php');
                        break;
                    case 'donhang':
                        include_once('donhang.php');
                        break;
                    case 'wait':
                        include_once('wait.php');
                        break;
                    case 'delivering':
                        include_once('delivering.php');
                        break;
                    case 'delivered':
                        include_once('delivered.php');
                        break;
                    case 'canceled':
                        include_once('canceled.php');
                        break;
                }
            } else {
                include_once('gioithieu.php');
            }
            ?>

        </div>
    </div>
</body>

</html>