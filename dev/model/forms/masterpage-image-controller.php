<?php 
	session_start();
	if (file_exists('../../images/'.$_SESSION['USERTYPE'].'/'.$_SESSION['USERID'].'/'.$_SESSION['USERPICTURE'])){
		$userimage = '<img src="../../images/'.$_SESSION['USERTYPE'].'/'.$_SESSION['USERID'].'/'.$_SESSION['USERPICTURE'].'" class="img-thumbnail" 
			alt="User Image" width="100" height="100" 
			style="background-color: white;margin: 0; padding: 0;" />';
	} else {
		if($_SESSION['USERGENDER'] == 'FEMALE'){
			$userimage =  '<img src="../../images/Female.png" class="img-thumbnail" 
				alt="User Image" width="100" height="100" 
				style="background-color: white;margin: 0; padding: 0;" />';
		} else {
			$userimage =  '<img src="../../images/Male.png" class="img-thumbnail" 
				alt="User Image" width="100" height="100" 
				style="background-color: white;margin: 0; padding: 0;" />';
		}
	}
	echo $userimage;
?>