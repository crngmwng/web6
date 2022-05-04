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
if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $del =$_GET['del_id'];
    try {
    $stmt = $db->prepare("delete from app where login = :del");
    $stmt -> bindParam(':del', $del);
    $stmt->execute();
    }
    catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
    }
  }
$values = array();
if (isset($_GET['red_id'])) {
       $red =$_GET['red_id'];
    try {
    $stmt = $db->prepare("select login, name, email, year, sex, limbs, ability_immortality, ability_pass_thr_walls, ability_levitation, bio, checkbox from app where login = :red");
    $stmt -> bindParam(':red', $red);
    $stmt->execute();
        foreach ($stmt as $row) {
      $values['name']=$row["name"];
      $values['email'] = $row["email"];
      $values['bio'] = $row["bio"];
	$values['year']=$row["year"];
	$values['radio-group-1']=$row["sex"];
	$values['radio-group-2']=$row["limbs"];
	$values['check-1']=$row["checkbox"];
      }
        
    include('form.php');
    }
    catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
    }
  }
  ?>
<table border='1'>
    <tr>
    <td>Логин</td>
    <td>Пароль</td>
    <td>Имя</td>
        <td>Еmail</td>
        <td>Год</td>
        <td>Пол</td>
        <td>Кол-во конечностей</td>
        <td>Бессмертие</td>
        <td>Прохождение сквозь стены</td>
        <td>Левитация</td>
        <td>Биография</td>
        <td>Галочка</td>
  </tr>
    <?php
try {
 $stmt = $db->prepare("SELECT login, password, name, email, year, sex, limbs, ability_immortality, ability_pass_thr_walls, ability_levitation, bio, checkbox FROM app");
    $stmt->execute();
    
    foreach ($stmt as $row) {
     echo '<tr>'.
        "<td>{$row["login"]}</td>".
        "<td>{$row["password"]}</td>".
        "<td>{$row["name"]}</td>".
         "<td>{$row["email"]}</td>".
         "<td>{$row["year"]}</td>".
         "<td>{$row["sex"]}</td>".
         "<td>{$row["limbs"]}</td>".
         "<td>{$row["ability_immortality"]}</td>".
         "<td>{$row["ability_pass_thr_walls"]}</td>".
         "<td>{$row["ability_levitation"]}</td>".
         "<td>{$row["bio"]}</td>".
         "<td>{$row["checkbox"]}</td>".
        "<td><a href='?del_id={$row['login']}'>Удалить</a></td>".
         "<td><a href='?red_id={$row['login']}'>Редактировать</a></td>".
         '</tr>';
      }
 
}
   
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
    ?>
   </table>


// *********
