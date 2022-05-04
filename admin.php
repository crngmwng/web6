<?php

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin' ||
    md5($_SERVER['PHP_AUTH_PW']) != md5('123')) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

print('Вы успешно авторизовались и видите защищенные паролем данные.');


// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
  $user = 'u47590';
$pass = '3205407';
$db = new PDO('mysql:host=localhost;dbname=u47590', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
 $stmt = $db->prepare("SELECT `login`, `password`, `name` FROM `app`");
    $stmt->execute();
    foreach ($stmt as $row) {
      "<tr><td>{$row['login']}</td><td>{$row['password']}</td><td>{$row['name']} </td></tr>";
      }
}
   
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

/*$user = 'u47590';
$pass = '3205407';
$host = 'localhost';
$db_name='u47590';
$link = mysqli_connect($host, $user, $pass, $db_name);
?>
<table border='1'>
  <tr>
    <td>Идентификатор</td>
    <td>Наименование</td>
    <td>Цена</td>
  </tr>
  <?php
    $sql = mysqli_query($link, 'SELECT `login`, `password`, `name` FROM `app`');
    while ($result = mysqli_fetch_array($sql)) {
      echo "<tr><td>{$result['login']}</td><td>{$result['password']}</td><td>{$result['name']} </td></tr>";
    }
  ?>
</table>

*/
// *********
