<?php

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

$query = [];

try {
    include "includes/header.php";
    include('database.php');

    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($url);
    parse_str($parts['query'], $query);

    $id = $query['id'];

    $statement = $db->prepare("SELECT * FROM `GAME` WHERE `id`=$id");
    $statement->execute();
    $games = $statement->fetchAll();
    if (!$games) throw new Exception();
} catch (Exception $e) {
    header("Location: games.php");
}

?>

<main class="container">
  <div class="starter-template">
      <?php foreach($games as $game): ?>
          <h1 class="text-center modal-title"><?php echo $game['name'] ?></h1>
              <div class="justify-content-center game-individual">
                  <img class="game-pic" src="<?php echo $game['media_url'] ?>">
                  <p class="fw-bold fs-3"><?php echo $game['name'] ?></p>
                  <p class="fw-bold fs-3">Publisher: <a class="a" href="<?php echo $game['website'] ?>" target="_blank"><?php echo $game['publisher'] ?></a></p>
                  <p class="fw-bold fs-3">
                  <?php $tab = get_dev($game['id'], $db);
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
                  <p class="fw-bold fs-3"> Description </p>
                  <p><?php echo $game['description']; ?></p>
          </div>
      <?php endforeach; ?>
  </div>

</main><!-- /.container -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
