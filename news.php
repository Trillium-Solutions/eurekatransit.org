<?php
require_once ('postgres_connect.php');

		// Prepare a query for execution
		$news_result = pg_prepare($dbc, "news_query", 'select title,body from news where news_id=$1');

		// Execute the prepared query.  Note that it is not necessary to escape
		// the string "Joe's Widgets" in any way
		$news_result = pg_execute($dbc, "news_query", array($_GET['id']));
		

while ($row = db_fetch_array($news_result, MYSQL_ASSOC)) {
$title = $row['title'];
$body = $row['body']; }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
<link rel="icon" type="image/png" href="http://www.hta.org/images/icon.png"/>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title><?php echo $title; ?> | Eureka Transit Service</title>
		<link href="css/main.css" rel="stylesheet" type="text/css" media="all" />

<style type="text/css">
#instruction {float:left; width:200px;height:300px;margin-left:10px;margin-right:10px;}
li {margin-left:20px; padding-right:7px;}
#zone_name {text-align:center; font-size:20px; line-height:25px; width:40px; font-weight:bold;padding:0px}
td {border-bottom:1px solid #ccc;padding:1px;padding-right:10px}
#page_title {font-size:16px;font-weight:bold;text-align:left;padding:25px 0px 0px 17px;margin:0px}
</style>

<script type="text/javascript">
</script>

</head>

<body>

<a href="#Content" class="hidden">Skip to Content</a>
<div id="Container">
<div id="ContentWrapper">




<div id="logo_header">
<a href="index.php"><img src="images/ets_logo.gif" alt="" border="0" width="206" height="81" /></a>
</div>

<div id="header_area">

<div id="nav_path"><a href="index.php">ETS Home</a> ></div>

<br clear="left"/>

<h1 id="page_title">
<?php


echo $title;

?>
</h1>
</div>

<br clear="all">

<hr size="2"  width="784" style="padding-left:10px;padding-right:10px;">

<div id="page_text_itself">

<?php

echo $body;

?>



</div>

</div>
<br clear="all" />
</div>

<?php require_once ('includes/footer.html'); ?>


</body>

</html>