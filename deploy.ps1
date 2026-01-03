# Script de despliegue para GitHub Pages

# 1. Construir los assets de producción (Vite)
Write-Host "Construyendo assets..."
npm run build

# 2. Generar el sitio estático
Write-Host "Configurando entorno para exportación..."
$env:ASSET_URL = "./"
$env:APP_URL = "http://localhost"

Write-Host "Exportando sitio estático..."
php artisan export

# 3. Mover a la carpeta docs (requerido por GitHub Pages)
if (Test-Path "docs") {
    Write-Host "Eliminando carpeta docs existente..."
    Remove-Item "docs" -Recurse -Force -ErrorAction SilentlyContinue
    Start-Sleep -Seconds 1
}

if (Test-Path "dist") {
    Write-Host "Moviendo dist a docs..."
    
    # Intentar mover/renombrar. Si falla (común en OneDrive), copiar y borrar.
    try {
        Move-Item -Path "dist" -Destination "docs" -Force -ErrorAction Stop
    }
    catch {
        Write-Warning "No se pudo mover la carpeta 'dist' (posible bloqueo de OneDrive). Intentando copiar..."
        Copy-Item -Path "dist" -Destination "docs" -Recurse -Force
        Remove-Item "dist" -Recurse -Force -ErrorAction SilentlyContinue
    }
} else {
    Write-Error "La carpeta dist no se generó."
    exit 1
}

# 4. Crear archivo .nojekyll para evitar que GitHub ignore archivos que empiezan con _
New-Item -Path "docs\.nojekyll" -ItemType File -Force

Write-Host "¡Despliegue listo! Sube los cambios a GitHub."
