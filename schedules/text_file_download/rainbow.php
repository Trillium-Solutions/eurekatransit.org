<?php

// Include the configuration file for error management and such.
require_once ('../../includes/config.inc.php'); 

// Connect to the database
require_once ('../../mysql_connect.php');

$trip_id=88;

$trip_query = "select route_id,service_id from trips where trip_id=$trip_id";
$trip_result = mysql_query($trip_query);

while ($row=mysql_fetch_array($trip_result, MYSQL_ASSOC))
{$route_id=$row['route_id'];
$service_id=$row['service_id'];}

$service_query = "select service_label from service_groupings where service_id=$service_id";
$service_result = mysql_query($service_query);

while ($row=mysql_fetch_array($service_result, MYSQL_ASSOC))
{$service_label=$row['service_label'];}

$route_query = "select route_short_name,route_long_name,route_color,route_desc from routes where route_id=$route_id";
$route_result = mysql_query($route_query);

while ($row=mysql_fetch_array($route_result, MYSQL_ASSOC))
{$route_short_name=$row['route_short_name'];
$route_long_name=$row['route_long_name'];;
$route_desc=$row['route_desc'];}


$route_name=$route_short_name;
if ($route_long_name != "") {$$route_name=$route_short_name."-".$route_long_name;}

$route_filename=str_replace ( ' ', '_', $row['route_short_name']);

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header('Content-Type: text/plain');
header("Content-Disposition: attachment; filename=\"".$route_filename."\"");
header('Content-Transfer-Encoding: 8bit');


// query for stops
$stop_times = "select time_format(arrival_time,':%i') AS arrival_time, time_format(departure_time,':%i') AS departure_time, time_format(arrival_time,'%p') AS am_pm, stops.stop_id,stops.stop_name, stops.zone_id,stops.stop_list_order, stops.stop_lat, stops.stop_lon from stop_times inner join stops on stops.stop_id=stop_times.stop_id where stop_times.trip_id =$trip_id order by stop_times.stop_sequence asc";
$stops_result = mysql_query($stop_times);


echo "Eureka Transit Service
";
echo $route_short_name; if ($route_long_name != "") {echo "-$route_long_name";}
echo "($service_label)
";

echo $route_desc;

echo "

";

while ($row = mysql_fetch_array($stops_result, MYSQL_ASSOC)) {
echo $row['stop_name']."  ".$row['arrival_time'];

if ($row['arrival_time'] != $row['departure_time']) {echo '(Departs '.$row['departure_time'].')';}

echo '
';
}


?>