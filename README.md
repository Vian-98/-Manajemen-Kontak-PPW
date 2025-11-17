# 📒 FR Hub - Contact Manager

![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Session Storage](https://img.shields.io/badge/Storage-Session-orange?style=for-the-badge)

**FR Hub** adalah aplikasi manajemen kontak berbasis web yang ringan dan estetis. Dibangun dengan **PHP Native** dan **Tailwind CSS**, aplikasi ini mendemonstrasikan pengelolaan data sementara menggunakan *PHP Session* tanpa memerlukan database eksternal.

Cocok untuk tugas kuliah atau referensi belajar logika dasar CRUD (Create, Read, Update, Delete).

---

## ✨ Fitur Unggulan

Aplikasi ini dirancang sesuai spesifikasi teknis dengan sentuhan UI modern:

### 1. 🔐 Autentikasi User (Login Session)
Sistem keamanan sederhana menggunakan session. Halaman dashboard dan manajemen kontak **terkunci** dan tidak dapat diakses tanpa login.
- **Fitur**: Redirect otomatis jika belum login.
- **Validasi**: Cek username & password hardcoded.

### 2. 📝 Manajemen Kontak (CRUD)
Pengelolaan data kontak yang lengkap disimpan dalam memori browser (Session).
- **Tambah Kontak**: Form dengan validasi server-side (Nama wajib, Telepon harus angka, Email format valid).
- **Edit Kontak**: Ubah detail nama, telepon, email, atau status favorit.
- **Hapus Kontak**: Menghapus data kontak dari list.

### 3. ⭐ Fitur Favorit & UI Interaktif
- **Prioritas Kontak**: Kontak yang ditandai sebagai "Favorit" akan muncul di bagian paling atas dengan *highlight* khusus.
- **Glassmorphism Design**: Tampilan antarmuka modern dengan efek kaca (*blur*) menggunakan Tailwind CSS.
- **Interactive Feedback**: Pesan error saat login salah atau input tidak valid.

---

## 📸 Galeri Tampilan

Berikut adalah tampilan antarmuka aplikasi FR Hub yang telah dikembangkan:

### 1. Halaman Login
Halaman keamanan awal. Pengguna harus login menggunakan kredensial yang benar untuk mengakses dashboard.

![Halaman Login](https://github.com/user-attachments/assets/5517da60-ce0d-452a-b9f7-aa1f6958e2ef)
*Tampilan login simple dengan validasi session.*

### 2. Dashboard Utama (Data Kosong)
Tampilan awal ketika belum ada data kontak yang dimasukkan. Terdapat banner iklan interaktif (dummy) yang bisa ditutup.

![Dashboard Kosong](https://github.com/user-attachments/assets/bc9d698b-30fb-44f5-aab9-b41e0d5bd1fb)
*State kosong (empty state) yang ramah pengguna.*

### 3. Form Tambah Kontak
Formulir untuk memasukkan data kontak baru. Dilengkapi validasi input (nama wajib, telepon angka, format email).

![Form Tambah Kontak](https://github.com/user-attachments/assets/95f37147-ac34-45c8-b454-7e0348cf7a76)
*Input data kontak baru dengan opsi 'Jadikan Favorit'.*

### 4. Dashboard (Data Terisi)
Daftar kontak yang telah disimpan. Kontak dibagi menjadi kategori "Favorit" (bintang kuning) dan "Semua Kontak".

![Dashboard Terisi](https://github.com/user-attachments/assets/f49de67f-eba6-4ae8-b690-8fc5b3fc386d)
*Manajemen list kontak.*

### 5. Form Edit Kontak
Fitur untuk mengubah detail kontak yang sudah ada. Data lama akan otomatis terisi di dalam form (pre-filled).

![Form Edit Kontak](https://github.com/user-attachments/assets/f056a06e-6f91-4a79-b842-672c3b0ffa2a)
*Halaman update data dengan data sebelumnya otomatis terisi.*

---

<div align="center">
  <h3>🎥 Demo Aplikasi</h3>
  <video src="https://github.com/user-attachments/assets/3f2b84c4-971f-4150-a5de-0bfb169f4c7e" width="100%" controls autoplay muted>
    Browser kamu tidak mendukung tag video.
  </video>
  <p align="center">
    <i>
      Tampilan interaktif FR Hub: Login, Tambah Kontak, dan Dashboard.<br>
      <b>Fitur Unik:</b> Perhatikan <b>Banner Iklan</b> yang bisa ditutup (tombol X) dan <b>Logo FR Hub</b> di pojok kiri atas yang berfungsi sebagai tombol Logout rahasia.
    </i>
  </p>
</div>

---

## 📂 Struktur File & Fungsi

Berikut adalah penjelasan singkat mengenai peran setiap file dalam proyek ini:

| Nama File | Deskripsi & Fungsi |
| :--- | :--- |
| `index.php` | **Gerbang Masuk**. Menangani form login dan inisialisasi session. |
| `dashboard.php` | **Halaman Utama**. Menampilkan daftar kontak (dipisah antara Favorit & Biasa). |
| `tambah.php` | **Form Input**. Menangani logika penambahan data baru ke array session. |
| `edit.php` | **Form Edit**. Mengubah data kontak yang sudah ada berdasarkan index array. |
| `hapus.php` | **Logika Hapus**. Menghapus item dari array session dan redirect kembali. |
| `toggle_favorit.php` | **Switch**. Mengubah status `true/false` pada atribut favorit kontak. |
| `logout.php` | **Keluar**. Menghancurkan session (`session_destroy`) dan melempar user ke login. |

---

## 🚀 Cara Menjalankan (Instalasi)

Karena aplikasi ini **tidak menggunakan database MySQL**, kamu bisa menjalankannya langsung hanya dengan PHP.

### Prasyarat
Pastikan komputer kamu sudah terinstall **PHP**.

### Langkah-langkah
1.  **Download/Clone** repository ini.
2.  Buka terminal/CMD dan arahkan ke folder proyek.
3.  Jalankan *built-in server* PHP dengan perintah:
    ```bash
    php -S localhost:8000
    ```
4.  Buka browser dan akses: `http://localhost:8000`

---

## 🔑 Akun Demo

Gunakan kredensial berikut untuk masuk ke aplikasi:

| Username | Password |
| :--- | :--- |
| `favian` | `favian` |

> **Catatan:** Data kontak bersifat **SEMENTARA**. Karena menggunakan `$_SESSION`, jika kamu Logout atau menutup browser sepenuhnya, data kontak akan mereset (hilang).

---

## 👨‍💻 Author

Dibuat untuk memenuhi tugas Manajemen Kontak PPW.
* **Logic**: PHP Native (Array & Session Manipulation)
* **Styling**: Tailwind CSS (CDN)
