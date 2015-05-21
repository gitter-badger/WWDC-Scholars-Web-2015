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
	</head>
	<body>
		<div id="head">
			<h1>&#63743; WWDC</h1><h2>Scholars</h2>
		</div>
		<div class="container">
			<h1><?php echo $scholar->get('firstName') . " " . $scholar->get('lastName');?></h1>
		</div>
	</body>
</html>
