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
?>	
