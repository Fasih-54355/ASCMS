-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 02:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'skincare'),
(2, 'haircare'),
(3, 'cosmetics');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `dist_id` int(11) NOT NULL,
  `dist_name` varchar(25) NOT NULL,
  `dist_email` varchar(50) DEFAULT NULL,
  `dist_phone` varchar(10) NOT NULL,
  `dist_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`dist_id`, `dist_name`, `dist_email`, `dist_phone`, `dist_address`) VALUES
(1, 'Nishant Shah', 'nishant45@gmail.com', '8980769792', 'Alpha Mall, Vastrapur, Ahmedabad'),
(2, 'Rahul Pandey', 'rahul431@gmail.com', '9099432197', 'Gota, S.G. Highway, Ahmedabad'),
(3, 'Pawan Panchal', 'pawan.rocks@gmail.com', '7878025437', 'Modhera Stadium, Ahmedabad'),
(4, 'Pushpak Patel', 'pushpak@gmail.com', '9012376544', 'Navrangpura, Ahmedabad'),
(5, 'Haniket Patel', 'hanipatel@gmail.com', '8980745372', 'CTM, Ahmedabad');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date_added` date DEFAULT current_timestamp(),
  `expiry_date` date DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `product_id`, `quantity`, `location`, `date_added`, `expiry_date`, `info`) VALUES
('INV501', 'PRO001', 20000, 'Warehouse A', '2023-11-01', '2024-10-31', 'Skincare - Hydrating Facial Cleanser'),
('INV502', 'PRO002', 15000, 'Warehouse B', '2023-11-02', '2024-12-31', 'Skincare - Vitamin C Serum'),
('INV503', 'PRO003', 18000, 'Warehouse C', '2023-11-03', '2024-09-30', 'Skincare - Moisturizing Night Cream'),
('INV504', 'PRO004', 12000, 'Warehouse A', '2023-11-04', '2024-11-30', 'Haircare - Repairing Hair Mask'),
('INV505', 'PRO005', 25000, 'Warehouse B', '2023-11-05', '2024-10-31', 'Haircare - Argan Oil Shampoo'),
('INV506', 'PRO006', 18000, 'Warehouse C', '2023-11-06', '2024-08-31', 'Haircare - Leave-In Conditioner'),
('INV507', 'PRO007', 30000, 'Warehouse A', '2023-11-07', '2024-11-30', 'Cosmetics - Matte Lipstick - Rose Petal'),
('INV508', 'PRO008', 15000, 'Warehouse B', '2023-11-08', '2024-10-31', 'Cosmetics - Liquid Foundation - Natural Beige');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `dist_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_amount` decimal(10,3) NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `order_id`, `retailer_id`, `dist_id`, `date`, `total_amount`, `comments`) VALUES
(1, 2, 4, 3, '2015-04-28', 5119.500, ''),
(2, 1, 2, 5, '2015-04-28', 4780.150, ''),
(3, 3, 1, 1, '2015-04-28', 8891.680, ''),
(4, 4, 5, 4, '2015-04-28', 7888.960, ''),
(5, 5, 5, 1, '2020-12-07', 8919.880, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `invoice_items_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`invoice_items_id`, `invoice_id`, `product_id`, `quantity`) VALUES
(1, 1, 4, 20),
(2, 1, 5, 5),
(3, 1, 7, 10),
(4, 1, 9, 10),
(5, 1, 12, 6),
(6, 1, 14, 5),
(7, 2, 1, 20),
(8, 2, 2, 15),
(9, 2, 5, 10),
(10, 2, 8, 5),
(11, 2, 10, 8),
(12, 2, 11, 10),
(13, 2, 13, 2),
(14, 2, 15, 3),
(15, 3, 1, 2),
(16, 3, 2, 4),
(17, 3, 3, 3),
(18, 3, 4, 8),
(19, 3, 5, 10),
(20, 3, 6, 12),
(21, 3, 8, 4),
(22, 3, 11, 10),
(23, 3, 13, 3),
(24, 3, 14, 5),
(25, 3, 15, 6),
(26, 4, 2, 12),
(27, 4, 4, 30),
(28, 4, 8, 4),
(29, 4, 11, 20),
(30, 4, 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `order_status` varchar(25) DEFAULT NULL,
  `order_date` date DEFAULT current_timestamp(),
  `note` varchar(255) DEFAULT NULL,
  `shipment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `company_id`, `product_id`, `order_quantity`, `order_status`, `order_date`, `note`, `shipment_id`) VALUES
