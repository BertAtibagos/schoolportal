<?php
	session_start();
	if (isset($_POST['action']))
	{
		if ($_POST['action'] === 'MENU_NAME'){
			if (isset($_POST['info'])){
				$_SESSION['MENUNAME'] = strtoupper(STRVAL($_POST['info']));
			} else {
				$_SESSION['MENUNAME'] = 'HOME';
			}
			echo '1';
		} else {
			echo '0';
		}
	} else if (isset($_GET['action']))
	{ 
		if (isset($_SESSION['MENUNAME'])){
			echo $_SESSION['MENUNAME'];
		} else {
			echo 'HOME';
		}
	} else 
	{
		echo '0';
	}
?>