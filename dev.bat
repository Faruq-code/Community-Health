@echo off
setlocal

echo ==========================================
echo   Community Health Dev Server (One Window)
echo ==========================================

:: 1. Start PHP server in the background
echo [INFO] Starting Laravel PHP Server (localhost:8000)...
start /b php artisan serve

:: 2. Start Vite in the current window
echo [INFO] Starting Vite (Frontend Assets)...
npm run dev

:: Note: Closing this window will stop npm run dev. 
:: You'll need to manually stop the `php artisan serve` process if it's still running.
pause
