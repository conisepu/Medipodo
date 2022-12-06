<?php
  session_start();
  $Id_Usuario=$_SESSION['ID_Usuario'];
  if(!isset($_SESSION['ID_Usuario'])){
    header('location: index.php');
  }
?>