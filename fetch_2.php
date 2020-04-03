<?php

  $title = "NEW Ambient Temperature Graph (c)";
  $legend_sensor_name1 = "Temprature";
  $legend_sensor_name2 = "Humidity";
  $legend_time_name =  "Time";
  $number_of_samples =  "1000";
  $interval_span =  "30"; //mins

?>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('datetime', "<?php echo $legend_time_name; ?>");
      data.addColumn('number', '<?php echo $legend_sensor_name1; ?>');
      data.addColumn('number', '<?php echo $legend_sensor_name2; ?>');
      //data.addColumn('number', 'Sensor2');


      data.addRows([
   		<?php

			date_default_timezone_set("Asia/Riyadh");

			$connect = new PDO("mysql:host=localhost;dbname=mydb", "root", "");

			/*****************************************************************/
			/*****************************************************************/
			/*****************************************************************/

			/*****************************************************************/
			/*****************************************************************/
			/*****************************************************************/


			 //$query = " SELECT dtime,sensor1,sensor2,hum,temp  FROM tbl_sensors ORDER BY id DESC LIMIT 100 ";
			 $query = " SELECT *  FROM tbl_sensors ORDER BY id DESC LIMIT $number_of_samples ";

			 $statement = $connect->prepare($query);
			 $statement->execute();
			 $result = $statement->fetchAll();

			//$i = 0;
			foreach($result as $row)
				{
					//++$i;
					$time = strtotime($row['dtime']);
					//$tzone = strtotime($row['tzone']);


					$y = date("Y",$time);
					$mo = date("m",$time);
					$d = date("d",$time);

					$h = date("H",$time);
					$m = date("i",$time);
					$s = date("s",$time);
					$u = date("u",$time);


					$sensor1 = $row['temp'];
					$sensor2 = $row['hum'];


					if($sensor1 == 0) continue;


					echo "[new Date($y,$mo,$d,$h,$m,$s), $sensor1],";
					echo "[new Date($y,$mo,$d,$h,$m,$s), $sensor2],";
				}

					$y = date("Y");
					$mo = date("m");
					$d = date("d");
					$h = date("H");
					$m = date("i");
					$s = date("s");


		?>


      ]);

      var options = {
        chart: {
          //title: 'Ambient Temperature Graph (c)',
          title: '<?php echo $title; ?>',
          subtitle: 'Time/Date: <?php echo date('hA (M-d-Y )',time()); ?>'
        },
        width: '100%',
        height: 500,
        legend: {position: 'top'},
        enableInteractivity: false,
        chartArea: {
          width: '100%'
        },
        hAxis: {
          viewWindow: {

			         min: new Date(<?php echo $y.",".$mo.",".$d.",".$h.",".($m-$interval_span); ?>),
               max: new Date(<?php echo $y.",".$mo.",".$d.",".$h.",".($m); ?>),


          },
          gridlines: {
            count: -1,
            units: {
              days: {format: ['MMM dd']},
              hours: {format: ['HH:mm', 'ha']},
            }
          },
          minorGridlines: {
            units: {
              hours: {format: ['hh:mm:ss a', 'ha']},
              minutes: {format: ['HH:mm a Z', ':mm']}
            }
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>

  <div id="line_top_x"></div>
