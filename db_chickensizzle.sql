-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2025 pada 08.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_chickensizzle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `created_at`) VALUES
(1, 'Chicken Menu', 'Menu ayam dengan berbagai varian', '2025-10-15 03:37:00'),
(2, 'Side Dish', 'Menu pendamping', '2025-10-15 03:37:00'),
(3, 'Beverages', 'Minuman segar', '2025-10-15 03:37:00'),
(4, 'Paket Hemat', 'Paket menu hemat', '2025-10-15 03:37:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `expense_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `financial_records`
--

CREATE TABLE `financial_records` (
  `record_id` int(11) NOT NULL,
  `transaction_type` enum('income','expense') NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `reference_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `current_stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `minimum_stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price_per_unit` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `ingredient_name`, `unit`, `current_stock`, `minimum_stock`, `price_per_unit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ayam Fillet', 'kg', 50.00, 10.00, 35000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(2, 'Tepung Bumbu', 'kg', 20.00, 5.00, 15000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(3, 'Saus Original', 'liter', 10.00, 2.00, 25000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(4, 'Saus Pedas', 'liter', 8.00, 2.00, 25000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(5, 'Saus BBQ', 'liter', 8.00, 2.00, 28000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(6, 'Kentang', 'kg', 30.00, 10.00, 12000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(7, 'Kubis', 'kg', 15.00, 5.00, 8000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(8, 'Wortel', 'kg', 10.00, 3.00, 10000.00, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ingredient_stock`
--

CREATE TABLE `ingredient_stock` (
  `stock_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `transaction_type` enum('in','out','adjustment') NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payment_method` enum('transfer','cash','ewallet') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','verified','rejected') DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT NULL,
  `proof_image` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`payment_id`, `transaction_id`, `payment_method`, `amount`, `status`, `payment_date`, `proof_image`, `notes`, `verified_at`, `verified_by`) VALUES
(1, 3, 'transfer', 45000.00, 'pending', NULL, NULL, 'Menunggu bukti pembayaran', NULL, NULL),
(7, 9, 'transfer', 45000.00, 'pending', '2025-11-27 11:30:22', '1764268222_a44acf9773057c9b3863.png', 'Menunggu bukti pembayaran', NULL, NULL),
(8, 10, 'transfer', 5000.00, 'pending', NULL, NULL, 'Menunggu bukti pembayaran', NULL, NULL),
(9, 11, 'transfer', 45000.00, 'pending', '2025-11-27 11:59:26', '1764269966_37ef0e118a9ec4ce9166.png', 'Menunggu bukti pembayaran', NULL, NULL),
(10, 12, 'transfer', 38000.00, 'pending', '2025-11-27 13:49:22', '1764276562_5bd32f27b6412bc26ae4.png', 'Menunggu bukti pembayaran', NULL, NULL),
(11, 13, 'cash', 8000.00, 'pending', '2025-11-27 13:50:38', NULL, '', NULL, NULL),
(12, 14, 'ewallet', 35000.00, 'pending', NULL, NULL, 'Menunggu bukti pembayaran', NULL, NULL),
(13, 15, 'ewallet', 15000.00, 'pending', '2025-11-27 23:37:00', '1764311820_db24ba60ae709eafbd9f.png', 'Menunggu bukti pembayaran', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `description`, `price`, `stock`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chicken Sizzle Original', 'Ayam sizzle dengan saus original', 35000.00, 50, NULL, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(2, 1, 'Chicken Sizzle Spicy', 'Ayam sizzle dengan saus pedas', 35000.00, 48, NULL, 'active', '2025-10-15 03:37:00', '2025-11-27 20:51:09'),
(3, 1, 'Chicken Sizzle BBQ', 'Ayam sizzle dengan saus BBQ', 38000.00, 39, NULL, 'active', '2025-10-15 03:37:00', '2025-11-27 20:48:58'),
(4, 2, 'French Fries', 'Kentang goreng crispy', 15000.00, 98, NULL, 'active', '2025-10-15 03:37:00', '2025-11-28 06:36:08'),
(5, 2, 'Coleslaw', 'Salad sayuran segar', 10000.00, 80, NULL, 'active', '2025-10-15 03:37:00', '2025-10-15 03:37:00'),
(6, 3, 'Es Teh Manis', 'Teh manis dingin', 5000.00, 198, NULL, 'active', '2025-10-15 03:37:00', '2025-11-27 18:40:11'),
(7, 3, 'Es Jeruk', 'Jus jeruk segar', 8000.00, 148, NULL, 'active', '2025-10-15 03:37:00', '2025-11-27 20:50:38'),
(8, 4, 'Paket Ayang', '1 Chicken Sizzle + French Fries + Es Teh', 45000.00, 24, '1764271898_69dd0a1723aa6db3bbf6.png', 'active', '2025-10-15 03:37:00', '2025-11-27 19:31:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_ingredient_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity_needed` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `report_type` enum('sales','inventory','financial') NOT NULL,
  `report_title` varchar(200) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `report_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`report_data`)),
  `file_path` varchar(255) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `generated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `contact_person`, `phone`, `address`, `email`, `status`, `created_at`) VALUES
(1, 'PT. Ayam Segar', 'Budi Santoso', '021-1234567', NULL, 'budi@ayamsegar.com', 'active', '2025-10-15 03:37:00'),
(2, 'CV. Sayur Fresh', 'Siti Nurhaliza', '021-7654321', NULL, 'siti@sayurfresh.com', 'active', '2025-10-15 03:37:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','paid','processing','shipped','completed','cancelled') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `shipping_method` enum('delivery','pickup','cod','thirdparty') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `invoice_number`, `transaction_date`, `total_amount`, `shipping_cost`, `status`, `shipping_address`, `shipping_method`, `notes`) VALUES
(1, 6, 'INV-1760670516', '2025-10-17 03:08:36', 45000.00, 0.00, 'completed', 'pasar rebo', NULL, NULL),
(2, 6, 'INV-1763099697', '2025-11-14 05:54:57', 45000.00, 0.00, 'pending', 'awdadawdawdaawdawdaw', NULL, NULL),
(3, 6, 'INV-1763100136-126', '2025-11-14 06:02:16', 45000.00, 0.00, 'pending', '', NULL, NULL),
(4, 6, 'INV-1763100654-815', '2025-11-14 06:10:54', 5000.00, 0.00, 'pending', 'dawdqawd', NULL, ''),
(5, 6, 'INV-1763101081-671', '2025-11-14 06:18:01', 15000.00, 0.00, 'pending', 'afascasdawa', NULL, ''),
(6, 6, 'INV-1763101337-118', '2025-11-14 06:22:17', 35000.00, 0.00, 'pending', 'vb7uyuyiu', NULL, ''),
(7, 6, 'INV-1764266609-391', '2025-11-27 18:03:29', 45000.00, 0.00, 'pending', 'r878itg97g', NULL, 'yjxcujhfihfi'),
(8, 6, 'INV-1764266698-427', '2025-11-27 18:04:58', 8000.00, 0.00, 'pending', 'yyruiyriiutgiou', NULL, 'uriufyuif7f'),
(9, 6, 'INV-1764268205-564', '2025-11-27 18:30:05', 45000.00, 0.00, 'completed', 'awdasdawdaw', NULL, 'awdawdawdas'),
(10, 5, 'INV-1764268811-366', '2025-11-27 18:40:11', 5000.00, 0.00, 'completed', 'qraraw', NULL, 'adwad'),
(11, 5, 'INV-1764269955-877', '2025-11-27 18:59:15', 45000.00, 0.00, 'pending', 'tedt', NULL, ''),
(12, 6, 'INV-1764276538-885', '2025-11-27 20:48:58', 38000.00, 0.00, 'pending', 'testtestest', NULL, ''),
(13, 6, 'INV-1764276638-688', '2025-11-27 20:50:38', 8000.00, 0.00, 'cancelled', 'shwsegwgqaw', NULL, ''),
(14, 6, 'INV-1764276669-362', '2025-11-27 20:51:09', 35000.00, 0.00, 'cancelled', 'eihoiusegboisgea', NULL, ''),
(15, 6, 'INV-1764311768-609', '2025-11-28 06:36:08', 15000.00, 0.00, 'pending', 'Latitude: -6.4421888\r\nLongitude: 107.0596096\r\n(Alamat tidak ditemukan)', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`detail_id`, `transaction_id`, `product_id`, `quantity`, `price`, `subtotal`) VALUES
(1, 1, 8, 1, 45000.00, 45000.00),
(2, 2, 8, 1, 45000.00, 45000.00),
(3, 3, 8, 1, 45000.00, 45000.00),
(4, 4, 6, 1, 5000.00, 5000.00),
(5, 5, 4, 1, 15000.00, 15000.00),
(6, 6, 2, 1, 35000.00, 35000.00),
(7, 7, 8, 1, 45000.00, 45000.00),
(8, 8, 7, 1, 8000.00, 8000.00),
(9, 9, 8, 1, 45000.00, 45000.00),
(10, 10, 6, 1, 5000.00, 5000.00),
(11, 11, 8, 1, 45000.00, 45000.00),
(12, 12, 3, 1, 38000.00, 38000.00),
(13, 13, 7, 1, 8000.00, 8000.00),
(14, 14, 2, 1, 35000.00, 35000.00),
(15, 15, 4, 1, 15000.00, 15000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `notify_email` tinyint(1) NOT NULL DEFAULT 1,
  `notify_sms` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `full_name`, `phone`, `address`, `profile_image`, `role`, `notify_email`, `notify_sms`, `created_at`) VALUES
(1, 'admin', 'admin@chickensizzle.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', '081234567890', NULL, NULL, 'admin', 1, 0, '2025-10-15 03:36:59'),
(2, 'customer1', 'customer@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John Doe', '081234567891', 'Jl. Contoh No. 123, Jakarta', NULL, 'customer', 1, 0, '2025-10-15 03:37:00'),
(3, 'admintest', 'admintest@gmail.com', 'admin123456789', 'admintest', '123456789012', NULL, NULL, 'admin', 1, 0, '2025-10-15 15:09:55'),
(5, 'admin2', 'admintest2@gmail.com', '$2y$10$9hUlwTp4O8yrhMoWRl/5yO8v8LYVR58LKvKwmvPzpPYZrNEyCtXpO', 'bantet mpruy', '123123123123', '', NULL, 'admin', 1, 0, '2025-10-15 15:16:07'),
(6, 'bantet ganteng', 'bantet123@gmail.com', '$2y$10$MU81PJs1sCVUgU4NqHlJu./FoRNwhoQJq3xEbKBUMI8tJlZZI75FO', 'bantet ganteng', '123456789', '', '1764274663_601d313fa0d3ef72865c.png', 'customer', 1, 0, '2025-10-15 15:56:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `product_id`, `created_at`) VALUES
(4, 6, 8, '2025-10-24 07:52:58'),
(5, 6, 7, '2025-10-24 07:53:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `unique_user_product` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_date` (`expense_date`);

--
-- Indeks untuk tabel `financial_records`
--
ALTER TABLE `financial_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_type_date` (`transaction_type`,`transaction_date`);

--
-- Indeks untuk tabel `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indeks untuk tabel `ingredient_stock`
--
ALTER TABLE `ingredient_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_ingredient_date` (`ingredient_id`,`transaction_date`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `verified_by` (`verified_by`),
  ADD KEY `idx_status` (`status`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `idx_category_status` (`category_id`,`status`);

--
-- Indeks untuk tabel `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_ingredient_id`),
  ADD UNIQUE KEY `unique_product_ingredient` (`product_id`,`ingredient_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `generated_by` (`generated_by`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_status_date` (`status`,`transaction_date`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_role` (`role`),
  ADD KEY `idx_email` (`email`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD UNIQUE KEY `unique_user_product` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `financial_records`
--
ALTER TABLE `financial_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ingredient_stock`
--
ALTER TABLE `ingredient_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `product_ingredient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `financial_records`
--
ALTER TABLE `financial_records`
  ADD CONSTRAINT `financial_records_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `ingredient_stock`
--
ALTER TABLE `ingredient_stock`
  ADD CONSTRAINT `ingredient_stock_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`),
  ADD CONSTRAINT `ingredient_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `ingredient_stock_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`verified_by`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Ketidakleluasaan untuk tabel `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `product_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`);

--
-- Ketidakleluasaan untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`generated_by`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
