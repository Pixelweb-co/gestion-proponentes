<?php
/**
 * Plugin Name:  Demo Form Proponentes
 * Description:  Formulario para inscripi&oacute;n de los proponentes. Utiliza el shortcode [demo_proponente_form] para que el formulario aparezca en la página o el post que desees.
 * Version:      0.1.1
 * Author:       Ing. Heimys M. Alvarado
 * Author URI:   https://ing-halvarado-7s.github.io/hma
 * PHP Version:  7.2
 *
 * @category Form
 * @package  PROPO
 * @author   Ing. Heimys M. Alvarado <ing.halvarado.7s@gmail.com>
 * @license  GPLv2 http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://ing-halvarado-7s.github.io/hma
 */

/**
 * Realiza las acciones necesarias para configurar el plugin cuando se activa
 *
 * @return void
 */
function demo_proponente_init()
{

}

// El formulario puede insertarse en cualquier sitio con este shortcode
// El código de la función que carga el shortcode hace una doble función:
// 1-Graba los datos en la tabla si ha habido un envío desde el formulario
// 2-Muestra el formulario

add_shortcode('demo_proponente_form', 'demo_proponente_form');

/**
 * Crea y procesa el formulario que rellenan los proponentes
 *
 * @return string
 */
function demo_proponente_form()
{
   
    // Carga esta hoja de estilo para poner más bonito el formulario
    ob_start();
    ?>
    
    <br>
    
	
<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			
    <div class="row">
  		
    	<div class="col-9">
      	<form id="frm_act">

                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="first_name"><h6>Nombres</h6></label>
                              <input type="text" class="form-control" name="first_name" id="first_name"  title="Ingrese su first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                            <label for="last_name"><h6>Apellidos</h6></label>
                              <input type="text" class="form-control" name="last_name" id="last_name"  title="Ingrese su last name if any.">
                          </div>
                      </div>
          

                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="tipo_documentos"><h6>Tipo de documento</h6></label>
                              

                              <select class="form-control" name="tipo_documento">
                              		<option value="1">C&eacute;dula de ciudadan&iacute;a</option>
                              		<option value="2">C&eacute;dula de extranjer&iacute;a</option>
                              
                              </select>

                          </div>
                      </div>


                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="tipo_documentos"><h6>Número de documento</h6></label>
                              	<input type="number" class="form-control" name="numero_documento">

                          </div>
                      </div>
          

                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="tipo_proponentes"><h6>Tipo de proponente</h6></label>

                              <select name="tipo_proponente" class="form-control">
                              		<option value="1">Persona natural</option>
                              		<option value="2">Persona jur&iacute;dica</option>
                              
                              </select>
                          </div>
                      </div>


                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="text"><h6>Direcci&oacute;n</h6></label>
                              <input type="text" class="form-control" id="direccion" name="direccion_prop" title="enter a location">
                          </div>
                      </div>

          
                      <div class="form-group">
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                             <label for="celular"><h6>Celular</h6></label>
                              <input type="text" class="form-control" name="celular_prop" id="celular" title="Ingrese su celular number if any.">
                          </div>
                      </div>



                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="telefono_prop"><h6>Tel&eacute;fono</h6></label>
                              <input type="text" class="form-control" name="telefono_prop" id="telefono_prop" title="Ingrese su telefono number if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                        <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                            <label for="usuario"><h6>Usuario</h6></label>
                            <input type="text" id="usuario" name="usuario" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">

                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="email"><h6>Correo el&eacute;ctronico</h6></label>
                              <input type="email" class="form-control" name="email" id="email"  title="Ingrese su email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                              <label for="password"><h6>Password</h6></label>
                              <input type="password" class="form-control" name="password" id="password"  title="Ingrese su password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-md-3  col-sm-4 col-xs-9  my-2">
                            <label for="password2"><h6>Confirmar password</h6></label>
                              <input type="password" class="form-control" name="password2" id="password2" title="Ingrese su password2.">
                          </div>
                      </div>
              	
              
             
                      <div class="form-group">
                           <div class="col-xs-9">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Registrar</button>
                            </div>
                      </div>
</form>
        </div><!--/col-9-->
    



<!-- adsd -->


    </div><!--/row-->

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
            first_name:{
                        required: true,
                        maxlength: 30,
                        regex:/^[A-Za-záéíóúñÁÉÍÓÚÑ \s]+$/g
                    },
					last_name: {
                        required: true,
                        maxlength: 30,
                        regex:/^[A-Za-záéíóúñÁÉÍÓÚÑ \s]+$/g
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
						minlength: 8
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
                    direccion_prop: {
                        required: "Ingrese la Direcci&oacute;n",   
                        maxlength : "La direcci&oacute;n no debe tener m&aacute;s de 50 caracteres",
                        regex: "Solo se permiten caracteres de la A a la Z, espacios, gui&oacute;n y signo numeral"
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
						minlength: "Tu nombre de usuario debe tener al menos 2 caracteres"
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
        }
    })



    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
</script>


<style type="text/css">
	
	.col-xs-6{
		border-bottom: 1px solid #ccc;
		padding-bottom: 10px
	}

</style>

    <?php

    return ob_get_clean();
}

add_action("admin_menu", "demo_proponente_menu");

/**
 * Agrega el menú del plugin al formulario de WordPress
 *
 * @return void
 */
function demo_proponente_menu()
{
    add_menu_page("Formulario proponentes", "proponentes", "manage_options",
        "demo_proponente_menu", "demo_proponente_admin", "dashicons-feedback", 75);
}

function demo_proponente_admin(){}

/**
 * Devuelve la IP del usuario que está visitando la página
 * Código fuente: https://stackoverflow.com/questions/6717926/function-to-get-user-ip-address
 *
 * @return string
 */
function Kfp_Obtener_IP_usuario()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED',
        'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
                }
            }
        }
    }
}