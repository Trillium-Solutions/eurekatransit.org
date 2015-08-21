<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
<link rel="icon" type="image/png" href="http://www.hta.org/images/icon.png"/>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Eureka Transit Service Schedules</title>
		<link href="../css/main.css" rel="stylesheet" type="text/css" media="all" />

<style type="text/css">
#instruction {float:left; width:200px;height:300px;margin-left:10px;margin-right:10px;}
li {margin-left:20px; padding-right:7px;}
#route_name {font-size:50px;font-weight:bold;}
td {padding-right:30px;}
</style>

<script type="text/javascript">
</script>

</head>

<body>

<a href="#Content" class="hidden">Skip to Content</a>
<div id="Container">
<div id="ContentWrapper">




<div id="logo_header">
<a href="../"><img src="../images/ets_logo.gif" border="0" width="206" height="81" /></a>
</div>

<div id="header_area">

<div id="nav_path"><a href="../">ETS Home</a> ></div>

<br clear="left"/>

<h1 id="page_title">Schedules</h1>

</div>

<br clear="all">

<div id="page_text_itself" style="width:670;margin-left:3px; border-top:1px solid black;padding-left:30px; padding-top:30px">


<h3>Browser viewable schedules - <i><u>Updated March 4, 2013</u></i></h3>



<ul>
<li><a href="ets_weekday_Mar_2013.html"><strong>Weekday service (Mon-Fri):</strong> Red, Green, Gold and Purple routes</a></li>
<li><a href="ets_weekend_Mar_2013.html"><strong>Weekend service (Saturday):</strong> Gold, Purple and Rainbow routes</a></li>
</ul>

<h3>Printed schedules</h3>

<blockquote>

<p><a href="print/eureka_transit_schedule.PNG">Download ETS schedule (printed format, PNG image)</a></p>
</blockquote>




<?php 

require_once ('../postgres_connect.php');

$service_update_query = "select news_id,title from news where news_category_id=1 and agency_id = 2 and start_date < now() and end_date > now() order by start_date desc";
$service_update_result = db_query($service_update_query);

?>


<h3>Service updates</h3>

<?php

if (db_num_rows($service_update_result) != 0) {

echo "<ul>";

while ($row = db_fetch_array($service_update_result, MYSQL_ASSOC)) {
echo "<li><a href=\"../news.php?id=".$row['news_id']."\">".$row['title']."</a></li>";}
echo "</ul>";

}

else {echo "<p><i>There are no current service updates.</i></p>";}

?>

<h3>Holidays</h3>

<blockquote><a href="holidays.html">Calendar of holiday service exceptions</a></blockquote>


<br/>
<table align="center" border=0 style="background-color: #fff; padding: 5px;" cellspacing=0>
  <tr><td style="padding-left: 5px">
    <b>Subscribe to the Eureka Transit email list</b> so that you receive email notifucation of schedule changes and updates to the mobile downloads
  </td></tr>
  <form action="http://groups.google.com/group/humboldttransit/boxsubscribe">
  <tr><td style="padding-left: 5px;">
    Email: <input type=text name=email>
           <input type=submit name="sub" value="Subscribe"> <a href="http://groups.google.com/group/eurekatransit">More about this email group</a>

  </td></tr>
</form>
</table>

</blockquote>

</div>

</div>
<br clear="all" />
</div>

<?php require_once ('../includes/footer.html'); ?>


</body>

</html>