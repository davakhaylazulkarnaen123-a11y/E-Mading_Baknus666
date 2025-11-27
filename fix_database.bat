@echo off
echo Fixing E-Mading Database...

cd /d "c:\laragon\www\e-mading"

echo Dropping all tables...
php artisan db:wipe --force

echo Running migrations...
php artisan migrate --force

echo Seeding database...
php artisan db:seed --force

echo Database fixed successfully!
pause