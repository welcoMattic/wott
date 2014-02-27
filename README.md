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

- Populate your database from TMDB API

``` php app/console wott:insertGenres ```

Faker (create 5 entries in People, Film and Genre)

```php app/console faker:populate```

