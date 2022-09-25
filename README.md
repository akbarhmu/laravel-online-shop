<p align="center"><a href="https://github.com/akbarhmu/laravel-online-shop" target="_blank"><img src="https://raw.githubusercontent.com/akbarhmu/laravel-online-shop/main/public/images/logo/logo.png?token=AQJC6VFPPAKHRZPVBWVM3B3AXBDJU" width="50"></a></p>

<p align="center">
<b>Simple Online Store Website Built With Laravel</b>
</p>

Simple online store website built with laravel. The purpose of this projects is for fulfill the final project of web programming. This was our first production app, so it contains a lot of inefficient algorithms such as repeating the code, also we messed up with conventional commits messages.

Beside Laravel, this project uses other tools like:
- [Jetstrap (Jetstream+Bootstrap)](https://github.com/nascent-africa/jetstrap)
- [Bootstrap 4](https://getbootstrap.com/)
- [Font Awesome](http://fontawesome.io/)
- [Stisla Admin Template](https://github.com/stisla/stisla)
- [kavist/rajaongkir](https://github.com/kavist/rajaongkir)
- [Intervention/image](https://github.com/Intervention/image)
- [Scyllaly/hcaptcha](https://github.com/Scyllaly/hcaptcha)

This project is inspired from [fikrisuheri/laravel-toko-online](https://github.com/fikrisuheri/laravel-toko-online)

## Features
- Integration with RajaOngkir
- Integration with BinderByte shipping tracker api

## Requirement

-   Composer
-   Node.js
-   PHP 7.3 or later (with [enabled gd library](https://write.corbpie.com/how-to-enable-gd-library-with-xampp-php-8-on-windows/))
-   MySQL 5.7 or later

## Installation

```
git clone https://github.com/akbarhmu/laravel-online-shop.git
cd laravel-online-shop
cp .env.example .env
```

Open `.env`, change `DB_DATABASE` according to your needs, then create a database with that name.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=electroparadizo
DB_USERNAME=root
DB_PASSWORD=
```
Change `RAJAONGKIR_API_KEY` with apikey that you can obtain them from [here](https://rajaongkir.com/akun/panel). Make sure RAJAONGKIR_PACKAGE is starter, because we didn't support PRO package at the moment. This API is used for calculating the shipping cost.
```
RAJAONGKIR_API_KEY=
RAJAONGKIR_PACKAGE=starter
```
Change `BINDERBYTE_API_KEY` with apikey that you can obtain them from [here](https://dashboard.binderbyte.com/profile), this  used for shipping tracking.
```
BINDERBYTE_API_KEY=
```
Change `HCAPTCHA` secret and sitekey, you can obtain them from [here](https://dashboard.hcaptcha.com/sites). This used for captcha validation at service menu.
```
HCAPTCHA_SECRET=
HCAPTCHA_SITEKEY=
```
Install required dependency and rebuild asset : 
```
composer install
npm install
npm run dev
```
Generate application key :
```
php artisan key:generate
```
Run the migrations with the seeds, this need internet connection :
```
php artisan migrate:fresh --seed
```
Create storage symbolic link :
```
php artisan storage:link
```
```
php artisan serve
```

Open http://localhost:8000 in browser, use email `admin@mail.com` and password `admin` to login.

## License

`Laravel Online Shop` is licensed under [The MIT license (MIT)](https://electro-paradizo.mit-license.org/).
