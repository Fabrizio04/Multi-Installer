@echo off
rem Attenzione! Non modificare questo file
"%~dp0\signtool.exe" sign /f "%~dp0\codesign.pfx" /p "%2" /d "Multi-Installer by Fabrizio Amorelli" /tr http://timestamp.digicert.com "%~dp0\..\setup\%1"