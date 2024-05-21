<?php
 die();
0:00:59 task 5 executed,
command: moduleName=git&methodName=run.
return : .
output : 
2024-04-27 00:00:59 begin repo 1
2024-04-27 00:00:59 sync branch master logs.
2024-04-27 00:00:59 get this repo logs.
2024-04-27 00:00:59 Please init repo project1
2024-04-27 00:00:59 

repo #1: http://localhost:7070/api/v4/projects/3/repository/ finished
2024-04-27 00:00:59 begin repo 3
2024-04-27 00:00:59 sync branch master logs.
2024-04-27 00:00:59 get this repo logs.
2024-04-27 00:00:59 Please init repo Front
2024-04-27 00:00:59 

repo #3: http://localhost:7070/api/v4/projects/11/repository/ finished

0:00:59 task 7 executed,
command: moduleName=mail&methodName=asyncSend.
return : .
output : 
OK

0:00:59 task 8 executed,
command: moduleName=webhook&methodName=asyncSend.
return : .
output : 
NO WEBHOOK EXIST.

0:00:59 task 9 executed,
command: moduleName=admin&methodName=deleteLog.
return : .
output : 

0:00:59 task 12 executed,
command: moduleName=ci&methodName=checkCompileStatus.
return : .
output : 
success
0:00:59 task 13 executed,
command: moduleName=ci&methodName=exec.
return : .
output : 
success
0:00:59 task 14 executed,
command: moduleName=mr&methodName=syncMR.
return : .
output : 
success
0:01:59 task 11 executed,
command: moduleName=ci&methodName=initQueue.
return : .
output : 
success
0:05:59 task 5 executed,
command: moduleName=git&methodName=run.
return : .
output : 
2024-04-27 00:05:59 begin repo 1
2024-04-27 00:05:59 sync branch master logs.
2024-04-27 00:05:59 get this repo logs.
2024-04-27 00:05:59 Please init repo project1
2024-04-27 00:05:59 

repo #1: http://localhost:7070/api/v4/projects/3/repository/ finished
2024-04-27 00:05:59 begin repo 3
2024-04-27 00:05:59 sync branch master logs.
2024-04-27 00:05:59 get this repo logs.
2024-04-27 00:05:59 Please init repo Front
2024-04-27 00:05:59 

repo #3: http://localhost:7070/api/v4/projects/11/repository/ finished

0:05:59 task 7 executed,
command: moduleName=mail&methodName=asyncSend.
return : .
output : 
OK

0:05:59 task 8 executed,
command: moduleName=webhook&methodName=asyncSend.
return : .
output : 
NO WEBHOOK EXIST.

0:05:59 task 9 executed,
command: moduleName=admin&methodName=deleteLog.
return : .
output : 

0:05:59 task 12 executed,
command: moduleName=ci&methodName=checkCompileStatus.
return : .
output : 
success
0:05:59 task 13 executed,
command: moduleName=ci&methodName=exec.
return : .
output : 
success
0:05:59 task 14 executed,
command: moduleName=mr&methodName=syncMR.
return : .
output : 
success
