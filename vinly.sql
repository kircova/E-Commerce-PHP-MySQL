-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 12:14 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinly`
--

-- --------------------------------------------------------

--
-- Table structure for table `average_rating`
--

CREATE TABLE `average_rating` (
  `arating` int(11) DEFAULT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pid` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`pid`, `cid`) VALUES
(21, 1),
(22, 2),
(23, 3),
(24, 4),
(25, 5),
(26, 6),
(27, 7),
(28, 8),
(29, 9),
(30, 10),
(31, 11);

-- --------------------------------------------------------

--
-- Table structure for table `cartdetails`
--

CREATE TABLE `cartdetails` (
  `cid` int(11) NOT NULL,
  `prid` int(11) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartdetails`
--

INSERT INTO `cartdetails` (`cid`, `prid`, `price`, `quantity`) VALUES
(1, 1, 163.00, 1),
(1, 22, 120.00, 1),
(2, 1, 133.00, 5),
(3, 3, 119.00, 2),
(3, 10, 106.25, 2),
(5, 3, 119.00, 1),
(5, 5, 119.00, 2),
(6, 9, 125.10, 9),
(7, 9, 125.10, 3),
(8, 9, 125.10, 4),
(9, 9, 125.10, 3),
(10, 9, 125.10, 2),
(11, 9, 125.10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `pid` int(11) NOT NULL,
  `prid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `com_text` text DEFAULT NULL,
  `rating` int(11) DEFAULT 5,
  `isVisible` tinyint(1) DEFAULT 1,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`pid`, `prid`, `cid`, `com_text`, `rating`, `isVisible`, `time`) VALUES
