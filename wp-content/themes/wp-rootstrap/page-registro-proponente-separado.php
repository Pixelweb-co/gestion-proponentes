<?php
/*
  Template Name: Registro Proponente2
 */
?>
<?php
    
   
get_header(); 


?>

<div id="content" class="site-content container">
	    <div id="primary" class="content-area col-sm-12 col-md-12">
		    <div id="main" class="site-main" role="main">		
                <form id="frm_act">
                    <div class="form-group">
                        <div class="row">         
                            <div class="col-md-4">
                                <label for="tipo_proponentes"><h6>Tipo de proponente</h6></label>
                                <select name="tipo_proponente" id="tipo_proponente"  class="form-control" onchange="muestraMas()">
                                    <option value="">--Seleccione--</option>
                                    <option value="1">Persona natural</option>
                                    <option value="2">Persona jur&iacute;dica</option>                                    
                                </select>
                            </div>                                                   
                        </div>
                    </div><!-- fin  del selector inicial de tipo de proponente -->
                    <div id="natural" style="display:none;">     
                        <!-- Fila 1  -->
                        <div class="form-group">
                            <div class="row">                                                            
                                <div class="col-md-6">
                                <label for="first_name"><h6>Nombres</h6></label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"  title="Ingrese su first name if any.">
                                </div>                            
                                <div class="col-md-6">
                                    <label for="last_name"><h6>Apellidos</h6></label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"  title="Ingrese su last name if any.">
                                </div>                            
                                                           
                                </div><!-- Fin row -->    
                        </div> <!-- Fin del form group -->

                        <!-- Fila 2  -->
                        <div class="form-group">
                            <div class="row">    
                                <div class="col-md-4">
                                    <label for="tipo_documentos"><h6>Tipo de documento</h6></label>
                                    <select class="form-control" name="tipo_documento">
                                            <option value="1">C&eacute;dula de ciudadan&iacute;a</option>
                                            <option value="2">C&eacute;dula de extranjer&iacute;a</option>
                                    </select>
                                </div>                         
                                <div class="col-md-4">
                                    <label for="tipo_documentos"><h6>N&uacute;mero de documento</h6></label>
                                    <input type="number" class="form-control" name="numero_documento">
                                </div>                            
                                                            
                                <div class="col-md-4">
                                    <label for="direccion_prop1"><h6>Direcci&oacute;n</h6></label>
                                    <input type="text" class="form-control" id="direccion_prop1" name="direccion_prop1" title="enter a location">
                                </div>                
                                </div><!-- Fin row -->    
                        </div> <!-- Fin del form group -->

                        
                
                    </div><!-- fin de natural -->

                    <div id="juridico" style="display:none;">     
                        <!-- Fila 1  -->
                        <div class="form-group">
                            <div class="row">                                                            
                                <div class="col-md-4">
                                    <label for="razon_social"><h6>Raz&oacute;n Social</h6></label>
                                    <input type="text" class="form-control" name="razon_social" id="razon_social"  title="Ingrese su first name if any.">
                                </div>                            
                                <div class="col-md-4">
                                    <label for="nit"><h6>NIT</h6></label>
                                    <input type="text" class="form-control" name="nit" id="nit"  title="Ingrese su last name if any.">
                                </div>                            
                                <div class="col-md-4">
                                    <label for="direccion_prop2"><h6>Direcci&oacute;n</h6></label>
                                    <input type="text" class="form-control" id="direccion_prop2" name="direccion_prop2" title="enter a location">
                                </div>                            
                                </div><!-- Fin row -->    
                        </div> <!-- Fin del form group -->
                    </div><!-- fin de juridico -->   


                    <!-- Filas comune para los dos divs -->
                    <div id="filas_comunes" style="display:none;">
                        <div class="form-group">
                            <div class="row">                            
                                <div class="col-md-4">
                                    <label for="celular"><h6>Celular</h6></label>
                                    <input type="text" class="form-control" name="celular_prop" id="celular" title="Ingrese su celular number if any.">
                                </div>
                                <div class="col-md-4">
                                    <label for="telefono_prop"><h6>Tel&eacute;fono</h6></label>
                                    <input type="text" class="form-control" name="telefono_prop" id="telefono_prop" title="Ingrese su telefono number if any.">
                                </div>
                                <div class="col-md-4">
                                    <label for="usuario"><h6>Usuario</h6></label>
                                    <input type="text" id="usuario" name="usuario" class="form-control">
                                </div>                            
                            </div><!-- Fin row -->    
                        </div> <!-- Fin del form group -->
                        <!-- Fila 4  -->
                        <div class="form-group">
                            <div class="row">                           
                                <div class="col-md-4">
                                    <label for="email"><h6>Correo el&eacute;ctronico</h6></label>
                                    <input type="email" class="form-control" name="email" id="email"  title="Ingrese su email.">
                                </div>                           
                                <div class="col-md-4">
                                    <label for="password"><h6>Password</h6></label>
                                    <input type="password" class="form-control" name="password" id="password"  title="Ingrese su password.">
                                </div>                           
                                <div class="col-md-4">
                                    <label for="password2"><h6>Confirmar password</h6></label>
                                    <input type="password" class="form-control" name="password2" id="password2" title="Ingrese su password2.">
                                </div>
                            </div><!-- Fin row -->    
                        </div> <!-- Fin del form group -->
                        <!-- Fila Botones  -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6 d-flex justify-content-center">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Registrar</button>
                                </div>
                                <div class="col-xs-6 d-flex justify-content-center">
                                    <br>
                                    <a class="btn btn-lg btn-success" href="<?=site_url('login')?>"><i class="glyphicon glyphicon-user"></i> Ingresar</a>
                                </div>                            
                            </div><!-- Fin row -->    
                        </div> <!-- Fin del form group -->
                    </div>
                    <!-- fin de filas_comunes -->
                </form>
                

		    </div><!-- #main -->
	    </div><!-- #primary -->
	</div>

    <?php 
	get_footer(); 

