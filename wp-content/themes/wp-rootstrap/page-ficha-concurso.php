<?php
/*
  Template Name: Ficha Concurso
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


if(!isset($_GET['concurso_id'])){
?>

<script>

window.history.back(-1);

</script>


<?php
 
die;
}
	//obtener todos los datos del concurso
	$concurso = get_post($_GET['concurso_id']);
	
	
	//obtener todos los datos de los proponentes
	$args = array(
		'role'           => 'proponente',
		'order'          => 'ASC',
		'orderby'        => 'tipo_proponente',
		'fields'         => 'all_with_meta'
	);
	
	// The User Query
	$user_query = new WP_User_Query( $args );


?>
<input type="hidden" name="id_conc" id="id_conc" value="<?=$concurso->ID?>">
	
<div id="content" class="site-content container">
<div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			

	<div class="container">	      
		
		<h3>Ficha de Proceso</h3> <br> <a href="javascript:window.close()"> Volver Atrás</a>
	<hr style="width:95%; margin:0px">


	<br>

	<div class="row">
					
			<div class="col-md-3"><b>Nombre:</b> </div>
			<div class="col-md-8"> <?=$concurso->post_title?></div>
			
	</div>


	<div class="row">
					
			<div class="col-md-3"><b>Descripción del concurso:</b> </div>
			<div class="col-md-8"> <?=$concurso->post_content?></div>
			
	</div>



	<div class="row">
					
			<div class="col-md-3"><b>Documento adjunto:</b> </div>
			<div class="col-md-8"> <?=$concurso->documento?></div>
			
	</div>



	<div class="row">
			<?php
				$supervisor = get_userdata($concurso->supervisor );
			?>
			<div class="col-md-3"><b>Supervisor:</b> </div>
			<div class="col-md-8">
				<?php  
					echo $supervisor->first_name.' '.$supervisor->last_name;
				?> 
			</div>
			
	</div>


	<?php 
		$hay_ganador = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$concurso->ID."' and ganador = 1");
		if($hay_ganador->ganador== 1){
			$doc_contrato = $hay_ganador->doc_contrato;
		?>
		<form id="form_contrato">
			<div class="row">
				<div class="col-xs-11">
				<label for="camara_cio">Contrato del ganador:</label>
				<div class="doc_link">                    
						<?=$doc_contrato?>
					</div>
				</div>
			</div>
			<div class="row"><!-- Fila formulario contrato -->
				<div class="col-xs-7">
					
					                              
					<input  type="file" class="form-control" name="doc_contrato" id="doc_contrato">
					<input type="hidden" name="prop" id="prop" value="<?=$hay_ganador->proponente?>">
					<input type="hidden" name="conc" id="conc" value="<?=$concurso->ID?>">
				</div>
				<div class="col-xs-4">
					<button class="btn  btn-success botC"	 type="submit"				
					name="bot_contrato" id="bot_contrato">Agregar Documento</button>

					<?php 
						// echo 'Ganador= '.$hay_ganador->proponente;
						// echo '<br>Concurso= '.$concurso->ID; 
					?>
				</div>
			</div><!-- fin Fila formulario contrato5  -->
		</form> 
		<?}//fin del if
	?>

<!-- Tabla para autorizar proponente -->
<?php 
	$hay_ganador = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$concurso->ID."' and ganador = 1");
	if($hay_ganador->ganador!=1){

	
?>
<br>
<h3>Autorizar proponentes</h3>

	<hr style="width:95%; margin:0px">
	<br>

		<?php 
		$sql2 = "select concurso from prop_autorizado where concurso='".$concurso->ID."' and proponente =-1";
		//echo $sql2;
		$todos_autorizados = $wpdb->get_row($sql2);
		if(isset($todos_autorizados->concurso)){
		?>
			<div class="container">
				<div class="row"><!-- fila 1 -->
					<div class="col-lg-8">   
					<b>Todos los proponetes están autorizados para postular a este concurso</b>
					</div>
					<div class="col-lg-3">            
						<button id="btnDesautorizarTodos" type="button" class="btn btn-danger" title="Desautoriza a todos los proponentes para este concurso" >Desautorizar todos los proponentes</button>    
					</div>    
				</div><!-- fin fila 1 -->
			</div><!--fin del container de bot�n autorizar -->
		<?php }else{ ?>
			<!-- si no estan todos autorizados -->
			<div class="container">
				<div class="row"><!-- fila 1 -->
				<div class="col-lg-8">            			
					</div>
					<div class="col-lg-3">            
						<button id="btnAutorizarTodos" type="button" class="btn btn-primary" title="Autoriza a todos los proponentes para este concurso" >Autorizar todos los proponentes</button>    
					</div>    
				</div><!-- fin fila 1 -->
			</div><!--fin del container de bot�n autorizar -->
			<div class="container">
				<div class="row"><!-- fila 1 -->
					<div class="col-lg-11">            
						<button id="btnNuevoP" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
					</div>    
				</div><!-- fin fila 1 -->                           
				<div class="row"><!-- fila 2 -->
					<div class="col-lg-11">
						<div class="table-responsive"> 

							<?php 
							//consultar la tabla de autorizados
							$hay_autorizado = $wpdb->get_row("select * from prop_autorizado where concurso='".$concurso->ID."' LIMIT 1");
							//echo 'Ver '.$hay_autorizado->concurso.'<br>';
							//if (isset($hay_autorizado->concurso)) {
												
										
							?>
							<table id="tabla_autorizados" class="table table-striped table-bordered table-condensed" style="width:95%">
									<thead class="text-center">
										<tr>
											
											<th>Tipo de proponente</th>
											<th>Nombre y apellido/Razón social</th>
											
											<th>Celular</th>
											<th>Acci&oacute;n</th>
										</tr>
									</thead>
									<tbody>
									

									<?php
									//cconsultar todos los autorizados para este concurso 
									$hay_autorizados = $wpdb->get_results("select * from prop_autorizado where concurso='".$concurso->ID."'");
									//ciclo para recorrer todos los autorizados para este concurso
									foreach ($hay_autorizados as $autorizado) {
										$prop_autorizados = get_user_by('id', $autorizado->proponente);//user y usermeta
										// echo $prop_autorizados->display_name;
										if($prop_autorizados->tipo_proponente=="1"){
											$tipo_prop="Natural";
										}else{
											$tipo_prop="Jurí­dico";
										}
										// echo '<br>'.$tipo_prop;
									
									?>
										<td>
													<?=$tipo_prop?>
													<input type="hidden" value="<?=$autorizado->proponente?>" class="clase_ID_proponente" id="id_prop" name="id_prop">
													<input type="hidden" name="conc" id="conc" value="<?=$concurso->ID?>" class="clase_ID_concurso">
													
												</td>
												<td>
												<?php 
													echo										$prop_autorizados->first_name.' '.$prop_autorizados->last_name;
												?>
												
												<td><?=$prop_autorizados->celular_prop?></td>
												<td></td>
											</tr>	
											
									<?php }//fin del foreach ?>                      
										
									</tbody>        
									</table>                    
								<?php 

										
									// } else {
									// 	echo 'No tabla';
									// }
								?>
							
						</div> <!-- fin de responsive -->
					</div><!-- fin de col -->
				</div>  <!-- fin de row -->
			</div><!--fin de la tabla autorizar -->
			<!-- fin de si no estan todos autorizados -->
		<?php }//fin de si no están todos autorizados ?>


<!-- Fin Tabla para autorizar proponente -->

<!-- Modal para autorizar proponente Nuevo -->

<div class="modal fade" id="modalCRUDc" tabindex="-1" role="dialog" aria-labelledby="modalCRUDcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDcLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formProponenteAutorizadoInsertar">    
            <div class="modal-body">
                 
                <div class="form-group">
                <label for="supervisor" class="col-form-label">Proponente * </label>
                        <select class="form-control input-lg" id="propoAuto" name="propoAuto" >
                            <option value="">Seleccione un proponente</option>
                        <?php
                            foreach ( $user_query->results as $userS ) {
                                echo '<option value="'.$userS->ID.'"> '. strtoupper($userS->first_name).' '.strtoupper($userS->last_name).'</option>';
                            }
                        ?>
                            
                        </select>
                
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarc1" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>
<!-- Fin de modal para autorizar proponente -->

<?php 
	}//fin de si no hay ganador
?>

<br>
<h3>Proponentes</h3>

<hr style="width:95%; margin:0px">


<br>

	<div class="container">
		<div class="row">
			
			<div class="col-md-11">
				<?php
					//Para validar si hay o no datos para los proponentes
					if (! empty( $user_query->results )) { 
				?>

						<table id="tabla_proponente" class="table table-striped table-bordered table-condensed" style="width:95%">
							<thead class="text-center">
								<tr>
									
									<th>Tipo de proponente</th>
									<th>Nombre y apellido/Razón social</th>
									<th>Celular</th>
									<th>Acciones</th>
									<th></th>
			   
								</tr>
							</thead>
							<tbody>
							   

							 <?php 
							 	$hay_ganador = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$concurso->ID."' and ganador = 1");

								 if($hay_ganador->ganador== 1){//si hay un ganador
									foreach ( $user_query->results as $user ):
										if($user->tipo_proponente=="1"){
											$tipo_prop="Natural";
										}else{
											$tipo_prop="Jurí­dico";
										}

										// echo 'Id concurso: '.$concurso->ID.' y el usuario: '.$user->ID.'<br>';
										
										
										
										$esta_postulado = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$concurso->ID."' and proponente = '".$user->ID."'");
										//echo 'Id concurso: '.$concurso->ID.' y el usuario: '.$user->ID.'/ Postulado'.$esta_postulado->id.'<br>';
										if(isset($esta_postulado->id)){

							?>
											<tr>
												
												<td>
												<?=$tipo_prop?>
													<input type="hidden" value="<?=$user->ID?>" class="clase_ID_Post">
												</td>
												<td>
												<a href="http://proponentes.pixelweb.com.co/ficha-proponente/?proponente_id=<?=$user->ID?>" target="_blank" rel="noopener noreferrer" class="link_nombre"><?php 
											echo $user->first_name.' '.$user->last_name; ?> </a>
												</td>
												
												<td><?=$user->celular_prop?></td>
												
												<td>
														<?php 
														
														if($esta_postulado->ganador == '1'){
															$ganador_uni = 1;
															?>
															<b>Es ganador</b>
															<?php
														}else{
															
															?>
															
															<button type="button" data-concurso="<?=$concurso->ID?>" data-proponente="<?=$user->ID?>" class='btn btn-success btn-ganador' disabled>Ganador</button>
															
															<?php
														}//fin del else del botón ganador
														?>
												</td>
												<td></td>
											</tr>
									<?php 
										
										}//fin del if postulados

									endforeach;//fin del ciclo para mostrar el ganador   ?>
									<!-- hay un ganador pinto el form para que se cargue el documento de contrato -->
									                  
									<?php
								 }else{//si no hay un ganador

									foreach ( $user_query->results as $user ):
										if($user->tipo_proponente=="1"){
											$tipo_prop="Natural";
										}else{
											$tipo_prop="Jurí­dico";
										}

										// echo 'Id concurso: '.$concurso->ID.' y el usuario: '.$user->ID.'<br>';
										
										
										
										$esta_postulado = $wpdb->get_row("select * from prop_postulaciones where concurso ='".$concurso->ID."' and proponente = '".$user->ID."'");
										//echo 'Id concurso: '.$concurso->ID.' y el usuario: '.$user->ID.'/ Postulado'.$esta_postulado->id.'<br>';
										if(isset($esta_postulado->id)){

							?>
											<tr>
												
												<td><?=$tipo_prop?><input type="hidden" value="<?=$user->ID?>" class="clase_ID_Post"></td>
												<td><?php 
											echo $user->first_name.' '.$user->last_name; ?></td>
												
												<td><?=$user->celular_prop?></td>
												
												<td>
														
															
												<button type="button" 
															data-concurso="<?=$concurso->ID?>" 
															data-titulo="<?=$concurso->post_title?>"
															data-proponente="<?=$user->ID?>"
															data-nombre="<?=$user->first_name?>"
															data-apellido="<?=$user->last_name?>" 
															data-email="<?=$user->user_email?>" 

															class='btn btn-success btn-ganador' >Ganador</button>
															
															
												</td>
												<td></td>
											</tr>
									<?php 

										}//fin del if postulados

									endforeach;//fin del ciclo para mostrar el ganador    
								}//fin del else que no hay ganador
								
							    	?>
									 
								 
								
								
							</tbody>        
							</table>                    
					  
							<?php }//fin del if empty( $user_query->results )
							else{
								echo '<h1>No hay proponentes licitando.<h1>';
							}?>

			</div><!-- fin de 12 col  de mostrar los licitantes-->


		</div><!-- fin de row  de mostrar los licitantes-->
	</div><!-- fin del containde de la tabla de licitantes-->
	
	
	
	
	
	
	</div>
	</div>

	
</div>
</div>



<?php 

	get_footer();

?>

<script type="text/javascript">
jQuery(document).ready(function($) {



	//validar

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
		

		$('#form_contrato').validate({
        errorElement: 'div',
        rules:{            
            doc_contrato:{
				required:true,
                validarSoloPDF:true
            }
        },
        messages: {            
            doc_contrato:{
				required: "Ingrese un documento en formato PDF",
            	extension: "Solo se permiten documentos .pdf"
            }
        }
    })


	//fin de validar

	//******************************** */

	tabla_proponente = $("#tabla_proponente").DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "" 
			},
			{
          "targets": [ 4 ],
          "visible": false
      }
		],
                
                //Para cambiar el lenguaje a espaÃƒÆ’Ã‚Â±ol
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                }
            });
       




