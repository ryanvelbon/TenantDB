# RENTdee

RentDee is a tenant reporting database, built for landlords. We aim to make your renting decisions easier by helping you pick the best tenants.

## Topics

1. [Features](#features)
1. [Database](#database)
1. [Running the tests](#running-the-tests)
1. [Deployment](#deployment)
1.
1. [Conventions](#conventions)

## Features

### Admin
- dashboard
  - view stats
    - number of sign ups
    - number of report runs
- search a User
- search a tenant report by passport, phone, or email
- edit a User

### Frontend
- report a tenant
- search a tenant
- localization (using i18n package)


## Database
- User
  - end-users (landlord, agent, tenant)
  - admin users (admin)
- Role
- Permission
- Property
- Tenant
- TenantReport

## Stack

RentDee is a SPA built with Laravel + Vue (using Inertia client-side rendering)

Why client-side rendering? SEO not important. Note that even though we are not using server-side rendering, we are still using server-side routing with Ziggy package.

## Installation

### Running the tests

Set up a testing environment

    $ cp .env.example .env.testing

    APP_ENV=testing
     
    DB_CONNECTION=
    DATABASE=

Switch to test environment

    $ php artisan config:cache --env=testing

to switch back to local environment

    $ php artisan config:cache --env=local

Run the tests

    $ php artisan test

    $ php artisan test --filter


## Notes for developers

### Create reusable Vue components

Create reusable custom Vue components in `resources/js/Components` so that you will have a consistent UI.

### OOP Inheritance & extension tables

Extension tables should follow the naming convention `goos__foo` where `class Foo extends Goo`.

### Comments tags

You will come across comments containing the following tags such as `*PENDING*`, `*TEMP*`, `*FIX*`, `*REFACTOR*`, `*OPT*`, `*REVISE*`; these indicate that the code needs to be revised.