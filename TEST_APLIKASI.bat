@echo off
echo ========================================
echo TESTING E-MADING APPLICATION
echo ========================================

cd /d "c:\laragon\www\e-mading"

echo Step 1: Clear all caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear

echo Step 2: Run seeder to ensure data exists...
php artisan db:seed --force

echo Step 3: Start Laravel server...
echo.
echo ========================================
echo APPLICATION READY!
echo ========================================
echo.
echo Access your application at:
echo http://127.0.0.1:8000
echo.
echo Login accounts:
echo Admin: admin / password
echo Guru: guru / password
echo Siswa: siswa / password
echo.
echo The home page should now show articles like in Screenshot 314
echo Press Ctrl+C to stop the server
echo.
php artisan serve