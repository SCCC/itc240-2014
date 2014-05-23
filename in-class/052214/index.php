<!doctype html>
<html>
    <body>
        <h1>WHAT YOU ATE:</h1>
        <form method="POST" action="edit.php">
            <input placeholder="type" name="type">
            <input placeholder="calories" name="calories">
            <input type="submit">
        </form>
        <a href="?sort=type">Type</a>
        <a href="?sort=id"> Id</a>
        <a href="?sort=calories">Calories</a>

<?php
    
    include("passwords.php");
    $mysql = new mysqli(
        "localhost", //server
        "twilburn", //username
        $mysql_password, //password
        "twilburn" //database name
    );
    
    $column = 'calories';
    if (isset($_REQUEST["sort"])) {
        $column = $_REQUEST["sort"];
    }
    $column = $mysql->real_escape_string($column);
    
    $whitelist = [
        "calories" => true,
        "id" => true,
        "type" => true
    ];
    
    if (!isset($whitelist[$column])) {
        $column = 'calories';
    }
    
    $prepared = $mysql->prepare("SELECT * FROM tracker_food ORDER BY $column DESC;");
    //don't need to bind - no parameters!
    $prepared->execute();
    $results = $prepared->get_result();

    foreach ($results as $row) {
?>
    <div> 
        <?= htmlentities($row["calories"]) ?>
        calories from 
        <?= htmlentities($row["type"]) ?>
    </div>
<?php
    }

    $sumQuery = $mysql->prepare('SELECT SUM(calories) AS sum FROM tracker_food;');
    //don't need to bind, no parameters
    $sumQuery->execute();
    //results don't come back from DB until get_result
    $sumResult = $sumQuery->get_result();

    $sum = $sumResult->fetch_array();
    
    $maxQuery = $mysql->prepare('SELECT MAX(calories) AS calories FROM tracker_food WHERE calories < 500;');
    $maxQuery->execute();
    $maxResult = $maxQuery->get_result();
    $max = $maxResult->fetch_array();
    
    $countResult = $mysql->query('SELECT COUNT(*) AS rows FROM tracker_food WHERE calories >= 200 AND calories <= 800;');
    $count = $countResult->fetch_array();
?>
        <div>
            Your total calorie input is:
            <?= $sum["sum"] ?>
        </div>
        <div>
            Your highest input was:
            <?= $max["calories"] ?>
        </div>
        <div>
            Total number of meals:
            <?= $count["rows"] ?>
        </div>
    </body>
</html>