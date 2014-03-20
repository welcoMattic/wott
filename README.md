What's on TV tonight ? (wott.fr)
====

Symfony2 project @ IESA Multimédia

*Mathieu Santostefano + Maxime Vaullerin + Marine Bouras + Grégory Joly*

Minimum configuration required :

- Apache >= 2.2 (ou Nginx >= 1.2.1)
- PHP >= 5.5
- MySQL >= 5.5
- Xdebug 2.2.3
- APC

## Installation

- Create vhost

Create a vhost named : wott.dev

- Clone the repo

```git clone https://github.com/welcoMattic/wott```

####Composer

- Install Symfony2 components and vendors

```composer install```

- Or if you already have install WOTT project, do an update

```composer update```

####Database

- Update your database

``` php app/console doctrine:schema:create ```

- Or if you already have install WOTT project, do an update

``` php app/console doctrine:schema:update --force ```

- Populate your database from TMDB API

``` php app/console wott:insertGenres ```
``` php app/console wott:insertFilms ```
``` php app/console wott:insertPeoples ```

- Create a superAdmin to access to the admin dashboard

``` php app/console fos:user:create --super-admin ```

####Assets

- Install web assets

``` php app/console assets:install web ```