@echo off
echo Final database setup...

cd /d "c:\laragon\www\e-mading"

php artisan db:seed --force

echo.
echo ========================================
echo E-MADING SETUP COMPLETED!
echo ========================================
echo.
echo Test URLs:
echo Home: http://localhost/e-mading/
echo Login: http://localhost/e-mading/login
echo Dashboard: http://localhost/e-mading/dashboard
echo.
echo Login Accounts:
echo Admin: admin / password
echo Guru: guru / password
echo Siswa: siswa / password
echo.
echo Features to test:
echo 1. Login with any account
echo 2. View dashboard
echo 3. Create new article
echo 4. View published articles
echo.
pause