-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2023 lúc 04:44 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website08`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Date of birth` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `Id` int(11) NOT NULL,
  `Total prices` int(11) NOT NULL,
  `Date order` date NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Customer Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `Id` int(11) NOT NULL,
  `Date payment` date NOT NULL,
  `Method payment` tinyint(4) NOT NULL COMMENT '(0) Nhận hàng rồi thanh toán, (1) Thẻ tín dụng/ Ghi nợ, (2) Ví Momo, (3) PayPal',
  `Shopping cart Id` int(11) NOT NULL,
  `Customer ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Product category ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`Id`, `Image`, `Description`, `Name`, `Price`, `Quantity`, `Product category ID`) VALUES
(0, 'https://canifa.com/img/1000/1500/resize/6/t/6th23w007-pb415-m-1-u.webp', 'Áo sơ mi chất liệu cotton, cổ đức, dáng ngắn.\r\nChất liệu cotton.\r\nThoáng mát và dễ chịu khi mặc.', 'Áo sơ mi nữ dài tay dáng ngắn', 499000, 10, 0),
(1, 'https://canifa.com/img/1000/1500/resize/6/t/6th23s002-sg217-m-1.webp', 'Áo sơ mi chất liệu 100% cotton, cổ đức tay chờm.', 'Áo sơ mi nữ cotton cổ đức tay chờm', 499000, 16, 0),
(2, 'https://canifa.com/img/1000/1500/resize/6/t/6th23s001-fo049-m-1.webp', 'Áo sơ mi chất liệu 100% cotton, cổ đức tay dài.', 'Áo sơ mi nữ cotton cổ đức dài tay in họa tiết', 419000, 16, 0),
(3, 'https://canifa.com/img/1000/1500/resize/6/t/6ts23w016-sl213-m-1-u.webp', 'Áo cộc tay cổ tròn dáng ngắn, dáng vừa vặn, phần tay áo xếp ly tạo độ bồng vừa phải, mang lại sự nữ tính nhẹ nhàng cho người mặc, chất liệu interlock dầy dặn, thoải mái, dễ chịu cho người mặc, phù hợp với đi chơi, đi làm, thời tiết mùa thu, mùa xuân.', 'Áo phông nữ interlock dáng ngắn tay xếp ly', 299000, 26, 0),
(4, 'https://canifa.com/img/1000/1500/resize/6/t/6ts23s012-sw001-m-1.webp', 'Áo phông chất liệu 100% cotton, cổ tròn tay cộc, phôm oversize.', 'Áo phông nữ cotton cổ tròn dáng oversize có hình in', 150000, 27, 0),
(5, 'https://canifa.com/img/1000/1500/resize/6/t/6tw23w007-sp234-m-1-u.webp', 'Áo nỉ dáng basic cổ tròn, thiết kế bo gấu tạo sự thoải mái khi mặc, kết hợp với các chi tiết đồ họa đơn giản tạo điểm nhấn cho sản phẩm.', 'Áo nỉ nữ bo gấu có hình in', 250000, 24, 0),
(6, 'https://canifa.com/img/1000/1500/resize/6/t/6tw23w003-sw011-m-1-u.webp', 'Áo hoodie nữ dáng oversize, phong cách khỏe khoắn với thiết kế can phối ở tay áo và hình in nổi bật tạo nên một sản phẩm ấn tượng, phù hợp với giới trẻ.', 'Áo nỉ nữ có mũ dáng rộng', 560000, 16, 0),
(7, 'https://canifa.com/img/1000/1500/resize/6/t/6tp23w005-sk010-m-1-u.webp', 'Áo cộc tay cổ bẻ, dáng ngắn, eo ôm vừa, chất liệu interlock dầy dặn, thoải mái, dễ chịu cho người mặc, phù hợp với đi chơi, đi làm, thời tiết mùa thu, mùa xuân.\r\nChất liệu Cotton Polyester.', 'Áo polo nữ interlock dáng ngắn', 29, 10, 0),
(8, 'https://canifa.com/img/1000/1500/resize/6/t/6ts23s004-sb138-m-1.webp', 'Áo phông chất liệu polyester, cổ vuông tay phồng, phôm ôm.', 'Áo phông nữ cổ vuông tay bồng dáng ôm', 280000, 6, 0),
(9, 'https://canifa.com/img/1000/1500/resize/6/t/6to23s001-fo049-m-1.webp', 'Áo kiểu chất liệu 100% cotton, cổ V mở cúc, tay phồng.', 'Áo kiểu nữ cotton cổ V tay phồng in họa tiết', 300000, 7, 0),
(10, 'https://canifa.com/img/1000/1500/resize/8/t/8te23w008-sl146-xl-1-u.webp', 'Áo len nam cổ tròn dáng ôm gọn bằng sợi 50% acrylic 50% Polyester mềm, mịn có cổ tròn, viền gân nổi, tay dài với cổ tay và gấu bo gân nổi.\r\nChất liệu mềm mại, nhẹ nhưng ấm tạo cảm giác thoải mái cho người mặc trong thời tiết thu đông. Màu sắc rất đa dạng,', 'Áo len nam cổ tròn dáng ôm', 299000, 24, 1),
(11, 'https://canifa.com/img/1000/1500/resize/8/t/8te22w021-sg440-xl-1.webp', 'Áo len chất liệu polyester pha, cổ polo tay cộc, phôm regular.', 'Áo len nam cổ polo cộc tay dáng suông', 499000, 10, 1),
(12, 'https://canifa.com/img/1000/1500/resize/8/t/8th23w003-ck069-xl-1-a-u.webp', 'Áo sơ mi nam tay dài flannel kẻ caro, chất liệu cotton thông thoáng, form regular fit với độ ôm sát cơ thể vừa phải, thoải mái cả ngày dài. Đường may tỉ mỉ, kiểm soát chất lượng chỉ, đường may một cách hoàn hảo mang đến cho khách hàng một sản phẩm chỉn ch', 'Áo sơ mi nam cotton flannel họa tiết kẻ', 599000, 10, 1),
(13, 'https://canifa.com/img/1000/1500/resize/8/t/8th23w007-sa818-xl-1-u.webp', 'Áo được thiết kế theo form regular fit ôm dáng vừa phải giúp cho những hoạt động đều có thể diễn ra thoải mái.\r\nÁo sơ mi nam sử dụng nguyên liệu bamboo cao cấp tạo cảm giác thoáng mát - ít nhăn - thấm hút mồ hôi.', 'Áo sơ mi tay dài nam bamboo trơn dáng suông', 599000, 10, 1),
(14, 'https://canifa.com/img/1000/1500/resize/8/t/8th20s016-sb167-s.webp', 'Áo sơ mi nam.\r\n37% cotton 32% linen 31% viscose.\r\n100% linen.', 'Áo sơ mi nam dáng suông basic', 149000, 16, 1),
(15, 'https://canifa.com/img/1000/1500/resize/8/t/8tw23c001-sw011-xl-1-u.webp', 'Áo nỉ dáng relax, phần vai áo được thiết kế rộng hơn bình thường, mang lại cảm giác thoải mái khi chuyển động. Dáng áo phù hợp với dáng người hình tam giác hoặc hình chữ nhật.', 'Áo nỉ nam dáng rộng in hình Mickey', 699000, 7, 1),
(16, 'https://canifa.com/img/1000/1500/resize/8/t/8tw23w004-sa142-xl-1-u.webp', 'Áo nỉ có mũ chất liệu cotton pha, mặt trái chải xù mềm và in hoạ tiết. Cổ tay và gấu bo gân nổi.\r\nÁo được thiết kế vừa vặn, thoải mái, tiện lợi trong mọi hoạt động. Áo phù hợp để mặc thường ngày, dễ dàng phối layer tạo nhiều set thời trang đa phong cách.', 'Áo nỉ nam có mũ in hình trước ngực', 499000, 17, 1),
(17, 'https://canifa.com/img/1000/1500/resize/8/t/8th23w008-sl165-xl-1-u.webp', 'Áo sơ mi nam dài tay Oxford, chất liệu cotton thông thoáng, form regular fit với độ ôm sát cơ thể vừa phải, thoải mái cả ngày dài. Đường may tỉ mỉ, kiểm soát chất lượng chỉ, đường may một cách hoàn hảo mang đến cho khách hàng một sản phẩm chỉnh chu.', 'Áo sơ mi Oxford nam cotton dài tay', 499000, 15, 1),
(18, 'https://canifa.com/img/1000/1500/resize/8/t/8te23w020-sb001-xl-1-u.webp', 'Áo polo sợi nam dài tay, dệt mặt hàng dáng suông dài tay. Áo dáng regular với đặc trưng vừa phần vai, phần thân và tay áo hơi ôm vào body nhưng không đem lại sự khó chịu hay bó sát.', 'Áo polo sợi nam dài tay dáng suông', 599000, 10, 1),
(19, 'https://canifa.com/img/1000/1500/resize/8/t/8te23w013-sb001-xl-1-u.webp', 'Áo len gilet cổ tim Canifa dễ dàng kết hợp với áo sơ mi dài tay và áo khoác là một sự lựa chọn thú vị cho nam giới trong mùa thu đông này. Kiểu dáng ôm vừa, gọn gàng và kiểu dệt họa tiết trám chìm trẻ trung, nổi bật mà vẫn tinh tế.', 'Áo len gilet nam cổ tim', 499000, 16, 1),
(20, 'https://product.hstatic.net/1000284478/product/27_cc1-02000184_1_541d517303d64b5b87742720786d543d.jpg', 'Chất liệu: Alloy\r\nChất liệu hợp kim cao cấp, sáng bóng\r\nDễ dàng kết hợp với nhiều loại trang phục, phụ kiện đi kèm nhằm tôn lên nét đẹp tinh tế của phái đẹp\r\nXuất xứ thương hiệu: Việt Nam', 'Khuyên tai nữ hình chiếc nơ đính đá lấp lánh', 99000, 2, 2),
(21, 'https://product.hstatic.net/1000284478/product/27_cc3-01000152_2_37164c359bba4cfd88539830fcc300ab.jpg', 'Thương hiệu: Ceci\r\nXuất xứ: Việt Nam\r\nGiới tính: Nữ\r\nKiểu dáng: Vòng đeo tay dạng hở\r\nMàu sắc: Gold\r\nChất liệu: Titanium Steel', 'Vòng đeo tay nữ dạng hở phối charm hình bướm đính đá', 289000, 6, 2),
(22, 'https://product.hstatic.net/1000284478/product/07_cc1-09000213_1_c09efa6d7f3745f49c49dda9331f1dbd.jpg', 'Thương hiệu: Ceci\r\nXuất xứ: Việt Nam\r\nGiới tính: Nữ\r\nKiểu dáng: Khuyên tai dạng kẹp\r\nMàu sắc: Silver\r\nChất liệu: Copper', 'Khuyên tai nữ dạng kẹp xoắn ba vòng đính đá', 249000, 12, 2),
(23, 'https://product.hstatic.net/1000284478/product/07_cc4-01000386_2_ca5c1a47f79743e192175b2396601f08.jpg', 'Thương hiệu: Ceci\r\nXuất xứ: Việt Nam\r\nGiới tính: Nữ\r\nKiểu dáng: Vòng cổ chuỗi xích nhỏ\r\nMàu sắc: Silver\r\nChất liệu: Titanium Steel', 'Vòng cổ nữ phối mặt bươm bướm đính đá sang trọng', 249000, 4, 2),
(24, 'https://product.hstatic.net/1000284478/product/07_cc3-01000147_1_6188a6fd83824197903c2bef0f3356f7.jpg', 'Thương hiệu: Ceci\r\nXuất xứ: Việt Nam\r\nGiới tính: Nữ\r\nKiểu dáng: Vòng đeo tay nhiều vòng\r\nMàu sắc: Silver\r\nChất liệu: Copper', 'Vòng đeo tay nữ mắt xích phối mặt trái tim xinh xắn', 229000, 6, 2),
(25, 'https://product.hstatic.net/1000284478/product/27_cc4-01000406_2_fb3ffbac1b724b468bda7ea47673c990.jpg', 'Thương hiệu: Ceci\r\nXuất xứ: Việt Nam\r\nGiới tính: Nữ\r\nKiểu dáng: Vòng cổ chuỗi xích nhỏ\r\nMàu sắc: Gold\r\nChất liệu: Titanium Steel', 'Vòng cổ nữ chuỗi xích mặt hình kim cúc cài cá tính', 229000, 4, 2),
(26, 'https://product.hstatic.net/1000284478/product/01_pw2-66390004_1_eff765d08906468cafb2964c7b107870.jpg', 'Chất liệu: Faux Leather/ Microfiber\r\nKích thước: W28 x H14 x D12 (cm)\r\nXuất xứ thương hiệu: Singapore', 'Túi đeo vai nữ hình thang Cuba Liberty Bowling', 1599000, 6, 2),
(27, 'https://product.hstatic.net/1000284478/product/12_pw2-56390032_1_92fd15822b1644c5b8f5675834939c80.jpg', 'Thương hiệu: Pedro\r\nXuất xứ: Singapore\r\nKiểu dáng: Túi xách\r\nChất liệu: Faux Leather\r\nKích thước: H11 x W17.5 x D5.5 (cm)', 'Túi xách nữ phôm chữ nhật Chain Handle', 1299000, 4, 2),
(28, 'https://product.hstatic.net/1000284478/product/01_pm3-15940242_2_cac1d20633d2455fb57aa3ee993b5868.jpg', 'Kiểu dáng thắt lưng bản vừa thanh lịch\r\nMặt khóa chữ nhật sang trọng\r\nKhắc logo thương hiệu tinh tế\r\nĐộ dài linh hoạt, phù hợp với nhiều thể trạng cơ thể\r\nXuất xứ thương hiệu: Singapore', 'Thắt lưng nam bản vừa khóa kim loại sang trọng', 1399000, 13, 2),
(29, 'https://product.hstatic.net/1000284478/product/oce_tic2068_1_ff221e9844d94c24bcd27fcced7c9610.jpg', 'Thương hiệu: Charles Tyrwhitt\r\nXuất xứ: Anh\r\nGiới tính: Nam\r\nKiểu dáng: Cà vạt lụa\r\nMàu sắc: Ocean Blue\r\nChất liệu: 67% silk, 33% linen\r\nKích thước: 8 x 149 (cm)', 'Cà vạt nam thời trang Silk Linen', 1690000, 17, 2),
(30, 'https://canifa.com/img/1000/1500/resize/6/b/6bs23w009-sl213-m-1-u.webp', 'Quần shorts nữ, dáng hơi A, có dây rút eo, chất liệu interlock dầy dặn, thoải mái, dễ chịu cho người mặc, phù hợp với đi chơi, thời tiết mùa thu, mùa xuân.', 'Quần soóc nữ interlock có dây rút', 349000, 12, 3),
(31, 'https://canifa.com/img/1000/1500/resize/6/b/6bp23w006-sm438-m-1-u.webp', 'Quần nỉ nữ dáng jogger basic, thiết kế vừa vặn với chất liệu đàn hồi giúp vận động thoải mái, bề mặt bên trong vải được dệt với cấu trúc vòng sợi giúp giữ nhiệt nhưng vẫn thoáng khí mang lại sự thoải mái cho người mặc.', 'Quần nỉ nữ basic dáng jogger', 399000, 17, 3),
(32, 'https://canifa.com/img/1000/1500/resize/6/b/6bp23w009-sk010-m-1-u.webp', 'Quần dài nữ chất liệu gió, phong cách khỏe khoắn với chi tiết túi hộp và rút dây hay bên gấu, tạo nên một sản phẩm năng động, thoải mái phù hợp với giới trẻ. Chất liệu nhẹ, cản gió, thích hợp thời tiết mưa gió ẩm tại Việt Nam. Vải ít bám bẩn, không nhăn ', 'Quần dài nữ chất liệu gió túi hộp', 799000, 24, 3),
(33, 'https://canifa.com/img/1000/1500/resize/6/b/6bp23s002-sa643-m-1.webp', '94% polyester 6% spandex. Giặt tay ở nhiệt độ thường, không được ngâm. Không sử dụng hóa chất tẩy có chứa Clo. Phơi trong bóng mát. Không sử dụng máy sấy. Là ở nhiệt độ thấp 110 độ C. Giặt với sản phẩm cùng màu. Không là lên chi tiết trang trí.', 'Quần dài nữ dáng suông', 499000, 20, 3),
(34, 'https://canifa.com/img/1000/1500/resize/6/b/6bs22s004-sg260-m-1-u.webp', '60% cotton 40% polyester. Quần soóc nữ cạp chun chất liệu cotton pha, nhiều màu sắc, phôm dáng thoải mái', 'Quần soóc nữ cạp chun', 99500, 21, 3),
(35, 'https://canifa.com/img/1000/1500/resize/6/d/6ds23w023-sa792-m-1-u.webp', 'Váy liền nữ cổ bẻ, dáng dài có cắt bổ thân tạo eo, giúp người mặc vô cùng tôn dáng, tay xếp nếp tạo bồng nhẹ, chất liệu interlock dầy dặn, thoải mái, dễ chịu cho người mặc, phù hợp với đi chơi, đi làm, thời tiết mùa thu, mùa xuân.', 'Váy liền nữ interlock cổ bẻ dáng dài', 599000, 10, 3),
(36, 'https://canifa.com/img/1000/1500/resize/6/d/6ds23s006-sl114-m-1.webp', '63% cotton 34% nylon 3% spandex. Váy liền nữ.', 'Váy liền nữ sát nách cổ đức có đai thắt eo', 499000, 12, 3),
(37, 'https://canifa.com/img/1000/1500/resize/6/k/6ks23w009-sp116-m-1-u.webp', 'Chân váy dài qua gối nữ, dáng hơi A, có dây rút eo, chất liệu interlock dầy dặn, thoải mái, dễ chịu cho người mặc, phù hợp với đi chơi, đi làm, thời tiết mùa thu, mùa xuân.\r\nChất liệu Cotton Polyester', 'Chân váy nữ interlock dài qua gối có xẻ trước', 499000, 21, 3),
(38, 'https://canifa.com/img/1000/1500/resize/6/k/6ks23w016-sa848-m-1-u.webp', 'Chân váy ngắn có quần bên trong, dáng hơi A,\r\ncó dây rút eo.\r\nChất liệu interlock dầy dặn, thoải mái, dễ chịu.\r\nChất liệu cotton polyester.', 'Quần váy nữ interlock dáng ngắn', 399000, 10, 3),
(39, 'https://canifa.com/img/1000/1500/resize/6/k/6ks23c001-sj672-m-1.webp', 'Chân váy jean chất liệu 100% cotton, cạp thường cài cúc, phôm regular.', 'Chân váy jeans nữ cotton dáng suông', 549000, 12, 3),
(40, 'https://canifa.com/img/1000/1500/resize/8/b/8bp23w014-sa251-xl-1-u.webp', 'Quần nỉ jogger với phần bo ống ở gấu quần, kiểu dáng khỏe khoắn và nam tính. Độ dày vừa phải đảm bảo sự thoải mái và tiện lợi trong mọi hoạt động. Điểm nhấn can phối ở chân tạo cảm giác trẻ trung và nổi bật.', 'Quần nỉ nam dáng jogger', 599000, 12, 4),
(41, 'https://canifa.com/img/1000/1500/resize/8/b/8bp23w011-sa598-xl-1-u.webp', 'Quần nỉ nam form regular mang phong cách năng động, cá tính. Phần cuối của ống may thêm chun túm có chốt chặn. Quần được thiết kế nhiều túi mang đến sự tiện dụng cho người mặc.', 'Quần nỉ nam gấu chun có chốt chặn', 599000, 17, 4),
(42, 'https://canifa.com/img/1000/1500/resize/8/b/8bk23a001-sk010-31-1.webp', 'Quần khaki chất liệu cotton pha, cạp thường cài cúc, phôm regular. 65% cotton 35% polyester.', 'Quần khaki nam dáng suông', 349000, 10, 4),
(43, 'https://canifa.com/img/1000/1500/resize/8/b/8bk23a007-sg228-31-1.webp', 'Quần khaki nam dáng slimfit thoải mái, dễ mặc.\r\nChất liệu khaki dày dặn, bền chắc.\r\nThiết kế basic, phù hợp với nhiều dáng người châu Á. Độ đàn hồi tốt, tạo cảm giác thoải mái cho người mặc trong mọi hoạt động.', 'Quần khaki nam dáng ôm túi chéo', 599000, 17, 4),
(44, 'https://canifa.com/img/1000/1500/resize/8/b/8bj23a002-sj772-31-21.webp', 'Quần jeans chất liệu cotton pha, cạp thường cài cúc, phôm ôm.', 'Quần jeans nam dáng ôm', 799000, 16, 4),
(45, 'https://canifa.com/img/1000/1500/resize/8/b/8bs23s003-sb680-xl-1.webp', 'Quần soóc chất liệu 100% cotton, cạp chun luồn dây dệt, túi chéo 2 bên.', 'Quần soóc nam cotton cạp chun túi chéo', 399000, 24, 4),
(46, 'https://canifa.com/img/1000/1500/resize/8/b/8bs23s006-sk010-31-1.webp', 'Quần soóc chất liệu cotton, cạp thường cài cúc, túi chéo 2 bên.', 'Quần soóc nam có túi hai bên', 549000, 14, 4),
(47, 'https://canifa.com/img/1000/1500/resize/8/b/8bs23s004-fg114-xl-1.webp', 'Quần soóc chất liệu 100% cotton, cạp chun luồn dây dệt, phôm regular.', 'Quần soóc nam cotton cạp chun', 399000, 20, 4),
(48, 'https://canifa.com/img/1000/1500/resize/8/b/8bs23s011-se237-xl-1.webp', 'Quần soóc chất liệu cotton pha, cạp chun, túi ốp 2 bên.', 'Quần soóc nam cạp chun túi ốp hai bên', 419000, 24, 4),
(49, 'https://canifa.com/img/1000/1500/resize/8/b/8bs23s012-sj796-xl-1.webp', 'Quần soóc chất liệu jean 100% cotton, cạp chun luồn dây dệt, túi ốp 1 bên, phôm regular.', 'Quần soóc jeans nam cotton cạp chun dáng suông', 384000, 16, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product category`
--

