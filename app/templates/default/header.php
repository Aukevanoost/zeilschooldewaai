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
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<div id="HeaderMask">
		<div class="container">
			<div class="Right" id="socialmedia">
				<i class="fa fa-facebook-official fa-lg"></i>
				<i class="fa fa-twitter-square fa-lg"></i>
				<i class="fa fa-instagram fa-lg"></i>

			</div>
			<a href="home"><img src="/zeilschooldewaai/app/templates/default/img/logo.png" id="Logo" /></a>
		</div>
	</div>
</div>
<div id="navbar">
	<div class="container">
<?php
	   if (\Helpers\Session::get('rechten')==2) { ?>
        <div class="Left">
			<a href="beheerklanten"><div class="NavItem <?php if($data['title'] == 'beheer klanten'){echo 'active';} ?>">Beheer Klanten</div></a>
			<a href="beheerboten"><div class="NavItem <?php if($data['title'] == 'beheer boten'){echo 'active';} ?>">Beheer Boten</div></a>
			<a href="beheercursussen"><div class="NavItem <?php if($data['title'] == 'beheer cursussen'){echo 'active';} ?>">Beheer Cursussen</div></a>
			<a href="beheerinstructeurs"><div class="NavItem <?php if($data['title'] == 'beheer instructeurs'){echo 'active';} ?>">Beheer Instructeurs</div></a>
			<a href="cursistkoppelen"><div class="NavItem <?php if($data['title'] == 'cursisten koppelen'){echo 'active';} ?>">Cursist Koppelen</div></a>

		</div>
		      <!-- Admin menu -->
              <?php } elseif (\Helpers\Session::get('rechten')==3 ) { ?>
         <div class="Left">
              <a href="beheer"><div class="NavItem <?php if($data['title'] == 'beheer'){echo 'active';} ?>">Beheer</div></a>            
        </div>
        
			<!-- Normale menu items.-->
      <?php } else { ?>
         <div class="Left">
              <a href="home"><div class="NavItem <?php if($data['title'] == 'Home'){echo 'active';} ?>">Home</div></a>
              <a href="overons"><div class="NavItem <?php if($data['title'] == 'Over ons'){echo 'active';} ?>">Over ons</div></a>
              <a href="boten"><div class="NavItem <?php if($data['title'] == 'Boten'){echo 'active';} ?>">Boten</div></a>
              <a href="cursussen"><div class="NavItem <?php if($data['title'] == 'Cursussen'){echo 'active';} ?>">Cursussen</div></a>
              <a href="contact"><div class="NavItem <?php if($data['title'] == 'Contact'){echo 'active';} ?>">Contact</div></a>
        </div>
    <?php } ?>  
		<div class="Right">
            
            
		<?php
		//Andere menu item als er een login geset is.
		if (\Helpers\Session::get('id')) {
			?>
			<a href="loguit"><div class="NavItem"><i class="fa fa-lock"></i> Uitloggen</div></a>
			<?php
				if (\Helpers\Session::get('rechten')==1) {
			?>
			<a href="profiel"><div class="NavItem <?php if($data['title'] == 'Profiel'){echo 'active';} ?>"><i class="fa fa-user"></i> Profiel</div></a>
			<?php
				}
				else
				{
			?>

			<?php
				}
		}
		//Normale menu items.
		else{ ?>
			<a href="login"><div class="NavItem <?php if($data['title'] == 'Login'){echo 'active';} ?>"><i class="fa fa-lock"></i> Ik ben al klant</div></a>
			<a href="registreren"><div class="NavItem <?php if($data['title'] == 'Registreren'){echo 'active';} ?>"><i class="fa fa-info-circle"></i> Klant worden</div></a>

			<?php 

			} ?>
		<!--<i class="fa fa-lock"></i>-->
		</div>
		<div id="ResponsiveLogo">De Waai | <?= $data['title']  ?></div>
		<div id="ResponsiveTrigger"></div>
	</div>
	<div class="responsiveMenu">
	<?php
		if (\Helpers\Session::get('rechten')==2) { ?>
			<a href="beheerklanten"><div class="ResponsiveItem">Beheer Klanten</div></a>
			<a href="beheerboten"><div class="ResponsiveItem">Beheer Boten</div></a>
			<a href="beheercursussen"><div class="ResponsiveItem">Beheer Cursussen</div></a>
			<a href="beheerinstructeurs"><div class="ResponsiveItem">Beheer Instructeurs</div></a>
			<a href="cursistkoppelen"><div class="ResponsiveItem">Cursist Koppelen</div></a>
		<?php }elseif (\Helpers\Session::get('rechten')==3 ) { ?>
			<a href="beheer"><div class="ResponsiveItem">Beheer</div></a> 
		<?php } else { ?>
			<a href="home"><div class="ResponsiveItem">Home</div></a>
			<a href="overons"><div class="ResponsiveItem">Over ons</div></a>
			<a href="boten"><div class="ResponsiveItem">Boten</div></a>
			<a href="cursussen"><div class="ResponsiveItem">Cursussen</div></a>
			<a href="contact"><div class="ResponsiveItem">contact</div></a>
		<?php } ?>

		<?php
		//Andere menu item als er een login geset is.
		if (\Helpers\Session::get('id')) {
			?>
			<a href="loguit"><div class="ResponsiveItem">Uitloggen</div></a>
			<?php
				if (\Helpers\Session::get('rechten')==1) {
			?>
			<a href="profiel"><div class="ResponsiveItem">Profiel</div></a>
			<?php
				}
		}
		//Normale menu items.
		else{ ?>
			<a href="login"><div class="ResponsiveItem">Ik ben al klant</div></a>
			<a href="registreren"><div class="ResponsiveItem">Klant worden</div></a>

			<?php 

			} ?>


	</div>
</div>
<div class="container page">
