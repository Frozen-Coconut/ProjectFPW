# Software Development Project

## Konfigurasi (Windows)
- Clone repository dari [https://github.com/Frozen-Coconut/ProjectFPW](https://github.com/Frozen-Coconut/ProjectFPW)
- Buka folder repository yang sudah diclone dengan cmd
- Jalankan perintah tersebut: `composer install` untuk menginstall dependencies yang diperlukan
- Jalankan perintah tersebut: `copy .env.example .env` untuk membuat file .env
- Buka file .env dan hapus code di bawah ini
```ini
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
- Tambahkan code di bawah ini di bagian paling bawah file .env
```ini
MAIL_MAILER=smtp
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=liantoleonard703@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

MIDTRANS_IS_PRODUCTION=false
MIDTRANS_MERCHANT_ID=G231324727
MIDTRANS_CLIENT_KEY=SB-Mid-client-kfxIXT-JQg4B6pvZ
MIDTRANS_SERVER_KEY=SB-Mid-server-9U6RzSWl0Qug_Vt7bMfxYtdf
```
- Jalankan perintah tersebut: `php artisan key:generate` untuk mengenerate app key
- Jalankan server untuk database mysql, dapat menggunakan XAMPP
- Jalankan perintah `php artisan migrate` untuk membuat database dan table yang diperlukan
- Jalankan perintah `php artisan db:seed` untuk mengisi database dengan data dummy untuk testing
- Jalankan perintah tersebut: `php artisan serve`

## Daftar Email dan Password User Dummy (Username:Password)
### Admin
- administrator@example.com:rotartsinimda
- anotheradministrator@example.com:rotartsinimdarehtona
### User
- user1@example.com:user1
- user2@example.com:user2
- user3@example.com:user3
- user4@example.com:user4
- user5@example.com:user5
- user6@example.com:user6
- user7@example.com:user7
- user8@example.com:user8
- user9@example.com:user9
- user10@example.com:user10
