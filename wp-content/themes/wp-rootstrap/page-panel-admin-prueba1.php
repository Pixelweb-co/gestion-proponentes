<?php
/*
  Template Name: Panel Admin
 */
?>
<?php  
   get_header(); 

 //*****************Traer los datos para las tablas */  
//consultar los proponentes
$args = array(
	'role'           => 'proponente',
	'number'         => '-1',
	'offset'         => '10',
	'order'          => 'ASC',
	'orderby'        => 'tipo_proponente',
	'fields'         => 'all_with_meta',
);

// The User Query
$user_query = new WP_User_Query( $args );
//fin de consultar los proponentes

//consultar los supervisores
$argsSupervisor = array(
	'role'           => 'supervisor',
	'number'         => '-1',
	'offset'         => '10',
	'order'          => 'ASC',
	'orderby'        => 'tipo_proponente',
	'fields'         => 'all_with_meta',
);

// The User Query
$user_supervisor = new WP_User_Query( $argsSupervisor );
//consultar los supervisores



//consultar concursos

$args = array(
    'post_type' => 'concurso',
    'orderby' => 'date',
    'order'   => 'DESC'
);

$concursos_query = new WP_Query($args);

?>	



<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			
	
            <div class="row">        
                <div class="col-sm-2"></div>
            </div>
            
            <div class="row"><!--/ row-->
                <div class="col-md-12"> <!-- Espacio de trabajo -->                
                    <!-- Pestañas -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#panel_proponentes">Proponentes</a></li>
                        <li><a data-toggle="tab" href="#panel_concursos">Concursos</a></li>
                        <li><a data-toggle="tab" href="#panel_supervisores">Supervisores</a></li>
                    </ul>
                    <div class="tab-content"><!--Contenedor grande dpara las peasta�as -->
                    <!-- Contenido de cada pestaña -->
                    
                        <div class="tab-pane active" id="panel_proponentes">   
                                <div class="row row-space">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">  
                                                <?php if ( ! empty( $user_query->results ) ) { ?>      
                                                    <form id="frm_proponentes"><!-- formulario para proponentes -->
                                                        <table id="tabla_proponente" class="table table-striped table-bordered table-condensed" style="width:100%">
                                                            <thead class="text-center">
                                                                <tr>
                                                                    
                                                                    <th>N&uacute;mero de documento</th>
                                                                    <th>Nombre y apellido/Raz&oacute;n social</th>
                                                                    <th>Email</th>
                                                                    <th>Tipo de proponete</th>
                                                                    <th>Ver</th>
                                                                    <th>Acci&oacute;n</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php                            
                                                                    foreach ( $user_query->results as $user ) {
                                                                        if($user->tipo_proponente=="1"){
                                                                            $tipo_prop="Natural";
                                                                        }else{
                                                                            $tipo_prop="Jurídico";
                                                                        }
                                                                ?>
                                                                <tr>
                                                                    
                                                                    <td><?=$user->numero_documento?></td>
                                                                    <td><?=strtoupper($user->display_name)?></td>
                                                                    <td><?=strtoupper($user->user_email)?></td>
                                                                    <td><?=strtoupper($tipo_prop)?></td>
                                                                    <td><a class='btn btn-warning' href='/ficha-proponente/?proponente_id=<?=$user->id?>' target='_blank'>Ver</a></td>
                                                                    <td></td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                ?>                                
                                                            </tbody>        
                                                        </table>                    
                                                    </form>
                                                <?php }else{ echo '<h1>No hay proponentes disponibles</h1>'; } ?>    
                                            </div> <!-- fin de responsive -->
                                        </div><!-- fin de col -->
                                </div>  <!-- fin de row -->
                            

                        </div><!--/fin de panel proponentes-->


                        <div class="tab-pane" id="panel_concursos">
                        
                            <div class="row row-space"><!-- fila 1 -->
                                <div class="col-lg-12">            
                                    <button id="btnNuevoC" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
                                </div>    
                            </div><!-- fin fila 1 -->                           
                            <div class="row row-space"><!-- fila 2 -->
                                <div class="col-lg-12">
                                    <div class="table-responsive">  
                                     <?php if (count($concursos_query->posts) > 0) { ?>

                                            <table id="tabla_concursos" class="table table-striped table-bordered table-condensed" style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        
                                                    <th>T&iacute;tulo</th>
                                                        <th>Descripci&oacute;n</th>
                                                        <th>Documento</th>
                                                        <th>Supervisor</th>
                                                        <th>Ver</th>
                                                        <th>Acci&oacute;n</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   

                                                 <?php 
                                                 
                                                    foreach ($concursos_query->posts as $post): 
                                                        $argsSupervisor1 = get_userdata($post->supervisor );
                                                    
                                                    
                                                    ?>
                                                 
                                                        
                                                        <tr>
                                                            
                                                            <td><?=$post->post_title?><input type="hidden" value="<?=$post->ID?>" class="clase_ID_Post"></td>
                                                            <td><?=$post->post_content?></td>
                                                            <td><div class="doc_link">
                                                                    <?=$post->documento?>                    
                                                                </div>
                                                            
                                                            </td>
                                                            <td>
                                                                <?php
                                                                     echo  $argsSupervisor1->first_name;                                                           
                                                                ?>
                                                                <input type="hidden" value="<?=$post->supervisor?>" class="clase_ID_Supervisor">
                                                            </td>
                                                            <td>
                                                            
                                                            <a class='btn btn-warning' href='/ficha-concurso/?concurso_id=<?=$post->ID?>' target='_blank'>Ver</a></td>
                                                            <td></td>
                                                        </tr>
                                                       <?php endforeach; ?>                      
                                                    
                                                </tbody>        
                                                </table>                    
                                          
                                        <?php }else{ echo '<h1>No hay concursos disponibles</h1>'; } ?>    
                                    </div> <!-- fin de responsive -->
                                </div><!-- fin de col -->
                            </div>  <!-- fin de row -->
                        </div><!--/fin de panel concursos-->
                    

                        <div class="tab-pane" id="panel_supervisores"> 
                            <div class="row row-space"><!-- fila 1 -->
                                <div class="col-lg-12">            
                                <button id="btnNuevoS" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
                                </div>    
                            </div><!-- fin fila 1 -->                           
                            <div class="row row-space"><!-- fila 2 -->
                                <div class="col-lg-12">
                                    <div class="table-responsive">  
                                        <?php if ( ! empty( $user_query->results ) ) { ?>      
                                            <form id="frm_supervisores"><!-- formulario para supervisores -->
                                                <table id="tabla_supervisores" class="table table-striped table-bordered table-condensed" style="width:100%">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Documento de Identidad</th>
                                                            <th>Nombres</th>
                                                            <th>Apellidos</th>
                                                            <th>Email</th>
                                                            <th>Usuario</th>
                                                            <th>Ver</th>
                                                            <th>Acci&oacute;n</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php                            
                                                            foreach ( $user_supervisor->results as $userS ) {
                                                                // if($user->tipo_proponente=="1"){
                                                                //     $tipo_prop="Natural";
                                                                // }else{
                                                                //     $tipo_prop="Jurídico";
                                                                // } //Pendiente por si hay que colocar si existe o no un archivo
                                                        ?>
                                                        <tr>
                                                            
                                                            <td><?=$userS->numero_documento?></td>
                                                            <td><?=strtoupper($userS->first_name)?></td>
                                                            <td><?=strtoupper($userS->last_name)?></td>
                                                            <td><?=strtoupper($userS->user_email)?></td>
                                                            <td><?=strtoupper($userS->user_login)?></td>
                                                            <td>
                                                                <a class='btn btn-warning' href='/ficha-supervisor/?supervisor_id=<?=$userS->id?>' target='_blank'>Ver</a>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        ?>                                
                                                    </tbody>        
                                                </table>                    
                                            </form>
                                        <?php }else{ echo '<h1>No hay supervisores disponibles</h1>'; } ?>    
                                    </div> <!-- fin de responsive -->
                                </div><!-- fin de col -->
                            </div>  <!-- fin de row --><!-- fila 2 -->
                        </div><!--/tab-pane panel Supervisores-->
                    
                    </div><!--/tab-content. Contendeor mayor-->
                </div><!--/col-12--> <!-- Fin de Espacio de trabajo -->
            </div><!--/ fin de row-->
		</div><!-- fin de #main -->
	</div><!-- fin de #primary -->
</div><!-- fin de #content -->

<!-- Modal para Concursos Insertar-->
<div class="modal fade" id="modalCRUDc" tabindex="-1" role="dialog" aria-labelledby="modalCRUDcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDcLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formConcursosInsertar">    
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">T&iacute;tulo:</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
                
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripci&oacute;n</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" >
                </div>                
                <div class="form-group">
                <label for="documento"><h6>Documento Concurso - Bajo formato *</h6></label>
                        <div class="doc_link">
                            <?=$userS->documento?>                    
                        </div>
                        <input  type="file"   class="form-control" name="documento" id="documento">
                </div> 
                <div class="form-group">
                <label for="supervisor" class="col-form-label">Supervisor</label>
                        <select class="form-control input-lg" id="supervisor" name="supervisor" >
                            <option value="">Seleccione un supervisor</option>
                        <?php
                            foreach ( $user_supervisor->results as $userS ) {
                                echo '<option value="'.$userS->ID.'"> '. $userS->first_name.' '.$userS->last_name.'</option>';
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



<!-- Modal para Concursos Modificar -->
<div class="modal fade" id="modalCRUDc2" tabindex="-1" role="dialog" aria-labelledby="modalCRUDcLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDcLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formConcursosModificar">    
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">T&iacute;tulo:</label>
                <input type="text" class="form-control" id="titulo2" name="titulo2">
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripci&oacute;n</label>
                <input type="text" class="form-control" id="descripcion2" name="descripcion2" >
                </div>                
                <div class="form-group" id="doc">
                        
                </div>
                <div class="form-group">
                <label for="supervisor" class="col-form-label">Supervisor</label>
                <input type="hidden" id="id_post" name="id_post">

                <select class="form-control input-lg" id="supervisor2" name="supervisor2" >
                            <option value="">Seleccione un supervisor</option>
                        <?php
                            foreach ( $user_supervisor->results as $userS ) {
                                echo '<option value="'.$userS->ID.'"> '. $userS->first_name.' '.$userS->last_name.'</option>';
                            }
                        ?>
                            
                        </select>
                
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarc2" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>





<!-- Modal para Supervisor Insertar-->
<div class="modal fade" id="modalCRUDs1" tabindex="-1" role="dialog" aria-labelledby="modalCRUDsLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDsLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- fin de modal header -->
            <form id="formSupervisoresInsertar">    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="documento_identidadS" class="col-form-label">Documento de Identidad</label>
                        <input type="text" class="form-control" id="documento_identidadS" name="documento_identidadS">
                    </div>
                    <div class="form-group">
                        <label for="nombreS" class="col-form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombreS" name="nombreS">
                    </div>
                    <div class="form-group">
                        <label for="apellidoS" class="col-form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidoS" name="apellidoS">
                    </div>                
                    <div class="form-group">
                        <label for="emailS" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="emailS" name="emailS">
                    </div>     
                    <div class="form-group">
                        <label for="usuarioS" class="col-form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuarioS" name="usuarioS" >
                    </div>       
                </div><!-- fin de modal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardarS1" class="btn btn-dark">Guardar</button>
                </div><!-- fin de modal footer -->
            </form>    
        </div><!-- fin de modal content-->
    </div><!-- fin de modal-dialog -->
</div>  <!-- fin de modal fade -->

<!-- Modal para Supervisor Modificar-->
<div class="modal fade" id="modalCRUDs2" tabindex="-1" role="dialog" aria-labelledby="modalCRUDsLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDsLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formSupervisoresModificar">    
            <div class="modal-body">
                <div class="form-group">
                <label for="documento_identidadS2" class="col-form-label">Documento de Identidad</label>
                <input type="text" class="form-control" id="documento_identidadS2" name="documento_identidadS2" disabled>
                </div>
                <div class="form-group">
                <label for="nombreS2" class="col-form-label">Nombres</label>
                <input type="text" class="form-control" id="nombreS2" name="nombreS2">
                </div>
                <div class="form-group">
                <label for="apellidoS2" class="col-form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidoS2" name="apellidoS2">
                </div>                
                <div class="form-group">
                <label for="emailS2" class="col-form-label">Email</label>
                <input type="text" class="form-control" id="emailS2" name="emailS2" disabled>
                </div>     
                <div class="form-group">
                <label for="usuarioS2" class="col-form-label">Usuario</label>
                <input type="text" class="form-control" id="usuarioS2" name="usuarioS2" disabled>
                </div>       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarS2" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  





<?php 
	get_footer(); 
                                                                    
?>



<script type="text/javascript">
jQuery(document).ready(function($) {

		$('.nav a').click(function(){

		    $('.tab-pane').removeClass('active');		
		
		    if($(this).attr('href') === '#panel_concursos'){

		        $('#panel_concursos').addClass('active');

		    }else if($(this).attr('href') === '#panel_supervisores'){

                $('#panel_supervisores').addClass('active');

            }else{

		        $('#panel_proponentes').addClass('active');

		    }//fin del if-else
        })// fin de la función del .nav a
        
            //Validaciones

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




            $('#formSupervisoresInsertar').validate({
            errorElement: 'div',
            rules:{
                nombreS:{
                    required: true,
                    maxlength: 30,
                    regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                },
                apellidoS: {
                    required: true,
                    maxlength: 30,
                    regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                },
                documento_identidadS: {
                    required: true,
                    number: true,
                    minlength: 6,
                    maxlength: 10,
                    regex: /[0-9]/
                },                        
                usuarioS: {
                    required: true,
                    minlength: 8
                },
                emailS: {
                    required: true,
                    email: true
                }
            },
            messages: {
                nombreS: {
                    required: "Ingrese el Nombre",
                    maxlength: "El nombre no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z y espacios" 
                },
                apellidoS: {
                    required: "Ingrese el Apellido",
                    maxlength: "El apellido no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z y espacios" 
                },
                documento_identidadS: {
                    required: "Ingrese el n&uacute;mero de documento",
                    number: "Ingrese un numero de documento v&aacute;lido",
                    minlength: "El documento debe tener al menos 6 caracteres",
                    maxlength: "El documento no debe tener m&aacute;s 10 caracteres",
                    regex: "Ingrese un número de documento v&aacute;lido"
                },
                
                usuarioS: {
                    required: "Por favor ingresa tu nombre de usuario",
                    minlength: "Tu nombre de usuario debe tener al menos 8 caracteres"
                },
                emailS: "Por favor ingresa una direcci&oacute;n de email válida"
                        
            }
        })//fin de la función validate



// /****++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++**********/
        $('#formSupervisoresModificar').validate({
            errorElement: 'div',
            rules:{
                nombreS2:{
                    required: true,
                    maxlength: 30,
                    regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                },
                apellidoS2: {
                    required: true,
                    maxlength: 30,
                    regex:/^[A-Za-záéíóúñÝÉÝÓÚÑ \s]+$/g
                }
            },
            messages: {
                nombreS2: {
                    required: "Ingrese el Nombre",
                    maxlength: "El nombre no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z y espacios" 
                },
                apellidoS2: {
                    required: "Ingrese el Apellido",
                    maxlength: "El apellido no debe tener m&aacute;s de 30 caracteres",
                    regex: "Solo se permiten caracteres de la A a la Z y espacios" 
                }       
            }
        })//fin de la función validate



/*********************************************************************************/



        //JS y Ajax para proponentes

        tabla_proponente = $("#tabla_proponente").DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
            }],
                
                //Para cambiar el lenguaje a espaÃ±ol
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Ãšltimo",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                }
            });
            
            

        var fila; //capturar la fila para editar o borrar el registro
            

        //botÃ³n BORRAR
        $(document).on("click", ".btnBorrar", function(){    
            fila = $(this);
            email = $(this).closest("tr").find('td:eq(2)').text();
            nombre = $(this).closest("tr").find('td:eq(1)').text();
            
            opcion = 3 //borrar
            var respuesta = confirm("¿Está seguro de eliminar el registro: "+nombre+"?");
            if(respuesta){
                $.ajax({
                    url: "/wp-admin/admin-ajax.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:opcion, email:email, action: 'eliminar_proponente_ajax'},
                    success: function(){
                        tabla_proponente.row(fila.parents('tr')).remove().draw();
                        tabla_proponente.ajax.reload(null, false);
                    }
                });
            }   
        });//fin de eliminar

        //Fin de JS y Ajax para proponentes


//************************************************************************************************************* */



//         //JS y Ajax para tabla_concursos
            tabla_concursos = $("#tabla_concursos").DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarC' type='button'>Editar</button><button class='btn btn-danger btnBorrarC'>Borrar</button></div></div>"  
            }],
                
                //Para cambiar el lenguaje a espaÃ±ol
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Ãšltimo",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                }
            });
        

        
        $("#btnNuevoC").click(function(){ //Funcionalidad para el boton nuevo de Concursos
            $("#formConcursosInsertar").trigger("reset");
            $(".modal-header").css("background-color", "#28a745");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Nuevo Concurso");            
            $("#modalCRUDc").modal("show");        
            id=null;
            opcion = 1; //alta
        });//fin de Funcionalidad para el boton nuevo de Concursos

        var filaC; //capturar la fila para editar o borrar el registro

        $(document).on("click", ".btnEditarC", function(){//Funcionalidad para el boton editar de Concursos
            filaC = $(this).closest("tr");
            
            id_post=  filaC.find('.clase_ID_Post').val() ;
            titulo = filaC.find('td:eq(0)').text();
            descripcion = filaC.find('td:eq(1)').text();
            var documento = filaC.find('td:eq(2)').text();
            supervisor = filaC.find('td:eq(3)').text();
            id_supervisor=  filaC.find('.clase_ID_Supervisor').val();
            console.log('Documento',documento);
            alert(documento);
            // console.log('id',id);
            // console.log(supervisor);
            
         
            
            $("#id_post").val(id_post);
            $("#titulo2").val(titulo);
            $("#descripcion2").val(descripcion);
            $("#documento2").val(documento);
            // $("#supervisor2").val(supervisor);
            $("#supervisor2 option[value="+ id_supervisor +"]").attr("selected",true);

            
            opcion = 2; //editar
            
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar Concursos");            
            $("#modalCRUDc2").modal("show");  
            
        });//fin de Funcionalidad para el boton nuevo de Concursos


        $(document).on("click", ".btnBorrarC", function(){    
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
                        filaC = $(this);
            
                        titulo = $(this).closest("tr").find('td:eq(0)').text();
                        
                        // console.log('Aqui estoy 1');
                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            dataType: "json",
                            data: {titulo:titulo, action:'eliminar_concursos_ajax'},
                            success: function(){
                                // tabla_supervisores.row(filaS.parents('tr')).remove().draw();
                                // tabla_supervisores.ajax.reload(null, false);
                            
                                // console.log('Aqui estoy 2');
                        
                                // if (data.result == 'success') {
                                //     console.log('Aqui estoy 2',data.result);
                                //         swal({                
                                //                     html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                //                     + '<div class="sw-texto">'+data.mensaje+'</div>',
                                //                     customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                //                     confirmButtonText: "Entendido",
                                //                     confirmButtonClass: 'btn-sw btn-sw-ok',
                                //                     //showConfirmButton: false,
                                //                     type: "success"
                                //                     }).then(function() {
                                //                         // Recarga la pï¿½gina que actualiza
                                //                         location.reload();
                                //                         /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                //         });//fin del then del swal por el ï¿½xito

                                // }else{

                                //         //  swal('Verificar la informaciï¿½n:', data.mensaje, 'Error');

                                //         swal({
                                //             html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
                                //                 '<div class="sw-texto"><b>Verificar la información: </b> '+data.mensaje+'Result: '+data.result+' </div>',
                                //             customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
                                //             confirmButtonText: "Entendido",
                                //             confirmButtonClass: 'btn-sw btn-sw-error',
                                //             //showConfirmButton: false,
                                //             type: "error"
                                //         });//fin del then del swal de error

                                // }//fin del else de los mensajes

                            }   //fin de success     
                        });//fin de ajax

                        
                    }//fin del if
                });//fin del then      
        });//fin de eliminar

        
        
        $("#formConcursosInsertar").submit(function(e){//Funcionalidad para el boton aceptar modal Concursos
            e.preventDefault();  
            // var $form = $(this);//variable que guarda la instancia del
            // if(! $form.valid()) return false;//si el formulario no ha sido validado no deja actuar el submit

            


                swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas el envío del registro?<br> <br><strong></div>',
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

                        fd.append('action', 'insertar_concursos_ajaxP');

                        fd.append('titulo', this.titulo.value);
                        fd.append('descripcion', this.descripcion.value);
                        fd.append('supervisor', this.supervisor.value);
                        
                        fd.append('documento', document.getElementById('documento').files[0]);
                        
                        //submit.attr("disabled", "disabled").addClass('disabled');
                        // titulo = $.trim($("#titulo").val());
                        // descripcion = $.trim($("#descripcion").val());
                        // //documento = $.trim($("#documento").val());
                        // documento= document.getElementById('documento').files[0];
                        // supervisor = $.trim($("#supervisor").val());
                        

                        
                        // console.log(titulo);
                        // console.log(descripcion);
                        // console.log(documento);   
                        // console.log(supervisor);
                        


                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            data: fd,
                            dataType: "json",
                            // data: {titulo:titulo, descripcion:descripcion, documento:documento, supervisor:supervisor, opcion:opcion, action: 'insertar_concursos_ajaxP'},
                            contentType: false,
                            processData: false,
                            success: function(data){  
                                //submit.removeAttr("disabled").removeClass('disabled');
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
                                                        // Recarga la pï¿½gina que actualiza
                                                        location.reload();
                                                        /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                        });//fin del then del swal por el ï¿½xito

                                }else{



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
            
    
            
        }); // fin de funcionalidad para el boton aceptar modal Concursos




        
        $("#formConcursosModificar").submit(function(e){//Funcionalidad para el boton aceptar modal Concursos
            e.preventDefault();  
            // var $form = $(this);//variable que guarda la instancia del
            // if(! $form.valid()) return false;//si el formulario no ha sido validado no deja actuar el submit

            


                swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas el envío del registro?<br> <br><strong></div>',
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
                        id_post  = $.trim($("#id_post").val());
                        titulo = $.trim($("#titulo2").val());
                        descripcion = $.trim($("#descripcion2").val());
                        documento = $.trim($("#documento2").val());
                        supervisor = $.trim($("#supervisor2").val());
                        

                        console.log(id_post);
                        console.log(titulo);
                        console.log(descripcion);
                        console.log(documento);   
                        console.log(supervisor);
                        


                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            dataType: "json",
                            data: {id_post:id_post, titulo:titulo, descripcion:descripcion, documento:documento, supervisor:supervisor, opcion:opcion, action: 'modificar_concursos_ajax'},
                            success: function(data){  
                                // console.log(date);

                                // documento_identidadS = data.documento_identidadS;
                                // nombreS = data.nombreS;
                                // apellidoS = data.apellidoS;
                                // emailS = data.emailS;
                                // usuarioS = data.usuarioS;
                                
                                // if(opcion == 1){tabla_supervisores.row.add([ documento_identidadS, nombreS, apellidoS, emailS, usuarioS]).draw();}
                                // else{tabla_supervisores.row(filaS).data([ documento_identidadS, nombreS, apellidoS, emailS, usuarioS]).draw();}   
                                // tabla_supervisores.ajax.reload(null, false);

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
                                                        // Recarga la pï¿½gina que actualiza
                                                        location.reload();
                                                        /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                        });//fin del then del swal por el ï¿½xito

                                }else{

                                        //  swal('Verificar la informaciï¿½n:', data.mensaje, 'Error');

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

                        $("#modalCRUDc2").modal("hide");
                    }//fin del if
                });//fin del then     
            
    
            
        }); // fin de funcionalidad para el boton aceptar modal Concursos


        //Fin de JS y Ajax para tabla_concursos

