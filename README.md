# Sistem Manajemen Data Pegawai

Aplikasi web modern untuk pengelolaan data kepegawaian yang dibangun menggunakan **Laravel**, **Filament Panel Builder**, dan **MySQL**. Seluruh antarmuka, notifikasi, validasi, dan alur kerja menggunakan Bahasa Indonesia dengan zona waktu **Asia/Jakarta (WIB)**.

---

## 🌟 Fitur Utama

1. **Autentikasi & Hak Akses Admin (`/admin`)**
   - Akses penuh ke dashboard dan modul pegawai hanya untuk admin yang telah terautentikasi.
   - Pendaftaran publik dinonaktifkan demi keamanan sistem internal.
   - Password disimpan menggunakan hashing terenkripsi (`bcrypt`).

2. **Manajemen Data Pegawai (CRUD)**
   - **Tambah Pegawai**: Formulir input nama lengkap, jenis kelamin, pendidikan terakhir, dan tanggal lahir.
   - **Tabel Interaktif**:
     - Nomor urut baris otomatis per halaman (`No.`).
     - Pencarian cepat berdasarkan nama pegawai.
     - Pengurutan (*sorting*) berdasarkan kolom yang relevan.
     - Filter data berdasarkan Jenis Kelamin (*Laki-laki*, *Perempuan*).
     - Filter data berdasarkan Pendidikan Terakhir (*SD* sampai *S3*).
     - Format tanggal lahir Indonesia: `DD/MM/YYYY`.
     - Penghitungan usia dinamis dalam tahun penuh menggunakan Carbon (tidak disimpan di database sehingga selalu akurat).
   - **Detail Pegawai**: Halaman informasi lengkap pegawai beserta waktu pencatatan.
   - **Ubah Pegawai**: Perbaruan data dengan validasi server-side.
   - **Modal Konfirmasi Penghapusan Khusus**:
     - Judul: *“Hapus Data Pegawai?”*
     - Pesan: *“Apakah Anda yakin ingin menghapus data pegawai [nama pegawai]? Tindakan ini tidak dapat dibatalkan.”*
     - Tombol konfirmasi merah: *“Ya, Hapus”*
     - Tombol pembatalan: *“Batal”*
     - Menekan Batal, menutup modal, atau menekan tombol Escape tidak akan menghapus data.
     - Notifikasi keberhasilan berbahasa Indonesia setelah setiap aksi tambah, ubah, atau hapus.

3. **Dashboard Statistik & Visualisasi Grafik (ChartWidget)**
   - **Kartu Ringkasan (Stats Overview)**:
     - Total pegawai terdaftar.
     - Jumlah & persentase pegawai laki-laki.
     - Jumlah & persentase pegawai perempuan.
   - **Grafik Komposisi Jenis Kelamin**:
     - Diagram *Doughnut* interaktif membandingkan jumlah laki-laki dan perempuan dilengkapi tooltip detail.
   - **Grafik Distribusi Pendidikan Terakhir**:
     - Diagram *Bar* urut berjenjang dari `SD`, `SMP`, `SMA/SMK`, `D1`, `D2`, `D3`, `D4/S1`, `S2`, hingga `S3`.
     - Jenjang tanpa pegawai tetap ditampilkan bernilai `0`.
   - **Grafik Distribusi Kelompok Usia**:
     - Diagram *Bar* dengan 6 kelompok usia: `<20`, `20–29`, `30–39`, `40–49`, `50–59`, dan `≥60` tahun.
     - Dihitung secara presisi per hari ini menggunakan Carbon; setiap pegawai masuk ke tepat satu kelompok usia.
   - Seluruh widget menangani kondisi database kosong secara anggun (*graceful*) tanpa error.

---

## 💻 Kebutuhan Sistem (System Requirements)

- **PHP**: Versi `8.2` atau lebih baru (Disarankan PHP `8.4`).
  - Ekstensi PHP yang wajib aktif: `pdo_mysql`, `mbstring`, `intl`, `curl`, `openssl`, `fileinfo`, `gd`, `zip`.
- **Database**: MySQL / MariaDB (tersedia di XAMPP).
- **Composer**: Versi `2.x`.
- **Web Browser**: Chrome, Edge, Firefox, atau Safari versi terbaru.

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi:

