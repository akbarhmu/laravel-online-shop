<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a></p>

<p align="center">
ElectroParadizo: Simple Online Store Website Built With Laravel
</p>

Simple online store website built with laravel and jetstrap (livewire). The purpose of this projects is for educational only, this was my first production app in my life, so it contains a lot of inefficient algorithms such as repeating the code.

Beside Laravel, this project uses other tools like:
- [Jetstrap (Jetstream+Bootstrap)](https://github.com/nascent-africa/jetstrap)
- [Bootstrap 4](https://getbootstrap.com/)
- [Font Awesome](http://fontawesome.io/)
- [Stisla Admin Template](https://github.com/stisla/stisla)
- [kavist/rajaongkir](https://github.com/kavist/rajaongkir)
- [Intervention/image](https://github.com/Intervention/image)

## Features
- Integration with RajaOngkir

## Requirement

-   Composer
-   Node.js
-   PHP 7.3 or later (with [enabled gd library](https://write.corbpie.com/how-to-enable-gd-library-with-xampp-php-8-on-windows/))
-   MySQL 5.7 or later

## Installation

```
git clone https://github.com/Gasiyu/ElectroParadizo.git
cd ElectroParadizo
cp .env.example .env
```

Open `.env`, change `DB_DATABASE` according to your needs, then create a database with that name. Change `RAJAONGKIR_API_KEY` with apikey that you can get from [here](https://rajaongkir.com/akun/panel).

```
composer install
npm install
npm run dev

php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link

php artisan serve
```

Go to http://localhost:8000 . Use `admin@mail.com` with password `admin` to login at admin dashboard.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
