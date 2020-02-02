<?php
include("class_db.php");
$mysql = new Main_db;
$mysql->Connect_db(); //เชื่อมต่อdb
$mysql->SetCharacter();
$cmd = isset($_POST["command"]) ? $_POST["command"] : "";

if ($cmd != "") {

	//Signup
	if ($cmd == "signup") {
		$firstName = $_POST['Fname'];
		$lastName = $_POST['Lname'];
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$confirm_password = $_POST['Conpass'];
		$oldpassword =  $_POST['oldpassword'];
		$has_same_username = $mysql->Check_same('tbl_member','member_username',$username);
		if(!$has_same_username){
			$arr = array( 
				"member_username"=> $username,
				"member_password"=> password_hash($password, PASSWORD_BCRYPT, array('cost'=>12)),
				"member_firstname"=> $firstName,
				"member_lastname"=> $lastName
				);
			$mysql->Insert_db($arr,"tbl_member"); //Check echo >>>> arr,ชื่อtable(พว่งหับ $tableName ใน Class_db.php)
			$check = array('check' => 1);
			
		}else{
			$check = array('check' => 0);
		}
		echo json_encode($check);
		exit();
		$mysql->Close_db();
	}
	//login
	if ($cmd == "login") {
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$result = $mysql->login($username);

		if(password_verify($password,$result['member_password'])){
			session_start();
		    $_SESSION['getUsername'] = $result['member_username'];
			$_SESSION['getId'] = $result['member_id'];
			$_SESSION['getPassword'] = $result['member_password'];

			// $timestamp = array(
			// 				'h_user_id' => $result['h_user_id'],
			// 				'h_user_login' =>  date('Y-m-d H:i:s')
			// 			);
			//$key_user = array("h_user_id");
			//$mysql->Update_db($timestamp,$key_user,"h_user");
			$check = 1;
		}
		else{
			$check = 0;
		}
		echo json_encode($check_login = array('check' => $check ));
		$mysql->Close_db();
	}

	//logout
	if ($cmd == "logout") {
		session_start() ;
		session_destroy();
	}

	//query_lessonlist
	if ($cmd == "query_lessonlist") {
		$sql = "SELECT * FROM tbl_lesson";
		$result = $mysql->select_db($sql);

		foreach ($result as $read) {
			$arr[] = array(
				'lesson_id' => $read['lesson_id'],
				'lesson_name' => $read['lesson_name'],
				'lesson_desc' => $read['lesson_desc'],
				'lesson_intro_mp4' => $read['lesson_intro_mp4'],
				'lesson_content_mp4' => $read['lesson_content_mp4'],
				'lesson_urlname' => $read['lesson_urlname']);
		}
		echo json_encode($arr);
	}

	//select_lesson
	if ($cmd == "select_lesson") {
		$id = $_POST['lesson_id'];
		$sql = "SELECT * FROM tbl_lesson WHERE lesson_id = ".$id."";
		$read = $mysql->Select_db_one($sql);

		$arr = array(
			'lesson_id' => $read['lesson_id'],
			'lesson_name' => $read['lesson_name'],
			'lesson_desc' => $read['lesson_desc'],
			'lesson_intro_mp4' => $read['lesson_intro_mp4'],
			'lesson_content_mp4' => $read['lesson_content_mp4'],
			'lesson_urlname' => $read['lesson_urlname']);
		echo json_encode($arr);
	}

	//update_lesson
	if ($cmd == "update_lesson") {

		$sql_checkurl = "SELECT lesson_urlname FROM tbl_lesson WHERE lesson_urlname LIKE '".$_POST['lesson_urlname_edit_field']."'";
		$result = $mysql->numRows($sql_checkurl);

		if($_POST['current_videoIntro'] !=="" && $_POST['lesson_videoIntro_edit_field'] !=="" && $_POST['current_videoIntro'] !== $_POST['lesson_videoIntro_edit_field']){
			unlink($_POST['current_videoIntro']);
		}

		$arr = array( //field ต่างๆ
				"lesson_id"=> $_POST['lesson_id'],
				"lesson_name"=> $_POST['lesson_name_edit_field'],
				"lesson_desc"=> $_POST['lesson_desc_edit_field'],
				"lesson_intro_mp4"=> $_POST['lesson_videoIntro_edit_field'],
				"lesson_content_mp4"=> $_POST['lesson_videoContent_edit_field'],
				'lesson_urlname' => $_POST['lesson_urlname_edit_field']);

		$key = array("lesson_id");
		$check = $mysql->Update_db($arr,$key,"tbl_lesson");

		if ($result == 0 && $_POST['lesson_urlname_edit_field'] !== "" && !file_exists("../".$_POST['lesson_urlname_edit_field'].".html")) {
			$template = file_get_contents("template.html");
			$myfile = fopen("../".$_POST['lesson_urlname_edit_field'].".html", "w+");
			fwrite($myfile,$template); fclose($myfile);
		}

		echo json_encode($check);
	}

	//add_lesson
	if ($cmd == "add_lesson") {
		$sql_checkurl = "SELECT lesson_urlname FROM tbl_lesson WHERE lesson_urlname LIKE '".$_POST['lesson_urlname']."'";
		$result_check = $mysql->numRows($sql_checkurl);

		$arr = array( 
				"lesson_name"=> mysql_real_escape_string($_POST['lesson_name']),
				"lesson_desc"=> mysql_real_escape_string($_POST['lesson_desc']),
				"lesson_intro_mp4"=> $_POST['lesson_videoIntro'],
				"lesson_content_mp4"=> $_POST['lesson_videoContent'],
				'lesson_urlname' => $_POST['lesson_urlname']
				);
		$mysql->Insert_db($arr,"tbl_lesson");

		if ($result_check == 0 && $_POST['lesson_urlname'] !== "" && !file_exists("../".$_POST['lesson_urlname'].".html")) {
			$template = file_get_contents("template.html");
			$myfile = fopen("../".$_POST['lesson_urlname'].".html", "w+");
			fwrite($myfile,$template); fclose($myfile);
		}
	}

	//delete_lesson
	if ($cmd == "delete_lesson") {
		if($_POST['deleteall'] == 1){
			$sql_checkurl = "SELECT lesson_urlname, lesson_intro_mp4, lesson_content_mp4 FROM tbl_lesson WHERE lesson_id = '".$_POST['lesson_id']."'";
			$read = $mysql->Select_db_one($sql_checkurl);
			if($read['lesson_urlname'] !== ""){
				unlink("../".$read['lesson_urlname'].".html");
				unlink($read['lesson_intro_mp4']);
				unlink($read['lesson_content_mp4']);
			}
		}

		$sql = "DELETE FROM tbl_lesson WHERE lesson_id = '".$_POST['lesson_id']."'";
		$check = $mysql->Delete_db($sql);
		$mysql->Close_db();
	}

	//upload Intro
	if ($cmd == "upload_video"){
		$targetDir = "../upload/video";
		$targetDir_inside = "../upload/video";
	    $tempFile = $_FILES['fileUpload']['tmp_name'];
	    $Filename = uniqid()."-".$_FILES['fileUpload']['name'];
	    $targetFile =  $targetDir_inside."/".$_POST['directory']."/".$Filename ;
	    try {
	    	move_uploaded_file($tempFile,$targetFile);
	    	$result = array('status' => 'ok', 'File_direct' => $targetFile, 'tempFile' => $tempFile);
	    } catch (Exception $e) {
	    	$result = array('status' => 'error', 'File_direct' => $targetFile, 'tempFile' => $tempFile);
	    }
		echo json_encode($result);
	}

	//delete_currentIntroVideo
	if ($cmd == "delete_currentIntroVideo") {
		$sql = "SELECT lesson_intro_mp4 FROM tbl_lesson WHERE lesson_id = ".$_POST['lesson_id']."";
		$read = $mysql->Select_db_one($sql);
		unlink($read['lesson_intro_mp4']);

		$arr = array( //field ต่างๆ
				"lesson_id"=> $_POST['lesson_id'],
				"lesson_intro_mp4"=> ""
			);

		$key = array("lesson_id");
		$check = $mysql->Update_db($arr,$key,"tbl_lesson");
	}

	//delete_currentIntroVideo_add
	if ($cmd == "delete_currentIntroVideo_add") {
		unlink($_POST['url']);
	}

	//connectVideo
	if ($cmd == "connectVideo") {
		$sql = "SELECT lesson_intro_mp4 FROM tbl_lesson WHERE lesson_urlname LIKE '".$_POST['urlname']."'";
		$read = $mysql->Select_db_one($sql);
		$result = array("intro_mp4_url" => $read['lesson_intro_mp4']);
		echo json_encode($result);
	}

}
?>