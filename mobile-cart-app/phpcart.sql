-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2022-12-26 15:31:25
-- 伺服器版本： 8.0.29
-- PHP 版本： 8.1.6

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
  `categoryid` int UNSIGNED NOT NULL,
  `categoryname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `categorysort` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

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
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `orderid` int UNSIGNED NOT NULL,
  `total` int UNSIGNED DEFAULT NULL,
  `customername` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customeremail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customeraddress` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerphone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paytype` enum('ATM匯款','線上刷卡','貨到付款') CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT 'ATM匯款'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderdetailid` int UNSIGNED NOT NULL,
  `orderid` int UNSIGNED DEFAULT NULL,
  `productid` int UNSIGNED DEFAULT NULL,
  `productname` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `unitprice` int UNSIGNED DEFAULT NULL,
  `quantity` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `productid` int UNSIGNED NOT NULL,
  `categoryid` int UNSIGNED NOT NULL,
  `productname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `productprice` int UNSIGNED DEFAULT NULL,
  `productimages` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

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
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderid`);

--
-- 資料表索引 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderdetailid`);

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
  MODIFY `categoryid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `orderid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderdetailid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `productid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
