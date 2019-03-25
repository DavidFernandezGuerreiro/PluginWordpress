<?php
/*
Plugin Name: Palabras mal sonantes
Plugin URI:  http://link to your plugin homepage
Description: Este plugin reemplaza las palabras mal sonantes.
Version:     1.0
Author:      David
Author URI:  http://link to your website
License:     yakata
License URI: https://link to your plugin license

Copyright YEAR PLUGIN_AUTHOR_NAME (email : your email address)
(Plugin Name) is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
(Plugin Name) is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with (Plugin Name). If not, see (http://link to your plugin license).
*/


//función para corregir las faltas de ortografía de wordpress en WordPress:
/*
function renym_wordpress_typo_fix( $text ) {
	return str_replace( 'wordpress', 'WordPress', $text );
}
add_filter( 'the_content', 'renym_wordpress_typo_fix' );
*/

//"Tacha" las palabras mal sonantes del post:
function renym_content_replace( $content ) {
	$search  = array( 'wordpress', 'joder', 'gilipollas', 'hijo de puta', 'puta' );
	$replace = array( '<del>WordPress</del>', '<del>joder</del>', '<del>gilipollas</del>', '<del>hijo de puta</del>', '<del>puta</del>' );
	return str_replace( $search, $replace, $content );
}
add_filter( 'the_content', 'renym_content_replace' );


//Cuenta el número de pálabras que tiene el post:
function renym_count_palabras( $content ) {
    echo "".$content."<b><font color='#6d6d6d' face='sans-serif' size='3em'>Hay ".str_word_count($content, 0)." palabras en el post</font></b>";
}
add_filter( 'the_content', 'renym_count_palabras' );


//MUESTRA EL TITULO DE LOS POSTS DE LA PÁGINA EN EL FOOTER:
// Enganche el gancho de acción 'wp_footer', agregue la función denominada 'mfp_Add_Text' a él
add_action("wp_footer", "mfp_Add_Text");
 
// Define 'mfp_Add_Text'
function mfp_Add_Text(){

	global $wpdb;
	
	$resultados= $wpdb->get_col( "SELECT post_title FROM wp5_posts WHERE post_status='publish'" );
	
	echo "<b><font color='#606060' face='sans-serif' size='3em'>POSTS PUBLICADOS</font></b>";
	echo "<table style='width:10%' border='2px' >
			<tr><td><b><font color='#606060' face='sans-serif' size='3em'>".$resultados[0]."</font></b></td></tr>
			<tr><td><b><font color='#606060' face='sans-serif' size='3em'>".$resultados[1]."</font></b></td></tr>
			<tr><td><b><font color='#606060' face='sans-serif' size='3em'>".$resultados[2]."</font></b></td></tr>
			<tr><td><b><font color='#606060' face='sans-serif' size='3em'>".$resultados[3]."</font></b></td></tr>
		</table>";

}



?>