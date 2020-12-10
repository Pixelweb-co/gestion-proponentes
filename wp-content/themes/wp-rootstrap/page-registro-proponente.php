<?php
/*
  Template Name: Registro Proponente
 */
?>
<?php
    
   
get_header(); 

if(isset($_GET['tipo']) && $_GET['tipo'] == 'natural'){
?>

<div id="content" class="site-content container">
	    <div id="primary" class="content-area col-sm-12 col-md-12">
		    <div id="main" class="site-main" role="main">		
      	        <form id="frm_act">
                    <!-- Fila 1  -->
                    <div class="form-group">
                        <div class="row">                                                            
                            <div class="col-md-4">
                                <label for="first_name"><h6>Nombres *</h6></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" >
                            </div>                            
                            <div class="col-md-4">
                                <label for="last_name"><h6>Apellidos *</h6></label>
                                <input type="text" class="form-control" name="last_name" id="last_name"  >
                            </div>                            
                            <div class="col-md-4">
                                <label for="tipo_documentos"><h6>Tipo de documento *</h6></label>
                                <select class="form-control" name="tipo_documento">
                                        <option value="1">C&eacute;dula de ciudadan&iacute;a</option>
                                        <option value="2">C&eacute;dula de extranjer&iacute;a</option>
                                </select>
                            </div>                            
                            </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->

                    <!-- Fila 2  -->
                    <div class="form-group">
                        <div class="row">                            
                            <div class="col-md-4">
                                <label for="numero_"><h6>N&uacute;mero de documento *</h6></label>
                                <input type="text" class="form-control" name="numero_documento">
                        
                            </div>                            
                            <div class="col-md-4">
                              
                                <label for="text"><h6>Direcci&oacute;n *</h6></label>
                                <input type="text" class="form-control" id="direccion_prop" name="direccion_prop" >
                            


                                <input type="hidden" name="tipo_proponente" value="1">
    
                             </div>                            
                            <div class="col-md-4">
                              

                                <label for="celular"><h6>Celular *</h6></label>
                                <input type="text" class="form-control" name="celular_prop" id="celular" >
                            

                              </div>                
                            </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->

                    <!-- Fila 3  -->
                    <div class="form-group">
                        <div class="row">                            
                            <div class="col-md-4">
                                  <label for="telefono_prop"><h6>Tel&eacute;fono *</h6></label>
                                <input type="text" class="form-control" name="telefono_prop" id="telefono_prop" >
                            </div>
                            <div class="col-md-4">
                                <label for="email"><h6>Correo el&eacute;ctronico *</h6></label>
                                <input type="email" class="form-control" name="email" id="email"  >
                            </div>  
                            <div class="col-md-4">
                                 <label for="usuario"><h6>Usuario *</h6></label>
                                 <input type="text" id="usuario" name="usuario" class="form-control">
                            </div>                          
                        </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->


                    <!-- Fila 4  -->
                    <div class="form-group">
                        <div class="row">                           
                            <div class="col-md-6">
                                <label for="password"><h6>Contrase&ntilde;a *</h6></label>
                                <input type="password" class="form-control" name="password" id="password"  >
                            </div>                           
                            <div class="col-md-6">
                                <label for="password2"><h6>Confirma tu contrase&ntilde;a *</h6></label>
                                <input type="password" class="form-control" name="password2" id="password2" >
                            </div>
                        </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->
              
                    <!-- Fila 5  -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-mds-12 d-flex justify-content-center">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Reg&iacute;strate</button>
                            </div>
                                                    
                        </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->
                </form>
                

		    </div><!-- #main -->
	    </div><!-- #primary -->
	</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $.validator.addMethod("pwcheck", function(value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
        && /[a-z]/.test(value) // has a lowercase letter
        && /\d/.test(value) // has a digit
    });


    var letras="abcdefghyjklmnñopqrstuvwxyz";

       var validarSoloLetras =  function(texto){
           texto = texto.toLowerCase();
           for(i=0; i<texto.length; i++){
              if (letras.indexOf(texto.charAt(i),0)!=-1){
                 return 1;
              }
           }
           return 0;
        }

        $.validator.addMethod("validarSoloLetras", function(value, element) {
          return validarSoloLetras(value);
        }, 'Selecciona un barrio (Texto y n�meros o solo texto)');

    // Add regular expression option for jquery validate:
    $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Formato incorrecto; Por favor revisa tu entrada."
    );
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
    // I use element.value instead value here, value parameter was always null
    return arg != element.value; 
    }, "Value must not equal arg.");

        $('#frm_act').validate({
            errorElement: 'div',
            rules:{
                first_name:{
                            required: true,
                            maxlength: 30,
                            regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                        },
                        last_name: {
                            required: true,
                            maxlength: 30,
                            regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                        },

                        tipo_documento: {required: true},
                        numero_documento: {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 10,
                            regex: /[0-9]/
                        },
                        //tipo_proponente: {required: true},
                        direccion_prop: {
                            required: true,
                            maxlength: 50,
                            regex:/^[A-Za-z0-9-# \s]+$/g
                        },
                        celular_prop: {
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                            regex: /[0-9]/
                        },
                        telefono_prop: {
                            required: true,
                            minlength: 7,
                            maxlength: 10,
                            regex: /[0-9]/
                        },
                        usuario: {
                            required: true,
                            minlength: 8,
                            regex:/^[A-Za-z0-9]+$/g
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        password2: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        }
            },
            messages: {
                first_name: {
                    required: "Ingresa el nombre",
                    maxlength: "El nombre no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz y espacios" 
                },
                last_name: {
                    required: "Ingresa el apellido",
                    maxlength: "El apellido no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz y espacios" 
                },
                tipo_documento: {
                    required: "Ingresa tipo de documento"
                },
                numero_documento: {
                    required: "Ingresa el n&uacute;mero de documento",
                    number: "Ingresa un n&uacute;mero de documento v&aacute;lido",
                    minlength: "El documento debe tener al menos 6 caracteres",
                    maxlength: "El documento no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                
                direccion_prop: {
                    required: "Ingresa la direcci&oacute;n",   
                    maxlength : "La direcci&oacute;n no debe tener m&aacute;s de 50 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz, n&uacute;meros del 0 al 9, espacios, gui&oacute;n y signo numeral"
                },
                celular_prop: {
                    required: "Ingresa el celular",
                    minlength: "El celular debe tener al menos 10 caracteres",
                    maxlength: "El celular no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                telefono_prop: {
                    required: "Ingresa un tel&eacute;fono fijo v&aacute;lido",
                    minlength: "El tel&eacute;fono fijo debe tener al menos 7 caracteres",
                    maxlength: "El tel&eacute;fono fijo no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                usuario: {
                    required: "Ingresa el nombre de usuario",
                    minlength: "El nombre de usuario debe tener al menos 8 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz y n&uacute;meros del 0 al 9"
                },
                email: "Ingresa una direcci&oacute;n de email v&aacute;lida",
                password: {
                    required: "Ingresa la contraseña",
                    minlength: "La contraseña debe tener al menos 5 caracteres"
                },
                password2: {
                    required: "Ingresa nuevamente la contraseña",
                    minlength: "La contraseña debe tener al menos 5 caracteres",
                    equalTo: "Ingresa la misma contraseña"
                }
            }
        })//fin de la funi�n validate


// for user registration form
$('#frm_act').submit( function(e){

e.preventDefault();

var $form = $(this)

if(! $form.valid()) return false;


swal({
    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
    + '<div class="sw-texto">\u00BFConfirmas el env&iacute;o del registro?<br> <br><strong></div>',
    customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
    showCancelButton: true,
    confirmButtonClass: 'btn-sw btn-sw-ok',
    cancelButtonClass: 'btn-sw btn-sw-ok btn-cancel-ok',
    cancelButtonText: 'No',
    confirmButtonText: 'Si',
    showLoaderOnConfirm: true,
    /*preConfirm: function() {
    return new Promise(function(resolve, reject) {*/
}).then((result) => {

        if (result.value) {

            var submit = $("[name=botReg]")
            // preloader = $(".userRegistration #preloader"),
            // message = $(".userRegistration #message")

            var fd = new FormData();

            //var cedula = document.getElementById('cedula-admon').files[0];
            // var rut = document.getElementById('rut-admon').files[0];
            // var camara = document.getElementById('camara-comercio').files[0];

            fd.append('action', 'user_registro_proponente_ajax');

            // fd.append('nonce', this.rs_user_registration_nonce.value);
            fd.append('first_name', this.first_name.value);
            fd.append('last_name', this.last_name.value);            
            fd.append('tipo_documento', this. tipo_documento.value);
            fd.append('numero_documento', this. numero_documento.value);
            fd.append('tipo_proponente', this. tipo_proponente.value);
            fd.append('direccion_prop',this. direccion_prop.value);                       
            fd.append('celular_prop', this. celular_prop.value);
            fd.append('telefono_prop', this. telefono_prop.value);  
            fd.append('usuario', this.usuario.value);
            fd.append('email' , this.email.value); 
            fd.append('password', this.password.value);


            //desactivar el bot�n onsubmit para evitar la doble sumisi�n
            submit.attr("disabled", "disabled").addClass('disabled');
            // Mostrar precarga
            // preloader.css({'visibility':'visible'});

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: fd,
                dataType: 'json',
                //async: true,
                //cache: false,
                contentType: false,
                // enctype: 'multipart/form-data',
                processData: false,
                success: function (data) {
                    submit.removeAttr("disabled").removeClass('disabled');
                    
             if (data.result == 'sucess') {


                swal({                
                            html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                            + '<div class="sw-texto">'+data.mensaje+'</div>',
                            customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                            confirmButtonText: "Entendido",
                            confirmButtonClass: 'btn-sw btn-sw-ok',
                             //showConfirmButton: false,
                            type: "success"
                             }).then(function() {

                                  location.href = '<?=site_url('login')?>'
                              
                                  });


             }else{

            //  swal('Verificar la informaci�n:', data.mensaje, 'Error');
 
             swal({
                html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
                    '<div class="sw-texto"><b>Verificar la informaci�n: </b> '+data.mensaje+' </div>',
                customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
                confirmButtonText: "Entendido",
                confirmButtonClass: 'btn-sw btn-sw-error',
                //showConfirmButton: false,
                type: "error"
            });


             }




                }//fin del success
            })//fin del ajax
        }//fin del if
    });//fin del then 
})//fin de la funci�n
})//fin del jquery 
</script>

