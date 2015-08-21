<?php

// Start output buffering.
ob_start();
// Initialize a session.
session_start();

// Include the configuration file for error management and such.
require_once ('../includes/config.inc.php'); 

// Connect to the database
require_once ('../postgres_connect.php');

// Set the page title and include the HTML header.
$page_title = "Holidays | Eureka Transit Service (ETS)";

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


<h1>Holiday Schedule</h1>

<?php

$last_year= date("Y")-1;

$calendar_dates_query = "


SELECT calendar_dates.description, calendar_dates.calendar_date_id, DATE_FORMAT( calendar_dates.date,  '%W, %e %b %Y' ) AS formated_date, calendar.service_label AS service_name_added
FROM calendar_date_service_exceptions
LEFT JOIN calendar ON calendar_date_service_exceptions.service_exception = calendar.calendar_id
LEFT JOIN calendar_dates ON calendar_date_service_exceptions.calendar_date_id = calendar_dates.calendar_date_id
WHERE calendar_dates.agency_id =2
AND calendar_dates.date >  '".$last_year."-12-31'
AND calendar_dates.date <  '".date("Y")."-12-31'
AND (
calendar_date_service_exceptions.exception_type =1
OR calendar_date_service_exceptions.exception_type = NULL
)
ORDER BY calendar_dates.date ASC";
$calendar_dates_result = db_query($calendar_dates_query);


// echo '<p>'.$calendar_dates_query.'</p>';

if ($calendar_dates_result) {

echo '<table class="holidays" cellspacing="0">
<tr><th style="padding-right:20px">Date</th><th style="padding-right:20px">Holiday / exception description</th><th style="padding-right:20px">Service</th>';


// begin while loop
while ($row = db_fetch_array($calendar_dates_result, MYSQL_ASSOC)) {
echo '<tr><td>';
echo $row['formated_date'];
echo ' &nbsp;&nbsp;</td><td>';
echo $row['description'];
echo '&nbsp;&nbsp;</td><td>';


$calendar_date_service_exceptions_query = "select calendar.service_label from calendar_date_service_exceptions inner join calendar on calendar_date_service_exceptions.service_exception=calendar.calendar_id where calendar_date_id=".$row['calendar_date_id']." and exception_type=1;";
$calendar_date_service_exceptions_result = db_query($calendar_date_service_exceptions_query);


if (db_num_rows($calendar_date_service_exceptions_result) > 0) 
{echo '<ul style="list-style-type: none;padding:0px;margin:0px;">';
while ($row = db_fetch_array($calendar_date_service_exceptions_result, MYSQL_ASSOC)) {
echo '<li style="padding:0px;margin:0px;">'.$row['service_label'].'</li>';
}
echo '</ul>';
}

else {echo 'No service';}

echo '</td></tr>';

// end while loop
}

echo '</table>';

}

else {echo '<p>There are no service holidays lsited.</p>';}

?>


<p>This table is provided below, which shows normal holidays without dates.  This information is provided because the transit information database does not always fully reflect these holidays.</p>

<table>
	<tr>
		<th>Holiday / exception description</th> <th>Service</th>
	</tr>
	<tr>
		<td>New Year's Day</td> <td>No service</td>
	</tr>
	<tr>
		<td>MLK Day  </td> <td>Saturday service</td>
	</tr>
	<tr>
		<td>Presidents Day  </td> <td>Saturday service</td>
	</tr>
	<tr>
		<td>Memorial Day  </td> <td>Saturday service</td>
	</tr>
	<tr>
		<td>Independence Day  </td> <td>No service</td>
	</tr>
	<tr>
		<td>Labor Day  </td> <td>Saturday service</td>
	</tr>
	<tr>
		<td>Thanksgiving Day  </td> <td>No service</td>
	</tr>
	<tr>
		<td>Day after Thanksgiving  </td> <td>Saturday service</td>
	</tr>
	<tr>
		<td>Christmas Day  </td> <td>No service</td>
	</tr>
	<tr>
		<td>Day after Christmas  </td> <td>Saturday service</td>
	</tr>
</table>


<?php require_once ('../includes/footer.html'); ?>

</body>
</html>