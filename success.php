<?php
	if(isset($_GET['ok'])){
    	if($_GET['ok'] == 1) { 
        	echo "<script type='text/javascript'>alert('Se ha realizado la operación con exito.')</script>";
      	}else{
        	echo "<script type='text/javascript'>alert('No se pudo realizar la operación!.')</script>";
    	}
	}
?>