<?php

$dsn = 'mysql:host=localhost;dbname=game_shop';
$username = 'rooot';
$password = 'root';

try {
    $db = new PDO($dsn, $username, $password);
    $statement = $db->prepare("select * from game");
    $statement->execute();
    $devs = array();
    $gens = array();

    $row = 1;
    if (count($statement->fetchAll()) == 0) {
        $statement->closeCursor();
        if (($file = fopen('db.csv', 'r')) !== false) {
            while (($data = fgetcsv($file, 20000, ";")) !== false) {
                if ($row++!=1) {
                    $id = $data[0];
                    $name = $data[1];
                    $publisher = $data[2];
                    $released_year = $data[3];
                    $developer = $data[4]; // to split.
                    $gender = $data[5]; // to split
                    $website = $data[6];
                    $media = $data[7];
                    $description = $data[8];

                    $statement = $db->prepare('INSERT INTO `GAME` VALUES (:id, :name, :publisher, :released_year, :website, :media, :desc)');
                    $statement->bindValue(':id', $id);
                    $statement->bindValue(':name', $name);
                    $statement->bindValue(':publisher', $publisher);
                    $statement->bindValue(':released_year', $released_year);
                    $statement->bindValue(':website', $website);
                    $statement->bindValue(':media', $media);
                    $statement->bindValue(":desc", $description);
                    $statement->execute();
                    $statement->closeCursor();

                    $d = explode(",", $developer);
                    foreach ($d as $dev) {
                        if (!in_array($dev, $devs)) {
                            $devs[] = $dev;
                            $statement = $db->prepare('INSERT INTO `DEVELOPER` VALUES (:dev)');
                            $statement->bindValue(':dev', $dev);
                            $statement->execute();
                            $statement->closeCursor();
                        }
                        $statement = $db->prepare('INSERT INTO `DEVELOP` VALUES (:dev, :id)');
                        $statement->bindValue(':dev', $dev);
                        $statement->bindValue(':id', $id);
                        $statement->execute();
                        $statement->closeCursor();
                    }

                    $d = explode(",", $gender);
                    foreach ($d as $gen) {
                            if (!in_array($gen, $gens)) {
                                $gens[] = $gen;
                                $statement = $db->prepare('INSERT INTO `GENDER` VALUES (:gen)');
                                $statement->bindValue(':gen', $gen);
                                $statement->execute();
                                $statement->closeCursor();
                            }
                            $statement = $db->prepare('INSERT INTO `GENDER_GAME` VALUES (:gen, :id)');
                            $statement->bindValue(':gen', $gen);
                            $statement->bindValue(':id', $id);
                            $statement->execute();
                            $statement->closeCursor();
                        }
                    }
                }
            }
        }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}
