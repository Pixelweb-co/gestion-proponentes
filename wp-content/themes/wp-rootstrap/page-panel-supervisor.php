<?php
/*
  Template Name: Panel Supervisor
 */
?>
<?php
    
    //Reviso si est� logueado
	if(is_user_logged_in()){
       
    }else{//si no est� logueado
        header("Location: http://proponentes.pixelweb.com.co/");
        die();
    }
    
   global $wpdb;
    get_header(); 


    $supervisor = get_user_by('id', get_current_user_id());

    $numeroDocumento = get_user_meta(get_current_user_id(), 'numero_documento');
    $numeroDocumento = $numeroDocumento[0];

    $cargoS= get_user_meta(get_current_user_id(), 'cargoS');
    $cargoS= $cargoS[0];


    $args = array(
        'post_type' => 'concurso',
        'orderby' => 'date',
        'order'   => 'DESC',
        'meta_query' => array(
            array(
                'key'     => 'supervisor',
                'value'   => $supervisor->ID,
                'compare' => '=',
            ),
        ),
    );
    
    $concursos_query = new WP_Query($args);
// echo '<br><br><br><br><br><br>';

//     echo $supervisor->ID.'<br>';
//     foreach ($concursos_query->posts as $post){
//         echo $post->post_title.'<br>';
//     }
    

?>





<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			
            <div class="row">
                <div class="col-sm-10"><h3>Bienvenido <?=ucfirst($supervisor->first_name)?> <?=ucfirst($supervisor->last_name)?></h3>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="frm_act"><!-- formulario para actualizar -->            
                        <div class="row"><!-- Fila 1  -->
                                <div class="col-md-6">
                                    <label for="first_name"><h6>Nombres</h6></label>
                                    <input disabled type="text" class="form-control" name="first_name" id="first_name" value="<?=$supervisor->first_name?>">
                                </div>
                            
                                
                                <div class="col-md-6">
                                <label for="last_name"><h6>Apellidos</h6></label>
                                    <input disabled type="text" class="form-control" name="last_name" id="last_name" value="<?=$supervisor->last_name?>">
                                </div>
                        </div><!-- fin fila 1 -->

                        <div class="row"><!-- Fila 2  -->                         
                                <div class="col-md-6">
                                    <label for="numero_documento"><h6>Número de documento</h6></label>
                                    <input disabled type="text" class="form-control"  disabled name="numero_documento" id="numero_documento" value="<?=$numeroDocumento?>">
                                </div>                          
                                <div class="col-md-6">
                                    <label for="email"><h6>Correo eléctronico</h6></label>
                                    <input disabled type="email" class="form-control" name="email" id="email" value="<?=$supervisor->user_email?>">
                                </div>
                        </div><!-- Fin Fila 2  -->

                        <div class="row"><!-- Fila 3  -->                         
                                <div class="col-md-6">
                                    <label for="cargo"><h6>Cargo </h6></label>
                                    <input disabled type="text" class="form-control"  disabled name="cargo" id="cargo" value="<?=$cargoS?>">
                                </div>                          
                        </div><!-- Fin Fila 3  -->
                        
                    </form>
                </div><!--/col-9-->
            </div><!--/row-->


    <hr style="width:95%; margin:0px">

<br>
            <h3>Documentos adjuntos</h3>


    <br>

    <div class="row">
        <div class="col-md-12"><button data-toggle="modal" data-target="#ModalDoc" class="btn btn-success"><i class="fa fa-plus"></i> Agregar documento</button>
    </div></div>

    <br>

            <div class="row">
                
                <div class="col-md-12">
                    
                    <table class="table">
                        
                        <tr>
                            <th>Nombre concurso</th>
                            <th>Documento adjunto</th>
                            <th>Fecha</th>
                            
                        </tr>

                        <?php

