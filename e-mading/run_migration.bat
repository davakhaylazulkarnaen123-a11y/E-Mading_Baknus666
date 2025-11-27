@echo off
cd /d "c:\laragon\www\e-mading"
"c:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe" artisan migrate --path=database/migrations/2025_11_17_000000_add_rejection_reason_to_artikels_table.php
pause