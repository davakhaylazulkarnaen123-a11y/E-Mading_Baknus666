@echo off
echo Fixing migration order and running database setup...

cd /d "c:\laragon\www\e-mading"

echo Step 1: Dropping all tables...
php artisan db:wipe --force

echo Step 2: Running migrations in correct order...
php artisan migrate --force

echo Step 3: Seeding database...
php artisan db:seed --force

echo Database setup completed!
pause