# 📖 Buku C Digital – Pure Data Version (Static PHP)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JSON](https://img.shields.io/badge/JSON-Data_Storage-green?style=for-the-badge)

## 📋 Deskripsi Proyek

**Buku C Digital** adalah aplikasi web sederhana untuk mengelola data tanah (land records) tanpa menggunakan database. Aplikasi ini dibangun dengan **100% PHP Native** dan menggunakan file **JSON** untuk penyimpanan data. Sebagai Tugas Akhir praktikum Pemgrograman Dasar

### ✨ Fitur Utama

- ✅ **CRUD Operations** - Create, Read, Update, Delete data tanah
- 🔍 **Search Functionality** - Pencarian data berdasarkan nomor persil, nama pemilik, atau peta blok
- 👁️ **Detail View** - Menampilkan informasi lengkap data tanah
- 💾 **JSON Storage** - Penyimpanan data menggunakan file JSON dengan file locking
- 🎨 **Responsive Design** - Tampilan HTML + CSS yang responsif
- 🚫 **No JavaScript** - Aplikasi 100% server-side

## 🛠️ Teknologi yang Digunakan

- **PHP 7.4+** - Bahasa pemrograman utama
- **JSON** - Format penyimpanan data
- **HTML5 & CSS3** - Frontend sederhana

## 📁 Struktur Folder

```
ss-land-records/
├── public/
│   ├── index.php          # Halaman utama (list & search)
│   ├── create.php         # Form tambah data
│   ├── edit.php           # Form edit data
│   ├── detail.php         # Detail data tanah
│   ├── delete.php         # Handler hapus data
│   └── assets/
│       └── css/
│           └── style.css  # Styling aplikasi
├── libs/
│   └── helpers.php        # Fungsi-fungsi helper
├── data/
│   └── lands.json         # File penyimpanan data JSON
└── README.md              # Dokumentasi ini
```

## 🚀 Cara Instalasi

### Prasyarat

- PHP 7.4 atau lebih tinggi
- Composer (untuk install TCPDF)
- Web server (Apache/Nginx) atau PHP built-in server
- Extension PHP: json, mbstring

### Langkah Instalasi

1. **Clone atau Download Project**
   ```bash
   git clone <repository-url> ss-land-records
   cd ss-land-records
   ```


2. **Set Permissions untuk Folder Data**
   ```bash
   chmod 755 data/
   chmod 666 data/lands.json
   ```

3. **Jalankan Aplikasi**
   
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


### Penjelasan Detail Kode

The application has been refactored to use Object-Oriented Programming (OOP) principles. The following classes are introduced:

#### `Land`
- Represents a single land record.
- Provides getter and setter methods for encapsulated properties.

#### `LandRepository`
- Handles data operations such as loading, saving, searching, and deleting land records.
- Ensures data integrity and simplifies CRUD operations.

### Updated File Descriptions

#### `create.php`
- Uses `Land` and `LandRepository` to validate and save new land records.

#### `edit.php`
- Loads existing data using `LandRepository`.
- Updates data through `Land` object methods.

#### `detail.php`
- Displays detailed information using `Land` getter methods.

#### `index.php`
- Lists all land records using `LandRepository`.
- Supports search functionality.

#### `delete.php`
- Deletes a land record using `LandRepository` methods.

---

**© 2025 Buku C Digital - Pure PHP Application**
