<?php
mb_internal_encoding("UTF-8");

  $hlaska = '';
  if (isset($_GET['uspech']))
    $hlaska = 'Письмо успешно отправлено, я отвечу вам в ближайшее время';

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
      $predmet = 'Новое сообщение из почтовой формы';
      $uspech = mb_send_mail($adresa, $predmet, $_POST['zprava'], $hlavicka);
      
      if ($uspech)
      {
          $hlaska = 'Письмо успешно отправлено, я отвечу вам в ближайшее время';
          header('Location: index.php?uspech=ano');
          exit;
      }
      else
      {
          $hlaska = 'Электронное письмо не может быть отправлено. Проверьте адрес.';
      }
    }
    else
    {
      $hlaska = 'Форма заполнена неправильно!';
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
            <div>тел +49 1522 5948362</div>
            <div>По - Пя 10.00 - 18.00</div>
          </div>     
        </div>
      </header>

      <div class="nav">
          <div></div>
          <div class="topnav" id="myTopnav">
            <a href="rusky.php">Дом</a>
            <a href="galery_ru.php">Галерея</a>
            <a href="#price">Прайс-лист</a>
            <a href="#kontakt_ru" class="active">Контакты</a>
            <a href="kontakt.php">Česky</a>
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
            <label class='label required' for='name'>имя</label>
            <input class='text-input' id='name' name='jmeno' required type='text' value='<?= htmlspecialchars($jmeno) ?>' />
          </p>
          <p class='field required half'>
            <label class='label' for='email'>Эл. почта</label>
            <input class='text-input' id='email' name='email' required type='email' value='<?= htmlspecialchars($email) ?>' />
          </p>
          <p class='field'>
            <label class='label' for='message'>Сообщение</label>
            <textarea class='textarea' cols='50' id='message' name='zprava' required rows='4'><?= htmlspecialchars($zprava) ?></textarea>
          </p>
          <p class='field'>
            <input class='button' type='submit' value='Послать сообщение'>
          </p>
          <p class='field'>
            <label class='label' for='rok'>Напишите здесь текущий год</label>
            <input class='text-input' id='rok' name='rok' required type='text' />
          </p>
        </form>
</div>


        
<!-- local js ============================================================== -->
<script src="../js/main_java.js"></script>        
</body>
</html>
