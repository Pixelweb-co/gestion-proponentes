<?php
/**
 * functions and definitions
 *
 * @package rootstrap
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170; /* pixels */
}

if ( ! function_exists( 'rootstrap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rootstrap_setup() {


   remove_action('wp_head', '_admin_bar_bump_cb');
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'rootstrap' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'rootstrap', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );



	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'rootstrap' ),
		'seconday' => __( 'Secondary Menu', 'rootstrap' ),
		'footer-links' => __( 'Footer Links', 'rootstrap' ) // secondary nav in footer
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'rootstrap_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // rootstrap_setup
add_action( 'after_setup_theme', 'rootstrap_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function rootstrap_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'rootstrap' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar(array(
    	'id' => 'home-widget-1',
    	'name' => __( 'Homepage Widget 1', 'rootstrap' ),
    	'description' => __( 'Displays on the Home Page', 'rootstrap' ),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgettitle">',
    	'after_title' => '</h3>',
    ));

    register_sidebar(array(
      'id' => 'home-widget-2',
      'name' =>  __( 'Homepage Widget 2', 'rootstrap' ),
      'description' => __( 'Displays on the Home Page', 'rootstrap' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));

    register_sidebar(array(
      'id' => 'home-widget-3',
      'name' =>  __( 'Homepage Widget 3', 'rootstrap' ),
      'description' =>  __( 'Displays on the Home Page', 'rootstrap' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));	
    
    register_sidebar(array(
    	'id' => 'footer-widget-1',
    	'name' =>  __( 'Footer Widget 1', 'rootstrap' ),
    	'description' =>  __( 'Used for footer widget area', 'rootstrap' ),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgettitle">',
    	'after_title' => '</h3>',
    ));

    register_sidebar(array(
      'id' => 'footer-widget-2',
      'name' =>  __( 'Footer Widget 2', 'rootstrap' ),
      'description' =>  __( 'Used for footer widget area', 'rootstrap' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));

    register_sidebar(array(
      'id' => 'footer-widget-3',
      'name' =>  __( 'Footer Widget 3', 'rootstrap' ),
      'description' =>  __( 'Used for footer widget area', 'rootstrap' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));	


    register_widget( 'rootstrap_popular_posts_widget' );
}
add_action( 'widgets_init', 'rootstrap_widgets_init' );

include(get_template_directory() . "/inc/popular-posts-widget.php");

/**
 * adding the rootstrap search form (created in extra.php)
 */

add_filter( 'get_search_form', 'rootstrap_wpsearch' );


/**
 * Enqueue scripts and styles. 
 */
function rootstrap_scripts() {

  wp_enqueue_style( 'rootstrap-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );



  wp_enqueue_style( 'rootstrap-bootstrap', get_template_directory_uri() . '/inc/css/all.min.css' );   // font-awesome

  wp_enqueue_style( 'rootstrap-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );
  wp_enqueue_style( 'rootstrap-datatables1', get_template_directory_uri().'/inc/css/datatables/datatables.min.css' );
  wp_enqueue_style( 'rootstrap-datatables2', get_template_directory_uri().'/inc/css/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css' );
  


  if( ( is_home() || is_front_page() ) && rootstrap_get_option('rootstrap_slider_checkbox') == 1 ) {
		wp_enqueue_style( 'slider-css', get_template_directory_uri().'/inc/css/slider.css' );
  }

	wp_enqueue_style( 'rootstrap-style', get_stylesheet_uri() );

	wp_enqueue_script('rootstrap-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );



	wp_enqueue_script( 'stickymenu', get_template_directory_uri() . '/inc/js/jquery.sticky.js', array('jquery') );
	wp_enqueue_script( 'rootstrap-bootstrapwp', get_template_directory_uri() . '/inc/js/functions.min.js', array('jquery') );
	wp_enqueue_script( 'layerslider', get_template_directory_uri() . '/inc/js/jquery.cslider.js', array('jquery'), true );	
	if( ( is_home() || is_front_page() ) && rootstrap_get_option('rootstrap_slider_checkbox') == 1 ) {		
		wp_enqueue_script( 'mordernizer', get_template_directory_uri() . '/inc/js/modernizr.custom.28468.js', array('jquery'), true );
	}	
	
	

	wp_enqueue_script( 'rootstrap-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20140222', true );



    wp_enqueue_style( 'css-swa', get_template_directory_uri().'/inc/css/sweetalert2.css' );


    wp_enqueue_style( 'select2', get_template_directory_uri().'/inc/css/select2.min.css' );

    wp_enqueue_script('jquery-validate', get_template_directory_uri().'/js/jquery.validate.min.js', array('jquery') );


    wp_enqueue_script('jquery-select2', get_template_directory_uri().'/js/select2.min.js', array('jquery') );


    wp_enqueue_script('jquery-swa', get_template_directory_uri().'/js/sweetalert2.min.js', array('jquery') );

    wp_enqueue_script('jquery-datatable', get_template_directory_uri().'/js/datatables/datatables.min.js', array('jquery') );
  



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rootstrap_scripts' );


/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define('rootstrap_framework_URL', get_template_directory() . '/inc/admin/');
define('rootstrap_framework_DIRECTORY', get_template_directory_uri() . '/inc/admin/');
require_once (rootstrap_framework_URL . 'rootstrap-options.php');



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */

require get_template_directory() . '/inc/navwalker.php';

 
function user_registro_proponente() 
	{
        
        global $wpdb;
        $error = '';
        $success = '';

        //Limpiar los datos, excepto los selects, num?icos y password
        $tipo_proponente= $_POST['tipo_proponente'];

            $first_name= sanitize_text_field($_POST['first_name']);
            $last_name= sanitize_text_field($_POST['last_name']);            
            $tipo_documento= $_POST['tipo_documento'];
            $numero_documento= $_POST['numero_documento'];
            $direccion_prop= sanitize_text_field($_POST['direccion_prop']);

        $celular_prop= sanitize_text_field($_POST['celular_prop']);
        $telefono_prop= sanitize_text_field($_POST['telefono_prop']);  
        $usuario = sanitize_text_field($_POST['usuario']);
        $email= sanitize_email($_POST['email']); 
        $password= $_POST['password'];

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; //patron para el correo

            if ( !is_email( $email ) ) {
            $error = 'Ingrese un correo electr?ico v?ido.';
            } elseif (!preg_match($regex, $email)) {
            $error = 'Ingrese un correo electr?ico v?ido.';      
            }elseif( empty( $usuario ) ) {
                $error = 'El campo usuario es obligatorio.';
            }elseif( empty($email)) {
                $error = 'El campo correo electr?ico es obligatorio.';
            }elseif( empty( $password ) ) {
                $error = 'El campo contrase? es obligatorio.';
            } elseif ( username_exists( $usuario ) ) {
                $error = "El Usuario ya se encuentra registrado";
            } elseif ( email_exists( $email ) ) {
                $error = "El correo electrÃ³nico ya se encuentra registrado";
            }else {//guardar

                          $user_params = array (
                            'user_login'    => apply_filters( 'pre_user_user_login', $usuario ),
                            'user_pass'     => apply_filters( 'pre_user_user_pass', $password ),
                            'first_name'    => apply_filters( 'pre_user_first_name', $first_name ),
                            'last_name'     => apply_filters( 'pre_user_last_name', $last_name ),
                            'user_email'    => apply_filters( 'pre_user_email', $email ),
                            'role'          => 'proponente'                  
                          );

                          
                          $user_id = wp_insert_user( $user_params );
                          
                              update_user_meta($user_id ,'tipo_documento',$tipo_documento);
                              update_user_meta($user_id ,'numero_documento',$numero_documento);
                              update_user_meta($user_id ,'direccion_prop',$direccion_prop);
                    
                          update_user_meta($user_id ,'tipo_proponente',$tipo_proponente);                          
                          update_user_meta($user_id ,'celular_prop',$celular_prop);
                          update_user_meta($user_id ,'telefono_prop',$telefono_prop);

                          //Para enviar correo
                          notificacion_credenciales_proponente($usuario,$password, $email);
            }//fin de la validaci? de los campos y de guardar los datos

            //Mensaje de exito o error cuando registra  
            if ($error=='') {
              die(json_encode(array('result' => 'sucess', 'mensaje' => "Gracias por registrarte, se te ha enviado un correo con los datos de acceso a tu cuenta.")));
            } else {
              die(json_encode(array('result' => 'error', 'mensaje' => $error)));
            }            
	}//fin de la funci?n proponente
    add_action('wp_ajax_user_registro_proponente_ajax', 'user_registro_proponente');
    add_action('wp_ajax_nopriv_user_registro_proponente_ajax', 'user_registro_proponente');



    function user_actualizar_proponente() 
    {
          
          global $wpdb;
          $error = '';
          $success = '';
          $user_id = get_current_user_id();
          //Limpiar los datos, excepto los selects, num?icos y password
        $tipo_proponente= $_POST['tipo_proponente'];

            $first_name= sanitize_text_field($_POST['first_name']);
            $last_name= sanitize_text_field($_POST['last_name']);            
    
        $direccion_prop= sanitize_text_field($_POST['direccion_prop']);          
        $celular_prop= sanitize_text_field($_POST['celular_prop']);
        $telefono_prop= sanitize_text_field($_POST['telefono_prop']);
        $actividad1= sanitize_text_field($_POST['actividad1']);
        $actividad2= sanitize_text_field($_POST['actividad2']);
        $actividad3= sanitize_text_field($_POST['actividad3']);
        $actividad4= sanitize_text_field($_POST['actividad4']);
          

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; //patron para el correo

        if( empty( $direccion_prop ) ) {
          $error = 'El campo dirección es obligatorio.';
        }elseif( empty( $celular_prop) ) {
          $error = 'El campo celular es obligatorio.';
        }elseif( empty( $telefono_prop ) ) {
            $error = 'El campo teléfono es obligatorio.';
        }else {//guardar

          
            $user_params = array (
              'ID' => get_current_user_id(),                      
              'first_name'    => apply_filters( 'pre_user_first_name', $first_name ),
              'last_name'     => apply_filters( 'pre_user_last_name', $last_name )
            );         

            wp_update_user( $user_params );                  

          // Archivo Hoja de vida
          $hoja_vida_name = $_POST['hoja_vida_name'];
          $hoja_vida = insert_attachment_user( 'hoja_vida', $hoja_vida_name);
          if($hoja_vida != '*'){
            update_user_meta( $user_id, 'hoja_vida', $hoja_vida);
          }

          if ($tipo_proponente=="2"){
            $camara_cio_name = $_POST['camara_cio_name'];
            $camara_cio = insert_attachment_user( 'camara_cio', $camara_cio_name);
            

          if($camara_cio != '*'){
            update_user_meta( $user_id, 'camara_cio', $camara_cio);
          }

          

          }//fin de guardar datos metauser segun el tipo de proponente
              
          update_user_meta($user_id ,'direccion_prop',$direccion_prop);
          update_user_meta($user_id ,'celular_prop',$celular_prop);
          update_user_meta($user_id ,'telefono_prop',$telefono_prop);
          update_user_meta($user_id ,'actividad1',$actividad1);
          update_user_meta($user_id ,'actividad2',$actividad2);
          update_user_meta($user_id ,'actividad3',$actividad3);
          update_user_meta($user_id ,'actividad4',$actividad4);
          

          // Carga de Archivos
          //
          
          
          $cedula_name = $_POST['cedula_name'];
          $cedula = insert_attachment_user( 'cedula', $cedula_name);

          if($cedula != '*'){
          update_user_meta( $user_id, 'cedula', $cedula);
          
        }
          //
          $tarjeta_profesional_name = $_POST['tarjeta_profesional_name'];
          $tarjeta_profesional = insert_attachment_user( 'tarjeta_profesional', $tarjeta_profesional_name);
          
          if($tarjeta_profesional != '*'){
          
          update_user_meta( $user_id, 'tarjeta_profesional', $tarjeta_profesional);
          }

          //
          $registro_unico_trubitario_name = $_POST['registro_unico_trubitario_name'];
          $registro_unico_trubitario = insert_attachment_user( 'registro_unico_trubitario',$registro_unico_trubitario_name );
          
          if($registro_unico_trubitario != '*'){
          update_user_meta( $user_id, 'registro_unico_trubitario', $registro_unico_trubitario);
          }  
          //

          $registro_unico_de_proponentes_name = $_POST['registro_unico_de_proponentes_name'];
          $registro_unico_de_proponentes = insert_attachment_user( 'registro_unico_de_proponentes', $registro_unico_de_proponentes_name);
          
          if($registro_unico_de_proponentes != '*'){
          update_user_meta( $user_id, 'registro_unico_de_proponentes', $registro_unico_de_proponentes);
          }
          //

          $antecedentes_name = $_POST['antecedentes_name'];
          $antecedentes = insert_attachment_user( 'antecedentes', $antecedentes_name);
          
          if($antecedentes != '*'){
          update_user_meta( $user_id, 'antecedentes', $antecedentes);
          }
          // 

          $doc_habilidad_name = $_POST['doc_habilidad_name'];        
          $doc_habilidad = insert_attachment_user( 'doc_habilidad', $doc_habilidad_name);
          
          if($doc_habilidad != '*'){
          update_user_meta( $user_id, 'doc_habilidad', $doc_habilidad);
          }
          //

          $acta_confidencialidad_name = $_POST['acta_confidencialidad_name'];
          $acta_confidencialidad = insert_attachment_user( 'acta_confidencialidad', $acta_confidencialidad_name);
          
          if($acta_confidencialidad != '*'){
          update_user_meta( $user_id, 'acta_confidencialidad', $acta_confidencialidad);
          }

        }//fin de la validaci�n y actualizaci�n de los campos
              
        //Mensaje de exito o error cuando registra  
          if ($error=='') {
            die(json_encode(array(
              'result' => 'sucess', 
              'mensaje' => "Sus datos fueron actualizados con éxito",
              'actividad1' => $actividad1,
              'actividad2' => $actividad2,
              'actividad3' => $actividad3,
              'actividad4' => $actividad4
            )));
          } else {
            die(json_encode(array('result' => 'error', 'mensaje' => $error)));
          }
   
    }//fin de la función actualizar proponente
      add_action('wp_ajax_user_actualizar_proponente_ajax', 'user_actualizar_proponente');
      add_action('wp_ajax_nopriv_user_actualizar_proponente_ajax', 'user_actualizar_proponente');
  
  
  //Fin de actualizar

    //********************************************************************* */
    function user_actualizar_supervisor() 
    {
          
          global $wpdb;
          $error = '';
          $success = '';

          //Limpiar los datos, excepto los selects, num?icos y password
        

          $first_name= sanitize_text_field($_POST['first_name']);
          $last_name= sanitize_text_field($_POST['last_name']);            
    
        

          if( empty( $first_name ) ) {
            $error = 'El campo dirección es obligatorio.';
          }elseif( empty( $last_name) ) {
            $error = 'El campo celular es obligatorio.';
          }else {//guardar

          
            $user_params = array (
              'ID' => get_current_user_id(),                      
              'first_name'    => apply_filters( 'pre_user_first_name', $first_name ),
              'last_name'     => apply_filters( 'pre_user_last_name', $last_name )
            );         

            wp_update_user( $user_params );                  

        }//fin de la validaci�n y actualizaci�n de los campos
              
        //Mensaje de exito o error cuando registra  
          if ($error=='') {
            die(json_encode(array('result' => 'sucess', 'mensaje' => "Sus datos fueron actualizados con éxito")));
          } else {
            die(json_encode(array('result' => 'error', 'mensaje' => $error)));
          }
   
    }//fin de la función actualizar proponente
      add_action('wp_ajax_user_actualizar_supervisor_ajax', 'user_actualizar_supervisor');
      add_action('wp_ajax_nopriv_user_actualizar_supervisor_ajax', 'user_actualizar_supervisor');
  
  
  //Fin de actualizar panel supervisor

    //********************************************************************* */






//Isertar supervisor admin



function insertar_supervisor_admin() 
{
      
      global $wpdb;
      $error = '';
      $success = '';

      //Limpiar los datos, excepto los selects, num?icos y password
      // $id = sanitize_text_field($_POST['id']);, en el insert se genera y, en el actualizar y eliminar se busca
      $documento_identidadS = sanitize_text_field($_POST['documento_identidadS']);
      $nombreS = sanitize_text_field($_POST['nombreS']);
      $apellidoS = sanitize_text_field($_POST['apellidoS']);
      $cargoS = sanitize_text_field($_POST['cargoS']);
      $emailS = sanitize_text_field($_POST['emailS']);
      $usuarioS = sanitize_text_field($_POST['usuarioS']);
      
      //ValidaciÃƒÂ³n de los campos
      $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; //patron para el correo


       
        if( empty( $documento_identidadS ) ) {
          $error = 'El campo documento de identidad es obligatorio.';
        }elseif( empty( $nombreS ) ) {
          $error = 'El campo nombre es obligatorio.';
        }elseif( empty( $apellidoS ) ) {
          $error = 'El campo apellido es obligatorio.';
        }elseif( empty( $cargoS ) ) {
          $error = 'El campo cargo es obligatorio.';
        }else  if ( !is_email( $emailS ) ) {
          $error = 'Ingrese un correo electrónico válido.';
        } elseif (!preg_match($regex, $emailS)) {
             $error = 'Ingrese un correo electrónico válido.';      
        }elseif( empty($emailS)) {
            $error = 'El campo correo electrónico es obligatorio.';
        }elseif ( email_exists( $emailS ) ) {
            $error = "El correo electrónico ya se encuentra registrado";
        }elseif( empty( $usuarioS ) ) {
          $error = 'El campo usuario es obligatorio.';
        } elseif ( username_exists( $usuarioS ) ) {
          $error = "El Usuario ya se encuentra registrado";
        }
        
        if ($error=='') {
        
                  
                      
                      $password = wp_generate_password( 8, false );
                      

                      $user_params = array (//insertar los datos de la tabla users
                        'user_login'    => apply_filters( 'pre_user_user_login', $usuarioS ),
                        'user_pass'     => apply_filters( 'pre_user_user_pass', $password ),
                        'first_name'    => apply_filters( 'pre_user_first_name', $nombreS ),
                        'last_name'     => apply_filters( 'pre_user_last_name', $apellidoS ),
                        'user_email'    => apply_filters( 'pre_user_email', $emailS ),
                        'role'          => 'supervisor'                  
                      );
                      
                      $user_id = wp_insert_user( $user_params );//ejecutar la inserciÃƒÂ³n de los datos de la tabla users y devuleve el id asignado
                      //echo 'OPC 1.';
                      
                      
                      //insertar los datos de la tabla metausers
                      update_user_meta($user_id ,'numero_documento',$documento_identidadS);//ejecutar la inserciÃƒÂ³n  de los datos de la tabla metausers
                      update_user_meta($user_id ,'cargoS',$cargoS);//ejecutar la inserciÃƒÂ³n  de los datos de la tabla metausers
                      //echo ('aqui'.$user_id);
                      
                                          
                            //     //Para enviar correo
                      notificacion_credenciales_proponente($usuarioS,$password, $emailS);

                      die(json_encode(array(
                        'result' => 'success', 
                        'mensaje' => "Supervisor registrado con éxito",
                        'documento_identidadS' => $documento_identidadS,
                        'nombreS' => $nombreS,
                        'apellidoS' => $apellidoS,
                        'emailS' => $emailS,
                        'usuarioS' => $usuarioS
                      )));//fin del envio de datos al successs



                    // print_r($user_id);
                    //die();

                            
                    
                  
     
        }else{//if (error='')
          die(json_encode(array('result' => 'error', 'mensaje' => $error)));
        }
    

}//fin de insertar supervisor

  add_action('wp_ajax_insertar_supervisor_ajax', 'insertar_supervisor_admin');
  add_action('wp_ajax_nopriv_insertar_supervisor_ajax', 'insertar_supervisor_admin');






    //********************************************************************* */


    //modificar_supervisor_ajax



    function modificar_supervisor_admin() 
    {
          
          global $wpdb;
          $error = '';
          $success = '';
  
          //Limpiar los datos, excepto los selects, num?icos y password
          // $id = sanitize_text_field($_POST['id']);, en el insert se genera y, en el actualizar y eliminar se busca
          
          $nombreS = sanitize_text_field($_POST['nombreS']);
          $apellidoS = sanitize_text_field($_POST['apellidoS']);
          $cargoS = sanitize_text_field($_POST['cargoS']);
          $emailS = $_POST['emailS'];
          
      
            if( empty( $nombreS ) ) {
              $error = 'El campo nombre es obligatorio.';
            }elseif( empty( $apellidoS ) ) {
              $error = 'El campo apellido es obligatorio.';
            }elseif( empty( $cargoS ) ) {
              $error = 'El campo cargo es obligatorio.';
            }

            
            if ($error=='') {
            
                            $usu = get_user_by( 'email',$emailS );
                            $user_id = $usu->ID;
                      
                            
                            
                            $user_params = array (//insertar los datos de la tabla users
                              'ID' => $user_id,
                              'first_name'    => apply_filters( 'pre_user_first_name', $nombreS ),
                              'last_name'     => apply_filters( 'pre_user_last_name', $apellidoS )
                              //'user_email'    => apply_filters( 'pre_user_email', $emailS ),
                              
                            );
                           
                            wp_update_user( $user_params );
                            //echo 'OPC 2. -->'.$user_id;
                            // die();
                            update_user_meta($user_id ,'cargoS',$cargoS);//ejecutar la inserciÃƒÂ³n  de los datos de la tabla metausers
                            
                            die(json_encode(array(
                                'result' => 'success', 
                                'mensaje' => "Supervisor modificado con éxito",
                                'nombreS' => $nombreS,
                                'apellidoS' => $apellidoS
                              )));//fin del envio de datos al successs
         
            }else{//if (error='')
              die(json_encode(array('result' => 'error', 'mensaje' => $error)));
            }
        
  
    }//fin de modificar supervisor
    
      add_action('wp_ajax_modificar_supervisor_ajax', 'modificar_supervisor_admin');
      add_action('wp_ajax_nopriv_modificar_supervisor_ajax', 'modificar_supervisor_admin');



//********************************************************************* */

//Función para que el administrador pueda eliminar el supervisor

function eliminar_supervisor_admin() 
    {
          
      global $wpdb;
      $error = '';
      $success = '';
      // $user_id = get_current_user_id();
      

      $email = $_POST['email'];
      $usu = get_user_by( 'email',$email );
      // echo ('eliminar');
      // die();
      
      if($usu->ID){
        wp_delete_user( $usu->ID );//eliminar
      }//fin de el usuario si existe
      
    //Mensaje de exito o error cuando registra  
      if ($error=='') {
        die(json_encode(array('result' => 'sucess', 'mensaje' => "Supervisor eliminado con éxito")));
      } else {
        die(json_encode(array('result' => 'error', 'mensaje' => $error)));
      }

}//fin de la función eliminar proponente
      add_action('wp_ajax_eliminar_supervisor_ajax', 'eliminar_supervisor_admin');
      add_action('wp_ajax_nopriv_eliminar_supervisor_ajax', 'eliminar_supervisor_admin');
  
  
  //Fin de eliminar proponente admin





//Función para que el administrador pueda eliminar el proponente

function eliminar_proponente_admin() 
    {
          
      global $wpdb;
      $error = '';
      $success = '';
      // $user_id = get_current_user_id();
      

      $opcion = $_POST['opcion'];
      $email = $_POST['email'];
      $usu = get_user_by( 'email',$email );
    
      
      // update_user_meta($usu->ID ,'direccion_prop','Palafito');        

      if($usu->ID){
            wp_delete_user( $usu->ID );//eliminar
      }//fin de el usuario si existe
          
    //Mensaje de exito o error cuando registra  
      if ($error=='') {
        die(json_encode(array('result' => 'sucess', 'mensaje' => "Proponente eliminado con éxito")));
      } else {
        die(json_encode(array('result' => 'error', 'mensaje' => $error)));
      }

    }//fin de la función eliminar proponente
      add_action('wp_ajax_eliminar_proponente_ajax', 'eliminar_proponente_admin');
      add_action('wp_ajax_nopriv_eliminar_proponente_ajax', 'eliminar_proponente_admin');
  
  
  //Fin de eliminar proponente admin


///


//Función para que el administrador pueda ingresar el proponente autorizado

function incluir_proponente_autorizado_admin(){
  global $wpdb;
    
          $id_prop = $_POST['id_prop_autorizado'];
          $id_concurso = $_POST['id_concurso'];
    
          $table = $wpdb->prefix.'autorizado';
          
          $data = [ 'concurso' => $id_concurso, 'proponente' => $id_prop  ];
          $format = array('%s','%s');
          $result = $wpdb->insert($table,$data,$format);
                      
        //Mensaje de exito o error cuando registra  
          if ($error=='') {
            die(json_encode(array(
              'result' => 'success', 
              'mensaje' => "Proponente agregado con éxito",
              'proponente' => $id_prop,
              'id_concurso' => $id_concurso,
              'table'=>$table
            )));
  }else{
  
  die(json_encode(array(
            'result' => 'error', 
            'mensaje' => "Error al cargar documento, intente de nuevo"
          )));
  
  
  
  }
  
  
  
  
  }
  
  
   add_action('wp_ajax_incluir_proponente_autorizado_ajax', 'incluir_proponente_autorizado_admin');
   add_action('wp_ajax_nopriv_incluir_proponente_autorizado_ajax', 'incluir_proponente_autorizado_admin');





//Función para que el administrador pueda eliminar el proponente autorizado

function eliminar_proponente_autorizado_admin() 
    {
          
      global $wpdb;
      $error = '';
      $success = '';
      // $user_id = get_current_user_id();
      

      
      $id_prop = $_POST['id_prop_autorizado'];
      $id_concurso = $_POST['id_concurso'];

      $table = $wpdb->prefix.'autorizado';
      $where = [ 'concurso' => $id_concurso, 'proponente' => $id_prop  ];
      $result = $wpdb->delete($table,$where);

      
          
    //Mensaje de exito o error cuando registra  
      if ($error=='') {
        die(json_encode(array(
          'result' => 'sucess', 
          'mensaje' => "Proponente eliminado con éxito",
          'proponente' => $id_prop,
          'id_concurso' => $id_concurso,
          'table'=>$table
        )));
      } else {
        die(json_encode(array('result' => 'error', 'mensaje' => $error)));
      }

    }//fin de la función eliminar proponente
      add_action('wp_ajax_eliminar_proponente_autorizado_ajax', 'eliminar_proponente_autorizado_admin');
      add_action('wp_ajax_nopriv_eliminar_proponente_autorizado_ajax', 'eliminar_proponente_autorizado_admin');
  
  
  //Fin de eliminar proponente admin


/********************************************************/
    //********************************************************************* */

//Función para que autorizar_todos_los_proponentes_admin

function autorizar_todos_los_proponentes_admin() 
    {
          
      global $wpdb;
      $error = '';
      $success = '';
      // $user_id = get_current_user_id();
      

      
      
      $id_concurso = $_POST['id_concurso'];
      $id_prop = -1;
      $table = $wpdb->prefix.'autorizado';

      //eliminamos todos los proponentes agregados individualmente
      
      // $where = [ 'concurso' => $id_concurso];
      // $result = $wpdb->delete($table,$where);

      //autorizamos a todos los proponentes
      $data = [ 'concurso' => $id_concurso, 'proponente' => $id_prop  ];
      $format = array('%s','%s');
      $result1 = $wpdb->insert($table,$data,$format);

      
          
    //Mensaje de exito o error cuando registra  
      if ($error=='') {
        die(json_encode(array(
          'result' => 'sucess', 
          'mensaje' => "Proponentes autorizado con éxito",
          'proponente' => $id_prop,
          'id_concurso' => $id_concurso,
          'table'=>$table
        )));
      } else {
        die(json_encode(array('result' => 'error', 'mensaje' => $error)));
      }

    }//fin de la función eliminar proponente
      add_action('wp_ajax_autorizar_todos_los_proponentes_ajax', 'autorizar_todos_los_proponentes_admin');
      add_action('wp_ajax_nopriv_autorizar_todos_los_proponentes_ajax', 'autorizar_todos_los_proponentes_admin');
  
  
  //Fin de autorizar_todos_los_proponentes_ajax



  //Función para que autorizar_todos_los_proponentes_admin

function desautorizar_todos_los_proponentes_admin() 
{
      
  global $wpdb;
  $error = '';
  $success = '';
  // $user_id = get_current_user_id();
  //echo 'Concurso: ';
  // echo 'Concurso: '.$id_concurso;
  //die();
  
  $id_concurso = $_POST['id_concurso'];
  $id_prop = -1;
  

  


  //eliminamos todos los proponentes agregados individualmente
  $table = $wpdb->prefix.'autorizado';
  $where = [ 'concurso' => $id_concurso, 'proponente'=>$id_prop];
  $result = $wpdb->delete($table,$where);

      
//Mensaje de exito o error cuando registra  
  if ($error=='') {
    die(json_encode(array(
      'result' => 'sucess', 
      'mensaje' => "Proponente eliminado con éxito",
      'proponente' => $id_prop,
      'id_concurso' => $id_concurso,
      'table'=>$table
    )));
  } else {
    die(json_encode(array('result' => 'error', 'mensaje' => $error)));
  }

}//fin de la función eliminar proponente
  add_action('wp_ajax_desautorizar_todos_los_proponentes_ajax', 'desautorizar_todos_los_proponentes_admin');
  add_action('wp_ajax_nopriv_desautorizar_todos_los_proponentes_ajax', 'desautorizar_todos_los_proponentes_admin');


//Fin de desautorizar_todos_los_proponentes_ajax







/********************************************************/
    //********************************************************************* */







//Isertar supervisor admin

function insertar_concursos_admin() 
{
      
      global $wpdb;
      $error = '';
      $success = '';

      //Limpiar los datos, excepto los selects, num?icos y password
      // $id = sanitize_text_field($_POST['id']);, en el insert se genera y, en el actualizar y eliminar se busca


      $titulo = sanitize_text_field($_POST['titulo']);
      $descripcion = sanitize_text_field($_POST['descripcion']);
      $documento = sanitize_text_field($_POST['documento']);
      $supervisor =sanitize_text_field($_POST['supervisor']);

      
      //ValidaciÃƒÂ³n de los campos
      $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; //patron para el correo

      
       


        if( empty( $titulo ) ) {
          $error = 'El campo titulo de identidad es obligatorio.';
        }elseif( empty( $descripcion ) ) {
          $error = 'El campo descripci&oacute;n es obligatorio.';
        }elseif( empty( $supervisor ) ) {
          $error = 'El campo supervisor es obligatorio.';
        }
                
        if ($error=='') {
        
                      $args = array (//insertar los datos de la tabla users
                        'post_title'    =>  $titulo,
                        'post_content'  =>  $descripcion,
                        'post_status'     => 'publish',
                        'post_type'     => 'concurso'                  
                      );
                      
                      $post_id = wp_insert_post( $args );//ejecutar la inserción de los datos de la tabla post y  devuelve el id asignado
                      //echo 'OPC 1.';
                      
                      
                      //insertar los datos de la tabla metausers
                      //add_post_meta($post_id ,'documento',$documento);//ejecutar la inserción  de los datos de la tabla user_post
                      add_post_meta($post_id ,'supervisor',$supervisor);//ejecutar la inserción  de los datos de la tabla user_post
                      //echo ('aqui'.$user_id);
                      $documento_name = $_POST['documento_name'];
                      if($documento_name!=''){
                        $documento = insert_attachment_concurso( 'documento', $documento_name);
                        // $documento = insert_attachment_concurso( 'documento', 'Documento concurso');
                   
                        if($documento != '*'){
                          update_post_meta($post_id ,'documento',$documento);//ejecutar la inserci?  de los archivos de la tabla meta_post
                        }                
                      }//fin del if
                            //     //Para enviar correo
                      //notificacion_credenciales_proponente($usuarioS,$password, $emailS);

                      die(json_encode(array(
                        'result' => 'success', 
                        'mensaje' => "Concurso registrado con éxito",
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'documento' => $documento,
                        'supervisor' => $supervisor
                      )));//fin del envio de datos al successs



                    // print_r($user_id);
                    //die();

                            
                    
                  
     
        }else{//if (error='')
          die(json_encode(array('result' => 'error', 'mensaje' => $error)));
        }
    

}//fin de insertar concursos

  add_action('wp_ajax_insertar_concursos_ajax', 'insertar_concursos_admin');
  add_action('wp_ajax_nopriv_insertar_concursos_ajax', 'insertar_concursos_admin');


  /***************************************************************************************/


  function insertar_concursos_adminP() 
{
      
  global $wpdb;
  $error = '';
  $success = '';

  //Limpiar los datos, excepto los selects, num?icos y password
  // $id = sanitize_text_field($_POST['id']);, en el insert se genera y, en el actualizar y eliminar se busca


  $titulo = sanitize_text_field($_POST['titulo']);
  $descripcion = sanitize_text_field($_POST['descripcion']);
  $supervisor =sanitize_text_field($_POST['supervisor']);
  
  

    if( empty( $titulo ) ) {
      $error = 'El campo titulo  es obligatorio.';
    }elseif( empty( $descripcion ) ) {
      $error = 'El campo descripci&oacute;n es obligatorio.';
    }elseif( empty( $supervisor ) ) {
      $error = 'El campo supervisor es obligatorio.';
    }
            
    if ($error=='') {
    
                  $args = array (//insertar los datos de la tabla users
                    'post_title'    =>  $titulo,
                    'post_content'  =>  $descripcion,
                    'post_status'     => 'publish',
                    'post_type'     => 'concurso'                  
                  );
                  
                  $post_id = wp_insert_post( $args );//ejecutar la inserci? de los datos de la tabla post y  devuelve el id asignado
                  
                  

                  add_post_meta($post_id ,'supervisor',$supervisor);//ejecutar la inserci?  de los datos de la tabla meta_post
                  

                  //insertar los datos de la tabla post_meta
                  $documento = insert_attachment_concurso( 'documento', 'Documento concurso');
                 
                  if($documento != '*'){
                    add_post_meta($post_id ,'documento',$documento);//ejecutar la inserci?  de los archivos de la tabla meta_post
                  }

                  
                  
                                      
                        //     //Para enviar correo
                  //notificacion_credenciales_proponente($usuarioS,$password, $emailS);

                  die(json_encode(array(
                    'result' => 'success', 
                    'mensaje' => "Concurso registrado con ?ito",
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'documento' => $documento,
                    'supervisor' => $supervisor
                  )));//fin del envio de datos al successs

                  


                // print_r($user_id);
                //die();         
 
    }else{//if (error='')
      die(json_encode(array('result' => 'error', 'mensaje' => $error)));
    }

}//fin de insertar concursos

  add_action('wp_ajax_insertar_concursos_ajaxP', 'insertar_concursos_adminP');
  add_action('wp_ajax_nopriv_insertar_concursos_ajaxP', 'insertar_concursos_adminP');



  /***************************************************************************************/


  function modificar_concursos_admin() 
{
      
      global $wpdb;
      $error = '';
      $success = '';

      //Limpiar los datos, excepto los selects, num?icos y password
      // $id = sanitize_text_field($_POST['id']);, en el insert se genera y, en el actualizar y eliminar se busca

      $id_post =$_POST['id_post'];
      $titulo = sanitize_text_field($_POST['titulo']);
      $descripcion = sanitize_text_field($_POST['descripcion']);
      //$documento = sanitize_text_field($_POST['documento']);
      $supervisor =sanitize_text_field($_POST['supervisor']);
      

        if( empty( $descripcion ) ) {
          $error = 'El campo descripci&oacute;n es obligatorio.';
        }elseif( empty( $supervisor ) ) {
          $error = 'El campo supervisor es obligatorio.';
        }

      //   echo 'Doc: '.$documento;
      // echo 'Sup: '.$supervisor;
      // die();
        
        if ($error=='') {
          // $post_all = get_page_by_title($titulo,'', 'concurso');
          // $post_id = $post_all->ID;
                      // Modificar los datos de post
                      $args = array (//insertar los datos de la tabla users
                        'ID' => $id_post,
                        'post_title' =>$titulo,
                        'post_content'  =>  $descripcion                
                      );
                      wp_update_post( $args); 
                      
                      
                      
                      //Modificar los datos de la tabla post_meta

                      //update_post_meta($id_post ,'documento',$documento);//ejecutar la inserción  de los datos de la tabla user_post
                        update_post_meta($id_post ,'supervisor',$supervisor);//ejecutar la inserción  de los datos de la tabla user_post
                      //insertar los datos de la tabla post_meta

                      

                      $documento_name = $_POST['documento_name'];
                      if($documento_name!=''){
                        $documento = insert_attachment_concurso( 'documento', $documento_name);
                        // $documento = insert_attachment_concurso( 'documento', 'Documento concurso');
                   
                        if($documento != '*'){
                          update_post_meta($post_id ,'documento',$documento);//ejecutar la inserci?  de los archivos de la tabla meta_post
                        }                
                      }//fin del if


                      //echo ('aqui'.$user_id);
                      
                                          
                            //     //Para enviar correo
                      //notificacion_credenciales_proponente($usuarioS,$password, $emailS);

                      die(json_encode(array(
                        'result' => 'success', 
                        'mensaje' => "Concurso modificado con éxito",
                        'titulo' => $titulo,
                        'id_post' => $id_post,
                        'descripcion' => $descripcion,
                        'documento' => $documento,
                        'supervisor' => $supervisor,
                        'documento_name' => $documento_name 
                      )));//fin del envio de datos al successs



                    // print_r($user_id);
                    //die();

                            
                    
                  
     
        }else{//if (error='')
          die(json_encode(array('result' => 'error', 'mensaje' => $error)));
        }
    

}//fin de insertar concursos

  add_action('wp_ajax_modificar_concursos_ajax', 'modificar_concursos_admin');
  add_action('wp_ajax_nopriv_modificar_concursos_ajax', 'modificar_concursos_admin');


  /***************************************************************************************/

  function documento_concurso(){



        global $wpdb;
        

        $doc_contrato_name = $_POST['doc_contrato_name'];
        if($doc_contrato_name != ''){

          $id_doc = insert_attachment_user( 'doc_contrato', $doc_contrato_name);
          if($id_doc != '*'){
                    
              $table = $wpdb->prefix.'postulaciones';
              $data = ['doc_contrato' => $id_doc];
              $where = [ 'concurso' => $_POST['concurso'], 'proponente' => $_POST['proponente']  ];
              $result = $wpdb->update($table,$data,$where);
              
                        
              die(json_encode(array(
                        'result' => 'sucess', 
                        'mensaje' => "Documento agregado con éxito",
                        'documento' => $id_doc,
                        'proponente' => $_POST['proponente'],
                        'concurso' => $_POST['concurso'],
                        'nombreArch' => $doc_contrato_name
                      )));
          }else{
          
              die(json_encode(array(
                        'result' => 'error', 
                        'mensaje' => "Error al cargar documento, intente de nuevo"
                        
  
                      ))); 
          }
        }//fin de si viene vacio el nombre
        else{
          die(json_encode(array(
            'result' => 'error', 
            'mensaje' => "Error. Debe anexar un documento")));
        }
   }//fin del functions documento concurso
    
    
     add_action('wp_ajax_documento_concurso_ajax', 'documento_concurso');
     add_action('wp_ajax_nopriv_documento_concurso_ajax', 'documento_concurso');
    


//********************************************************************* */







//Función para que el administrador pueda eliminar el supervisor

function eliminar_concursos_admin() 
    {
          
      global $wpdb;
      $error = '';
      $success = '';
      
      $id_post = $_POST['id_post'];

      wp_delete_post( $id_post );//eliminar el concurso de los post

      //eliminar el concurso de los autorizados
      $tableA = $wpdb->prefix.'autorizado';
      $whereA = [ 'concurso' => $id_post];
      $resultA = $wpdb->delete($tableA,$whereA);


      //eliminar el concurso de las portulaciones
      $tableP = $wpdb->prefix.'postulaciones';
      $whereP = [ 'concurso' => $id_post];
      $resultP = $wpdb->delete($tableP,$whereP);




      if($error==''){

        die(json_encode(array(
          'result' => 'success', 
          'mensaje' => "Concurso eliminado con éxito",
          'table_A' => $tableA,
          'table_P' => $tableP,
          'Id_concurso' => $id_post

        )));//fin del envio de datos al successs
          
      } else {
        die(json_encode(array('result' => 'error', 'mensaje' => $error)));
      }

    }//fin de la función eliminar proponente
      add_action('wp_ajax_eliminar_concursos_ajax', 'eliminar_concursos_admin');
      add_action('wp_ajax_nopriv_eliminar_concursos_ajax', 'eliminar_concursos_admin');
  
  
  //Fin de eliminar proponente admin


  function documento_supervisor(){
    global $wpdb;
    
    
    $documento_name = $_POST['documento_name'];
    $id_doc = insert_attachment_user( 'documento', $documento_name);
    
    
    if($id_doc != '*'){
              
    $table = $wpdb->prefix.'documentos_supervisor';
    $data = array('fecha' => date('Y-m-d'), 'concurso' => sanitize_text_field($_POST['concurso']), 'supervisor' => get_current_user_id(),'enlace_documento' => $id_doc);
    $format = array('%s','%s','%s','%s');
    $result = $wpdb->insert($table,$data,$format);
    
              
    die(json_encode(array(
              'result' => 'success', 
              'mensaje' => "Documento agregado con éxito",
              'doc_id' => $documento, 
              'doc_name' =>$documento_name 
            )));
    
    
    
    }else{
    
    die(json_encode(array(
              'result' => 'error', 
              'mensaje' => "Error al cargar documento, intente de nuevo"
            )));
    
    
    
    }
    
    
    
    
    }
    
    
     add_action('wp_ajax_documento_supervisor_ajax', 'documento_supervisor');
     add_action('wp_ajax_nopriv_documento_supervisor_ajax', 'documento_supervisor');
      

function eliminar_doc_sup(){
global $wpdb;


$wpdb->query("delete from prop_documentos_supervisor where id = '".$_POST['id_doc']."'");

          
die(json_encode(array(
          'result' => 'success', 
          'mensaje' => "Documento eliminado con éxito"
        )));

}



 add_action('wp_ajax_eliminar_doc_sup_ajax', 'eliminar_doc_sup');
 add_action('wp_ajax_nopriv_eliminar_doc_sup_ajax', 'eliminar_doc_sup');
  

///////
 function postular_proponente(){
  global $wpdb;
  
  
  $table = $wpdb->prefix.'postulaciones';
  $data = array('fecha' => date('Y-m-d'), 'concurso' => $_POST['concurso'], 'proponente' => get_current_user_id());
  $format = array('%s','%s','%s','%s');
  $result = $wpdb->insert($table,$data,$format);
  
  mail_notificacion_postulacion($_POST['titulo'],$_POST['nombre'],$_POST['apellido'],$_POST['email'], date('Y-m-d'));
  
    
  die(json_encode(array(
            'result' => 'success', 
            'mensaje' => "Se ha postulado correctamente a este concurso"
          )));
  
  
  }
  
  
   add_action('wp_ajax_postular_prop_ajax', 'postular_proponente');
   add_action('wp_ajax_nopriv_postular_prop_ajax', 'postular_proponente');

   
   


  ///////
  function declarar_ganador(){

    global $wpdb;
    
    $table = $wpdb->prefix.'postulaciones';
    $data = [ 'ganador' => '1']; // NULL value.
    $where = [ 'concurso' => $_POST['concurso'], 'proponente' => $_POST['proponente']  ];
    // echo  'concurso '.$_POST['concurso'].'proponente:'.$_POST['proponente'];
    // die();
    
    $result = $wpdb->update($table,$data,$where);

    notificacion_ganador_concuso($_POST['titulo'],$_POST['nombre'],$_POST['apellido'],$_POST['email']);
      
    die(json_encode(array(
              'result' => 'success', 
              'mensaje' => "Ha declarado el ganador de este concurso correctamente. "
            )));
    
    
    }
    
    
     add_action('wp_ajax_declarar_ganador_ajax', 'declarar_ganador');
     add_action('wp_ajax_nopriv_declarar_ganador_ajax', 'declarar_ganador');
    

  ///////


function mail_notificacion_postulacion($titulo, $nombre, $apellido, $email, $fecha){
  $asunto = "Postulaci�n al concurso exitosa";
                    
  $mensaje = '<table width="100%" bgcolor="#f6f8f1"  cellpadding="0" cellspacing="0" ">
  <tbody>
  <tr>
    <td>
      <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
      <![endif]-->     
      <table style="width: 100%; max-width: 640px;" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <tr>
              <td class="innerpadding borderbottom" style="padding: 15px 30px 30px 30px; background-color: #dff0d8;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <td align="center" class="h2" style="color: #000000;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;">
                      
                    </td>
                  </tr>
                </tbody></table>
              </td>
          </tr>
          <tr>
              <td align="center" class="h2" style="color: #128041;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;  background-color:#dff0d8;">
                <h2>Sistema de proponente</h2><br>
                <h3>Concurso postulado:'. $titulo .'<h3>
              </td>
          </tr>
          <tr>
              <td align="center" class="h2" style="color: #128041;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;  background-color:#ffffff;">
                  <br><h4>Saludos. '.$nombre.' '.$apellido.' </h4><br>
              </td>
          </tr>


            
          <tr>
          <td align="center" bgcolor="#ffffff" class="innerpadding bodycopy" style="font-size: 17px;font-family: Open Sans, sans-serif;line-height: 22px;padding: 10px 30px;">
            <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">  
              <tbody>
                  <tr>
                      <td width="30%"></td>
                      <td align="left">
                        <p ><strong>Te haz postulado correctamente al concurso:</strong><br>'. $titulo .'.</p>
                        <p ><strong>Fecha de postulación:</strong><br>'.$fecha.'</p>
                      </td>
                     
                      <td width="20%"></td>
                    </tr>
                

         
         
         </tbody>
         <table></table>
          </td>
        </tr>
        <tr>
          <td align="center" bgcolor="#f5f5f5">
              <br>
              <div style="text-align:center;background-color: #47a477; color: #ffffff; display: inline-block; padding: 10px 20px; margin-top: 5px; margin-bottom: 20px; font-family: Open Sans, sans-serif;font-size: 20px; border-radius: 30px;">
                  <a style="color: #fff; text-decoration: none;" href="' . site_url('login') . '">
                  Ingresar al panel de proponentes
                  </a>
              </div>
         </td>
        </tr>
      </tbody>
      </table>
      <!--[if (gte mso 9)|(IE)]>
            </td>
          </tr>
      </table>
      <![endif]-->
      </td>
    </tr>
  </tbody>
</table>
';
  //wp_mail( $email_admon, 'Activacion de usuario', 'Felicitaciones este es el enlace de activación: ' .  );
  function tipo_de_contenido_html() {
    return 'text/html';
  }
  add_filter( 'wp_mail_content_type', 'tipo_de_contenido_html' );
  
  wp_mail($email, $asunto, $mensaje);

}

///////

function notificacion_ganador_concuso($titulo, $nombre, $apellido, $email){

  $asunto = "Ganador de Concurso";
                    
  $mensaje = '<table width="100%" bgcolor="#f6f8f1"  cellpadding="0" cellspacing="0" ">
  <tbody>
  <tr>
    <td>
      <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
      <![endif]-->     
      <table style="width: 100%; max-width: 640px;" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <tr>
              <td class="innerpadding borderbottom" style="padding: 15px 30px 30px 30px; background-color: #dff0d8;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <td align="center" class="h2" style="color: #000000;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;">
                      
                    </td>
                  </tr>
                </tbody></table>
              </td>
          </tr>
          <tr>
              <td align="center" class="h2" style="color: #128041;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;  background-color:#dff0d8;">
                <h2>Sistema de proponente</h2><br>
                <h3>Concurso postulado:'. $titulo .'<h3>
              </td>
          </tr>
          <tr>
              <td align="center" class="h2" style="color: #128041;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;  background-color:#ffffff;">
                  <br><h4>Saludos. '.$nombre.' '.$apellido.' </h4><br>
              </td>
          </tr>


            
          <tr>
          <td align="center" bgcolor="#ffffff" class="innerpadding bodycopy" style="font-size: 17px;font-family: Open Sans, sans-serif;line-height: 22px;padding: 10px 30px;">
            <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">  
              <tbody>
                  <tr>
                      <td width="30%"></td>
                      <td align="left">
                        <p ><strong>Felicitaciones es el ganador del concurso:</strong><br>'. $titulo .'.</p>
                        <p >Pronto estaremos en contacto.</p>
                      </td>
                     
                      <td width="20%"></td>
                    </tr>
                

         
         
         </tbody>
         <table></table>
          </td>
        </tr>
        <tr>
          <td align="center" bgcolor="#f5f5f5">
              <br>
              <div style="text-align:center;background-color: #47a477; color: #ffffff; display: inline-block; padding: 10px 20px; margin-top: 5px; margin-bottom: 20px; font-family: Open Sans, sans-serif;font-size: 20px; border-radius: 30px;">
                  <a style="color: #fff; text-decoration: none;" href="' . site_url('login') . '">
                  Ingresar al panel de proponentes
                  </a>
              </div>
         </td>
        </tr>
      </tbody>
      </table>
      <!--[if (gte mso 9)|(IE)]>
            </td>
          </tr>
      </table>
      <![endif]-->
      </td>
    </tr>
  </tbody>
</table>
';
  //wp_mail( $email_admon, 'Activacion de usuario', 'Felicitaciones este es el enlace de activación: ' .  );
  function tipo_de_contenido_html() {
    return 'text/html';
  }
  add_filter( 'wp_mail_content_type', 'tipo_de_contenido_html' );
  
  wp_mail($email, $asunto, $mensaje);
                  
              

}///fin de ganador de concursos

//////

add_action( 'wp_login','redirect_to_homepage');
function redirect_to_homepage($user_login) {

    global $wp_session;

    global $wpdb;

    // if user is accessing admin page/dashboard do not redirect
    if (is_admin()) {  
        return;
    }


    $user = $wpdb->get_row("SELECT * FROM " . $wpdb->base_prefix . "users WHERE user_login = '" . $user_login . "'");

      $user = get_user_by('id', $user->ID);

    $link = site_url();

    if(in_array('proponente', $user->roles)){
      $link = site_url('panel-proponente');
    }


    if(in_array('supervisor', $user->roles)){
      $link = site_url('panel-supervisor');
    }


    if(in_array('administrador', $user->roles)){
      $link = site_url('panel-administrador');
    }


    wp_redirect($link);
    die;

  }


  function notificacion_credenciales_proponente($usuario,$password,$email_prop){

    $asunto = "Bienvenido a gestión proponentes.";
                      
    $mensaje = '<table width="100%" bgcolor="#f6f8f1"  cellpadding="0" cellspacing="0" ">
    <tbody>
    <tr>
      <td>
        <!--[if (gte mso 9)|(IE)]>
          <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>
        <![endif]-->     
        <table style="width: 100%; max-width: 640px;" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
          <tbody>
            <tr>
                <td class="innerpadding borderbottom" style="padding: 15px 30px 30px 30px; background-color: #dff0d8;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td align="center" class="h2" style="color: #000000;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;">
                        
                      </td>
                    </tr>
                  </tbody></table>
                </td>
            </tr>
            <tr>
                <td align="center" class="h2" style="color: #128041;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;  background-color:#dff0d8;">
                  <h3>Bienvenido al Sistema de proponentes </h3><br>
                </td>
            </tr>
            <tr>
                <td align="center" class="h2" style="color: #128041;font-family: Open Sans, sans-serif;font-size: 17px;line-height: 28px;font-weight: bold;  background-color:#ffffff;">
                    <br><h4>Por favor termina tu registro.<br> Para poder ingresar tus credenciales son:</h4><br>
                </td>
            </tr>
  
  
              
            <tr>
            <td align="center" bgcolor="#ffffff" class="innerpadding bodycopy" style="font-size: 17px;font-family: Open Sans, sans-serif;line-height: 22px;padding: 10px 30px;">
              <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">  
                <tbody>
                    <tr>
                        <td width="30%"></td>
                        <td align="left">
                          <p >Usuario:<strong> ' .$usuario. ' </strong></p>
                        </td>
                       
                        <td width="20%"></td>
                      </tr>
                  <tr>
                    <td width="30%"></td>
                    <td align="left">
                      <p >Contrase&ntilde;a:<strong> ' . $password . ' </strong></p>
                    </td>
                   
                    <td width="20%"></td>
                  </tr>
  
           
           
           </tbody>
           <table></table>
            </td>
          </tr>
          <tr>
            <td align="center" bgcolor="#f5f5f5">
                <br>
                <div style="text-align:center;background-color: #47a477; color: #ffffff; display: inline-block; padding: 10px 20px; margin-top: 5px; margin-bottom: 20px; font-family: Open Sans, sans-serif;font-size: 20px; border-radius: 30px;">
                    <a style="color: #fff; text-decoration: none;" href="' . site_url('login') . '">
                    Ingresar al panel de proponentes
                    </a>
                </div>
           </td>
          </tr>
        </tbody>
        </table>
        <!--[if (gte mso 9)|(IE)]>
              </td>
            </tr>
        </table>
        <![endif]-->
        </td>
      </tr>
    </tbody>
  </table>
  ';
    //wp_mail( $email_admon, 'Activacion de usuario', 'Felicitaciones este es el enlace de activación: ' .  );
    function tipo_de_contenido_html() {
      return 'text/html';
    }
    add_filter( 'wp_mail_content_type', 'tipo_de_contenido_html' );
    
    wp_mail($email_prop, $asunto, $mensaje);
                    
                
  
  }///fin de credencial proponentes
  
////Insert para archivos
function insert_attachment_user( $file_handler, $label ) {

  // check to make sure its a successful upload
  if ( $_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK ) __return_false();
  
  require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
  require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
  require_once( ABSPATH . 'wp-admin' . '/includes/media.php' );
  

if($_FILES[$file_handler]['name'] != ''){
  
  $upload = wp_upload_bits($_FILES[$file_handler]['name'], null, file_get_contents($_FILES[$file_handler]['tmp_name']));
  $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
  $wp_upload_dir = wp_upload_dir();
  
  $link = '<a href="'. $upload['url'] .'" target="_blank">Ver '.$label.'</a>';
  
}else{

  $link = '*';
  
}

  return $link;
  
  
  
  }//fin de insert para archivos


  function insert_attachment_concurso( $file_handler, $label ) {//insert para archivos concurso

    // check to make sure its a successful upload
    if ( $_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK ) __return_false();
    
    require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
    require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
    require_once( ABSPATH . 'wp-admin' . '/includes/media.php' );
    
    $upload = wp_upload_bits($_FILES[$file_handler]['name'], null, file_get_contents($_FILES[$file_handler]['tmp_name']));
    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
    $wp_upload_dir = wp_upload_dir();
    
    $link = '<a href="'. $upload['url'] .'" target="_blank">Ver '.$label.'</a>';
    
    return $link;
    
    }//fin de insert para archivos concurso 




// post_type eventos
function registro_de_post_types() {
    register_post_type('concurso',
        array(
            'labels'      => array(
                'name'          => __('Concursos', 'textdomain'),
                'singular_name' => __('Concurso', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
        )
    );
}
add_action('init', 'registro_de_post_types');