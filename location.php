<?php
$con=mysql_connect("localhost","root") or die("Failed to connect with database!!!!");
mysql_select_db("osm", $con); 
// The Chart table contains two fields: weekly_task and percentage
// This example will display a pie chart. If you need other charts such as a Bar chart, you will need to modify the code a little to make it work with bar chart and other charts
$sth = mysql_query("SELECT * FROM location");
$rth = mysql_query("SELECT * FROM analysis");
$tth = mysql_query("SELECT * FROM dtissues");
$state = $_GET['state'];
echo "<link rel='stylesheet' href='css/bootstrap.css'> <link rel='stylesheet' href='css/style.css'>";
echo "<h1 id = 'statehead' class = 'text-center'>Analysis of ",$state,"</h1>";
/*echo "<div id = 'tablinks'> <a href = '#chart_div'><h3>Popularity of Candidates in</h3>", $state, "</a> <a href = '#chart1_div'><h3>Issues Mentioned: Hillary Clinton</h3></div>";

--------------------------
example data: Table (Chart)
--------------------------
weekly_task     percentage
Sleep           30
Watching Movie  40
work            44
*/

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'State', 'type' => 'string'),
    array('label' => $state, 'type' => 'number')

);

$rows1 = array();
//flag is not needed
$flag = true;
$table1 = array();
$table1['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Issue', 'type' => 'string'),
    array('label' => $state, 'type' => 'number')

);

$rows2 = array();
$table2 = array();
$table2['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Issues', 'type' => 'string'),
    array('label' => $state, 'type' => 'number')

);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['State']); 

    // Values of each slice
    $temp[] = array('v' => (int) $r[$state]); 
    $rows[] = array('c' => $temp);
}

$rows1 = array();
while($s = mysql_fetch_assoc($rth)) {
    $temp1 = array();
    // the following line will be used to slice the Pie chart
    $temp1[] = array('v' => (string) $s['Issue']); 

    // Values of each slice
    $temp1[] = array('v' => (int) $s[$state]); 
    $rows1[] = array('c' => $temp1);
}
$rows2 = array();
while($t = mysql_fetch_assoc($tth)) {
    $temp2 = array();
    // the following line will be used to slice the Pie chart
    $temp2[] = array('v' => (string) $t['Issues']); 

    // Values of each slice
    $temp2[] = array('v' => (int) $t[$state]); 
    $rows2[] = array('c' => $temp2);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

$table1['rows'] = $rows1;
$jsonTable1 = json_encode($table1);

$table2['rows'] = $rows2;
$jsonTable2 = json_encode($table2);
//echo $jsonTable;
?>
    
 <html>
  <head>
	<link href="css/style.css" rel="stylesheet">
	<link href="css/robotoslab.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript">
	
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
	google.setOnLoadCallback(drawChart1);
	google.setOnLoadCallback(drawChart2);


    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
          title: 'Popularity of US Presidential Candidates',
          is3D: 'true',
		  fontName: 'Open Sans',
		  fontSize: 16,
          width: 800,
          height: 650,
		  colors: ['#0052a5', '#E0162B']
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
	function drawChart1() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable1?>);
      var options = {
          title: 'Issues mentioned in tweets in support of Hillary Clinton',
		  fontName: 'Open Sans',
		  fontSize: 16,
          is3D: 'true',
          width: 800,
          height: 650,
		  colors: ['#f23c55', '#2a2f36', '#31797d', '#61c791', '#e0ffb3', '#635a8e', '#4eb29c', '#5c564b', '#f28542', '#a71421', '#430716']
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart1 = new google.visualization.PieChart(document.getElementById('chart1_div'));
      chart1.draw(data, options);
    }
	function drawChart2() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable2?>);
      var options = {
          title: 'Issues mentioned in tweets in support of Donald Trump',
		  fontName: 'Open Sans',
		  fontSize: 16,
          is3D: 'true',
          width: 800,
          height: 650,
		  colors: ['#f23c55', '#2a2f36', '#31797d', '#61c791', '#e0ffb3', '#635a8e', '#4eb29c', '#5c564b', '#f28542', '#a71421', '#430716', 'BDF271', '00823E']
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart2 = new google.visualization.PieChart(document.getElementById('chart2_div'));
      chart2.draw(data, options);
    }
    </script>
  </head>

  <body>
  <div class= "tablink" id="smaller">
	<ul id = "navi" class="navi">
  <li class="act"><a href = "#chart_div">Popularity of Candidates</a></li>
  <li><a href = "#chart1_div"> Issues Mentioned: Hillary</a></li>
  <li><a href = "#chart2_div">Issues Mentioned: Trump</a></li>
	</ul>
	</div>
	<script>
      $(".navi li a").click(function() {
  $(".navi li").removeClass('act');
    $(this).parent().addClass('act');
});
  </script>
    <!--this is the div that will hold the pie chart-->
	<div id ="shift2">
    <div id="chart_div"></div>
	<div id="chart1_div"></div>
	<div id="chart2_div"></div>
	</div>
  </body>
</html>