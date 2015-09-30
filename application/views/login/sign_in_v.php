    <!-- Page Content -->
    <div class="container">



        <div class="row">
           
        </div>
        <!-- /.row -->

        <hr>

        <div class="row">
            <div class="col-md-8">
                <?php $attributes = array('class' => 'form-horizontal', 'id' => 'signup-form', 'role' => 'form');
                  echo form_open('', $attributes); ?>
        <!--<div class="form-horizontal" role="form">-->
            <div class="col-md-12" class="text-center">
                <div class="col-md-12">
                    <div class="form-group">    
                        <div class="col-md-12">
                             <h3 class="text-info" > <strong>Registrar </strong> </h3>
                        </div>

                        <div class="col-md-8">
                            <input type="text" id="form_nombre" name ="form_nombre" placeholder="Nombre" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="form_ape_p" name ="form_ape_p" placeholder="Apellido Paterno" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="form_ape_m" name ="form_ape_m" placeholder="Apellido Materno" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="form_username" name ="form_username" placeholder="Username" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="form_correo" name ="form_correo" placeholder="Correo electrónico" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                         <div class="col-md-8">
                            <input type="text" id="form_correo2" name ="form_correo2" placeholder="Volver a ingresar el correo electrónico" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="password" id="form_pass" name ="form_pass" placeholder="Contraseña" class="form-control form_datos solonumeros" value="" maxlength="20"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="password" id="form_pass2" name ="form_pass2" placeholder="Volver a ingresar la contraseña" class="form-control form_datos solonumeros" value="" maxlength="20"></input>
                        </div>
                        <div class="col-md-8">
                            <input class="btn btn-success submit" name="commit" type="submit" value="¡Registrarme!">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <hr>
                    </div>
                  
                    <div class="col-md-8">
                        <div class="btn btn-primary submit" >iniciar en face</div>
                    </div>

                </div>
                <div class="col-md-12">
                    <?php echo validation_errors(); ?>
                </div>
                <div class="col-md-12">
                    <?php echo validation_errors(); ?>
                </div>
            </div>

        <?php echo form_close(); ?>

            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

     <script type="text/javascript">

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
                form_correo: {
                    remote: "El correo ya esta registrado"
                },
                form_username: {
                    remote: "El username ya existe, asigne otro"
                } 
            },
            submitHandler: function(form) {
                form.submit();
            }
        })
     })






     </script>


