<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Config</title>
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
				<form id="install_form" method="POST" action="<?= base_url('addSiteConfigs') ?>">
					<h4>Site Details</h4>
					<div class="tab">
						<p><input placeholder="Site name" class="form-control" name="sitename" value="My Website" required></p>
						<p><input placeholder="Footer Text" class="form-control" name="footertext" value="Designed and developed by My Developer" required></p>
						<p><input placeholder="Smtp Email" class="form-control" name="smtpEmail"></p>
						<p><input placeholder="Smtp Password" class="form-control" name="smtpPassword"></p>
						<p><input placeholder="Smtp HostName" class="form-control" name="smtpHost"></p>
					</div>
					<button type="submit" id="submit" class="form-control btn btn-primary">Next <i class="fas fa-arrow-right"></i></button>
				</form>
			</div>
		</div>
	</body>
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/install/js/install.js"></script>
</html>
