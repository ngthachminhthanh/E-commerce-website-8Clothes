
function showCartToast(product_name) {
  var toastBody = $("#cartToast .toast-body");

  toastBody.text("Đã thêm sản phẩm vào giỏ hàng.");

  $("#cartToast").toast({
    delay: 2000
  }).toast("show");
}

function addToCart(product_id, product_name, product_image_link, product_price) {
  $.ajax({
    type: "POST",
    url: "./services/add_to_cart.php",
    data: {
      product_id: product_id,
      product_name: product_name,
      product_image_link: product_image_link,
      product_price: product_price
    },
    success: function (response) {
      console.log('success')
      showCartToast(product_name);
    },
    error: function (xhr, status, error) {
      console.error("AJAX request failed:", status, error);
    }
  });
}

console.log('why oh why-----------')
function updateCartItemQuantity(productId, quantity) {
  $.ajax({
    url: "./services/update_cart_item_quantity.php",
    method: "POST",
    data: {
      product_id: productId,
      quantity: quantity
    },
    success: function(response) {
      console.log(response);
      var responseData = response;
      var responseData = JSON.parse(response);
      
      function formatCurrency(amount) {
        var formattedAmount = amount.toLocaleString("vi-VN", {
          style: "currency",
          currency: "VND"
        });

        return formattedAmount;
      }

      var formattedTotalPrice = formatCurrency(responseData.newTotalPrice);

      console.log(formattedTotalPrice);
      if (responseData.hasOwnProperty("newTotalPrice")) {
        console.log("--------------" + responseData.newTotalPrice);
        $("#total_price_vnd").text(formattedTotalPrice);
      }
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}

function addAddress() {
  var cities = $("#shipping-city");
  var districts = $("#shipping-district");
  var wards = $("#shipping-ward");
  console.log('addresses');
  $.ajax({
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
    method: "GET",
    dataType: "json",
    success: function (result) {
      renderCity(result);
    },
    error: function (error) {
      console.error("Error fetching data:", error);
    }
  });

  function renderCity(data) {
    cities.empty().append('<option value="" selected>Chọn tỉnh thành</option>');

    $.each(data, function (index, item) {
      cities.append('<option class="dark:text-slate-40 dark:bg-slate-800" value="' + item.Id + '">' + item.Name + '</option>');
    });

    cities.on("change", function () {
      districts.empty().append('<option value="" selected>Chọn quận huyện</option>');
      wards.empty().append('<option value="" selected>Chọn phường xã</option>');

      if ($(this).val() !== "") {
        var result = data.find(n => n.Id === $(this).val());

        $.each(result.Districts, function (index, item) {
          districts.append('<option class="dark:text-slate-40 dark:bg-slate-800" value="' + item.Id + '">' + item.Name + '</option>');
        });
      }
    });

    districts.on("change", function () {
      wards.empty().append('<option value="" selected>Chọn phường xã</option>');

      var dataCity = data.find(n => n.Id === cities.val());

      if ($(this).val() !== "") {
        var dataWards = dataCity.Districts.find(n => n.Id === $(this).val()).Wards;

        $.each(dataWards, function (index, item) {
          wards.append('<option class="dark:text-slate-40 dark:bg-slate-800" value="' + item.Id + '">' + item.Name + '</option>');
        });
      }
    });
  }
}


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
  $.ajax({
    url: "./sort.php", 
    method: "POST",
    data: { sortOption: selectedValue, category: keyword },
    success: function (data) {
      $("#content").html(data);
    }
  });
}

function search() {
  let selectedValue = $(".products-container .sort select").val();
  var keyword = $("#input").val().trim();
  $.ajax({
    url: "./sort.php",
    method: "POST",
    data: { sortOption: selectedValue, category: keyword },
    success: function (data) {
      $("#content").html(data);
    }
  });
}
