<table>
  <tr>
    <td align="center">WEATHER DATA <?  echo $_POST['date']; ?> </td>
  </tr>
  <tr>
    <td>
      <table id="thetable" border="1">
      <tr>
        <td>Date/Time</td>
        <td>Temp</td>
        <td>Humidity</td>
	<td>Wind Speed</td>
	<td>Wind Direction</td>
	<td>Wind Gust</td>
	<td>Wind Gust Direction</td>
	<td>Rain Rate</td>
	<td>Rain</td>
      </tr>
<?

//convert compass
function getCompassDirection($bearing) {
     $tmp = round($bearing / 22.5);
     switch($tmp) {
          case 1:
               $direction = "NNE";
               break;
          case 2:
               $direction = "NE";
               break;
          case 3:
               $direction = "ENE";
               break;
          case 4:
               $direction = "E";
               break;
          case 5:
               $direction = "ESE";
               break;
          case 6:
               $direction = "SE";
               break;
          case 7:
               $direction = "SSE";
               break;
          case 8:
               $direction = "S";
               break;
          case 9:
               $direction = "SSW";
               break;
          case 10:
               $direction = "SW";
               break;
          case 11:
               $direction = "WSW";
               break;
          case 12:
               $direction = "W";
               break;
          case 13:
               $direction = "WNW";
               break;
          case 14:
               $direction = "NW";
               break;
          case 15:
               $direction = "NNW";
               break;
          default:
               $direction = "N";
     }
     return $direction;
}


mysql_connect("localhost","weewx","weewx");//database connection
mysql_select_db("weewx");
				
$order = "select FROM_UNIXTIME(dateTime), outTemp, outHumidity, windSpeed, windDir, windGust, windGustDir, rainRate, rain from archive where  DATE(FROM_UNIXTIME(dateTime)) = '" . $_POST['date'] . "';";
			
$result = mysql_query($order);	
				
while($data = mysql_fetch_row($result)){	
	$compass = getCompassDirection($data[4]);
	$compassGust = getCompassDirection($data[6]);
	echo("<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$compass</td><td>$data[5]</td><td>$compassGust</td><td>$data[7]</td><td>$data[8]</td></tr>");
}
?>
    </table>
  </td>
</tr>
</table>
