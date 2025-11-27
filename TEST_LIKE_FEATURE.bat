@echo off
echo ========================================
echo    TEST FITUR LIKE - E-MADING DIGITAL
echo ========================================
echo.

echo [1] Starting Laravel Server...
start /B php artisan serve --host=127.0.0.1 --port=8000

echo [2] Waiting for server to start...
timeout /t 3 /nobreak > nul

echo [3] Opening test URLs...
echo.
echo Testing URLs:
echo - Home Page: http://127.0.0.1:8000
echo - Login Page: http://127.0.0.1:8000/login
echo - Article Detail: http://127.0.0.1:8000/artikel/8
echo.

start http://127.0.0.1:8000
timeout /t 2 /nobreak > nul
start http://127.0.0.1:8000/login

echo.
echo ========================================
echo           TEST INSTRUCTIONS
echo ========================================
echo.
echo 1. Test WITHOUT LOGIN:
echo    - Go to home page
echo    - Check like buttons are disabled/gray
echo    - Tooltip should show "Login untuk memberikan like"
echo.
echo 2. Test WITH LOGIN:
echo    - Login with: admin / password
echo    - Go to article detail page
echo    - Click like button (should turn red)
echo    - Click again (should turn gray)
echo    - Counter should update
echo.
echo 3. Test MULTIPLE USERS:
echo    - Login as different users
echo    - Check like status is independent
echo.
echo Press any key to stop server...
pause > nul

echo.
echo [4] Stopping server...
taskkill /F /IM php.exe > nul 2>&1
echo Server stopped.
echo.
echo Test completed!
pause