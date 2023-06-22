<?php

/**
 * Plugin Name:       BLUE 360 Product Variation Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Author:            Product Variatio Plugin
 * Author URI:        https://facebook.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       variation
 * Domain Path:       /languages
 */

 if ( ! defined( 'ABSPATH' ) ) {

    die;
}
// 
add_action( 'woocommerce_variable_add_to_cart', function() {
 
    add_action( 'wp_print_footer_scripts', function() {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($){
            $(".variations td.value select ").hide();
            var input_name = $(".variations td.value select ").attr("name");
            var data = $("form.variations_form").attr("data-product_variations");
            data = JSON.parse( data );
            console.log(data);
            html = "<div class='variation_container'>";
            data.forEach( function( row, index ) {
				var checked = '';
				if ($(".variations td.value select option:selected").text() == row.attributes[input_name]){
					checked = "checked='true'";
				}
                html += "<div class='variation_row'>";
                html += "<div class='variation_column'>";
                html += "<label for='"+input_name+"_"+index+"'>";    
				html += "<div class='variation_internal_row'>";
                        html += "<img src='"+row.custom_field_url+"'>";
				 html += "<span class='media_note'>"+row.custom_field_media_note+"</span>";
                    html += "</div>";
                    html += "<div class='variation_internal_row'>";
                        html += "<p>"+row.price_html+"</p>";
                    html += "</div>";
                    html += "<div class='variation_internal_row'>";
                        html += "<div class='variation_internal_col'>";
                            html += "<strong>SKU:</strong><br><span>"+row.sku+"</span>";
                        html += "</div>";
                        html += "<div class='variation_internal_col'>";
                            html += "<strong>ISBN:</strong><br><span>"+row.custom_field_isbn+"</span>";
                        html += "</div>";
                    html += "</div>";
					html += "</label>";
                html += "</div>";
                html += "<div class='variation_column'>";
                    html += "<input class='variation_radio' type='radio' id='"+input_name+"_"+index+"' name='"+input_name+"' value='"+row.attributes[input_name]+"' data-btype='"+row.custom_field_btype+"' "+checked+">";
                html += "</div>";
                html += "</div>";

            } );
            html += "</div>";
            $(".variations td.value").append(html);
            $(".variations .variation_column input.variation_radio").click(function(){
                $(".variations td.value select").val($(this).val());
				$("span.product-type-description-after-price").text($(this).attr("data-btype"));
                $(".variations td.value select").trigger("change");
                
            });
// 			console.log($(".variations td.value select option:selected").text());
        });
        
        </script>
        <?php
 
    } );
 
} );



// 

define('URL', plugin_dir_url( __FILE__ ) );
define('PATH', plugin_dir_path( __FILE__ ) );
define('BASE_URL', get_option( 'siteurl' ));

if(!class_exists( 'VariationPluginClass' ) ){

    class VariationPluginClass{
        function register(){

            add_action('admin_menu', array($this, 'theme_options_panel'));
            add_action('admin_enqueue_scripts', array($this, 'hooks') );

            add_action( 'woocommerce_variation_options_pricing', array($this, 'bbloomer_add_custom_field_to_variations'), 10, 3 );

            add_action('wp_enqueue_scripts', array($this,'custom_css'));
            
            add_action( 'woocommerce_save_product_variation', array($this, 'bbloomer_save_custom_field_variations'), 10, 2 );

            add_filter( 'woocommerce_available_variation', array($this,'bbloomer_add_custom_field_variation_data' ));
			
			//
			add_action('wp_ajax_update_product_price', array($this,'update_product_price_ajax'));
			add_action('wp_ajax_nopriv_update_product_price', array($this,'update_product_price_ajax'));
			// 			 			

           
            add_action('rest_api_init', function () {
                register_rest_route( 'area/v1','area', array(
                          'methods'  => 'POST',
                          'callback' =>  array( $this, 'area' ),
						 'permission_callback' => '__return_true',
                ));
              });

              add_action('rest_api_init', function () {
                register_rest_route( 'area/v1','media_url', array(
                          'methods'  => 'POST',
                          'callback' =>  array( $this, 'media_url' ),
					      'permission_callback' => '__return_true',
                ));
              });

              add_action('rest_api_init', function () {
                register_rest_route( 'area/v1','update_data', array(
                          'methods'  => 'POST',
                          'callback' =>  array( $this, 'update_data' ),
					      'permission_callback' => '__return_true',
                ));
              });

              add_action('rest_api_init', function () {
                register_rest_route( 'area/v1','delete_data', array(
                          'methods'  => 'POST',
                          'callback' =>  array( $this, 'delete_data' ),
					     'permission_callback' => '__return_true',
                ));
              });

        }

		
		function update_product_price_ajax() {
  			$product_id = $_POST['product_id'];
  			$price = $_POST['price'];

  // Update the product price in the database
  			// update_post_meta($product_id, '_price', $price);
  			// update_post_meta($product_id, '_regular_price', $price);
  
  			wp_die();
			}
		 function custom_css()
        {
    
			  wp_enqueue_script( 'jquery' );
			 
              wp_enqueue_script('menuplugin-admin_css6',URL.'assests/js/front_end.js' ,array('jquery'),false,true);
			 
			  wp_localize_script( 'menuplugin-admin_css6', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),) );
			 
// 			 wp_enqueue_script('menuplugin-admin_css7',URL.'assests/js/custom.js' ,array('jquery'),false,true);
			 
        }
   
        function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
            //isbn
            
            woocommerce_wp_text_input( array(
                'id' => 'custom_field_isbn[' . $loop . ']',
                'class' => 'short',
                'label' => __( 'ISBN', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'custom_field_isbn', true )
            ));
            // end isbn   
            //  media  
