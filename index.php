<?php
if ($_GET['city']) {
    $city = $_GET['city'];
    $weatherContent = @file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid=7ad812c256b8203c31a75b3f4a9f79e8');
    
    $weather = "";
    $error = "";


    if(!$weatherContent){
        $error = '<div class="alert alert-danger" role="alert">
        Could not find city - Please Try Again !
        </div>';
    }else{
        $weatherArray = json_decode($weatherContent,true);
        $weatherIcon = '<img src="http://openweathermap.org/img/wn/'.$weatherArray['weather'][0]['icon'].'.png" alt="weathericon"><br/>';
        $start = '<div class="alert alert-success" role="alert">';
        $content = 'The weather in '.$weatherArray['name'].' is currently '.$weatherArray['weather'][0]['description'].'.<br/>';
        $tempInCelcius = intval($weatherArray['main']['temp']-273);
        $windSpeed = $weatherArray['wind']['speed']*3.6;
        $content .= "The temperature is ".$tempInCelcius.' &deg;C and the wind speed is '.$windSpeed.' km/h.<br/>';
        $end = '</div>';
        $weather = $start.$weatherIcon.$content.$end;
    }


}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's The Weather</title>
    <link rel = "icon" href="image/icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1 id="title-head">What's The Weather?</h1>
        <form method="GET">
            <label for="city" class="form-label">Enter the name of a city</label>
            <input type="text" class="form-control" id="city" placeholder="eg. New Delhi, Patna, Kolkata, London, New York" name="city">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="weather">
            <?php 
                echo $weather.$error;
            ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>