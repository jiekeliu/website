<?php
header('Content-Type:text/html;Charset=utf-8');
include_once "../../model/extrafunction.php";
$obj = new AxtraFun();
$status = $obj->createMod('../../Extra/log/contraller/log.html');
echo $status;
?>