#!/usr/bin/env bash
composer install
cd ./js
npm install
npx ng build --progress
cd ../public/
php -S localhost:8000
