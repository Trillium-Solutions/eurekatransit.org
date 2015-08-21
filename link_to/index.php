<?php

require_once ('../includes/config.inc.php'); 

echo '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
<link rel="icon" type="image/png" href="http://www.hta.org/images/icon.png"/>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title><a href="http://www.eurekatransit.org/link_to/">Link to eurekatransit.org</a></title>
		<link href="../css/main.css" rel="stylesheet" type="text/css" media="all" />

<style type="text/css">
#instruction {float:left; width:200px;height:300px;margin-left:10px;margin-right:10px;}
li {margin-left:20px; padding-right:7px;}
#zone_name {text-align:center; font-size:20px; line-height:25px; width:40px; font-weight:bold;padding:0px}
td {border-bottom:1px solid #ccc;padding:1px;padding-right:10px}
</style>

<script type="text/javascript">
</script>

</head>

<body>

<a href="#Content" class="hidden">Skip to Content</a>
<div id="Container">
<div id="ContentWrapper">




<div id="logo_header">
<a href="http://www.eurekatransit.org/"><img src="images/ets_logo.gif" alt="" border="0" width="206" height="81" /></a>
</div>

<div id="header_area">

<div id="nav_path"><a href="http://www.eurekatransit.org/">ETS Home</a> ></div>

<br clear="left"/>

<h1 id="page_title"><a href="http://www.eurekatransit.org/link_to/">Link to eurekatransit.org</a></h1>

</div>

<br clear="all">

<hr size="2"  width="784" style="padding-left:10px;padding-right:10px;">

<div id="page_text_itself">


<h3>Why link here?</h3>

<ul>
<li>Linking to transit will help people to more easily get to your locatiton</li>
<li>Your link demonstrates you care about the environment and our community, because transit is more friendly to both</li>
<li>When people choose to  ride transit instead of drive, it helps keep money in our local economy</li>
</ul>

<h3>Text link<h3>

<p>Copy and paste this HTML code into your webpage:</p>

<code>&lt;a href="http://www.eurekatransit.org/"&gt;Ride Eureka Transit Service&lt;/a&gt;</code>

<h3>Trip planner link</h3>

<p>This form will generate code to include a trip planner form for Google Transit with your address pre-programmed as the destination.</p>

<fieldset>
<form method="post" action="index.php">
<strong>Enter the destination address:</strong><br/><input type="text" name="daddr" size="40"> <input type="submit" value="Generate form">
<br/><span style="font-size:10px">(e.g. 5th & D Streets, Eureka, CA)</span>

</form>
</fieldset>';



if (isset($_POST['daddr'])) {

echo '<h3>Use this code on your website</h3>';

echo '<code>';

echo'&lt;div id="trip_planner" style="width:230px; padding:10px"&gt;

&lt;h3&gt;Get transit directions&lt;/h3&gt;

Get a custom bus itinerary with transfers and walking directions through Google Transit.  Please read &lt;a href="trip_planner.php"&gt;about the trip planner and terms & conditions&lt;/a&gt; before using.

&lt;form name="f" action="http://www.google.com/transit"&gt;&lt;input type="hidden" name="ie" value="UTF8"&gt;&lt;input type="hidden" name="f" value="d"&gt;
    &lt;table&gt;
        &lt;tr&gt;
            &lt;td&gt;&lt;font size="-1"&gt;&lt;strong&gt;Start&lt;/strong&gt;&lt;/font&gt;&lt;/td&gt;

		&lt;/tr&gt;
		
 &lt;tr&gt;
            &lt;td valign="top"&gt;&lt;input type="text" style="width:15em" size="15" name="saddr" tabindex="1" maxlength="2048"&gt;&lt;br&gt;
            &lt;font size="-2" color="#555555"&gt;e.g. 5th & D Streets, Eureka, CA&lt;/font&gt;&lt;/td&gt;
&lt;/tr&gt;

&lt;tr&gt;
&lt;td&gt;&lt;font size="-1"&gt;&lt;strong&gt;End&lt;/strong&gt;&lt;/font&gt;&lt;/td&gt;&lt;/tr&gt;
&lt;tr&gt;

&lt;td&gt;',$_POST['daddr'],'&lt;input type="hidden" name="daddr" value="',$_POST['daddr'],'"&gt;&lt;br&gt;
&lt;font size="-2" color="#555555"&gt;e.g. 1 Harpst Street, Arcata, CA&lt;/font&gt;&lt;/td&gt;&lt;/tr&gt;


&lt;tr&gt;
&lt;td&gt;&lt;font size="-1"&gt;&lt;input type="radio" id="leave" name="ttype" value="dep" checked tabindex="1"&gt;&lt;label for="leave"&gt;Depart at&lt;/label&gt; &nbsp;&lt;font color="#888888"&gt;or&lt;/font&gt; &lt;input type="radio" id="arrive" name="ttype" value="arr" tabindex="1"&gt;&lt;label for="arrive"&gt;Arrive by&lt;/label&gt; &nbsp;&lt;/font&gt;&lt;/td&gt;&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;&lt;font size="-1"&gt;&lt;input type="text" id="fdate" size="10" name="date" value="" tabindex="1" maxlength="100"&gt;  &lt;input type="text" id="ftime" size="10" name="time" value="" tabindex="1" maxlength="100"&gt;&lt;/font&gt;&lt;/td&gt;        &lt;/tr&gt;

&lt;tr&gt;
&lt;td valign="top"&gt;&lt;input type="submit" value="Get Directions" tabindex="1"&gt;&lt;/td&gt;
&lt;/tr&gt;

    &lt;/table&gt;
&lt;/form&gt;

&lt;/div&gt;';

echo '</code>';
}

echo '</div>

</div>
<br clear="all" />
</div>

<div id="Footer">
<p><a href="http://groups.google.com/group/humboldttransit/">Email updates</a> â€¢ <a href="../contact.php">Contact/Feedback</a> â€¢ <a href="index.php">Link to eurekatransit.org</a>
<br/><a href="link_to/">Link to eurekatransit.org</a> ¥ <a href="credits.php">Site Credits</a> ¥ <a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=0&amp;t=219"><img border="0" alt="Firefox 2" title="Firefox 2" src="http://sfx-images.mozilla.org/affiliates/Buttons/firefox2/ff2b80x15.gif"/></a></p>
</div>
		
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-2025592-2";
urchinTracker();
</script>

</body>

</html>';


?>