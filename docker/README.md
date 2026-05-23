# Docker for ekinerja (CodeIgniter 3 + PHP 7.3 + Apache + MariaDB)

Semua file Docker lainnya ditempatkan di folder ini. File `docker-compose.yml` dan `.env.example` sekarang berada di root proyek. Template diadaptasi dari `ci3-php7.3-apache`.

Langkah cepat:

1. Salin `../.env.example` menjadi `../.env` dan sesuaikan jika diperlukan.

2. Jalankan dari folder root proyek:

```bash
cd ..
docker compose up -d --build
```

3. Akses aplikasi di `http://localhost:8081`.

Catatan:

- Volume aplikasi memetakan `../` (root project `ekinerja`) ke `/var/www/html` di container.
- Jika ingin mengubah port atau nama container, edit `docker-compose.yml`.

Default container names:
- aplikasi: `ekinerja-ci`
- database: `ekinerja-ci-mariadb`