//*********************************************************************************/



        //JS y Ajax para proponentes

        tabla_autorizados = $("#tabla_autorizados").DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrar' type='button'><i class='fa fa-trash-o' aria-hidden='true' title='Eliminar Proponente Autorizado' style='font-size:12px'></i></button></div></div>"  
            }],
                
                //Para cambiar el lenguaje a espaÃƒÆ’Ã‚Â±ol
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                }
            });
            
            
		///
		$("#btnNuevoP").click(function(){ //Funcionalidad para el boton nuevo de Concursos
            $("#formProponenteAutorizadoInsertar").trigger("reset");
            $(".modal-header").css("background-color", "#28a745");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Autorizar Proponentes");            
            $("#modalCRUDc").modal("show");        
            id=null;
            opcion = 1; //alta
        });//fin de Funcionalidad para el boton nuevo de Concursos

		////

		$("#formProponenteAutorizadoInsertar").submit(function(e){//Funcionalidad para el boton aceptar modal proponentes autorizados
			e.preventDefault(); 
			 
                swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas el enví­o del registro?<br> <br><strong></div>',
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
                        var submit = $("[name=btnGuardarc1]")

						var fd = new FormData();
						
						var id_concurso = document.getElementById('id_conc').value;
						
                        fd.append('action', 'incluir_proponente_autorizado_ajax');
						fd.append('id_concurso', id_concurso);
                        fd.append('id_prop_autorizado', this.propoAuto.value);
                        
                        


                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            data: fd,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(data){  
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
                                                        // Recarga la pÃƒÂ¯Ã‚Â¿Ã‚Â½gina que actualiza
                                                        location.reload();
                                                        /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                        });//fin del then del swal por el ÃƒÂ¯Ã‚Â¿Ã‚Â½xito

                                }else{

                                        //  swal('Verificar la informaciÃƒÂ¯Ã‚Â¿Ã‚Â½n:', data.mensaje, 'Error');

                                        swal({
                                            html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
                                                '<div class="sw-texto"><b>Verificar la información: </b> '+data.mensaje+'Result: '+data.result+' </div>',
                                            customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
                                            confirmButtonText: "Entendido",
                                            confirmButtonClass: 'btn-sw btn-sw-error',
                                            //showConfirmButton: false,
                                            type: "error"
                                        });//fin del then del swal de error

                                }//fin del else de los mensajes

                            }   //fin de success     
                        });//fin de ajax

                        $("#modalCRUDc").modal("hide");
                    }//fin del if
                });//fin del then     
            
    
            
        }); // fin de funcionalidad para el boton aceptar modal proponentes autorizados

		////

        var fila; //capturar la fila para editar o borrar el registro
            

        //boÃ³n BORRAR
          
        $(document).on("click", ".btnBorrar", function(){    
            swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas la eliminación del registro?<br> <br><strong></div>',
                    customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-sw btn-sw-ok',
                    cancelButtonClass: 'btn-sw btn-sw-ok btn-cancel-ok',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si',
                    showLoaderOnConfirm: true
                    
            }).then((result) => {

                if (result.value) {
                        
						
						fila = $(this).closest("tr");
            
						id_prop_autorizado=  fila.find('.clase_ID_proponente').val();
						id_concurso=  fila.find('.clase_ID_concurso').val();
						
						
                        
                        
                            
                            $.ajax({
                                url: "/wp-admin/admin-ajax.php",
                                type: "POST",
                                data: {id_prop_autorizado: id_prop_autorizado, id_concurso:id_concurso, action: 'eliminar_proponente_autorizado_ajax'},
                                dataType: "json",
                                //contentType: false,
                                //processData: false,
                                success: function(){
                                    swal({                
                                        html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                        + '<div class="sw-texto">Se ha eliminado correctamente este proponente</div>',
                                        customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                        confirmButtonText: "Entendido",
                                        confirmButtonClass: 'btn-sw btn-sw-ok',
                                        //showConfirmButton: false,
                                        type: "success"
                                    }).then(function() {
                                                // Recarga la pÃ¡gina que actualiza
                                                location.reload();
                                            
                                            
                                    });//fin del then del swal por el Ã©xito
                                }//fin del sucess
                            });//finde ajax
                    }//fin del if   
            })//fin del then    
        });//fin de eliminar



        //Fin de JS y Ajax para proponentes autorizados



