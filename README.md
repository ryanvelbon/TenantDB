# TenantDB

TenantDB helps landlords and property managers pick the best tenants and avoid rental disasters.

1. [Features](#features)
1. [Install](#install)
1. [Test](#test)

Features
========

Admin Panel
-----------
- dashboard
- manage users
- manage tenant reports

Customer-Facing App
-------------------
- report a tenant
- search a tenant
- tenant screening and background check

Install
=======

    $ composer install

    $ npm install && npm run dev

Test
====

Run the tests

    $ php artisan test

You cannot use SQLite for running the tests because the database is partially seeded using MySQL scripts. Therefore, you will need to set up a MySQL test database before running any tests.

Create a `.env.testing` file

    $ cp .env.example .env.testing

    APP_ENV=testing

Configure `DB_CONNECTION` and `DATABASE`.

    $ php artisan config:clear

Switch to test environment

    $ php artisan config:cache --env=testing

to switch back to local environment

    $ php artisan config:cache --env=local
