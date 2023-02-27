<?php

include "includes/header.php";
include('database.php');
$statement = $db->prepare('SELECT * FROM GAME');
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<main class="container">
  <div class="starter-template text-center">
    <h1>Page 1</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
  </div>

    <div class="games">
        <?php foreach ($products as $product) : ?>
            <h4><?php echo $product['name'] ?></h4>
        <?php endforeach ?>
    </div>

</main><!-- /.container -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