CREATE TABLE `product category` (
  `Id` int(11) NOT NULL,
  `Category name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product category`
--

INSERT INTO `product category` (`Id`, `Category name`) VALUES
(0, 'Áo nữ'),
(1, 'Áo nam'),
(2, 'Phụ kiện'),
(3, 'Quần/ Váy nữ'),
(4, 'Quần nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shopping cart`
--

CREATE TABLE `shopping cart` (
  `Id` int(11) NOT NULL,
  `Transaction Id customer` varchar(255) NOT NULL,
  `Transaction Id merchant` varchar(255) NOT NULL,
  `Oder Id` int(11) NOT NULL,
  `Customer Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shopping cart item`
--

CREATE TABLE `shopping cart item` (
  `Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Product ID` int(11) NOT NULL,
  `Shopping cart Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Customer Id` (`Customer Id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `product category id` (`Product category ID`);

--
-- Chỉ mục cho bảng `product category`
--
ALTER TABLE `product category`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `shopping cart`
--
ALTER TABLE `shopping cart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Oder id` (`Oder Id`);

--
-- Chỉ mục cho bảng `shopping cart item`
--
ALTER TABLE `shopping cart item`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `product id` (`Product ID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Customer Id` FOREIGN KEY (`Customer Id`) REFERENCES `customer` (`Id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product category id` FOREIGN KEY (`Product category ID`) REFERENCES `product category` (`Id`);

--
-- Các ràng buộc cho bảng `shopping cart`
--
ALTER TABLE `shopping cart`
  ADD CONSTRAINT `Oder id` FOREIGN KEY (`Oder Id`) REFERENCES `order` (`Id`);

--
-- Các ràng buộc cho bảng `shopping cart item`
--
ALTER TABLE `shopping cart item`
  ADD CONSTRAINT `product id` FOREIGN KEY (`Product ID`) REFERENCES `product` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
