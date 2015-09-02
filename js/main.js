function showHelper(input,id){
            document.getElementById("for_"+id).style.display = "block";
            input.onblur = function(id){
                document.getElementById("for_"+input.id).style.display = "none";
        };
    };

function validate(form, validatable){
    var message = "<ul>";
            var allValid = true;

            var field;
            var password, passConfirm;
            for(var i = 0;i < validatable.length;i++){// цикл по массиву с объектами полей формы
                    field = validatable[i]; // переменной в каждой итерации присваивается объект 

                        if(field["regExp"].test( field["value"] ) ) // проверка регулярным выражением поля regExp поле value, введенное пользователем в форме
                            console.log(field["fieldCaption"]+": " +true);
                        else{ // если хоть одно поле не валидно, переменная allValid, пропускающая отправку формы при true, становится false, т.е. форма не отправится
                            allValid = false;
                            message += "<li>Поле: "+field["fieldCaption"]+" не корректно. "+field["validMsg"]+"</li>";// добавление списку ошибок, текущей
                            console.log(field["fieldCaption"]+": " +false);
                        }

                        switch (field["fieldName"]){
                            case "password":
                                password = field["value"]
                            break
                            case "passConfirm":
                                passConfirm = field["value"]
                                if(password !== passConfirm){
                                    allValid = false;
                                    message += "<li>Поля: Пароль и Подтверждающий пароль не совпадают!</li>";// добавление списку ошибок, текущей
                                    console.log("пароль !== подтв пароль : " +false);
                                }
                        };       


            };

            message+= "</ul>";

            if(allValid == false){// если есть ошибки, добавление переменной со списком ошибок в dom
                var messageBlock = document.getElementById("messageBlock");
                messageBlock.style.display = "block";
                messageBlock.innerHTML = message;
            }
            else //если ошибок нет - отправка формы
                form.submit();
};     

window.onload = function(){

    var form = document.forms[0];

    if(form.name == "signUp"){

     form.onsubmit = function(e) {
            e.preventDefault();

            var validatableSignUp = [// Описание всх полей формы и данных для валидации в виде json
            {
                fieldName: "firstName",
                fieldCaption: "Имя",
                value:  form.elements.firstName.value,
                regExp: /[a-zA-Zа-яА-я ]{2,100}$/,
                validMsg: "Должно иметь длину больше 2 символов, содержать только русские и английские буквы!"
            },
             {
                fieldName: "lastName",
                fieldCaption: "Фамилия",
                value:  form.elements.lastName.value,
                regExp: /[a-zA-Zа-яА-я ]{2,100}$/,
                 validMsg: "Должно иметь длину больше 2 символов, содержать только русские и английские буквы!"
            },
             {
                fieldName: "email",
                fieldCaption: "E-mail",
                value:  form.elements.email.value,
                regExp: /^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/,
                 validMsg: "Должно содержать только английские буквы, символы @ . "
            },
             {
                fieldName: "password",
                fieldCaption: "Пароль",
                value:  form.elements.password.value,
                regExp: /^[a-zA-Z0-9-_\.]{5,15}$/,
                validMsg: "Должно иметь длину от 5 символов, начинаться с английской буквы и содержать только английские буквы!"
            },
             {
                fieldName: "passConfirm",
                fieldCaption: "Подтверждающий пароль",
                value:  form.elements.passwordConfirmation.value,
                regExp: /^[a-zA-Z0-9-_\.]{5,15}$/,
                validMsg: "Должно иметь длину от 5 символов, начинаться с английской буквы и содержать только английские буквы!"
            },
             {
                fieldName: "birthYear",
                fieldCaption: "Год рождения",
                value:  form.elements.birthYear.value,
                regExp: /^[0-9]{0,4}$/,
                validMsg: "Должно иметь длину от 4 символа, диапазон 1920-2010"
            },
             {
                fieldName: "livingArea",
                fieldCaption: "Место проживания",
                value:  form.elements.livingArea.value,
                regExp: /^[a-zA-Zа-яА-Я0-9,. ]{0,100}$/,
                validMsg: "Должно состоять только из русских или английских букв, цифр и символов , . "
            }
            ,
             {
                fieldName: "phoneNumber",
                fieldCaption: "Мобильный телефон",
                value:  form.elements.phoneNumber.value,
                regExp: /^[0-9-.()+ ]{0,20}$/,
                validMsg: "Должно состоять только из цифр и символов '-.() ' "
            }
            ,
             {
                fieldName: "about",
                fieldCaption: "О себе",
                value:  form.elements.about.value,
                regExp: /^[a-zA-Zа-яА-Я0-9,. ]{0,255}$/,
                validMsg: "Должно состоять только из русских или английских букв, цифр и пробелов"
            }

        ];

          validate(form, validatableSignUp);  

        }; //end formSignUp.onsubmit
       }// endif(form.name == signUp) 


         else if(form.name == "signIn") {

     form.onsubmit = function(e) {
            e.preventDefault();

            var validatableSignIn = [// Описание всх полей формы и данных для валидации в виде json
             {
                fieldName: "email",
                fieldCaption: "E-mail",
                value:  form.elements.email.value,
                regExp: /^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/,
                 validMsg: "Должно содержать только английские буквы, символы @ . "
            },
             {
                fieldName: "password",
                fieldCaption: "Пароль",
                value:  form.elements.password.value,
                regExp: /^[a-zA-Z0-9-_\.]{5,15}$/,
                validMsg: "Должно иметь длину от 5 символов, начинаться с английской буквы и содержать только английские буквы!"
            }

        ];

          validate(form, validatableSignIn);  

        };
    }// endif(form.name == signIn)

     }

