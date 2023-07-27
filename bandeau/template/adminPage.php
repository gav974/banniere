<div class="banner">
<div class="wrap">
    <h1 >Ma bannière</h1>
  </div>
  <hr>
<div class="banner-admin-message">
  <p>
Le plugin affiche une bannière sur la page d'accueil de WordPress pour afficher des messages dynamiques.</p>
  <p>Veuiller entrer vos messages en les separant avec une virgule: <small> <em> message , message 2 , message3 </em></small></p>
  
</div>

<form class="banner-admin-form" action="?page=bandeau/bandeau.php&action=ba_mes_messages" method="post">
  <label for="ba-messaging">Entrer vos messages ici </label>
    <input type="text" name="ba_mes_messages" value="<?php echo $string_message ?>" id="ba-messaging" required>
  <input type="submit" value="Enregistrer" >
</form>
<?php if(isset($status)){
  echo '<p style="color:'.$status[0].';">'.$status[1].'</p>';
}?>
<div class="small">
<small>Extension developpée par <a href="mailto:johanny.eclapier@upstart.re">Johanny Eclapier</a> <?php echo date('Y'); ?></small><br>
<small >Si vous ♥️ l'extension envoyez-moi un courriel !  </small>
</div>
</div>




