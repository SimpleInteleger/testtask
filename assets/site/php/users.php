<?php
	class User {
		public $users=array();
		
		public function __construct(){
		}
		public function read(){
			$data="";
			$data_array=array();
			$myfiler1 = fopen("array.txt", "r") or die("Unable to open file!");
			while(!feof($myfiler1)) {
				$data = $data.fgetc($myfiler1);
			}
		   
			fclose($myfiler1);
			$data_array=json_decode($data);
			$this->$users=array();
			foreach($data_array as $option){
				array_push($this->$users,$option);
			}
			
		}
		public function write(){
			$myfilew1 = fopen("array.txt", "w") or die("Unable to open file!");
			$txt = json_encode($this->$users);
			
			fwrite($myfilew1, $txt);
			
			fclose($myfilew1);
		}
		
		public function add_user($id,$email,$name ,$password){
			 $this->read();
			array_push($this->$users,array("id" => $id, "email" => $email ,  "name" => $name, "password" => $password ));
			 $this->write();
		}
		public function search_email($email){
			 $this->read();
			$e_exist="";
			foreach($this->$users as $user){
				if($user->email==$email){
					$e_exist=$e_exist."|".$user->id." ".$user->email." ".$user->name." ".$user->password;
				}
				
			}
			$myfilew2 = fopen("log.txt", "w") or die("Unable to open file!");
				$txt = $e_exist;
				fwrite($myfilew2, $txt);
				fclose($myfilew2);
				return $e_exist;
		}
		public function validation($email,$pwd,$pwdp){
			$result=false;
			$semail_bool = strpos($email,"@");
			$spwd_bool = false;	
			if($pwd == $pwdp)
			{
				$spwd_bool=true;
			}
			if ($spwd_bool and $semail_bool != false)
			{
				$result=true;
				}else{
				$result=false;
			}
			return $result;
		}
		public function next_id(){
		     $this->read();
			$max_id=0;
			foreach($this->$users as $user){
				if(intval($user->id)>$max_id){
					$max_id = intval($user->id);
				}
			}
			return $max_id+1;
		}
		
		
		
		
	}
?>
