<!DOCTYPE HTML>
<?php
	include('keys.php');
	require 'vendor/autoload.php';
	use Parse\ParseClient;
	use Parse\ParseQuery;
	use Parse\ParseObject;
	use Parse\ParseFile;
	ParseClient::initialize($app_id, $rest_key, $master_key);
?>
<html>
	<head>
		<title>WWDC Scholars</title>
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
			<?php
				//DETERMINE CORRECT PEOPLE TO LOAD, GIVEN PAGE
				parse_str($_SERVER['QUERY_STRING']);
				if(!isset($page)){
					$page = 0;
				}
				$limit = 24;

				//LOAD DATA FROM PARSE
				$query = new ParseQuery("scholars");
				$query->ascending("lastName");
				$query->limit($limit);
				$query->skip($page * $limit); 
				try{
					$results = $query->exists('objectId');
				}catch(ParseException $ex){
				}
				$scholars = $results->find();

				//DISPLAY DATA ON SCREEN
				for($i = 0; $i < count($scholars); $i++){
					$oliver= $scholars[$i];
					$imgUrl = $oliver->get("profilePic");
					echo '<a href="detail.php?page=' . $oliver->getObjectId() . '">';
					echo '<div class="square" style="background-image:url(\'';
					echo $imgUrl->getURL();
					echo '\');';
					echo '">';
					echo '<h1>' . $oliver->get("firstName") . ' ' . $oliver->get('lastName') . '</h1>';
					echo '</div></a>';
				}
			?>
			<?php
				//IF NOT PAGE 0, SHOW PREVIOUS PAGE BUTTON
				if($page > 0){
			?>
			<a href="index.php?page=<?php echo $page - 1; ?>">
				<div class="pageLink left">
					&laquo; Previous
				</div>
			</a>
			<?php
				}
				else{
					echo '<style>.pageLink{ width:100%; }</style>';
				}
				if(count($scholars) == $limit){
			?>
			<a href="index.php?page=<?php echo $page + 1; ?>">
				<div class="pageLink right">
					Next &raquo;
				</div>
			</a>
			<?php
				}
				else{
					echo '<style>.pageLink{ width:100%; }</style>';
				}
			?>
		</div>
		<div class="container">
			<h1>Are you a <b>&#63743; WWDC</b>15 scholarship winner?</h1>
			<p>Congratulations! We'll see you on June 7<sup>th</sup> for the Scholarship Orientation Session! For now, you can join us all on <a href="https://www.facebook.com/groups/477629149059210" target="_blank"> Facebook</a>!</p>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
