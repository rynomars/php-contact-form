#!/bin/bash
mysql -u root -p < init_db.sql;
composer install;
php artisan migrate;
