<?php
session_start();
if((!isset($_SESSION["user"]))){
    header("Location: ./index.php?msg=Login First&status=401");
    exit(); 
}
?>