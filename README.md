KOPERASI MANTAP --KOPMA

Aplikasi koperasi berbasis web dengan menggunakan laravel versi 9 dan admin LTE

# Tahap Install
---
1.  Copy file .env.example menjadi .env dengan menjalankan perintah
`cp .env.example .env`

2.  Jalankan perintah untuk men-generate key app laravel
`php artisan key:generate`

3.  Buat database baru (jika sudah, abaikan). Buka file .env, lakukan konfigurasi pada bagian database mysql, biarkan saja bagian APP_ENV tetap local dan APP_DEBUG tetap true untuk tahap development

4.  Jalankan perintah untuk mendownload seluruh dependencies yang terdapat di dalam file composer.json
`composer install`
atau
`composer update`

5.  Jalankan perintah dibawah untuk melakukan migrasi database (Semua data akan dihapus dan akan diisi ulang oleh seeder yang telah dibuat)
`php artisan migrate:fresh --seed`

6.  Jalankan perintah untuk run app laravel
`php artisan serve`
