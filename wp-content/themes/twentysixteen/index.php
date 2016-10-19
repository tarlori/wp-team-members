<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<h2 class="page-title team-members-title"><?php echo __( 'Team Members', 'twentysixteen' ); ?></h2>

			<?php
				$args = array(
					'post_type' => 'tl_team_member_post', 
					'orderby'=> 'title', 
					'order' => 'ASC',
					'posts_per_page' => 12 
				);
	    		$team_members = get_posts($args);
    		?>
    		<?php if(count($team_members)) : ?>
    			<div class="row team-members">
		    	<?php foreach($team_members as $key => $post) : setup_postdata($post); ?>
		    		<?php
		    			$position = get_field( 'tl_team_member_position', $post->ID );
		    			$facebook = get_field( 'tl_team_member_facebook', $post->ID );
		    			$twitter = get_field( 'tl_team_member_twitter', $post->ID );
		    			$photo = has_post_thumbnail($post->ID) ? wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'tl_team_member_media')[0] : 'https://dummyimage.com/318x180/444/fff';
		    			$bio = esc_textarea(get_the_content());
		    			$bio = strlen($bio) > 300 ? substr($bio, 0, 300) .'...' : $bio;
	    			?>
	    			<div class="col-sm-4 team-member--col<?php echo ($key%3 == 0) ? ' clear-col' : ''; ?>">
	    				<div class="team-member--col-inner">
		    				<img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_html(get_the_title()); ?>" class="photo">
		    				<div class="team-member--pad">
			    				<div class="team-member--name"><?php echo esc_html(get_the_title()); ?></div>
			    				<div class="team-member--position"><?php echo esc_html($position); ?></div>
			    				<div class="team-member--icons">
			    					<?php if (!empty($facebook)) : ?>
			    						<a href="<?php echo esc_url($facebook); ?>" target="_blank"><img src="<?php echo get_template_directory_uri() . '/img/icon-fb.jpg'; ?>"></a>
			    					<?php endif; ?>
			    					<?php if (!empty($twitter)) : ?>
			    						&nbsp;<a href="<?php echo esc_url($twitter); ?>" target="_blank"><img src="<?php echo get_template_directory_uri() . '/img/icon-twitter.jpg'; ?>"></a>
			    					<?php endif; ?>
			    				</div>
			    				<div class="team-member--bio"><?php echo $bio; ?></div>
			    				<div class="team-member--read-more"><button type="button" class="btn btn-primary"><?php echo __( 'Read More', 'twentysixteen' ); ?></button><input type="hidden" class="hid_read_less_text" value="<?php echo __( 'Read Less', 'twentysixteen' ); ?>"><input type="hidden" class="hid_read_more_text" value="<?php echo __( 'Read More', 'twentysixteen' ); ?>"></div>
			    			</div>
	    				</div>
	    			</div>
	    		<?php endforeach; wp_reset_postdata(); ?>
	    		</div>
    		<?php endif; ?>
			
			<?php
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