<?php }else{  ?>
 

<div id="content" class="site-content container">
      <div id="primary" class="content-area col-sm-12 col-md-12">
        <div id="main" class="site-main" role="main">   
                <form id="frm_act">
                    <!-- Fila 1  -->
                    <div class="form-group">
                        <div class="row">                                                            
                            <div class="col-md-4">
                                <label for="first_name"><h6>Raz&oacute;n social *</h6></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" >
                            </div>                            
                            <div class="col-md-4">
                                <label for="numero_documento"><h6>Nit * (incluir dígito de verificación sin guión)</h6></label>
                                <input type="text" class="form-control" name="numero_documento" id="numero_documento">
                        

                            </div>                            
                            <div class="col-md-4">
                              
                                <input type="hidden" name="tipo_proponente" value="2">
                              
                                <label for="direccion_prop"><h6>Direcci&oacute;n *</h6></label>
                                <input type="text" class="form-control" id="direccion_prop" name="direccion_prop" >
                            


                            </div>                            
                            </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->

                    <!-- Fila 2  -->
                    <div class="form-group">
                        <div class="row">                            
                            <div class="col-md-4">
                                <label for="celular"><h6>Celular *</h6></label>
                                <input type="text" class="form-control" name="celular_prop" id="celular">
                              


                            </div>                            
                            <div class="col-md-4">
                                  <label for="telefono_prop"><h6>Tel&eacute;fono *</h6></label>
                                <input type="text" class="form-control" name="telefono_prop" id="telefono_prop" >


                            </div>                            
                            <div class="col-md-4">
                                <label for="email"><h6>Correo el&eacute;ctronico *</h6></label>
                                <input type="email" class="form-control" name="email" id="email">
                              

                            </div>           
                            </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->

                    <!-- Fila 3  -->
                    <div class="form-group">
                        <div class="row"> 
                        <div class="col-md-4">
                              <label for="usuario"><h6>Usuario *</h6></label>
                                <input type="text" id="usuario" name="usuario" class="form-control">
                              </div>
                              <div class="col-md-4">
                                <label for="password"><h6>Contraseña *</h6></label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>                           
                            <div class="col-md-4">
                                <label for="password2"><h6>Confirma contraseña *</h6></label>
                                <input type="password" class="form-control" name="password2" id="password2">
                            </div>                             
                            
                        </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->


                    <!-- Fila 5  -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-mds-12 d-flex justify-content-center">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Reg&iacute;strate</button>
                            </div>
                                                    
                        </div><!-- Fin row -->    
                    </div> <!-- Fin del form group -->
                </form>
                

        </div><!-- #main -->
      </div><!-- #primary -->
  </div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $.validator.addMethod("pwcheck", function(value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
        && /[a-z]/.test(value) // has a lowercase letter
        && /\d/.test(value) // has a digit
    });


       var letras="abcdefghyjklmn�opqrstuvwxyz";

       var validarSoloLetras =  function(texto){
           texto = texto.toLowerCase();
           for(i=0; i<texto.length; i++){
              if (letras.indexOf(texto.charAt(i),0)!=-1){
                 return 1;
              }
           }
           return 0;
        }

        $.validator.addMethod("validarSoloLetras", function(value, element) {
          return validarSoloLetras(value);
        }, 'Selecciona un barrio (Texto y n�meros o solo texto)');

    // Add regular expression option for jquery validate:
    $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Formato incorrecto; Por favor revisa tu entrada."
    );
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
    // I use element.value instead value here, value parameter was always null
    return arg != element.value; 
    }, "Value must not equal arg.");

        $('#frm_act').validate({
            errorElement: 'div',
            rules:{
                first_name:{
                            required: true,
                            maxlength: 30,
                            regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                        },
                numero_documento: {
                    required: true,
                    number: true,
                    minlength: 9,
                    maxlength: 13,
                    regex: /[0-9]/
                },
                //tipo_proponente: {required: true},
                direccion_prop: {
                    required: true,
                    maxlength: 50,
                    regex:/^[A-Za-z0-9-# \s]+$/g
                },
                celular_prop: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    regex: /[0-9]/
                },
                telefono_prop: {
                    required: true,
                    minlength: 7,
                    maxlength: 10,
                    regex: /[0-9]/
                },
                usuario: {
                    required: true,
                    minlength: 8,
                    regex:/^[A-Za-z0-9]+$/g
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            messages: {
                  first_name: {
                    required: "Ingresa la raz&oacute;n social",
                    maxlength: "La raz&oacute;n social no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz y espacios" 
                },
                    numero_documento: {
                    required: "Ingresa el n&uacute;mero de documento",
                    number: "Ingresa un n&uacute;mero de documento v&aacute;lido",
                    minlength: "El documento debe tener al menos 9 caracteres",
                    maxlength: "El documento debe tener  no debe tener m&aacute;s de 13 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                direccion_prop: {
                    required: "Ingresa la direcci&oacute;n",   
                    maxlength : "La direcci&oacute;n no debe tener m&aacute;s de 50 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz, n&uacute;meros del 0 al 9, espacios, gui&oacute;n y signo numeral"
                },
                celular_prop: {
                    required: "Ingresa el celular",
                    minlength: "El celular debe tener al menos 10 caracteres",
                    maxlength: "El celular no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                telefono_prop: {
                    required: "Ingresa un tel&eacute;fono fijo v&aacute;lido",
                    minlength: "El tel&eacute;fono fijo debe tener al menos 7 caracteres",
                    maxlength: "El tel&eacute;fono fijo no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                usuario: {
                    required: "Ingresa el nombre de usuario",
                    minlength: "El nombre de usuario debe tener al menos 8 caracteres",
                    regex: "Solo se permiten caracteres de la Aa a la Zz y n&uacute;meros del 0 al 9"
                },
                email: "Ingresa una direcci&oacute;n de email v&aacute;lida",
                password: {
                    required: "Ingresa la contraseña",
                    minlength: "La contraseña debe tener al menos 5 caracteres"
                },
                password2: {
                    required: "Ingresa nuevamente la contraseña",
                    minlength: "La contraseña debe tener al menos 5 caracteres",
                    equalTo: "Ingresa la misma contraseña"
                }
            }
        })//fin de la funi�n validate


// for user registration form
$('#frm_act').submit( function(e){

e.preventDefault();

var $form = $(this)

if(! $form.valid()) return false;


swal({
    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
    + '<div class="sw-texto">\u00BFConfirmas el env&iacute;o del registro?<br> <br><strong></div>',
    customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
    showCancelButton: true,
    confirmButtonClass: 'btn-sw btn-sw-ok',
    cancelButtonClass: 'btn-sw btn-sw-ok btn-cancel-ok',
    cancelButtonText: 'No',
    confirmButtonText: 'Si',
    showLoaderOnConfirm: true,
    /*preConfirm: function() {
    return new Promise(function(resolve, reject) {*/
}).then((result) => {

        if (result.value) {

            var submit = $("[name=botReg]")
            // preloader = $(".userRegistration #preloader"),
            // message = $(".userRegistration #message")

            var fd = new FormData();

            //var cedula = document.getElementById('cedula-admon').files[0];
            // var rut = document.getElementById('rut-admon').files[0];
            // var camara = document.getElementById('camara-comercio').files[0];

            fd.append('action', 'user_registro_proponente_ajax');

            // fd.append('nonce', this.rs_user_registration_nonce.value);
            fd.append('first_name', this.first_name.value);
            fd.append('last_name', '');            
            fd.append('tipo_documento', '');
            fd.append('numero_documento', this. numero_documento.value);
            fd.append('tipo_proponente', this. tipo_proponente.value);
            fd.append('direccion_prop',this. direccion_prop.value);                       
            fd.append('celular_prop', this. celular_prop.value);
            fd.append('telefono_prop', this. telefono_prop.value);  
            fd.append('usuario', this.usuario.value);
            fd.append('email' , this.email.value); 
            fd.append('password', this.password.value);


            //desactivar el bot�n onsubmit para evitar la doble sumisi�n
            submit.attr("disabled", "disabled").addClass('disabled');
            // Mostrar precarga
            // preloader.css({'visibility':'visible'});

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: fd,
                dataType: 'json',
                //async: true,
                //cache: false,
                contentType: false,
                // enctype: 'multipart/form-data',
                processData: false,
                success: function (data) {
                    submit.removeAttr("disabled").removeClass('disabled');
                    
             if (data.result == 'sucess') {


                swal({                
                            html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                            + '<div class="sw-texto">'+data.mensaje+'</div>',
                            customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                            confirmButtonText: "Entendido",
                            confirmButtonClass: 'btn-sw btn-sw-ok',
                             //showConfirmButton: false,
                            type: "success"
                             }).then(function() {

                                  location.href = '<?=site_url('login')?>'
                              
                                  });


             }else{

            //  swal('Verificar la informaci�n:', data.mensaje, 'Error');
 
             swal({
                html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
                    '<div class="sw-texto"><b>Verificar la informaci�n: </b> '+data.mensaje+' </div>',
                customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
                confirmButtonText: "Entendido",
                confirmButtonClass: 'btn-sw btn-sw-error',
                //showConfirmButton: false,
                type: "error"
            });


             }




                }//fin del success
            })//fin del ajax
        }//fin del if
    });//fin del then 
})//fin de la funci�n
})//fin del jquery 
</script>






    <?php 

 
}


	get_footer(); 

?>

<style type="text/css">
    .error{ color: #FF0000 !important; }
	/* .col-xs-6{
		border-bottom: 1px solid #ccc;
		padding-bottom: 10px
	} */

</style>



