<?php
/*
  Template Name: Ficha Supervisor
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
    
    global $wpdb;

if(!isset($_GET['supervisor_id'])){
?>

<script>

window.history.back(-1);

</script>


<?php
     //die;
}

    $supervisor = get_user_by('id', $_GET['supervisor_id']);
    
    $id =  $_GET['supervisor_id'];
    // echo 'ID = '.$id;


?>

	
<div id="content" class="site-content container">
    <div id="primary" class="content-area col-sm-12 col-md-12">
		<div id="main" class="site-main" role="main">			
            <div class="container">
                <h3>Ficha del supervisor</h3><br> <a href="javascript:window.close()"> Volver Atrás</a>
                <hr style="width:95%; margin:0px">
                <br>
                <div class="row"><!-- fila 1 -->
                    <div class="col-md-3"><b>Nombres:</b> </div>
                    <div class="col-md-3"> <?= $supervisor->first_name?></div>
                    
                    <div class="col-md-3"><b>Apellidos:</b> </div>
                    <div class="col-md-3">  <?= $supervisor->last_name?> </div>
	            </div><!-- fin de fila 1 -->
                <div class="row"><!-- fila 2 -->
                    <div class="col-md-3"><b>Email:</b> </div>
                    <div class="col-md-3"> <?= $supervisor->user_email?></div>
                    
                    <div class="col-md-3"><b>Número de documento:</b> </div>
                    <div class="col-md-3">  <?= $supervisor->numero_documento?> </div>
                </div><!-- fin de fila 2 -->

                <br>			
            	<h3>Documentos adjuntados</h3>
	            <hr style="width:95%; margin:0px">
            	<br>

                <div class="row"><!-- fila 3 -->
                    
                    <div class="col-md-12">
                        <?php
                            $documentos_supervisor = $wpdb->get_results("select * from prop_documentos_supervisor where supervisor ='".$id."'");
                              
                        ?>

                                <table id="tabla_proponente" class="table table-striped table-bordered table-condensed" style="width:95%">
                                    <thead class="text-center">
                                        <tr>
                                            
                                            <th>Fecha</th>
                                            <th>Documento</th>
                                            <th>Concurso</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    

                                    <?php 
                                            foreach ( $documentos_supervisor as $doc_supervisor ):

                                    ?>
                                                    <tr>
                                                        <td><?=$doc_supervisor->fecha?></td>
                                                        <td><?=$doc_supervisor->enlace_documento?></td>
                                                        <td><?=$doc_supervisor->concurso?></td>
                                                    </tr>
                                            <?php 
                                            endforeach;//fin del ciclo para mostrar el ganador                      
                                        

                                        
                                            ?>
                                    </tbody>        
                                    </table>                    
                            
                                    

                    </div><!-- fin de 12 col  de mostrar los licitantes-->


                </div><!-- fin de row  de mostrar los documentos-->

            </div><!-- fin de container -->
		</div><!-- fin de main -->
    </div><!-- fin de primary -->
</div><!-- fin de content -->



<?php 

	get_footer();

?>