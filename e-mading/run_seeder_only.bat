@echo off
echo Running database seeder...

cd /d "c:\laragon\www\e-mading"

php artisan db:seed --force

echo Seeding completed!
echo.
echo Test your application:
echo Home: http://localhost/e-mading/
echo Login: http://localhost/e-mading/login
echo.
echo Login credentials:
echo Admin: admin / password
echo Guru: guru / password  
echo Siswa: siswa / password
echo.
pause