### 1. Persiapan Database di XAMPP
1. Buka aplikasi **XAMPP Control Panel**.
2. Pastikan service **MySQL** (dan Apache jika diperlukan) dalam status **Running**.
3. Buka browser dan akses **phpMyAdmin** di `http://localhost/phpmyadmin`.
4. Buat database baru dengan nama:
   ```sql
   CREATE DATABASE `sistem_pegawai` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

### 2. Konfigurasi File Environment (`.env`)
Salin atau pastikan file `.env` sudah sesuai:
```env
APP_NAME="Sistem Manajemen Data Pegawai"
APP_ENV=local
APP_KEY=base64:HsuxUvxOy/Dm7mkxcwWuPCbYJbm2/J3aay9tO6uAvko=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_pegawai
DB_USERNAME=root
DB_PASSWORD=
```
*(Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` jika Anda menggunakan password untuk user root MySQL Anda).*

### 3. Menjalankan Migrasi Database
Jalankan perintah Artisan untuk membuat tabel-tabel yang diperlukan:
```bash
php artisan migrate
```

### 4. Membuat Akun Admin
Terdapat 3 (tiga) cara mudah untuk menyiapkan akun Administrator:

- **Cara A: Menggunakan Seeder Admin (Disarankan untuk cepat)**
  ```bash
  php artisan db:seed --class=AdminUserSeeder
  ```
  *Akun default yang dibuat:*
  - **Email**: `admin@example.com`
  - **Password**: `admin123`

- **Cara B: Menggunakan Perintah Khusus (`app:create-admin`)**
  ```bash
  php artisan app:create-admin
  ```
  Anda dapat memasukkan Nama, Email, dan Password admin secara interaktif melalui terminal.

- **Cara C: Menggunakan Perintah Filament**
  ```bash
  php artisan make:filament-user
  ```

### 5. Memasukkan Data Contoh Pegawai (Opsional)
Untuk menguji coba tampilan dashboard, grafik, dan tabel pegawai dengan data nyata, jalankan seeder pegawai fiktif:
```bash
php artisan db:seed --class=EmployeeSeeder
```
> **Catatan:** Seeder ini memuat lebih dari 30 data pegawai dengan variasi lengkap jenis kelamin, 9 jenjang pendidikan (SD hingga S3), dan 6 rentang usia lengkap (<20 hingga ≥60 tahun). Seeder ini hanya akan mengisi data ketika dipanggil secara eksplisit.

### 6. Menjalankan Server Aplikasi
Jalankan server pengembangan Laravel:
```bash
php artisan serve
```

Buka peramban (browser) dan akses:
```
http://localhost:8000/admin
```
*(URL root `http://localhost:8000` akan otomatis dialihkan ke halaman login `/admin`).*

---

## 📁 Struktur Berkas Penting

- `app/Models/Employee.php`: Model data pegawai beserta opsi konsisten dan accessor usia Carbon.
- `app/Filament/Resources/Employees/`:
  - `EmployeeResource.php`: Konfigurasi resource, ikon, dan navigasi.
  - `Schemas/EmployeeForm.php`: Skema form input & validasi pegawai.
  - `Schemas/EmployeeInfolist.php`: Skema tampilan detail pegawai.
  - `Tables/EmployeesTable.php`: Tabel pegawai, filter, pengurutan, nomor urut, dan modal konfirmasi hapus khusus.
  - `Pages/`: Halaman daftar, tambah, lihat, dan ubah data dengan pesan notifikasi berbahasa Indonesia.
- `app/Filament/Widgets/`:
  - `EmployeeStatsOverview.php`: Kartu statistik total pegawai, laki-laki, dan perempuan.
  - `EmployeeGenderChart.php`: Grafik *Doughnut* jenis kelamin.
  - `EmployeeEducationChart.php`: Grafik *Bar* pendidikan terakhir (SD–S3).
  - `EmployeeAgeChart.php`: Grafik *Bar* rentang kelompok usia (<20 s/d ≥60).
- `app/Console/Commands/CreateAdminCommand.php`: Perintah konsol pembuatan akun admin.
- `database/migrations/2026_11_08_143856_create_employees_table.php`: Migrasi tabel `employees`.
- `database/seeders/AdminUserSeeder.php`: Seeder akun administrator awal.
- `database/seeders/EmployeeSeeder.php`: Seeder 35+ pegawai fiktif beragam kategori.
- `database/factories/EmployeeFactory.php`: Factory pegawai fiktif.
- `lang/id/`: Terjemahan pesan validasi dan autentikasi dalam Bahasa Indonesia.

---

## 🔒 Keamanan & Praktik Terbaik
- Mengikuti pedoman resmi **Laravel** dan **Filament Panel Builder**.
- Seluruh password di-hash dengan aman.
- Input data divalidasi ketat di sisi server.
- Tidak ada penghapusan data tanpa konfirmasi aktif dari pengguna.
- Akses ke data pegawai dibatasi khusus bagi pengguna yang telah login.
