-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-01-07 20:06:41
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `phpcart`
--

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `categoryid` int(10) UNSIGNED NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `categorysort` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`, `categorysort`) VALUES
(1, 'iPhone', 1),
(2, 'iPad', 2),
(3, 'Mac', 3),
(4, '其他', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `memberdata`
--

CREATE TABLE `memberdata` (
  `m_id` int(10) UNSIGNED NOT NULL,
  `m_username` varchar(20) NOT NULL,
  `m_passwd` varchar(100) NOT NULL,
  `m_level` enum('admin','member') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `memberdata`
--

INSERT INTO `memberdata` (`m_id`, `m_username`, `m_passwd`, `m_level`) VALUES
(1, '123', '$2y$10$ajXHDRPHDlW9amFlq.pHeOLZarIcEQlopmaKIih6LJgKdhWJOEYL6', 'member'),
(2, 'sss', '$2y$10$ht3XNgNMhQrf.MUYPS5G.eweBRlY6u92g1FyKZgyEjbnrNk0m4Kl6', 'admin'),
(3, 'vvv', '$2y$10$qJd7Fsf3wFi3ZXcDgiVZNeaY.PXpzW4KNiE.NieCqvhKOVb8zn4iG', 'member');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `m_id` int(11) UNSIGNED NOT NULL,
  `total` int(10) UNSIGNED DEFAULT NULL,
  `customername` varchar(100) DEFAULT NULL,
  `customeremail` varchar(100) DEFAULT NULL,
  `customeraddress` varchar(100) DEFAULT NULL,
  `customerphone` varchar(100) DEFAULT NULL,
  `paytype` enum('ATM匯款','線上刷卡','貨到付款') DEFAULT 'ATM匯款'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`orderid`, `m_id`, `total`, `customername`, `customeremail`, `customeraddress`, `customerphone`, `paytype`) VALUES
(16, 2, 24390, 'aaav', 'aaa@aaa.com', 'aaa', 'aaa', '線上刷卡'),
(19, 2, 66090, 'aaa', 'aaa@aaa.com', 'aaa', 'aaa', 'ATM匯款');

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderdetailid` int(10) UNSIGNED NOT NULL,
  `orderid` int(10) UNSIGNED DEFAULT NULL,
  `productid` int(10) UNSIGNED DEFAULT NULL,
  `productname` varchar(254) DEFAULT NULL,
  `unitprice` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `orderdetail`
--

INSERT INTO `orderdetail` (`orderdetailid`, `orderid`, `productid`, `productname`, `unitprice`, `quantity`) VALUES
(21, 16, 6, 'iPad Air 10.9 Wi-Fi', 24390, 1),
(25, 19, 6, 'iPad Air 10.9 Wi-Fi', 24390, 1),
(26, 19, 10, 'MacBook Air M2 8核心', 41700, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `productid` int(10) UNSIGNED NOT NULL,
  `categoryid` int(10) UNSIGNED NOT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `productprice` int(10) UNSIGNED DEFAULT NULL,
  `productimages` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`productid`, `categoryid`, `productname`, `productprice`, `productimages`, `description`) VALUES
