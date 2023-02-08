# RENTdee

RentDee is a tenant reporting database, built for landlords. We aim to make your renting decisions easier by helping you pick the best tenants.

## Features
Main features include:
- report a tenant
- search a tenant
- localization (using i18n package)

## Database
- User
- Role
- Permission
- TenantReport

## Stack

RentDee is a SPA built with Laravel + Vue (using Inertia client-side rendering)

Why client-side rendering? SEO not important. Note that even though we are not using server-side rendering, we are still using server-side routing with Ziggy package.