//////

        //botón autorizar
          
        $(document).on("click", "#btnAutorizarTodos", function(){    
            swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas la autorización de todos los proponentes para este concurso?<br> <br><strong></div>',
                    customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-sw btn-sw-ok',
                    cancelButtonClass: 'btn-sw btn-sw-ok btn-cancel-ok',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si',
                    showLoaderOnConfirm: true
                    
            }).then((result) => {

                if (result.value) {
						
					var id_concurso = document.getElementById('id_conc').value;


                            $.ajax({
                                url: "/wp-admin/admin-ajax.php",
                                type: "POST",
                                data: {id_concurso:id_concurso, action: 'autorizar_todos_los_proponentes_ajax'},
                                dataType: "json",
                                //contentType: false,
                                //processData: false,
                                success: function(){
                                    swal({                
                                        html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                        + '<div class="sw-texto">Se han autorizado correctamente a todos los proponentes para este concurso</div>',
                                        customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                        confirmButtonText: "Entendido",
                                        confirmButtonClass: 'btn-sw btn-sw-ok',
                                        //showConfirmButton: false,
                                        type: "success"
                                    }).then(function() {
                                                // Recarga la pÃ¡gina que actualiza
                                                location.reload();
                                            
                                            
                                    });//fin del then del swal por el Ã©xito
                                }//fin del sucess
                            });//finde ajax
                    }//fin del if   
            })//fin del then    
        });//fin de autorizar





