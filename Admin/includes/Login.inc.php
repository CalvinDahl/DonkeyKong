<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){	
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];

	try {
		require_once 'dbh.inc.php';
		require_once 'Login_model.inc.php';
		require_once 'Login_contr.inc.php';
		
		//create_user($pdo);
		
		//ERROR HANDLERS
		$errors['empty_input'] = "";
		$errors['login_incorrect'] = "";
		
		if(is_input_empty($username,$pwd)){
			$errors['empty_input'] = "Fill in all fields!";
		}
		
		$result = get_user($pdo,$username);
		
		if(is_username_wrong($result)){
			$errors["login_incorrect"] = "Incorrect login info!";
		}
		if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
			$errors["login_incorrect"] = "Incorrect login info!";
		}
		
		echo json_encode($errors);
		
		
	} catch(PDOException $e){
		die("Query Failed: " . $e->getMessage());
	}
}