<?php

function validate ($inputs, $formType) { // Первый параметр - массив с полями формы и вспомогательными данными, 
  //второй - тип формы - регистрация или авторизация, при регистрации нужно выдавать ошибку об уже сущ e-mail

  
  $allValid = true; // переменная, пропускающая форму

  $_SESSION["errors"] = "<ul>"; // сообщения об ошибках

  if( count( $inputs ) == 0 ){
  $_SESSION["errors"].= "<li>Ни одно поле не заполнено</li>";         
  return header( 'Location: '.$_SERVER['HTTP_REFERER'], true, 301 );  
}

for($i = 0; $i <= count($inputs)-1; $i++){ // цикл по массиву полей, удаление у них html тегов, недопустимых знаков и пробелов

  foreach($inputs[$i] as $key => $value){
    if( ($key == "fieldValue") &&  (isset($key)) ){
      $inputs[$i][$key] = htmlspecialchars( ( stripslashes($value) ), ENT_QUOTES );
      $inputs[$i][$key] = str_replace("/", "",$value);
      $inputs[$i][$key] = str_replace("`", "",$value);
        if ( ($value != "livingArea") || ($value != "about") )
          $inputs[$i][$key] = trim($value);
    }
  }
}

if( ( isset( $_FILES['image']["name"] ) ) && ($_FILES['image']["name"] != "") ){// если загружено изображение, добавление его типа и размера к полям для валидации
  array_push( $inputs, ["fieldName" => "imageType", "fieldValue" => $_FILES["image"]["type"], "regExp" => "(image/jpeg|image/png|image/gif)", "required" => false, "fieldCaption" => "Тип изображения", "validMsg" => "Разрешены форматы: jpeg, gif, png"  ] );
  array_push( $inputs, ["fieldName" => "imageSize", "fieldValue" => $_FILES["image"]["size"], "regExp" => "/^[0-9]{0,7}$/", "required" => false, "fieldCaption" => "Размер изображения", "validMsg" => "Максимальный размер - 9 мегабайт" ] );
}


   for($i = 0; $i <= count($inputs)-1; $i++){//перебор массива полей формы, валидация регулярными выражениями

          if( ($inputs[$i]["required"] == "true") && ( strlen($inputs[$i]["fieldValue"]) == 0 )  ){//если поле пустое, добавлене в переменную информации о соотв ошибке
            $_SESSION["errors"].= "<li>Поле: ". $inputs[$i]["fieldName"] . " обязательно к заполнению!</li>";
            $allValid = false;
          }
          if (!preg_match( $inputs[$i]["regExp"], $inputs[$i]["fieldValue"]) ) { // если валидация поля по шаблону не прошла, добавление в переменную информацию о соответствующей ошибке
              $_SESSION["errors"].= "<li>Некорректное поле: ".$inputs[$i]["fieldCaption"].". ".$inputs[$i]["validMsg"]."</li>";
              $allValid = false;
          }
          switch ( $inputs[$i]["fieldName"] ){
                case "password":
                    $password = $inputs[$i]["fieldValue"];
                break;
                case "passConfirm":
                    $passConfirm = $inputs[$i]["fieldValue"];
                    if( $password !== $passConfirm){
                        $_SESSION["errors"].= "<li>Поля: Пароль и Подтверждающий пароль не совпадают!</li>";
                        $allValid = false;
                    }
                break;
                case "email":
                    $email = $inputs[$i]["fieldValue"];
                break;
                case "sex":
                    if( $inputs[$i]["fieldValue"] == "male" )
                      $inputs[$i]["fieldValue"] = "муж.";
                    else
                      $inputs[$i]["fieldValue"] = "жен.";
                break;    
          }          
      

   }

if($formType == "signUp"){ // если форма - регистрации
     //Проверка email на уникальность
  $mysqli = mysqli_connect( 'localhost','root','','forms');
  if (!$mysqli) { 
       printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
       exit; 
    };

  $sql = "select email from users where email = '$email' ";
  $result = $mysqli->query($sql);
    // Performs the $sql query on the server to create the database

      if ($result->num_rows > 0) {
        $_SESSION["errors"].= "<li>пользователь с таким E-mail'ом уже зарегистрирован!</li>";
        $allValid = false;
      }
    
  mysqli_close($mysqli); 
}
   //------------------------------

$_SESSION["errors"] .= "</ul>";

    if($allValid == false)
      return header( 'Location: '.$_SERVER['HTTP_REFERER'], true, 301 );

    return $inputs; 
}
          
      
    



 ?>