////

//botón autorizar
          
$(document).on("click", "#btnDesautorizarTodos", function(){    
            swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas la desautorización de todos los proponentes para este concurso?<br> <br><strong></div>',
                    customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-sw btn-sw-ok',
                    cancelButtonClass: 'btn-sw btn-sw-ok btn-cancel-ok',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si',
                    showLoaderOnConfirm: true
                    
            }).then((result) => {

                if (result.value) {
						
					var id_concurso = document.getElementById('id_conc').value;


                            $.ajax({
                                url: "/wp-admin/admin-ajax.php",
                                type: "POST",
                                data: {id_concurso:id_concurso, action: 'desautorizar_todos_los_proponentes_ajax'},
                                dataType: "json",
                                //contentType: false,
                                //processData: false,
                                success: function(){
                                    swal({                
                                        html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                        + '<div class="sw-texto">Se han desautorizado correctamente a todos los proponentes para este concurso</div>',
                                        customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                        confirmButtonText: "Entendido",
                                        confirmButtonClass: 'btn-sw btn-sw-ok',
                                        //showConfirmButton: false,
                                        type: "success"
                                    }).then(function() {
                                                // Recarga la pÃ¡gina que actualiza
                                                location.reload();
                                            
                                            
                                    });//fin del then del swal por el Ã©xito
                                }//fin del sucess
                            });//finde ajax
                    }//fin del if   
            })//fin del then    
        });//fin de autorizar

	//************************************ */

    $('.btn-ganador').click(function(){

		console.log('hola');
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

			if (result.value) {
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
			}//fin de if (result.value) 

        })//fin del then superior
    })//fin de la función para el botón ganador



