<?php
/*
Plugin Name: Image CDN
Plugin URI: http://thomasloughlin.com/cloudflare-cdn-image-hosting/
Version: 1.0.0
Author: Thomas Loughlin
Author URI: http://thomasloughlin.com/
Description: Version 1 finds and image and replaces it with the cdn url.
*/

function process_content ($content)
{
    //get contents before comments
$data=explode("<div class='shareinpost'>",$content);
    $pattern = '/src="http:\/\/((www\.)?thomasloughlin\.com\/wp-content\/uploads\/(\S)*\.(png|jpg|jpeg|gif))/i' ;
    $content =
        preg_replace (
            $pattern,
            'src="http://cdn-images.${1}',
            $data[0]
        );
if(count($data)>1) //$data[1]!='')
{
     $content.= "<div class='shareinpost'>" .$data[1];

}
return $content;

}

add_filter ('the_content',       'process_content');
add_filter ('the_content_limit', 'process_content');
add_filter ('the_excerpt',       'process_content');
add_filter ('post_thumbnail_html', 'process_content');
add_filter ('the_content_rss',   'process_content');
add_filter ('the_excerpt_rss',   'process_content');
add_filter ('post_gallery', 'process_content',10,2);
?>