(1, 11, 1, 101, 2, 'Processing', '2023-11-01', 'Skincare - Moisturizer', 301),
(2, 12, 2, 102, 1, 'Shipped', '2023-11-03', 'Haircare - Shampoo', 302),
(3, 13, 3, 103, 3, 'Delivered', '2023-11-05', 'Cosmetics - Lipstick', 303),
(4, 14, 1, 104, 2, 'Processing', '2023-11-07', 'Skincare - Cleanser', 304),
(5, 15, 2, 105, 1, 'Shipped', '2023-11-09', 'Haircare - Conditioner', 305),
(6, 16, 3, 106, 1, 'Delivered', '2023-11-11', 'Cosmetics - Foundation', 306),
(7, 17, 1, 107, 3, 'Processing', '2023-11-13', 'Skincare - Serum', 307),
(8, 18, 2, 108, 2, 'Shipped', '2023-11-15', 'Haircare - Styling Gel', 308),
(9, 19, 3, 109, 1, 'Delivered', '2023-11-17', 'Cosmetics - Mascara', 309);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `ProductionID` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `StartDateTime` datetime DEFAULT NULL,
  `EndDateTime` datetime DEFAULT NULL,
  `QuantityProduced` int(11) DEFAULT NULL,
  `FactoryLocation` varchar(100) DEFAULT NULL,
  `ProductionStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`ProductionID`, `product_id`, `StartDateTime`, `EndDateTime`, `QuantityProduced`, `FactoryLocation`, `ProductionStatus`) VALUES
(1, 1, '2023-10-15 08:00:00', '2023-10-15 18:00:00', 500, 'Skincare Factory A', 'Completed'),
(2, 3, '2023-10-20 09:00:00', '2023-10-20 16:00:00', 400, 'Haircare Factory B', 'Ongoing'),
(3, 2, '2023-10-25 10:00:00', '2023-10-25 17:00:00', 600, 'Skincare Factory B', 'Completed'),
(4, 4, '2023-11-01 08:00:00', '2023-11-01 15:00:00', 300, 'Haircare Factory A', 'Completed'),
(5, 5, '2023-11-05 11:00:00', '2023-11-05 18:00:00', 700, 'Skincare Factory C', 'Ongoing'),
(6, 6, '2023-11-10 09:00:00', '2023-11-10 16:00:00', 450, 'Haircare Factory B', 'Ongoing'),
(7, 7, '2023-11-15 10:00:00', '2023-11-15 17:00:00', 800, 'Skincare Factory A', 'Ongoing'),
(8, 8, '2023-11-20 08:00:00', '2023-11-20 14:00:00', 250, 'Haircare Factory A', 'Completed'),
(9, 9, '2023-11-25 09:00:00', '2023-11-25 16:00:00', 550, 'Skincare Factory B', 'Ongoing'),
(10, 10, '2023-11-30 10:00:00', '2023-11-30 17:00:00', 900, 'Haircare Factory C', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `code`, `price`, `unit`, `category_id`, `description`, `image`, `supplier_id`) VALUES
(1, 'Moisturizing Cream', 'SK-MOIS-001', 29.99, '50ml', 1, 'A hydrating moisturizer for daily use', 'moisturizer.jpg', 101),
(2, 'Vitamin C Serum', 'SK-VITC-002', 19.99, '30ml', 1, 'Brightens and evens skin tone', 'vitamin_c_serum.jpg', 102),
(4, 'Moisturizing Shampoo', 'HC-MOIS-001', 12.50, '250ml', 2, 'Nourishing shampoo for dry hair', 'shampoo.jpg', 201),
(5, 'Argan Oil Conditioner', 'HC-ARGOIL-002', 24.99, '200ml', 2, 'Restores hair shine and softness', 'conditioner.jpg', 202),
(7, 'Matte Lipstick', 'COS-LIP-001', 8.99, '4g', 3, 'Long-lasting, bold matte finish lipstick', 'matte_lipstick.jpg', 301),
(8, 'Eyeshadow Palette', 'COS-EYESH-002', 15.50, '10g', 3, 'Assortment of highly pigmented shades', 'eyeshadow_palette.jpg', 302);

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterials`
--

