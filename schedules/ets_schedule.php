<?php

// Start output buffering.
ob_start();
// Initialize a session.
session_start();

// Include the configuration file for error management and such.
require_once ('../includes/config.inc.php'); 

// Connect to the database
require_once ('../mysql_connect.php');


	if ($_GET['service'] == 'weekday') {$display_trips=array(39689,39702,39715,476); $calendar_id=8; $trips_array_length=4;}
	elseif ($_GET['service'] == 'weekend') {$display_trips=array(32779,476,39727); $calendar_id=9; $trips_array_length=3;}

// if (isset($_GET['update'])) {
// 
// 	if ($_GET['update'] == '04-march-2013') {
// 	
// 		if ($_GET['service'] == 'weekday') {$display_trips=array(32694,32721,32936,476); $calendar_id=675; $trips_array_length=4;}
// 	elseif ($_GET['service'] == 'weekend') {$display_trips=array(32779,476,32789); $calendar_id=677; $trips_array_length=3;}
// 	
// 	}
// 
// }

$service_query = "select service_label from calendar where calendar_id=$calendar_id";
$service_result = mysql_query($service_query);

while ($row=mysql_fetch_array($service_result, MYSQL_ASSOC))
{$service_label=$row['service_label'];}

// Set the page title and include the HTML header.
$page_title = "ETS ".$service_label;

$css="td,th {font-size:10px;
	border-bottom: black;
	border-width: 1px 0px 0 0;
	border-style: solid none none  none;
	padding:0px
}
.colorback {background-color:#d3f4ff;}


";

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="icon" type="image/png" href="http://www.hta.org/images/icon.png"/>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $page_title; ?></title>
	<link href="http://www.eurekatransit.org/css/main.css" rel="stylesheet" type="text/css" media="all" />


<?php
echo '<style type="text/css" media="all">';

echo 'body {margin:8px}';

echo '#green_bar_header {background-color: #2e3192; border-top: 2px solid black; color:#fff; padding:1px; text-align: center; margin:0px; width:100%; font-size:17px; margin-bottom:6px;}';


if (isset($css)) {echo $css;}

echo '</style>';

?>

</head>
<body>


<a href="../">&#xAB; Back to ETS Home</a><br/><a href="../schedules/">&#xAB; Back to all ETS Schedules</a>

<?php

echo '<h1 id="green_bar_header">'.$page_title.'</h1>';

?>


<div id="Content">

<?php

// query for trips

$trips_array_current_row=0;

echo '<table><tr>';

while ($trips_array_current_row < $trips_array_length) {

$current_trip=$display_trips[$trips_array_current_row];

echo' <td style="border:0px;padding-right:20px" valign="top">';
$trip_query = "select route_id,service_id from trips where trip_id=$current_trip";
$trip_result = mysql_query($trip_query);

while ($row=mysql_fetch_array($trip_result, MYSQL_ASSOC))
{$route_id=$row['route_id'];
$service_id=$row['service_id'];}

$route_query = "select route_short_name,route_long_name,route_color,route_desc from routes where route_id=$route_id";
$route_result = mysql_query($route_query);

while ($row=mysql_fetch_array($route_result, MYSQL_ASSOC))
{$route_short_name=$row['route_short_name'];
$route_long_name=$row['route_long_name'];
$route_color=$row['route_color'];
$route_desc=$row['route_desc'];}

// query for stops
$stop_times = "select time_format(arrival_time,':%i') AS arrival_time, time_format(departure_time,':%i') AS departure_time, time_format(arrival_time,'%p') AS am_pm, stops.stop_id,stops.stop_name, stops.zone_id,stops.stop_list_order, stops.stop_lat, stops.stop_lon from stop_times left join stops on stops.stop_id=stop_times.stop_id where stop_times.trip_id =$current_trip order by stop_times.stop_sequence asc";
$stops_result = mysql_query($stop_times);


echo "<table cellspacing=\"0\" style=\"border:4px solid #$route_color; padding:5px;\" width=\"150px\">
<tr><th colspan=\"2\">";
echo $route_long_name;
echo "</th></tr>
<tr><td style=\"border:0px\"><i>(click name to show on map)</i></td></tr>";


while ($row = mysql_fetch_array($stops_result, MYSQL_ASSOC)) {
echo '<tr><th><nobr><a href="http://maps.google.com/maps?f=q&hl=en&q='.$row['stop_lat'].'+,'.$row['stop_lon'].'&z=17">'.$row['stop_name'].'</a>&nbsp;&nbsp;&nbsp;</nobr></th>';


echo '<td>&nbsp;&nbsp;'.$row['arrival_time'].'</td>';

if ($row['arrival_time'] != $row['departure_time']) {echo '<tr><td colspan="2" style="text-align:right;border:0px;"><i>Departs</i> '.$row['departure_time'].'</td></tr>';}

echo '</td></tr>';
}

echo '<tr><td colspan="2">' . $route_desc . '</td></tr>';


echo '</table>
</td>';

$trips_array_current_row++;

}

echo '</tr></table>';

?>

</body>
</html>