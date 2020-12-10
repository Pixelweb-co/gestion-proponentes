<?php
/*
  Template Name: Panel Proponente
 */
?>
<?php
    
   //Reviso si est� logueado
	if(is_user_logged_in()){
       
    }else{//si no est� logueado
        header("Location: http://proponentes.pixelweb.com.co/");
        die();
    }
    
get_header(); 

$tipo_proponente = get_user_meta(get_current_user_id(), 'tipo_proponente');
$tipo_proponente = $tipo_proponente[0];
echo '<input type="hidden" name="tipo_prop" id="tipo_prop" value="'.$tipo_proponente.'">';//para tomar el id para javascript

$proponente = get_user_by('id', get_current_user_id());

// Obtener los datos del usermeta
    $tipo_documento = get_user_meta(get_current_user_id(), 'tipo_documento');
    $tipo_documento = $tipo_documento[0];

    $numeroDocumento = get_user_meta(get_current_user_id(), 'numero_documento');
    $numeroDocumento = $numeroDocumento[0];
    //Datos jurídicos exclusivo para persona jurídico
    $camara_cio = get_user_meta(get_current_user_id(), 'camara_cio');
    $camara_cio = $camara_cio[0];

    $hoja_vida = get_user_meta(get_current_user_id(), 'hoja_vida');
    $hoja_vida = $hoja_vida[0];

//Datos personales comunes a personas naturales y jurídicos

$direccion_prop = get_user_meta(get_current_user_id(), 'direccion_prop');
$direccion_prop = $direccion_prop[0];

$celular_prop = get_user_meta(get_current_user_id(), 'celular_prop');
$celular_prop = $celular_prop[0];

$telefono_prop = get_user_meta(get_current_user_id(), 'telefono_prop');
$telefono_prop = $telefono_prop[0];

//Datos Jurídicos comunes a personas naturales y jurídicos
$cedula = get_user_meta(get_current_user_id(), 'cedula');
$cedula = $cedula[0];

$actividad1= get_user_meta(get_current_user_id(), 'actividad1');
$actividad1 = $actividad1[0];

$actividad2= get_user_meta(get_current_user_id(), 'actividad2');
$actividad2 = $actividad2[0];

$actividad3= get_user_meta(get_current_user_id(), 'actividad3');
$actividad3 = $actividad3[0];

$actividad4= get_user_meta(get_current_user_id(), 'actividad4');
$actividad4 = $actividad4[0];

$tarjeta_profesional = get_user_meta(get_current_user_id(), 'tarjeta_profesional');
$tarjeta_profesional = $tarjeta_profesional[0];

$registro_unico_trubitario = get_user_meta(get_current_user_id(), 'registro_unico_trubitario');
$registro_unico_trubitario = $registro_unico_trubitario[0];

$registro_unico_de_proponentes = get_user_meta(get_current_user_id(), 'registro_unico_de_proponentes');
$registro_unico_de_proponentes = $registro_unico_de_proponentes[0];

$antecedentes = get_user_meta(get_current_user_id(), 'antecedentes');
$antecedentes = $antecedentes[0];

$doc_habilidad = get_user_meta(get_current_user_id(), 'doc_habilidad');
$doc_habilidad = $doc_habilidad[0];

$acta_confidencialidad = get_user_meta(get_current_user_id(), 'acta_confidencialidad');
$acta_confidencialidad = $acta_confidencialidad[0];

$first_name = get_user_meta(get_current_user_id(), 'first_name');
$first_name = $first_name[0];

$last_name = get_user_meta(get_current_user_id(), 'last_name');
$last_name = $last_name[0];




