<?php

include "includes/header.php";
include('database.php');

function get_dev(int $id, $db) {
    $statement = $db->prepare('SELECT DEVELOPER.* 
                            FROM DEVELOPER JOIN DEVELOP 
                            ON DEVELOPER.name = DEVELOP.name
                            WHERE id_game =' . $id);
    $statement->execute();
    $devs = $statement->fetchAll();
    $statement->closeCursor();
    return $devs;
}

$statement = $db->prepare('SELECT * FROM GAME ORDER BY released_year DESC, name');
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<main class="container">
  <div class="starter-template text-center">
    <h1 class="p-5">Our games</h1>
  </div>

    <div class="d-flex flex-wrap gap-5 justify-content-center">
        <?php foreach ($products as $product) : ?>
            <div class="game">
                <a href="<?php
                        echo "game.php?id=".$product['id'] ?>">
                    <img class="game-box" src="<?php echo $product['media_url']?>" alt="<?php echo $product['name'] ?>'s box">
                </a>
                <p class="text-primary">
                <p class="fw-bold"><?php echo $product['name'] ?></p>
                    <p><?php $tab = get_dev($product['id'], $db);
                    echo "Released year: ".$product['released_year']."<br/>";
                    echo "Publisher: " . $product["publisher"]."<br/>";
                    if (count($tab) > 1) {
                        echo "Developers: ";
                        echo "<ul>";
                        foreach ($tab as $dev) {
                            echo "<li>" . $dev['name'] . "</li>";
                        }
                        echo '</ul>';
                    } else {
                        echo "Developer: " . $tab[0]["name"] . "<br/>";
                    }
                    ?>
                    </p>
                </p>
            </div>
        <?php endforeach ?>

    </div>

</main><!-- /.container -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
