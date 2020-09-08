<?php include('header.php'); ?>
<div class="container">
<form class="connexion-form" action="traitement.php" method="POST">
  <div class="mb-3">
    <label for="email" class="form-label">Entrez votre email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="emailconn">
    <!-- <div id="email" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">saisissez votre mot de passe</label>
    <input type="password" class="form-control" id="password" name="passwordconn">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php include('footer.php'); ?>
