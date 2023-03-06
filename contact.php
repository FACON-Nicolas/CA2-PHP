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
    <h1>Please contact us</h1>
    <p class="lead">Please use this page to contact us, about the games we sell or about something else.<br> It will be a pleasure to give you an answer !</p>
  </div>

    <form action="contact_post.php" method="POST">
        <div class="row">
            <div class="col">
                <label for="firstName">First Name: </label>
                <input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name" required>
            </div>
            <div class="col">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="text" class="form-control" name="email" placeholder="E-mail" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="game"> Game's name: </label>
            <?php if(count($products) < 50): ?>
                <select class="form-control" name="game">
                    <option selected>Select a game</option>
                    <?php foreach ($products as $item): ?>
                        <option name="game" value="<?php echo $item['name'] ?>"><?php echo $item['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <input type="text" name="game" id="game" class="form-control" placeholder="Game's name" pattern="[\pL\pN]+(?=\h+[\pL\pN]+$)">
            <?php endif; ?>
        </div>
        <div>
            <label for="request">Request</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="request" id="inlineRadio1" value="Question">
                    <label class="form-check-label" for="inlineRadio1">Question</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="request" id="inlineRadio2" value="Issue">
                    <label class="form-check-label" for="inlineRadio2">Issue</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="request" id="inlineRadio3" value="Suggestion">
                    <label class="form-check-label" for="inlineRadio3">Suggestion</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="city">Town / City: </label>
                <input class="form-control" type="text" name="city" id="city" placeholder="city" pattern="[\pL\pN]+(?=\h+[\pL\pN]+$)" required>
            </div>
            <div class="col">
                <label for="street">Street: </label>
                <input class="form-control" type="text" name="street" id="street" placeholder="street" pattern="[\pL\pN]+(?=\h+[\pL\pN]+$)" required>
            </div>
            <div class="col-1">
                <label for="street-number">N°: </label>
                <input class="form-control" type="text" name="number" id="street-number" placeholder="street number" pattern="[0-9]{1-5}" required>
            </div>
            <div class="col-2">
                <label for="lastName">Zip:</label>
                <input class="form-control" type="text" name="zip" id="zip" placeholder="Zip" pattern="^[AC-FHKNPRTV-Y]\d[0-9W][ -]?[0-9AC-FHKNPRTV-Y]{4}$" required>
            </div>
        </div>

        <div class="form-group">
            <textarea class="form-control" placeholder="Please write your message here" name="message"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Button</button>

    </form>

</main><!-- /.container -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
