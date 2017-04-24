<?php
/*** mysql hostname ***/
$hostname = 'wftuqljwesiffol6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';

/*** mysql username ***/
$username = 'ck7qnb1sp3elbbtk';

/*** mysql password ***/
$password = 'c9og060xxklz3qz8';

$dbname = 'o7jfr0rpoevbgt5k';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

if($_POST['name']) {
    $name       = $_POST['name'];
    $message    = $_POST['message'];
    /*** set all errors to execptions ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO beatykyivbase.shoutbox1 (date_time, name, message)
            VALUES (NOW(), :name, :message)";
    /*** prepare the statement ***/
    $stmt = $dbh->prepare($sql);

    /*** bind the params ***/
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    /*** run the sql statement ***/
    if ($stmt->execute()) {
        populate_shoutbox();
    }
} 
}
catch(PDOException $e) {
    echo $e->getMessage();
}

if($_POST['refresh']) {
    populate_shoutbox();
}


function populate_shoutbox() {
    global $dbh;
    $sql = "select * from shoutbox1 order by date_time desc limit 10";
    echo '<ul>';
    foreach ($dbh->query($sql) as $row) {
        echo '<li>';
        echo '<span class="date">'.date("d.m.Y H:i", strtotime($row['date_time'])).'</span>';
        echo '<span class="name">'.$row['name'].'</span>';
        echo '<span class="message">'.$row['message'].'</span>';
        echo '</li>';
    }
    echo '</ul>';
}
?>