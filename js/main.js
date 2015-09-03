function showHelper(input,id){
            document.getElementById("for_"+id).style.display = "block";
            input.onblur = function(id){
                document.getElementById("for_"+input.id).style.display = "none";
        };
    };

function validate(form, validatable, localeMessages){
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
                            message += "<li>"+localeMessages["field"][ locale ]+field["fieldCaption"]+localeMessages["incorrect"][ locale ]+field["validMsg"]+"</li>";// добавление списку ошибок, текущей
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
                                    message += "<li>"+localeMessages["passMisMatch"][ locale ]+"</li>";// добавление списку ошибок, текущей
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
    htmlTag = document.getElementsByTagName("html");
    locale = htmlTag[0].attributes.lang.value;
    console.log( locale );

    var form = document.forms[0];

    if(form.name == "signUp"){

     form.onsubmit = function(e) {
            e.preventDefault();

            var validatableSignUp = [// Описание всх полей формы и данных для валидации в виде json
            {
                fieldName: "firstName",
                fieldCaption: localeMessages["fieldCaption"]["firstName"][ locale ],
                value:  form.elements.firstName.value,
                regExp: /[a-zA-Zа-яА-я ]{2,100}$/,
                validMsg: localeMessages["validMsg"]["firstName"][ locale ]
            },
             {
                fieldName: "lastName",
                fieldCaption: localeMessages["fieldCaption"]["lastName"][ locale ],
                value:  form.elements.lastName.value,
                regExp: /[a-zA-Zа-яА-я ]{2,100}$/,
                 validMsg: localeMessages["validMsg"]["lastName"][ locale ]
            },
             {
                fieldName: "email",
                fieldCaption: localeMessages["fieldCaption"]["email"][ locale ],
                value:  form.elements.email.value,
                regExp: /^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/,
                 validMsg: localeMessages["validMsg"]["email"][ locale ]
            },
             {
                fieldName: "password",
                fieldCaption: localeMessages["fieldCaption"]["password"][ locale ],
                value:  form.elements.password.value,
                regExp: /^[a-zA-Z0-9-_\.]{5,15}$/,
                validMsg: localeMessages["validMsg"]["password"][ locale ]
            },
             {
                fieldName: "passConfirm",
                fieldCaption: localeMessages["fieldCaption"]["passConfirm"][ locale ],
                value:  form.elements.passwordConfirmation.value,
                regExp: /^[a-zA-Z0-9-_\.]{5,15}$/,
                validMsg: localeMessages["validMsg"]["passConfirm"][ locale ]
            },
             {
                fieldName: "birthYear",
                fieldCaption: localeMessages["fieldCaption"]["birthYear"][ locale ],
                value:  form.elements.birthYear.value,
                regExp: /^[0-9]{0,4}$/,
                validMsg: localeMessages["validMsg"]["birthYear"][ locale ]
            },
             {
                fieldName: "livingArea",
                fieldCaption: localeMessages["fieldCaption"]["livingArea"][ locale ],
                value:  form.elements.livingArea.value,
                regExp: /^[a-zA-Zа-яА-Я0-9,. ]{0,100}$/,
                validMsg: localeMessages["validMsg"]["livingArea"][ locale ]
            }
            ,
             {
                fieldName: "phoneNumber",
                fieldCaption: localeMessages["fieldCaption"]["phoneNumber"][ locale ],
                value:  form.elements.phoneNumber.value,
                regExp: /^[0-9-.()+ ]{0,20}$/,
                validMsg: localeMessages["validMsg"]["phoneNumber"][ locale ]
            }
            ,
             {
                fieldName: "about",
                fieldCaption: localeMessages["fieldCaption"]["about"][ locale ],
                value:  form.elements.about.value,
                regExp: /^[a-zA-Zа-яА-Я0-9,. ]{0,255}$/,
                validMsg: localeMessages["validMsg"]["about"][ locale ]
            }

        ];

          validate(form, validatableSignUp, localeMessages);  

        }; //end formSignUp.onsubmit
       }// endif(form.name == signUp) 


         else if(form.name == "signIn") {

     form.onsubmit = function(e) {
            e.preventDefault();

            var validatableSignIn = [// Описание всх полей формы и данных для валидации в виде json
             {
                fieldName: "email",
                fieldCaption: localeMessages["fieldCaption"]["email"][ locale ],
                value:  form.elements.email.value,
                regExp: /^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/,
                 validMsg: localeMessages["validMsg"]["email"][ locale ]
            },
             {
                fieldName: "password",
                fieldCaption: localeMessages["fieldCaption"]["password"][ locale ],
                value:  form.elements.password.value,
                regExp: /^[a-zA-Z0-9-_\.]{5,15}$/,
                validMsg: localeMessages["validMsg"]["password"][ locale ]
            }

        ];

          validate(form, validatableSignIn, localeMessages);  

        };
    }// endif(form.name == signIn)

     }

