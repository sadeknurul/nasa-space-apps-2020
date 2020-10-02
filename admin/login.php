<?php require_once("../php/config.php");?>

<!DOCTYPE HTML>

<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/login_style.css" media="all" />
</head>
<body>

	<div class="login">
	<h1>Admin Login</h1>
	<h2 class="text-center bg-warning" style="color:white;font-size:25px;text-align:center;"><?php display_message(); ?></h2>
    <form method="post">
	<?php login_admin(); ?>
    	<input type="text" name="username" placeholder="Username" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login</button>
    </form>
</div>
</body>
</html>
