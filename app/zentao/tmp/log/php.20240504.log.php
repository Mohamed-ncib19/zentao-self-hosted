<?php
 die();
?>

00:16:04 Uncaught Error: Call to undefined method userModel::password_verify() in module/user/model.php:811
Stack trace:
#0 module/user/control.php(861): userModel->identify('admin', '67b28efc75a64fd...')
#1 framework/base/router.class.php(1928): user->login('', '')
#2 www/index.php(73): baseRouter->loadModule()
#3 {main}
  thrown in module/user/model.php on line 811 when visiting user-login

00:16:07 Uncaught Error: Call to undefined method userModel::password_verify() in module/user/model.php:811
Stack trace:
#0 module/user/control.php(861): userModel->identify('admin', '3548e66d3daa54a...')
#1 framework/base/router.class.php(1928): user->login('', '')
#2 www/index.php(73): baseRouter->loadModule()
#3 {main}
  thrown in module/user/model.php on line 811 when visiting user-login

00:32:32 syntax error, unexpected 'public' (T_PUBLIC), expecting end of file in module/user/control.php on line 805 when visiting user-login

07:54:24 syntax error, unexpected 'return' (T_RETURN), expecting variable (T_VARIABLE) or '{' or '$' in module/user/model.php on line 870 when visiting user-login-L3plbnRhby8=

07:54:25 syntax error, unexpected 'return' (T_RETURN), expecting variable (T_VARIABLE) or '{' or '$' in module/user/model.php on line 870 when visiting user-login-L3plbnRhby8=

07:54:34 syntax error, unexpected 'return' (T_RETURN), expecting variable (T_VARIABLE) or '{' or '$' in module/user/model.php on line 870 when visiting user-login-L3plbnRhby8=

07:54:35 syntax error, unexpected 'return' (T_RETURN), expecting variable (T_VARIABLE) or '{' or '$' in module/user/model.php on line 870 when visiting user-login-L3plbnRhby8=

07:54:35 syntax error, unexpected 'return' (T_RETURN), expecting variable (T_VARIABLE) or '{' or '$' in module/user/model.php on line 870 when visiting user-login-L3plbnRhby8=
