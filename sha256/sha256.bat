@echo off

cd %~dp0
rem SETLOCAL EnableExtensions EnableDelayedExpansion
SET "arg1=%~1"
SET "arg2=%~2"

FOR /F "tokens=* USEBACKQ" %%F IN (`sha256sum.exe "%arg2%\%arg1%"`) DO (
	SET var=%%F
)

for /F "tokens=1 delims=. " %%a in ("%var%") do (
   set sh256=%%a
)

rem echo %sh256%

set filename=%arg1: =+%
rem echo %filename%

rem web service inserimento/aggiornamento sha256
curl http://localhost/sha256.php?id=%filename%:%sh256%
exit