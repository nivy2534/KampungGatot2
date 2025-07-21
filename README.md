# 🚀 Laravel + Docker + Vite Starter

Proyek ini menggunakan Laravel dengan stack modern berbasis **Docker** dan **Vite** untuk frontend development.

---

## 📦 Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- (Opsional) [Laravel Installer](https://laravel.com/docs/installation)

---

## 🛠️ Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/nama-proyek.git
cd nama-proyek
```

> Ganti `https://github.com/username/nama-proyek.git` dengan URL proyek Anda (jika sudah diupload).

---

### 2. Salin `.env`

```bash
cp .env.example .env
```

---

### 3. Setup Docker

Buat file `docker-compose.yml`:

```yaml
version: '3.8'

services:
  app:
    build:
      context: ./docker/php
    container_name: kampung_gatot
    volumes:
      - .:/var/www/html:cached
    depends_on:
      - mysql
    networks:
      - kampung_gatot
    mem_limit: 2g
    cpus: 3

  nginx:
    image: nginx:stable-alpine
    container_name: kampung_gatot_nginx
    ports:
      - "8888:80"
    volumes:
      - .:/var/www/html:cached
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    networks:
      - kampung_gatot
    mem_limit: 512m
    cpus: 0.5

  mysql:
    image: mysql:8.0
    container_name: kampung_gatot_mysql
    restart: unless-stopped
    environment:
        MYSQL_DATABASE: db_kampung_gatot
        MYSQL_USER: user
        MYSQL_PASSWORD: secret
        MYSQL_ROOT_PASSWORD: secret # Diperlukan untuk inisialisasi
    ports:
        - "3311:3306"
    volumes:
        - mysql-data:/var/lib/mysql
    networks:
        - kampung_gatot
    mem_limit: 2g
    cpus: 2



  redis:
    image: redis:7-alpine
    container_name: kampung_gatot_redis
    ports:
      - "6379:6379"
    networks:
      - kampung_gatot
    mem_limit: 512m
    cpus: 0.5

networks:
  kampung_gatot:
    driver: bridge

volumes:
  mysql-data:
```

---

### 4. Tambahkan konfigurasi NGINX

Buat folder `docker/nginx` dan file `default.conf`:

```nginx
server {
    listen 80;
    index index.php index.html;
    root /var/www/html/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

---

### 5. Jalankan Docker

```bash
docker-compose up -d
```

---

### 6. Masuk ke Container PHP

```bash
docker compose exec app bash
```

---

### 7. Compose Install

```bash
composer install
```

---

### 8. Generate App Key & Migrasi

```bash
php artisan key:generate
php artisan migrate
```

---

## ⚡ Install Frontend (Vite + Tailwind)

### 1. Masuk ke container Node

```bash
docker compose exec app bash
```

### 2. Install dependencies

```bash
npm install
```

> Jika belum ada `package.json`, jalankan:

```bash
npm init -y
npm install vite laravel-vite-plugin tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

### 3. Konfigurasi `vite.config.js`

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    server: {
        host: "127.0.0.1", // Paksa gunakan IPv4
        port: 5173,
    },
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
```

### 4. `resources/css/app.css`

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

---

## 🔁 Jalankan Vite

```bash
npm run dev
```

> Gunakan `npm run build` saat production.

---

## 🌐 Akses Website

- Laravel: <http://localhost:8888>
- PHP: port `9000`
- MySQL: port `3311`

---

## 🧽 Troubleshooting

- Jika container tidak jalan: `docker-compose down -v && docker-compose up -d`
- Cek log: `docker-compose logs -f`
- Permission error? Jalankan `chmod -R 775 storage bootstrap/cache`

---

## ✅ Selesai

Anda sudah berhasil menjalankan Laravel dengan Docker dan Vite. 🎉
