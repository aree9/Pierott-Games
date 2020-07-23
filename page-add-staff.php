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
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			<?php
			if ( $_POST['submit'] ) {
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

				//Insert into vars
				$newName = $connect->escape_string( $_POST['staff-name'] );
				$newBio  = $connect->escape_string( $_POST['staff-bio'] );
				$newGame = $connect->escape_string( $_POST['staff-game'] );


				$sql = "INSERT INTO custom_staff (staff_name, staff_bio, staff_game)" . "VALUES ( '$newName' , '$newBio' , '$newGame')";

				if ( $connect->query( $sql ) === true ) {
					echo( "Success" );
				} else {
					echo( "Error: " . $query . "<br/>" . $conn->error );
				}

				mysqli_close( $dbc );

			} else {
				?>
                <form method="post" action="">
                    <label for="staff-name">Name: </label>
                    <input type="text" name="staff-name"/>
                    <label for="staff-bio">Bio: </label>
                    <textarea name="staff-bio"></textarea>
                    <label for="staff-game">Favourite Game: </label>
                    <textarea name="staff-game"></textarea>
                    <input type="submit" name="submit" value="submit"/>
                </form>
				<?php
			}
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
