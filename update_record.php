<?php
require('database.php');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$city = filter_input(INPUT_POST, 'city', FILTER_UNSAFE_RAW);
$countrycode = filter_input(INPUT_POST, 'countrycode', FILTER_UNSAFE_RAW);
$district = filter_input(INPUT_POST, 'district', FILTER_UNSAFE_RAW);
$population = filter_input(INPUT_POST, 'population', FILTER_UNSAFE_RAW);

if ($id) {
    $query = 'UPDATE city
              SET Name = :city, CountryCOde = :countrycode, District = :district, Population = :population
              WHERE ID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':countrycode', $countrycode);
    $statement->bindValue(':district', $district);
    $statement->bindValue(':population', $population);
    $success = $statement->execute();
    $statement->closeCursor();
}

$update = true;

include('index.php');
?>