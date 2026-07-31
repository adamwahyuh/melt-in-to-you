# 🍨 Melt In To You

Melt In To You merupakan aplikasi pemesanan es krim berbasis web yang dibangun menggunakan Laravel. Aplikasi ini menyediakan sistem pemesanan online bagi pelanggan sekaligus dashboard operasional untuk Owner, Kasir, dan Stocker sehingga seluruh proses bisnis mulai dari pengelolaan produk hingga laporan penjualan dapat dilakukan dalam satu sistem.

---
# Install
Clone repository

```bash
git clone https://github.com/adamwahyuh/melt-in-to-you.git
cd melt-in-to-you
```


Izinkan Script install
```bash
chmod +x install.sh
```

Jalankan install
```bash
./install.sh
```
---
# Informasi akun Demo 

### Semua privilages
- username = adam
- password = adam

### User Biasa
- username = vera
- password = vera
---
# 📖 Daftar Isi

- Tentang Aplikasi
- Fitur
- Teknologi
- Role Pengguna
- Alur Kerja
- Instalasi
- Struktur Project

---

# 📌 Tentang Aplikasi

Melt In To You merupakan sistem informasi pemesanan es krim yang memiliki empat jenis pengguna, yaitu:

- Pelanggan
- Kasir
- Stocker
- Owner

Setiap pengguna memiliki hak akses yang berbeda sehingga keamanan dan operasional aplikasi lebih terstruktur menggunakan sistem Role Based Access Control (RBAC). :contentReference[oaicite:1]{index=1}

---

# ✨ Fitur

## 👤 Autentikasi

- Login
- Register
- Logout
- Validasi Form
- Redirect berdasarkan role
- Redirect apabila pelanggan belum memiliki alamat

---

## 🏠 Manajemen Alamat

Pelanggan dapat:

- Menambahkan alamat
- Mengubah alamat
- Menghapus alamat
- Mengatur alamat utama

---

## 🍦 Produk

Pelanggan dapat:

- Melihat daftar produk
- Melihat harga terbaru
- Melihat foto produk
- Melihat deskripsi produk

Stocker dapat:

- Menambah produk
- Mengubah produk
- Mengubah harga produk
- Menghapus produk

---

## 🛒 Cup (Keranjang)

Pelanggan dapat:

- Menambahkan produk ke Cup
- Menambah jumlah produk
- Mengurangi jumlah produk
- Menghapus produk dari Cup
- Melihat total harga Cup

---

## 📦 Order

Pelanggan dapat:

- Checkout Cup
- Membuat pesanan
- Melihat riwayat pesanan
- Melihat detail pesanan
- Menandai pesanan telah diterima

Kasir dapat:

- Melihat seluruh pesanan
- Menandai pesanan sedang diproses
- Menandai pesanan sedang dikirim

---

## 📊 Dashboard

### Dashboard Kasir

Menampilkan:

- Seluruh pesanan
- Pesanan hari ini
- Pendapatan hari ini
- Jumlah pelanggan hari ini

### Dashboard Owner

Menampilkan laporan:

- Total penjualan
- Total produk terjual
- Total pelanggan
- Filter harian
- Filter mingguan
- Filter bulanan

---

# 👥 Role Pengguna

## 1. Pelanggan

Hak akses:

- Registrasi akun
- Login
- Mengelola alamat
- Melihat produk
- Menambahkan produk ke Cup
- Checkout
- Melihat riwayat pesanan
- Menyelesaikan pesanan

---

## 2. Stocker

Hak akses:

- Melihat produk
- Menambah produk
- Mengubah produk
- Mengubah harga
- Menghapus produk

---

## 3. Kasir

Hak akses:

- Melihat seluruh order
- Mengubah status order
- Melihat statistik harian

---

## 4. Owner

Hak akses:

- Melihat laporan penjualan
- Melihat total pendapatan
- Melihat jumlah pembeli
- Melihat produk terjual
- Filter laporan berdasarkan periode

---

#  Alur Kerja Sistem

## Pelanggan

```text
Register
    │
    ▼
Login
    │
    ▼
Tambah Alamat
    │
    ▼
Pilih Produk
    │
    ▼
Masukkan ke Cup
    │
    ▼
Checkout
    │
    ▼
Order Dibuat
    │
    ▼
Kasir Memproses
    │
    ▼
Kasir Mengirim
    │
    ▼
Pesanan Diterima
    │
    ▼
Selesai
```

---

## Stocker

```text
Login
   │
   ▼
Dashboard
   │
   ├── Tambah Produk
   ├── Edit Produk
   ├── Update Harga
   └── Hapus Produk
```

---

## Kasir

```text
Login
   │
   ▼
Dashboard
   │
   ▼
Melihat Order
   │
   ▼
Diproses
   │
   ▼
Dikirim
   │
   ▼
Menunggu Konfirmasi Pelanggan
```

---

## Owner

```text
Login
   │
   ▼
Dashboard
   │
   ▼
Laporan Penjualan
   │
   ├── Harian
   ├── Mingguan
   ├── Bulanan
   ├── Total Penjualan
   ├── Total Pembeli
   └── Total Produk Terjual
```

---

# Kelompok

1. Adam : Ngoding Aplikasi 
2. Ken : Membuat Dokumentasi, 
3. Aristo : Membuat Dokumentasi