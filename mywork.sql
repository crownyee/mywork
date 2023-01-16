-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-16 03:35:36
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mywork`
--

-- --------------------------------------------------------

--
-- 資料表結構 `myclient`
--

CREATE TABLE `myclient` (
  `ID` int(255) NOT NULL,
  `Client_name` varchar(16) NOT NULL,
  `Id_card_number` varchar(16) NOT NULL,
  `Telephone_number` varchar(16) NOT NULL,
  `Address` varchar(32) NOT NULL,
  `Age` int(10) NOT NULL,
  `Job` varchar(10) NOT NULL,
  `Date_of_Registration` date NOT NULL DEFAULT current_timestamp(),
  `Consumption_status` varchar(6) NOT NULL,
  `photo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `myclient`
--

INSERT INTO `myclient` (`ID`, `Client_name`, `Id_card_number`, `Telephone_number`, `Address`, `Age`, `Job`, `Date_of_Registration`, `Consumption_status`, `photo`) VALUES
(8, '想歸寶', 'A125346987', '845621397', '新北', 18, '想歸寶', '2023-01-11', '正常', './uploads/OIP.jpg'),
(11, 'GgY', 'E851623479', '516234879', '桃園', 13, '小學生', '2023-01-05', '正常', './uploads/944157193618456576.jpg'),
(1, '邱冠佾', 'F123456789', '123465789', '鶯歌', 22, '學生', '2023-01-01', '正常', './uploads/dooog.png'),
(14, 'DD ', 'F19483759256', '24892748256', 'FF', 48, 'FJG', '2023-01-04', '停用', './uploads/HoloX.jpg'),
(2, '邱冠二', 'F234567891', '234567981', '台北', 33, '上班族', '2023-01-02', '停用', './uploads/Friends.png'),
(3, '邱冠三', 'f345678921', '321654978', '台中', 18, '學生', '2023-01-01', '停用', './uploads/SS.png'),
(6, 'ㄚㄚ邱', 'F512364897', '516234897', '嘉義', 45, '老闆', '2023-01-07', '正常', './uploads/989885968683257866.jpg'),
(5, 'CHUHC', 'F615234789', '516234897', '台中', 33, '上班族', '2023-01-03', '正常', './uploads/1000352971831377940.jpg'),
(7, '阿秋霸', 'G512346987', '651234889', '新北', 24, '學生', '2023-01-06', '正常', './uploads/944157193618456576.jpg'),
(12, 'FFGG', 'G6512348979', '65142348979', '台北', 22, 'GY', '2023-01-04', '正常', './uploads/915513081470259273.jpg'),
(9, '丘丘丘', 'H152364897', '885462239', '高雄', 17, '學生', '2023-01-14', '正常', './uploads/'),
(10, 'xQc', 'S9516234875', '651234879', '美國', 36, '老', '2023-01-07', '正常', './uploads/th.jpg'),
(13, 'YYOuO  ', 'Y213546987', '25648397', '新北市', 22, '學生', '2023-01-06', '正常', './uploads/916168199857401927.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `mycompany_income`
--

CREATE TABLE `mycompany_income` (
  `ID` int(255) NOT NULL,
  `Supplier_name` varchar(16) NOT NULL,
  `Supplier_number` int(6) NOT NULL,
  `Supplier_r_people` varchar(16) NOT NULL,
  `Product_name` varchar(10) NOT NULL,
  `Source` varchar(12) NOT NULL,
  `Specification` varchar(12) NOT NULL,
  `Import_Unit` varchar(6) NOT NULL,
  `Import_Price` decimal(10,2) NOT NULL,
  `Quantity` decimal(10,2) NOT NULL,
  `Subtotal` decimal(10,2) GENERATED ALWAYS AS (`Import_Price` * `Quantity`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `mycompany_income`
--

INSERT INTO `mycompany_income` (`ID`, `Supplier_name`, `Supplier_number`, `Supplier_r_people`, `Product_name`, `Source`, `Specification`, `Import_Unit`, `Import_Price`, `Quantity`) VALUES
(1, '大公司', 112345, '大人物', '大乖乖', '乖乖地', '超好吃', '公克', '20.00', '1000.00'),
(2, '小公司', 456123, '小tt', '小餅乾', '台灣', '好吃', '公克', '10.00', '500.00'),
(8, '好了拉龍哥', 565699, '龍哥', '超級龍包', '龍身上', '超龍', '公斤', '55.00', '200.00'),
(9, 'DD', 58357927, 'DFD', 'FF', 'FF', 'FF', '公克', '30.00', '30.00');

-- --------------------------------------------------------

--
-- 資料表結構 `mycompany_receive`
--

CREATE TABLE `mycompany_receive` (
  `ID` int(255) NOT NULL,
  `Client_name` varchar(16) NOT NULL,
  `Id_card_number` varchar(16) NOT NULL,
  `Receivable_amount` decimal(10,2) NOT NULL,
  `Receivable_date` date NOT NULL,
  `Pending` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `mycompany_receive`
--

INSERT INTO `mycompany_receive` (`ID`, `Client_name`, `Id_card_number`, `Receivable_amount`, `Receivable_date`, `Pending`) VALUES
(1, '邱冠佾', 'F123456789', '100.00', '2023-01-04', '0.00'),
(2, '邱冠佾', 'F123456789', '150.00', '2023-01-17', '0.00'),
(39, 'xQc', 'S9516234875', '225.00', '2023-01-28', '0.00'),
(41, '邱冠佾', 'F123456789', '300.00', '2023-01-28', '0.00'),
(42, '阿秋霸', 'G512346987', '125.00', '2023-02-01', '0.00'),
(43, 'YYOuO', 'Y213546987', '3300.00', '2023-02-09', '0.00'),
(44, 'xQc', 'S9516234875', '225.00', '2023-01-19', '0.00');

-- --------------------------------------------------------

--
-- 資料表結構 `myorder_history`
--

CREATE TABLE `myorder_history` (
  `ID` int(255) NOT NULL,
  `Id_card_number` varchar(16) NOT NULL,
  `Order_name` varchar(16) NOT NULL,
  `Order_date` date NOT NULL,
  `Unit` varchar(6) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Order_price` decimal(10,2) GENERATED ALWAYS AS (`Quantity` * `Price`) VIRTUAL,
  `Supplier_name` varchar(16) NOT NULL,
  `Supplier_number` int(6) NOT NULL,
  `Expected_delivery_date` date NOT NULL,
  `Actual_delivery_date` date NOT NULL,
  `consume` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `myorder_history`
--

INSERT INTO `myorder_history` (`ID`, `Id_card_number`, `Order_name`, `Order_date`, `Unit`, `Quantity`, `Price`, `Supplier_name`, `Supplier_number`, `Expected_delivery_date`, `Actual_delivery_date`, `consume`) VALUES
(1, 'F123456789', '大乖乖', '2023-01-01', '公克', 4, '25.00', '大公司', 112345, '2023-01-03', '2023-01-04', '0'),
(2, 'F234567891', '退費', '2023-01-01', '公克', 3, '25.00', '大公司', 112345, '2023-01-09', '2023-01-10', '-75'),
(3, 'F123456789', '小餅乾', '2023-01-10', '公克', 10, '15.00', '小公司', 456123, '2023-01-12', '2023-01-13', '0'),
(22, 'F123456789', '小餅乾', '2023-01-17', '公克', 20, '15.00', '小公司', 456123, '2023-01-18', '2023-01-19', '0'),
(23, 'S9516234875', '退費', '2023-01-27', '公克', 15, '15.00', '小公司', 456123, '2023-02-10', '2023-02-11', '-225'),
(24, 'G512346987', '大乖乖', '2023-01-19', '公克', 5, '25.00', '大公司', 112345, '2023-01-21', '2023-01-22', '0'),
(25, 'H152364897', '退費', '2023-01-27', '公克', 5, '15.00', '小公司', 456123, '2023-02-01', '2023-02-04', '-75'),
(26, 'S9516234875', '小餅乾', '2023-01-17', '公克', 15, '15.00', '小公司', 456123, '2023-01-20', '2023-01-21', '0'),
(27, 'Y213546987', '超級龍包', '2023-01-24', '公克', 55, '60.00', '好了拉龍哥', 565699, '2023-01-30', '2023-01-31', '0'),
(28, 'Y213546987', '退費', '2023-02-01', '公克', 30, '60.00', '好了拉龍哥', 565699, '2023-02-03', '2023-02-04', '-1800'),
(29, 'G512346987', '退費', '2023-01-05', '公斤', 1, '10.00', '好了拉龍哥', 565699, '2023-01-11', '2023-01-12', '-10');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `myclient`
--
ALTER TABLE `myclient`
  ADD PRIMARY KEY (`Id_card_number`),
  ADD KEY `Client_name` (`Client_name`),
  ADD KEY `ID` (`ID`);

--
-- 資料表索引 `mycompany_income`
--
ALTER TABLE `mycompany_income`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `Supplier_name` (`Supplier_name`),
  ADD KEY `Supplier_number` (`Supplier_number`);

--
-- 資料表索引 `mycompany_receive`
--
ALTER TABLE `mycompany_receive`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `Client_name` (`Client_name`),
  ADD KEY `Id_card_number` (`Id_card_number`);

--
-- 資料表索引 `myorder_history`
--
ALTER TABLE `myorder_history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `Id_card_number` (`Id_card_number`),
  ADD KEY `Supplier_number` (`Supplier_number`),
  ADD KEY `Order_name` (`Order_name`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `myclient`
--
ALTER TABLE `myclient`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `mycompany_income`
--
ALTER TABLE `mycompany_income`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `mycompany_receive`
--
ALTER TABLE `mycompany_receive`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `myorder_history`
--
ALTER TABLE `myorder_history`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `mycompany_receive`
--
ALTER TABLE `mycompany_receive`
  ADD CONSTRAINT `mycompany_receive_ibfk_1` FOREIGN KEY (`Id_card_number`) REFERENCES `myorder_history` (`Id_card_number`);

--
-- 資料表的限制式 `myorder_history`
--
ALTER TABLE `myorder_history`
  ADD CONSTRAINT `myorder_history_ibfk_1` FOREIGN KEY (`Id_card_number`) REFERENCES `myclient` (`Id_card_number`),
  ADD CONSTRAINT `myorder_history_ibfk_2` FOREIGN KEY (`Supplier_number`) REFERENCES `mycompany_income` (`Supplier_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
