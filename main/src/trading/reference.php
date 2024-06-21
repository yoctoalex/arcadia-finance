<?php
	if(empty($_GET['user_name']) || empty($_GET['email']) || empty($_GET['bank_id']))
	{
		header('HTTP/1.1 500 No Variables');
		exit();
	}
	
	$user_name = $_GET['user_name'];
	$bank_id = $_GET['bank_id'];
	$email = $_GET['email'];
	
	$query = '{"email":"'.$email.'","dir":"1","bank_id":"'.$bank_id.'","user_name":"'.$user_name.'"}';
	
	$url = getenv('REFER_A_FRIEND_MODULE_URL');
	if (empty($url)) {
		$url = 'http://app3';
	}
	$url = $url.'/app3/record_request.php';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
	$result = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	
	
	if ($info["http_code"] == "200")
	{
		echo $result;
	}
	if ($info["http_code"] == "501")
	{
		header('HTTP/1.1 500 Wrong Format');
		exit();
	}	


?>
