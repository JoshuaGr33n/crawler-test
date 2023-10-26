<?php session_start();
(!isset($_SESSION['user'])) ?  header('Location: /login') :'';
?>
 <a href="/logout">Logout</a> <?=$_SESSION['user'];?><br><a href="/">Home Page</a><br><a href="/admin">Admin Home Page</a><br><a href="/post-content">Add content to Home Page</a><br>
<!DOCTYPE html>
<html>