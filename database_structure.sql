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

-- 5. Tabel untuk menyimpan log aktivitas
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

-- Sample data untuk tabel items (sesuaikan dengan kebutuhan)
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
