<?php

session_start();

if(session_destroy()){
	header("LOCATION:index.php");
}



?>