<?php 
$newcity = filter_input(INPUT_POST, "newcity", FILTER_UNSAFE_RAW);
$countrycode = filter_input(INPUT_POST, "countrycode", FILTER_UNSAFE_RAW);
$district = filter_input(INPUT_POST, "district", FILTER_UNSAFE_RAW);
$population = filter_input(INPUT_POST, "population", FILTER_UNSAFE_RAW);

$city = filter_input(INPUT_GET, "city", FILTER_UNSAFE_RAW);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>PDO tutorial</title>
</head>
<body>
    <main>
        <header>
            <h1>PDO</h1>
        </header>
        <?php
        if (isset($deleted)) {
            echo "Record deleted.<br /><br />";
        } else if(isset($updated)) {
            echo "Record updated.<br /><br />";
        }
        ?>
        <?php
        if (!$city && !$newcity) { 
        ?>
            <section>
                <h2>Read Data</h2>
                <form action="." method="GET">
                <label for="city">
                    City Name
                </label>
                <input type="text" id="city" name="city" required />
                <button>Submit</button>
                </form>
            </section>
            <section>
                <h2>Insert Data</h2>
                <form action="." method="POST">
                <label for="newcity">
                    City Name
                </label>
                <input type="text" id="newcity" name="newcity" required />
                <label for="countrycode">
                    Country Code 
                </label>
                <input type="text" id="countrycode" name="countrycode" maxlength="3" required />
                <label for="district">
                    District
                </label>
                <input type="text" id="district" name="district" required />
                <label for="population">
                    Population
                </label>
                <input type="text" id="population" name="population" required />
                <button>Submit</button>
                </form>
            </section>
        <?php
        } else {
        ?>
        <?php require("database.php"); ?>
        <?php 
        if ($newcity) {
           $query = "INSERT INTO city (Name, CountryCode, District, Population)
                    VALUES (:newcity, :countrycode, :district, :population)";
            $statement = $db->prepare($query);
            $statement->bindValue(':newcity', $newcity);
            $statement->bindValue(':countrycode', $countrycode);
            $statement->bindValue(':district', $district);
            $statement->bindValue(':population', $population);
            $statement->execute();
            $statement->closeCursor();
        }

        if ($city || $newcity) {
            $query = 'SELECT * FROM city
                       WHERE Name = :city
                       ORDER BY Population DESC';
            $statement = $db->prepare($query);
            if ($city) {
                $statement->bindValue(':city', $city);
            } else {
                $statement->bindValue(':city', $newcity);
            }
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
        }
        ?>
        <?php
         if (!empty($results)) {
        ?>
           <section>
             <h2>Update Data</h2>
             <?php foreach ($results as $result) {
                $id = $result['ID'];
                $city = $result['Name'];
                $countrycode = $result['CountryCode'];
                $district = $result['District'];
                $population = $result['Population'];
             ?>
                <form class="update" action="update_record.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <label for="city-<?php echo $id ?>">City Name</label>
                    <input 
                        type="text" 
                        id="city-<?php echo $id ?>" 
                        name="city" 
                        value="<?php echo $city ?>"
                        required />
                    <label for="countrycode-<?php echo $id ?>">Country Code</label>
                    <input 
                        type="text" 
                        id="countrycode-<?php echo $id ?>" 
                        name="countrycode" 
                        value="<?php echo $countrycode ?>"
                        required />
                    <label for="district-<?php echo $id ?>">District</label>
                    <input 
                        type="text" 
                        id="district-<?php echo $id ?>" 
                        name="district" 
                        value="<?php echo $district ?>"
                        required />
                    <label for="population-<?php echo $id ?>">Population</label>
                    <input 
                        type="text" 
                        id="population-<?php echo $id ?>" 
                        name="population" 
                        value="<?php echo $population ?>"
                        required />
                    <button class="green">Update</button>
                </form>
                <form class="delete" action="delete_record.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <button class="red">Delete</button>
                </form>
             <?php } ?>
           </section>
        <?php
         } else {
        ?>
        <p>Sorry, no results.</p>
        <?php
         }
        ?>
        <a class="go-home" href=".">Go to request forms</a>
        <?php
        } 
        ?>
    </main>
</body>
</html>