(21, 1, 1, 'Bu albüm rap piyasasını yerinden oynattı. İyi ki varsın Ceza! Çok seviyorum.', 5, 1, '2021-01-09 18:50:44'),
(21, 15, 2, 'Yok böyle bir albüm. Gerçekten çok etkileyici. Böyle bir ekip kolay kolay bir araya gelmez. Thundercat e sevgilelerle.', 5, 1, '2021-01-09 18:50:44'),
(21, 1, 3, 'Bu bir deneme yorumudur', 3, 1, '2021-01-09 22:05:03'),
(21, 1, 35, 'LETS GOOO', 5, 1, '2021-01-10 00:59:00'),
(21, 1, 58, 'asdf', 3, 1, '2021-01-10 03:16:00'),
(21, 1, 59, '', 2, 1, '2021-01-10 03:20:07'),
(23, 1, 60, 'asdfasdfasd', 4, 1, '2021-01-10 03:45:23'),
(23, 1, 62, 'asdf', 3, 1, '2021-01-10 03:49:51'),
(23, 1, 63, '', 1, 1, '2021-01-10 04:13:08'),
(23, 1, 64, '', 1, 1, '2021-01-10 04:13:12'),
(23, 1, 65, '', 1, 1, '2021-01-10 04:13:26'),
(23, 1, 66, '', 1, 1, '2021-01-10 04:13:31'),
(23, 1, 67, '', 1, 1, '2021-01-10 04:13:35'),
(23, 1, 68, '', 1, 1, '2021-01-10 04:13:40'),
(23, 1, 69, '', 1, 1, '2021-01-10 04:13:45'),
(23, 1, 70, '', 1, 1, '2021-01-10 04:13:49'),
(23, 1, 71, '', 1, 1, '2021-01-10 04:13:54'),
(23, 1, 72, '', 1, 1, '2021-01-10 04:13:59'),
(23, 1, 73, '', 1, 1, '2021-01-10 04:14:03'),
(23, 1, 74, 'son deneme söz', 4, 1, '2021-01-10 04:34:18'),
(23, 1, 75, 'çok iyi', 3, 0, '2021-01-11 17:17:00'),
(21, 1, 76, 'fena değil', 1, 0, '2021-01-11 21:49:01'),
(21, 1, 77, 'fena değil', 2, 0, '2021-01-11 21:50:23'),
(21, 1, 78, 'fena değil', 2, 0, '2021-01-11 21:51:20'),
(21, 1, 79, 'fena değil', 4, 0, '2021-01-11 21:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `pid` int(11) NOT NULL,
  `Review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`pid`, `Review`) VALUES
(21, NULL),
(22, NULL),
(23, NULL),
(24, NULL),
(25, NULL),
(26, NULL),
(27, NULL),
(28, NULL),
(29, NULL),
(30, NULL),
(31, 'Graphically attractive, informative, and user friendly!!'),
(33, 'Project of the year. Developers must have put a lot of hours into this website and it clearly payed off. A grade material...'),
(34, 'What an awesome website, it wouldn\'t surprise me to see the developers behind this website receiving a good grade..'),
(35, 'Good job! I am speechless. Talented group, talented people...'),
(36, 'No errors, just beautiful products and service. Thank you!');

-- --------------------------------------------------------

--
-- Table structure for table `makes`
--

CREATE TABLE `makes` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `makes`
--

INSERT INTO `makes` (`oid`, `pid`) VALUES
(1, 21),
(2, 21),
(2, 23),
(3, 23),
(4, 24),
(5, 25),
(6, 26),
(7, 27),
(8, 28),
(9, 29),
(10, 29),
(12, 24),
(13, 24),
(16, 21),
(17, 21);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `oid` int(11) NOT NULL,
  `prid` int(11) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`oid`, `prid`, `price`, `quantity`) VALUES
(1, 2, 159.98, 2),
(2, 1, 133.00, 5),
(2, 4, 100.00, 1),
(3, 10, 106.25, 1),
(4, 10, 106.25, 2),
(5, 9, 125.10, 3),
(6, 7, 66.30, 2),
(7, 3, 119.00, 5),
(8, 8, 133.00, 1),
(9, 7, 66.30, 2),
(10, 9, 125.10, 1),
(12, 9, 12.00, 1),
(12, 10, 106.25, 2),
(13, 5, 119.00, 1),
(14, 11, 65.00, 4),
(16, 11, 66.30, 3),
(17, 1, 163.00, 1),
(17, 8, 133.00, 1),
(18, 11, 66.30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `oid` int(11) NOT NULL,
  `orderdate` date DEFAULT NULL,
  `shipAddress` text NOT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `orderPrice` float(10,2) NOT NULL,
  `orderStatus` varchar(128) NOT NULL DEFAULT 'On delivery',
  `name` varchar(128) DEFAULT NULL,
  `surname` varchar(128) DEFAULT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`oid`, `orderdate`, `shipAddress`, `isActive`, `orderPrice`, `orderStatus`, `name`, `surname`, `email`) VALUES
(1, '2020-12-17', 'Suadiye Kadikoy', 1, 319.96, 'Delivered', 'Steph', 'Cur', 'steph@sabanciuniv.edu'),
(2, '2020-08-23', 'Orta, Sabancı Ünv., 34956 Tuzla/İstanbul', 1, 765.00, 'Delivered', 'Steve', 'Kerr', 'gsw3repeat@gmail.com'),
(3, '2020-12-14', 'Bebek, 34342 Beşiktaş/İstanbul', 1, 106.25, 'On delivery', 'Andre', 'Iggy', 'nevermissfinal@iggy.com'),
(4, '2020-12-31', 'Maslak Mahallesi, Taşyoncası Sokak, No: 1V ve No:1Y Bina Kodu: 34481742, 34398 Sarıyer/İstanbul', 1, 212.50, 'On delivery', 'Klay', 'Thompson', '3rdquarter@gmail.com'),
(5, '2020-12-13', 'Üniversiteler, Dumlupinar Bulvari 1/6-133, 06800 Çankaya/Ankara', 1, 375.30, 'On delivery', 'Draymond', 'Green', 'dray@anoyy.com'),
(6, '2020-12-04', 'Beyazıt, 34452 Fatih/İstanbul', 1, 132.60, 'On delivery', 'James', 'Wiseman', 'rot@gmail.com'),
(7, '2020-12-01', 'İTÜ Ayazağa Kampüsü, Rektörlük Binası, 34469 Maslak/İstanbul', 1, 595.00, 'On delivery', 'Joel', 'Embiid', 'bigman@gmaill.com'),
(8, '2020-12-02', 'Üniversiteler, Hacettepe Beytepe Kampüsü, 06800 Çankaya/Ankara', 1, 133.00, 'On delivery', 'bird', 'larry', 'anime@gmail.com'),
(9, '2020-12-03', 'Rumelifeneri, Sarıyer Rumeli Feneri Yolu, 34450 Sarıyer/İstanbul', 1, 132.60, 'Delivered', 'Ben', 'Simmons', 'ben@gmail.com'),
(10, '2020-11-25', 'Hisarüstü, Nispetiye Caddesi, Rumelihisarı, Sarıyer/İstanbul Türkiye', 0, 125.10, 'On delivery', 'Furkan', 'Korkmaz', 'sniper@gmail.com'),
(12, '2021-01-11', 'sadfads.', 1, 225.50, 'On delivery', 'Baran', 'Çimen', 'cimenbaran@gmail.com'),
(13, '2021-01-11', 'mimimimi', 1, 120.00, 'On delivery', 'deneeem', 'eeeee', 'denem@gmail.com'),
(14, '2021-01-11', 'Suadiye Kadıköy', 1, 230.30, 'On delivery', 'Yusufhan', 'Kırçova', 'yusk@gmail.com'),
(15, '2021-01-11', 'Suadiye Mh. Aydın Sk. No: 38 - Kadıköy (Suadiye Mah.)', 1, 579.95, 'On delivery', 'insan', 'xd', 'xd@gmail.com'),
(16, '2021-01-11', 'Alemdag Cekmekoy', 1, 199.90, 'On delivery', 'XDDD', 'xd', 'xzdxd@gmail.com'),
(17, '2021-01-11', 'Suadiye Kadıköy', 1, 297.00, 'On delivery', 'Yusufhan', 'Kırçova', 'yusuhf@gmail.com'),
(18, '2021-01-11', 'Alemdag Cekmekoy', 1, 133.60, 'On delivery', 'Yusufhan', 'Kircova', 'yusufhan@sabanciuniv.edu');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `pid` int(11) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `surname` char(20) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `pass` char(50) DEFAULT NULL,
  `personImgUrl` text DEFAULT NULL,
  `usertype` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`pid`, `name`, `surname`, `email`, `pass`, `personImgUrl`, `usertype`) VALUES
(1, 'Baran', 'Cimen', 'asas@gmail.com', 'xdxdxd', '', 1),
(2, 'Cedi', 'Osman', 'cediosman@sabanciuniv.edu', 'sextonmal', '', 1),
(3, 'Utku', 'Ekşi', 'mutku@sabanciuniv.edu', 'deneme1', '', 1),
(4, 'Işıl', 'Sefünç', 'isilsefunc@sabanciuniv.edu', 'deneme2', '', 1),
(5, 'Yusufhan', 'Kırçova', 'yusufhank@sabanciuniv.edu', 'deneme3', '', 1),
(6, 'Batuhan', 'Demir', 'batuhandemir@sabanciuniv.edu', 'deneme4', '', 1),
(7, 'Joe', 'Pass', 'joepass@sabanciuniv.edu', 'deneme5', '', 1),
(8, 'Danny', 'Ainge', 'dannya@sabanciuniv.edu', 'deneme6', '', 1),
(9, 'Burgaz', 'Ada', 'bada@sabanciuniv.edu', 'deneme7', '', 1),
(10, 'Büyük', 'Ada', 'buyukada@sabanciuniv.edu', 'deneme8', '', 1),
(11, 'Kınalı', 'Ada', 'kada@sabanciuniv.edu', 'deneme9', '', 2),
(12, 'Heybeli', 'Ada', 'hadax@sabanciuniv.edu', 'deneme10', '', 2),
(13, 'Danny', 'Green', 'dgreen@sabanciuniv.edu', 'deneme11', '', 2),
(14, 'Kevin', 'Durant', 'kd@sabanciuniv.edu', 'deneme12', '', 2),
(15, 'Kyrie', 'Irving', 'kyrie@sabanciuniv.edu', 'deneme13', '', 2),
(16, 'Furkan', 'Korkmaz', 'fkorkmaz@sabanciuniv.edu', 'deneme14', '', 2),
(17, 'Ersan', 'İlyasova', 'hada@sabanciuniv.edu', 'deneme15', '', 2),
(18, 'Seth', 'Curry', 'scurry@sabanciuniv.edu', 'deneme16', '', 2),
(19, 'Şebnem', 'Ferah', 'sebo@sabanciuniv.edu', 'deneme17', '', 2),
(20, 'Tobias', 'Harris', 'tharris@sabanciuniv.edu', 'deneme18', '', 2),
(21, 'Steph', 'Curry', 'stephcurry@sabanciuniv.edu', 'deneme19', '', 0),
(22, 'Moses', 'Malone', 'malone@sabanciuniv.edu', 'deneme20', '', 0),
(23, 'Karl', 'Malone', 'karl@sabanciuniv.edu', 'deneme21', '', 0),
(24, 'Michael', 'Jordan', 'mj@sabanciuniv.edu', 'deneme22', '', 0),
(25, 'Larry', 'Bird', 'bird@sabanciuniv.edu', 'deneme23', '', 0),
(26, 'Magic', 'Johnson', 'magic@sabanciuniv.edu', 'deneme24', '', 0),
(27, 'Kevin', 'Garnett', 'kg@sabanciuniv.edu', 'deneme25', '', 0),
(28, 'Steve', 'Nash', 'nash@sabanciuniv.edu', 'deneme26', '', 0),
(29, 'FK', 'J', 'fkj@sabanciuniv.edu', 'deneme27', '', 0),
(30, 'Lavar', 'Ball', 'bball@sabanciuniv.edu', 'deneme28', '', 0),
(31, 'Batuhan', 'Demir', 'kkural@sabanciuniv.edu', 'deneme29', 'https://media-exp1.licdn.com/dms/image/C4D03AQEYP9q8WhYZNQ/profile-displayphoto-shrink_800_800/0/1610015444915?e=1616025600&v=beta&t=MArdtuWJHLpYD1St_wO947hMyx58RIlZeo-fFUmcQfQ', 0),
(32, 'Semih', 'Erden', 'serden@sabanciuniv.edu', 'deneme30', '', 0),
(33, 'Yusufhan', 'Kircova', 'yusufhan@sabanciuniv.edu', '1234', 'https://media-exp1.licdn.com/dms/image/C4D03AQGlKO6ovzVzQA/profile-displayphoto-shrink_200_200/0?e=1611792000&v=beta&t=R_tKYdLiuP7f9d8w1zY9D0jO2UYo2GWJkVaImPFU4d8', 0),
(34, 'Baran', 'Cimen', 'cimen@cimen.com', '12345', 'https://media-exp1.licdn.com/dms/image/C4D03AQH3TWA-2pl39w/profile-displayphoto-shrink_200_200/0/1607104832636?e=1615420800&v=beta&t=REW_747gfILE0CIgKsNl_ay3fOHrxo5j_Q0nWsqe6T8', 0),
(35, 'Isil', 'Sefunc', 'isilsefunc@isil.com', '12345', 'https://media-exp1.licdn.com/dms/image/C5603AQGOLN8cru5MqQ/profile-displayphoto-shrink_200_200/0/1609960863763?e=1615420800&v=beta&t=PxC_VzRmbr_cYThAixSTikcrc9DXYGQf2a2Dgwjyo78', 0),
(36, 'Melih', 'Utku', 'melihmelih@sabanci.com', '1234', 'https://media-exp1.licdn.com/dms/image/C4D03AQHkc5RiupzERA/profile-displayphoto-shrink_200_200/0/1560005464567?e=1615420800&v=beta&t=1XK1y5or6EU3ImB2tQ5yrHWGXOaLRqqfdkD-rsAVXc4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prid` int(11) NOT NULL,
  `pname` char(100) DEFAULT NULL,
  `artist` char(50) DEFAULT NULL,
  `genre` char(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float(10,2) DEFAULT 1.00,
  `categoryId` int(11) NOT NULL,
  `productImgUrl` text DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `IsVisible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prid`, `pname`, `artist`, `genre`, `description`, `price`, `categoryId`, `productImgUrl`, `stock`, `IsVisible`) VALUES
(1, 'Sus Pus', 'Ceza', 'RAP', ' iTunes tarafından 2015’in En İyi Rap/Hip Hop albümü seçilmişti. CEZA, albümle aynı adı taşıyan şarkısı ile NPR (National Public Radio) Müzik tarafından açıklanan 2015’in En İyi Şarkıları listesinde de tek Türk sanatçı olarak yer aldı.', 163.00, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000686726-1.jpg', 15, 1),
(2, 'Good Girl Gone Bad', 'Rihanna', 'POP', 'R&B yıldızı Rihanna\'nın en iyi ve en sevilen albümü olarak nitelendirilen Good Girl Gone Bad, 2 LP\'lik versiyonuyla yeniden müzikseverlerle buluşuyor. Albümdeki tüm şarkıların hit ve dillerden düşmeyen şarkılar özelliğinde olması albümü modern bir R&B klasiği haline getiriyor.', 159.98, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0001712087001-1.jpg', 20, 1),
(3, 'Bir de benden dinle', 'Müslüm Gürses', 'ARABESK', 'Müslüm babaa', 114.00, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0001755791001-1.jpg', 5, 1),
(4, 'Bounce', 'Bon Jovi', 'ROCK', 'Bounce taki parçaların çoğu ', 96.00, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000706068-1.jpg', 2, 1),
(5, 'Kendi Kendine', 'MFÖ', 'ROCK', 'Müzik dünyasındaki 46. yıllarını geride bırakan Türkiye’nin en önemli müzik gruplarından MFÖ’nün 2017 yılında çıkardığı ve eleştirmenler tarafından tam not alan son albümleri Kendi Kendine  şimdi DMC etiketiyle plak olarak da yayında!', 119.00, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0001737907001-1.jpg', 24, 1),
(6, 'Made In Heaven', 'Queen', 'ROCK', 'Cennet yapımı sayılabilecek bir albümdür. Ne de olsa albüm Freddie Mercury öldükten sonra bitirilebilmiştir. Göz yaşartıcı güzellikte bir albümdür. Bazı şarkıları vokalsiz kalan Queen grubunun gitaristi Brian May söylemiştir. ', 269.97, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000678011-1.jpg', 2, 1),
(7, 'Kendi Cennetim', 'Nilüfer', 'POP', ' Nilüfer\'in yirmi beşinci stüdyo albümüdür. Albümde toplamda 13 şarkı bulunmaktadır. Bu albüm 2 yıl süren titiz bir çalışmanın ürünüdür. Albümde ilk kez Sezen Aksu ve Nazan Öncel\'den ikişer şarkı seslendirdi.', 76.30, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000677168-1.jpg', 25, 1),
(8, 'Dostlar Beni Hatırlasın', 'Aşık Veysel', 'TÜRKÜ', 'Veysel\'in türkü şeklinde söylediği versiyonunda \'ben giderim adım kalır\' a öyle bir haykırışla girer ki gözler yaş dolar, akar. Türkü bitiminde canı alınacak gibi söyler Veysel. Dostlar seni hatırlıyor Veysel. Hiç unutmadılar ki zaten. Hatırlayanlara bir yürek mesafesindesin.', 133.00, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000710976-1.jpg', 3, 1),
(9, 'Sizler Hiç Yokken', 'Jehan Barbur', 'ROCK', 'Jehan Barbur\'un 4. albümüdür. \"Tüm kaybettiklerimiz ve tükenen herkes için...\" icra ettiği şarkılardan oluşan albüm.', 125.10, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000703937-1.jpg', 5, 1),
(10, 'Bahane', 'Sezen Aksu', 'ROCK', 'Sezen Aksu\'nun 30. sanat yılında çıkardığı son albümü. Nicelik ve nitelik bakımından tatmin edici albümde, eskidendi çok eskiden, perişanım şimdi, kalp unutmaz diğerleri arasından öne çıkıyor.', 106.25, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000710485-1.jpg', 100, 1),
(11, 'Because the Internet', 'Childish Gambino', 'RAP', 'Childish Gambino\'nun 6 Aralık 2013\'te çıkan ikinci stüdyo albümüdür. Albümü en kaba tabirle depresif olarak nitelendirebiliriz. Fakat bu demek değil ki dinlerken eğlenmeyeceksiniz ve güzel vakit geçirmeyeceksiniz.', 1000.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/51FNFwMq9yL._SX355_.jpg', 25, 1),
(12, 'Scorpion', 'Drake', 'RAP', 'Drake\'in birçok streaming rekoru kırmasına rağmen beklenenden daha az ilk hafta satışı elde edecek olan beşinci stüdyo albümü.', 62.00, 0, 'https://data.opus3a.com/product_photo/36/36fc781294309606a389487f329be679/large/3d532b3fd91beb839087ba0836556d5f.jpg?product_title=drake-scorpion-cd', 20, 1),
(13, 'Flower Boy', 'Tyler, The Creator', 'RAP', 'Flower Boy başka bir adıyla Scum Fuck Flower Boy, Tyler, the Creator\'un 4. stüdyo albümüdür. Resmi olarak 21 Temmuz 2017\'de yayınlanmıştır.', 159.98, 0, 'https://images-na.ssl-images-amazon.com/images/I/81W3TZBkF1L._SY355_.jpg', 40, 1),
(14, 'blond', 'Frank Ocean', 'POP', 'Amerikalı şarkıcı, söz yazarı ve prodüktör Frank Ocean, 2016 yılında çıkardığı \"Blonde\" albümü ile çok konuşulan ve dinlenme sayıları milyonları buldu.', 119.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/81UPsXanOrL._SY355_.jpg', 40, 1),
(15, 'To Pimp A Butterfly', 'Kendrick Lamar', 'RAP', 'Ünlü rap müzisyeni Kendrick Lamar’ın 3. stüdyo albümü To Pimp A Butterfly, 15 Mart 2015 tarihinde yayınlandı. Dünyada büyük ses getiren albüm, milyonlarca kopya sattı ve 58. Grammy Ödülleri\'nde yılın albümü ve yılın rap albümü kategorilerinde aday gösterilip, yılın rap albümü ödülünü kazandı.', 95.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/71NUQhdZDJL._SY355_.jpg', 2, 1),
(16, '2014 Forest Hills Drive', 'J.Cole', 'RAP', '2014 Forest Hills Drive otobiyografik bir albüm olmasının getirdikleriyle J. Cole\'ün dinlediklerini de barındıran bir albüm. Bütün şarkılar 90\'lar kokulu sağlam bir prodüksiyon üzerine dönüyor.', 119.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/71XstPLx8PL._SY355_.jpg', 25, 1),
(17, 'Led Zeppelin I', 'Led Zeppelin', 'ROCK', '1969\'da çıkmıştır. Grup bu albüm sayesinde daha ilk seferde Amerika\'yı aynı yıl 3 kere turlamıştır. Blues havası feci hakimdir, coverlar mevcuttur. Grubun geleceğini parlatmaya yetmiştir.', 299.97, 0, 'https://images-na.ssl-images-amazon.com/images/I/816FdtquvwL._SY355_.jpg', 2, 1),
(18, 'Benim Dertlerim', 'Orhan Gencebay', 'ARABESK', 'Orhan Gencebay\'ın 1978\'de çıkardığı albümüdür. Kimilerine göre Türk müzik tarihinin gelmiş geçmiş en iyi albümleri arasında yer almaktadır.', 66.30, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0001711054001-1.jpg', 25, 1),
(19, 'Postacılar', 'Ferdi Tayfur', 'ARABESK', 'İlk plaktaki naif, titrek, ağlak ve bir o kadar da samimi Ferdi Tayfur yorumu, kendisinin artık Ferdi babalığa terfi ettiği 80\'lerle birlikte oturmuş, olgunlamış bir ses ve tavırla arabeskin en damar şarkılarından birine dönüşmüş.', 133.00, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0001876072001-1.jpg', 3, 1),
(20, 'Dinle', 'Mahsun Kırmızıgül', 'ARABESK', 'MAHSUN BOMBA GİBİ GELİYOR. Bıkmadan usanmadan dinleyebileceğiniz bir albüm. Albümde müthiş bir çeşitlilik var.', 125.10, 0, 'https://i.dr.com.tr/cache/600x600-0/originals/0000000210732-1.jpg', 5, 1),
(21, 'Man on the Moon: The End of Day', 'Kid Cudi', 'RAP', 'Man On The Moon Trilogy sinin ilk ayağı olan albüm. Kid Cudi nin ilk stüdyo albümüdür. Çıkış yılı 2009.', 67.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/51m%2BqOWNoEL._SX425_.jpg', 5, 1),
(22, 'JACKBOYS', 'Travis Scott', 'RAP', 'Travis Scott ın 27 Aralık 2019da saldığı taptaze albümü. Travis Scott ın stüdyosu olan Cactus Jack in elemanları ile yaptığı iş.', 120.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/41mEXKB8eaL._SX425_.jpg', 23, 1),
(28, 'IGOR', 'Tyler, the Creator', 'RAP', '17 Mayıs 2019 çıkış tarihli yeni Tyler the Creator albümü. Albümdeki sözler, prodüksiyon ve düzenleme işleri tamamen Tyler a ait.', 320.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/71udX8iRBsL._SX425_.jpg', 2, 1),
(29, 'Mr. Robot: Volume 1', 'Mac Quayle', 'SOUNDTRACK', 'Mr. Robot dizisinin müziklerini içeren albüm.', 450.00, 0, 'https://images-na.ssl-images-amazon.com/images/I/81hDq2rLsSL._SX425_.jpg', 2, 1),
(34, 'Future Nostalgia', 'Dua Lipa', 'POP', 'Dua Lipa\'nın ilk albümünde gördüğümüz pop elementlerini bu albümünde 80li yılların funk ve groove\'uyla harmanlamasının sonucu ortaya çıkan, hareketli ve eğlenceli bir albüm.', 315.00, 0, 'https://www.cdplak.com/image/cache/webp/catalog/pop-soul/new4/Dua-Lipa-Future-Nostalgia-Plak-Kapak-On-500x500.webp', 15, 1);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `genre_upp` BEFORE INSERT ON `product` FOR EACH ROW SET NEW.genre = UPPER(NEW.genre)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `productmanager`
--

CREATE TABLE `productmanager` (
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productmanager`
--

INSERT INTO `productmanager` (`pid`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Table structure for table `salesmanager`
--

CREATE TABLE `salesmanager` (
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesmanager`
--

INSERT INTO `salesmanager` (`pid`) VALUES
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `prid` int(11) NOT NULL,
  `songname` char(50) NOT NULL,
  `TrackNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`prid`, `songname`, `TrackNumber`) VALUES
(1, 'Aç Kalbini', 1),
(1, 'Bulanık Sular', 2),
(1, 'Ders Al', 3),
(1, 'Hoşgeldiniz', 4),
(1, 'Kim Olduğunu Unut', 5),
(1, 'Kime Anlatsam', 6),
(1, 'Kolay Gelsin', 7),
(1, 'Milyon Farklı Hikaye', 8),
(1, 'Ne De Zor', 9),
(1, 'Sessizlik', 10),
(1, 'Sor Bize(ft Sansor Salvo)', 11),
(1, 'Suspus', 12),
(1, 'Yok Geri Donmek', 13),
(2, 'Breakin\' Dishes', 4),
(2, 'Don\'t Stop The Music', 3),
(2, 'Good Girl Gone Bad', 12),
(2, 'Hate That I Love You', 6),
(2, 'Lemme Get That', 9),
(2, 'Push Up On Me', 2),
(2, 'Question Existing', 11),
(2, 'Rehab', 10),
(2, 'Say It', 7),
(2, 'Sell Me Candy', 8),
(2, 'Shut Up And Drive', 5),
(2, 'Umbrella', 1),
(3, 'Aygız', 1),
(3, 'Belalım', 7),
(3, 'Çok Yalnızım', 6),
(3, 'Dediler Zamanla Hep', 3),
(3, 'Dertli Mektup', 10),
(3, 'Kar Tanesi', 2),
(3, 'Kara Sevda', 9),
(3, 'Kolay Gelsin', 5),
(3, 'Şanssızım', 11),
(3, 'Sen Deli Misin ?', 8),
(3, 'Vurgun', 4),
(4, 'All About Lovin\' You', 6),
(4, 'Bounce', 11),
(4, 'Everyday', 2),
(4, 'Hook Me Up', 7),
(4, 'Joey', 4),
(4, 'Love Me Back To Life', 9),
(4, 'Misunderstood', 5),
(4, 'Open All Night', 12),
(4, 'Right Side Of Wrong', 8),
(4, 'The Distance', 3),
(4, 'Undivided', 1),
(4, 'You Had Me From Hello', 10),
(5, 'Acıyı Bal Eyledik', 11),
(5, 'Aşkın Kenarından', 1),
(5, 'Beyaz Sayfa', 4),
(5, 'Emin Misin', 2),
(5, 'Güzel Şeyler De Oluyor', 3),
(5, 'Hayret Makamı', 7),
(5, 'Maalesef Böyle Oldu', 8),
(5, 'Neden Bana Aşk Şarkısı Yazan Çıkmaz', 6),
(5, 'Ruh Halim Yerlerde', 10),
(5, 'Senin Hatırına', 5),
(5, 'Türk\'üz Türkü Çağırırız', 12),
(5, 'Yıllar Sonra', 9),
(6, '13', 11),
(6, 'A Winter\'s Tale', 9),
(6, 'Heaven For Everyone (Remastered 2011)', 6),
(6, 'I Was Born To Love You', 5),
(6, 'It\'s A Beautiful Day (Remastered 2011)', 1),
(6, 'It\'s A Beautiful Day (Reprise) (Remastered 2011)', 10),
(6, 'Made In Heaven, Let Me Live (Remastered 2011)', 2),
(6, 'Mother Love', 3),
(6, 'My Life Has Been Saved (Remastered 2011)', 4),
(6, 'Too Much Love Will Kill You', 7),
(6, 'You Don\'t Fool Me (Remastered 2011)', 8),
(7, 'Aylar Geçti', 5),
(7, 'Beklemem', 12),
(7, 'Bu Tarafa', 8),
(7, 'Elimden Gelen Bu Kadardı', 7),
(7, 'Günahkar Zaman ( Neyleyim )', 10),
(7, 'Hadi Kızlar', 2),
(7, 'Havalandı Ruhum', 4),
(7, 'Hazan', 13),
(7, 'Haziran Vakti', 6),
(7, 'İki Eski Sevgili', 9),
(7, 'Nokta', 1),
(7, 'Seninim', 11),
(7, 'Vefa', 3),
(8, 'Anlatmam Derdimi Dertsiz İnsana', 5),
(8, 'Beni Hor Görme Kardeşim', 2),
(8, 'Bir Seher Vaktinde', 7),
(8, 'Bir Ulu Ağaçtan Bir Yaprak Düşer', 12),
(8, 'Birlik Destanı', 1),
(8, 'Dostlar Beni Hatırlasın', 6),
(8, 'Esti Bahar Yeli', 11),
(8, 'Güzelliğin On Para Etmez', 4),
(8, 'Küçük Dünyam', 3),
(8, 'Murat', 10),
(8, 'Sen Bir Ceylan Olsan Bende Bir Avcı', 9),
(8, 'Sen Varsın Orada', 8),
(9, 'Ardışık', 7),
(9, 'Bugün Yine Böyle', 8),
(9, 'Burada Yaralı Biri Var', 9),
(9, 'Can', 4),
(9, 'Dünya Bugün', 6),
(9, 'Ellerimde Kelimeler', 1),
(9, 'Kendine Zaman Ver', 10),
(9, 'Kiminsin Be Adam', 2),
(9, 'Naz Barı', 5),
(9, 'Yollar', 3),
(10, 'Ahdım Olsun', 13),
(10, 'Bahane', 1),
(10, 'Çile', 15),
(10, 'Eskidendi Çok Eskiden', 2),
(10, 'Geçiyor Bizden De', 10),
(10, 'Herkes Yaralı', 8),
(10, 'Hükümsüz', 12),
(10, 'İkili Delilik', 6),
(10, 'Kalp Unutmaz', 7),
(10, 'Kınalı Kuzum', 14),
(10, 'Perişanım Şimdi', 3),
(10, 'Pişman Olduğun Zaman', 5),
(10, 'Şanıma İnanma', 9),
(10, 'Şanıma İnanma ( Kıvanch K.)', 16),
(10, 'Tebdil-i Mekan', 11),
(10, 'Yanmışım Sönmüşüm Ben', 4),
(11, '3005', 9),
(11, 'Death By Numbers', 13),
(11, 'Dial Up', 4),
(11, 'I. Flight of the Navigator', 14),
(11, 'I. Pink Toes', 17),
(11, 'I. The Party', 11),
(11, 'I. The Worst Guys', 5),
(11, 'I.Crawl', 2),
(11, 'II. Earth: The Oldest Computer (The Last Night)', 18),
(11, 'II. No Exit', 12),
(11, 'II. Shadows', 6),
(11, 'II. Worldstar', 3),
(11, 'II. Zealots of Stockholm [Free Information]', 15),
(11, 'III. Life: The Biggest Trool[Andrew Auernheimer]', 19),
(11, 'III. Telepgraph Ave.(\"Oakland\" by Lloyd)', 7),
(11, 'III. Urn', 16),
(11, 'IV. Sweatpants', 8),
(11, 'Playing Around Before the Party Starts', 10),
(11, 'The Library - Intro', 1),
(12, '8 Out of 10', 7),
(12, 'After Dark (feat. Static Major, Ty Dolla $ign)', 23),
(12, 'Blue Tint', 20),
(12, 'Can’t Take a Joke', 9),
(12, 'Don’t Matter to Me (feat. Michael Jackson)', 22),
(12, 'Elevate', 3),
(12, 'Emotionless', 4),
(12, 'Final Fantasy', 24),
(12, 'Finesse', 17),
(12, 'God’s Plan', 5),
(12, 'In My Feelings', 21),
(12, 'Is There More', 12),
(12, 'I’m Upset', 6),
(12, 'Jaded', 15),
(12, 'March 14', 25),
(12, 'Mob Ties', 8),
(12, 'Nice For What', 16),
(12, 'Nonstop', 2),
(12, 'Peak', 13),
(12, 'Ratchet Happy Birthday', 18),
(12, 'Sandra’s Rose', 10),
(12, 'Summer Games', 14),
(12, 'Survival', 1),
(12, 'Talk Up (feat. JAY-Z)', 11),
(12, 'That’s How You Feel', 19),
(13, '911', 10),
(13, 'Boredom', 8),
(13, 'Droppin\' Seeds', 11),
(13, 'Enjoy Right Now, Today', 14),
(13, 'Foreword', 1),
(13, 'Garden Shed', 7),
(13, 'Glitter', 13),
(13, 'I Ain\'t Got Time!', 9),
(13, 'November', 12),
(13, 'Pothole', 6),
(13, 'See You Again', 4),
(13, 'Sometimes..', 3),
(13, 'Where This Flower Blooms', 2),
(13, 'Who Dat Boy', 5),
(14, 'Be Yourself', 4),
(14, 'Close to You', 13),
(14, 'Facebook Story', 12),
(14, 'Futura Free', 17),
(14, 'Godspeed', 16),
(14, 'Good Guy', 8),
(14, 'Ivy', 2),
(14, 'Nights', 9),
(14, 'Nikes', 1),
(14, 'Pink + White', 3),
(14, 'Pretty Sweet', 11),
(14, 'Self Control', 7),
(14, 'Siegfried', 15),
(14, 'Skyline To', 6),
(14, 'Solo', 5),
(14, 'Solo (Reprise)', 10),
(14, 'White Ferrari', 14),
(15, 'Alright', 7),
(15, 'Complexion ft. Rapsody', 12),
(15, 'For Free? (Interlude)', 2),
(15, 'For Sale? (Interlude)', 8),
(15, 'Hood Politics', 10),
(15, 'How Much A Dollar Cost ft. James Fauntleroy and Ro', 11),
(15, 'i', 15),
(15, 'Institutionalized ft. Bilal, Anna Wise and Snoop D', 4),
(15, 'King Kunta', 3),
(15, 'Momma', 9),
(15, 'Mortal Man', 16),
(15, 'The Blacker the Berry', 13),
(15, 'These Walls ft. Bilal, Anna Wise and Thundercat', 5),
(15, 'u', 6),
(15, 'Wesley’s Theory ft. George Clinton and Thundercat', 1),
(15, 'You Ain’t Gotta Lie (Momma Said)', 14),
(16, 'A Tale of 2 Citiez', 5),
(16, 'Apparently', 11),
(16, 'Fire Squad', 6),
(16, 'G.O.M.D', 8),
(16, 'Hello', 10),
(16, 'Intro', 1),
(16, 'January 28th', 2),
(16, 'Love Yourz', 12),
(16, 'No Role Modelz', 9),
(16, 'Note To Self', 13),
(16, 'St. Tropez', 7),
(16, 'Wet Dreamz', 3),
(16, '’03 Adolescence', 4),
(17, 'Babe I\'m Gonna Leave You', 2),
(17, 'Black Mountain Side', 6),
(17, 'Communication Breakdown', 7),
(17, 'Dazed and Confused', 4),
(17, 'Good Times Bad Times', 1),
(17, 'How Many More Times', 9),
(17, 'I Can\'t Quit You Baby', 8),
(17, 'You Shook Me', 3),
(17, 'Your Time Is Gonna Come', 5),
(18, 'Bir Zaman Ağlayıp', 9),
(18, 'Bitecek Dertlerimiz', 11),
(18, 'Felekten Beter Vurdu', 8),
(18, 'Her Günüm Gamlı Geçer', 5),
(18, 'Kaderimi Çiziyorum', 6),
(18, 'Sen', 10),
(18, 'Seveceksin', 3),
(18, 'Sevmek Ne Güzel', 7),
(18, 'Tutuldu Ellerim', 4),
(18, 'Zalimsin', 2),
(18, 'Zamansız Rüzgâr', 1),
(19, 'Bana Gerçekleri Söyle', 10),
(19, 'Dur Dinle Sevgilim', 8),
(19, 'Kır Çiçekleri', 7),
(19, 'Mahkumların Duası', 6),
(19, 'Mahşer Günü', 5),
(19, 'Ne Bilirdim ki', 9),
(19, 'Postacılar', 1),
(19, 'Sakın Düşme', 4),
(19, 'Sana Kaderimsin Dedim', 3),
(19, 'Yüreğimde Yare Var', 2),
(20, 'Aşkımın son hanesi', 7),
(20, 'Bahane', 5),
(20, 'Canım', 1),
(20, 'Canım (Remix)', 9),
(20, 'Kal de', 2),
(20, 'Olmadı', 8),
(20, 'Sen gidince', 10),
(20, 'Sevdanın rengi', 6),
(20, 'Tomurcuk', 3),
(20, 'Yanıma gel', 4),
(20, 'Yanıma Gel (Remix)', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `average_rating`
--
ALTER TABLE `average_rating`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `cartdetails`
--
ALTER TABLE `cartdetails`
  ADD PRIMARY KEY (`cid`,`prid`),
  ADD KEY `prid` (`prid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `prid` (`prid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `makes`
--
ALTER TABLE `makes`
  ADD PRIMARY KEY (`oid`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`oid`,`prid`),
  ADD KEY `prid` (`prid`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`oid`),
  ADD UNIQUE KEY `oid` (`oid`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pid` (`pid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prid`),
  ADD UNIQUE KEY `prid` (`prid`);

--
-- Indexes for table `productmanager`
--
ALTER TABLE `productmanager`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `salesmanager`
--
ALTER TABLE `salesmanager`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`prid`,`songname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `customer` (`pid`);

--
-- Constraints for table `cartdetails`
--
ALTER TABLE `cartdetails`
  ADD CONSTRAINT `cartdetails_ibfk_1` FOREIGN KEY (`prid`) REFERENCES `product` (`prid`),
  ADD CONSTRAINT `cartdetails_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `cart` (`cid`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `customer` (`pid`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`prid`) REFERENCES `product` (`prid`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`prid`) REFERENCES `product` (`prid`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `order_table` (`oid`);

--
-- Constraints for table `productmanager`
--
ALTER TABLE `productmanager`
  ADD CONSTRAINT `productmanager_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `person` (`pid`) ON DELETE CASCADE;

--
-- Constraints for table `salesmanager`
--
ALTER TABLE `salesmanager`
  ADD CONSTRAINT `salesmanager_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `person` (`pid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
