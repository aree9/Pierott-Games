<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

get_header(); ?>
<?php $layout_class = shapely_get_layout_class(); ?>
    <div class="row">
		<?php
		if ( 'sidebar-left' == $layout_class ) :
			get_sidebar();
		endif;
		?>
        <div id="primary" class="col-md-8 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<?php

			//Initialise server details
      $servername = "########";
      $h_username = "########";
      $h_password = "########";
      $dbname     = "########";
      //DETAILS REMOVED FOR PUBLIC REPOSITORY

			//Establish connection
			$connect = new mysqli( $servername, $h_username, $h_password, $dbname ) or die( $connect->error );

			//Check connection
			if ( ! $connect->connect_error ) {
			} else {
				die( "Connection Failed : " . $connect->connect_error );
			}

			$query = "SELECT * FROM custom_staff";
			$result = mysqli_query( $connect, $query )
			or die( 'Error querying the database' );
			if ( mysqli_num_rows( $result ) == 0 ) {
				echo( 'Looks like nobody works here...' );
			} else {
				while ( $row = mysqli_fetch_assoc( $result ) ) {

					echo( '<div class="wp-block-media-text alignwide has-media-on-the-right">' );
					echo( '<div class="wp-block-media-text__content">' );
					echo( '<p class="has-large-font-size">' . $row['staff_name'] . '</p>' );
					echo( '<p>' . $row['staff_bio'] . '</p>' );
					echo( '<p>Favourite Game: ' . $row['staff_game'] . '</p>' );
					echo( '</div>' );
					echo( '</div>' );

				}
			}
			mysqli_close( $dbc );


			?>
        </div><!-- #primary -->
		<?php
		if ( 'sidebar-right' == $layout_class ) :
			get_sidebar();
		endif;
		?>
    </div>
<?php
get_footer();
