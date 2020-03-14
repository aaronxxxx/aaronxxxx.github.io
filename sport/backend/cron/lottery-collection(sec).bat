@echo off
  
:LotteryCollection
::分析目前日期 
for /f "tokens=1-4 delims=-/ " %%i IN ("%date%") DO (
 set year=%%i
 set month=%%j
 set day=%%k
)
 
::設定 log
SET fname=%year%-%month%-%day%
SET fname=%fname: =0%
SET fname=D:\www\sport_website\backend\cron\log\%fname%.txt

echo start: %date% %time% >> %fname%
CD D:\www\sport_website\backend\
CALL .\yii.bat lottery-collection
CALL .\yii.bat lottery-checkout
CALL .\yii.bat six-checkout
echo end: %date% %time% >> %fname%

::程式結束  
::暫停10秒後再繼續執行aaa
timeout  /t 20 /nobreak
goto LotteryCollection
 
pause
