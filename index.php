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
		<title>WWDC Scholars</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="head">
			<h1>&#63743; WWDC</h1><h2>Scholars</h2>
		</div>
		<div class="container">
			<?php
				parse_str($_SERVER['QUERY_STRING']);
				if(!isset($page)){
					$page = 0;
				}
				$limit = 20;
				$query = new ParseQuery("scholars");
				$query->ascending("lastName");
				$query->limit($limit);
				$query->skip($page * $limit); 
				try{
					$results = $query->exists('objectId');
				}catch(ParseException $ex){
				}
				$scholars = $results->find();
			?>
			<?php
				if($page > 0){
			?>
			<a href="index.php?page=<?php echo $page - 1; ?>">
				<div class="pageLink">
					<- Previous Page
				</div>
			</a>
			<?php
				}
				if(count($scholars) == 20){
			?>
			<a href="index.php?page=<?php echo $page + 1; ?>">
				<div class="pageLink">
					Next Page ->
				</div>
			</a>
			<?php
				}
				for($i = 0; $i < count($scholars); $i++){
					$oliver= $scholars[$i];
					$imgUrl = $oliver->get("profilePic");
					echo '<a href="detail.php?page=' . $oliver->getObjectId() . '">';
					echo '<div class="square" style="background-image:url(\'';
					echo $imgUrl->getURL();
					echo '\');';
					if($i % 4 == 3){
						echo 'margin-right:0px;';
					}
					echo '">';
					echo '<h1>' . $oliver->get("firstName") . ' ' . $oliver->get('lastName') . '</h1>';
					echo '</div></a>';
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