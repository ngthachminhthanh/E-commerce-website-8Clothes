
  
  // document ready jquery
  $(document).ready(function () {
    var themeToggleDarkIcon = $(
      "#theme-toggle-dark-icon"
    );
    var themeToggleLightIcon = $(
      "#theme-toggle-light-icon"
    );
  
    if (
      localStorage.getItem("color-theme") === "dark" ||
      (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
      themeToggleLightIcon.removeClass("hidden");
    } else {
      themeToggleDarkIcon.removeClass("hidden");
    }
  
    var themeToggleBtn = $("#theme-toggle");
  
    themeToggleBtn.on("click", function () {
      themeToggleDarkIcon.toggleClass("hidden");
      themeToggleLightIcon.toggleClass("hidden");
  
      if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
          $("html").addClass("dark");
          localStorage.setItem("color-theme", "dark");
        } else {
          $("html").removeClass("dark");
          localStorage.setItem("color-theme", "light");
        }
  
      } else {
        // if ($("html").classList.contains("dark")) {
        if ($("html").hasClass("dark")) {
          $("html").removeClass("dark");
          localStorage.setItem("color-theme", "light");
        } else {
          $("html").addClass("dark");
          localStorage.setItem("color-theme", "dark");
        }
      }
    });
  
  
  
  
    $("#logOutBtn").on("click", function () {
      $.ajax({
        type: "GET",
        url: "./services/logout.php",
        dataType: "json",
        success: function (response) {
          if (response.success) {
            console.log("Đăng xuất thành công");
            location.reload();
          }
        },
        error: function () {
          console.log("Có lỗi xảy ra khi gửi yêu cầu đăng xuất.");
        }
      });
    });
  
  
  
    let searchBar = document.querySelector('.searchBar');
    let currentPage = window.location.pathname;
    let excludedPages = ['/cart.php', '/checkout.php', '/process_checkout.php'];
    if (currentPage.includes(excludedPages[0]) || currentPage.includes(excludedPages[1]) || currentPage.includes(excludedPages[2])) {
      searchBar.style.visibility = 'hidden';
    } else {
      searchBar.style.visibility = 'visible';
    }
  
  });
  // ready end
  
  function sortPL(loaiSP, sortOption) {
    var selectedValue = sortOption;
    var loaisp = loaiSP;
    // if (sortOption == "")
    // return;
    // location.reload();
    console.log(selectedValue, loaisp)
    // Gửi yêu cầu AJAX để lấy dữ liệu được sắp xếp
    $.ajax({
      url: "./sortphanloai.php", // Đường dẫn đến file xử lý sắp xếp
      method: "POST",
      data: { sortOption: selectedValue, loaisp: loaisp },
      success: function (data) {
        // Cập nhật nội dung trang với kết quả sắp xếp
        $("#content").html(data);
      }
    });
  }
  function sortIndex(sortOption) {
    // Lấy giá trị đã chọn
    var selectedValue = sortOption;
    var keyword = $("#input").val().trim();
    console.log(selectedValue, '  --  - - ', keyword);
    // Gửi yêu cầu AJAX để lấy dữ liệu được sắp xếp
    $.ajax({
      url: "./sort.php", // Đường dẫn đến file xử lý sắp xếp
      method: "POST",
      data: { sortOption: selectedValue, category: keyword },
      success: function (data) {
        // Cập nhật nội dung trang với kết quả sắp xếp
        $("#content").html(data);
      }
    });
  }
  
  function searchDH() {
    // Lấy giá trị đã chọn
    alert("hihi");
    //let selectedValue = $(".products-container .sort select").val();
    var keyword = $("#input").val().trim();
    // Gửi yêu cầu AJAX để tìm kiếm sản phẩm
    $.ajax({
      // url: "./filter.php", // Đường dẫn đến file xử lý tìm kiếm
      url: "./admin/admin_search.php", // Đường dẫn đến file xử lý tìm kiếm
      method: "POST",
      // data: { category: keyword },
      data: { category: keyword },
      success: function (data) {
        // Cập nhật nội dung trang với kết quả tìm kiếm
        $("#list_donhang").html(data);
        //alert ("hihih");
      }
    });
  }
  
  
  