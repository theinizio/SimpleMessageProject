<?php



$user = new User(Db::getConnection());
$GLOBALS['user'] = $user;

header('Content-type: text/html; charset=utf-8');

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SimpleMessageProject</title>
        <meta name="description" content="SimpleMessageProject">
        <meta name="viewport" content="width=device-width">
		
        <!-- CSS -->
		<link href="/smp/template/css/main.css" type="text/css" rel="stylesheet">
		        
		       
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="/smp/template/js/myscript.js"></script>
	
    </head>
    <body>
 
 
<?php

flush(); // we flush the content so the browser can start the download of css/js
?>