(1, 1, 'iPhone 14 Pro Max', 42400, 'iphone14proMax.jpg', '★6.7吋 超 Retina XDR 顯示器\r\n★A16 仿生晶片\r\n★支援無線充電、 IP68 等級 防潑、抗水與防塵\r\n★主鏡頭：4800萬像素+1200萬像素超廣角與廣角相機\r\n★霧面質感玻璃機背與不鏽鋼設計\r\n★擁有四倍耐摔優異表現的超瓷晶盾面板'),
(2, 1, 'iPhone 14 Plus', 32600, 'iphone14plus.jpg', '★6.7 吋 超 Retina XDR 顯示器\r\n★最快速的 A15 仿生晶片\r\n★支援無線充電、 IP68 等級 防潑、抗水與防塵\r\n★主鏡頭：1200萬像素超廣角與廣角相機\r\n★全球最小巧、最纖薄、最輕盈的 5G 手機\r\n★擁有四倍耐摔優異表現的超瓷晶盾'),
(3, 1, 'iPhone 13', 24099, 'iphone14plus.jpg', '★6.1 吋 超 Retina XDR 顯示器\r\n★最快速的 A15 仿生晶片\r\n★支援無線充電、IP68 等級防潑抗水\r\n★主鏡頭：1200萬像素雙相機系統：超廣角與廣角相機'),
(4, 2, 'iPad Pro 11.0 WiFi ', 31400, 'iPad11pro.jpg', '★11.0 吋 (對角線) Liquid Retina 顯示器\r\n★2388 x 1668 解析度，每吋 264 像素 (ppi)\r\n★Apple M2 晶片\r\n★主鏡頭廣角1200 萬+超廣角1000像素相機、前鏡頭1200 萬像素超廣角相機\r\n★搭載光學雷達掃描儀設備，替擴增實境(AR)開啟更多無限可能性\r\n★802.11ax Wi-Fi 6；同時支援雙頻 (2.4GHz 及 5GHz)；支援 HT80 的 MIMO 技術'),
(5, 2, 'iPad 10.2 WIFI', 10590, 'iPad10wifi.jpg', '★10.2 吋 Retina 顯示器\r\n★支援 Apple Pencil (第 1 代)\r\n★A13 仿生晶片具備神經網路引擎\r\n★800萬畫素相機，1080p HD 影片拍攝\r\n★FaceTime HD 相機\r\n★Touch ID，解鎖、Apple Pay'),
(6, 2, 'iPad Air 10.9 Wi-Fi', 24390, 'iPadair.jpg', '★8核心M1晶片。\r\n★10.9吋Liquid Retina 顯示器。\r\n★支援第二代 Apple Pencil / 巧控鍵盤 (配件另售)。\r\n★Touch ID指紋辨識功能。\r\n★iPad OS。'),
(7, 2, 'iPad mini 8.3吋', 16590, 'iPadminiwifi.jpg', '★8.3 吋 Liquid Retina 顯示器\r\n★支援 Apple Pencil (第 2 代)\r\n★A15 仿生晶片具備神經網路引擎\r\n★1200萬畫素相機，1080p HD 影片拍攝\r\n★FaceTime HD 相機\r\n★Touch ID，解鎖、Apple Pay'),
(8, 3, 'iMac 24吋 M1 7核心 GPU 8G 256G', 37950, 'iMac.jpg', '★8 核心 CPU 配備 4 個效能核心與\r\n★4 個節能核心\r\n★7 核心 GPU\r\n★16 核心神經網路引擎'),
(9, 3, 'MacBook Air M1 8G/256G', 29046, 'macbookair.jpg', '★Apple M1晶片配備8核心CPU、7核心GPU與16核心神經網路引擎\r\n★8GB 統一記憶體\r\n★256GB SSD 儲存裝置¹\r\n★具備原彩顯示的 Retina 顯示器\r\n★巧控鍵盤、Touch ID、力度觸控板\r\n★兩個 Thunderbolt / USB 4 埠'),
(10, 3, 'MacBook Air M2 8核心', 41700, 'macbookair2.jpg', '★Apple M2 晶片配備 8 核心 CPU、8 核心 GPU 與 16 核心神經網路引擎\r\n★16GB 統一記憶體 / 256GB SSD 儲存裝置\r\n★具備原彩顯示的 13.6 吋 Liquid Retina 顯示器\r\n★1080p FaceTime HD 相機 / MagSafe 3 充電埠\r\n★兩個 Thunderbolt / USB 4 埠 / 30W USB-C 電源轉接器\r\n★含 Touch ID 的背光巧控鍵盤 - 中文 (注音)'),
(11, 3, 'Mac mini M1 8G/256GB', 20805, 'macmini.jpg', '★Apple M1晶片配備8核心CPU、8核心GPU與16核心神經網路引擎\r\n★8GB 統一記憶體\r\n★256GB SSD 儲存裝置\r\n★Gigabit 乙太網路'),
(12, 4, 'AirPods 藍牙耳機 (第 3 代) ', 5590, 'airpods3.jpg', '★藍牙5.0\r\n★抗汗抗水功能(IPX4)\r\n★具有動態頭部追蹤功能的空間音訊\r\n★充電一次的聆聽時間最長可達6小時\r\n★適應性等化功能，根據你的耳型調整音樂'),
(13, 4, 'AirPods Pro 藍芽耳機 第2代', 7490, 'airpodspro2.jpg', '★個人化空間音訊\r\n★具﻿備﻿動﻿態﻿頭﻿部﻿追﻿蹤\r\n★主動式降噪與適﻿應﻿性﻿通﻿透﻿模﻿式\r\n★抗汗抗水的AirPods與﻿充﻿電﻿盒\r\n★充電一次的聆聽時間，最長可達6小時'),
(14, 4, 'APPLE Watch Ultra', 25900, 'applewatchultra.jpg', '★IP6X等級防塵認證、MIL-STD 810H認證\r\n★Retina顯示器，最高可達2000尼特亮度\r\n★血氧濃度app、心電圖app\r\n★高心率與低心率通知、心律不整通知\r\n★體溫感測、經期追蹤功能、排卵日回推估計\r\n★SOS 緊急服務、全球緊急電話、跌倒偵測功能、車禍偵測功能'),
(15, 4, 'Apple Watch S8', 13553, 'applewatchs8.jpg', '★IP6X等級防塵認證\r\n★Retina顯示器，最高可達1000尼特亮度\r\n★血氧濃度app、心電圖app\r\n★高心率與低心率通知、心律不整通知\r\n★體溫感測、經期追蹤功能、排卵日回推估計\r\n★SOS 緊急服務、全球緊急電話、跌倒偵測功能、車禍偵測功能');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- 資料表索引 `memberdata`
--
ALTER TABLE `memberdata`
  ADD PRIMARY KEY (`m_id`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `mid` (`m_id`);

--
-- 資料表索引 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderdetailid`),
  ADD KEY `orderid` (`orderid`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberdata`
--
ALTER TABLE `memberdata`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `orderid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderdetailid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `memberdata` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
