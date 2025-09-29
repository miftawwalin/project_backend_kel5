# Database Structure Documentation
## Request Item System - PT. METALART ASTRA INDONESIA

### 📋 Overview
Database ini dirancang untuk sistem request barang warehouse consumable dengan fitur auto-fill berdasarkan item code.

### 🗂️ Tabel Utama

#### 1. **items** - Master Data Barang
```sql
- id (Primary Key)
- item_code (Unique) - Kode barang yang digunakan untuk auto-fill
- nama_barang - Nama lengkap barang
- loc - Lokasi penyimpanan barang
- uom - Unit of Measure (PCS, KG, PAIR, dll)
- description - Deskripsi barang
- created_at, updated_at - Timestamp
```

#### 2. **request_forms** - Data Form Request
```sql
- id (Primary Key)
- form_number (Unique) - Nomor form request (P1-XXXX)
- tanggal - Tanggal request
- produksi - Jenis produksi (4500 TAP, 2500 TAP, 2000 TAP)
- requested_by - NPK user yang request
- approved_by - NPK user yang approve
- received_by - NPK user yang receive
- status - Status form (pending, approved, rejected, completed)
- created_at, updated_at - Timestamp
```

#### 3. **request_items** - Detail Item yang Direquest
```sql
- id (Primary Key)
- request_form_id (Foreign Key) - Relasi ke request_forms
- item_id (Foreign Key) - Relasi ke items
- qty - Jumlah yang direquest
- npk_nama - NPK dan nama user
- notes - Catatan tambahan
- created_at, updated_at - Timestamp
```

#### 4. **users** - Data User/Pegawai
```sql
- id (Primary Key)
- npk (Unique) - Nomor Pegawai Karyawan
- nama - Nama lengkap
- department - Departemen
- position - Posisi/jabatan
- email - Email
- phone - Nomor telepon
- is_active - Status aktif/tidak
- created_at, updated_at - Timestamp
```

#### 5. **activity_logs** - Log Aktivitas
```sql
- id (Primary Key)
- request_form_id (Foreign Key) - Relasi ke request_forms
- user_id (Foreign Key) - Relasi ke users
- action - Jenis aksi (create, update, approve, reject)
- description - Deskripsi aksi
- created_at - Timestamp
```

### 🔗 Relasi Antar Tabel

```
request_forms (1) -----> (N) request_items
    |                           |
    |                           v
    |                       items (1)
    |
    v
users (1) -----> (N) activity_logs
```

### 📊 View yang Tersedia

#### **v_request_details** - View Gabungan Data
View ini menggabungkan semua data request dengan detail item dan user untuk memudahkan query.

### 🚀 Cara Menggunakan

1. **Import Database:**
   - Buka phpMyAdmin
   - Pilih database yang akan digunakan
   - Klik tab "Import"
   - Upload file `database_structure.sql`
   - Klik "Go" untuk menjalankan

2. **Sample Data:**
   - Database sudah include sample data untuk testing
   - 15 sample items dengan berbagai kategori
   - 5 sample users dengan NPK berbeda
   - 3 sample request forms dengan status berbeda

3. **Customisasi Data:**
   - Tambahkan item baru di tabel `items`
   - Tambahkan user baru di tabel `users`
   - Sesuaikan dengan kebutuhan perusahaan

### 🔍 Query Contoh

#### Cari item berdasarkan item code:
```sql
SELECT * FROM items WHERE item_code = 'ITEM001';
```

#### Lihat semua request yang pending:
```sql
SELECT * FROM v_request_details WHERE status = 'pending';
```

#### Lihat request berdasarkan user:
```sql
SELECT * FROM v_request_details WHERE requested_by = 'NPK001';
```

### 📝 Catatan Penting

1. **Item Code harus unique** - digunakan untuk auto-fill
2. **Form Number harus unique** - format P1-XXXX
3. **NPK harus unique** - identifier user
4. **Foreign Key constraints** - data integrity terjaga
5. **Index sudah dioptimasi** - query performance baik

### 🔧 Maintenance

- **Backup database** secara berkala
- **Monitor performance** dengan query yang kompleks
- **Update sample data** sesuai kebutuhan real
- **Tambah index** jika diperlukan untuk query baru

### 📞 Support

Untuk pertanyaan atau modifikasi database, hubungi tim development.
