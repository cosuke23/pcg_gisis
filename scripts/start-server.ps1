# Starts everything the tailnet link https://msi.tail7d94c9.ts.net needs:
# XAMPP MySQL, the Laravel server on 127.0.0.1:8000, and Tailscale Serve.
# Safe to run more than once: anything already running is left alone.
# Registered to run at logon via a shortcut in the Windows Startup folder.

$ErrorActionPreference = 'Continue'
$ProjectDir = Split-Path -Parent $PSScriptRoot
$LogDir     = Join-Path $ProjectDir 'storage\logs'
$Log        = Join-Path $LogDir 'startup.log'
$MysqlExe   = 'C:\xampp\mysql\bin\mysqld.exe'
$MysqlIni   = 'C:\xampp\mysql\bin\my.ini'
$PhpExe     = 'C:\xampp\php\php.exe'
$Tailscale  = 'C:\Program Files\Tailscale\tailscale.exe'
$AppPort    = 8000

function Write-Log($msg) {
    "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')  $msg" | Out-File -FilePath $Log -Append -Encoding utf8
}

function Test-Port($port) {
    $client = New-Object System.Net.Sockets.TcpClient
    try {
        $client.ConnectAsync('127.0.0.1', $port).Wait(500) -and $client.Connected
    } catch {
        $false
    } finally {
        $client.Dispose()
    }
}

function Wait-Port($port, $seconds) {
    for ($i = 0; $i -lt $seconds; $i++) {
        if (Test-Port $port) { return $true }
        Start-Sleep -Seconds 1
    }
    return $false
}

New-Item -ItemType Directory -Force -Path $LogDir | Out-Null
Write-Log 'Startup script running.'

# 1. MySQL
if (Test-Port 3306) {
    Write-Log 'MySQL already listening on 3306.'
} else {
    Start-Process -FilePath $MysqlExe -ArgumentList "--defaults-file=$MysqlIni", '--standalone' -WindowStyle Hidden
    if (Wait-Port 3306 60) { Write-Log 'MySQL started.' } else { Write-Log 'ERROR: MySQL did not start within 60s.' }
}

# 2. Laravel server
if (Test-Port $AppPort) {
    Write-Log "Laravel already listening on $AppPort."
} else {
    Start-Process -FilePath $PhpExe `
        -ArgumentList 'artisan', 'serve', '--host=127.0.0.1', "--port=$AppPort" `
        -WorkingDirectory $ProjectDir -WindowStyle Hidden `
        -RedirectStandardOutput (Join-Path $LogDir 'serve.out.log') `
        -RedirectStandardError  (Join-Path $LogDir 'serve.err.log')
    if (Wait-Port $AppPort 30) { Write-Log 'Laravel server started.' } else { Write-Log "ERROR: Laravel did not start on $AppPort within 30s." }
}

# 3. Tailscale Serve (its config persists, but re-applying is harmless)
if (Test-Path $Tailscale) {
    for ($i = 0; $i -lt 30; $i++) {
        $state = (& $Tailscale status --json 2>$null | ConvertFrom-Json).BackendState
        if ($state -eq 'Running') { break }
        Start-Sleep -Seconds 2
    }
    & $Tailscale serve --bg $AppPort 2>&1 | Out-Null
    Write-Log "Tailscale Serve applied (backend state: $state)."
} else {
    Write-Log 'ERROR: tailscale.exe not found.'
}

Write-Log 'Startup script finished.'
