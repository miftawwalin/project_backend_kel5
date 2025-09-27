-- Database Structure untuk Request Item System
-- Jalankan script ini di phpMyAdmin

-- 1. Tabel untuk menyimpan data master item/barang
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) NOT NULL UNIQUE,
  `nama_barang` varchar(255) NOT NULL,
  `loc` varchar(50) NOT NULL,
  `uom` varchar(20) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_code` (`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel untuk menyimpan data request form
CREATE TABLE `request_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_number` varchar(50) NOT NULL UNIQUE,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel untuk menyimpan detail item yang direquest
CREATE TABLE `request_items` (
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
  KEY `item_id` (`item_id`),
  FOREIGN KEY (`request_form_id`) REFERENCES `request_forms` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel untuk menyimpan data user/pegawai
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npk` varchar(20) NOT NULL UNIQUE,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel untuk menyimpan inventory movements (GR/GI)
CREATE TABLE `inventory_movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `movement_type` enum('GR','GI') NOT NULL,
  `quantity` int(11) NOT NULL,
  `movement_date` date NOT NULL,
  `reference_number` varchar(100),
  `notes` text,
  `user_id` int(11),
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `movement_type` (`movement_type`),
  KEY `movement_date` (`movement_date`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Tabel untuk menyimpan log aktivitas
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_form_id` int(11),
  `user_id` int(11),
  `action` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `request_form_id` (`request_form_id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`request_form_id`) REFERENCES `request_forms` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data untuk tabel items berdasarkan data inventory 2025
INSERT INTO `items` (`item_code`, `nama_barang`, `loc`, `uom`, `description`) VALUES
('SBM-001-002-0000002', 'ZERUST YELLOW FERROUS VCI FILM SHEET', 'D-5-1(A.1)', 'Pcs', 'Zerust yellow ferrous VCI film sheet untuk proteksi korosi'),
('SBM-001-003-0000001', 'ANTI-RUST OIL TBS-3215', 'OIL AREA', 'Ltr', 'Anti-rust oil TBS-3215 untuk proteksi logam'),
('SBM-001-004-0000001', 'LITHIUM GREASE EP.O', 'D-1-4 (E.2)', 'CAN', 'Lithium grease extreme pressure untuk pelumasan'),
('SBM-001-005-0000001', 'DESICANT SUNDRY II 60 GRAM', 'D-5-1(A.1)', 'Pcs', 'Desicant sundry II 60 gram untuk penyerap kelembaban'),
('SBM-001-006-0000001', 'W-4C ANTI CORROSIVE (18 L/CAN)', 'OIL AREA', 'CAN', 'W-4C anti corrosive 18 liter per can'),
('SBM-001-007-0000001', 'SOLAR', 'D-1-4 (E.2)', 'Ltr', 'Bahan bakar solar untuk mesin'),
('SBM-001-008-0000001', 'CUTTING OIL', 'E-2-4 (C.1)', 'DRUM', 'Cutting oil untuk proses pemotongan'),
('SBM-001-009-0000001', 'HYDRAULIC OIL', 'OIL AREA', 'GALON', 'Hydraulic oil untuk sistem hidrolik'),
('SBM-001-010-0000001', 'CLEANING SOLVENT', 'D-5-1(A.1)', 'Pail', 'Cleaning solvent untuk pembersihan'),
('SBM-001-011-0000001', 'LUBRICATING OIL', 'D-1-4 (E.2)', 'BTL', 'Lubricating oil untuk pelumasan mesin'),
('ITEM001', 'Bolt M8x20', 'A1-B2', 'PCS', 'Bolt ukuran M8 panjang 20mm'),
('ITEM002', 'Nut M8', 'A1-B3', 'PCS', 'Nut ukuran M8'),
('ITEM003', 'Washer M8', 'A1-B4', 'PCS', 'Washer ukuran M8'),
('ITEM004', 'Screw Driver', 'A2-C1', 'PCS', 'Obeng untuk berbagai ukuran'),
('ITEM005', 'Safety Gloves', 'A2-C2', 'PAIR', 'Sarung tangan keselamatan');

-- Sample data untuk tabel users
INSERT INTO `users` (`npk`, `nama`, `department`, `position`, `email`, `phone`) VALUES
('NPK001', 'John Doe', 'Production', 'Supervisor', 'john.doe@company.com', '081234567890'),
('NPK002', 'Jane Smith', 'Warehouse', 'Manager', 'jane.smith@company.com', '081234567891'),
('NPK003', 'Mike Johnson', 'Production', 'Operator', 'mike.johnson@company.com', '081234567892'),
('NPK004', 'Sarah Wilson', 'Quality Control', 'Inspector', 'sarah.wilson@company.com', '081234567893'),
('NPK005', 'David Brown', 'Maintenance', 'Technician', 'david.brown@company.com', '081234567894');

-- Sample data untuk request_forms
INSERT INTO `request_forms` (`form_number`, `tanggal`, `produksi`, `requested_by`, `status`) VALUES
('REQ-2024-001', '2024-01-15', 'PRODUKSI - 4500 TAP', 'NPK001', 'pending'),
('REQ-2024-002', '2024-01-16', 'PRODUKSI - 2500 TAP', 'NPK003', 'approved'),
('REQ-2024-003', '2024-01-17', 'PRODUKSI - 2000 TAP', 'NPK005', 'pending');

-- Sample data untuk request_items
INSERT INTO `request_items` (`request_form_id`, `item_id`, `qty`, `npk_nama`) VALUES
(1, 1, 50, 'NPK001 - John Doe'),
(1, 2, 50, 'NPK001 - John Doe'),
(1, 3, 50, 'NPK001 - John Doe'),
(2, 4, 2, 'NPK003 - Mike Johnson'),
(2, 5, 5, 'NPK003 - Mike Johnson'),
(3, 6, 3, 'NPK005 - David Brown'),
(3, 7, 10, 'NPK005 - David Brown');

-- Sample data untuk inventory movements (GR = Good Receipt, GI = Good Issue)
INSERT INTO `inventory_movements` (`item_id`, `movement_type`, `quantity`, `movement_date`, `reference_number`, `notes`, `user_id`) VALUES
-- GR September 2024
(4, 'GR', 2640, '2024-09-15', 'GR-2024-001', 'Pembelian desicant sundry II', 2),
(5, 'GR', 2, '2024-09-20', 'GR-2024-002', 'Pembelian W-4C anti corrosive', 2),
(6, 'GR', 5000, '2024-09-25', 'GR-2024-003', 'Pembelian solar', 2),
-- GI September 2024
(4, 'GI', 3210, '2024-09-28', 'GI-2024-001', 'Penggunaan untuk produksi', 1),
(5, 'GI', 3, '2024-09-30', 'GI-2024-002', 'Penggunaan untuk maintenance', 5),
(6, 'GI', 2945, '2024-09-30', 'GI-2024-003', 'Penggunaan untuk mesin produksi', 1);

-- Index untuk optimasi query
CREATE INDEX `idx_items_item_code` ON `items` (`item_code`);
CREATE INDEX `idx_request_forms_status` ON `request_forms` (`status`);
CREATE INDEX `idx_request_forms_tanggal` ON `request_forms` (`tanggal`);
CREATE INDEX `idx_request_items_form_id` ON `request_items` (`request_form_id`);
CREATE INDEX `idx_users_npk` ON `users` (`npk`);
CREATE INDEX `idx_activity_logs_created_at` ON `activity_logs` (`created_at`);

-- View untuk memudahkan query data request
CREATE VIEW `v_request_details` AS
SELECT 
    rf.id as request_id,
    rf.form_number,
    rf.tanggal,
    rf.produksi,
    rf.requested_by,
    rf.status,
    ri.id as item_request_id,
    i.item_code,
    i.nama_barang,
    i.loc,
    ri.qty,
    i.uom,
    ri.npk_nama,
    u.nama as user_nama,
    u.department
FROM request_forms rf
LEFT JOIN request_items ri ON rf.id = ri.request_form_id
LEFT JOIN items i ON ri.item_id = i.id
LEFT JOIN users u ON rf.requested_by = u.npk
ORDER BY rf.tanggal DESC, rf.form_number, ri.id;
