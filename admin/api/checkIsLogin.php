<?php

session_start();
if($_SESSION['info']){
    echo"ok";
}else{
    echo"fail";
}

?>