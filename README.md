What's on TV tonight ? (wott.fr)
====

Symfony2 project @ IESA Multimédia

*Mathieu Santostefano + Maxime Vaullerin + Marine Bouras + Grégory Joly*

Minimum configuration required :

- Apache >= 2.2 (ou Nginx >= 1.2.1)
- PHP 5.5.9
- MySQL >= 5.5
- Xdebug 2.2.3
- APC

## Installation

config webseveur local (hosts + vhost)

- Clone the repo

```git clone https://github.com/welcoMattic/wott```

- Install Symfony2 components and vendors

```composer install```

- Or if you already have install WOTT project, do an update

```composer update```

- Update your database

``` php app/console doctrine:schema:create ```

- Populate your database from TMDB API

``` php app/console wott:insertGenres ```
``` php app/console wott:insertFilms ```
``` php app/console wott:insertPeoples ```

- Create a superAdmin to access to the admin dashboard

``` php app/console fos:user:create --super-admin ```