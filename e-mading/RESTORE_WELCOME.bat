@echo off
echo Restoring welcome page...

cd /d "c:\laragon\www\e-mading"

php artisan config:clear
php artisan route:clear

echo.
echo ========================================
echo WELCOME PAGE RESTORED!
echo ========================================
echo.
echo Home page now shows the welcome screen like Screenshot 308
echo.
echo To start server: php artisan serve
echo Then access: http://127.0.0.1:8000
echo.
pause