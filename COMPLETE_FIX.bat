@echo off
echo ========================================
echo E-MADING COMPLETE FIX
echo ========================================

cd /d "c:\laragon\www\e-mading"

echo Step 1: Database setup...
php artisan db:wipe --force
php artisan migrate --force
php artisan db:seed --force

echo Step 2: Clear all caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo Step 3: Generate app key...
php artisan key:generate

echo Step 4: Create storage link...
php artisan storage:link

echo.
echo ========================================
echo SETUP COMPLETED!
echo ========================================
echo.
echo TEST THESE URLs:
echo.
echo 1. http://e-mading.test (Virtual Host)
echo 2. http://localhost/e-mading/public/ (Direct)
echo 3. http://localhost/e-mading/ (With .htaccess)
echo.
echo LOGIN ACCOUNTS:
echo Admin: admin / password
echo Guru: guru / password  
echo Siswa: siswa / password
echo.
echo If still 404, restart Laragon and try URL #2
echo.
pause