
function showCartToast(product_name) {
  var toastBody = $("#cartToast .toast-body");

  toastBody.text("Đã thêm sản phẩm  vào giỏ hàng.");

  $("#cartToast").toast({
    delay: 2000
  }).toast("show");
}


// var script = document.createElement('script');
// 	script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
// 	script.type = 'text/javascript';
// 	document.head.appendChild(script);
function addToCart(product_id, product_name, product_image_link, product_price) {
  $.ajax({
    type: "POST",
    url: "./php/services/add_to_cart.php",
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







//     <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
//     <script>
// 	var cities = document.getElementById("city");
// var districts = document.getElementById("district");
// var wards = document.getElementById("ward");
// var Parameter = {
//   url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
//   method: "GET", 
//   responseType: "application/json", 
// };
// var promise = axios(Parameter);
// promise.then(function (result) {
//   renderCity(result.data);
// });

// function renderCity(data) {
//   for (const x of data) {
//     cities.options[cities.options.length] = new Option(x.Name, x.Id);
//   }
//   cities.onchange = function () {
//     district.length = 1;
//     ward.length = 1;
//     if(this.value != ""){
//       const result = data.filter(n => n.Id === this.value);

//       for (const k of result[0].Districts) {
//         district.options[district.options.length] = new Option(k.Name, k.Id);
//       }
//     }
//   };
//   district.onchange = function () {
//     ward.length = 1;
//     const dataCity = data.filter((n) => n.Id === cities.value);
//     if (this.value != "") {
//       const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

//       for (const w of dataWards) {
//         wards.options[wards.options.length] = new Option(w.Name, w.Id);
//       }
//     }
//   };
// }
// 	</script>

// $(document).ready(
  function addAddress () {
    var cities = $("#shipping-city");
    var districts = $("#shipping-district");
    var wards = $("#shipping-ward");
    console.log(cities.options)
  console.log('---------------------------------------hhhhhhhhhh')
  
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
  // );
  
  