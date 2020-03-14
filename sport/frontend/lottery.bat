@echo off

rem -------------------------------------------------------------
rem  Yii command line bootstrap script for Windows.
rem  generate lottery data
rem -------------------------------------------------------------

:lottery

php.exe yii lottery

@echo. build time %time%

@ping 127.0.0.1 -n 5 >nul

goto lottery