<?php

// tests/WeatherAppTest.php
use PHPUnit\Framework\TestCase;

require_once 'index.php'; 

class WeatherAppTest extends TestCase
{
    public function testValidLocation()
    {
        $location = 'London';
        $importer = new Importer($location);
        $this->expectOutputRegex('/Weather in London/');
        $importer->import();
    }

    public function testInvalidLocation()
    {
        $location = 'InvalidCityName';
        $importer = new Importer($location);
        $this->expectOutputRegex('/No weather data available for the specified location/');
        $importer->import();
    }

    // Add more test cases as needed
}
?>