<!DOCTYPE HTML>
<?php
	require 'vendor/autoload.php';
	use Parse\ParseClient;
	use Parse\ParseQuery;
	use Parse\ParseObject;
	use Parse\ParseFile;
	ParseClient::initialize('16ktYTkz6kuPyT81SZtxP4CXDV0POwVV5szF7kYP', '8Wl6GsCO7LuLB5z8maqM4kDfZb5RLxXkmjMKvJE7', 'ReDjNKcHwfwfIThkaNP9FpXU1nSESclaSjqVTIto');
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
			<h1><?php echo $scholar->get('firstName') . " " . $scholar->get('lastName');?></h1>
			<div class="third">
				<h2>&#63743;Apple Details</h2>
				<p>
				<?php
					if($scholar->get('numberOfTimesWWDCScholar') == '1'){
						echo 'First time at WWDC!<br><br>';
					}
					else if($scholar->get('numberOfTimesWWDCScholar') != null){
						echo 'Has  attended WWDC ' . $scholar->get('numberOfTimesWWDCScholar') . ' times<br><br>';
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
			<div class="third" style="min-height:330px;background-image:url('<?php echo $scholar->get('profilePic')->getURL(); ?>');border-radius:32px;">
			</div>
			<div class="third">
				<h2>Contact Details</h2>
				<p>
				<?php
					if($scholar->get('email') != null){
						echo '<a href="mailto:' . $scholar->get('email') . '"target="_blank">Email</a><br><br>';
					}
					if($scholar->get('website') != null){
						echo '<a href="' . $scholar->get('website') .  '"target="_blank">Website</a><br><br>';
					}
					if($scholar->get('twitter') != null){
						echo '<a href="' . $scholar->get('twitter') . '"target="_blank">Twitter</a><br><br>';
					}
					if($scholar->get('linkedin') != null){
						echo '<a href="' . $scholar->get('linkedin') . '" target="_blank">LinkedIn</a><br><br>';
					}
					if($scholar->get('facebook') != null){
						echo '<a href="' . $scholar->get('facebook') . '" target="_blank">Facebook</a><br><br>';
					}
				?>
				</p>
			</div>
		</div>
		<?php
			 if($scholar->get('screenshotOne') != null){
		?>
		<div class="container">
			<h1>
				&#63743;WWDC 15 App Screenshots
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
