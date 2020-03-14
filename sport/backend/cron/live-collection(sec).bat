@echo off
  
:LotteryCollection
::分析目前日期 


CALL D:\www\sport_website\backend\yii.bat live-collection
CALL D:\www\sport_website\backend\yii.bat lottery-collection

::程式結束  
::暫停10秒後再繼續執行aaa
timeout  /t 40 /nobreak
goto LotteryCollection
 
pause
