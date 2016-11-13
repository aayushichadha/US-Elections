<?php
$con=mysql_connect("localhost","root") or die("Failed to connect with database!!!!");
mysql_select_db("osm", $con); 
// The Chart table contains two fields: weekly_task and percentage
// This example will display a pie chart. If you need other charts such as a Bar chart, you will need to modify the code a little to make it work with bar chart and other charts
$sth = mysql_query("SELECT * FROM issues");
$tth = mysql_query("SELECT * FROM issues");
$rth = mysql_query("SELECT * FROM pop");


/*
-------------------------
example data: Table (Chart)
--------------------------
weekly_task     percentage
Sleep           30
Watching Movie  40
work            44
*/

$rows = array();
$rows1 = array();
$rows2 = array();

//flag is not needed

$flag = true;
$table = array();
$table1 = array();
$table2 = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Issue', 'type' => 'string'),
    array('label' => 'Hillary', 'type' => 'number')

);
$table1['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Issue', 'type' => 'string'),
    array('label' => 'Trump', 'type' => 'number')

);
$table2['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'name', 'type' => 'string'),
    array('label' => 'Popularity', 'type' => 'number')

);

$rows = array();
$rows1 = array();
$rows2 = array();

while($s = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $s['Issue']); 

    // Values of each slice
    $temp[] = array('v' => (int) $s['Hillary']); 
    $rows[] = array('c' => $temp);
}

while($t = mysql_fetch_assoc($tth)) {
    $temp1 = array();
    // the following line will be used to slice the Pie chart
    $temp1[] = array('v' => (string) $t['Issue']); 

    // Values of each slice
    $temp1[] = array('v' => (int) $t['Trump']); 
    $rows1[] = array('c' => $temp1);
}

while($r = mysql_fetch_assoc($rth)) {
    $temp2 = array();
    // the following line will be used to slice the Pie chart
    $temp2[] = array('v' => (string) $r['name']); 

    // Values of each slice
    $temp2[] = array('v' => (int) $r['Popularity']); 
    $rows2[] = array('c' => $temp2);
}
$table['rows'] = $rows;
$table1['rows'] = $rows1;
$table2['rows'] = $rows2;

$jsonTable = json_encode($table);
$jsonTable1 = json_encode($table1);
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
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	 
      google.charts.load('current', {'packages':['corechart','geochart']});
      google.charts.setOnLoadCallback(drawChart4);
	  function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['State', 'Hillary Clinton', 'Donald Trump'],
          ['AL', 110, 58],
		  ['AK', 8, 6],
['AZ', 190, 94],
['AR', 18, 16],
['CA', 930, 588],
['CO', 134, 43],
['CT', 48, 79],
['DE', 4, 3],
['FL', 559, 580],
['GA', 204, 273],
['HI', 26, 7],
['ID', 13, 1],
['IL', 208, 162],
['IN', 117, 81],
['IA', 20, 21],
['KS', 18, 28],
['KY', 64, 54],
['LA', 123, 100],
['ME', 21, 20],
['MD', 70, 54],
['MA', 67, 100],
['MI', 141, 112],
['MN', 116, 44],
['MS', 33, 22],
['MO', 88, 120],
['MT', 13, 5],
['NE', 14, 3],
['NV', 139, 85],
['NH', 48, 7],
['NJ', 170, 75],
['NM', 34, 48],
['NY', 619, 601],
['NC', 228, 198],
['ND', 12, 14],
['OH', 180, 177],
['OK', 76, 43],
['OR', 108, 68],
['PA', 247, 169],
['RI', 17, 14],
['SC', 89, 59],
['SD', 3, 4],
['TN', 122, 134],
['TX', 482, 657],
['UT', 16, 27],
['VT', 9, 5],
['VA', 88, 119],
['WA', 242, 213],
['WV', 12, 17],
['WI', 64, 56],
['WY', 5, 7]
        ]);

        var options = {
          title: 'State-Wise Popularity Analysis of US Presidential Candidates',
		  fontName: 'Open Sans',
		  fontSize: 12,
		  width:'1427',
		  height:'470',
          legend: { position: 'bottom' },
		   vAxis: {
          viewWindow: {
            max: 950
          }, 
		  ticks: [0,200,400,600,800,950]
        }
        };

        var chart4 = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart4.draw(data, options);
      }
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = new google.visualization.DataTable();
     
       
				data.addRows(50);
  data.addColumn('string', 'State');
  data.addColumn('number', 'Tweets ');
