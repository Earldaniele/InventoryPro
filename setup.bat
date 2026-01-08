@echo off
echo ================================
echo Laravel Inventory System Setup
echo ================================
echo.

echo Checking if Composer is installed...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Composer is not installed or not in PATH
    echo Please install Composer from https://getcomposer.org/
    pause
    exit /b 1
)

echo Checking if PHP is installed...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: PHP is not installed or not in PATH
    echo Please install PHP 8.1 or higher
    pause
    exit /b 1
)

echo.
echo Installing Laravel dependencies...
composer install

echo.
echo Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo Environment file created.
) else (
    echo Environment file already exists.
)

echo.
echo Generating application key...
php artisan key:generate

echo.
echo ================================
echo Setup Complete!
echo ================================
echo.
echo Next steps:
echo 1. Configure your database settings in the .env file
echo 2. Create a MySQL database (e.g., inventory_db)
echo 3. Run: php artisan migrate
echo 4. Optionally run: php artisan db:seed (for sample data)
echo 5. Start the server: php artisan serve
echo.
echo The application will be available at http://localhost:8000
echo.
pause