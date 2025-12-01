# 📖 Buku C Digital – Pure Data Version (Static PHP)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TCPDF](https://img.shields.io/badge/TCPDF-PDF_Generation-red?style=for-the-badge)
![JSON](https://img.shields.io/badge/JSON-Data_Storage-green?style=for-the-badge)

## 📋 Deskripsi Proyek

**Buku C Digital** adalah aplikasi web sederhana untuk mengelola data tanah (land records) tanpa menggunakan database. Aplikasi ini dibangun dengan **100% PHP Native** dan menggunakan file **JSON** untuk penyimpanan data.

### ✨ Fitur Utama

- ✅ **CRUD Operations** - Create, Read, Update, Delete data tanah
- 🔍 **Search Functionality** - Pencarian data berdasarkan nomor persil, nama pemilik, atau peta blok
- 👁️ **Detail View** - Menampilkan informasi lengkap data tanah
- 🖨️ **Print to PDF** - Generate PDF menggunakan TCPDF
- 💾 **JSON Storage** - Penyimpanan data menggunakan file JSON dengan file locking
- 🎨 **Responsive Design** - Tampilan HTML + CSS yang responsif
- 🚫 **No JavaScript** - Aplikasi 100% server-side

## 🛠️ Teknologi yang Digunakan

- **PHP 7.4+** - Bahasa pemrograman utama
- **TCPDF** - Library untuk generate PDF
- **JSON** - Format penyimpanan data
- **HTML5 & CSS3** - Frontend sederhana
- **Composer** - Dependency management (untuk TCPDF)

## 📁 Struktur Folder

```
ss-land-records/
├── public/
│   ├── index.php          # Halaman utama (list & search)
│   ├── create.php         # Form tambah data
│   ├── edit.php           # Form edit data
│   ├── detail.php         # Detail data tanah
│   ├── delete.php         # Handler hapus data
│   ├── print.php          # Generate PDF dengan TCPDF
│   └── assets/
│       └── css/
│           └── style.css  # Styling aplikasi
├── libs/
│   └── helpers.php        # Fungsi-fungsi helper
├── data/
│   └── lands.json         # File penyimpanan data JSON
├── vendor/                # Dependencies (TCPDF)
├── composer.json          # Composer configuration
└── README.md              # Dokumentasi ini
```

## 🚀 Cara Instalasi

### Prasyarat

- PHP 7.4 atau lebih tinggi
- Composer (untuk install TCPDF)
- Web server (Apache/Nginx) atau PHP built-in server
- Extension PHP: json, mbstring, gd (untuk TCPDF)

### Langkah Instalasi

1. **Clone atau Download Project**
   ```bash
   git clone <repository-url>
   cd ss-land-records
   ```

2. **Install Dependencies dengan Composer**
   ```bash
   composer install
   ```
   
   Atau jika belum ada composer.json:
   ```bash
   composer require tecnickcom/tcpdf
   ```

3. **Set Permissions untuk Folder Data**
   ```bash
   chmod 755 data/
   chmod 666 data/lands.json
   ```

4. **Jalankan Aplikasi**
   
   **Menggunakan PHP Built-in Server:**
   ```bash
   cd public
   php -S localhost:8000
   ```
   
   **Menggunakan XAMPP:**
   - Copy folder project ke `htdocs/`
   - Akses via browser: `http://localhost/ss-land-records/public/`

5. **Akses Aplikasi**
   
   Buka browser dan akses:
   ```
   http://localhost:8000
   ```
   atau
   ```
   http://localhost/ss-land-records/public/
   ```

## 📊 Format Data JSON

File `data/lands.json` menyimpan data dengan struktur berikut:

```json
[
  {
    "id": "land-674c5e8a1b2c3",
    "persil_number": "123/45",
    "owner_name": "Budi Santoso",
    "owner_address": "Jl. Merdeka No. 10, Jakarta Pusat",
    "land_type": "tanah_kering",
    "luas_m2": 300,
    "peta_blok": "A01",
    "notes": "Tanah berbatasan dengan jalan raya",
    "created_at": "2025-01-01 10:00:00",
    "updated_at": "2025-01-01 10:00:00"
  }
]
```

### Field Explanation

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | ID unik (auto-generated) |
| `persil_number` | string | Nomor persil tanah |
| `owner_name` | string | Nama pemilik tanah |
| `owner_address` | string | Alamat pemilik |
| `land_type` | string | Jenis tanah (`tanah_kering` atau `tanah_basah`) |
| `luas_m2` | float | Luas tanah dalam meter persegi |
| `peta_blok` | string | Kode blok peta |
| `notes` | string | Catatan tambahan (optional) |
| `created_at` | string | Timestamp pembuatan data |
| `updated_at` | string | Timestamp perubahan terakhir |

## 📚 Fitur Detail

### 1. Index Page (`index.php`)
- Menampilkan semua data tanah dalam tabel
- Fitur pencarian dengan GET parameter `?q=`
- Tombol aksi: Detail, Edit, Print, Delete
- Menampilkan pesan sukses/error setelah operasi CRUD

### 2. Create Page (`create.php`)
- Form input untuk menambah data tanah baru
- Validasi input server-side
- Generate ID otomatis
- Redirect ke index setelah berhasil

### 3. Edit Page (`edit.php`)
- Load data existing berdasarkan ID
- Form pre-filled dengan data lama
- Update timestamp `updated_at`
- Validasi input

### 4. Detail Page (`detail.php`)
- Menampilkan semua informasi data tanah
- Format tabel yang rapi
- Tombol aksi: Back, Edit, Print, Delete

### 5. Delete Handler (`delete.php`)
- Menghapus data berdasarkan ID
- Konfirmasi JavaScript sebelum hapus
- Redirect dengan pesan status

### 6. Print to PDF (`print.php`)
- Generate PDF menggunakan TCPDF
- Format professional 1 halaman
- Header dengan judul
- Informasi lengkap data tanah
- Footer dengan informasi sistem
- Download otomatis atau preview di browser

## 🔧 Fungsi Helper (`libs/helpers.php`)

| Function | Description |
|----------|-------------|
| `loadData()` | Membaca data dari JSON file |
| `saveData($data)` | Menyimpan data ke JSON dengan file locking |
| `findById($id)` | Mencari data berdasarkan ID |
| `generateId()` | Generate unique ID |
| `deleteById($id)` | Menghapus data berdasarkan ID |
| `updateById($id, $data)` | Update data berdasarkan ID |
| `addData($data)` | Menambah data baru |
| `searchLands($query)` | Pencarian data tanah |
| `sanitize($input)` | Sanitize input user |
| `getLandTypeLabel($type)` | Convert tipe tanah ke label |

## 🎨 Styling (CSS)

- Desain responsif untuk mobile dan desktop
- Warna tema hijau untuk tombol primary
- Tabel dengan hover effect
- Form styling yang clean
- Message box untuk feedback user
- Button styles dengan warna semantik

## 🔒 Keamanan

- **Input Sanitization** - Semua input user di-sanitize
- **File Locking** - Menggunakan `flock()` untuk mencegah race condition
- **No SQL Injection** - Tidak menggunakan database
- **XSS Prevention** - Menggunakan `htmlspecialchars()`
- **Type Validation** - Validasi tipe data input

## 📝 Contoh Penggunaan

### Menambah Data Baru
1. Klik tombol "➕ Tambah Data Baru"
2. Isi form dengan data tanah
3. Klik "💾 Simpan Data"
4. Data akan tersimpan di `lands.json`

### Mencari Data
1. Ketik keyword di search box
2. Klik "🔍 Cari"
3. Sistem akan mencari di: nomor persil, nama pemilik, peta blok

### Generate PDF
1. Klik tombol "🖨 Print" pada data yang ingin dicetak
2. PDF akan dibuka di tab baru
3. Download atau print langsung dari browser

## 🐛 Troubleshooting

### Error: "Failed to open stream"
**Solusi:** Pastikan folder `data/` memiliki permission write (755)

### PDF tidak generate
**Solusi:** Pastikan TCPDF sudah terinstall:
```bash
composer require tecnickcom/tcpdf
```

### Data tidak tersimpan
**Solusi:** 
- Cek permission file `lands.json` (666)
- Pastikan folder `data/` bisa di-write

### CSS tidak load
**Solusi:** Pastikan path CSS benar dan folder `public/assets/css/` ada

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan final project.

## 👨‍💻 Developer

Dikembangkan dengan ❤️ menggunakan Pure PHP

## 📞 Support

Jika ada pertanyaan atau issue, silakan buat issue di repository ini.

---

**© 2025 Buku C Digital - Pure PHP Application**