data.setValue(0, 0, 'Alabama'); data.setValue(0, 1, 0); data.setFormattedValue(0, 1, 'Clinton: 65% Trump: 35%');
data.setValue(1, 0, 'Alaska'); data.setValue(1, 1, 0); data.setFormattedValue(1, 1, 'Clinton: 57% Trump: 43%');
data.setValue(2, 0, 'Arizona'); data.setValue(2, 1, 0); data.setFormattedValue(2, 1, 'Clinton: 67% Trump: 33%');
data.setValue(3, 0, 'Arkansas'); data.setValue(3, 1, 0); data.setFormattedValue(3, 1, 'Clinton: 53% Trump: 47%');
data.setValue(4, 0, 'California'); data.setValue(4, 1, 0); data.setFormattedValue(4, 1, 'Clinton: 61% Trump: 39%');
data.setValue(5, 0, 'Colorado'); data.setValue(5, 1, 0); data.setFormattedValue(5, 1, 'Clinton: 76% Trump: 24%');
data.setValue(6, 0, 'Connecticut'); data.setValue(6, 1, 1); data.setFormattedValue(6, 1, 'Clinton: 38% Trump: 62%');
data.setValue(7, 0, 'Delaware'); data.setValue(7, 1, 0); data.setFormattedValue(7, 1, 'Clinton: 57% Trump: 43%');
data.setValue(8, 0, 'Florida'); data.setValue(8, 1, 1); data.setFormattedValue(8, 1, 'Clinton: 49% Trump: 51%');
data.setValue(9, 0, 'Georgia'); data.setValue(9, 1, 1); data.setFormattedValue(9, 1, 'Clinton: 43% Trump: 57%');
data.setValue(10, 0, 'Hawaii'); data.setValue(10, 1, 0); data.setFormattedValue(10, 1, 'Clinton: 79% Trump: 21%');
data.setValue(11, 0, 'Idaho'); data.setValue(11, 1, 0); data.setFormattedValue(11, 1, 'Clinton: 93% Trump: 7%');
data.setValue(12, 0, 'Illinois'); data.setValue(12, 1, 0); data.setFormattedValue(12, 1, 'Clinton: 56% Trump: 44%');
data.setValue(13, 0, 'Indiana'); data.setValue(13, 1, 0); data.setFormattedValue(13, 1, 'Clinton: 59% Trump: 41%');
data.setValue(14, 0, 'Iowa'); data.setValue(14, 1, 1); data.setFormattedValue(14, 1, 'Clinton: 49% Trump: 51%');
data.setValue(15, 0, 'Kansas'); data.setValue(15, 1, 1); data.setFormattedValue(15, 1, 'Clinton: 39% Trump: 61%');
data.setValue(16, 0, 'Kentucky'); data.setValue(16, 1, 0); data.setFormattedValue(16, 1, 'Clinton: 54% Trump: 46%');
data.setValue(17, 0, 'Louisiana'); data.setValue(17, 1, 0); data.setFormattedValue(17, 1, 'Clinton: 55% Trump: 45%');
data.setValue(18, 0, 'Maine'); data.setValue(18, 1, 0); data.setFormattedValue(18, 1, 'Clinton: 51% Trump: 49%');
data.setValue(19, 0, 'Maryland'); data.setValue(19, 1, 0); data.setFormattedValue(19, 1, 'Clinton: 56% Trump: 44%');
data.setValue(20, 0, 'Massachusetts'); data.setValue(20, 1, 1); data.setFormattedValue(20, 1, 'Clinton: 40% Trump: 60%');
data.setValue(21, 0, 'Michigan'); data.setValue(21, 1, 0); data.setFormattedValue(21, 1, 'Clinton: 56% Trump: 44%');
data.setValue(22, 0, 'Minnesota'); data.setValue(22, 1, 0); data.setFormattedValue(22, 1, 'Clinton: 73% Trump: 47%');
data.setValue(23, 0, 'Mississippi'); data.setValue(23, 1, 0); data.setFormattedValue(23, 1, 'Clinton: 60% Trump: 40%');
data.setValue(24, 0, 'Missouri'); data.setValue(24, 1, 0); data.setFormattedValue(24, 1, 'Clinton: 42% Trump: 58%');
data.setValue(25, 0, 'Montana'); data.setValue(25, 1, 0); data.setFormattedValue(25, 1, 'Clinton: 72% Trump: 28%');
data.setValue(26, 0, 'Nebraska'); data.setValue(26, 1, 0); data.setFormattedValue(26, 1, 'Clinton: 82% Trump: 18%');
data.setValue(27, 0, 'Nevada'); data.setValue(27, 1, 0); data.setFormattedValue(27, 1, 'Clinton: 62% Trump: 38%');
data.setValue(28, 0, 'New Hampshire'); data.setValue(28, 1, 0); data.setFormattedValue(28, 1, 'Clinton: 87% Trump: 13%');
data.setValue(29, 0, 'New Jersey'); data.setValue(29, 1, 0); data.setFormattedValue(29, 1, 'Clinton: 69% Trump: 31%');
data.setValue(30, 0, 'New Mexico'); data.setValue(30, 1, 1); data.setFormattedValue(30, 1, 'Clinton: 41% Trump: 59%');
data.setValue(31, 0, 'New York'); data.setValue(31, 1, 0); data.setFormattedValue(31, 1, 'Clinton: 51% Trump: 49%');
data.setValue(32, 0, 'North Carolina'); data.setValue(32, 1, 0); data.setFormattedValue(32, 1, 'Clinton: 54% Trump: 46%');
data.setValue(33, 0, 'North Dakota'); data.setValue(33, 1, 1); data.setFormattedValue(33, 1, 'Clinton: 46% Trump: 54%');
data.setValue(34, 0, 'Ohio'); data.setValue(34, 1, 0); data.setFormattedValue(34, 1, 'Clinton: 50% Trump: 50%');
data.setValue(35, 0, 'Oklahoma'); data.setValue(35, 1, 0); data.setFormattedValue(35, 1, 'Clinton: 64% Trump: 36%');
data.setValue(36, 0, 'Oregon'); data.setValue(36, 1, 0); data.setFormattedValue(36, 1, 'Clinton: 61% Trump: 39%');
data.setValue(37, 0, 'Pennsylvania'); data.setValue(37, 1, 0); data.setFormattedValue(37, 1, 'Clinton: 59% Trump: 41%');
data.setValue(38, 0, 'Rhode Island'); data.setValue(38, 1, 0); data.setFormattedValue(38, 1, 'Clinton: 55% Trump: 45%');
data.setValue(39, 0, 'South Carolina'); data.setValue(39, 1, 0); data.setFormattedValue(39, 1, 'Clinton: 60% Trump: 40%');
data.setValue(40, 0, 'South Dakota'); data.setValue(40, 1, 1); data.setFormattedValue(40, 1, 'Clinton: 43% Trump: 57%');
data.setValue(41, 0, 'Tennessee'); data.setValue(41, 1, 1); data.setFormattedValue(41, 1, 'Clinton: 48% Trump: 52%');
data.setValue(42, 0, 'Texas'); data.setValue(42, 1, 1); data.setFormattedValue(42, 1, 'Clinton: 42% Trump: 58%');
data.setValue(43, 0, 'Utah'); data.setValue(43, 1, 1); data.setFormattedValue(43, 1, 'Clinton: 37% Trump: 63%');
data.setValue(44, 0, 'Vermont'); data.setValue(44, 1, 0); data.setFormattedValue(44, 1, 'Clinton: 64% Trump: 36%');
data.setValue(45, 0, 'Virginia'); data.setValue(45, 1, 1); data.setFormattedValue(45, 1, 'Clinton: 43% Trump: 57%');
data.setValue(46, 0, 'Washington'); data.setValue(46, 1, 0); data.setFormattedValue(46, 1, 'Clinton: 53% Trump: 47%');
data.setValue(47, 0, 'West Virginia'); data.setValue(47, 1, 1); data.setFormattedValue(47, 1, 'Clinton: 41% Trump: 59%');
data.setValue(48, 0, 'Wisconsin'); data.setValue(48, 1, 0); data.setFormattedValue(48, 1, 'Clinton: 53% Trump: 47%');
data.setValue(49, 0, 'Wyoming'); data.setValue(49, 1, 1); data.setFormattedValue(49, 1, 'Clinton: 42% Trump: 58%');
 
        var options = {
		tooltip: { textStyle: {
		fontName: 'Open Sans',
		fontSize: 18}},
		region: 'US', resolution: 'provinces', legend:'none', width: 1050, colorAxis: { minValue: 0, maxValue:1,
		colors: ['#0052A5','#E0162B'] }
        };

        var chart5 = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart5.draw(data, options);
      }
	  
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
          title: 'Issues Mentioned in Support of Hillary Clinton ',
          is3D: 'true',
		  fontName: 'Open Sans',
		  fontSize: 24,
          width: 900,
          height: 720,
		  colors: ['#f23c55', '#2a2f36', '#31797d', '#61c791', '#e0ffb3', '#635a8e', '#4eb29c', '#5c564b', '#f28542', '#a71421', '#430716']
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
          title: 'Issues Mentioned in Support of Donald Trump ',
		  fontName: 'Open Sans',
		  fontSize: 24,
          is3D: 'true',
          width: 900,
          height: 720,
		  colors: ['#f23c55', '#2a2f36', '#31797d', '#61c791', '#e0ffb3', '#635a8e', '#4eb29c', '#5c564b', '#f28542', '#a71421', '#430716']
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart1 = new google.visualization.PieChart(document.getElementById('chart1_div'));
      chart1.draw(data, options);
    }
	 function drawChart2() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable2?>)
      var options = {
          title: 'Popularity of Presidential Candidates in the US',
		  fontName: 'Open Sans',
		  fontSize: 22,
          is3D: 'true',
          width: 1000,
          height: 650,
		  bar: {groupWidth: "45%"},
		  colors: ['#0052a5', '#E0162B'],
		  hAxis: {
    viewWindow: {
        min: 0,
        max: 9000
    } ,
    ticks: [0, 2000, 4000, 6000, 8000,]
		  }
  // display labels every 25}
        };
		
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart2 = new google.visualization.BarChart(document.getElementById('chart2_div'));
      chart2.draw(data, options);
    }
    </script>

  </head>

  <body>
    <!--this is the div that will hold the pie chart-->
		
    <div class= "tablink">
	<ul id = "navi" class="navi">
  <li class="act"><a href = "#chart_div"> Issues Mentioned: Hillary</a></li>
  <li><a href = "#chart1_div">Issues Mentioned: Trump</a></li>
  <li><a href = "#chart2_div">Overall Popularity of Candidates</a></li>
  <li><a href = "#curve_chart">State-wise Popularity of Candidates</a></li>
  <li><a href = "#cloud1">Word Cloud for Issues of Donald Trump</a>
  <li><a href = "#cloud2">Word Cloud for Issues of Hillary Clinton</a></li>
  <li><a href = "#regions_div">Popularity on Map</a></li>
	</ul>
	<script>
      $("#navi li a").click(function() {
  $("#navi li").removeClass('act');
    $(this).parent().addClass('act');
});
  </script>
	</div>
	<div id="shift">
	<div id="chart_div"></div>
	<div id="chart1_div"></div>
	<div id="chart2_div" style="width:700px; height:900px;"></div>
	<div id="curve_chart" class="shiftless" style="width:700px; height:1000px;"></div>
	<div id="cloud1"><img style ="height:97%" src = "trumpw.png"></div>
	<div id="cloud2"><img style ="height:97%" src = "hillaryw.png"></div>
	<div id="regions_div"></div>
	<span class="mapsub"> <span class ="boxed" id = "sblue"></span>Hillary Clinton: 34 States </span><span class="mapsub"> <span class = "boxed" id = "sred"></span>Donald Trump: 16 States </span>
	
  </body>
</html>