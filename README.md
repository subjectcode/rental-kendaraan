# 🚗 Rental Kendaraan - Kelompok 4

Sistem Rental Kendaraan berbasis Laravel + PHP + MySQL yang digunakan untuk mengelola data kendaraan, pelanggan, transaksi penyewaan, dan pengembalian kendaraan secara online.

---

## 👨‍💻 Kelompok 4


---

## ✨ Fitur Utama

- Dashboard statistik rental
- CRUD kendaraan
- CRUD pelanggan
- Transaksi penyewaan kendaraan
- Pengembalian kendaraan
- Status kendaraan otomatis
- Status pembayaran
- UUID sebagai primary key
- Database relational MySQL
- Deploy online menggunakan Railway

---

## 🛠️ Teknologi Yang Digunakan

- Laravel 13
- PHP 8.3
- MySQL
- Bootstrap
- Font Awesome
- Railway
- GitHub

---

## 📂 Struktur Database

### Tabel Kendaraan
- id_kendaraan
- nama_kendaraan
- jenis
- merk
- harga_sewa
- status

### Tabel Pelanggan
- id_pelanggan
- nama
- nik
- no_hp
- alamat

### Tabel Transaksi
- id_transaksi
- id_pelanggan
- id_kendaraan
- tgl_sewa
- lama_sewa
- total_bayar
- status_pembayaran

### Tabel Pengembalian
- id_pengembalian
- id_transaksi
- tgl_kembali
- denda
- total_bayar

---

## 🔗 Relasi Database

- Satu pelanggan dapat memiliki banyak transaksi
- Satu kendaraan dapat digunakan pada banyak transaksi
- Satu transaksi memiliki satu pengembalian

---

## 🌐 Deployment

Aplikasi telah di-deploy menggunakan Railway dan dapat diakses secara online.

---

## 📸 Tampilan Sistem

- Dashboard
- Data Kendaraan
- Data Pelanggan
- Data Transaksi
- Data Pengembalian

---

## ⚡ Cara Menjalankan Project

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
