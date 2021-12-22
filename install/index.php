<?php
error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.
$db_config_path = '../app/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {
	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();
	
	// Validate the post data
	if($core->validate_post($_POST) == true)
	{
		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}


		// If no errors, redirect to registration page
		if(!isset($message)) {
		  	$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
			$redir .= "://".$_SERVER['HTTP_HOST'];
			$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
			$redir = str_replace('install/','',$redir); 
			header( 'Location: ' . $redir . 'siteConfig' );
		}
	}
	else 
	$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Common Codignator Install Setup</title>
    <link rel="stylesheet" href="../public/assets/install/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Setup Website</h1>
        </div>
    </div> 
	<div class="container">
		<div class="row">
		
			<?php if(is_writable($db_config_path)){?>

				<?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>

				<form id="install_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<h4>DB Configs</h4>
					<div class="tab">
						<p><input placeholder="Host Name" class="form-control" id="hostname" name="hostname" value="localhost" required></p>
						<p><input placeholder="Username" class="form-control" id="username" name="username" value="root" required></p>
						<p><input placeholder="Password" id="password" class="form-control" name="password" ></p>
						<p><input placeholder="Database Name" id="database"  class="form-control" name="database" required></p>
					</div>
					<button type="submit" id="submit" class="form-control btn btn-primary">Next <i class="fas fa-arrow-right"></i></button>
				</form>

			<?php } else { ?>
			<p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
			<?php } ?>
			</div>
		</div>
	</body>
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/install/js/install.js"></script>
</html>
