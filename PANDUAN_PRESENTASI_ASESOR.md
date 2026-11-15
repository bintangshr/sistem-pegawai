# 🎓 Buku Saku & Panduan Presentasi Uji Kompetensi (Asesor)
## Sistem Manajemen Data Pegawai (HRIS) berbasis Laravel & Filament

> **Catatan Pengantar untuk Peserta Uji / Mahasiswa:**
> Dokumen ini dirancang sebagai panduan belajar komprehensif, bahasa yang digunakan sengaja dibuat santai, mengalir, dan mudah dipahami layaknya mentor yang sedang menjelaskan kepada temannya sebelum maju sidang. Dokumen ini menggabungkan hasil observasi live sistem di peramban (Chrome) dengan bedah arsitektur kode sumber proyek. Kuasai dokumen ini dan Anda akan siap menjawab segala pertanyaan kritis maupun jebakan asesor dengan percaya diri dan nilai maksimal! 🚀

---

## 📑 DAFTAR ISI
1. [Bagian 1: Bedah Tampilan & Alur Kerja Live Website (Hasil Scan Chrome `localhost:8000`)](#bagian-1-bedah-tampilan--alur-kerja-live-website-hasil-scan-chrome-localhost8000)
2. [Bagian 2: Memahami Filament di Proyek Ini Secara Utuh](#bagian-2-memahami-filament-di-proyek-ini-secara-utuh)
3. [Bagian 3: Pemetaan Lengkap 7 Fokus Penilaian Uji Kompetensi](#bagian-3-pemetaan-lengkap-7-fokus-penilaian-uji-kompetensi)
4. [Bagian 4: Skenario & Urutan Buka File Saat Live Demo di Depan Asesor](#bagian-4-skenario--urutan-buka-file-saat-live-demo-di-depan-asesor)
5. [Bagian 5: Simulasi Tanya-Jawab Asesor (12 Pertanyaan Kritis & Jebakan)](#bagian-5-simulasi-tanya-jawab-asesor-12-pertanyaan-kritis--jebakan)

---

## BAGIAN 1: Bedah Tampilan & Alur Kerja Live Website (Hasil Scan Chrome `localhost:8000`)

Ketika aplikasi dijalankan dengan `php artisan serve`, kita mengakses URL `http://localhost:8000`. Rute root (`/`) secara otomatis mengalihkan pengguna ke pintu gerbang panel admin di `http://localhost:8000/admin`.

Mari kita bedah setiap jengkal tampilan yang muncul di layar monitor dan bagaimana hubungannya dengan berkas kode sumber di belakang layar:

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                           ALUR LIVE ANTARMUKA WEB                           │
├───────────────┬──────────────────────────────────┬──────────────────────────┤
│ Halaman       │ Komponen UI Utama di Layar       │ Berkas Kode Pengendali   │
├───────────────┼──────────────────────────────────┼──────────────────────────┤
│ /admin/login  │ Form Autentikasi, Brand Title    │ AdminPanelProvider.php   │
│               │ Plus Jakarta Sans, Tema Indigo   │ User.php                 │
├───────────────┼──────────────────────────────────┼──────────────────────────┤
│ /admin        │ • AccountWidget (Welcome Admin)  │ AdminPanelProvider.php   │
│ (Dashboard)   │ • 3 Kartu Stats Overview         │ EmployeeStatsOverview.php│
│               │ • Chart Donat Jenis Kelamin      │ EmployeeGenderChart.php  │
│               │ • Chart Batang Pendidikan (SD-S3)│ EmployeeEducationChart.php│
│               │ • Chart Batang Kelompok Usia     │ EmployeeAgeChart.php     │
├───────────────┼──────────────────────────────────┼──────────────────────────┤
│ /admin/       │ • Tombol Header "+ Tambah Pegawai"│ ListEmployees.php        │
│ employees     │ • Tabel Interaktif Data Pegawai  │ EmployeesTable.php       │
│ (Daftar Data) │ • Pencarian Nama, Filter 2 Dropdown│ EmployeeResource.php   │
│               │ • Kolom Usia Otomatis (Badge)    │ Employee.php (usia())    │
│               │ • Aksi Baris (Lihat, Ubah, Hapus)│ EmployeesTable.php       │
│               │ • Modal Konfirmasi Hapus Khusus  │ EmployeesTable.php       │
├───────────────┼──────────────────────────────────┼──────────────────────────┤
│ /admin/       │ Form Input Modular:              │ EmployeeForm.php         │
│ employees/    │ • Nama (TextInput - required)    │ CreateEmployee.php       │
│ create        │ • Jenis Kelamin (Select Dropdown)│ Employee.php (OPTIONS)   │
│               │ • Pendidikan (Select Dropdown)   │ Employee.php (OPTIONS)   │
│               │ • Tanggal Lahir (DatePicker)     │                          │
├───────────────┼──────────────────────────────────┼──────────────────────────┤
│ /admin/       │ Rincian Lengkap Pegawai:         │ EmployeeInfolist.php     │
│ employees/{id}│ Infolist Grid 2 Kolom, Badge,    │ ViewEmployee.php         │
│ (Detail)      │ Usia Dihitung, Tanggal Terdaftar │                          │
├───────────────┼──────────────────────────────────┼──────────────────────────┤
│ /admin/       │ Form Edit + Tombol Aksi Header:  │ EditEmployee.php         │
│ employees/    │ Ubah Data Pegawai, Tombol Lihat, │ EmployeeForm.php         │
│ {id}/edit     │ Tombol Hapus dengan Konfirmasi   │                          │
└───────────────┴──────────────────────────────────┴──────────────────────────┘
```

---

### 1. Pintu Masuk: Halaman Login (`/admin/login`)
- **Tampilan di Layar:**
  - Kotak login modern dengan logo brand: **"HRIS • Sistem Pegawai"**.
  - Menggunakan tipografi elegan **Plus Jakarta Sans** dengan aksen warna dominan **Indigo** (primer) dan **Slate** (latar belakang netral).
  - Terdapat input *Email*, input *Password*, dan tombol *Masuk*.
- **Di Balik Layar:**
  - Dikonfigurasi di `app/Providers/Filament/AdminPanelProvider.php` melalui method rantai: `->brandName('HRIS • Sistem Pegawai')`, `->font('Plus Jakarta Sans')`, dan `->colors(['primary' => Color::Indigo, 'gray' => Color::Slate])`.
  - Keamanan dijamin oleh middleware bawaan Laravel: `VerifyCsrfToken` (mencegah eksploitasi Cross-Site Request Forgery), `EncryptCookies`, dan hashing kata sandi berbasis algoritma `bcrypt`.
  - Akun login admin default disediakan oleh file `database/seeders/AdminUserSeeder.php` (`admin@example.com` / `admin123`).

---

### 2. Beranda Eksekutif: Halaman Dashboard (`/admin`)
Setelah admin menekan tombol masuk, sistem langsung menyajikan beranda analitik visual yang kaya informasi:

#### A. Widget Selamat Datang (`AccountWidget`)
- Menampilkan nama admin yang sedang login dan tombol keluar (*Sign out*).

#### B. Tiga Kartu Ringkasan Statistik (`EmployeeStatsOverview`)
Di bagian atas dashboard berjajar 3 kartu indikator utama (*KPI Cards*):
1. **Kartu Total Pegawai:**
   - **Tampilan Live:** Menampilkan angka `36 Orang` dengan label *"Total Pegawai"*, deskripsi *"Total keseluruhan pegawai"*, ikon pengguna ganda (`heroicon-o-users`), warna primer indigo.
   - **Logika Kode:** `Employee::count()` di berkas `app/Filament/Widgets/EmployeeStatsOverview.php`.
2. **Kartu Pegawai Laki-laki:**
   - **Tampilan Live:** Menampilkan `19 Orang` dengan deskripsi dinamis `"52.8% dari total pegawai"`, warna biru langit (*info*).
   - **Logika Kode:** Dihitung dari `Employee::where('jenis_kelamin', 'Laki-laki')->count()` lalu dipersentasekan `round(($totalLaki / $totalPegawai) * 100, 1)`.
3. **Kartu Pegawai Perempuan:**
   - **Tampilan Live:** Menampilkan `17 Orang` dengan deskripsi dinamis `"47.2% dari total pegawai"`, warna amber/kuning (*warning*).
   - **Logika Kode:** Dihitung dari `Employee::where('jenis_kelamin', 'Perempuan')->count()` lalu dipersentasekan `round(($totalPerempuan / $totalPegawai) * 100, 1)`.

#### C. Tiga Grafik Visualisasi Data (Chart.js)
1. **Grafik 1: Komposisi Jenis Kelamin (`EmployeeGenderChart.php`)**
   - **Tampilan Live:** Diagram Donat (*Doughnut*) interaktif yang membagi proporsi gender. Sisi biru untuk Laki-laki (19) dan sisi merah muda (*pink*) untuk Perempuan (17).
   - **Posisi:** Berdampingan di sisi kiri (`columnSpan = 1`).
   - **Interaktivitas:** Ketika kursor diarahkan ke irisan donat, muncul *tooltip* yang memperlihatkan angka pasti dan kategori. Legenda diletakkan rapi di bagian bawah (*bottom*).
2. **Grafik 2: Distribusi Pendidikan Terakhir (`EmployeeEducationChart.php`)**
   - **Tampilan Live:** Diagram Batang Vertikal (*Bar Chart*) dengan 9 balok berwarna-warni yang mewakili jenjang pendidikan terurut:
     - `SD`: 2 orang
     - `SMP`: 2 orang
     - `SMA/SMK`: 9 orang (terbanyak)
     - `D1`: 1 orang
     - `D2`: 2 orang
     - `D3`: 4 orang
     - `D4/S1`: 8 orang
     - `S2`: 5 orang
     - `S3`: 3 orang
   - **Posisi:** Di sisi kanan berdampingan dengan diagram donat (`columnSpan = 1`).
   - **Kecerdasan Logika:** Menggunakan query agregasi SQL cepat `groupBy('pendidikan_terakhir')`, dan apabila ada jenjang yang bernilai 0, sistem tetap menampilkannya secara elegan tanpa merusak urutan hierarki pendidikan.
3. **Grafik 3: Distribusi Kelompok Usia (`EmployeeAgeChart.php`)**
   - **Tampilan Live:** Diagram Batang Lebar horizontal penuh (`columnSpan = 'full'`) di bawah kedua grafik sebelumnya. Menampilkan sebaran 6 kelompok rentang umur:
     - `<20 tahun`: 5 orang
     - `20–29 tahun`: 7 orang
     - `30–39 tahun`: 6 orang
     - `40–49 tahun`: 6 orang
     - `50–59 tahun`: 6 orang
     - `≥60 tahun`: 6 orang
   - **Kecerdasan Logika:** Usia pegawai **tidak disimpan secara statis** di basis data, melainkan dihitung secara real-time pada detik grafik dimuat menggunakan library `Carbon` (`$employee->tanggal_lahir->age`). Dengan begitu, data grafik usia tidak akan pernah kedaluwarsa meskipun tahun terus bertambah!

---

### 3. Modul Inti: Halaman Daftar Pegawai (`/admin/employees`)
Ketika mengklik menu **"Data Pegawai"** di bilah navigasi kiri:
- **Heading & Header Action:** Di pojok kanan atas terdapat tombol hijau/biru mencolok bertuliskan **"+ Tambah Pegawai"** yang dikendalikan oleh `app/Filament/Resources/Employees/Pages/ListEmployees.php`.
- **Fitur Pencarian Global:** Kolom pencarian di atas tabel mampu mencari nama pegawai secara instan (*live debounce search*).
- **Fitur Filter Ganda:**
  - Filter *Jenis Kelamin*: Pilihan dropdown 'Laki-laki' dan 'Perempuan'.
  - Filter *Pendidikan Terakhir*: Pilihan dropdown dari SD hingga S3.
- **Kolom Tabel Terstruktur:**
  - *Nama Lengkap*: Ditampilkan tebal (*bold*), dapat dicari (*searchable*), dan dapat diurutkan abjad (*sortable*).
  - *Jenis Kelamin*: Tampil dalam bentuk Badge warna (Biru untuk Laki-laki dengan ikon pria, Merah/Pink untuk Perempuan dengan ikon wanita).
  - *Pendidikan*: Tampil sebagai Badge bergradasi warna tingkat pendidikan (Hijau untuk S2/S3, Biru untuk S1, Kuning untuk Diploma, Abu-abu untuk sekolah dasar/menengah).
  - *Tanggal Lahir*: Format tanggal Indonesia ramah pengguna: `d M Y` (contoh: `25 Sep 2007`).
  - *Usia*: Badge abu-abu berlabel format `{Usia} Tahun` (contoh: `19 Tahun`) yang dihitung langsung dari tanggal lahir.
- **Tiga Tombol Aksi Baris (*Row Actions*):**
  - **Lihat:** Membuka halaman detail data pegawai.
  - **Ubah:** Membuka formulir edit pegawai.
  - **Hapus (Fitur Keselamatan Khusus):**
    - Saat tombol "Hapus" diklik, data **TIDAK langsung hilang**.
    - Muncul jendela modal konfirmasi dengan desain peringatan:
      - **Judul Modal:** *"Hapus Data Pegawai?"*
      - **Teks Deskripsi:** *"Apakah Anda yakin ingin menghapus data pegawai [Nama Pegawai]? Tindakan ini tidak dapat dibatalkan."*
      - **Tombol Konfirmasi:** *"Ya, Hapus"* dengan warna merah bahaya (*danger*).
      - **Tombol Batal:** *"Batal"*.
    - Menekan tombol "Batal", menekan tombol `Escape`, atau mengklik area luar modal akan menutup pop-up dengan aman tanpa menghapus data sedikit pun.

---

### 4. Formulir Tambah & Ubah Data Pegawai
- Dikendalikan oleh skema modular `app/Filament/Resources/Employees/Schemas/EmployeeForm.php`:
  - **Field 1: Nama Pegawai** (`TextInput`): Wajib diisi (*required*), maksimal 255 karakter, memiliki teks petunjuk (*placeholder*) `"Masukkan nama lengkap pegawai"`, memenuhi lebar formulir (*columnSpanFull*).
  - **Field 2: Jenis Kelamin** (`Select`): Dropdown pilihan tunggal yang mengambil opsi terstandar dari `Employee::JENIS_KELAMIN_OPTIONS`.
  - **Field 3: Pendidikan Terakhir** (`Select`): Dropdown pilihan terurut dari `Employee::PENDIDIKAN_OPTIONS`.
  - **Field 4: Tanggal Lahir** (`DatePicker`): Pemilih tanggal interaktif dengan format Indonesia `d/m/Y`, dilengkapi batasan cerdas `maxDate(now())` sehingga pengguna mustahil menginput tanggal lahir di masa depan.
- **Alur Notifikasi & Redirect:** Setelah menekan tombol Simpan, sistem tidak menampilkan halaman kosong, melainkan langsung mengarahkan kembali pengguna ke tabel utama (`getRedirectUrl()`), disertai pesan pop-up sukses hijau (*Notification Toast*) berbahasa Indonesia: *"Data Pegawai Berhasil Ditambahkan"*.

---

### 5. Tampilan Detail Pegawai (`Infolist`)
- Dikendalikan oleh `app/Filament/Resources/Employees/Schemas/EmployeeInfolist.php`.
- Menampilkan seluruh atribut pegawai secara rapi dalam grid 2 kolom dengan format badge yang konsisten.
- Di bagian bawah ditampilkan informasi audit otomatis:
  - *Tanggal Terdaftar* (`created_at` format `d/m/Y H:i`).
  - *Terakhir Diperbarui* (`updated_at` format `d/m/Y H:i`).

---

## BAGIAN 2: Memahami Filament di Proyek Ini Secara Utuh

### Apa Itu Filament?
Bagi pemula yang baru belajar Laravel, bayangkan jika kita harus membuat aplikasi web CRUD (Create, Read, Update, Delete) secara manual:
1. Kita harus menulis puluhan baris rute di `routes/web.php`.
2. Kita harus membuat `Controller` dengan method `index`, `create`, `store`, `edit`, `update`, dan `destroy`.
3. Kita harus menulis form HTML di file Blade, mengatur class Tailwind/Bootstrap secara manual satu per satu.
4. Kita harus memasang JavaScript atau library pihak ketiga untuk membuat filter, pagination, modal konfirmasi, dan grafik.

**Filament menyederhanakan seluruh kerumitan tersebut!**
Filament adalah toolkit antarmuka (*Application UI Framework*) modern untuk Laravel yang dibangun di atas **TALL Stack**:
- **T**ailwind CSS (untuk styling modern yang responsif dan fleksibel).
- **A**lpine.js (untuk interaktivitas ringan di sisi browser seperti dropdown dan modal).
- **L**aravel (sebagai fondasi backend yang tangguh dan aman).
- **L**ivewire (mesin reaktif yang memungkinkan antarmuka web berkomunikasi dengan server secara *asynchronous* tanpa perlu reload halaman atau menulis API JSON manual).

Di dalam Filament, kita cukup mendefinisikan struktur formulir dan tabel menggunakan **bahasa PHP berorientasi objek yang deklaratif**. Filament yang akan otomatis mengonversinya menjadi komponen web yang cantik, aman, dan siap pakai.

---

### Bagaimana Cara Kerja Filament Menghubungkan Database ke Tampilan Web?

```
┌────────────────────────────────────────────────────────────────────────┐
│                        ALUR DATA FILAMENT DENGAN LARAVEL               │
└────────────────────────────────────────────────────────────────────────┘

     1. Basis Data MySQL (Tabel 'employees')
                    ▲
                    │ (Eloquent ORM: SELECT, INSERT, UPDATE, DELETE)
                    ▼
     2. Model Eloquent: App\Models\Employee
        - Definisi Kolom: $fillable
        - Casting Data: casts() -> tanggal_lahir as date
        - Dynamic Accessor: usia() via Carbon
        - Master Opsi: JENIS_KELAMIN_OPTIONS, PENDIDIKAN_OPTIONS
                    ▲
                    │ (Dipanggil oleh Resource Filament)
                    ▼
     3. Abstraksi Resource & Skema Filament
        - EmployeeResource: Daftarkan model & halaman (Index, Create, View, Edit)
        - EmployeeForm: Memetakan kolom DB ke TextInput, Select, DatePicker
        - EmployeesTable: Memetakan kolom DB ke TextColumn, SelectFilter, Actions
        - EmployeeInfolist: Memetakan kolom DB ke TextEntry detail
                    ▲
                    │ (Diterjemahkan secara reaktif oleh Livewire)
                    ▼
     4. Browser Pengguna (Chrome)
        - Tampilan tabel HTML reaktif, form validasi realtime, modal konfirmasi,
          serta diagram Chart.js yang interaktif tanpa reload halaman.
```

---

### Mana Komponen Bawaan Filament vs Logika Murni Bikinan Kita?
Asesor sering bertanya: *"Ini kan pakai framework/panel builder, mana bagian yang benar-benar kamu buat sendiri?"*
Inilah jawaban tegas dan pembagiannya:

#### Komponen Bawaan yang Disediakan Filament (*Pre-existing Framework*):
1. **Engine Panel Admin:** Kerangka layout sidebar, header, dark-mode toggle, dan user profile menu.
2. **Library Komponen Form & Tabel:** Class dasar seperti `TextInput`, `Select`, `DatePicker`, `TextColumn`, `Badge`, `SelectFilter`, `DeleteAction`.
3. **Komponen Pembungkus Grafik:** Class `ChartWidget` yang bertindak sebagai jembatan ke pustaka Chart.js.
4. **Sistem Notifikasi:** Class `Notification::make()` untuk memunculkan pesan pop-up toast.

#### Logika Murni & Kode Kustom Bikinan Kita (*Custom Business Logic*):
1. **Perancangan Skema Database:** File migration `create_employees_table.php` dengan tipe data ENUM dan indeks yang efisien.
2. **Kalkulasi Usia Dinamis Carbon:** Method accessor `usia()` pada model `Employee.php` dan kolom tabel `EmployeesTable.php` yang menghitung usia secara real-time dari tanggal lahir ke hari ini.
3. **Penerapan Prinsip DRY pada Master Pilihan:** Konstanta `JENIS_KELAMIN_OPTIONS` dan `PENDIDIKAN_OPTIONS` pada model `Employee.php` yang dipakai bersama oleh Form input, Filter tabel, Seeder, dan Factory.
4. **Custom Modal Keselamatan Hapus:** Konfigurasi penimpaan (*override*) pada `DeleteAction` di `EmployeesTable.php` dan `EditEmployee.php` sehingga memunculkan dialog konfirmasi berbahasa Indonesia yang menyebutkan nama pegawai secara spesifik.
5. **Algoritma Agregasi Data 3 Grafik:**
   - Logika penghitungan persentase di `EmployeeStatsOverview.php`.
   - Query SQL `selectRaw` dan penataan array frekuensi per jenjang hierarki pendidikan di `EmployeeEducationChart.php`.
   - Logika percabangan `if-elseif-else` untuk klasifikasi umur ke dalam 6 bucket di `EmployeeAgeChart.php`.
6. **Command Artisan Kustom (`CreateAdminCommand.php`):** Logika CLI interaktif dengan validasi surel unik dan kata sandi minimal 6 karakter.
7. **Dataset Realistis Seeder (`EmployeeSeeder.php`):** Logika manipulasi tanggal mundur Carbon untuk menciptakan 36 data pegawai tiruan dengan distribusi demografi yang seimbang.

---

## BAGIAN 3: Pemetaan Lengkap 7 Fokus Penilaian Uji Kompetensi

Inilah inti terpenting untuk penilaian uji kompetensi. Setiap aspek di bawah ini dilengkapi dengan **bukti konkret**, **nama file**, **nama class/method**, dan **cuplikan kodenya**:

---

### 1. Penggunaan Spesifikasi Program
Memenuhi seluruh kebutuhan fungsional dan non-fungsional aplikasi:
- **Kebutuhan Fungsional (CRUD & Visualisasi):**
  - Pembuatan data pegawai baru: `App\Filament\Resources\Employees\Pages\CreateEmployee`.
  - Pembacaan & pencarian data: `App\Filament\Resources\Employees\Tables\EmployeesTable`.
  - Pembaruan data: `App\Filament\Resources\Employees\Pages\EditEmployee`.
  - Penghapusan data: `Filament\Actions\DeleteAction`.
  - Dashboard analitik 3 chart: `EmployeeGenderChart`, `EmployeeEducationChart`, `EmployeeAgeChart`.
- **Kebutuhan Non-Fungsional (Perlindungan Data dari Kesalahan Pengguna):**
  - Perlindungan konfirmasi modal sebelum aksi destruktif dilakukan.
  - **Bukti Kode:** `app/Filament/Resources/Employees/Tables/EmployeesTable.php`:
    ```php
    DeleteAction::make()
        ->modalHeading('Hapus Data Pegawai?')
        ->modalDescription(fn ($record): string => "Apakah Anda yakin ingin menghapus data pegawai {$record->nama_pegawai}? Tindakan ini tidak dapat dibatalkan.")
        ->modalSubmitActionLabel('Ya, Hapus')
        ->modalCancelActionLabel('Batal')
        ->color('danger')
    ```

---

### 2. Penulisan Kode Sesuai Guidelines dan Best Practices
- **Standar Format PSR-12 / Laravel Pint:**
  - Seluruh kode proyek telah diformat dan divalidasi menggunakan linter resmi `vendor/bin/pint --format agent` dengan hasil *passed* (tanpa galat sintaks maupun style).
- **Penamaan Variabel & Metode yang Bersih dan Deskriptif:**
  - Menggunakan metode camelCase yang ekspresif: `getRedirectUrl()`, `getCreatedNotification()`, `canAccessPanel()`.
  - Variabel bermakna jelas: `$totalPegawai`, `$totalLaki`, `$persenPerempuan`, `$birthDate`.
- **Prinsip DRY (Don't Repeat Yourself):**
  - Opsi dropdown jenis kelamin dan pendidikan tidak ditulis berulang kali di berbagai berkas, melainkan dipusatkan di model `Employee.php`.
  - **Bukti Kode:** `app/Models/Employee.php`:
    ```php
    public const JENIS_KELAMIN_OPTIONS = [
        'Laki-laki' => 'Laki-laki',
        'Perempuan' => 'Perempuan',
    ];
    ```
- **Pemisahan Tanggung Jawab (Separation of Concerns / Modularitas):**
  - Daripada menumpuk ribuan baris kode di dalam `EmployeeResource.php`, kode dipecah rapi ke dalam kelas terdedikasi:
    - Form Input: `app/Filament/Resources/Employees/Schemas/EmployeeForm.php`
    - Tabel & Filter: `app/Filament/Resources/Employees/Tables/EmployeesTable.php`
    - Tampilan Detail: `app/Filament/Resources/Employees/Schemas/EmployeeInfolist.php`

---

### 3. Pemrograman Terstruktur
Penerapan 3 pilar algoritma pemrograman terstruktur (Sequence, Selection, Iteration):
- **A. Runtutan (Sequence):**
  - Alur eksekusi langkah demi langkah pada pembuatan admin di terminal.
  - **Bukti Kode:** `app/Console/Commands/CreateAdminCommand.php` (method `handle()`):
    ```php
    $name = $this->option('name') ?? $this->ask('Nama Lengkap', 'Administrator');
    // 1. Validasi Email secara berurutan
    while (! $email) { ... }
    // 2. Validasi Kata Sandi
    while (! $password) { ... }
    // 3. Simpan ke Database
    $user = User::create([ ... ]);
    // 4. Tampilkan pesan berhasil
    $this->info("✓ Akun administrator [{$user->email}] berhasil dibuat!");
    ```
- **B. Percabangan (Selection):**
  - Percabangan multi-kondisi `if - elseif - else` untuk mengklasifikasi umur pegawai ke dalam kelompok grafik usia.
  - **Bukti Kode:** `app/Filament/Widgets/EmployeeAgeChart.php`:
    ```php
    if ($age < 20) {
        $ageGroups['<20']++;
    } elseif ($age <= 29) {
        $ageGroups['20–29']++;
    } elseif ($age <= 39) {
        $ageGroups['30–39']++;
    } elseif ($age <= 49) {
        $ageGroups['40–49']++;
    } elseif ($age <= 59) {
        $ageGroups['50–59']++;
    } else {
        $ageGroups['≥60']++;
    }
    ```
  - Percabangan modern `match` expression untuk pewarnaan dinamis badge tabel:
    ```php
    match ($state) {
        'S3', 'S2' => 'success',
        'D4/S1' => 'primary',
        'D3', 'D2', 'D1' => 'warning',
        default => 'gray',
    }
    ```
- **C. Perulangan (Iteration):**
  - Loop `foreach` untuk memproses data seeder dan memetakan frekuensi kategori.
  - **Bukti Kode:** `app/Filament/Widgets/EmployeeEducationChart.php`:
    ```php
    $data = [];
    foreach ($categories as $category) {
        $data[] = (int) ($counts[$category] ?? 0);
    }
    ```

---

### 4. Pemrograman Berorientasi Objek (OOP)
Penerapan 4 pilar utama OOP dalam arsitektur aplikasi:
- **A. Class & Object:**
  - Blueprint class `Employee` yang diinstansiasi menjadi objek rekaman basis data:
    `Employee::create([...])` atau `Stat::make('Total Pegawai', ...)`
- **B. Pewarisan (Inheritance):**
  - Penggunaan kata kunci `extends` untuk mewarisi kemampuan kelas induk:
    - `class EmployeeResource extends Resource` (mewarisi kapabilitas routing & panel Filament).
    - `class EmployeeGenderChart extends ChartWidget` (mewarisi fungsionalitas visualisasi Chart.js).
    - `class CreateAdminCommand extends Command` (mewarisi kemampuan konsol Artisan).
- **C. Enkapsulasi (Encapsulation):**
  - Pembatasan visibilitas properti menggunakan hak akses `protected` dan `protected static` untuk melindungi data internal kelas dari manipulasi luar sembarangan:
    - `protected static ?string $model = Employee::class;`
    - `protected $fillable = ['nama_pegawai', 'jenis_kelamin', ...];`
    - `protected $hidden = ['password', 'remember_token'];`
- **D. Polimorfisme (Polymorphism & Method Overriding):**
  - Menimpa (*override*) method kelas induk untuk memberikan perilaku spesifik pada kelas anak:
  - **Bukti Kode:** `app/Filament/Widgets/EmployeeGenderChart.php`:
    ```php
    // Menimpa method abstrak/induk ChartWidget untuk menentukan jenis chart
    protected function getType(): string
    {
        return 'doughnut';
    }

    // Menimpa method getData() untuk menyuplai dataset khusus pegawai
    protected function getData(): array
    {
        // Logika dataset kustom
    }
    ```

---

### 5. Penggunaan Library atau Komponen Pre-Existing
Aplikasi dibangun secara efisien dengan memanfaatkan pustaka industri yang teruji (didefinisikan di `composer.json`):
1. **`laravel/framework` (v13.x):** Fondasi utama yang menyediakan routing, Eloquent ORM, migrasi, validasi form, middleware keamanan, dan CLI Artisan.
2. **`filament/filament` (v5.x):** Engine utama pembuatan panel antarmuka CRUD, form builder, table builder, infolist, dan widget dashboard.
3. **`nesbot/carbon`:** Library manipulasi waktu tingkat tinggi. Digunakan untuk menghitung selisih usia secara presisi (`$date->age`) dan membuat variasi tanggal seeder (`subYears()`, `subMonths()`).
4. **`Chart.js`:** Library grafik JavaScript populer yang diintegrasikan oleh Filament untuk merender visualisasi data donat dan batang di canvas browser.
5. **`fakerphp/faker`:** Menghasilkan data tiruan nama dan profil Indonesia (`fake('id_ID')->name()`) pada factory dan seeder data pegawai.

---

### 6. Penerapan Akses Basis Data (Database Access)
- **Struktur Tabel Terstandar & Ternormalisasi:**
  - **Bukti Kode:** `database/migrations/2026_11_08_143856_create_employees_table.php`:
    ```php
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pegawai', 255);
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->enum('pendidikan_terakhir', ['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4/S1', 'S2', 'S3']);
        $table->date('tanggal_lahir');
        $table->timestamps();
    });
    ```
- **Pencegahan Celah Keamanan SQL Injection:**
  - Seluruh akses data menggunakan **Eloquent ORM** dan **Query Builder** Laravel yang di balik layar menggunakan PDO Prepared Statements dengan *parameter binding*. Pengguna tidak dapat menyisipkan injeksi SQL berbahaya melalui input form atau pencarian.
- **Efisiensi Query Agregasi:**
  - Pada grafik pendidikan, sistem tidak melakukan *fetching* seluruh baris data ke memori PHP, melainkan menyerahkan proses perhitungan ke mesin basis data menggunakan fungsi SQL `COUNT(*)` dan `GROUP BY`:
    `Employee::query()->selectRaw('pendidikan_terakhir, COUNT(*) as aggregate')->groupBy('pendidikan_terakhir')`
- **Seeder & Factory untuk Kemudahan Replikasi Data:**
  - `AdminUserSeeder.php` memastikan sistem memiliki user admin awal yang siap pakai.
  - `EmployeeSeeder.php` mengisi lebih dari 30 data pegawai dengan komposisi demografi lengkap.

---

### 7. Pembuatan Dokumen Kode Program (Documentation)
- **Dokumentasi Pengguna & Pengembang (`README.md`):**
  - Berisi panduan instalasi langkah demi langkah dari persiapan database, perintah migrasi, opsi pembuatan admin, pengisian seeder, hingga penanganan dependensi sistem.
- **Standar Dokumentasi Internal PHPDoc (Bahasa Indonesia):**
  - Seluruh 18 berkas PHP utama pada proyek ini telah dilengkapi dengan blok PHPDoc lengkap:
    - Tag `@property` dan `@property-read` pada model Eloquent untuk memperjelas kamus data.
    - Tag `@param` dan `@return` dengan **Array Shape Type Definitions** yang presisi.
    - Tag `@var` untuk type-hinting properti kelas.
    - Komentar sebaris (*inline comments* `//`) yang ditempatkan secara terarah pada logika kompleks (perhitungan usia dinamis Carbon dan pengelompokan bucket grafik).

---

## BAGIAN 4: Skenario & Urutan Buka File Saat Live Demo di Depan Asesor

Ketika asesor meminta Anda mendemonstrasikan aplikasi dan membuktikan kode sumbernya, **jangan panik dan jangan membuka file secara acak**. Ikuti panduan 6 langkah tenang berikut ini:

```
┌────────────────────────────────────────────────────────────────────────┐
│               RUTE DEMO PRESENTASI DI DEPAN ASESOR                     │
└────────────────────────────────────────────────────────────────────────┘

  [Langkah 1: Tampilkan Layar Login & Jelaskan AdminPanelProvider.php]
                                 │
                                 ▼
  [Langkah 2: Masuk ke Dashboard, Tunjukkan Kartu Stats & Buka EmployeeStatsOverview.php]
                                 │
                                 ▼
  [Langkah 3: Jelaskan 3 Grafik & Buka EmployeeGenderChart / AgeChart.php]
                                 │
                                 ▼
  [Langkah 4: Pindah ke Menu Pegawai, Uji Pencarian & Demo Modal Hapus]
  [Buka File: EmployeesTable.php]
                                 │
                                 ▼
  [Langkah 5: Buka Form Tambah Pegawai & Tunjukkan EmployeeForm.php & Employee.php]
                                 │
                                 ▼
  [Langkah 6: Tunjukkan Kerapian PHPDoc & Jalankan Linter Laravel Pint]
```

---

### Langkah 1: Tampilkan Halaman Login Web
- **Aksi di Layar:** Buka Chrome di `http://localhost:8000/admin`.
- **File yang Dibuka di Editor:** `app/Providers/Filament/AdminPanelProvider.php`.
- **Kalimat yang Diucapkan ke Asesor:**
  > *"Selamat pagi/siang Bapak/Ibu Asesor. Aplikasi ini kami bangun menggunakan Laravel dan Filament Panel Builder. Di file `AdminPanelProvider.php` ini, kami mengonfigurasi branding sistem menjadi 'HRIS • Sistem Pegawai', menyetel font kustom Plus Jakarta Sans, menerapkan skema warna Indigo, serta mengaktifkan middleware keamanan bawaan Laravel seperti proteksi CSRF dan autentikasi sesi."*

---

### Langkah 2: Masuk ke Dashboard & Tunjukkan Kartu Statistik
- **Aksi di Layar:** Masukkan `admin@example.com` / `admin123`, tekan tombol Masuk. Tunjuk 3 kartu ringkasan di atas layar.
- **File yang Dibuka di Editor:** `app/Filament/Widgets/EmployeeStatsOverview.php`.
- **Kalimat yang Diucapkan ke Asesor:**
  > *"Setelah masuk, kita disambut oleh Dashboard Eksekutif. Di bagian atas terdapat 3 kartu ringkasan. Di file `EmployeeStatsOverview.php` ini, kita bisa melihat bahwa kartu menghitung total pegawai dan mengagregasi persentase gender pria dan wanita secara dinamis menggunakan Eloquent. Jika data pegawai bertambah, persentase di kartu ini otomatis terhitung ulang."*

---

### Langkah 3: Tunjukkan 3 Grafik Visualisasi
- **Aksi di Layar:** Gerakkan kursor ke grafik donat gender, diagram batang pendidikan, dan diagram kelompok usia.
- **File yang Dibuka di Editor:** `app/Filament/Widgets/EmployeeGenderChart.php` dan `app/Filament/Widgets/EmployeeAgeChart.php`.
- **Kalimat yang Diucapkan ke Asesor:**
  > *"Selanjutnya di area visualisasi, terdapat tiga grafik dengan tipe berbeda. Grafik gender menggunakan diagram Donat, sedangkan pendidikan dan usia menggunakan diagram Batang. Yang paling menarik ada di `EmployeeAgeChart.php`: umur pegawai tidak disimpan statis di tabel database, melainkan dihitung secara real-time dari tanggal lahir ke hari ini menggunakan Carbon. Dengan demikian, pengelompokan usia 6 rentang ini selalu akurat per hari ini."*

---

### Langkah 4: Buka Menu Data Pegawai & Uji Coba Tombol Hapus
- **Aksi di Layar:** Klik menu "Data Pegawai", ketik nama di pencarian, coba salah satu filter, lalu klik tombol **"Hapus"** pada salah satu baris hingga muncul modal pop-up. Tunjukkan teks modal, lalu klik **"Batal"**.
- **File yang Dibuka di Editor:** `app/Filament/Resources/Employees/Tables/EmployeesTable.php`.
- **Kalimat yang Diucapkan ke Asesor:**
  > *"Pada modul Data Pegawai, tabel sudah dilengkapi fitur pencarian, filter dua tingkat, dan pagination otomatis. Untuk kebutuhan non-fungsional perlindungan data, kami meng-override `DeleteAction` di file `EmployeesTable.php` sehingga memunculkan modal konfirmasi khusus berbahasa Indonesia yang menyebutkan nama pegawai terkait. Jika pengguna tidak sengaja menekan tombol hapus, mereka cukup menekan 'Batal' dan data tetap aman."*

---

### Langkah 5: Buka Form Tambah Pegawai
- **Aksi di Layar:** Klik tombol "+ Tambah Pegawai", tunjukkan field input dan datepicker.
- **File yang Dibuka di Editor:** `app/Filament/Resources/Employees/Schemas/EmployeeForm.php` dan `app/Models/Employee.php`.
- **Kalimat yang Diucapkan ke Asesor:**
  > *"Untuk struktur formulir, kami menerapkan prinsip Clean Code dan DRY. Skema form dipisahkan ke `EmployeeForm.php`. Pilihan dropdown jenis kelamin dan pendidikan tidak kami tulis berulang di form, melainkan memanggil konstanta master `Employee::JENIS_KELAMIN_OPTIONS` dan `PENDIDIKAN_OPTIONS` dari Model `Employee.php`."*

---

### Langkah 6: Tunjukkan Kerapian Dokumentasi & Kode
- **Aksi di Layar:** Tunjukkan blok PHPDoc di salah satu file dan jalankan perintah `vendor/bin/pint --test` di terminal.
- **File yang Dibuka di Editor:** `app/Models/Employee.php` atau `README.md`.
- **Kalimat yang Diucapkan ke Asesor:**
  > *"Terakhir, seluruh berkas kode proyek telah kami lengkapi dengan dokumentasi blok PHPDoc terstandar bahasa Indonesia yang mencakup tipe properti, parameter, dan array shape definitions. Kode juga telah melalui uji linter Laravel Pint dan memenuhi standar industri PSR-12."*

---

## BAGIAN 5: Simulasi Tanya-Jawab Asesor (12 Pertanyaan Kritis & Jebakan)

Berikut adalah daftar pertanyaan yang paling sering ditanyakan oleh asesor penguji beserta kunci jawaban cerdas dan memikat:

---

#### ❓ Pertanyaan 1: "Kenapa umur pegawai tidak dibuatkan kolom sendiri saja di tabel database (misal: kolom `usia INT`)?"
> **💡 Jawaban Cerdas:**
> *"Menyimpan kolom usia secara statis di database merupakan pelanggaran prinsip normalisasi dan integritas data (bad practice). Usia adalah atribut turunan (derived attribute) yang nilainya bertambah setiap tahun. Jika kita simpan angka '25' di database hari ini, maka dua tahun lagi data tersebut sudah usang dan salah jika tidak ada script cron yang mengupdatenya.*
> *Oleh karena itu, di tabel database kita hanya menyimpan `tanggal_lahir`. Usia dihitung secara dinamis kapan pun dibutuhkan melalui Accessor `usia()` di model `Employee.php` menggunakan pustaka `Carbon`. Datanya selalu akurat 100% tanpa membebani penyimpanan database."*

---

#### ❓ Pertanyaan 2: "Bagaimana Anda membuktikan bahwa aplikasi ini aman dari serangan SQL Injection?"
> **💡 Jawaban Cerdas:**
> *"Aplikasi ini sepenuhnya menggunakan Eloquent ORM dan Query Builder Laravel. Di balik layar, Eloquent menggunakan ekstensi PDO (PHP Data Objects) dengan fitur Prepared Statements dan Parameter Binding.*
> *Ketika pengguna mengetikkan teks di kolom pencarian atau filter, nilainya diperlakukan murni sebagai string data literal, bukan sebagai instruksi SQL yang dieksekusi. Bahkan pada query agregasi grafik di `EmployeeEducationChart.php`, kami menggunakan parameter query yang terkontrol dan tidak menggabungkan variabel input langsung ke raw SQL."*

---

#### ❓ Pertanyaan 3: "Apa itu Filament dan kenapa Anda tidak membuat CRUD manual memakai Controller dan Blade tradisional?"
> **💡 Jawaban Cerdas:**
> *"Filament adalah framework TALL-stack terstandar industri untuk membangun panel administrasi yang cepat, konsisten, dan aman. Kami memilih Filament karena beberapa alasan profesional:*
> 1. *Mencegah pembuatan kode repetitif (*boilerplate code*) seperti pagination, sorting, dan filter yang rentan bug jika dibuat manual.*
> 2. *Tampilan antarmuka sudah mengikuti standar aksesibilitas dan desain modern yang responsif.*
> 3. *Keamanan form dan tabel terkelola secara otomatis oleh Livewire dengan perlindungan CSRF dan validasi server-side yang ketat.*
> 4. *Waktu pengembangan dapat dialokasikan sepenuhnya untuk menyempurnakan logika bisnis, visualisasi data, dan kebutuhan pengguna."*

---

#### ❓ Pertanyaan 4: "Bagaimana cara kerja grafik usia dalam mengelompokkan pegawai jika ada yang berulang tahun tepat hari ini?"
> **💡 Jawaban Cerdas:**
> *"Pada file `EmployeeAgeChart.php`, kita mengambil objek `tanggal_lahir` yang sudah di-cast menjadi objek `Carbon`. Method `$employee->tanggal_lahir->age` menghitung selisih tahun penuh antara tanggal lahir dengan waktu sistem saat ini (`Carbon::now()`).*
> *Jika pegawai lahir pada tanggal 15 November 2005 dan hari ini adalah 15 November 2026, Carbon secara presisi mengembalikan angka 21 tahun (bukan 20 tahun), sehingga pegawai tersebut langsung masuk ke bucket usia `20–29` tahun."*

---

#### ❓ Pertanyaan 5: "Mengapa Anda memisahkan file `EmployeeForm.php`, `EmployeesTable.php`, dan `EmployeeInfolist.php` daripada menyatukannya di `EmployeeResource.php`?"
> **💡 Jawaban Cerdas:**
> *"Kami menerapkan prinsip Single Responsibility Principle (SRP) dalam arsitektur perangkat lunak. Jika form, tabel, dan infolist disatukan dalam satu file `EmployeeResource.php`, file tersebut akan membengkak hingga ratusan baris kode (*God Object*) yang sulit dibaca dan dirawat.*
> *Dengan memisahkannya ke folder `Schemas/` dan `Tables/`, jika tim frontend ingin mengubah validasi input form, mereka cukup fokus pada `EmployeeForm.php` tanpa khawatir merusak logika tabel atau navigasi."*

---

#### ❓ Pertanyaan 6: "Di mana Anda menerapkan prinsip OOP Polymorphism dalam proyek ini?"
> **💡 Jawaban Cerdas:**
> *"Polimorfisme diterapkan melalui Method Overriding pada widget dan resource. Sebagai contoh, ketiga kelas grafik kita (`EmployeeGenderChart`, `EmployeeEducationChart`, dan `EmployeeAgeChart`) sama-sama mewarisi kelas induk `ChartWidget`.*
> *Namun masing-masing kelas anak menimpa (*override*) method `getType()` dengan hasil berbeda: grafik gender mengembalikan `'doughnut'`, sedangkan grafik pendidikan dan usia mengembalikan `'bar'`. Masing-masing kelas anak juga menimpa method `getData()` dengan logika dataset uniknya sendiri."*

---

#### ❓ Pertanyaan 7: "Bagaimana jika ada jenjang pendidikan yang belum memiliki pegawai sama sekali (misalnya tidak ada pegawai lulusan S3), apakah grafiknya akan error?"
> **💡 Jawaban Cerdas:**
> *"Tidak akan error. Di berkas `EmployeeEducationChart.php`, kami telah mengantisipasi kondisi tersebut dengan kode:*
> `(int) ($counts[$category] ?? 0)`
> *Sistem meloop seluruh array master pendidikan (`Employee::PENDIDIKAN_OPTIONS`). Jika suatu jenjang tidak ditemukan dalam hasil query database, sistem secara otomatis memberikan nilai default `0`. Sehingga jenjang tersebut tetap muncul di diagram batang dengan nilai nol dan tidak merusak visualisasi."*

---

#### ❓ Pertanyaan 8: "Bagaimana jika admin salah menekan tombol hapus, apa pengaman yang Anda pasang?"
> **💡 Jawaban Cerdas:**
> *"Kami memasang pengaman non-fungsional tingkat tinggi berupa konfirmasi modal bertingkat pada `DeleteAction`. Ketika tombol tong sampah atau teks 'Hapus' diklik, aksi penghapusan ditahan oleh sistem dan memunculkan pop-up modal peringatan berwarna merah.*
> *Modal tersebut menyebutkan secara spesifik nama pegawai yang akan dihapus agar admin sadar data siapa yang sedang dipilih. Jika admin menekan 'Batal' atau tombol Escape, event dibatalkan seketika dan data di database tetap utuh."*

---

#### ❓ Pertanyaan 9: "Mengapa Anda memilih tipe data `ENUM` untuk jenis kelamin dan pendidikan di file migration, bukan `VARCHAR`?"
> **💡 Jawaban Cerdas:**
> *"Tipe data `ENUM` memberikan integritas data di level mesin database (database-level integrity). Nilai jenis kelamin hanya boleh 'Laki-laki' atau 'Perempuan', dan pendidikan hanya boleh dari 'SD' sampai 'S3'.*
> *Jika menggunakan `VARCHAR`, ada risiko inkonsistensi penulisan data (misalnya ada yang menginput 'Pria', 'L', atau typo seperti 'S1/D4'). Selain itu, secara performa penyimpanan, `ENUM` di MySQL disimpan dalam representasi integer biner yang jauh lebih hemat memori dibanding string `VARCHAR`."*

---

#### ❓ Pertanyaan 10: "Apa fungsi file `CreateAdminCommand.php` jika Filament sudah punya perintah bawaan `php artisan make:filament-user`?"
> **💡 Jawaban Cerdas:**
> *"Perintah kustom `php artisan app:create-admin` kami buat untuk memenuhi spesifikasi alur kerja lokal dan kemudahan administrasi:*
> 1. *Antarmuka konsol interaktifnya menggunakan bahasa Indonesia yang ramah bagi staf TI lokal.*
> 2. *Mendukung passing argumen opsi CLI (`--name`, `--email`, `--password`) sehingga dapat diotomatisasi dalam skrip deployment tanpa prompt interaktif.*
> 3. *Memastikan field `email_verified_at` langsung terisi timestamp saat itu juga agar akun admin dapat langsung digunakan tanpa kendala verifikasi email."*

---

#### ❓ Pertanyaan 11: "Bagaimana Anda memastikan standar kode Anda rapi dan bebas dari kesalahan style?"
> **💡 Jawaban Cerdas:**
> *"Kami menggunakan alat bantu linter dan formatter kode resmi ekosistem Laravel yaitu **Laravel Pint**. Sebelum proyek difinalisasi, kami menjalankan perintah `vendor/bin/pint --format agent`.*
> *Laravel Pint secara otomatis memeriksa dan memperbaiki indentasi, penempatan kurung kurawal, urutan import namespace, dan struktur komentar PHPDoc agar konsisten 100% mematuhi standar PSR-12 dan panduan Laravel resmi."*

---

#### ❓ Pertanyaan 12: "Bagaimana jika ada pegawai yang tanggal lahirnya bernilai null atau kosong di database?"
> **💡 Jawaban Cerdas:**
> *"Pada tingkat database dan form, kolom `tanggal_lahir` diwajibkan (*required*). Namun untuk menerapkan prinsip Defensive Programming, kode kami di method `usia()` model `Employee.php` dan loop di `EmployeeAgeChart.php` memiliki pengecekan:*
> `if (! $this->tanggal_lahir) { return null; }`
> *Pada tabel dan detail pegawai, jika nilai usia bernilai null, sistem menampilkan tanda strip `'-'` secara anggun tanpa memicu fatal error 'Call to a member function on null'."*

---

## 🏆 KESIMPULAN AKHIR UNTUK PRESENTASI
Sistem Manajemen Data Pegawai ini bukan sekadar aplikasi CRUD sederhana, melainkan aplikasi web enterprise yang dirancang dengan:
1. **Keamanan Berlapis:** Proteksi CSRF, enkripsi sesi, bcrypt password, dan pencegahan SQL Injection via Eloquent.
2. **Kualitas Kode Industri:** Berorientasi Objek (OOP) murni, modular (SRP), bebas pengulangan (DRY), serta terdokumentasi lengkap dengan PHPDoc Bahasa Indonesia.
3. **Pengalaman Pengguna (UX) Unggul:** Antarmuka visual yang estetik, modal keselamatan kerja data, dan grafik analitik yang dinamis dan interaktif.

**Semoga sukses dalam ujian kompetensi Anda! Bicaralah dengan tenang, percaya diri, dan tersenyumlah! ✨**
