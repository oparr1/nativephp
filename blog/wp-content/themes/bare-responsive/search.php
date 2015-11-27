<?php get_header(); ?>
<div class="onepcssgrid-1200">
    <div class="onerow">
		<div id="content" class="wrapper">
			<div class="col8">
				<div id="main">
				<?php if ( have_posts() ) : ?>
						<h2>Search Results for '<?php echo esc_attr(get_search_query()); ?>'</h2>
					
					<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" class="post postbrdr" role="article">
						<div class="article_title_bar">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php /* the_title */ search_title_highlight(); ?></a></h2>
							<div class="postby_date_box">
								<span class="meta">
									<i>Posted by <span class="highlight"><?php the_author_posts_link(); ?></span> on <time datetime="<?php echo the_time('Y-m-j i'); ?>"><?php echo the_time(get_option('date_format')); ?></time>.</i>
									<i><?php edit_post_link('Admin Edit', ' ', '.'); ?></i>
								</span>	
							</div>
						</div>
						
						<section class="post-content clearfix">
							<?php /* the_excerpt */search_excerpt_highlight('<span class="readmore">Read more &rarr;</span>'); ?>
						</section>
					</article>
						
					<?php endwhile; ?>	
						
					<div id="navbelow" class="clearfix">
						<?php wp_pagenavi(); ?> 
					</div>
						
					<?php else : ?>
					<article class="post">
					  	<h1>Sorry, no results found searching '<?php echo esc_attr(get_search_query()); ?>'</h1>

					  
					  <section class="post-content">
					  	<p>Maybe try searching under a different keyword?</p>
					  	
					  	<p>Or head back to the <a href="<?php echo site_url(); ?>/">home page</a> and look for your content again.</p>
					  </section>
					</article>					
						
					<?php endif; ?>
				
				</div> <!-- /#main -->
			</div>
			<div class="col4 last">
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- /#content -->
		
		<br style="clear:both;">
	</div>
</div>
<?php get_footer(); ?>