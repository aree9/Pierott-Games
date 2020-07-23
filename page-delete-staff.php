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
				echo( '<form method="post" action="">' );
				echo( '<table class="wp-block-table is-style-stripes">' );
				echo( '<tbody>' );
				$userCount = 0;
				$userIDs   = array();
				while ( $row = mysqli_fetch_assoc( $result ) ) {
					$userIDs[] = $row['staff_id'];
					echo( '<tr>' );
					echo( '<td><input type="checkbox" name="user_' . $userCount . '" value=' . $row['staff_id'] . ' "></td>' );
					echo( '<td>' . $row['staff_name'] . '</td>' );
					echo( '<td>' . $row['staff_bio'] . '</td>' );
					echo( '<td>image</td>' );
					echo( '</tr>' );
					$userCount ++;
				}
				echo( '</tbody>' );
				echo( '</table>' );
				echo( '<input class="btn btn-md btn-filled" type="submit" value="submit" name="submit"/>' );
				echo( '</form>' );
			}
			mysqli_close( $dbc );

			?>
			<?php
			global $userIDs;
			if ( $_POST['submit'] ) {
				//Initialise server details
				$servername = "########";
				$h_username = "########";
				$h_password = "########";
				$dbname     = "########";
        //DETAILS REMOVED FOR PUBLIC REPOSITORY

				$connect = new mysqli( $servername, $h_username, $h_password, $dbname ) or die( $connect->error );

				//Check connection
				if ( ! $connect->connect_error ) {
				} else {
					die( "Connection Failed : " . $connect->connect_error );
				}
				$loopCount = 0;

				foreach ( $userIDs as $user ) {
					if ( ! empty( $_POST[ 'user_' . $loopCount ] ) ) {
						$sql = "DELETE FROM `custom_staff` WHERE `custom_staff`.`staff_id` =" . $user;
						if ( $connect->query( $sql ) === true ) {
							echo( "Success" );
						} else {
							echo( "Error: " . $query . "<br/>" . $conn->error );
						}
					}
					$loopCount ++;
				}

				/*for( $i = 0 ; $i < $userCount ; $i++){
					echo ("$i <br />");
					if (!empty($_POST['user_' . $i])){
						echo('-- $i isset --');
						$sql = "DELETE FROM `custom_staff` WHERE `custom_staff`.`staff_id` =" . $i;

						if ($connect->query($sql) === TRUE) {
						  echo("Success");
						} else {
						  echo("Error: " . $query . "<br/>" . $conn->error);
						}
					}
				}*/

				mysqli_close( $dbc );
				header( "Location: https://pierrotgames.000webhostapp.com/delete-staff" );
			} else {
				?>

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
