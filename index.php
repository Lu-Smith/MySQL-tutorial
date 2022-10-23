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
        <section>
            <h2>Read Data</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
               <label for="city">
                City Name
               </label>
               <input type="text" id="city" name="city" required />
               <button>Submit</button>
            </form>
        </section>
        <section>
            <h2>Insert Data</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
               <label for="newcity">
                City Name
               </label>
               <input type="text" id="newcity" name="newcity" required />
               <label for="countrycode">
                 Country Code 
               </label>
               <input type="text" id="countrycode" name="countrycode" maxlenght="3" required />
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
    </main>
</body>
</html>