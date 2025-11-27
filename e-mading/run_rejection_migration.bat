@echo off
echo Running rejection reason migration...
cd /d "c:\laragon\www\e-mading"
c:\laragon\bin\php\php8.2.12\php.exe artisan migrate --path=database/migrations/2025_11_17_000000_add_rejection_reason_to_artikels_table.php
echo Migration completed!
pause