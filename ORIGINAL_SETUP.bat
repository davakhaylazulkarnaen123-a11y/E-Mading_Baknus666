@echo off
echo Restoring original E-Mading setup...

cd /d "c:\laragon\www\e-mading"

echo Step 1: Clear caches...
php artisan config:clear
php artisan route:clear
php artisan cache:clear

echo Step 2: Start Laravel development server...
echo.
echo ========================================
echo ORIGINAL SETUP RESTORED
echo ========================================
echo.
echo To run E-Mading, use Laravel's built-in server:
echo.
echo Command: php artisan serve
echo.
echo Then access: http://127.0.0.1:8000
echo.
echo Login accounts:
echo Admin: admin / password
echo Guru: guru / password
echo Siswa: siswa / password
echo.
echo Press any key to start the server...
pause

php artisan serve