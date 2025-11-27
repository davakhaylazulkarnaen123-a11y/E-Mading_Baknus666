@echo off
echo ========================================
echo   SETUP ADVANCED CREATE ARTIKEL FORM
echo ========================================
echo.

echo [1] Running migration for new fields...
php artisan migrate --force

echo [2] Starting Laravel Server...
start /B php artisan serve --host=127.0.0.1 --port=8000

echo [3] Waiting for server to start...
timeout /t 3 /nobreak > nul

echo [4] Opening advanced create form...
start http://127.0.0.1:8000/login
timeout /t 2 /nobreak > nul
start http://127.0.0.1:8000/new-article

echo.
echo ========================================
echo        ADVANCED CREATE FEATURES
echo ========================================
echo.
echo ✅ Modern UI with drag & drop image upload
echo ✅ Real-time character/word counting
echo ✅ Live article preview
echo ✅ Text formatting tools (bold, italic, lists)
echo ✅ Tags system for better categorization
echo ✅ Scheduled publishing (for guru/admin)
echo ✅ Status management (draft/published)
echo ✅ Responsive design for all devices
echo ✅ Form validation and error handling
echo ✅ Tips and guidelines for better writing
echo.
echo Login credentials:
echo - Admin: admin / password
echo - Guru: guru / password  
echo - Siswa: siswa / password
echo.
echo Press any key to stop server...
pause > nul

echo.
echo [5] Stopping server...
taskkill /F /IM php.exe > nul 2>&1
echo Server stopped.
echo.
echo Advanced create form setup completed!
pause