//             $options[''] = __( 'Select a value', 'woocommerce');
//             global $wpdb;
//             $table_name = $wpdb->prefix . "mediatype"; 
//             $result = $wpdb->get_results ( "SELECT * FROM ". $table_name );
//             foreach( $result as $user) 
//             {
//             $options[] = $user->m_type;
//             }
        
//          woocommerce_wp_select( array(
//          'id' => 'custom_field_media_type[' . $loop . ']',
//          'class' => 'short media change',
//          'label' => __( 'Media Type', 'woocommerce' ),
//          'options' =>  $options,
//          'value' => get_post_meta( $variation->ID, 'custom_field_media_type', true )
//             ) );
//             
			$options[''] = __( 'Select a value', 'woocommerce');
global $wpdb;
$table_name = $wpdb->prefix . "mediatype"; 
$result = $wpdb->get_results( "SELECT * FROM ". $table_name );
foreach( $result as $user) {
    $options[$user->id] = $user->m_type; // Use the ID as the key
}

woocommerce_wp_select( array(
    'id' => 'custom_field_media_type[' . $loop . ']',
    'class' => 'short media change',
    'label' => __( 'Media Type', 'woocommerce' ),
    'options' =>  $options,
    'value' => get_post_meta( $variation->ID, 'custom_field_media_type', true )
) );
//             
            // end media

             //Media Note
            woocommerce_wp_text_input( array(
                'id' => 'custom_field_media_note[' . $loop . ']',
                'class' => 'short',
                'label' => __( 'Media Note', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'custom_field_media_note', true )
                   ) );
            // end Medid note 

             //  Payements type  
            // $options1[''] = __( 'Select a value', 'woocommerce');
            $data = array(
                'Regular',
                'Easy Cription Monthly',
                'Easy Cription Yearly',
                'Easy Pay'
            );
    
        $options1 = $data;
        
         woocommerce_wp_select( array(
         'id' => 'custom_field_payements_type[' . $loop . ']',
         'class' => 'short media',
         'label' => __( 'Payment Type', 'woocommerce' ),
         'options' =>  $options1,
         'value' => get_post_meta( $variation->ID, 'custom_field_payements_type', true )
            ) );
         // end Payements type

            //Payements
            woocommerce_wp_text_input( array(
                'id' => 'custom_field_payements[' . $loop . ']',
                'class' => 'short',
                'label' => __( 'Number of Payments', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'custom_field_payements', true )
                   ) );
            // end Payements

           //Payements Cycle
             woocommerce_wp_text_input( array(
                'id' => 'custom_field_payements_cycle[' . $loop . ']',
                'class' => 'short',
                'label' => __( 'Payment Cycle', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'custom_field_payements_cycle', true )
                   ) );
            // end Payements Cycle
         // start
            // echo '<div class="switch">';
            ?>
			<style>
				input#_input_checkbox_print {
    			margin-left: 8px;
				}
				p.form-field.custom_field_isbn\[0\]_field label {
					display: block;
					clear: both;
					width: 100% !important;
				}
			</style>
			<?php
            woocommerce_wp_checkbox( array(
                'id'            => '_input_checkbox_print',
                'wrapper_class' => 'show_if_simple',
                'class' => 'short slider round',
                'label'         => __( 'Print On Demand' ),
//                 'description'   => __( 'Input checkbox Description 1' ),
                'value' => get_post_meta( $variation->ID, '_input_checkbox_print', true )
            ) );
            // echo '</div>';
            // end
             //url
             ?>
             <script>
            jQuery(document).ready(function($) {
    $('select.change').on('change', function() {
    var subject=$(this).closest('.change').find('option:selected').text();
    var name = $(".url").attr("name");

    var settings = {
     "url": "https://blue360.britecode.dev/wp-json/area/v1/media_url",
    "method": "POST",
    "timeout": 0,
    "headers": {
     "Content-Type": "application/json"
},
"data": JSON.stringify({
"id": subject
}),
};

$.ajax(settings).done(function (response) {
var r = response;
var url = r.data[0]['url'];
var book = r.data[0]['book'];
$('.url').val(url);
$('.btype').val(book);
});
    });
    });
             </script>

             <?php
			
			$readonly = array('readonly' => 'readonly');
             
             woocommerce_wp_hidden_input( array(
                'id' => 'custom_field_url[' . $loop . ']',
                'class' => 'short url',
                'label' => __( 'Media Url', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'custom_field_url', true )
                   ) );
            // end url


            woocommerce_wp_hidden_input( array(
                'id' => 'custom_field_btype[' . $loop . ']',
                'class' => 'short btype',
                'label' => __( 'Book Type', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'custom_field_btype', true )
                   ) );
            // end url

            
    }

    function bbloomer_save_custom_field_variations( $variation_id, $i ) {
        // isbn
        $custom_field = $_POST['custom_field_isbn'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_isbn', esc_attr( $custom_field ) );
        //end isbn
        // media type
        $custom_field = $_POST['custom_field_media_type'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_media_type', esc_attr( $custom_field ) );
        // end media type 
        // media note
        $custom_field = $_POST['custom_field_media_note'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_media_note', esc_attr( $custom_field ) );
        // end media note 

        //Payements type
        $custom_field = $_POST['custom_field_payements_type'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_payements_type', esc_attr( $custom_field ) );
        // Payements type 

        //Payements
        $custom_field = $_POST['custom_field_payements'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_payements', esc_attr( $custom_field ) );
        // Payements 

        //Payements cycle
        $custom_field = $_POST['custom_field_payements_cycle'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_payements_cycle', esc_attr( $custom_field ) );
        // Payements cycle

        //print
        $custom_field = $_POST['_input_checkbox_print'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, '_input_checkbox_print', esc_attr( $custom_field ) );
        // print

        // url
        $custom_field = $_POST['custom_field_url'][$i];
        if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_url', esc_attr( $custom_field ) );
        // url
       
         // btype
         $custom_field = $_POST['custom_field_btype'][$i];
         if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'custom_field_btype', esc_attr( $custom_field ) );
         // btype

     }

     function bbloomer_add_custom_field_variation_data( $variations ) {
        // isbn
        $variations['custom_field_isbn'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_isbn', true );
        // end isbn
        // media type
        $variations['custom_field_media_type'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_media_type', true );
        // end media type 

        // media note
        $variations['custom_field_media_note'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_media_note', true );
        // end media note 

        // Payements type
        $variations['custom_field_payements_type'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_payements_type', true );
        // end Payements type

        // Payements
        $variations['custom_field_payements'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_payements', true );
        // end Payements
        
        // Payements cycle
        $variations['custom_field_payements_cycle'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_payements_cycle', true );
        // end Payements cycle

         //  print
         $variations['_input_checkbox_print'] = get_post_meta( $variations[ 'variation_id' ], '_input_checkbox_print', true );
         // end print
 

        // url
        $variations['custom_field_url'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_url', true );
        // end url

         // btype
         $variations['custom_field_btype'] = get_post_meta( $variations[ 'variation_id' ], 'custom_field_btype', true );
         // end btype

        return $variations;
     }
     
     
        function theme_options_panel(){
            
//             add_menu_page(
//                 'Variation Plugin Menu', 
//                 ' Blue Media Type', 
//                 'manage_options', 
//                 'media_type', 
//                 array($this, 'menupage'),
//                 'dashicons-admin-media',
//                 1);
 			add_submenu_page(
        	'edit.php?post_type=product',
        	__( 'Media Types' ),
        	__( 'Media Types' ),
        	'manage_woocommerce', // Required user capability
        	'media_type',
        	array($this, 'menupage')
    		);
            }

            function menupage(){
                include(PATH."menupage_template.php");
            }


            function create_db_table(){
        
                include(PATH.'first_db/createdb.php' );
    
            }
    
            function remove_db_table() {
            
                include(PATH.'first_db/removedb.php' );
    
            }


            function hooks( $hook )
            {
						
    
		  
            
            wp_register_script('menuplugin-admin_js', URL.'assests/js/jquery.min.js' ,array('jquery'),false,true);
    
            wp_register_script('menuplugin-admin_js1', URL.'assests/js/datatables.min.js' ,array('jquery'),false,true);
    
            wp_register_script('menuplugin-admin_js2', URL.'assests/js/bootstrap.min.js' ,array('jquery'),false,true);
    
            wp_register_script('menuplugin-admin_js2', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' ,array('jquery'),false,true);
    
            wp_register_script('menuplugin-admin_js4', "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js");
    
            wp_register_script('menuplugin-admin_js3', URL.'assests/js/custom.js' ,array('jquery'),false,true);
    
            // wp_localize_script('menuplugin-admin_js3', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php')));
            wp_localize_script( 'menuplugin-admin_js3', 'wnm_custom', array( 'base_url' => BASE_URL));
    
    
            // 
    
            wp_register_style('menuplugin-admin_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    
            wp_register_style('menuplugin-admin_css1', 'https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css');
    
            wp_register_style('menuplugin-admin_css2', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    
            wp_register_style('menuplugin-admin_css3', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    
            wp_register_style('menuplugin-admin_css4', URL.'assests/css/custom.css');
            
    
            $page = ( isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : '' );
           
            // multi
    
            if( 'media_type' ==  $page)
            { 
            
                wp_enqueue_script( 'menuplugin-admin_js' );
    
                wp_enqueue_script( 'menuplugin-admin_js1' );
    
                wp_enqueue_script( 'menuplugin-admin_js2' );
    
                wp_enqueue_script( 'menuplugin-admin_js3' );
    
                wp_enqueue_script( 'menuplugin-admin_js4' );
               
                // 
    
                wp_enqueue_style( 'menuplugin-admin_css' );
    
                wp_enqueue_style( 'menuplugin-admin_css1' );
    
                wp_enqueue_style( 'menuplugin-admin_css2' );
    
                wp_enqueue_style( 'menuplugin-admin_css3' );
    
                wp_enqueue_style( 'menuplugin-admin_css4' );   

                wp_enqueue_media();
    
            }

            if ('post.php' == $hook) {
                wp_enqueue_script('menuplugin-admin_js5',URL.'assests/js/product.js' ,array('jquery'),false,true);
            }
            wp_enqueue_style( 'menuplugin-admin_css4' ); 
//             wp_enqueue_style('menuplugin-admin_css5',URL.'assests/css/custom.css');

            // wp_enqueue_script('menuplugin-admin_js5',URL.'assests/js/product.js' ,array('jquery'),false,true);

            // wp_enqueue_script( 'menuplugin-admin_js3' );
        }

        function area($request) {

            include( PATH. 'first_db/insert.php' );
        }

        function media_url($request) {

            include( PATH. 'first_db/url.php' );
        }

        function update_data($request) {

            include( PATH. 'first_db/update.php' );
        }

        function delete_data($request) {

            include( PATH. 'first_db/delete.php' );
        }
        
        
    }
}

if(class_exists( 'VariationPluginClass' ) ){
    $crud = new VariationPluginClass();
    $crud->register();
}

register_activation_hook( __FILE__, array( $crud, 'create_db_table' ) );

register_deactivation_hook( __FILE__, array( $crud, 'remove_db_table' ) );