?>
<script>
    function mostrar_tipo_proponente(){
        var tipo_prop=document.getElementById('tipo_prop').value;
        var person_natural =document.getElementById('personal_natural');
        var camara_comercio =document.getElementById('camara_comercio');
        var personal_juridica= document.getElementById('personal_juridica');
        
        if (tipo_prop==1) {
            person_natural.style.display="block";
            camara_comercio.style.display="none";
            
            console.log('Soy Natural. Valor: ', tipo_prop);    
        } else {
            personal_juridica.style.display="block";
            console.log('Soy juridico', tipo_prop);    
        }
    }
    window.onload = mostrar_tipo_proponente;
    
    
</script>
	
<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			
	

	    <div class="row">
  		<div class="col-sm-10"><h3>Bienvenido <?=$proponente->first_name?> <?=$proponente->last_name?></h3></div>
    	<div class="col-sm-2"></div>
    </div>
    <div class="row">
  		<div class="col-md-12">
      	<form id="frm_act"><!-- formulario para actualizar -->
          <input type="hidden" name="tipo_prop1" id="tipo_prop1" value="<?=$tipo_proponente?>">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Información Básica</a></li>
                <li><a data-toggle="tab" href="#documentos_panel">Documentos jurídicos</a></li>
                <li><a data-toggle="tab" href="#concurso_panel">Concursos</a></li>
                
            </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                <div id="personal_natural" style="display:none;">
                    
                    <div class="form-group"><!-- Fila 1  -->
                          <div class="col-xs-6">
                              <label for="first_name"><h6>Nombres *</h6></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?=$proponente->first_name?>">
                          </div>
                      
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h6>Apellidos *</h6></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$proponente->last_name?>">
                          </div>
                    </div><!-- fin fila 1 -->

                    <div class="form-group"><!-- Fila 2  -->
                          
                          <div class="col-md-6">
                              <label for="tipo_documento"><h6>Tipo de documento</h6></label>
                                    <?php 
                                        if($tipo_documento==1)
                                        echo '<input type="text" class="form-control" disabled value ="C&eacute;dula de ciudadan&iacute;a" >';
                                        else{
                                            echo '<input type="text" class="form-control" disabled value ="C&eacute;dula de extranjer&iacute;a" >';
                                        }
                                    ?>
                              </select>

                          </div>                          
                          <div class="col-md-6">
                              <label for="numero_documento"><h6>Número de documento</h6></label>
                              	<input type="text" class="form-control"  disabled name="numero_documento" id="numero_documento" value="<?=$numeroDocumento?>">
                          </div>
                    </div><!-- Fin de la Fila 2  -->
                      
                </div><!-- fin de personal natural   -->

                <div id="personal_juridica" style="display:none;">
                    
                    <div class="form-group"><!-- Fila 1  -->
                          <div class="col-xs-6">
                              <label for="razon_social"><h6>Razón Social *</h6></label>
                              <input type="text" class="form-control" name="razon_social" id="razon_social"  value="<?=$proponente->first_name?>">
                          </div>
                          <div class="col-xs-6">
                            <label for="nit"><h6>NIT</h6></label>
                              <input type="text" class="form-control" name="nit" id="nit" value="<?=$numeroDocumento?>" disabled>
                          </div>
                    </div><!-- fin fila 1 -->
                </div><!-- fin de personal juridica   -->
                    <!-- Fila 3  -->
                    <div class="form-group">      
                          <div class="col-xs-6">
                              <label for="direccion_prop"><h6>Direcci&oacute;n * </h6></label>
                              <input type="text" class="form-control" id="direccion_prop" name="direccion_prop" value="<?=$direccion_prop?>">
                          </div>
                          <div class="col-xs-6">
                             <label for="celular_prop"><h6>Celular *</h6></label>
                              <input type="text" class="form-control" name="celular_prop" id="celular_prop" value="<?=$celular_prop?>">
                          </div>
                      </div><!-- Fin de Fila 3  -->
                      <div class="form-group"><!-- Fila 4  -->
                          <div class="col-xs-6">
                              <label for="telefono_prop"><h6>Teléfono *</h6></label>
                              <input type="text" class="form-control" name="telefono_prop" id="telefono_prop" value="<?=$telefono_prop?>">
                          </div>                          
                          <div class="col-xs-6">
                              <label for="email"><h6>Correo eléctronico</h6></label>
                              <input disabled type="email" class="form-control" name="email" id="email" value="<?=$proponente->user_email?>">
                          </div>
                      </div><!-- Fin Fila 4  -->
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" name="botAct"><i class="glyphicon glyphicon-ok-sign"></i> Actualizar información</button>
                            </div>
                      </div>
              
             </div><!--/tab-pane-->



             <div class="tab-pane" id="documentos_panel">
               
                <div class="row"><!-- Fila 1  -->      
                    <div class="col-xs-6">
                         <label for="cedula"><h6>C&eacute;dula *</h6></label>
                         <div class="doc_link">
                         <?=$cedula?>
                        </div>
                        <input  type="file"   class="form-control" name="cedula" id="cedula" >
                    </div>
                    <div class="col-xs-6">
                        <label for="tarjeta_profesional"><h6>Tarjeta profesional *</h6></label>
                        <div class="doc_link">
                            <?=$tarjeta_profesional?>
                        </div>
                        <input  type="file"   class="form-control" name="tarjeta_profesional" id="tarjeta_profesional" >
                    </div>
                </div><!-- Fin Fila 1  -->

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>

                <div class="row"><!-- Fila 2  -->
                    <div class="col-xs-6">
                        <label for="registro_unico_trubitario"><h6>Registro único tributario (RUT) *</h6></label>
                        <div class="doc_link">
                            <?=$registro_unico_trubitario?>
                        </div>
                        <input  type="file"   class="form-control" name="registro_unico_trubitario" id="registro_unico_trubitario"  >
                    </div>
                    <div class="col-xs-6">
                        <label for="registro_unico_de_proponentes"><h6>Registro único de proponentes (RUP) *</h6></label>
                        <div class="doc_link">
                            <?=$registro_unico_de_proponentes?>
                        </div>
                        <input  type="file"   class="form-control" name="registro_unico_de_proponentes" id="registro_unico_de_proponentes"  >
                    </div>
                </div><!-- Fila 2  -->


                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>

                <div class="row"><!-- Fila 3  -->
                    <div class="col-xs-6">
                        <label for="antecedentes"><h6>Antecedentes Legales (Policía, Contraloría y Procuraduría) *</h6></label>
                        <div class="doc_link">
                            <?=$antecedentes?>
                        </div>
                        <input  type="file"   class="form-control" name="antecedentes" id="antecedentes">
                    </div>
                    <div class="col-xs-6">
                        <label for="doc_habilidad"><h6>Documento de Inhabilidad y Compatibilidad - Bajo formato *</h6></label>
                        <div class="doc_link">
                            <?=$doc_habilidad?>                    
                        </div>
                        <input  type="file"   class="form-control" name="doc_habilidad" id="doc_habilidad">
                    </div>
                </div><!-- Fila 3  -->


                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
            
                <div class="row"><!-- Fila 4  -->
                    <div class="col-xs-6">
                        <label for="acta_confidencialidad"><h6>Acta de confiabilidad de la información - Bajo formato *</h6></label>                    
                        <div class="doc_link">
                            <?=$acta_confidencialidad?>                    
                        </div>                              
                        <input  type="file"   class="form-control" name="acta_confidencialidad" id="acta_confidencialidad" >
                    </div>
                    <div class="col-xs-6">
                            <label for="hoja_vida"><h6>Hoja de vida del representante legal *</h6></label>                    
                            <div class="doc_link">
                                <?=$hoja_vida?>                    
                            </div>                              
                            <input  type="file"   class="form-control" name="hoja_vida" id="hoja_vida" >
                        </div>                    
                </div><!-- fin Fila 4  -->

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>

                <div class="row"><!-- Fila 5  -->
                <div id="camara_comercio">            
                        <div class="col-xs-6">
                        <label for="camara_cio"><h6>Cámara de comercio</h6></label>
                            <div class="doc_link">                    
                                <?=$camara_cio?>
                            </div>                              
                            <input  type="file"   class="form-control" name="camara_cio" id="camara_cio">
                        </div>
                    </div><!--fin div cam-cio -->

                </div><!-- fin Fila 5  -->
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for=""><h6>Actividades proponentes</h6></label> 
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-5">
                        <label for=""><h6>Actividad 1 *</h6></label> 
                        <input type="text" name="actividad1" id="actividad1" value="<?=$actividad1?>">
                    </div>
                    <div class="col-md-5">
                    <label for=""><h6>Actividad 2</h6></label> 
                        <input type="text" name="actividad2" id="actividad2" value="<?=$actividad2?>">
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                     
                </div>

                <div class="row">
                    
                    <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-5">
                        <label for=""><h6>Actividad 3</h6></label> 
                        <input type="text" name="actividad3" id="actividad3"  value="<?=$actividad3?>">
                    </div>
                    <div class="col-md-5">
                    <label for=""><h6>Actividad 4</h6></label> 
                        <input type="text" name="actividad4" id="actividad4"  value="<?=$actividad4?>">
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                     
                </div>


                <div class="row">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" name="botAct"><i class="glyphicon glyphicon-ok-sign"></i> Actualizar información</button>
                            </div>
                      </div>
                </form>
             </div><!--/tab-pane-->

             <div class="tab-pane" id="concurso_panel">
               
                <div class="row">
                  <div class="col-md-12">
                  <?php 


                            //consultar concursos

                            $args = array(
                                'post_type' => 'concurso',
                                'orderby' => 'date',
                                'order'   => 'DESC'
                            );

                            $concursos_query = new WP_Query($args);
                            // Mostrar concursos en los que este autorizado personalmente o concursos que esten abierto para todos los proponentes, al menos 1 concurso
                            $sql ='select DISTINCT(concurso) from prop_autorizado where proponente='.$proponente->ID.' and concurso not in (select concurso from prop_postulaciones where ganador=1) or proponente=-1 limit 1';
                            //echo $sql;
                            $concursos_autorizado = $wpdb->get_row($sql);

                                   if (isset($concursos_autorizado->concurso)) { ?>

                                            <table id="tabla_concursos" class="table table-striped table-bordered table-condensed" style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        
                                                        <th>T&iacute;tulo</th>
                                                        <th>Descripci&oacute;n</th>
                                                        <th>Documento</th>
                                                        <th>Supervisor</th>
                                                        <th>Ver</th>
                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   

                                                 <?php 
                                                 $sql1 ='select DISTINCT(concurso) from prop_autorizado where proponente='.$proponente->ID.' and concurso not in (select concurso from prop_postulaciones where ganador=1) or proponente=-1';
                                                 //echo $sql;
                                                 $concursos_autorizados = $wpdb->get_results($sql1);
                                                 
                                                    foreach ($concursos_autorizados as $autorizado):
                                                        $post = get_post($autorizado->concurso) ;
                                                        $argsSupervisor1 = get_userdata($post->supervisor );
                                                    
                                                    
                                                    ?>
                                                 
                                                        
                                                        <tr>
                                                            
                                                            <td><?=$post->post_title?><input type="hidden" value="<?=$post->ID?>" class="clase_ID_Post"></td>
                                                            <td><?=$post->post_content?></td>
                                                            <td><?=$post->documento?></td>
                                                            <td>
                                                                <?php
                                                                     echo  $argsSupervisor1->first_name;                                                           
                                                                ?>
                                                                  
                                                                </td>
                                                            
                                                            
                                                            <td>
                                                              <?php 


                                                              $esta_postulado = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$post->ID."' and proponente = '".get_current_user_id()."'");


                                                              if(isset($esta_postulado->id)){

                                                                ?>
                                                                <button type="button" 
                                                                data-concurso="<?=$post->ID?>" 
                                                                
                                                                 


                                                                class='btn btn-postular' disabled>Postulado</button>

                                                                <?php

                                                              }else{

                                                                ?>
                                                                <button type="button" data-concurso="<?=$post->ID?>" 
                                                                data-titulo="<?=$post->post_title?>"
                                                                data-nombre="<?=$first_name?>"
                                                                data-apellido="<?=$last_name?>" 
                                                                data-email="<?=$proponente->user_email?>"
                                                                class='btn btn-warning btn-postular' >Postularse</button>

                                                                <?php
                                                              }

                                                              ?>


                                                              </td>
                                                              </tr>
                                                       <?php endforeach; ?>                      
                                                    
                                                </tbody>        
                                                </table>                    
                                          
                                        <?php }else{ echo '<h1>No hay concursos disponibles</h1>'; } ?>    


                  


                </div>
                </div>
              

             </div><!--/tab-pane concurso_panel-->
           
                        
          </div><!--/tab-content-->


                      
        </div><!--/col-9-->
    



