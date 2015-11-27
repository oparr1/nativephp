<aside id="sidebar" role="complementary">
  <!-- Widget search - add to funnction.php for customise -->
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
  		<?php dynamic_sidebar( 'sidebar-1' ); ?>
  <?php endif; ?>

  <!-- Custom archive menu -->
  <?php 
  $all_posts = get_posts(array(
  // show all posts and not limited by settings in wordpress
    'posts_per_page' => -1 
  ));

  // this variable will contain all the posts in a associative array
  // with three levels, for every year, month and posts.
  $ordered_posts = array();

  foreach ($all_posts as $single) {

    $year  = mysql2date('Y', $single->post_date);
    $month = mysql2date('F', $single->post_date);

    // specifies the position of the current post
    $ordered_posts[$year][$month][] = $single;
  }

  foreach ($ordered_posts as $year => $months) : // Years ?>
  <div class="widget archivesmenu">
      <h3>Archives</h3>  
        <ul class="years">
          	<li class="selected">
            	<span class="sym">&#x25BC;</span><a href="<?php echo get_year_link($year); ?>"><span><?php echo $year ?></span></a>
           	</li>
            <ul class="months">
                <?php foreach ($months as $month => $posts ) : // Months ?>
                  	<li class="selected">
                    	<span class="sym">&#x25BC;</span><a href="<?php echo get_month_link($year, $month); ?>"><span><?php echo $month ?></span><span class="monthCount"><?php printf(" (%d)", count($months[$month])) ?></span></a>
                    </li>
                    <ul class="posts">
                    <?php foreach ($posts as $single ) : // Posts ?>
                        <li class="selected">
                          <a href="<?php echo get_permalink($single->ID); ?>"><?php echo get_the_title($single->ID); ?></a>
                        </li>
                    <?php endforeach // End Posts ?>
                  </ul> <!-- end posts -->
                <?php endforeach  // End Months ?>
            </ul> <!-- end months -->
        </ul> <!-- end years -->
  </div>
  <?php endforeach  // End Years ?>
</aside><!-- #primary-sidebar -->

<!-- without widgets -->
			<?php /* if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
				<div class="widget">
					<h3>Search</h3>
					<?php get_search_form(); ?>
				</div>
			<?php endif; */ ?>

<!-- Archive Menu Expand/Collapse -->
<script>
jQuery(document).ready(function(){
    jQuery(".months, .posts").hide(); // hide months and posts
    jQuery(".archivesmenu li span.sym").html("&#x25ba;"); // Expand Arrow
    jQuery(".archivesmenu li span.sym").click(function(){
      // Add/Remove class 'selected' to li in order to expand/collapse
      if (jQuery(this).parent('li').hasClass('selected')) {
          jQuery(this).parentsUntil("ul.months").next().slideDown(250); // Slide Down
          jQuery(this).html('&#x25BC;'); // Expand arrow
          jQuery(this).parent('li').removeClass('selected');
      }
      else {
          jQuery(this).parent('li').addClass('selected');
          jQuery(this).parentsUntil("ul").next().slideUp(250); // Slide Up
          jQuery(this).html('&#x25ba;'); // Collapse arrow
      }
    });
});
</script>