CREATE TABLE `rawmaterials` (
  `RawMaterialID` int(11) NOT NULL,
  `RawMaterialName` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `UnitOfMeasurement` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `CostPerUnit` decimal(10,2) DEFAULT NULL,
  `QuantityInStock` int(11) DEFAULT NULL,
  `ReorderLevel` int(11) DEFAULT NULL,
  `LeadTime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rawmaterials`
--

INSERT INTO `rawmaterials` (`RawMaterialID`, `RawMaterialName`, `Description`, `SupplierID`, `UnitOfMeasurement`, `location`, `CostPerUnit`, `QuantityInStock`, `ReorderLevel`, `LeadTime`) VALUES
(1, 'Hyaluronic Acid', 'Hydrating ingredient for skincare products.', 1, 'grams', 'Warehouse A', 5.00, 1000, 200, 7),
(3, 'Tea Tree Oil', 'Antibacterial oil used in skincare and haircare.', 3, 'milliliters', 'Warehouse B', 8.50, 1200, 250, 5),
(4, 'Jojoba Oil', 'Moisturizing oil for skincare and hair products.', 4, 'milliliters', 'Warehouse C', 10.25, 950, 180, 8),
(5, 'Argan Oil', 'Nourishing oil for hair and skincare.', 1, 'milliliters', 'Warehouse B', 15.00, 700, 120, 10),
(6, 'Coconut Milk', 'Nourishing ingredient for hair products.', 5, 'liters', 'Warehouse C', 20.00, 500, 100, 12),
(7, 'Aloe Vera Gel', 'Soothing gel for skincare and haircare.', 3, 'milliliters', 'Warehouse A', 7.50, 1500, 300, 6),
(8, 'Avocado Oil', 'Moisturizing oil for hair and skincare products.', 6, 'milliliters', 'Warehouse A', 14.00, 850, 160, 9),
(9, 'Vitamin E Oil', 'Antioxidant oil for skincare products.', 2, 'milliliters', 'Warehouse B', 9.75, 1100, 220, 7),
(10, 'Witch Hazel Extract', 'Natural astringent for skincare.', 4, 'liters', 'Warehouse A', 6.50, 1800, 400, 5);

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE `retailer` (
  `retailer_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `address` varchar(200) NOT NULL,
  `area_id` int(11) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retailer`
--

INSERT INTO `retailer` (`retailer_id`, `username`, `password`, `address`, `area_id`, `phone`, `email`) VALUES
(1, 'altaf', 'altaf123', 'A4 Ali Abad Appt, Kajal Park Soci, Sarkhej Road, Ahmedabad', 1, '9978454323', 'altafneva@gmail.com'),
(2, 'nayan', 'nayan123', 'Opp. Shivalik Complex, Vastrapur, Ahmedabad', 2, '9898906523', 'nayan@gmail.com'),
(3, 'nishit', 'nishit123', 'B/H Kakariya Lake, Maninagar, Ahmedabad', 3, '8980941941', 'nishit@gmail.com'),
(4, 'dharmil', 'dharmil123', 'Near Vejalpur Police Station, Vejalpur, Ahmedabad', 5, '7865340091', 'dharmil123@gmail.com'),
(5, 'rajesh', 'rajesh123', 'C4-Pushpak Complex, New Ranip, Ahmedabad', 4, '7898902365', 'rajesh123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `return_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `return_reason` text DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` varchar(255) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quarter` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `quantity_sold` int(11) DEFAULT NULL,
  `revenue` decimal(10,2) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `season` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `product_id`, `product_name`, `quarter`, `year`, `quantity_sold`, `revenue`, `channel`, `season`) VALUES
('SAL1', 'PRO001', 'Hydrating Facial Cleanser', 1, 2023, 5000, 7500.00, 'Retail', 'Winter'),
('SAL10', 'PRO002', 'Vitamin C Serum', 2, 2023, 450, 3825.00, 'Retail', 'Spring'),
('SAL100', 'PRO004', 'Repairing Hair Mask', 1, 2022, 6000, 51048.00, 'Online', 'Winter'),
('SAL101', 'PRO005', 'Argan Oil Shampoo', 1, 2022, 8000, 120000.00, 'Online', 'Winter'),
('SAL102', 'PRO006', 'Leave-In Conditioner', 1, 2022, 6000, 51048.00, 'Online', 'Winter'),
('SAL103', 'PRO007', 'Matte Lipstick - Rose Petal', 1, 2022, 8000, 120000.00, 'Online', 'Winter'),
('SAL104', 'PRO008', 'Liquid Foundation - Natural Beige', 1, 2022, 6000, 51048.00, 'Online', 'Winter'),
('SAL105', 'PRO004', 'Repairing Hair Mask', 1, 2022, 5000, 75000.00, 'Wholesalers', 'Winter'),
('SAL106', 'PRO005', 'Argan Oil Shampoo', 1, 2022, 6500, 97500.00, 'Wholesalers', 'Winter'),
('SAL107', 'PRO006', 'Leave-In Conditioner', 1, 2022, 5000, 37500.00, 'Wholesalers', 'Winter'),
('SAL108', 'PRO007', 'Matte Lipstick - Rose Petal', 1, 2022, 6500, 91000.00, 'Wholesalers', 'Winter'),
('SAL109', 'PRO008', 'Liquid Foundation - Natural Beige', 1, 2022, 5000, 48750.00, 'Wholesalers', 'Winter'),
('SAL11', 'PRO003', 'Moisturizing Night Cream', 2, 2023, 500, 7500.00, 'Retail', 'Spring'),
('SAL110', 'PRO001', 'Hydrating Facial Cleanser', 2, 2022, 750, 11250.00, 'Wholesalers', 'Spring'),
('SAL111', 'PRO002', 'Vitamin C Serum', 2, 2022, 600, 5100.00, 'Wholesalers', 'Spring'),
('SAL112', 'PRO003', 'Moisturizing Night Cream', 2, 2022, 650, 6500.00, 'Wholesalers', 'Spring'),
('SAL113', 'PRO004', 'Repairing Hair Mask', 2, 2022, 500, 7500.00, 'Wholesalers', 'Spring'),
('SAL114', 'PRO005', 'Argan Oil Shampoo', 2, 2022, 650, 9750.00, 'Wholesalers', 'Spring'),
('SAL115', 'PRO006', 'Leave-In Conditioner', 2, 2022, 500, 3750.00, 'Wholesalers', 'Spring'),
('SAL116', 'PRO007', 'Matte Lipstick - Rose Petal', 2, 2022, 650, 9100.00, 'Wholesalers', 'Spring'),
('SAL117', 'PRO008', 'Liquid Foundation - Natural Beige', 2, 2022, 500, 4875.00, 'Wholesalers', 'Spring'),
('SAL118', 'PRO001', 'Hydrating Facial Cleanser', 3, 2022, 850, 12750.00, 'Wholesalers', 'Summer'),
('SAL119', 'PRO002', 'Vitamin C Serum', 3, 2022, 675, 5737.50, 'Wholesalers', 'Summer'),
('SAL12', 'PRO004', 'Repairing Hair Mask', 2, 2023, 375, 3187.50, 'Retail', 'Spring'),
('SAL120', 'PRO003', 'Moisturizing Night Cream', 3, 2022, 650, 6500.00, 'Wholesalers', 'Summer'),
('SAL121', 'PRO004', 'Repairing Hair Mask', 3, 2022, 500, 7500.00, 'Wholesalers', 'Summer'),
('SAL122', 'PRO005', 'Argan Oil Shampoo', 3, 2022, 650, 9750.00, 'Wholesalers', 'Summer'),
('SAL123', 'PRO006', 'Leave-In Conditioner', 3, 2022, 500, 3750.00, 'Wholesalers', 'Summer'),
('SAL124', 'PRO007', 'Matte Lipstick - Rose Petal', 3, 2022, 650, 9100.00, 'Wholesalers', 'Summer'),
('SAL125', 'PRO008', 'Liquid Foundation - Natural Beige', 3, 2022, 500, 4875.00, 'Wholesalers', 'Summer'),
('SAL126', 'PRO001', 'Hydrating Facial Cleanser', 4, 2022, 950, 14250.00, 'Wholesalers', 'Autumn'),
('SAL127', 'PRO002', 'Vitamin C Serum', 4, 2022, 800, 6800.00, 'Wholesalers', 'Autumn'),
('SAL128', 'PRO003', 'Moisturizing Night Cream', 4, 2022, 650, 6500.00, 'Wholesalers', 'Autumn'),
('SAL129', 'PRO004', 'Repairing Hair Mask', 4, 2022, 500, 7500.00, 'Wholesalers', 'Autumn'),
('SAL13', 'PRO005', 'Argan Oil Shampoo', 2, 2023, 500, 7500.00, 'Retail', 'Spring'),
('SAL130', 'PRO005', 'Argan Oil Shampoo', 4, 2022, 650, 9750.00, 'Wholesalers', 'Autumn'),
('SAL131', 'PRO006', 'Leave-In Conditioner', 4, 2022, 500, 3750.00, 'Wholesalers', 'Autumn'),
('SAL132', 'PRO007', 'Matte Lipstick - Rose Petal', 4, 2022, 650, 9100.00, 'Wholesalers', 'Autumn'),
('SAL133', 'PRO008', 'Liquid Foundation - Natural Beige', 4, 2022, 500, 4875.00, 'Wholesalers', 'Autumn'),
('SAL14', 'PRO006', 'Leave-In Conditioner', 2, 2023, 375, 3187.50, 'Retail', 'Spring'),
('SAL15', 'PRO007', 'Matte Lipstick - Rose Petal', 2, 2023, 500, 7500.00, 'Retail', 'Spring'),
('SAL16', 'PRO008', 'Liquid Foundation - Natural Beige', 2, 2023, 375, 3187.50, 'Retail', 'Spring'),
('SAL17', 'PRO001', 'Hydrating Facial Cleanser', 3, 2023, 700, 10500.00, 'Retail', 'Summer'),
('SAL18', 'PRO002', 'Vitamin C Serum', 3, 2023, 525, 4462.50, 'Retail', 'Summer'),
('SAL19', 'PRO003', 'Moisturizing Night Cream', 3, 2023, 500, 7500.00, 'Retail', 'Summer'),
('SAL2', 'PRO002', 'Vitamin C Serum', 1, 2023, 3750, 31870.50, 'Retail', 'Winter'),
('SAL20', 'PRO004', 'Repairing Hair Mask', 3, 2023, 375, 3187.50, 'Retail', 'Summer'),
('SAL21', 'PRO005', 'Argan Oil Shampoo', 3, 2023, 500, 7500.00, 'Retail', 'Summer'),
('SAL22', 'PRO006', 'Leave-In Conditioner', 3, 2023, 375, 3187.50, 'Retail', 'Summer'),
('SAL23', 'PRO007', 'Matte Lipstick - Rose Petal', 3, 2023, 500, 7500.00, 'Retail', 'Summer'),
('SAL24', 'PRO008', 'Liquid Foundation - Natural Beige', 3, 2023, 375, 3187.50, 'Retail', 'Summer'),
('SAL25', 'PRO001', 'Hydrating Facial Cleanser', 4, 2023, 800, 12000.00, 'Retail', 'Autumn'),
('SAL26', 'PRO002', 'Vitamin C Serum', 4, 2023, 600, 5100.00, 'Retail', 'Autumn'),
('SAL27', 'PRO003', 'Moisturizing Night Cream', 4, 2023, 500, 7500.00, 'Retail', 'Autumn'),
('SAL28', 'PRO004', 'Repairing Hair Mask', 4, 2023, 375, 3187.50, 'Retail', 'Autumn'),
('SAL29', 'PRO005', 'Argan Oil Shampoo', 4, 2023, 500, 7500.00, 'Retail', 'Autumn'),
('SAL3', 'PRO003', 'Moisturizing Night Cream', 1, 2023, 5000, 75000.00, 'Retail', 'Winter'),
('SAL30', 'PRO006', 'Leave-In Conditioner', 4, 2023, 375, 3187.50, 'Retail', 'Autumn'),
('SAL31', 'PRO007', 'Matte Lipstick - Rose Petal', 4, 2023, 500, 7500.00, 'Retail', 'Autumn'),
('SAL32', 'PRO008', 'Liquid Foundation - Natural Beige', 4, 2023, 375, 3187.50, 'Retail', 'Autumn'),
('SAL33', 'PRO001', 'Hydrating Facial Cleanser', 1, 2023, 6500, 97500.00, 'Wholesalers', 'Winter'),
('SAL34', 'PRO002', 'Vitamin C Serum', 1, 2023, 4875, 41419.25, 'Wholesalers', 'Winter'),
('SAL35', 'PRO003', 'Moisturizing Night Cream', 1, 2023, 6500, 97500.00, 'Wholesalers', 'Winter'),
('SAL36', 'PRO004', 'Repairing Hair Mask', 1, 2023, 4875, 41419.25, 'Wholesalers', 'Winter'),
('SAL37', 'PRO005', 'Argan Oil Shampoo', 1, 2023, 6500, 97500.00, 'Wholesalers', 'Winter'),
('SAL38', 'PRO006', 'Leave-In Conditioner', 1, 2023, 4875, 41419.25, 'Wholesalers', 'Winter'),
('SAL39', 'PRO007', 'Matte Lipstick - Rose Petal', 1, 2023, 6500, 97500.00, 'Wholesalers', 'Winter'),
('SAL4', 'PRO004', 'Repairing Hair Mask', 1, 2023, 3750, 31870.50, 'Retail', 'Winter'),
('SAL40', 'PRO008', 'Liquid Foundation - Natural Beige', 1, 2023, 4875, 41419.25, 'Wholesalers', 'Winter'),
('SAL41', 'PRO001', 'Hydrating Facial Cleanser', 2, 2023, 780, 11700.00, 'Wholesalers', 'Spring'),
('SAL42', 'PRO002', 'Vitamin C Serum', 2, 2023, 585, 4972.25, 'Wholesalers', 'Spring'),
('SAL43', 'PRO003', 'Moisturizing Night Cream', 2, 2023, 650, 9750.00, 'Wholesalers', 'Spring'),
('SAL44', 'PRO004', 'Repairing Hair Mask', 2, 2023, 487, 4141.93, 'Wholesalers', 'Spring'),
('SAL45', 'PRO005', 'Argan Oil Shampoo', 2, 2023, 650, 9750.00, 'Wholesalers', 'Spring'),
('SAL46', 'PRO006', 'Leave-In Conditioner', 2, 2023, 487, 4141.93, 'Wholesalers', 'Spring'),
('SAL47', 'PRO007', 'Matte Lipstick - Rose Petal', 2, 2023, 650, 9750.00, 'Wholesalers', 'Spring'),
('SAL48', 'PRO008', 'Liquid Foundation - Natural Beige', 2, 2023, 487, 4141.93, 'Wholesalers', 'Spring'),
('SAL49', 'PRO001', 'Hydrating Facial Cleanser', 3, 2023, 910, 13650.00, 'Wholesalers', 'Summer'),
('SAL5', 'PRO005', 'Argan Oil Shampoo', 1, 2023, 5000, 75000.00, 'Retail', 'Winter'),
('SAL50', 'PRO002', 'Vitamin C Serum', 3, 2023, 682, 5793.75, 'Wholesalers', 'Summer'),
('SAL51', 'PRO003', 'Moisturizing Night Cream', 3, 2023, 650, 9750.00, 'Wholesalers', 'Summer'),
('SAL52', 'PRO004', 'Repairing Hair Mask', 3, 2023, 487, 4141.93, 'Wholesalers', 'Summer'),
('SAL53', 'PRO005', 'Argan Oil Shampoo', 3, 2023, 650, 9750.00, 'Wholesalers', 'Summer'),
('SAL54', 'PRO006', 'Leave-In Conditioner', 3, 2023, 487, 4141.93, 'Wholesalers', 'Summer'),
('SAL55', 'PRO007', 'Matte Lipstick - Rose Petal', 3, 2023, 650, 9750.00, 'Wholesalers', 'Summer'),
('SAL56', 'PRO008', 'Liquid Foundation - Natural Beige', 3, 2023, 487, 4141.93, 'Wholesalers', 'Summer'),
('SAL57', 'PRO001', 'Hydrating Facial Cleanser', 4, 2023, 1040, 15600.00, 'Wholesalers', 'Autumn'),
('SAL58', 'PRO002', 'Vitamin C Serum', 4, 2023, 780, 6630.00, 'Wholesalers', 'Autumn'),
('SAL59', 'PRO003', 'Moisturizing Night Cream', 4, 2023, 650, 9750.00, 'Wholesalers', 'Autumn'),
('SAL6', 'PRO006', 'Leave-In Conditioner', 1, 2023, 3750, 31870.50, 'Retail', 'Winter'),
('SAL60', 'PRO004', 'Repairing Hair Mask', 4, 2023, 487, 4141.93, 'Wholesalers', 'Autumn'),
('SAL61', 'PRO005', 'Argan Oil Shampoo', 4, 2023, 650, 9750.00, 'Wholesalers', 'Autumn'),
('SAL62', 'PRO006', 'Leave-In Conditioner', 4, 2023, 487, 4141.93, 'Wholesalers', 'Autumn'),
('SAL63', 'PRO007', 'Matte Lipstick - Rose Petal', 4, 2023, 650, 9750.00, 'Wholesalers', 'Autumn'),
('SAL64', 'PRO008', 'Liquid Foundation - Natural Beige', 4, 2023, 487, 4141.93, 'Wholesalers', 'Autumn'),
('SAL65', 'PRO001', 'Hydrating Facial Cleanser', 1, 2023, 5000, 7500.00, 'Retail', 'Winter'),
('SAL66', 'PRO002', 'Vitamin C Serum', 1, 2023, 3750, 31870.50, 'Retail', 'Winter'),
('SAL67', 'PRO003', 'Moisturizing Night Cream', 1, 2023, 5000, 75000.00, 'Retail', 'Winter'),
('SAL68', 'PRO004', 'Repairing Hair Mask', 1, 2023, 3750, 31870.50, 'Retail', 'Winter'),
('SAL69', 'PRO005', 'Argan Oil Shampoo', 1, 2023, 5000, 75000.00, 'Retail', 'Winter'),
('SAL7', 'PRO007', 'Matte Lipstick - Rose Petal', 1, 2023, 5000, 75000.00, 'Retail', 'Winter'),
('SAL70', 'PRO006', 'Leave-In Conditioner', 1, 2022, 3750, 31870.50, 'Retail', 'Winter'),
('SAL71', 'PRO007', 'Matte Lipstick - Rose Petal', 1, 2022, 5000, 75000.00, 'Retail', 'Winter'),
('SAL72', 'PRO008', 'Liquid Foundation - Natural Beige', 1, 2022, 3750, 31870.50, 'Retail', 'Winter'),
('SAL73', 'PRO001', 'Hydrating Facial Cleanser', 2, 2022, 5600, 8400.00, 'Retail', 'Spring'),
('SAL74', 'PRO002', 'Vitamin C Serum', 2, 2022, 4200, 35664.60, 'Retail', 'Spring'),
('SAL75', 'PRO003', 'Moisturizing Night Cream', 2, 2022, 5600, 84000.00, 'Retail', 'Spring'),
('SAL76', 'PRO004', 'Repairing Hair Mask', 2, 2022, 4200, 35664.60, 'Retail', 'Spring'),
('SAL77', 'PRO005', 'Argan Oil Shampoo', 2, 2022, 5600, 84000.00, 'Retail', 'Spring'),
('SAL78', 'PRO006', 'Leave-In Conditioner', 2, 2022, 4200, 35664.60, 'Retail', 'Spring'),
('SAL79', 'PRO007', 'Matte Lipstick - Rose Petal', 2, 2022, 5600, 84000.00, 'Retail', 'Spring'),
('SAL8', 'PRO008', 'Liquid Foundation - Natural Beige', 1, 2023, 3750, 31870.50, 'Retail', 'Winter'),
('SAL80', 'PRO008', 'Liquid Foundation - Natural Beige', 2, 2022, 4200, 35664.60, 'Retail', 'Spring'),
('SAL81', 'PRO001', 'Hydrating Facial Cleanser', 3, 2022, 6300, 9450.00, 'Retail', 'Summer'),
('SAL82', 'PRO002', 'Vitamin C Serum', 3, 2022, 4725, 40158.75, 'Retail', 'Summer'),
('SAL83', 'PRO003', 'Moisturizing Night Cream', 3, 2022, 6300, 94500.00, 'Retail', 'Summer'),
('SAL84', 'PRO004', 'Repairing Hair Mask', 3, 2022, 4725, 40158.75, 'Retail', 'Summer'),
('SAL85', 'PRO005', 'Argan Oil Shampoo', 3, 2022, 6300, 94500.00, 'Retail', 'Summer'),
('SAL86', 'PRO006', 'Leave-In Conditioner', 3, 2022, 4725, 40158.75, 'Retail', 'Summer'),
('SAL87', 'PRO007', 'Matte Lipstick - Rose Petal', 3, 2022, 6300, 94500.00, 'Retail', 'Summer'),
('SAL88', 'PRO008', 'Liquid Foundation - Natural Beige', 3, 2022, 4725, 40158.75, 'Retail', 'Summer'),
('SAL89', 'PRO001', 'Hydrating Facial Cleanser', 4, 2022, 7000, 10500.00, 'Retail', 'Autumn'),
('SAL9', 'PRO001', 'Hydrating Facial Cleanser', 2, 2023, 600, 9000.00, 'Retail', 'Spring'),
('SAL90', 'PRO002', 'Vitamin C Serum', 4, 2022, 5250, 44653.50, 'Retail', 'Autumn'),
('SAL91', 'PRO003', 'Moisturizing Night Cream', 4, 2022, 7000, 105000.00, 'Retail', 'Autumn'),
('SAL92', 'PRO004', 'Repairing Hair Mask', 4, 2022, 5250, 44653.50, 'Retail', 'Autumn'),
('SAL93', 'PRO005', 'Argan Oil Shampoo', 4, 2022, 7000, 105000.00, 'Retail', 'Autumn'),
('SAL94', 'PRO006', 'Leave-In Conditioner', 4, 2022, 5250, 44653.50, 'Retail', 'Autumn'),
('SAL95', 'PRO007', 'Matte Lipstick - Rose Petal', 4, 2022, 7000, 105000.00, 'Retail', 'Autumn'),
('SAL96', 'PRO008', 'Liquid Foundation - Natural Beige', 4, 2022, 5250, 44653.50, 'Retail', 'Autumn'),
('SAL97', 'PRO001', 'Hydrating Facial Cleanser', 1, 2022, 8000, 12000.00, 'Online', 'Winter'),
('SAL98', 'PRO002', 'Vitamin C Serum', 1, 2022, 6000, 51048.00, 'Online', 'Winter'),
('SAL99', 'PRO003', 'Moisturizing Night Cream', 1, 2022, 8000, 120000.00, 'Online', 'Winter');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(25) DEFAULT NULL,
  `supplier_address` varchar(25) DEFAULT NULL,
  `supplier_phone` varchar(25) DEFAULT NULL,
  `supplier_email` varchar(25) DEFAULT NULL,
  `manager_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_email`, `manager_name`) VALUES
(301, 'The Ordinary (DECIEM)', 'Toronto, Canada', '+1-800-831-408', 'info@deciem.com', NULL),
(302, 'Paula\'s Choice Skincare', 'Seattle, Washington, USA', '+1-800-831-4088', 'support@paulaschoice.com', NULL),
(303, 'L\'Oréal Professional Prod', 'Paris, France', '+33-1-47-56-70-00', 'contact@loreal.com', NULL),
(304, 'Redken', 'New York, USA', '+1-800-503-3997', 'info@redken.com', NULL),
(305, 'MAC Cosmetics', 'New York, USA', '+1-800-588-0070', 'customerservice@maccosmet', NULL),
(306, 'Maybelline New York', 'New York, USA', '+1-800-944-0730', 'contact@maybelline.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `address` varchar(25) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `image_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fname`, `lname`, `email`, `phone`, `address`, `role`, `company_id`, `image_data`) VALUES
(1, 'admin', '12345', '', '', 'admin@gmail.com', 'admin', 'admin', 'admin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `warehouse_name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `manager_email` varchar(100) DEFAULT NULL,
  `manager_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `warehouse_name`, `location`, `capacity`, `manager_name`, `manager_email`, `manager_phone`) VALUES
(1, 'Warehouse A', '123 Main St, Cityville', 50000, 'John Doe', 'john.doe@email.com', '+1234567890'),
(2, 'Warehouse B', '456 Oak St, Townsville', 80000, 'Jane Smith', 'jane.smith@email.com', '+9876543210'),
(3, 'Warehouse C', '789 Pine St, Villagetown', 12000, 'Bob Johnson', 'bob.johnson@email.com', '+1122334455');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `retailer_id` (`retailer_id`),
  ADD KEY `dist_id` (`dist_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`invoice_items_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`ProductionID`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rawmaterials`
--
ALTER TABLE `rawmaterials`
  ADD PRIMARY KEY (`RawMaterialID`);

--
-- Indexes for table `retailer`
--
ALTER TABLE `retailer`
  ADD PRIMARY KEY (`retailer_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `ProductionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `production_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
