<!DOCTYPE html>
<html>
<head>
    <style>
        .box{
            align-text: center;
        }
    </style>
</head>
<body>

<?php

 include 'project.php';
$host = 'localhost';
$username = 'root';
$db = 'PROJECT';
$password = 'manish';
$word = $_GET["mainphp"];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
$sql = " SELECT main.word,main.meaning1,main.meaning2,main.synonym1,main.synonym2,main.antonym1,main.antonym2,main.example1,main.example2,main.image,grammer.partofspeech,grammer.pronounciation,grammer.scientific_name,languages.marathi,languages.urdu,languages.tamil,languages.hindi from main  JOIN grammer ON main.wordID=grammer.wordID JOIN languages ON main.wordID=languages.wordID where word='$word'";
try {
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit;
}

foreach ($data as $row) {
    $color = "red";?>
    <div class="box"><?php
    echo "Word: " . $row['word'] . "<br>";
     echo "<br>Meaning: " . $row['meaning1'] . "<br>";
    echo  "Example: " . $row['example1'] ."<br>" ;
    
    echo "<br>Synonym:" . $row['synonym1'] . "," . $row['synonym2'] . "<br>";
    echo "Antonym:" . $row['antonym1'] . "," . $row['antonym2'] . "<br>";
    echo "Part of Speech:" . $row['partofspeech'] . "<br>";
    if (is_null($row['scientific_name']) == 0) {
        
        echo "<br>ScientificName:" . $row['scientific_name'] . "<br>";
    }
    echo "Pronounciation:" . $row['pronounciation'] . "<br>";


    echo "<br>Marathi:" . $row['marathi'] . "<br>";
    echo "TAMIL:" . $row['tamil'] . "<br>";
    echo "URDU" . $row['urdu'] . "<br>";
    echo "HINDI:" . $row['hindi'] . "<br>";
    if (is_null($row['meaning2']) == 0) {
        echo "<br>Meaning2" . $row['meaning2'] . "<br>";

    }
    if (is_null($row['image']) == 0) {
        ?> <br> <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']);?>" width=80 height=80 /><?php
    }
    ".<br>";

  ?></div><?php

    
}
$pdo = null;
?>
</body>
</html>