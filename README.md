# Music shuffle

App developed by Tatyana Vogel and Malte Dahlheim

## Install the Application

This application uses PHP 7.4

* Point your virtual host document root to `public/` directory.
* Install the composer dependencies with composer.

```bash
cd [my-app-name]
composer install
```

* Copy the `.env` file and fill out the information. The database information
must match the database you want to use.

## Dev Env

To run the application in development, you can run these commands

```bash
cd [my-app-name]
composer start
```

Pleas note that you have to have a database server running with the same
config as in the `.env` file.

Or you can use `docker-compose` to run the app with `docker`:

```bash
cd [my-app-name]
docker-compose up -d
```

The application runs `http://localhost:8080`, open the address in your browser.

If you want to edit the javascript or css you need npm installed.

## Dev database setup

Login to the database server and create the all tables with the databaseSetup.sql
file in the `./db` directory.

### Disclaimer

In the docker environment we work with a user that has full access right on
the database

# Docs
Documentation can be found in the [docs directory](docs/index.md).
