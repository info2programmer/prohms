<?php

class Users {	
	
	function login($mode,$username,$password,$user_type)
	{
		if($mode=='login')
		{
				$row_count = mysql_num_rows(mysql_query("select * from td_users where username='$username' and password='$password' and user_type='$user_type'"));
				$row = 	mysql_fetch_assoc(mysql_query("select * from td_users where username='$username' and password='$password' and user_type='$user_type'"));			
				if($row_count>0)
				{
					// Start the session
					session_start();
					$_SESSION["user_id"] = $row['id'];
					$_SESSION["username"] = $row['username'];
					$_SESSION["is_user_logged_in1"] = 1;
					
					if($user_type=='C')
					{
						$image_path = 'http://localhost/bonggeneers/uploads/college/'.$row['logo_image'];
						$data = array(
									'userID' => $row['id'],
									'user' => $row['username'],
									'image' => $image_path,
									'status'=>1
								);	
					}
					else if($user_type=='S')
					{
						$image_path = 'http://localhost/bonggeneers/uploads/student/'.$row['logo_image'];
						$data = array(
									'userID' => $row['id'],
									'user' => $row['username'],
									'image' => $image_path,
									'status'=>1
								);
					}
					
					header('Content-Type: application/json');			
					$json = json_encode($data);
				}
				else
				{
					$status = array('status'=>0);
					header('Content-Type: application/json');			
					$json = json_encode($status);	
				}							
		}
	}
	
}
