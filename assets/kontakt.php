<?php
mb_internal_encoding("UTF-8");

  $hlaska = '';
  if (isset($_GET['uspech']))
    $hlaska = 'Email byl úspěšně odeslán, brzy vám odpovíme.';

  if ($_POST)     //v poli POST něco je, odeslal se formulář
  {
    if (isset($_POST['jmeno']) && $_POST['jmeno'] &&  //Potřebujeme tedy zjistit, zda v $_POST 
        isset($_POST['email']) && $_POST['email'] &&  //existují jednotlivé proměnné. K tomu v PHP 
        isset($_POST['zprava']) && $_POST['zprava'] &&  //slouží funkce isset()
        isset($_POST['rok']) && $_POST['rok'] == date('Y'))
    {
      // Sem přijde odeslání emailu
      $hlavicka = 'From: ' . $_POST['email'];
      $hlavicka .= "\nMIME-Version: 1.0\n";
      $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
      $adresa = 'jindrichpsenicny@gmail.com';
      $predmet = 'Nová zpráva z mailformu';
      $uspech = mb_send_mail($adresa, $predmet, $_POST['zprava'], $hlavicka);
      
      if ($uspech)
      {
          $hlaska = 'Email byl úspěšně odeslán, brzy vám odpovíme.';
          header('Location: index.php?uspech=ano');
          exit;
      }
      else
      {
          $hlaska = 'Email se nepodařilo odeslat. Zkontrolujte adresu.';
      }
    }
    else
    {
      $hlaska = 'Formulář není správně vyplněný!';
    }
  }
  
?>
<!DOCTYPE html>
<!--Vytvoril: Jindrich Psenicny-->
<html lang="cs-cz">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="tattoo, permanentní make-up, vizáž, obočí, linky, rty">
  <meta name="Psenicny Jindrich" content="Permanentní make-up">
  <title>Permanentní make-up</title>
  
  <link href="../css/reset.css" rel="stylesheet">
  <link href="../css/main_style.css" rel="stylesheet">
  <link href="../css/role.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

    <body>
      <header>
        <div class="grid-container">
          <div class="logo"><img alt="logo" src="../icon/transparent.png"></div>
          <div class="kontaktni-informace">
            <div>tel +49 1522 5948362</div>
            <div>Po - Pá 10.00 - 18.00</div>
          </div>     
        </div>
      </header>

      <div class="nav">
          <div></div>
          <div class="topnav" id="myTopnav">
            <a href="../index.php">Domů</a>
            <a href="galery.php">Galerie</a>
            <a href="#price">Ceník</a>
            <a href="#contact" class="active">Kontakty</a>
            <a href="kontakt_ru.php">Русский</a>
            <a href="#about">Deutsch</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
          </div>
        </div>
      
      
      <?php
      if ($hlaska)
        echo('<p>' . $hlaska . '</p>'); //Zde se vypíšou hlášky podle situace, jak dopadlo odeslání emailu

      $jmeno = (isset($_POST['jmeno'])) ? $_POST['jmeno'] : '';
      $email = (isset($_POST['email'])) ? $_POST['email'] : '';
      $zprava = (isset($_POST['zprava'])) ? $_POST['zprava'] : '';  
    ?>
      <div id='wrapper'>
        <form method="POST" class='form'>
          <p class='field required half'>
            <label class='label required' for='name'>Jméno</label>
            <input class='text-input' id='name' name='jmeno' required type='text' value='<?= htmlspecialchars($jmeno) ?>' />
          </p>
          <p class='field required half'>
            <label class='label' for='email'>E-mail</label>
            <input class='text-input' id='email' name='email' required type='email' value='<?= htmlspecialchars($email) ?>' />
          </p>
          <p class='field'>
            <label class='label' for='message'>Zpráva</label>
            <textarea class='textarea' cols='50' id='message' name='zprava' required rows='4'><?= htmlspecialchars($zprava) ?></textarea>
          </p>
          <p class='field'>
            <input class='button' type='submit' value='Odeslat zprávu'>
          </p>
          <p class='field'>
            <label class='label' for='rok'>Zde napište aktuální rok</label>
            <input class='text-input' id='rok' name='rok' required type='text' />
          </p>
        </form>
</div>


        
<!-- local js ============================================================== -->
<script src="../js/main_java.js"></script>        
</body>
</html>

