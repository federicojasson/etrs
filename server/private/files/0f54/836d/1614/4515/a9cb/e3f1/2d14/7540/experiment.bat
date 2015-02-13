@echo off
for /f "tokens=*" %%i in (%1) do @echo %%i >> output/output.txt
ping 127.0.0.1 -n 2 -w 1000 > NUL