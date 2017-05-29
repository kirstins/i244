<?php
require_once('functions.php');
session_start();
connect_db();
require_once('views/head.html');
if (isset($_GET['mode']) && $_GET['mode']!=""){
    $mode=htmlspecialchars($_GET['mode']);
} else {
    $mode="main";
}
switch($mode){
    case "register":
        register();
        break;
    case "login":
        login();
        break;
    case "logout":
        logout();
        break;
    case "addcost";
        addcost();
        break;
    case "addincome";
       addincome();
       break;
    case "costhistory":
       view_costs();
        break;
    case "incomehistory":
      view_income();
        break;
    default:
       include_once('views/main.html');
    break;
}
require_once('views/foot.html');