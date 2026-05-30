@echo off
REM ============================================
REM SVRMS - Configuration Update Script
REM ============================================
REM This script clears caches after updating .env configuration

echo.
echo ============================================
echo SVRMS Configuration Update
echo ============================================
echo.

echo [1/4] Clearing configuration cache...
php artisan config:cache
if errorlevel 1 goto error

echo.
echo [2/4] Clearing route cache...
php artisan route:cache
if errorlevel 1 goto error

echo.
echo [3/4] Clearing view cache...
php artisan view:clear
if errorlevel 1 goto error

echo.
echo [4/4] Clearing application cache...
php artisan cache:clear
if errorlevel 1 goto error

echo.
echo ============================================
echo SUCCESS! Configuration updated.
echo ============================================
echo.
echo Your application is ready to use with:
echo - Domain/IP configuration from .env
echo - All caches refreshed
echo.
echo Test your application with:
echo   - http://localhost:8000
echo   - http://your-ip:8000
echo   - http://your-domain.com
echo.
goto end

:error
echo.
echo ============================================
echo ERROR! Configuration update failed.
echo ============================================
echo.
exit /b 1

:end
pause
