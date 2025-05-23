# 📦 Projecte Laravel amb Sanctum, Breeze, MySQL i phpMyAdmin

Aquest projecte utilitza Laravel com a framework backend i frontend amb **Laravel Sanctum** per a l'autenticació basada en tokens i **Laravel Breeze** com a starter kit d'autenticació. La base de dades és MySQL i es pot gestionar fàcilment mitjançant **phpMyAdmin**. Tot s'executa en un entorn local.

## ✅ Requisits previs

Assegura't de tenir instal·lats els següents programes:

- [PHP >= 8.2](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js i npm](https://nodejs.org/)
- [MySQL o MariaDB](https://www.mysql.com/)
- [phpMyAdmin](https://www.phpmyadmin.net/)

## 🚀 Instal·lació

1. **Clona el repositori**
   
   git clone https://github.com/IvanGonVallbona/ProyectoM12.git
   cd ProyectoM12
   
2. **Instal·la les dependències de PHP**
   composer install
   
4. **Instal·la les dependències de Node.js**
   npm install && npm run build

5. **Copia el fitxer d'entorn i configura'l**
   cp .env.example .env
   
   Modifica les següents variables per connectar amb la teva base de dades MySQL:

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=nom_de_la_base_de_dades
  DB_USERNAME=usuari
  DB_PASSWORD=contrasenya

  6.**Genera la clau de l'aplicació**
  php artisan key:generate

7.**Executa les migracions i seeders**

php artisan migrate --seed

8.**Serveix l’aplicació en local**

php artisan serve

El projecte estarà disponible normalment a http://localhost:8000.
