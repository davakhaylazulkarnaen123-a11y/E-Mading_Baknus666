@echo off
echo Fixing all migration file orders...

cd /d "c:\laragon\www\e-mading\database\migrations"

echo Renaming migration files to correct order...
ren "2024_01_16_000000_create_comments_table.php" "2025_11_09_104448_create_comments_table.php"
ren "2024_01_17_000000_update_artikels_status.php" "2025_11_09_104449_update_artikels_status.php"
ren "2025_11_10_080336_add_views_to_artikels_table.php" "2025_11_09_104450_add_views_to_artikels_table.php"
ren "2025_11_11_000000_create_reports_table.php" "2025_11_09_104451_create_reports_table.php"
ren "2025_11_11_000000_fix_artikels_status_column.php" "2025_11_09_104452_fix_artikels_status_column.php"

cd /d "c:\laragon\www\e-mading"

echo Dropping all tables...
php artisan db:wipe --force

echo Running migrations...
php artisan migrate --force

echo Seeding database...
php artisan db:seed --force

echo All migrations fixed and database setup completed!
pause