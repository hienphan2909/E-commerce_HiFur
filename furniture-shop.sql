-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 25, 2022 lúc 05:20 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `furniture-shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `image`, `email`, `password`) VALUES
(1, 'Phan Minh Hiền', 'logo.jpg', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `cust_id`, `product_id`, `quantity`) VALUES
(28, 5, 42, 2),
(86, 4, 42, 2),
(87, 4, 40, 2),
(88, 4, 41, 2),
(89, 4, 37, 1),
(90, 5, 40, 2),
(91, 5, 13, 1),
(109, 15, 19, 1),
(164, 16, 43, 1),
(165, 16, 42, 2),
(166, 16, 35, 1),
(184, 1, 58, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `fontawesome-icon` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category`, `fontawesome-icon`) VALUES
(1, 'Giường ngủ', 'fa-bed'),
(2, 'Bộ bàn ăn', 'fa-utensils-alt'),
(3, 'Ghế các loại', 'fa-chair-office'),
(4, 'Bàn', 'fa-columns'),
(5, 'Ghế Sofa', 'fa-couch'),
(6, 'Tủ đựng chén', 'fa-columns'),
(7, 'Đèn trang trí', 'fal fa-lamp-floor');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) COLLATE utf8mb4_croatian_ci NOT NULL,
  `cust_email` varchar(100) COLLATE utf8mb4_croatian_ci NOT NULL,
  `cust_pass` varchar(100) COLLATE utf8mb4_croatian_ci NOT NULL,
  `cust_add` varchar(200) COLLATE utf8mb4_croatian_ci NOT NULL,
  `cust_postalcode` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `cust_city` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `cust_number` varchar(100) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_pass`, `cust_add`, `cust_city`, `cust_postalcode`, `cust_number`) VALUES
(17, 'Phan Minh Hiền', 'hien@gmail.com', '123', 'Cần Thơ', 'Cần Thơ', '1234567', '1234567'),
(18, 'Phan Minh Hiền', 'me@example.com', '123', 'Cần Thơ', 'Cần Thơ', '12345', '12345'),
(19, 'Phạm Châu Vô 2', 'vo2@gmail.com', '123', 'Cần Thơ', 'Cần Thơ', '123456789', '123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `customer_fullname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `customer_address` varchar(225) CHARACTER SET utf8 NOT NULL,
  `customer_city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `customer_pcode` int(11) NOT NULL,
  `customer_phonenumber` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `products_qty` int(11) NOT NULL,
  `order_date` varchar(100) CHARACTER SET utf8 NOT NULL,
  `order_status` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `customer_id`, `customer_email`, `customer_fullname`, `customer_address`, `customer_city`, `customer_pcode`, `customer_phonenumber`, `product_id`, `product_amount`, `invoice_no`, `products_qty`, `order_date`, `order_status`) VALUES
(98, 17, 'hien@gmail.com', 'Phan Minh Hiền', 'Cần Thơ', 'Cần Thơ', 1234567, '1234567', 56, 400000, 907041334, 1, '25-04-2022', 'Chờ xác nhận'),
(99, 17, 'hien@gmail.com', 'Phan Minh Hiền', 'Cần Thơ', 'Cần Thơ', 1234567, '1234567', 54, 260000, 907041334, 1, '25-04-2022', 'Chờ xác nhận'),
(100, 17, 'hien@gmail.com', 'Phan Minh Hiền', 'Cần Thơ', 'Cần Thơ', 1234567, '1234567', 55, 2425000, 907041334, 1, '25-04-2022', 'Đã xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `furniture_product`
--

CREATE TABLE `furniture_product` (
  `pid` int(11) NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_croatian_ci NOT NULL,
  `category` int(11) NOT NULL,
  `detail` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(40) COLLATE utf8mb4_croatian_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_croatian_ci NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_croatian_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Đang đổ dữ liệu cho bảng `furniture_product`
--

INSERT INTO `furniture_product` (`pid`, `title`, `category`, `detail`, `price`, `size`, `image`, `date`, `status`) VALUES
(5, 'Ghế new modern Chair v837', 3, '<p>Đ&acirc;y l&agrave; chiếc ghế mới hiện đại</p>\r\n', 190000, '35cm x 35cm', 'chairyellow.jpg', '10-04-2022', 'Công khai'),
(13, 'Ghế Sofa Esquel 1 Chỗ', 5, '<p>Sofa Esquel 1 Chỗ sẽ mang đến cho bạn sự thoải m&aacute;i v&agrave; th&ecirc;m phong c&aacute;ch ho&agrave;n to&agrave;n mới cho kh&ocirc;ng gian của bạn bằng c&aacute;ch th&ecirc;m m&agrave;u x&aacute;m</p>\r\n', 920000, '90cm X 60cm', 'Esquel1SeaterSofa-Gray3_1024x1024.webp', '10-04-2022', 'Công khai'),
(15, 'Ghế sofa Boeno - 2 chỗ ngồi', 5, '<p>Được thiết kế tinh tế để mang lại sự thoải m&aacute;i cho bạn Sofa Boeno 2 Chỗ sẽ t&ocirc;n l&ecirc;n diện mạo cho địa điểm của bạn v&agrave; th&ecirc;m m&agrave;u X&aacute;m Than để l&agrave;m cho nơi n&agrave;y tr&ocirc;ng rạng rỡ hơn</p>\r\n', 1300000, '150cm X 80cm', 'Boeno2SeaterSofa-CharcoalGray_1024x1024.webp', '10-04-2022', 'Công khai'),
(16, 'Ghế sofa Valerie - 4 chỗ ngồi', 5, '', 2500000, '220cm X 70cm', '13aaa_692e5742-f306-4898-9909-469c2658b09f_1024x1024.webp', '10-04-2022', 'Công khai'),
(17, 'Valerie 2 Seater Sofa - Saphire Blue', 5, '<p>Vẻ đẹp kh&oacute; cưỡng chiếc ghế sofa 2 chỗ Valerie c&oacute; sức sống vượt thời gian với những đường cong nhưng g&oacute;c cạnh tối giản trong m&agrave;u Xanh Sapphire rất ri&ecirc;ng sẽ l&agrave; sự lựa chọn tốt nhất để kh&ocirc;ng gian của bạn bừng s&aacute;ng.</p>\r\n', 46500, '120cm x 150cm', '13a_9e902afc-6519-4bf4-8ecf-871bd850a5fc_1024x1024.webp', '10-04-2022', 'Công khai'),
(19, 'Ghế sofa Flavia - 2 chỗ ngồi', 5, '<p>Sang trọng v&agrave; lu&ocirc;n mang phong c&aacute;ch Sofa Flavia 2 chỗ ngồi ho&agrave;n to&agrave;n c&oacute; thể thay đổi diện mạo kh&ocirc;ng gian của bạn bằng c&aacute;ch th&ecirc;m Azul Green v&agrave;o mảng m&agrave;u hiện c&oacute; của bạn.</p>\r\n', 1000000, '110cm X 70cm', '14aaa_1024x1024.webp', '10-04-2022', 'Công khai'),
(20, 'Ghế vựa Lazarus', 3, '<p>Chiều cao: 100cm. Chiều rộng: 70cm. Chất liệu: Đệm ngồi v&agrave; lưng tựa khung kim loại mạ cr&ocirc;m</p>\r\n', 200000, '200cm x 70cm', 'Lazarus_Visiting_Chair_1_1024x1024.jpg', '10-04-2022', 'Công khai'),
(22, 'Ghế văn phòng Rachelle', 3, '<p>Ghế văn ph&ograve;ng&nbsp;</p>\r\n', 1500000, '160cm x 80cm', 'Rachelle_office_chair_1b5bcb48-3cdb-4046-9b4e-ee0b04cd1f68_1024x1024.jpg', '10-04-2022', 'Công khai'),
(25, 'Giường ngủ đôi Brisk ', 1, '<p>Đối t&aacute;c b&aacute;o lại cuối c&ugrave;ng, Brisk l&agrave; đối t&aacute;c l&yacute; tưởng cho ph&ograve;ng ngủ của bạn. Thủ c&ocirc;ng mỹ nghệ tạo điểm nhấn cho thiết kế v&agrave; gi&uacute;p bạn thư gi&atilde;n sau một ng&agrave;y l&agrave;m việc mệt mỏi. M&agrave;u &oacute;c ch&oacute; n&oacute;i l&ecirc;n sự Tối giản &amp; Hiệu quả!</p>\r\n', 3000000, '220cm X 200cm', '46_ce9acbf1-005f-4f0e-869d-2ad350941303_1024x1024.jpg', '10-04-2022', 'Công khai'),
(27, 'Gường ngủ đôi Edler Upholstered', 1, '<p>Edler đi k&egrave;m với c&aacute;c ngăn k&eacute;o lưu trữ b&ecirc;n dưới v&agrave; giữ cho n&oacute; sang trọng nhưng cổ điển. N&oacute; bền, rộng r&atilde;i v&agrave; sẽ tồn tại suốt đời như một căn ph&ograve;ng ho&agrave;n hảo của bạn. Vải bọc c&oacute; t&ocirc;ng m&agrave;u trung t&iacute;nh thể hiện sự kh&eacute;o l&eacute;o tối ưu v&agrave; c&oacute; t&aacute;c động đơn giản, tinh tế đến kh&ocirc;ng kh&iacute; căn ph&ograve;ng của bạn.</p>\r\n', 7200000, '220cm X 200cm', '41_1024x1024.png', '10-04-2022', 'Công khai'),
(28, 'Giường ngủ đôi Haven ', 1, '<p>Một thi&ecirc;n đường của sự y&ecirc;n b&igrave;nh, thoải m&aacute;i v&agrave; l&acirc;u bền, Haven khiến bạn kh&oacute; thức dậy v&agrave;o buổi s&aacute;ng. Sự hấp dẫn nhẹ nh&agrave;ng to&aacute;t ra từ lớp vải bọc cao cấp m&agrave;u trắng, n&oacute; chỉ đơn giản l&agrave; đưa bạn đến thi&ecirc;n đường!</p>\r\n', 8200000, '230cm X 210cm', '38a_1024x1024.jpg', '10-04-2022', 'Công khai'),
(29, 'Giường ngủ đôi Floyd', 1, '<p>Đ&oacute; l&agrave; một thiết kế độc đ&aacute;o với c&aacute;c nh&atilde;n c&oacute; phần thể thao tr&ecirc;n đầu giường với g&oacute;c nh&igrave;n tối thiểu của khung. L&agrave;m cho ph&ograve;ng ngủ của bạn trở n&ecirc;n thoải m&aacute;i v&agrave; vui vẻ hơn bao giờ hết với Floyd.</p>\r\n', 7900000, '220cm X 200cm', '37_ee3153ad-7d4c-44ce-a844-e9632dc388da_1024x1024.jpg', '10-04-2022', 'Công khai'),
(30, 'Giường ngủ đôi Trout', 1, '<p>Lựa chọn đồ nội thất cho ph&ograve;ng ngủ của bạn l&agrave; một c&ocirc;ng việc kh&oacute; khăn - bởi v&igrave; hiếm khi t&igrave;m được thiết kế đẹp v&agrave; thoải m&aacute;i c&ugrave;ng nhau. V&igrave; vậy, nếu bạn đang khao kh&aacute;t một kh&ocirc;ng gian tinh tế nhưng vẫn thoải m&aacute;i, th&igrave; đ&acirc;y l&agrave; những g&igrave; m&agrave; ph&ograve;ng ngủ của bạn xứng đ&aacute;ng c&oacute; được: Giường đ&ocirc;i c&aacute; hồi</p>\r\n', 7300000, '220cm X 200cm', '17_9c4a409f-bcf6-43f6-b31b-248ccea05bb6_1024x1024.jpg', '10-04-2022', 'Công khai'),
(31, 'Giường ngủ đôi Mocca', 1, '<p>Một thi&ecirc;n đường của sự y&ecirc;n b&igrave;nh, thoải m&aacute;i v&agrave; l&acirc;u bền, Haven khiến bạn kh&oacute; thức dậy v&agrave;o buổi s&aacute;ng. Sự hấp dẫn nhẹ nh&agrave;ng to&aacute;t ra từ lớp vải bọc cao cấp m&agrave;u trắng, n&oacute; chỉ đơn giản l&agrave; đưa bạn đến thi&ecirc;n đường!</p>\r\n', 6850000, '220cm X 200cm', '36_60ec496a-a99e-4f51-bd5a-d33c003218ad_1024x1024.jpg', '10-04-2022', 'Công khai'),
(32, 'Giường ngủ đôi Spruce ', 1, '<p>Chiếc giường thanh lịch n&agrave;y l&agrave; một thiết kế đơn giản nhưng đầy t&iacute;nh thẩm mỹ sẽ l&agrave; một sự lựa chọn tuyệt đẹp cho ph&ograve;ng ngủ của bạn.</p>\r\n', 6500000, '220cm X 200cm', '32aaaaa_1024x1024.jpg', '10-04-2022', 'Công khai'),
(34, 'Bàn ăn ', 2, '', 320000, '90cm X 100cm', 'TheInvisibleCollection_KellyBehun_Table_RectangularMosaic.jpg', '10-04-2022', 'Công khai'),
(35, 'Bộ đồ ăn Raimi', 2, '<p>B&agrave;n ăn hiện đại</p>\r\n', 1200000, '130cm x 120cm', 'raimi_2_14e717a7-b66f-471c-9f7d-70d564968d3e_1024x1024.webp', '10-04-2022', 'Công khai'),
(37, 'Bộ đồ ăn Tapert-Trắng', 2, '<p>Bộ b&agrave;n ăn hiện&nbsp; đại với gỗ sồi v&agrave; được sơn PU chống mọt&nbsp;</p>\r\n', 1300000, '120cm x 90cm', 'tapert_a5df0f6b-6717-4707-abe7-da623cdcdf2c_1024x1024.webp', '10-04-2022', 'Công khai'),
(39, 'Bàn xếp Lorenzo', 4, '<p>Mặt tr&ecirc;n l&agrave;m bằng MDF phủ giấy PVC c&oacute; 4 ghế đ&ocirc;n, khung l&agrave;m bằng ống MS sơn tĩnh điện m&agrave;u đen.</p>\r\n', 249000, '40cm x 80cm', 'coffee-table-design-glass-and-wood-scandinavian-fiord-l-110xp60xh45cm.jpg', '10-04-2022', 'Công khai'),
(40, 'Bàn xếp v8', 4, '<p>B&agrave;n xếp hiện&nbsp; đại&nbsp;</p>\r\n', 420000, '40cm x 80cm', 'aza_1024x1024.jpg', '10-04-2022', 'Công khai'),
(41, 'Bàn xếp v2', 5, '<p>B&agrave;n xếp v2 ch&acirc;n sắt chắc chắn v&agrave; được sơn chống rỉ s&eacute;t. Mặt b&agrave;n gỗ th&ocirc;ng đẹp&nbsp;</p>\r\n', 120000, '40cm x 80cm', 'FC-FUR-BS-510_1024x1024.jpg', '10-04-2022', 'Công khai'),
(42, 'Bàn xếp v10', 4, '<p>B&agrave;n xếp v10 thiết kế hiện đại v&agrave; gon g&agrave;ng thuận tiện cho những căn ph&ograve;ng c&oacute; kh&ocirc;ng gian hẹp</p>\r\n', 120000, '40cm x 80cm', 'sads_1024x1024.jpg', '10-04-2022', 'Công khai'),
(43, 'Ghế Văn Phòng Tay Gập Chân Xoay GHE_VP6801', 3, '<p><strong>Ghế xoay lưới&nbsp;</strong>GHE_VP680&nbsp;<strong>&ndash; Giải ph&aacute;p tuyệt vời gi&uacute;p n&acirc;ng cao hiệu quả c&ocirc;ng việc</strong></p>\r\n\r\n<p>Bạn biết kh&ocirc;ng, ghế ngồi văn ph&ograve;ng l&agrave; một yếu tố rất quan trọng quyết định đến 2 yếu tố cơ bản trong c&ocirc;ng việc đ&oacute; l&agrave; sức khỏe của nh&acirc;n vi&ecirc;n v&agrave; hiệu suất c&ocirc;ng việc.</p>\r\n\r\n<p>Bởi v&igrave; sao? Ch&uacute;ng ta đều biết d&acirc;n văn ph&ograve;ng mỗi ng&agrave;y phải ngồi đến 8 tiếng để l&agrave;m việc v&agrave; nếu c&aacute;c sếp kh&ocirc;ng quan t&acirc;m đến điều n&agrave;y, kh&ocirc;ng lựa chọn được một mẫu ghế ngồi ph&ugrave; hợp cho nh&acirc;n vi&ecirc;n th&igrave; sẽ ảnh hưởng rất lớn đến sức khỏe của họ, trong đ&oacute; nguy cơ h&agrave;ng đầu l&agrave; c&aacute;c bệnh về xương khớp như đau lưng, tho&aacute;i h&oacute;a xương khớp&hellip; v&agrave; điều n&agrave;y sẽ ảnh hưởng trực tiếp đến hiệu suất c&ocirc;ng việc của nh&acirc;n vi&ecirc;n.</p>\r\n\r\n<p>L&agrave; mẫu ghế mới được ra mắt năm 2021, sản phẩm n&agrave;y của Thi&ecirc;n Minh sẽ l&agrave; sự lựa chọn ho&agrave;n hảo cho giới văn ph&ograve;ng với thiết kế độc đ&aacute;o gi&uacute;p giảm đau lưng, v&agrave; thư gi&atilde;n hiệu quả v&agrave; bảo vệ sức khỏe cho nh&acirc;n vi&ecirc;n, từ đ&oacute; gi&uacute;p bạn giải quyết nỗi lo chọn ghế cho nh&acirc;n vi&ecirc;n văn ph&ograve;ng.</p>\r\n', 800000, '88 cm - 98cn', 'O1CN0123V7uC2hHFmojZC_493317260.jpg', '10-04-2022', 'Công khai'),
(52, 'Tủ chén bát gỗ', 6, '<ul>\r\n	<li><strong><em>Tủ ch&eacute;n b&aacute;t gỗ</em></strong>: ph&aacute;t triển từ tủ gỗ, chạn gỗ đựng ch&eacute;n b&aacute;t, đồ d&ugrave;ng nấu ăn truyền thống. Tủ gỗ đựng ch&eacute;n b&aacute;t hay l&agrave;m tủ bếp hiện đại c&oacute; h&igrave;nh d&aacute;ng chắc chắn, sang trọng nhưng kh&aacute; cồng kềnh v&agrave; c&oacute; gi&aacute; mắc. Bạn c&oacute; thể chọn tủ bếp gỗ c&ocirc;ng nghiệp để gi&aacute; rẻ hơn.</li>\r\n</ul>\r\n', 800000, '120cm x 200cm', 'mau-tu-nhom-kinh-dung-chen-bat.png', '10-04-2022', 'Công khai'),
(53, 'Tủ chén bát gỗ công nghiệp ', 6, '<ul>\r\n	<li><strong><em>Tủ ch&eacute;n b&aacute;t gỗ</em></strong>: ph&aacute;t triển từ tủ gỗ, chạn gỗ đựng ch&eacute;n b&aacute;t, đồ d&ugrave;ng nấu ăn truyền thống. Tủ gỗ đựng ch&eacute;n b&aacute;t hay l&agrave;m tủ bếp hiện đại c&oacute; h&igrave;nh d&aacute;ng chắc chắn, sang trọng nhưng kh&aacute; cồng kềnh v&agrave; c&oacute; gi&aacute; mắc. Bạn c&oacute; thể chọn tủ bếp gỗ c&ocirc;ng nghiệp để gi&aacute; rẻ hơn.</li>\r\n	<li>Hiện đại sang trọng&nbsp;</li>\r\n</ul>\r\n', 500000, '220cm X 200cm', 'tu-dung-bat-dia-bang-go-33--jpg-1578033890.jpeg', '10-04-2022', 'Công khai'),
(54, 'Đèn thả hiện đại THCN 28/A-B-C', 7, '<p>Thiết kế hiện đại kiểu c&ocirc;ng nghiệp.<br />\r\nĐ&egrave;n sử dụng b&oacute;ng Led cao cấp với tuổi thọ cao<br />\r\nGi&aacute; chưa bao gồm b&oacute;ng<br />\r\nTh&iacute;ch hợp trang tr&iacute; cho qu&aacute;n cafe, nh&agrave; ở gia đ&igrave;nh v&agrave; nhiều kh&ocirc;ng gian kh&aacute;c nhau.</p>\r\n', 260000, 'Ø360 xH180 x E27*1', 'XS-510x510.jpg', '15-04-2022', 'Công khai'),
(55, 'Đèn thả kiểu công nghiệp hình chiếc xe đạp ', 7, '<ul>\r\n	<li>Chất liệu: Hợp kim sơn tĩnh điện</li>\r\n	<li>Thiết kế hiện đại c&ocirc;ng nghiệp kiểu Bắc &Acirc;u, mộc mạc, ho&agrave;i cổ.</li>\r\n	<li>Gi&aacute; sản phẩm chưa bao gồm b&oacute;ng đ&egrave;n Led, VAT v&agrave; ph&iacute; vận chuyển.</li>\r\n	<li>Th&iacute;ch hợp trang tr&iacute; cho qu&aacute;n cafe, nh&agrave; h&agrave;ng, nh&agrave; ở gia đ&igrave;nh v&agrave; nhiều kh&ocirc;ng gian kh&aacute;c nhau.</li>\r\n</ul>\r\n', 2425000, '880x500', 'ttk.14-510x515.jpg', '15-04-2022', 'Công khai'),
(56, 'Đèn thả tròn đui gỗ THCN 75A', 7, '<ul>\r\n	<li>Chất liệu: Hợp kim sơn tĩnh điện</li>\r\n	<li>Thiết kế hiện đại c&ocirc;ng nghiệp kiểu Bắc &Acirc;u, mộc mạc, ho&agrave;i cổ.</li>\r\n	<li>Gi&aacute; sản phẩm chưa bao gồm b&oacute;ng đ&egrave;n Led, VAT v&agrave; ph&iacute; vận chuyển.</li>\r\n	<li>Th&iacute;ch hợp trang tr&iacute; cho qu&aacute;n cafe, nh&agrave; h&agrave;ng, nh&agrave; ở gia đ&igrave;nh v&agrave; nhiều kh&ocirc;ng gian kh&aacute;c nhau.</li>\r\n</ul>\r\n', 400000, 'Ø350', 'T-i-gi-n-Hi-n-i-M-t-D-y-Chuy-n-n-E27-G_5-510x510.jpg', '15-04-2022', 'Công khai'),
(57, 'Giường ngủ mới nhất 2022', 1, '', 3000000, '220cmx200cm', '17_9c4a409f-bcf6-43f6-b31b-248ccea05bb6_1024x1024.jpg', '25-04-2022', 'Công khai'),
(58, 'Giường đôi Luxury', 1, '', 3000000, '220cmx200cm', '10_c3e2fbce-3ef1-4566-a44e-2d53c7be4cf5_1024x1024.webp', '25-04-2022', 'Công khai');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Chỉ mục cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `furniture_product`
--
ALTER TABLE `furniture_product`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `furniture_product`
--
ALTER TABLE `furniture_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `furniture_product` (`pid`);

--
-- Các ràng buộc cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `furniture_product` (`pid`);

--
-- Các ràng buộc cho bảng `furniture_product`
--
ALTER TABLE `furniture_product`
  ADD CONSTRAINT `furniture_product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
