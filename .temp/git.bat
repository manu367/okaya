@echo off
REM ===== Get today's date (YYYY-MM-DD) =====
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set todaydate=%datetime:~0,4%-%datetime:~4,2%-%datetime:~6,2%

REM ===== Git commands =====
git add .
git commit -m "first-%todaydate%"
git push origin main

pause
