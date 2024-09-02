# Confirmation prompt
$confirmation = Read-Host "This script will clear Laravel caches and remove temporary files. Are you sure you want to proceed? (y/n)"
if ($confirmation -ne 'y') {
    Write-Output "Operation cancelled."
    exit
}

# Clear Laravel cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Remove log files
Remove-Item -Path "storage\logs\*.log" -Force -Recurse -ErrorAction SilentlyContinue

# Remove temporary files
Remove-Item -Path "storage\framework\cache\*" -Force -Recurse -ErrorAction SilentlyContinue
Remove-Item -Path "storage\framework\sessions\*" -Force -Recurse -ErrorAction SilentlyContinue
Remove-Item -Path "storage\framework\views\*" -Force -Recurse -ErrorAction SilentlyContinue

Write-Output "Temporary files, logs, and cache have been cleared."