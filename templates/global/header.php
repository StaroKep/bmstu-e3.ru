<?php 
  // Просто запуск сессии
  session_start();

  if ($_GET["block"] != "false") {
    // header("Location: http://bmstu-e3.ru/pages");
  }
?>

<!DOCTYPE html>
<html lang="ru">

  <!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<head>
  <!-- Кодировка -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- Для IE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Для мобильных устройств -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1">   -->
  <!-- Иконка для сайта -->
  <link rel="shortcut icon" href="/assets/images/ico/favicon.ico" type="image/x-icon">
  
  <!-- Заголовок -->
  <title><?php echo $head_title; ?></title>
  
  <!-- Стили -->
  <!-- Мои -->
  <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
  

  <!-- Font Awasome -->
  <link rel="stylesheet" type="text/css" href="/assets/other/font-awesome-4.7.0/css/font-awesome.min.css">

  <!-- Скрипты -->
  <!-- JQ local -->
  <script src="/assets/js/jq/jquery-3.1.1.min.js"></script>
  <!-- Мои -->
  <script src="/assets/js/scripts.js"></script>
  <!-- VKapi -->
  <script src="https://vk.com/js/api/openapi.js?146" type="text/javascript"></script>

</head>

  <!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<body>

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter44734390 = new Ya.Metrika({ id:44734390, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/44734390" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->



<div class="header-area gif-bgi">
  <div class="header">

    <!-- Верхнее меню -->
    <div class="top-menu">
      
      <!-- Открытие полного меню сайта -->
      <div id="start-full-menu" class="menu-el">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </div>
      
      <!-- Короткое меню быстрого доступа -->
      <a href="/pages/home/"><div class="menu-el">Главная</div></a>
      <a href="/pages/news/"><div class="menu-el">Новости</div></a>
      <a href="/pages/entrant/"><div class="menu-el">Абитуриентам</div></a>
      <a href="/pages/about/"><div class="menu-el">О кафедре</div></a>
      <a href="/pages/contingent/tutors/"><div class="menu-el">Преподаватели</div></a>
      <a href="http://energo.bmstu.ru/"><div class="menu-el">Факультет</div></a>
      

      <!-- Элементы меню в зависимости от авторизации -->
      <?php 
        // Если пользователь авторизован, то показываем вход в ЛК и выход
        if ($_SESSION["user_login"] != ""){ 
          echo '
            <a href="/application/exit/"><div class="menu-el right-menu-el">
                Выход
            </div></a> 
            <a href="/pages/i/"><div class="menu-el right-menu-el">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div></a>
          ';
        }
        // Если пользователь не авторизован, то ссылка на авторизацию
        else{
          echo '
            <a href="/pages/authentication/"><div class="menu-el right-menu-el">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            </div></a>
          ';
        }
      ?>

      <!-- Отправить письмо на кафедру -->
      <a href="/pages/write-mail/">
        <div class="menu-el right-menu-el">
          <i class="fa fa-envelope" aria-hidden="true"></i>
        </div>
      </a> 
      <br clear="all"/>

      <!-- /// /// Короткое меню быстрого доступа /// /// -->
      
    </div>
    <!-- /// /// Верхнее меню /// /// -->
  
    <!-- Область польного меню -->
    <div class="full-menu-area">

      <div class="right-site-settings">
        <div class="on-off-el" id="on-off-gif">GIF</div>
      </div>

      <div class="first-line-full-menu">
        <!-- <a href="#">Аспиранты</a>
        <a href="/pages/chronicle/">Летопись</a>
        <a href="#">Галерея</a>
        <a href="#">Объявления</a>
        <a href="#">Полезная информация</a> -->
      </div>

      <div class="bottom-line-full-menu">
        <a href="http://www.bmstu.ru/">МГТУ им. Н. Э. Баумана</a>
        <a href="/pages/route/">Как добраться</a>
        <a href="/pages/other-links/">Сторонние источники</a>
        
        <a href="#" id="menu-schedule-time" title="
          <?php date_default_timezone_set('Europe/Moscow'); echo date('m.d.Y H:i:s'); ?> 
        ">
          <?php 
            echo date('H:i:s') . $week_special;
          ?>
        </a>
      </div>
      
    </div>

    <!-- Логотип, факультет, кафедра -->
    <div class="logo-and-department">
      <div class="bmstu-logo"><a href="http://www.bmstu.ru/"></a></div>
      <?php if ($head_title == "Э3 МГТУ им. Н. Э. Баумана"): ?>
        <div class="energo-name"><a href="http://energo.bmstu.ru/">Энергомашиностроение</a></div>
        <div class="e3-name"><a href="/pages/home/">Газотурбинные и нетрадиционные энергоустановки</a></div> 
      <?php else: ?>
        <div class="energo-name"><?php echo $title; ?></div>
        <div class="e3-name"><a href="/pages/home/">Газотурбинные и нетрадиционные энергоустановки</a></div> 
      <?php endif ?>
    </div>

  </div>
</div>