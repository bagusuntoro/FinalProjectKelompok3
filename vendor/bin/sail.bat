@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../laravel/sail/bin/sail
SET COMPOSER_BIN_DIR=%~dp0
bash "%BIN_TARGET%" %*
