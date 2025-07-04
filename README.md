# SI-PRESMA
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-%3E=8.0-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-brightgreen)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)](https://getbootstrap.com/)

#### SI-PRESMA (Sistem Presensi SMA)
SI-PRESMA adalah aplikasi absensi online berbasis web yang 
memudahkan pencatatan kehadiran seluruh civitas SMA/SMK (siswa, guru, staf) 
secara real time. Dirancang dengan PHP dan MySQL, sistem ini cocok untuk 
kebutuhan demo, tugas akhir, atau implementasi di lingkungan sekolah yang 
ingin beralih ke digital.

## Preview
#### Tampilan halaman login untuk admin 
![Tampilan login untuk admin SI-PRESMA](ss-web-absensi/admin-1.png)
#### Tampilan halaman dashboard untuk admin
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/admin-2.png)
#### Tampilan halaman data presensi sekolah untuk admin
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/admin-3.png) 
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/admin-4.png) 
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/admin-5.png)
#### Tampilan halaman download excel/pdf/print untuk admin
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/admin-8.png)
#### Tampilan halaman login untuk user
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/admin-9.png)
#### Tampilan halaman utama web absensi untuk user
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/login-2.png)
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/login-3.png)
![Tampilan dashboard untuk admin SI-PRESMA](ss-web-absensi/login-4.png)

## Fitur Utama
1. Presensi Online: Siswa, guru, dan staf bisa mengisi presensi secara daring.
2. Dashboard Admin: Lihat rekap presensi setiap sekolah, notifikasi kehadiran terbaru, dan ekspor data.
3. Multiple School Table: Setiap sekolah punya tabel presensi sendiri (SMA 1 s/d SMA 5 + sekolah lain).
4. Ekspor Data: Download presensi ke Excel/PDF.
5. Validasi & Keamanan: OTP verifikasi email saat registrasi, password terenkripsi.
6. Akses Lokal: Bisa demo lokal.

## Cara Instalasi
1. `git clone https://github.com/Dias-Prameswari/WEB-KOM-AWAN.git`
2. Import `db.sql` ke phpMyAdmin
3. Atur koneksi di file config.php sesuai host, username, dan password.
4. Jalankan di XAMPP/Laragon, akses `http://localhost/absensi/`
5. Login Admin: username: admin, password: [isi_password_admin]
6. Login User: Registrasi terlebih dahulu dan aktivasi via OTP email.

## 📝 Teknologi yang Digunakan
1. Backend: PHP 8+
2. Frontend: Bootstrap 5, Custom CSS
3. Database: MySQL
4. Email: PHPMailer (SMTP Gmail)

## Struktur Database
### Berikut struktur dan relasi utama database SI-PRESMA:
### Tabel: presensi_sma1, presensi_sma2, ..., presensi_sma5, presensi_sekolah_lain

| Field           | Tipe         | Keterangan                |
|-----------------|--------------|---------------------------|
| id              | INT          | Primary Key, Auto Inc     |
| nss             | VARCHAR(20)  | Nomor Sekolah             |
| nama_pengisi    | VARCHAR(50)  | Nama Siswa/Guru/Staf      |
| id_status       | INT          | FK ke tabel status        |
| id_keterangan   | INT          | FK ke keterangan_presensi |
| waktu_presensi  | DATETIME     | Tanggal & waktu presensi  |

---

### Tabel: admin

| Field      | Tipe          | Keterangan        |
|------------|---------------|------------------|
| id         | INT           | Primary Key      |
| username   | VARCHAR(30)   | Username admin   |
| password   | VARCHAR(100)  | Hash password    |

---

### Tabel: user

| Field      | Tipe          | Keterangan         |
|------------|---------------|-------------------|
| id         | INT           | Primary Key       |
| nama       | VARCHAR(50)   | Nama user         |
| email      | VARCHAR(50)   | Email             |
| password   | VARCHAR(100)  | Hash password     |
| otp        | VARCHAR(8)    | OTP verifikasi    |
| aktif      | TINYINT       | Status aktif (1/0)|

---

### Tabel: status

| Field       | Tipe          | Keterangan              |
|-------------|---------------|------------------------|
| id          | INT           | Primary Key            |
| nama_status | VARCHAR(30)   | Jenis status (Siswa, Guru, dst) |

---

### Tabel: keterangan_presensi

| Field            | Tipe          | Keterangan                  |
|------------------|---------------|----------------------------|
| id               | INT           | Primary Key                |
| nama_keterangan  | VARCHAR(20)   | Hadir/Izin/Sakit/Alfa      |

---

### Tabel: sekolah_semarang_fix_2 (Optional)

| Field           | Tipe          | Keterangan           |
|-----------------|---------------|----------------------|
| id              | INT           | Primary Key          |
| nama_sekolah    | VARCHAR(100)  | Nama sekolah         |
| nss             | VARCHAR(20)   | Nomor sekolah        |
| alamat_sekolah  | VARCHAR(150)  | Alamat sekolah       |
| kelurahan       | VARCHAR(50)   | Kelurahan            |
| kecamatan       | VARCHAR(50)   | Kecamatan            |
| nomor_telepon   | VARCHAR(30)   | Nomor telepon        |

> **Note:** Data sekolah sudah include di file `db.sql` dan siap dipakai tanpa setup tambahan.

---

### **Relasi Foreign Key**
- `presensi_smaX.id_status` → `status.id`
- `presensi_smaX.id_keterangan` → `keterangan_presensi.id`

---
Dibuat oleh [Dias Prameswari](https://github.com/Dias-Prameswari) | 2025
