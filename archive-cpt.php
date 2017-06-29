<?php get_header(); ?>

<div id="content" class="clearfix row">

	<div id="main" class="col-md-12 clearfix" role="main">

		<div class="row">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="col-sm-4">
				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
				<?php the_excerpt(); ?>
			</div>

		<?php endwhile; ?>

		</div>

		<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>

			<?php page_navi(); // use the page navi function ?>

		<?php } else { // if it is disabled, display regular wp prev & next links ?>
			<nav class="wp-prev-next">
				<ul class="pager">
					<li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
					<li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
				</ul>
			</nav>
		<?php } ?>


		<?php else : ?>

		<article id="post-not-found">
			<header>
				<h1><?php _e("No Products Yet", "wpbootstrap"); ?></h1>
			</header>
			<section class="post_content">
				<p><?php _e("Sorry, there are no products of this type.", "wpbootstrap"); ?></p>
			</section>
			<footer>
			</footer>
		</article>
	</div>

		<?php endif; ?>

	</div> <!-- end #main -->


</div> <!-- end #content -->

<?php get_footer(); ?>