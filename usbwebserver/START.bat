@echo off
start USBWebserver.exe
timeout /t 3 >nul
start http://localhost/