$('#form_contrato').submit( function(e){
// $('.botC').click(function(){

	e.preventDefault();

	var $form = $(this)

	if(! $form.valid()) return false;


		

				swal({
					html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
					+ '<div class="sw-texto">\u00BFConfirmas el env&iacute;o del documento de contrato?<br> <br><strong></div>',
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
						var submit = $("[name=bot_contrato]")
									var fd = new FormData();
									//postular_prop_ajax
									
									fd.append('action', 'documento_concurso_ajax');

									var doc_contrato = document.getElementById('doc_contrato').files[0];
									fd.append('doc_contrato', doc_contrato);
									if(doc_contrato!=undefined){
										fd.append('doc_contrato_name', doc_contrato.name);
									}
									else{
										fd.append('doc_contrato_name', '');
									}
									

									var prop=document.getElementById('prop').value;
									var conc=document.getElementById('conc').value;
									fd.append('proponente', prop);
									fd.append('concurso', conc);
									submit.attr("disabled", "disabled").addClass('disabled');

									$.ajax({
										url: '/wp-admin/admin-ajax.php',
										type: 'POST',
										data: fd,
										dataType: 'json',
										contentType: false,
										processData: false,
										success: function (data) {
											submit.removeAttr("disabled").removeClass('disabled');
											if(data.result=="sucess"){

												swal({                
														html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
														+ '<div class="sw-texto">Ha cargado el contrato de este concurso correctamente.</div>',
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
											}else{
														swal({
															html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
																'<div class="sw-texto"><b>Verificar la información: </b> '+data.mensaje+' </div>',
															customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
															confirmButtonText: "Entendido",
															confirmButtonClass: 'btn-sw btn-sw-error',
															//showConfirmButton: false,
															type: "error"
														}).then(function() {
															// Recarga la pï¿½gina que actualiza
															location.reload();
															/* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
														
													});//fin del then del swal por el ï¿½xito
											}


								}//fin del success
							})//fin del ajax
					}//fin de if (result.value) 
		
				});//fin del then
		
})//fin de la funciï¿½n


});//fin del jquery
</script>
<style type="text/css">
    .error{ color: #FF0000 !important; }
	.doc_link a{
		color: #000000 !important;
	}
	.link_nombre{
		color: #000000 !important;
	}
</style>