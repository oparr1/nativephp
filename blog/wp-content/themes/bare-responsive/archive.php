<?php get_header(); ?>
<div class="onepcssgrid-1200">
    <div class="onerow">
		<div id="content" class="wrapper">
			<div class="col8">			
				<div id="main">
					
					<?php if (is_category()) { ?>
					<h2>'<?php single_cat_title(); ?>' Category Archives</h2>

					<?php } elseif(is_tag()) { ?>
					<h2>Posts Tagged '<?php single_tag_title(); ?>'</h2>
					
					<?php } elseif(is_author()) { ?>
					<h2><?php get_the_author_meta('display_name'); ?> Author Archives</h2>
					
					<?php } elseif(is_day()) { ?>
					<h2><?php the_time('l, F j, Y'); ?>: Daily Archives</h2>
					
					<?php } elseif(is_month()) { ?>
						<h2><?php the_time('F Y'); ?> Monthly Archives</h2>
					
					<?php } elseif(is_year()) { ?>
						<h2><?php the_time('Y'); ?> Yearly Archives</h2>
					<?php } ?>
					
					
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" class="post postbrdr" role="article">
						<div class="article_title_bar">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class="postby_date_box">
								<span class="meta">
									<i>Posted by <span class="highlight"><?php the_author_posts_link(); ?></span> on <time datetime="<?php echo the_time('Y-m-j i'); ?>"><?php echo the_time(get_option('date_format')); ?></time>.</i>
									<i><?php edit_post_link('Admin Edit', ' ', '.'); ?></i>
								</span>	
							</div>
						</div>	
						
						<section class="post-content clearfix">
							<?php the_excerpt(); ?>
							<p><a href="<?php the_permalink() ?>">Read More...</a></p>
						</section>
					</article> <!-- /.post -->
					<?php endwhile; ?>
					
					<div id="navbelow" class="clearfix">
						<?php wp_pagenavi(); ?>  
					</div>
					
					<?php else : ?>
						<article id="post-not-found" class="post">
						  	<h2>Whoops! Looks like we can't find this post.</h2>
						  
						  <section class="post-content">
						  	<p>It seems like this post is missing somewhere. Double-check the URL or try navigating back via the website menu links.</p>
						  </section>
						</article>
					<?php endif; ?>
				</div> <!-- /#main -->
			</div>
			<div class="col4 last">
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- /#content -->
	</div>
</div>
		
		<br style="clear:both;">
<?php get_footer(); ?>