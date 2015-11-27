<?php get_header(); ?>
<div class="onepcssgrid-1200">
    <div class="onerow">
		<div id="content" class="wrapper">
			<div class="col8">
				<div id="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" class="post" role="article">
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
							<?php the_content(); ?>
						</section>
						
						<?php // uncomment for tags the_tags('<p class="tags"><span>Post Tags:</span> ', ', ', '</p>'); ?>
						
						<?php comments_template(); ?>
					</article><!-- /.post -->
					<?php endwhile; ?>
					
					<?php else : ?>
						<article id="post-not-found" class="post">
							<header class="posthead">
						  	<h2>Whoops! Looks like we can't find this post.</h2>
						  </header>
						  
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
		
		<br style="clear:both;">
	</div>
</div>
<?php get_footer(); ?>