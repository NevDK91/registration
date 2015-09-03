<?php

function validate ($inputs, $formType, $messages) { // Первый параметр - массив с полями формы и вспомогательными данными, 
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
  array_push( $inputs, ["fieldName" => "imageType", "fieldValue" => $_FILES["image"]["type"], "regExp" => "(image/jpeg|image/png|image/gif)", "required" => false, "fieldCaption" => $messages["fieldCaption"]["imageType"][$_SESSION["locale"] ], "validMsg" => $messages["validate"]["imageType"][$_SESSION["locale"] ]  ] );
  array_push( $inputs, ["fieldName" => "imageSize", "fieldValue" => $_FILES["image"]["size"], "regExp" => "/^[0-9]{0,7}$/", "required" => false, "fieldCaption" => $messages["fieldCaption"]["imageSize"][$_SESSION["locale"] ], "validMsg" => $messages["validate"]["imageSize"][$_SESSION["locale"] ] ] );
}


   for($i = 0; $i <= count($inputs)-1; $i++){//перебор массива полей формы, валидация регулярными выражениями

          if( ($inputs[$i]["required"] == "true") && ( strlen($inputs[$i]["fieldValue"]) == 0 )  ){//если поле пустое, добавлене в переменную информации о соотв ошибке
            $_SESSION["errors"].= "<li>". $messages["validate"]["field"][ $_SESSION["locale"] ] . $inputs[$i]["fieldName"] . " обязательно к заполнению!</li>";
            $allValid = false;
          }
          if (!preg_match( $inputs[$i]["regExp"], $inputs[$i]["fieldValue"]) ) { // если валидация поля по шаблону не прошла, добавление в переменную информацию о соответствующей ошибке
              $_SESSION["errors"].= "<li>" . $messages["validate"]["incorrField"][$_SESSION["locale"] ] . $inputs[$i]["fieldCaption"].". ".$inputs[$i]["validMsg"]."</li>";
              $allValid = false;
          }
          switch ( $inputs[$i]["fieldName"] ){
                case "password":
                    $password = $inputs[$i]["fieldValue"];
                break;
                case "passConfirm":
                    $passConfirm = $inputs[$i]["fieldValue"];
                    if( $password !== $passConfirm){
                        $_SESSION["errors"].= "<li>".$messages["validate"]["passMisMatch"][ $_SESSION["locale"] ]."</li>";
                        $allValid = false;
                    }
                break;
                case "email":
                    $email = $inputs[$i]["fieldValue"];
                break;
                case "sex":
                    if( $inputs[$i]["fieldValue"] == "male" )
                      $inputs[$i]["fieldValue"] = $messages["profile"]["male"][$_SESSION["locale"] ];
                    elseif( $inputs[$i]["fieldValue"] == "female" )
                      $inputs[$i]["fieldValue"] = $messages["profile"]["female"][$_SESSION["locale"] ];
                break;    
          }          
      

   }

if($formType == "signUp"){ // если форма - регистрации
     //Проверка email на уникальность

$mysqli = dbConnect();

  if (!$mysqli) { 
       printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
       exit; 
    };

  $sql = "select email from users where email = '$email' ";
  $result = $mysqli->query($sql);
    // Performs the $sql query on the server to create the database

      if ($result->num_rows > 0) {
        $_SESSION["errors"].= "<li>".$messages["validate"]["emailExists"][ $_SESSION["locale"] ]."</li>";
        $allValid = false;
      }
    
  mysqli_close($mysqli); 
}
   //------------------------------

$_SESSION["errors"] .= "</ul>";

    if($allValid == false) {
      return false;
    }
    else {
      return $inputs;
    }
}
          
      
    



 ?>