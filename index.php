<?php include "includes/header.php";
include("database.php");

$statement = $db->prepare('SELECT * FROM GAME WHERE id < 10 ORDER BY released_year DESC, name');
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();

?>

<div class="pt-5 pb-3">
    <h1 class="card-title fw-bolder game-main-title">MY<br/>NEW<br/>GAME</h1>
    <img class="main-img" src="https://i.redd.it/cd46ipwu48i51.jpg">
    <img class="game-main-img" src="https://applebygames.co.nz/wp-content/uploads/2023/02/CALL-OF-DUTY-COLD-WAR-XBOX-ONE-GAME.png"
</div>

<main class="container">
  <div class="starter-template text-center">
    <h1 class="pt-4">My games</h1>
      <div class="scrollmenu">
          <?php foreach($products as $game): ?>
              <a href="games.php"><img class="game-scroll" src="<?php echo $game['media_url'] ?>" alt="<?php echo $game['name'] ?>"></a>
           <?php endforeach; ?>
      </div>
  </div>

</main><!-- /.container -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
