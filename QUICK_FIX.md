# E-Mading Quick Fix Guide

## Issues Found and Fixed:

### 1. Database Foreign Key Issues
- Fixed foreign key constraints in migrations to reference correct column names
- Updated artikels, likes, and sessions tables

### 2. Missing Controllers
- Created HomeController for public home page

### 3. Middleware Registration
- Fixed AdminMiddleware alias in routes

### 4. Missing Views
- Home view exists and is properly configured

## Steps to Fix:

### Option 1: Run Database Fix Script
1. Open Command Prompt as Administrator
2. Navigate to project directory: `cd c:\laragon\www\e-mading`
3. Run: `fix_database.bat`

### Option 2: Manual Fix
1. Open Laragon Terminal or Command Prompt
2. Navigate to project: `cd c:\laragon\www\e-mading`
3. Run these commands:
   ```
   php artisan db:wipe --force
   php artisan migrate --force
   php artisan db:seed --force
   ```

### Option 3: Reset Everything
1. Delete database file: `database/database.sqlite` (if using SQLite)
2. Or drop all tables in MySQL/PostgreSQL
3. Run migrations: `php artisan migrate --force`
4. Run seeders: `php artisan db:seed --force`

## Test the Application:

1. **Home Page**: Visit `http://localhost/e-mading/` 
2. **Login**: Use credentials:
   - Admin: username=`admin`, password=`password`
   - Guru: username=`guru`, password=`password`  
   - Siswa: username=`siswa`, password=`password`
3. **Dashboard**: After login, should redirect to dashboard
4. **Create Article**: Test article creation functionality

## Common URLs:
- Home: `http://localhost/e-mading/`
- Login: `http://localhost/e-mading/login`
- Dashboard: `http://localhost/e-mading/dashboard`
- Create Article: `http://localhost/e-mading/artikel/create`

## If Still Getting 404 Errors:

1. Check Apache/Nginx configuration
2. Verify .htaccess file exists in public folder
3. Ensure mod_rewrite is enabled
4. Check file permissions
5. Clear Laravel cache: `php artisan cache:clear`
6. Clear config cache: `php artisan config:clear`
7. Clear route cache: `php artisan route:clear`