$documentos_data =  $wpdb->get_results("select * from prop_documentos_supervisor where supervisor = '".get_current_user_id()."' order by fecha ASC");


                        foreach($documentos_data as $doc){
                        

                         ?>
                        
                        <tr>
                            <td><?=$doc->concurso?></td>
                            <td><?=$doc->enlace_documento?></td>
                            <td><?=$doc->fecha?></td>
                            
                        </tr>



                    <?php } ?>


                    </table>


                </div>

            </div>


        </div><!-- #main -->
    </div><!-- #primary -->
</div><!-- fin del container -->



<!-- Modal -->
<div id="ModalDoc" class="modal fade" role="dialog">
  <div class="modal-dialog">
     <form action="/panel-supervisor/" method="post" id="sup_form"> 
   
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(0, 123, 255);">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar documento</h4>
      </div>
      <div class="modal-body">

           
            <div class="form-group">

                            <div class="row">                                                            
                                <div class="col-md-12">
                                <!-- <label for="concurso"><h6>Nombre concurso</h6></label>
                                    <input type="text" class="form-control" name="concurso" id="concurso"> -->

                                    <label for="supervisor" class="col-form-label">Nombre del concurso* </label>
                                        <select class="form-control input-lg" name="concurso" id="concurso" >
                                            <option value="">Seleccione un concurso</option>
                                        <?php
                                            foreach ($concursos_query->posts as $post){
                                                echo '<option value="'.$post->post_title.'"> '.ucfirst($post->post_title).'</option>';
                                            }
                                        ?>
                                        </select>
                                </div>                            
                                <div class="col-md-12">
                                    <label for="documento"><h6>Documento Adjunto</h6></label>
                                    <input type="file" class="form-control" name="documento" id="documento">
                                </div>                            
                                                           
                                </div>    
                        </div> 


   

      </div>
      <div class="modal-footer">
            
        <button type="submit" class="btn btn-success">Guardar</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
     </form>

  </div>
</div>


<?php 
	get_footer(); 

?>



<script type="text/javascript">
jQuery(document).ready(function($) {

    //Limpiar los campos cuando se le da clic al bot�n cerrar de la modal
     $('#ModalDoc').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
      });
    //Fin de Limpiar los campos cuando se le da clic al bot�n cerrar de la modal


        



		$.validator.addMethod("pwcheck", function(value) 
        {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
        }); // fin de m�todo pwcheck

        


       var letras="abcdefghyjklmnñopqrstuvwxyz";

       var validarSoloLetras =  function(texto){
           texto = texto.toLowerCase();
           for(i=0; i<texto.length; i++){
              if (letras.indexOf(texto.charAt(i),0)!=-1){
                 return 1;
              }
           }
           return 0;
       }// fin de validar solo letras

        
        $.validator.addMethod("validarSoloLetras", function(value, element) {
          return validarSoloLetras(value);
        }, 'Selecciona un barrio (Texto y números o solo texto)');



        //Validar solo pdf
        var validarSoloPDF =  function(archivo)
       {
           archivo = archivo.toLowerCase();
           var extensiones = archivo.substring(archivo.lastIndexOf("."));
           if(extensiones == ".pdf")
            {
                return 1;
            }
            return 0;
       }// fin de validar solo pdf

        
        $.validator.addMethod("validarSoloPDF", function(value, element) {
          return validarSoloPDF(value);
        }, 'Seleccione un documento .pdf');


    
    
        // Add regular expression option for jquery validate:
    
            $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Formato incorrecto"
            );

            $.validator.addMethod("valueNotEquals", function(value, element, arg){
            // I use element.value instead value here, value parameter was always null
            return arg != element.value; 
            }, "Value must not equal arg.");



    $('#sup_form').validate({
        errorElement: 'div',
        rules:{
            concurso: {
                required: true
            },
            documento: {
                required: true,
                validarSoloPDF:true
            }
        },
        messages: {
            concurso: {
                required: "Seleccione el nombre de el concurso"
            },
            documento: {
                required:"Ingrese un documento en formato PDF",
                validarSoloPDF:"Debe ingresar un documento en formato PDF"
             }
        }
    });

    // for user registration form
    $('#sup_form').submit( function(e){

        e.preventDefault();

        var $form = $(this)

        if(! $form.valid()) return false;


        swal({
            html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
            + '<div class="sw-texto">\u00BFConfirmas el env&iacute;o del documento?<br> <br><strong></div>',
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

                    var submit = $("[name=botAct]")
                    // preloader = $(".userRegistration #preloader"),
                    // message = $(".userRegistration #message")

                    var fd = new FormData();

                    //var cedula = document.getElementById('cedula-admon').files[0];
                    // var rut = document.getElementById('rut-admon').files[0];
                    var documento_file = document.getElementById('documento').files[0];
                    console.log(documento_file);
                    console.log(documento_file.name);

                    fd.append('action', 'documento_supervisor_ajax');

                    // fd.append('nonce', this.rs_user_registration_nonce.value);
                    // Obtener los datos del usermeta

                    fd.append('concurso', this.concurso.value);
                    
                    fd.append('documento', documento_file);
                    fd.append('documento_name', documento_file.name);
                        
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
                                
                            if (data.result == 'success') {


                                swal({                
                                        html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                        + '<div class="sw-texto">'+data.mensaje+'</div>',
                                        customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                        confirmButtonText: "Entendido",
                                        confirmButtonClass: 'btn-sw btn-sw-ok',
                                        //showConfirmButton: false,
                                        type: "success"
                                }).then(function() {
                                            // Recarga la p�gina que actualiza
                                            location.reload();
                                            /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                        
                                });//fin del then del swal por el �xito

                            }else{

                                //  swal('Verificar la información:', data.mensaje, 'Error');

                                swal({
                                    html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
                                        '<div class="sw-texto"><b>Verificar la información: </b> '+data.mensaje+' </div>',
                                    customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
                                    confirmButtonText: "Entendido",
                                    confirmButtonClass: 'btn-sw btn-sw-error',
                                    //showConfirmButton: false,
                                    type: "error"
                                });//fin del then del swal de error

                            }//fin del else de los mensajes
                            


                        }//fin del success
                    })//fin del ajax
                }//fin del if
        });//fin del then 
    })//fin de la funci�n



