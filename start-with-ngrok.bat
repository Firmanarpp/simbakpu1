@echo off
echo ========================================
echo   Laravel + ngrok HTTPS Setup
echo ========================================
echo.

echo Step 1: Starting Laravel Server...
echo.
start cmd /k "cd /d C:\firman\web1\my-laravel-app && echo Starting Laravel Server... && php artisan serve --host=0.0.0.0 --port=8000"

timeout /t 3 /nobreak >nul

echo Step 2: Starting ngrok tunnel...
echo.
echo IMPORTANT: Make sure you have:
echo 1. Downloaded ngrok to C:\firman\ngrok\
echo 2. Setup authtoken: ngrok config add-authtoken YOUR_TOKEN
echo.
pause

start cmd /k "cd /d C:\firman\ngrok && echo Starting ngrok... && echo. && ngrok http 8000"

echo.
echo ========================================
echo  Both services are starting...
echo ========================================
echo.
echo Laravel Server: http://localhost:8000
echo ngrok HTTPS: Check the ngrok terminal window
echo.
echo For mobile access with camera:
echo 1. Use the HTTPS URL from ngrok terminal
echo 2. QR Scanner camera will work on HTTPS!
echo.
pause
