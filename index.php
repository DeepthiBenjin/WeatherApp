<!DOCTYPE html>   
<html>   
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title> RSAWEB </title> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
 <!-- Link to your custom SCSS file -->
 <link rel="stylesheet" href="styles/styles.css">
</head>    
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Weather App</h2>
                <form method="post" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="location" class="form-control" placeholder="Enter your location" required>
                        <button type="submit" class="btn btn-primary">Get Weather</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>   
</html>  

<?php

if (!defined('ABSPATH'))
require_once('load.php');
//require_once(ABSPATH . 'config/defines.php');
require_once(ABSPATH . 'webserviceimport.php');

class Importer{

        private $location;
        private $wsimporter;

    public function __construct($location)
    {         
        $this->location = $location;
    }
    
    public function import()
    {  
	
       if(!empty($this->location)) {
         // Get geographical coordinates using Positionstack API
            $wsimporter = new weatherAPI();
            $positionstackResponse = $wsimporter->getGeoUpdates($this->location);
            $positionstackData = json_decode($positionstackResponse, true);  
            if (!empty($positionstackData['data'][0]['latitude']) && !empty($positionstackData['data'][0]['longitude'])) {
              $latitude = $positionstackData['data'][0]['latitude'];
              $longitude = $positionstackData['data'][0]['longitude'];

              // Get weather data using OpenWeatherMap API
              $openWeatherMapResponse = $wsimporter->getWeatherUpdates($latitude,$longitude);
              $openWeatherMapData = json_decode($openWeatherMapResponse, true);
              if (!empty($openWeatherMapData['main']) && !empty($openWeatherMapData['weather'][0])) {

                $temperature = $openWeatherMapData['main']['temp'];
                $description = $openWeatherMapData['weather'][0]['description'];
                $windSpeed = $openWeatherMapData['wind']['speed'];
                $windDirection = $openWeatherMapData['wind']['deg'];

                // Display the weather information
                echo "<div class='container mt-4'>";
                echo "<div class='weather-info'>";
                echo "<h3>Weather in $this->location </h3>";

                echo "<div class='weather-values'>
                      <div class='weather-value'>
                      <img src='images/temperature-icon.png' alt='Temperature Icon'>
                      <p>Temperature:</p><br>
                      <p class='temperature'><br> $temperature &#8451;</p>
                      </div>";

                echo "<div class='weather-value'>
                      <img src='images/description-icon.png' alt='Description Icon'>
                      <p>Description:</p><br>
                      <p class='temperature'><br> $description </p>
                      </div>";

                echo "<div class='weather-value'>
                      <img src='images/wind-speed-icon.png' alt='Wind Speed Icon'>
                      <p>Wind Speed:</p><br>
                      <p class='temperature'><br> $windSpeed  m/s</p>
                      </div>";

                echo "<div class='weather-value'>
                      <img src='images/wind-direction-icon.GIF' alt='Wind Direction Icon'>
                      <p>Wind Direction: </p><br>
                      <p class='temperature'><br>$windDirection &deg;</p>
                      </div>";
                echo  "</div>";
                echo "</div>";
                echo "</div>"; 
                
               } 
            }  else {
                echo "<div class='container mt-4'>";               
                echo "<h4>No weather data available for the specified location.</h4>";
                echo "</div>";
              
                }
                       
        }
    }  
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = $_POST['location'];
    $importer = new Importer($location);
    $importer->import();
   
  } 
?>

