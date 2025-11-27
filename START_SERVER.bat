@echo off
echo Starting E-Mading Server...

cd /d "c:\laragon\www\e-mading"

echo Server starting at http://127.0.0.1:8000
echo Press Ctrl+C to stop
echo.

php artisan serve