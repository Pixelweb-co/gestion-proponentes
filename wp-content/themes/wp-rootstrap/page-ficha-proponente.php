<?php
/*
  Template Name: Ficha Proponente
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


    if(!isset($_GET['proponente_id'])){

?>

<script>

window.history.back(-1);

</script>


<?php

//die;
}

$proponente_d = get_user_by('id', $_GET['proponente_id']);

//echo 'Id: : '.$proponente_d->ID;
//Datos Jurídicos comunes a personas naturales y jurídicos
$cedula = get_user_meta($proponente_d->ID, 'cedula');
$cedula = $cedula[0];


$tarjeta_profesional = get_user_meta($proponente_d->ID, 'tarjeta_profesional');
$tarjeta_profesional = $tarjeta_profesional[0];

$registro_unico_trubitario = get_user_meta($proponente_d->ID, 'registro_unico_trubitario');
$registro_unico_trubitario = $registro_unico_trubitario[0];

$registro_unico_de_proponentes = get_user_meta($proponente_d->ID, 'registro_unico_de_proponentes');
$registro_unico_de_proponentes = $registro_unico_de_proponentes[0];

$antecedentes = get_user_meta($proponente_d->ID, 'antecedentes');
$antecedentes = $antecedentes[0];
//echo 'Antecedentes: '.$antecedentes;

$doc_habilidad = get_user_meta($proponente_d->ID, 'doc_habilidad');
$doc_habilidad = $doc_habilidad[0];

$acta_confidencialidad = get_user_meta($proponente_d->ID, 'acta_confidencialidad');
$acta_confidencialidad = $acta_confidencialidad[0];

$hoja_vida = get_user_meta($proponente_d->ID, 'hoja_vida');
$hoja_vida = $hoja_vida[0];




if(get_user_meta($proponente_d->ID, 'tipo_documento',true) == 1){

$tipo_documento = "Cédula de ciudadanía";

}

if(get_user_meta($proponente_d->ID, 'tipo_documento',true) == 2){

$tipo_documento = "Cédula de extranjería";

}


if(get_user_meta($proponente_d->ID, 'tipo_documento',true) == 1){

$tipo_proponente = "Persona Natural";

}


if(get_user_meta($proponente_d->ID, 'tipo_documento',true) != 1){

$tipo_proponente = "Persona Jurídica";

}



?>

<div id="content" class="site-content container">
<div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			

	<div class="container">
		<h3>Ficha del proponente</h3><br> <a href="javascript:window.close()"> Volver Atrás</a>
	<hr style="width:95%; margin:0px">


	<br>

	<div class="row">
					
			<div class="col-md-3"><b>Tipo de proponente:</b> </div>
			<div class="col-md-3"> <?=$tipo_proponente?></div>
			
	</div>


    <?php if(get_user_meta($proponente_d->ID, 'tipo_documento',true) == 1){ ?><!-- Tipo Natural-->
		<div class="row">
					
			<div class="col-md-3"><b>Nombres:</b> </div>
			<div class="col-md-3"> <?= $proponente_d->first_name?></div>
			
			<div class="col-md-3"><b>Apellidos:</b> </div>
			<div class="col-md-3">  <?= $proponente_d->last_name?> </div>
	

		</div>

	    <div class="row">
					
			<div class="col-md-3"><b>Tipo de documento:</b> </div>
			<div class="col-md-3"> <?=$tipo_documento?></div>
			
			<div class="col-md-3"><b>Número de documento:</b> </div>
			<div class="col-md-3">  <?=get_user_meta($proponente_d->ID, 'numero_documento',true)?> </div>
	

		</div>

	    <div class="row">
					
			<div class="col-md-3"><b>Dirección:</b> </div>
			<div class="col-md-3"><?=get_user_meta($proponente_d->ID, 'direccion_prop',true)?></div>
			
			<div class="col-md-3"><b>Celular:</b> </div>
			<div class="col-md-3">  <?=get_user_meta($proponente_d->ID, 'celular_prop',true)?> </div>
	

		</div>

	    <div class="row">
					
			<div class="col-md-3"><b>Teléfono:</b> </div>
			<div class="col-md-3"><?=get_user_meta($proponente_d->ID, 'telefono_prop',true)?></div>
			
			<div class="col-md-3"><b>Correo Electrónico:</b> </div>
			<div class="col-md-3">  <?= $proponente_d->user_email?> </div>
	
	    </div>

    <?php }else{ ?><!-- Tipo jurídico-->

        <div class="row">
					
			<div class="col-md-3"><b>Razón social:</b> </div>
			<div class="col-md-3"> <?= $proponente_d->first_name?></div>
			
			<div class="col-md-3"><b>NIT:</b> </div>
			<div class="col-md-3">  <?=get_user_meta($proponente_d->ID, 'numero_documento',true)?> </div>
	

		</div>

	    <div class="row">
					
			<div class="col-md-3"><b>Dirección:</b> </div>
			<div class="col-md-3"><?=get_user_meta($proponente_d->ID, 'direccion_prop',true)?></div>
			
			<div class="col-md-3"><b>Celular:</b> </div>
			<div class="col-md-3">  <?=get_user_meta($proponente_d->ID, 'celular_prop',true)?> </div>
	

		</div>

	    <div class="row">
					
			<div class="col-md-3"><b>Teléfono:</b> </div>
			<div class="col-md-3"><?=get_user_meta($proponente_d->ID, 'telefono_prop',true)?></div>
			
			<div class="col-md-3"><b>Correo Electrónico:</b> </div>
			<div class="col-md-3">  <?= $proponente_d->user_email?> </div>
	
	    </div>
    <?php }//fin de else para mostrar jurídico ?>






<br>			
	<h3>Documentos del proponente</h3>

	<hr style="width:95%; margin:0px">


	<br>
            
		

                <div class="row"><!-- Fila 1  --> 
                    <div class="col-xs-6">
                         <label for="cedula"><h6><b>C&eacute;dula *</b></h6></label>
                         <div class="doc_link">
                         <?php
                                if ($cedula=="")
                                {
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }else{
                                    echo $cedula;
                                }
                             ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <label for="tarjeta_profesional"><h6><b>Tarjeta profesional *</b></h6></label>
                        <div class="doc_link">
                            
                            <?php
                                if ($tarjeta_profesional!="")
                                {
                                    echo $tarjeta_profesional;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>
                        </div>
                    </div>
                </div><!-- Fin Fila 1  -->
                <div class="row">
                    <div class="col-md-11">
                        <hr>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
                <div class="row"><!-- Fila 2  -->
                    <div class="col-xs-6">
                        <label for="registro_unico_trubitario"><h6><b>Registro único tributario (RUT) *</b></h6></label>
                        <div class="doc_link">
                            
                            <?php
                                if ($registro_unico_trubitario!="")
                                {
                                    echo $registro_unico_trubitario;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>
                        </div>
                        </div>
                    <div class="col-xs-6">
                        <label for="registro_unico_de_proponentes"><h6><b>Registro único de proponentes (RUP) *</b></h6></label>
                        <div class="doc_link">
                            <?php
                                if ($registro_unico_de_proponentes!="")
                                {
                                    echo $registro_unico_de_proponentes;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>
                        </div>
                    </div>
                </div><!-- Fila 2  -->
                <div class="row">
                    <div class="col-md-11">
                        <hr>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
                <div class="row"><!-- Fila 3  -->
                    <div class="col-xs-6">
                        <label for="antecedentes"><h6><b>Antecedentes Legales (Policía, Contraloría y Procuraduría) *</b></h6></label>
                        <div class="doc_link">
                        <?php
                                if ($antecedentes!="")
                                {
                                    echo $antecedentes;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>
                            
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <label for="doc_habilidad"><h6><b>Documento de Inhabilidad y Compatibilidad - Bajo formato *</b></h6></label>
                        <div class="doc_link">
                            
                            
                            <?php
                                if ($doc_habilidad!="")
                                {
                                    echo $doc_habilidad;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>                   
                        </div>
                    </div>
                </div><!-- Fila 3  -->
                <div class="row">
                    <div class="col-md-11">
                        <hr>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            
                <div class="row"><!-- Fila 4  -->
                    <div class="col-xs-6">
                        <label for="acta_confidencialidad"><h6><b>Acta de confiabilidad de la información - Bajo formato *</b></h6></label>                    
                        <div class="doc_link">
                            
                            <?php
                                if ($acta_confidencialidad!="")
                                {
                                    echo $acta_confidencialidad;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>                   
                        </div>                              
                     </div>
                     <div class="col-xs-6">
                            <label for="hoja_vida"><h6><b>Hoja de vida del representante legal *</b></h6></label>                    
                            <div class="doc_link">
                                
                            <?php
                                if ($hoja_vida!="")
                                {
                                    echo $hoja_vida;
                                }else{
                                    echo "<p>Este documento no ha sido cargado.</p>";
                                    
                                }
                             ?>                   
                            </div>                              
                            
                        </div>
                </div><!-- fin Fila 4  -->
                <div class="row">
                    <div class="col-md-11">
                        <hr>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
                <div class="form-group"><!-- Fila 5  -->    
                     <?php if(get_user_meta($proponente_d->ID, 'tipo_documento',true) == 2){ ?>
                    <div id="camara_comercio">            
                        <div class="col-xs-6">
                            <label for="camara_cio"><h6><b>Cámara de comercio</b></h6></label>
                            <div class="doc_link">                    
                                <?=$camara_cio?>
                            </div>                              
                        </div>
                    </div><!--fin div cam-cio -->
                	<?php } ?>

                </div><!-- fin Fila 5  -->

                

<dir class="clearfix"></dir>

<br>			
	<h3>Postulaciones</h3>

	<hr style="width:95%; margin:0px">


	<br>
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


                                   if (count($concursos_query->posts) > 0) { ?>

                                            <table id="tabla_concursos" class="table table-striped table-bordered table-condensed" style="width:95%">
                                                <thead class="text-center">
                                                    <tr>
                                                        
                                                    <th>T&iacute;tulo</th>
                                                        <th>Descripci&oacute;n</th>
                                                        <th>Documento</th>
                                                        <th>Supervisor</th>
                                                        <th>Acciones</th>
                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   

                                                 <?php 
                                                 
                                                    foreach ($concursos_query->posts as $post): 
                                                        $argsSupervisor1 = get_userdata($post->supervisor );
                                                    
                                                     $esta_postulado = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$post->ID."' and proponente = '".$proponente_d->ID."'");


                                                              if(isset($esta_postulado->id)){

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
                                                             
                                                                $esta_asignado = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$post->ID."' and ganador=1");

                                                                if($esta_postulado->ganador == '1'){

                                                                    ?>
                                                                    <b>Es ganador</b>

                                                                    <?php

                                                                }else if($esta_asignado->ganador==1){
                                                                    ?>
                                                                    <b>Concurso no disponible</b>

                                                                    <?php

                                                                        }else{
                                                                    ?>
                                                                    <button type="button" 
                                                                    data-concurso="<?=$post->ID?>"  
                                                                    data-titulo="<?=$post->post_title?>"  
                                                                    data-proponente="<?=$proponente_d->ID?>"
                                                                    data-nombre="<?=$proponente_d->first_name?>"
                                                                    data-apellido="<?=$proponente_d->last_name?>" 
                                                                    data-email="<?=$proponente_d->user_email?>" 
                                                                    class='btn btn-success btn-ganador'>Ganador</button>

                                                                    <?php
                                                                }

                                                                ?>


                                                            </td>
                                                         </tr>
                                                       <?php 

                                                   }

                                                   endforeach; ?>                      
                                                    
                                                </tbody>        
                                                </table>                    
                                          
                                        <?php }?>    



            	</div>

            </div>


	</div>
		</div>

</div>
	

</div>




<?php 

	get_footer();

?>


<script type="text/javascript">
jQuery(document).ready(function($) {


    $('.btn-ganador').click(function(){


        swal({
            html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
            + '<div class="sw-texto">\u00BFConfirmas que deseas declarar como ganador a este proponente?<br> <br><strong></div>',
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


             var fd = new FormData();
                    //postular_prop_ajax
                    fd.append('action', 'declarar_ganador_ajax');
                    fd.append('concurso', $(this).data('concurso'));
                    fd.append('titulo', $(this).data('titulo'));
                    fd.append('proponente', $(this).data('proponente'));
                    fd.append('nombre', $(this).data('nombre'));
                    fd.append('apellido', $(this).data('apellido'));
                    fd.append('email', $(this).data('email'));
                    
                    $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'POST',
                        data: fd,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                                swal({                
                                        html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                        + '<div class="sw-texto">Ha declarado el ganador de este concurso correctamente.</div>',
                                        customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                        confirmButtonText: "Entendido",
                                        confirmButtonClass: 'btn-sw btn-sw-ok',
                                        //showConfirmButton: false,
                                        type: "success"
                                }).then(function() {
                                            // Recarga la pï¿½gina que actualiza
                                            location.reload();
                                            /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                        
                                });//fin del then del swal por el ï¿½xito


                        }//fin del success
                    })//fin del ajax


        })//fin del then superior
    })//fin de la función para el botón ganador
});//fin del jquery


</script>

<style type="text/css">
	
	.doc_link{
		/* border-bottom: 1px #CCC solid !important; */

	}

	.doc_link p{
		color: red;
	}
    .doc_link a{
		color: #000000 !important;;
	}
    .error{ color: #FF0000 !important; }


</style>