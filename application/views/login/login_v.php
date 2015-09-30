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
                            <input type="text" id="form_username" name ="form_username" placeholder="Username" class="form-control form_datos solonumeros" value="" maxlength="45"></input>
                        </div>
                        <div class="col-md-8">
                            <input type="password" id="form_pass" name ="form_pass" placeholder="Contraseña" class="form-control form_datos solonumeros" value="" maxlength="20"></input>
                        </div>                        
                        <div class="col-md-8">
                            <input class="btn btn-success submit" name="commit" type="submit" value="Iniciar">
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
                form_pass: {
                    required: true,
                    minlength: 5
                }
                form_username: {
                    required: true
                }
            }
            submitHandler: function(form) {
                form.submit();
            }
        })
     })

     </script>


