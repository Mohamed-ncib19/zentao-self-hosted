<?php
 die();
?>

23:42:29 Uncaught PDOException: SQLSTATE[70100]: : 1927 Connection was killed in module/common/model.php:478
Stack trace:
#0 module/common/model.php(478): PDO->query('SELECT id  FROM...')
#1 module/common/view/header.html.php(23): commonModel::printCreateList()
#2 module/gitlab/view/browse.html.php(13): include('/opt/zbox/app/z...')
#3 framework/control.class.php(244): include('/opt/zbox/app/z...')
#4 framework/base/control.class.php(648): control->parseDefault('gitlab', 'browse')
#5 framework/base/control.class.php(877): baseControl->parse('gitlab', 'browse')
#6 module/gitlab/control.php(61): baseControl->display()
#7 framework/base/router.class.php(1928): gitlab->browse('id_desc', 0, 20, 1)
#8 www/index.php(73): baseRouter->loadModule()
#9 {main}
  thrown in module/common/model.php on line 478 when visiting gitlab-browse

17:42:29 Unknown: send of 5 bytes failed with errno=32 Broken pipe in Unknown on line 0 when visiting gitlab-browse
