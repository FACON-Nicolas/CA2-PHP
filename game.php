<?php include "includes/header.php" ?>

<!--
`website` TEXT NOT NULL,
`media_url` TEXT NOT NULL

-->
<main class="container">
  <div class="starter-template">
    <h1>Add a game</h1>
      <form action="add_game.php" method="post">
          <div class="form-group">
              <label for="name">Name: </label>
              <input type="text" class="form-control" name="name" placeholder="name" required>
          </div>
          <div class="form-group">
              <label for="year">Year: </label>
              <input type="text" class="form-control" name="year" placeholder="year" required>
          </div>
          <div class="form-group">
              <label for="email">Publisher: </label>
              <input type="text" class="form-control" name="publisher" placeholder="publisher" required>
          </div>
          <div class="form-group">
              <label for="email">Website Publisher: </label>
              <input type="text" class="form-control" name="website" placeholder="website" required>
          </div>
          <div class="form-group">
              <label for="email">url picture: </label>
              <input type="text" class="form-control" name="media_url" placeholder="url picture" required>
          </div>
          <button class="btn btn-primary" type="submit">Button</button>
      </form>
    <p class="lead"></p>
  </div>

</main><!-- /.container -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
