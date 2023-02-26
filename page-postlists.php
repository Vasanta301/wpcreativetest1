<?php 
/* Template Name: Post Lists 
*/
get_header();

$the_query = new WP_Query(array('post_type' => 'post','order'=>'Asc', 'orderby'=>'title'));
if ( $the_query->have_posts() ): ?>
	<header class="page-header alignwide">
		<h1 class="page-title"><?php echo get_the_title(); ?></h1>		
	</header>
	<div class="loader" style="display:none;"><?php _e('Generating Result...','WordPress');?></div>
	<div class="outer-container" id="outer-container">
		<?php while ( $the_query->have_posts() ): 
			$the_query->the_post();
        	get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
		endwhile; ?>
	</div>
	<?php filter_sidebar(); ?>
<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>
<?php
get_footer();