?>
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
        }, 'Selecciona un barrio (Texto y números o solo texto)');

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
                razon_social:{
                    required: true,
                    maxlength: 30,
                    regex:/^[A-Za-z0-9 \s]+$/g
                },
                nit:{
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    regex: /[0-9]/
                },
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
                tipo_proponente: {required: true},
                direccion_prop1: {
                    required: true,
                    maxlength: 50,
                    regex:/^[A-Za-z0-9-# \s]+$/g
                },
                direccion_prop2: {
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
                    maxlength: 20,
                    regex:/^[A-Za-z0-9_\s]+$/g
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
                razon_social: {
                    required: "Ingrese la raz&oacute;n social",
                    maxlength: "la raz&oacute;n social no debe tener m&aacute;s de 60 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z, n&uacute;meros del 0 al 9 y espacios" 
                },
                nit: {
                    required: "Ingrese el NIT",
                    minlength: "El NIT debe tener al menos 10 caracteres",
                    maxlength: "El NIT no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros" 
                },
                first_name: {
                    required: "Ingrese el Nombre",
                    maxlength: "El nombre no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z y espacios" 
                },
                last_name: {
                    required: "Ingrese el Apellido",
                    maxlength: "El apellido no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z y espacios" 
                },
                tipo_documento: {
                    required: "Ingrese Tipo de documento"                    
                },
                numero_documento: {
                    required: "Ingrese el n&uacute;mero de documento",
                    number: "Ingrese un numero de documento v&aacute;lido",
                    minlength: "El documento debe tener al menos 6 caracteres",
                    maxlength: "El documento no debe tener m&aacute;s 10 caracteres",
                    regex: "Ingrese un tel&eacute;fono fijo v&aacute;lido"
                },
                tipo_proponente: {
                    required: "Ingrese tipo de proponente",
                },
                direccion_prop1: {
                    required: "Ingrese la Direcci&oacute;n",   
                    maxlength : "La direcci&oacute;n no debe tener m&aacute;s de 50 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z, espacios, n&uacute;meros del 0 al 9, gui&oacute;n y signo numeral"
                },
                direccion_prop2: {
                    required: "Ingrese la Direcci&oacute;n",   
                    maxlength : "La direcci&oacute;n no debe tener m&aacute;s de 50 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z, espacios, n&uacute;meros del 0 al 9, gui&oacute;n y signo numeral"
                },
                celular_prop: {
                    required: "Ingrese el Celular",
                    minlength: "El celular debe tener al menos 10 caracteres",
                    maxlength: "El celular no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
                },
                telefono_prop: {
                    required: "Ingrese un Tel&eacute;fono Fijo v&aacute;lido",
                    minlength: "El tel&eacute;fono fijo debe tener al menos 7 caracteres",
                    maxlength: "El tel&eacute;fono fijo no debe tener m&aacute;s 10 caracteres",
                    regex: "Ingrese un tel&eacute;fono fijo v&aacute;lido"
                },
                usuario: {
                    required: "Por favor ingresa tu nombre de usuario",
                    minlength: "Tu nombre de usuario debe tener al menos 6 caracteres",
                    maxlength: "Tu nombre de usuario no debe tener más de 20 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z, n&uacute;meros del 0 al 9 y gui&oacute;n bajo _"
                },
                email: "Por favor ingresa una direcci&oacute;n de email valida",
                password: {
                    required: "Por favor ingresa tu password",
                    minlength: "Tu password debe tener al menos 5 caracteres"
                },
                password2: {
                    required: "Por favor ingresa nuevamente tu password",
                    minlength: "Tu password debe tener al menos 5 caracteres",
                    equalTo: "Por favor ingresa la misma password"
                }
            }//fin de mensajes
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

            var tipoProp = this.tipo_proponente.value;
            
            if (tipoProp=="1") {
                fd.append('first_name', this.first_name.value);
                fd.append('last_name', this.last_name.value);            
                fd.append('tipo_documento', this.tipo_documento.value);
                fd.append('numero_documento', this.numero_documento.value);
                fd.append('direccion_prop1',this.direccion_prop1.value);
            } else if (tipoProp=="2"){
                fd.append('razon_social', this.razon_social.value);
                fd.append('nit', this.nit.value); 
                fd.append('direccion_prop2',this.direccion_prop2.value);
            }
            
            fd.append('tipo_proponente', this.tipo_proponente.value);
                                   
            fd.append('celular_prop', this.celular_prop.value);
            fd.append('telefono_prop', this.telefono_prop.value);  
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

                    }//fin del else de los mensajes

                }//fin del success
            })//fin del ajax
        }//fin del if
    });//fin del then 
})//fin de la funci�n
 })//fin del jquery 

//Función para mostrar los campos según el tipo de proponente
function muestraMas(){
            var select_tipo_proponente=document.getElementById('tipo_proponente').value;
            var div_natural=document.getElementById('natural');
            var div_juridico=document.getElementById('juridico');
            var div_filas_comunes =document.getElementById('filas_comunes');

            if(select_tipo_proponente=="1"){
                div_natural.style.display="block";
                div_juridico.style.display="none";
            }
            else if(select_tipo_proponente=="2"){
                div_natural.style.display="none";
                // div_filas_comunes.display ="block";
                div_juridico.style.display="block";
            }
            div_filas_comunes.style.display ="block";
        }
</script>


