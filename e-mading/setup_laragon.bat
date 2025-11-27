@echo off
echo Setting up E-Mading for Laragon...

cd /d "c:\laragon\www\e-mading"

echo Step 1: Clear all caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo Step 2: Generate app key...
php artisan key:generate

echo Step 3: Create storage link...
php artisan storage:link

echo Step 4: Set permissions...
if exist "storage" (
    echo Setting storage permissions...
)
if exist "bootstrap\cache" (
    echo Setting bootstrap cache permissions...
)

echo.
echo ========================================
echo LARAGON SETUP COMPLETED!
echo ========================================
echo.
echo Access your application at:
echo http://e-mading.test
echo.
echo If still getting 404, try:
echo 1. Restart Laragon
echo 2. Check Apache is running
echo 3. Access: http://localhost/e-mading/public/
echo.
echo Login credentials:
echo Admin: admin / password
echo Guru: guru / password
echo Siswa: siswa / password
echo.
pause