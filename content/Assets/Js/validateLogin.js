
     $(function(){
        $("#signup-form").validate({
            rules: {
                form_nombre: "required",
                form_ape_p: "required",
                form_correo: {
                    required: true,
                    email: true,
                    remote: {
                        url: '<?= base_url("index.php/signup/check_email")?>',
                        type: "post",
                        data: {    
                         emailcheck : function() { return $("#form_correo").val(); }                                                
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert("Error Recargue la pagina");
                        }
                      }
                },
                form_correo2: {
                    required: true,
                    email: true,
                    equalTo: "#form_correo"
                },
                form_pass: {
                    required: true,
                    minlength: 5
                },
                form_pass2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#form_pass"
                },
                form_username: {
                    required: true,
                    minlength: 5,
                    remote: {
                        url: '<?= base_url("index.php/signup/check_username")?>',
                        type: "post",
                        data: {    
                         username: function() { return $("#form_username").val(); }                                                
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.status);
                            alert(textStatus);
                            alert(errorThrown);
                        }
                      }
                }
            },
            messages: {
                form_nombre: "Porfavor inserte su nombre",
                form_ape_p: "Porfavor inserte su apellido paterno",
                //lastname: "Please enter your lastname",
                form_pass: {
                    required: "asine una cantraseña",
                    minlength: "Su Contraseña debe de tener minimo 5 caracteres"                  
                },
                form_pass2: {
                    required: "Please provide a password",
                    minlength: "Su Contraseña debe de tener minimo 5 caracteres",
                    equalTo : "Porfavor inserte la misma contraseña"
                },
                form_correo: {
                    required: "asigne su correo",
                    remote: "El correo ya esta registrado"
                },
                form_correo2: {
                    required: "asigne su correo",
                    equalTo : "Porfavor inserte la misma correo"
                },
                form_username: {
                    required: "asigne su username",
                    minlength : "Su UserName debe de tener minimo 5 caracteres",
                    remote: "El username ya existe, asigne otro"
                } 
            },
            submitHandler: function(form) {

                form.submit();
            }
        })
     })



