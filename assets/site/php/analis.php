<?php 
	require_once('users.php');
	
	
	
	
	$sfname=$_POST['sfname'];
	$slname=$_POST['slname'];
	$name=$sfname." ".$slname;
	$semail=$_POST['semail'];
	$spwd=$_POST['spwd'];
	$spwdp=$_POST['spwdp'];
	
	
	
	$user = new User();
	$user->read();
	$echo_data="";
	$res="";
	$next_id=0;
	if($user->validation($semail,$spwd,$spwdp)){
		$res=$user->search_email($semail);
		$next_id=$user->next_id();
		
		
		if($res != ""){
		$echo_data="not1";}
		else{
		$user->add_user($next_id,$semail,$name,$spwd);
			$echo_data="done";
		}
	}
	else{
		$echo_data="not1";
	}
	echo $echo_data;
	
?>						