//******************************************************************************************************************************/

//JS y Ajax para tabla_supervisores
//Para validar https://www.it-swarm.dev/es/javascript/como-validar-correctamente-un-formulario-modal/822722051/

tabla_supervisores = $("#tabla_supervisores").DataTable({
            "columnDefs":[{
                "targets": -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarS' type='button'>Editar</button><button class='btn btn-danger btnBorrarS' type='button'>Borrar</button></div></div>"  
            }],
                
                //Para cambiar el lenguaje a español
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
        }); //fin de tabla supervisores

            $("#btnNuevoS").click(function(){ //Funcionalidad para el boton nuevo de supervisores
                $("#formSupervisoresInsertar").trigger("reset");
                $(".modal-header").css("background-color", "#28a745");
                $(".modal-header").css("color", "white");
                $(".modal-title").text("Nuevo Supervisor");            
                $("#modalCRUDs1").modal("show");        
                id=null;
                opcion = 1; //alta
            });//fin de Funcionalidad para el boton nuevo de supervisores

            var filaS; //capturar la fila para editar o borrar el registro
        
            $(document).on("click", ".btnEditarS", function(){//Funcionalidad para el boton editar de supervisores
                        console.log('Editar');
                    filaS = $(this).closest("tr");
                    // //id = obtener el id de post;
                    documento_identidadS = filaS.find('td:eq(0)').text();
                    console.log(documento_identidadS);
                    nombreS = filaS.find('td:eq(1)').text(); 
                    console.log(nombreS);
                    apellidoS = filaS.find('td:eq(2)').text();
                    console.log(apellidoS);   
                    emailS = filaS.find('td:eq(3)').text();
                    console.log(emailS);
                    usuarioS = filaS.find('td:eq(4)').text();
                    console.log(usuarioS);




                    $("#documento_identidadS2").val(documento_identidadS);
                    $("#nombreS2").val(nombreS);
                    $("#apellidoS2").val(apellidoS);
                    $("#emailS2").val(emailS);
                    $("#usuarioS2").val(usuarioS);

                    
                    opcion = 2; //editar
                    
                    $(".modal-header").css("background-color", "#007bff");
                    $(".modal-header").css("color", "white");
                    $(".modal-title").text("Editar supervisores");            
                    $("#modalCRUDs2").modal("show");  
                    
        });//fin de Funcionalidad para el boton nuevo de supervisores

        
        //botÃ³n BORRAR
        // $(document).on("click", ".btnBorrarS", function(){    
        //     filaS = $(this);
            
        //     nombre = $(this).closest("tr").find('td:eq(1)').text();
        //     ape = $(this).closest("tr").find('td:eq(2)').text();
        //     email = $(this).closest("tr").find('td:eq(3)').text();

            
        //     opcion = 3 //borrar
        // //     var respuesta = confirm("¿Está seguro de eliminar el registro: "+nombre+" "+ape+"?");
        // //     if(respuesta){
        //     $.ajax({
        //             url: "/wp-admin/admin-ajax.php",
        //             type: "POST",
        //             dataType: "json",
        //             data: {opcion:opcion, email:email, action: 'eliminar_supervisor_ajax'},
        //             success: function(){
        //                 tabla_supervisores.row(filaS.parents('tr')).remove().draw();
        //                 tabla_supervisores.ajax.reload(null, false);
        //             }
        //         });
        //     }   
        // });//fin de eliminar


       // $("#frm_supervisores").submit(function(e){
         $(document).on("click", ".btnBorrarS", function(){    
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
                        filaS = $(this);
            
                        // nombre = $(this).closest("tr").find('td:eq(1)').text();
                        // ape = $(this).closest("tr").find('td:eq(2)').text();
                        email = $(this).closest("tr").find('td:eq(3)').text();
                        
                        // console.log('Aqui estoy 1');
                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            dataType: "json",
                            data: {email:email, action:'eliminar_supervisor_ajax'},
                            success: function(){
                                // tabla_supervisores.row(filaS.parents('tr')).remove().draw();
                                // tabla_supervisores.ajax.reload(null, false);
                            
                                // console.log('Aqui estoy 2');
                        
                                // if (data.result == 'success') {
                                //     console.log('Aqui estoy 2',data.result);
                                //         swal({                
                                //                     html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
                                //                     + '<div class="sw-texto">'+data.mensaje+'</div>',
                                //                     customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
                                //                     confirmButtonText: "Entendido",
                                //                     confirmButtonClass: 'btn-sw btn-sw-ok',
                                //                     //showConfirmButton: false,
                                //                     type: "success"
                                //                     }).then(function() {
                                //                         // Recarga la pï¿½gina que actualiza
                                //                         location.reload();
                                //                         /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                //         });//fin del then del swal por el ï¿½xito

                                // }else{

                                //         //  swal('Verificar la informaciï¿½n:', data.mensaje, 'Error');

                                //         swal({
                                //             html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
                                //                 '<div class="sw-texto"><b>Verificar la información: </b> '+data.mensaje+'Result: '+data.result+' </div>',
                                //             customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
                                //             confirmButtonText: "Entendido",
                                //             confirmButtonClass: 'btn-sw btn-sw-error',
                                //             //showConfirmButton: false,
                                //             type: "error"
                                //         });//fin del then del swal de error

                                // }//fin del else de los mensajes

                            }   //fin de success     
                        });//fin de ajax

                        
                    }//fin del if
                });//fin del then      
        });//fin de eliminar




        $("#formSupervisoresInsertar").submit(function(e){//Funcionalidad para el boton aceptar modal supervisores
            e.preventDefault();  
            var $form = $(this);//variable que guarda la instancia del
            if(! $form.valid()) return false;//si el formulario no ha sido validado no deja actuar el submit

            


                swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas el envío del registro?<br> <br><strong></div>',
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


                        documento_identidadS = $.trim($("#documento_identidadS").val());
                        nombreS = $.trim($("#nombreS").val());
                        apellidoS = $.trim($("#apellidoS").val());
                        emailS = $.trim($("#emailS").val());
                        usuarioS = $.trim($("#usuarioS").val());

                        
                        console.log(documento_identidadS);
                        console.log(nombreS);
                        console.log(apellidoS);   
                        console.log(emailS);
                        console.log(usuarioS);
                        console.log(opcion);


                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            dataType: "json",
                            data: {documento_identidadS:documento_identidadS, nombreS:nombreS, apellidoS:apellidoS, emailS:emailS, usuarioS:usuarioS, action: 'insertar_supervisor_ajax'},
                            success: function(data){  
                                // console.log(date);

                                // documento_identidadS = data.documento_identidadS;
                                // nombreS = data.nombreS;
                                // apellidoS = data.apellidoS;
                                // emailS = data.emailS;
                                // usuarioS = data.usuarioS;
                                
                                // if(opcion == 1){tabla_supervisores.row.add([ documento_identidadS, nombreS, apellidoS, emailS, usuarioS]).draw();}
                                // else{tabla_supervisores.row(filaS).data([ documento_identidadS, nombreS, apellidoS, emailS, usuarioS]).draw();}   
                                // tabla_supervisores.ajax.reload(null, false);

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
                                                        // Recarga la pï¿½gina que actualiza
                                                        location.reload();
                                                        /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                        });//fin del then del swal por el ï¿½xito

                                }else{

                                        //  swal('Verificar la informaciï¿½n:', data.mensaje, 'Error');

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

                        $("#modalCRUDs1").modal("hide");
                    }//fin del if
                });//fin del then     
            
    
    
    
    }); // fin de funcionalidad boton insertar supervisores





    /****/
    $("#formSupervisoresModificar").submit(function(e){//Funcionalidad para el boton aceptar modal supervisores
            e.preventDefault();  
            var $form = $(this);//variable que guarda la instancia del
            if(! $form.valid()) return false;//si el formulario no ha sido validado no deja actuar el submit

            


                swal({
                    html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>'
                    + '<div class="sw-texto">\u00BFConfirmas que desea modificar el registro?<br> <br><strong></div>',
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

                        nombreS = $.trim($("#nombreS2").val());
                        apellidoS = $.trim($("#apellidoS2").val());
                        emailS = $.trim($("#emailS2").val());
                        
                        documento_identidadS = $.trim($("#documento_identidadS2").val());
                        usuarioS = $.trim($("#usuarioS2").val());


                        $.ajax({
                            url: "/wp-admin/admin-ajax.php",
                            type: "POST",
                            dataType: "json",
                            data: {nombreS:nombreS, apellidoS:apellidoS, emailS:emailS, action: 'modificar_supervisor_ajax'},
                            success: function(data){  
                                console.log('Modificado');

                                // documento_identidadS = documento_identidadS;
                                // nombreS = data.nombreS;
                                // apellidoS = data.apellidoS;
                                // emailS = emailS;
                                // usuarioS = usuarioS;

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
                                                        // Recarga la pï¿½gina que actualiza
                                                        location.reload();
                                                        /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                                    
                                        });//fin del then del swal por el ï¿½xito

                                }else{

                                        //  swal('Verificar la informaciï¿½n:', data.mensaje, 'Error');

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

                        $("#modalCRUDs2").modal("hide");
                    }//fin del if
                });//fin del then     
            
    
    }); // fin de funcionalidad boton modificar supervisores

    /****/


    // $("#formSupervisoresModificar").submit(function(e){//Funcionalidad para el boton aceptar modal supervisores
    //         e.preventDefault();  
    //         // var $form = $(this);//variable que guarda la instancia del
    //         // if(! $form.valid()) return false;//si el formulario no ha sido validado no deja actuar el submit


                
            
    //         nombreS = $.trim($("#nombreS2").val());
    //         apellidoS = $.trim($("#apellidoS2").val());
    //         emailS = $.trim($("#emailS2").val());
            
    //         documento_identidadS = $.trim($("#documento_identidadS2").val());
    //         usuarioS = $.trim($("#usuarioS2").val());

            
            

    //         $.ajax({
    //             url: "/wp-admin/admin-ajax.php",
    //             type: "POST",
    //             dataType: "json",
    //             data: {nombreS:nombreS, apellidoS:apellidoS, emailS:emailS, action: 'modificar_supervisor_ajax'},
    //             success: function(data){  
                    
    //                 documento_identidadS = documento_identidadS;
    //                 nombreS = data.nombreS;
    //                 apellidoS = data.apellidoS;
    //                 emailS = emailS;
    //                 usuarioS = usuarioS;
                    
    //                 // if(opcion == 1){tabla_supervisores.row.add([ documento_identidadS, nombreS, apellidoS, emailS]).draw();}
    //                 // else{tabla_supervisores.row(filaS).data([ documento_identidadS, nombreS, apellidoS, emailS]).draw();}   
    //                 // tabla_supervisores.ajax.reload(null, false);

    //              if (data.result == 'success') {

    //                     swal({                
    //                                 html:'<div class="sw-titulo sw-titulo-ok"> <i class="icon-correcto-cuadro-simple" aria-hidden="true"></i> </div>' 
    //                                 + '<div class="sw-texto">'+data.mensaje+'</div>',
    //                                 customClass: 'sw-standar-css sw-activar-user sw-reset-pass-ok',
    //                                 confirmButtonText: "Entendido",
    //                                 confirmButtonClass: 'btn-sw btn-sw-ok',
    //                                 //showConfirmButton: false,
    //                                 type: "success"
    //                                 }).then(function() {
    //                                     // Recarga la pï¿½gina que actualiza
    //                                     location.reload();
    //                                     /* location.href = '?=site_url('login')?>'  antes del signo ? va un < */
                                    
    //                                     });//fin del then del swal por el ï¿½xito

    //                 }else{

    //                     //  swal('Verificar la informaciï¿½n:', data.mensaje, 'Error');

    //                     swal({
    //                         html: '<div class="sw-titulo sw-titulo-error"> <i class="icon-cerrar-cuadro-simple" aria-hidden="true"></i> </div>' +
    //                             '<div class="sw-texto"><b>Verificar la información: </b> '+data.mensaje+'Result: '+data.result+' </div>',
    //                         customClass: 'sw-standar-css sw-activar-user sw-reset-pass-error',
    //                         confirmButtonText: "Entendido",
    //                         confirmButtonClass: 'btn-sw btn-sw-error',
    //                         //showConfirmButton: false,
    //                         type: "error"
    //                     });//fin del then del swal de error

    //                 }//fin del else de los mensajes

    //             }   //fin de success     
    //         });//fin de ajax

    //         $("#modalCRUDs2").modal("hide");    
            
    //     }); // fin de funcionalidad para el boton aceptar modal supervisores








        //Fin de JS y Ajax para tabla_supervisores


 });//fin de jquery ready


</script>


<style type="text/css">
    .row-space{
        margin-top:20px;
    }

</style>