<?php get_header(); ?>

<div id="content" class="clearfix row">

	<div id="main" class="col-sm-8 clearfix" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<header>

				<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>

				<p class="meta"><?php _e("Posted", "ig2d"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "ig2d"); ?> <?php the_author_posts_link(); ?>.</p>

			</header> <!-- end article header -->

			<section class="post_content clearfix" itemprop="articleBody">

				<div class="row">
					<div class="col-sm-4">
						<?php the_post_thumbnail( 'medium', array( 'class' => 'aligncenter' ) ); ?>
					</div>
					<div class="col-sm-8">
						<?php the_content(); ?>
					</div>
				</div>

			</section> <!-- end article section -->

			<footer>

				<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","ig2d") . ':</span> ', ' ', '</p>'); ?>

				<?php
				// only show edit button if user has permission to edit posts
				if( $user_level > 0 ) {
				?>
				<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","ig2d"); ?></a>
				<?php } ?>

			</footer> <!-- end article footer -->

		</article> <!-- end article -->

		<?php comments_template('',true); ?>

		<?php endwhile; ?>

		<?php else : ?>

		<article id="post-not-found">
			<header>
				<h1><?php _e("Not Found", "ig2d"); ?></h1>
			</header>
			<section class="post_content">
				<p><?php _e("Sorry, but the requested resource was not found on this site.", "ig2d"); ?></p>
			</section>
			<footer>
			</footer>
		</article>

		<?php endif; ?>

	</div> <!-- end #main -->

	<?php get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>