<?php
class weatherAPI
{
    
    public function __construct() {       
     
    }
   
    public function getGeoUpdates($location) {

        // Positionstack API access key
        $apiKey = 'ba07929ba9bf59d60273915d9996f7e5';

        // location you want to get details for
        $query = $location;

        // API URL with the API key and the location query
        $apiUrl = "http://api.positionstack.com/v1/forward?access_key={$apiKey}&query={$query}";

        // Initialize cURL options and execute the curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'cURL Error: ' . curl_error($curl);
            exit();
         }
        // Close cURL session
        curl_close($curl);
        return $response;      
                          
    }

    public function getWeatherUpdates($latitude,$longitude) {

        // openweathermap API access key
        $apiKey = '4d3cdd60814fc80ba5dc03352851748f';

        // Build the API URL with the API key and the geo details.
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&appid={$apiKey}";

        // Initialize cURL options and execute the curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'cURL Error: ' . curl_error($curl);
            exit();
         }
        // Close cURL session
        curl_close($curl);
        return $response;
    }

   
}

