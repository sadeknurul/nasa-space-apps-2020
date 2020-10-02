<?php

//helper functions
date_default_timezone_set('Asia/Dhaka');
function last_id() {
	global $connection;
	return mysqli_insert_id($connection);
}

function set_message($msg) {
	if(!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function redirect($location){
	header("Location: $location");
}

function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result){
	global $connection;
	if(!$result){
		die("QUERY FAILED" . mysqli_error($connection));
	}
}

function escape_string($string){
	global $connection;
	return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result){

	return mysqli_fetch_array($result);
}


  // getting the user IP address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}


/*********** Back end here ***********/

function datas()
{
	$query = query( "SELECT * FROM data ORDER by id DEsc");
	$rows = mysqli_num_rows($query);
	if ($rows > 0) {
		$i = 0;
		while ($row = fetch_array($query)) {
			$i += 1;
			$status = $row['status'] == 0? '<span class="badge badge-danger">under review</span> ':'<span class="badge badge-success">processed</span> ';
			if ($row['status'] == 0) {
				$options = '<option value="0" selected>under review</option><option value="1">processed</option>';
			}
			if ($row['status'] == 1) {
				$options = '<option value="0">under review</option><option value="1" selected>processed</option>';
			}
			$data = <<<DELIMETER
			<tr>
					<td>{$i}</td>
					<td>{$row['name']}</td>
					<td>{$row['phone']}</td>
					<td>{$status}</td>
					<td>{$row['date_time']}</td>
					<td><a href="#view{$row['id']}" data-toggle="modal">View</a></td>
			</tr>
			<!-- View Modal -->
			<div class="modal fade" id="view{$row['id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Request Details</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
						<form method="post">
				      <div class="modal-body">
				        <div class="form-group">
									<input type="hidden" name="id" value="{$row['id']}" class="form-control" />
								</div>
								<div class="form-group">
									<p>Name : {$row['name']}</p>
								</div>
								<div class="form-group">
									<p>Phone : {$row['phone']}</p>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										{$options}
									</select>
								</div>
								<div class="form-group">
									<label>Details</label>
									<p style='background-color:green;color:white;padding:20px 20px;'><span>{$row['details']}</span></p>
								</div>
								<div class="form-group">
									<label>Location</label>
									<iframe src="https://maps.google.com/maps?q={$row['lat_long']}&output=embed" width="100%" height="500"></iframe>
								</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" name="data_update" class="btn btn-primary">Save changes</button>
				      </div>
						</form>
			    </div>
			  </div>
			</div>
DELIMETER;
			echo $data;
		}
	}
}

function datas_routed()
{
	$query = query( "SELECT * FROM data ORDER by id DEsc");
	$rows = mysqli_num_rows($query);
	if ($rows > 0) {
		$i = 0;
		while ($row = fetch_array($query)) {
			$i += 1;
			$status = $row['status'] == 0? '<span class="badge badge-danger">under review</span> ':'<span class="badge badge-success">processed</span> ';
			if ($row['status'] == 0) {
				$options = '<option value="0" selected>under review</option><option value="1">processed</option>';
			}
			if ($row['status'] == 1) {
				$options = '<option value="0">under review</option><option value="1" selected>processed</option>';
			}
			$data = <<<DELIMETER
			<tr>
					<td>{$i}</td>
					<td>{$row['name']}</td>
					<td>{$row['phone']}</td>
					<td>{$status}</td>
					<td>Jatrabari Thana</td>
					<td>{$row['date_time']}</td>
					<td><a href="#view{$row['id']}" data-toggle="modal">View</a></td>
			</tr>
			<!-- View Modal -->
			<div class="modal fade" id="view{$row['id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Request Details</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
						<form method="post">
				      <div class="modal-body">
				        <div class="form-group">
									<input type="hidden" name="id" value="{$row['id']}" class="form-control" />
								</div>
								<div class="form-group">
									<p>Name : {$row['name']}</p>
								</div>
								<div class="form-group">
									<p>Phone : {$row['phone']}</p>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										{$options}
									</select>
								</div>
								<div class="form-group">
									<label>Details</label>
									<p style='background-color:green;color:white;padding:20px 20px;'><span>{$row['details']}</span></p>
								</div>
								<div class="form-group">
									<label>Location</label>
									<iframe src="https://maps.google.com/maps?q={$row['lat_long']}&output=embed" width="100%" height="500"></iframe>
								</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" name="data_update" class="btn btn-primary">Save changes</button>
				      </div>
						</form>
			    </div>
			  </div>
			</div>
DELIMETER;
			echo $data;
		}
	}
}

function data_update()
{
	if (isset($_POST['data_update'])) {
		$id = $_POST['id'];
		$status = $_POST['status'];
		$query = query("UPDATE data SET status = '$status' WHERE id = '$id'");
		confirm($query);
		echo "<h2 class='text-success'>Status Updated</h2>";

	}
}


function login_admin()
{
	if (isset($_POST['login'])) {
		$username = escape_string($_POST['username']);
		$password = md5(escape_string($_POST['password']));
		$query = query("SELECT * FROM admins WHERE username = '$username' AND password = '$password'");
		confirm($query);
		$rows = mysqli_num_rows($query);
		if ($rows > 0) {
			$_SESSION['username'] = $username;
			redirect("../admin");
		}
		else {
			echo "<h3 style='color:white;'>Username or Password is wrong !</h3>";
		}
	}
}
















?>