<!-- adsd -->


    </div><!--/row-->

		</div><!-- #main -->
	</div><!-- #primary -->
	</div>

<?php 
	get_footer(); 

?>



<script type="text/javascript">
	jQuery(document).ready(function($) {


    $('.btn-postular').click(function(){


  swal({
            html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
            + '<div class="sw-texto">\u00BFConfirmas postularte en este concurso?<br> <br><strong></div>',
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
                    var fd = new FormData();

                    fd.append('action', 'postular_prop_ajax');
                     fd.append('concurso', $(this).data('concurso'));
                    fd.append('titulo', $(this).data('titulo'));
                    fd.append('nombre', $(this).data('nombre'));
                    fd.append('apellido', $(this).data('apellido'));
                    fd.append('email', $(this).data('email'));

                    

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



                                swal({                
                                        html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                        + '<div class="sw-texto">Se ha postulado correctamente en este concurso</div>',
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


                        }//fin del success
                    })//fin del ajax
            }//fin del result value

        })
})
  




		$('.nav a').click(function(){

		    $('.tab-pane').removeClass('active');		
		
		    if($(this).attr('href') === '#documentos_panel'){

		        $('#documentos_panel').addClass('active');

		    }else if($(this).attr('href') === '#concurso_panel'){

                $('#concurso_panel').addClass('active');

            }else{

		        $('#home').addClass('active');

		    }//fin del if-else
		})// fin de la funci�n del .nav a

        $.validator.addMethod("pwcheck", function(value) 
        {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
        }); // fin de m�todo pwcheck

        


       var letras="abcdefghyjklmnñopqrstuvwxyz";

       var validarSoloLetras =  function(texto)
       {
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
           if(extensiones == ".pdf" || archivo == "")
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



    $('#frm_act').validate({
        errorElement: 'div',
        rules:{
            first_name: {
                required: true,
                maxlength: 30,
                //regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                regex: /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g
            },
            last_name: {
                required: true,
                maxlength: 100,
                // regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                regex: /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g
            },
            direccion_prop: {
                required: true,
                maxlength: 50
                //regex: /^[A-Za-záéíóúñÝÉÝÓÚÑ0-9-# \s]+$/g
                // regex:/^[A-Za-z0-9-# \s]+$/g
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
            cedula:{
                validarSoloPDF:true
            },
            tarjeta_profesional:{
                validarSoloPDF:true
            },
            registro_unico_trubitario:{
                validarSoloPDF:true
        	},
        	registro_unico_de_proponentes:{
                validarSoloPDF:true
        	},
        	antecedentes:{
                validarSoloPDF:true
        	},
        	doc_habilidad:{
                validarSoloPDF:true
        	},
        	acta_confidencialidad:{
                validarSoloPDF:true
        	},
        	camara_cio:{
                validarSoloPDF:true
            },
            hoja_vida:{
                validarSoloPDF:true	
            },
            actividad1: {
                required: true,
                minlength: 4,
                maxlength: 4,
                regex: /[0-9]/
            },
            actividad2: {
                minlength: 4,
                maxlength: 4,
                regex: /[0-9]/
            },
            actividad3: {
                minlength: 4,
                maxlength: 4,
                regex: /[0-9]/
            },
            actividad4: {
                minlength: 4,
                maxlength: 4,
                regex: /[0-9]/
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
            direccion_prop: {
                required: "Ingresa la direcci&oacute;n",   
                    maxlength : "La direcci&oacute;n no debe tener m&aacute;s de 50 caracteres",
                   // regex: "Solo se permiten caracteres de la Aa a la Zz, n&uacute;meros del 0 al 9, espacios, gui&oacute;n y signo numeral"
            },
            numero_documento: {
                required: "Ingresa el n&uacute;mero de documento",
                    number: "Ingresa un n&uacute;mero de documento v&aacute;lido",
                    minlength: "El documento debe tener al menos 6 caracteres",
                    maxlength: "El documento no debe tener m&aacute;s 10 caracteres",
                    regex: "Solo se permiten n&uacute;meros"
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
            cedula:{
            	extension: "Solo se permiten documentos .pdf"
            },
            tarjeta_profesional:{

            	extension: "Solo se permiten documentos .pdf"
            },
            registro_unico_trubitario:{
            	extension: "Solo se permiten documentos .pdf"
        	},
        	registro_unico_de_proponentes:{
            	extension: "Solo se permiten documentos .pdf"
        	},
        	antecedentes:{
            	extension: "Solo se permiten documentos .pdf"
        	},
        	doc_habilidad:{
            	extension: "Solo se permiten documentos .pdf"
        	},
        	acta_confidencialidad:{
            	extension: "Solo se permiten documentos .pdf"	
        	},
        	camara_cio:{
            	extension: "Solo se permiten documentos .pdf"	
            },
            hoja_vida:{
            	extension: "Solo se permiten documentos .pdf"
            },
            actividad1: {
                required: "Ingresa el código de la actividad del proponente",
                minlength: "El código debe tener al menos 4 caracteres",
                maxlength: "El código no debe tener m&aacute;s de 4 caracteres",
                regex: "Solo se permiten n&uacute;meros"
            },
            actividad2: {
                minlength: "El código debe tener al menos 4 caracteres",
                maxlength: "El código no debe tener m&aacute;s de 4 caracteres",
                regex: "Solo se permiten n&uacute;meros"
            },
            actividad3: {
                minlength: "El código debe tener al menos 4 caracteres",
                maxlength: "El código no debe tener m&aacute;s de 4 caracteres",
                regex: "Solo se permiten n&uacute;meros"
            },
            actividad4: {
                minlength: "El código debe tener al menos 4 caracteres",
                maxlength: "El código no debe tener m&aacute;s de 4 caracteres",
                regex: "Solo se permiten n&uacute;meros"
            }
        }
    })


    function isUndefined(value){
    // Obtain `undefined` value that's
    // guaranteed to not have been re-assigned
    var undefined = void(0);
    return value === undefined;
    }

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

            var submit = $("[name=botAct]")
            

            var fd = new FormData();
            
            var cedula= document.getElementById('cedula').files[0];
            var tarjeta_profesional= document.getElementById('tarjeta_profesional').files[0];
            var registro_unico_trubitario= document.getElementById('registro_unico_trubitario').files[0];
            var registro_unico_de_proponentes= document.getElementById('registro_unico_de_proponentes').files[0];
            var antecedentes= document.getElementById('antecedentes').files[0];
            var doc_habilidad= document.getElementById('doc_habilidad').files[0];
            var acta_confidencialidad= document.getElementById('acta_confidencialidad').files[0];
            var camara_cio= document.getElementById('camara_cio').files[0];
            var hoja_vida= document.getElementById('hoja_vida').files[0];
            
            


            fd.append('action', 'user_actualizar_proponente_ajax');

            // Obtener los datos del usermeta
            var tipo_prop=document.getElementById('tipo_prop').value;

        
                if(tipo_prop==1){
                fd.append('first_name', this.first_name.value);
                }else{
                fd.append('first_name', this.razon_social.value);	
                }



                fd.append('last_name', this.last_name.value);
            
                
                            
//            fd.append('tipo_documento', this.tipo_documento.value);
//           fd.append('numero_documento', this.numero_documento.value);
            fd.append('tipo_proponente', this.tipo_prop1.value);
            fd.append('direccion_prop',this.direccion_prop.value);                       
            fd.append('celular_prop', this.celular_prop.value);
            fd.append('telefono_prop', this.telefono_prop.value); 
            fd.append('actividad1', this.actividad1.value);
            fd.append('actividad2', this.actividad2.value);
            fd.append('actividad3', this.actividad3.value);
            fd.append('actividad4', this.actividad4.value); 

            //Archivos
            fd.append('cedula', cedula);
            fd.append('tarjeta_profesional', tarjeta_profesional);
            fd.append('registro_unico_trubitario', registro_unico_trubitario);
            fd.append('registro_unico_de_proponentes', registro_unico_de_proponentes);
            fd.append('antecedentes', antecedentes);
            fd.append('doc_habilidad', doc_habilidad);
            fd.append('acta_confidencialidad', acta_confidencialidad);
            fd.append('camara_cio', camara_cio);
            fd.append('hoja_vida', hoja_vida);
            
            //Nombre de los achivos 
            if(cedula!=undefined){
                fd.append('cedula_name', cedula.name);
            }
            else{
                fd.append('cedula_name', '');
            }
            
            if(!isUndefined(tarjeta_profesional)){
                fd.append('tarjeta_profesional_name', tarjeta_profesional.name); 
            }
            else{
                fd.append('tarjeta_profesional_name', '');
            } 
            
            
        
            if(!isUndefined(registro_unico_trubitario)){
                fd.append('registro_unico_trubitario_name', registro_unico_trubitario.name); 
            }
            else{
                fd.append('registro_unico_trubitario_name', '');
            } 
            

            if(!isUndefined(registro_unico_de_proponentes)){
                fd.append('registro_unico_de_proponentes_name', registro_unico_de_proponentes.name);    
            }
            else{
                fd.append('registro_unico_de_proponentes_name', '');
            }  
            

            if(!isUndefined(antecedentes)){
                fd.append('antecedentes_name', antecedentes.name);
            }
            else{
                fd.append('antecedentes_name', '');
            } 
            

            if(!isUndefined(doc_habilidad)){
                fd.append('doc_habilidad_name', doc_habilidad.name);    
            }
            else{
                fd.append('doc_habilidad_name', '');
            } 
            

            if(!isUndefined(acta_confidencialidad)){
                fd.append('acta_confidencialidad_name', acta_confidencialidad.name);
            }
            else{
            fd.append('acta_confidencialidad_name', ''); 
            } 
            

            if(!isUndefined(camara_cio)){
            fd.append('camara_cio_name', camara_cio.name);  
            }
            else{
            fd.append('camara_cio_name', '');  
            } 
            

            if(!isUndefined(hoja_vida)){
                fd.append('hoja_vida_name', hoja_vida.name);
            }
            else{
                fd.append('hoja_vida_name', '');
            } 
            

            
                    
            
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
                                    // Recarga la p�gina que actualiza
                                    location.reload();
                                    /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                
                                    });//fin del then del swal por el �xito

                    }else{

                        //  swal('Verificar la informaci�n:', data.mensaje, 'Error');

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
        margin-bottom:10px;
    }
    .error{ color: #FF0000!important; }
	
    .doc_link a{
		color: black !important;;
	}

</style>