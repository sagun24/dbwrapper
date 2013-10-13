<?php 
//uncomment if you want to use mysqli as your wrapper i prefer pdo.
/*require_once('mysqli.class.php');
	$users = DB::getInstance()->query('SELECT * FROM users');
	if($users->count())
	{
		foreach ($users->results() as $user) {
				echo $user->username;
				echo "<br>";	
			}
	}*/
?>

<?php 
	require_once('pdo.class.php');
	$users = DB::getInstance()->query('SELECT * FROM users');
	if($users->count())
	{
		foreach ($users->results() as $user) {
				//use is case fetch is used echo $user['username'];
				//we will do it the object oriented way
				echo $user->username;
				echo "<br>";	
			}
	}



/*	
	// test for insert and usage
	$data['username'] = "test";
	$data['password'] = "test";
	$data['first_name'] = "test";
	$data['last_name'] = "test";
	$data['previlage'] = 2;
	$data['email'] = "test";
	if($insert_id = DB::getInstance()->insert($data,'users'))
	{
		echo $insert_id;
	}
*/


/*
	// test for the update and usage
	$data['username'] = "update";
	$data['password'] = "update";
	$data['first_name'] = "update";
	$data['last_name'] = "update";
	$data['previlage'] = 3;
	$data['email'] = "update";
	if(DB::getInstance()->update($data,'users','user_id = 1'))
	{
		echo 'Updated';
	}
*/


/*
	// test for the delete and usage
	if(DB::getInstance()->delete('users','user_id = 2'))
	{
		echo 'deleted';
	}

*/
?>	
