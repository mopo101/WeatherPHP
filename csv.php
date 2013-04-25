<?
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");


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

$order = "select FROM_UNIXTIME(dateTime), outTemp, outHumidity, windSpeed, windDir, windGust, windGustDir, rainRate, rain from archive where  DATE(FROM_UNIXTIME(dateTime)) = '" . $_GET['date'] . "';";

$result = mysql_query($order);
echo '"Date Time","Outside Temp","Outside Humidity","Wind Speed","Wind Direction","Wind Gust","Wind Gust Direction","Rain Rate", "Rain Fall",'; 

while($data = mysql_fetch_row($result)){
        $compass = getCompassDirection($data[4]);
        $compassGust = getCompassDirection($data[6]);
        echo("\n$data[0],$data[1],$data[2],$data[3],$compass,$data[5],$compassGust,$data[7],$data[8]");
}


?>
