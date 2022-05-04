<html>
  <head>
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
  </head>
  <body>


      
<form action="" method="POST">
        <label>
            Имя:<br />
            <input name="name"  value="<?php print $values['name']; ?> "  />
        </label><br />
        <label>
            email:<br />
            <input name="email"  value="<?php print $values['email']; ?> "  />
        </label><br />
        <select id="year" name="year"></select> <br />
        <script>for (let year = 1920; year <= 2022; year++) {
            let options = document.createElement("OPTION");
            document.getElementById("year").appendChild(options).innerHTML = year;
          }
        </script>
        
        
         <input type="submit" value="ok"  />
    </form>
</body>
</html>
