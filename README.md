Tools:
Tailwind CSS
MySQL
Midtrans
Ngrok (untuk callback Midtrans 'ngrok http 8000')
Laragon

Akses Login:

ADMIN
URL: `/admin/login`
Email: `admin@digitalzone.com`
Password: `password`

Harus logout terlebih dahulu dari akun lain sebelum login sebagai admin

PETUGAS
URL: `/petugas/login`
Harus logout terlebih dahulu dari akun lain sebelum login sebagai petugas.

ALUR PEMBAYARAN
Setelah checkout, pengguna memiliki waktu 10 menit untuk melakukan pembayaran jika snap midtrans ke close.
Jika pembayaran tidak dilakukan, pesanan akan otomatis dibatalkan.
Stok produk akan dikembalikan secara otomatis jika pesanan gagal atau expired.

Import database ddari file digital_zone.sql