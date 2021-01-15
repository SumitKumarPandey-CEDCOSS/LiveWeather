<?php
error_reporting(E_ERROR);
/**
 * Php version 7.2.10
 * 
 * @category Components
 * @package  Packagename
 * @author   Sumit kumar Pandey <pandeysumit399@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://localhost/training/php%20mysql%20task1/register/signup.php
 */
if (isset($_POST['submit'])) {
    $city = $_POST['name'];
    $key = 'Put your Api Key over here';
    $url = 'api.openweathermap.org/data/2.5/weather/?q='.$city.'&appid='.$key.'';
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    $res = curl_exec($ch); 
    $result = json_decode($res);
    curl_close($ch);
    $lat = $result->coord->lat;
    $lon = $result->coord->lon;

    $url2 = "https://api.openweathermap.org/data/2.5/onecall?lat=".$lat."&lon=".$lon."&exclude=minutely,hourly&units=metric&appid=".$key."";
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch1, CURLOPT_URL, $url2); 
    $res1 = curl_exec($ch1); 
    $result1 = json_decode($res1);
    curl_close($ch1);
    echo "<pre>";
    print_r($result1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenWeather Api</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    

</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-5 text-center">Weather Data</h2>
        <form class="form-group" action="" method="POST">
            <input type="text" name="name" placeholder="City Name">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </form>
    </div>
    <div class="container-fluid">
    <table class="table table-bordered" id="display">
        <thead>
            <tr>                          
                <th>DATE</th>    
                <th>TEMPERATURE_Max</th>
                <th>TEMPERATUR_Min</th>
                <th>CITY</th>
                <th>COUNTRY</th>                          
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result1)) {
                foreach ($result1->daily as $key=>$val2) {
                    echo '<tr>';
                    echo '<td>'.date('l F\'y, d', $val2->dt).'</td>'; 
                    echo '<td>'.$val2->temp->max.'</td>';
                    echo '<td>'.$val2->temp->min.'</td>';
                    echo '<td>'.$result->name.'</td>';
                    echo '<td>'.$result->sys->country.'</td>';
                    echo '</tr>';
                }
            }            
            ?>
        </tbody>
    </table>
    </div>
    <script>
    $(document).ready(function(){
        $('#display').DataTable();
    });
</script>
</body>
</html>
hello hello
hello hello
