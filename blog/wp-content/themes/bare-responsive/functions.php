<?php
/*
  Custom functions designed specifically for Bare Responsive theme.
  Feel free to add your own dynamic functions, or clear out this file entirely.
  
*/
register_nav_menus( array( 'header-menu' => 'Header Menu' ) );
/**
 * Setting up custom sidebars
 *
 */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'id' => 'main',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="wtitle">',
		'after_title' => '</h3>'
	));
	
	register_sidebar(array(
		'name' => 'Responsive Sidebar',
		'id' => 'responsive',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="wtitle">',
		'after_title' => '</h3>'
	));
}
/**
 * Customize the 'Read More' link text
 *
 */
function custom_more_link( $link, $link_text ) {
     return str_replace( $link_text, 'Read More...', $link);
}
add_filter( 'the_content_more_link', 'custom_more_link', 10, 2 );
/**
 * Remove the hash(#) from all 'Read More' links
 *
 */
function remove_more_jump($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump');
// Search highlighting 
function search_excerpt_highlight() {
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);

    echo '<p>' . $excerpt . '</p>';
}
function search_title_highlight() {
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

    echo $title;
}
/*    add for widgets to appear in customise */
/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {
	register_sidebar( array(
		'name'          => 'Widget Area',
		'id'            => 'sidebar-1',
		'before_widget' => "<div class='widget'>",
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
