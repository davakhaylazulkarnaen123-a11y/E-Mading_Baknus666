@echo off
echo Testing E-Mading URLs...

echo.
echo Try these URLs in your browser:
echo.
echo 1. Virtual Host (Recommended):
echo    http://e-mading.test
echo.
echo 2. Direct Public Access:
echo    http://localhost/e-mading/public/
echo.
echo 3. With Port (if using php artisan serve):
echo    http://localhost:8000
echo.
echo 4. Laragon Default:
echo    http://localhost/e-mading/
echo.
echo ========================================
echo TROUBLESHOOTING:
echo ========================================
echo.
echo If getting 404:
echo 1. Make sure Laragon Apache is running
echo 2. Check if mod_rewrite is enabled
echo 3. Try: http://localhost/e-mading/public/
echo 4. Restart Laragon completely
echo.
echo If database errors:
echo 1. Run: php artisan migrate --force
echo 2. Run: php artisan db:seed --force
echo.
echo If route errors:
echo 1. Run: php artisan route:clear
echo 2. Run: php artisan config:clear
echo.
pause