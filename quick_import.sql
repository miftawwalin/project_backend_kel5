-- Quick Import untuk Request Item System
-- File ini berisi struktur minimal + sample data

-- Buat database (opsional, sesuaikan dengan nama database yang ada)
-- CREATE DATABASE request_item_system;
-- USE request_item_system;

-- 1. Tabel Items (Master Data Barang)
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `loc` varchar(50) NOT NULL,
  `uom` varchar(20) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_code` (`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Users (Data Pegawai)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npk` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `department` varchar(100),
  `position` varchar(100),
  `email` varchar(100),
  `phone` varchar(20),
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `npk` (`npk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Request Forms
CREATE TABLE IF NOT EXISTS `request_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_number` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `produksi` varchar(100) NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `approved_by` varchar(100),
  `received_by` varchar(100),
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_number` (`form_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Request Items
CREATE TABLE IF NOT EXISTS `request_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_form_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `npk_nama` varchar(100) NOT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `request_form_id` (`request_form_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample Data Items (15 items untuk testing)
INSERT INTO `items` (`item_code`, `nama_barang`, `loc`, `uom`, `description`) VALUES
('ITEM001', 'Bolt M8x20', 'A1-B2', 'PCS', 'Bolt ukuran M8 panjang 20mm'),
('ITEM002', 'Nut M8', 'A1-B3', 'PCS', 'Nut ukuran M8'),
('ITEM003', 'Washer M8', 'A1-B4', 'PCS', 'Washer ukuran M8'),
('ITEM004', 'Screw Driver', 'A2-C1', 'PCS', 'Obeng untuk berbagai ukuran'),
('ITEM005', 'Safety Gloves', 'A2-C2', 'PAIR', 'Sarung tangan keselamatan'),
('ITEM006', 'Safety Helmet', 'A2-C3', 'PCS', 'Helm keselamatan kerja'),
('ITEM007', 'Welding Rod 3.2mm', 'A3-D1', 'KG', 'Kawat las diameter 3.2mm'),
('ITEM008', 'Cutting Disc 4 inch', 'A3-D2', 'PCS', 'Mata gerinda potong 4 inch'),
('ITEM009', 'Grinding Disc 4 inch', 'A3-D3', 'PCS', 'Mata gerinda asah 4 inch'),
('ITEM010', 'Paint Brush 2 inch', 'A4-E1', 'PCS', 'Kuas cat ukuran 2 inch'),
('ITEM011', 'Safety Shoes', 'A2-C4', 'PAIR', 'Sepatu keselamatan kerja'),
('ITEM012', 'Safety Goggles', 'A2-C5', 'PCS', 'Kacamata keselamatan'),
('ITEM013', 'Measuring Tape 5m', 'A2-C6', 'PCS', 'Meteran ukur 5 meter'),
('ITEM014', 'Level Tool', 'A2-C7', 'PCS', 'Alat ukur level'),
('ITEM015', 'Hammer 500g', 'A2-C8', 'PCS', 'Palu berat 500 gram');

-- Sample Data Users (5 users untuk testing)
INSERT INTO `users` (`npk`, `nama`, `department`, `position`, `email`, `phone`) VALUES
('NPK001', 'John Doe', 'Production', 'Supervisor', 'john.doe@company.com', '081234567890'),
('NPK002', 'Jane Smith', 'Warehouse', 'Manager', 'jane.smith@company.com', '081234567891'),
('NPK003', 'Mike Johnson', 'Production', 'Operator', 'mike.johnson@company.com', '081234567892'),
('NPK004', 'Sarah Wilson', 'Quality Control', 'Inspector', 'sarah.wilson@company.com', '081234567893'),
('NPK005', 'David Brown', 'Maintenance', 'Technician', 'david.brown@company.com', '081234567894');
