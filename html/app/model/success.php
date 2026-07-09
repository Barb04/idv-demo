<?php
switch ($_SESSION['TRANSACTION']['MODEL']) {
  case 'M01':
    $_SESSION['TRANSACTION']["RETURN_1"] = $_SESSION['TRANSACTION']["RETURN_2"];
    include(__ROOT__.'/app/model/docv.php');
    break;

  default:
    include(__ROOT__.'/app/view/_header.phtml');
    include(__ROOT__.'/app/view/loader.phtml');
    include(__ROOT__.'/app/view/_footer.phtml');
    if(!empty($_SESSION['TRANSACTION']["RETURN_1"])){include(__ROOT__.'/app/model/retrival_1.php');}
    if(!empty($_SESSION['TRANSACTION']["RETURN_2"])){include(__ROOT__.'/app/model/retrival_2.php');}
    echo '<script> window.location.href = "'.$url_basic.'results"; </script>';
    exit;
  break;
}
//====================================================
#echo '<hr>'.json_encode($_SESSION, JSON_PRETTY_PRINT).'<hr>';exit;
