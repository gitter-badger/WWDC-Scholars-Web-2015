<!DOCTYPE HTML>
<?php
	require 'vendor/autoload.php';
	use Parse\ParseClient;
	use Parse\ParseQuery;
	use Parse\ParseObject;
	use Parse\ParseFile;
	ParseClient::initialize('***REMOVED***', '***REMOVED***', '***REMOVED***');
?>
<html>
	<head>
		<?php
			parse_str($_SERVER['QUERY_STRING']);
			$query = new ParseQuery("scholars");
			try{
				$query->equalTo("objectId", $page);
				$result = $query->find();
			}catch(ParseException $ex){
			}
			$scholar = $result[0];
		?>
		<title>WWDC Scholar - <?php echo $scholar->get('firstName') . " " . $scholar->get('lastName'); ?></title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	</head>
	<body>
		<a href="index.php" style="text-decoration:none;">
			<div id="head">
				<h1>&#63743; WWDC</h1><h2>Scholars</h2>
			</div>
		</a>
		<div class="container">
		  <div class="third" style="min-height:330px;border-radius:10px; background-image:url('<?php echo $scholar->get('profilePic')->getURL();?>');">
		  </div>
			<div class="third" id="infoStuff"><h1><?php echo $scholar->get('firstName') . " " . $scholar->get('lastName') . ", " . $scholar->get('age');?></h1>
		
			  <p style="margin-top: -15px;">
			  <?php
			     if($scholar->get('numberOfTimesWWDCScholar') == '1'){
			  echo 'First time at WWDC!<br><br>';
			  }
			  else if($scholar->get('numberOfTimesWWDCScholar') != null){
			  echo 'Has  attended WWDC ' . $scholar->get('numberOfTimesWWDCScholar') . ' times<br><br>';
			  }
			 
			  ?>
			  </p>
			

  
			  <center>
			    <div class="social" style="margin-top: -20px;">
			      
				<?php
				   if($scholar->get('email') != null){
				echo '<a href="mailto:' . $scholar->get('email') . '"target="_blank"><img src="images/gmail.png" /></a>';
				}
				if($scholar->get('website') != null){
				echo '<a href="' . $scholar->get('website') .  '"target="_blank"><img src="images/picasa.png" /></a>';
				}
				if($scholar->get('twitter') != null){
				echo '<a href="' . $scholar->get('twitter') . '"target="_blank"><img src="images/twitter.png" /></a>';
				}
				if($scholar->get('linkedin') != null){
				echo '<a href="' . $scholar->get('linkedin') . '" target="_blank"><img src="images/linkedin.png" /></a>';
				}
				if($scholar->get('facebook') != null){
				echo '<a href="' . $scholar->get('facebook') . '" target="_blank"><img src="images/facebook.png" /></a>';
				}
				?>
				
			    </div>
			  </center>

			  <center>
			  <p class="lead"><?php echo $scholar->get('shortBio');?></p>
			  </center>
			  
			 <?php 
			    if ($scholar->get('itunes') != null) {
			      echo '<a href="' . $scholar->get('itunes') . '" target="_blank"><img style="height: 70px; margin-top: 20px;" src="http://www.mosa.nl/files/8613/8668/4836/available-in-app-store-badge.png" /></a>';
			    }
			 ?>

			</div>

<!--
			<div class="third">
				<h2>&#63743; Apple Details</h2>
				<p>
				<?php
					if($scholar->get('numberOfTimesWWDCScholar') == '1'){
						echo 'First time at WWDC!<br><br>';
					}
					else if($scholar->get('numberOfTimesWWDCScholar') != null){
						echo 'Has attended WWDC ' . $scholar->get('numberOfTimesWWDCScholar') . ' times<br><br>';
					}
					if($scholar->get('itunes') != null){
						echo '<a href="' . $scholar->get('itunes') . '" target="_blank">iTunes Store Page</a><br><br>';
					}
					if($scholar->get('githubLinkApp') != null){
						echo '<a href="' . $scholar->get('githubLinkApp') . '" target="_blank">WWDC App on Github</a><br><br>';
					}
					if($scholar->get('videoLink') != null){
						echo '<a href="' . $scholar->get('videoLink') . '" target="_blank">WWDC App Video</a><br><br>';
					}
				?>
				</p>
			</div>
-->



	
		</div>
		<?php
			 if($scholar->get('screenshotOne') != null){
		?>
		<div class="container">
			<h1>
				&#63743; WWDC 15 Application
			</h1>
			<div id="screenshotsWrap">
				<div id="screenshots">
					<img src="<?php echo $scholar->get('screenshotOne')->getURL(); ?>">
					<?php
						$screenshots = array("screenshotTwo", "screenshotThree", "screenshotFour");
						foreach($screenshots as $shot){
							if($scholar->get($shot) != null){
								echo '<img src="' . $scholar->get($shot)->getURL() . '">';
							}
						}
					?>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</body>
</html>
