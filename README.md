# Aplikasi Penggajian Karyawan

Aplikasi penggajian karyawan digunakan untuk mengelola data karyawan, mencatat kehadiran (absensi), menghitung gaji, hingga membuat laporan penggajian. Aplikasi ini dibuat agar proses administrasi gaji lebih mudah, rapi, dan terpusat dalam satu sistem.

---

## Fitur Utama

Aplikasi ini memiliki beberapa menu utama, yaitu:

### 1. Login
- Pengguna harus masuk (login) menggunakan akun yang sudah terdaftar sebelum dapat mengakses sistem.
- Terdapat menu **Lupa Password** untuk memulihkan akun yang lupa kata sandinya.

### 2. Dashboard
Halaman utama setelah login yang menampilkan ringkasan informasi secara cepat, antara lain:
- **Total Karyawan** – jumlah seluruh karyawan yang terdaftar.
- **Total Absensi** – jumlah catatan kehadiran yang sudah diinput.
- **Total Pengeluaran Gaji** – jumlah total gaji yang sudah dibayarkan kepada seluruh karyawan.
- **Grafik Pengeluaran Gaji Per Bulan** – grafik yang menunjukkan besaran pengeluaran gaji setiap bulan pada tahun berjalan.

### 3. Menu Karyawan
Menu untuk mengelola data karyawan:
- **Menambah** data karyawan baru.
- **Melihat** daftar seluruh karyawan (nama, email, alamat, telepon, dan jabatan).
- **Mengubah (edit)** data karyawan jika ada perbaikan atau perubahan.
- **Menghapus** data karyawan.

### 4. Menu Absensi
Menu untuk mencatat kehadiran karyawan setiap minggu:
- **Input Absensi** – mencatat status kehadiran setiap hari (Senin s.d. Sabtu) dengan pilihan status: **Hadir, Izin, Sakit, atau Alpa**. Hari Minggu otomatis libur.
- **Edit Absensi** – mengubah catatan kehadiran pada minggu tertentu.
- **Hapus Absensi** – menghapus catatan kehadiran dalam satu minggu.
- **Export Excel** – mengunduh data absensi ke dalam format Excel.

### 5. Menu Gaji
Menu untuk mengelola penggajian karyawan:
- **Menambah Gaji** – memasukkan data gaji karyawan yang terdiri dari:
  - **Gaji Pokok** – gaji dasar karyawan.
  - **Potongan** – nilai potongan (jika ada).
  - **Lembur** – upah lembur karyawan.
  - **Tanggal Gaji** – tanggal pembayaran gaji.
  - **Total Gaji** dihitung otomatis dengan rumus: `Gaji Pokok - Potongan + Lembur`.
- **Mengubah Gaji** – memperbaiki data gaji jika diperlukan.
- **Menghapus Gaji** – menghapus data gaji yang tidak diperlukan.
- **Cetak Slip Gaji** – mencetak slip gaji per karyawan.
- **Cetak Semua Slip** – mencetak slip gaji seluruh karyawan sekaligus.

### 6. Menu Laporan
Menu untuk melihat laporan penggajian:
- Tabel menampilkan **Total Gaji** setiap karyawan yang telah digaji.
- Dilengkapi **filter periode** (pilih bulan dan tahun) sehingga laporan dapat dilihat per bulan.
- Di bawah tabel terdapat **Ringkasan Arus Kas Keluar** untuk periode terpilih, yang menampilkan:
  - **Total Gaji Bersih Karyawan** – jumlah seluruh total gaji bersih karyawan pada periode tersebut.
  - **Jumlah Karyawan** – jumlah karyawan yang menerima gaji pada periode tersebut.

### 7. Profil & Logout
- **Profil** – melihat dan memperbarui informasi akun pengguna.
- **Logout** – keluar dari sistem dengan aman.

---

## Panduan Penggunaan Singkat

1. **Login** menggunakan akun yang sudah terdaftar.
2. Mulai dari menu **Karyawan** untuk mendaftarkan data karyawan.
3. Catat kehadiran melalui menu **Absensi** setiap minggu.
4. Masukkan data gaji karyawan melalui menu **Gaji** (total gaji terhitung otomatis).
5. Pantau pengeluaran gaji pada **Dashboard**.
6. Lihat rekap dan ringkasan penggajian pada menu **Laporan** sesuai periode yang diinginkan.
7. Cetak slip gaji per karyawan atau seluruh karyawan melalui menu **Gaji**.