//     $('.btn-del-doc').click(function(){

// swal({
//         html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
//         + '<div class="sw-texto">\u00BFConfirmas la eliminación de este documento?<br> <br><strong></div>',
//         customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
//         showCancelButton: true,
//         confirmButtonClass: 'btn-sw btn-sw-ok',
//         cancelButtonClass: 'btn-sw btn-sw-ok btn-cancel-ok',
//         cancelButtonText: 'No',
//         confirmButtonText: 'Si',
//         showLoaderOnConfirm: true,
//         /*preConfirm: function() {
//         return new Promise(function(resolve, reject) {*/
//     }).then((result) => {


//         var fd = new FormData();

//                 fd.append('action', 'eliminar_doc_sup_ajax');
//                 fd.append('id_doc', $(this).data('id'));
                

//                 $.ajax({
//                     url: '/wp-admin/admin-ajax.php',
//                     type: 'POST',
//                     data: fd,
//                     dataType: 'json',
//                     //async: true,
//                     //cache: false,
//                     contentType: false,
//                     // enctype: 'multipart/form-data',
//                     processData: false,
//                     success: function (data) {



//                             swal({                
//                                     html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
//                                     + '<div class="sw-texto">Documento Eliminado correctamente</div>',
//                                     customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
//                                     confirmButtonText: "Entendido",
//                                     confirmButtonClass: 'btn-sw btn-sw-ok',
//                                     //showConfirmButton: false,
//                                     type: "success"
//                             }).then(function() {
//                                         // Recarga la p�gina que actualiza
//                                         location.reload();
//                                         /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                    
//                             });//fin del then del swal por el �xito


//                     }//fin del success
//                 })//fin del ajax


//     })

// ///

// })






});//fin de jquery


</script>


<style type="text/css">
	
	.col-xs-6{
		border-bottom: 1px solid #ccc;
		padding-bottom: 10px
	}

    .error{ color: #FF0000 !important; }

    .doc_link a{
		color: #000000 !important;;
	}
</style>