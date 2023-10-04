<?php
    require_once '../connectData.php';
if(!isset($_SESSION['id'])){
    session_start();
    session_destroy()&&
    redirect(BASE_URL_PATH.'index.php');
}