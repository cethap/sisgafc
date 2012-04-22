<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['loggedIn'])){
   header("location:login.php");
}
?>

