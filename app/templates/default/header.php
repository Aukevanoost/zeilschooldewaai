<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<?php
	//hook for plugging in meta tags
	$hooks->run('meta');
	?>
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/Core/Config.php ?></title>

	<!-- CSS -->
	<?php
	Assets::css(array(
		'//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
		'//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
		Url::templatePath() . 'css/header.css',
		Url::templatePath() . 'css/footer.css',
		Url::templatePath() . 'css/style.css',

	));

	//hook for plugging in css
	$hooks->run('css');
	?>

</head>
<body>
<?php
//hook for running code after body tag
$hooks->run('afterBody');
?>


<!-- Header -->
<div id="HeaderImg">
	<div class="container">
		<div class="Right" id="socialmedia">
			<i class="fa fa-facebook-official fa-lg"></i>
			<i class="fa fa-twitter-square fa-lg"></i>
			<i class="fa fa-instagram fa-lg"></i>

		</div>
		<img src="/zeilschooldewaai/app/templates/default/img/logo.png" id="Logo" />
	</div>
</div>
<div id="navbar">
	<div class="container">
		<div class="Left">
			<a href="home"><div class="NavItem <?php if($data['title'] == 'Home'){echo 'active';} ?>">Home</div></a>
			<a href="boten"><div class="NavItem <?php if($data['title'] == 'Boten'){echo 'active';} ?>">Boten</div></a>
			<a href="cursussen"><div class="NavItem">Cursussen</div></a>
			<a href="contact"><div class="NavItem <?php if($data['title'] == 'Contact'){echo 'active';} ?>">Contact</div></a>
		</div>
		<div class="Right">
			<a href="login"><div class="NavItem <?php if($data['title'] == 'Login'){echo 'active';} ?>"><i class="fa fa-lock"></i> Ik ben al klant</div></a>
			<a href="registreren"><div class="NavItem <?php if($data['title'] == 'Registeren'){echo 'active';} ?>"><i class="fa fa-info-circle"></i> Klant worden</div></a>
			<!--<i class="fa fa-lock"></i>-->
		</div>
	</div>
</div>
<div class="container page">
