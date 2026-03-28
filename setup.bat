@echo off
setlocal

echo ==========================================
echo   Community Health System Setup Helper
echo ==========================================

:: 1. Check for PHP
php -v >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] PHP is not installed or not in your PATH.
    echo Please install PHP 8.2+ or use Laravel Herd.
    pause
    exit /b
)

:: 2. Check for Composer
composer -v >nul 2>&1
if %errorlevel% neq 0 (
    echo [WARNING] Composer is not installed or not in your PATH.
    echo You will need to install dependencies manually or download composer.phar.
) else (
    echo [INFO] Installing dependencies...
    call composer install
)

:: 3. Environment File
if not exist .env (
    echo [INFO] Creating .env from .env.example...
    copy .env.example .env
    echo [SUCCESS] .env created. Please configure your DB credentials if not using SQLite.
) else (
    echo [INFO] .env already exists.
)

:: 4. Key Generate
echo [INFO] Generating application key...
php artisan key:generate

:: 5. Database Logic (Optional check)
echo.
echo Setup complete! 
echo.
echo Next steps:
echo 1. Make sure your MySQL server (XAMPP/Herd) is running.
echo 2. Update DB_PASSWORD in your .env file if needed.
echo 3. Run: php artisan migrate --seed
echo 4. Run: dev.bat to start the server.
echo.
pause
