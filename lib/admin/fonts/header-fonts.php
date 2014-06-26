<?php
/**
 * Returns an array of sample select options registered for nicholson.
 *
 * @since nicholson 1.0.2
 */
function lucid_header_font_options() {
	$header_font_options = array(
        'open-sans' => array(
            'name' 		=> 'Open Sans',
            'value'		=> 'open-sans',
            'import' 	=> '@import url(http://fonts.googleapis.com/css?family=Open+Sans:800);',
            'css' 		=> "font-family: 'Open Sans', Arial, sans-serif;"
        ),
        'oswald' => array(
        	'name'		=> 'Oswald',
        	'value'		=> 'oswald',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Oswald:700);',
        	'css'		=> "font-family: 'Oswald', Arial, sans-serif"
        ),
        'roboto' => array(
        	'name'		=> 'Roboto',
        	'value'		=> 'roboto',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Roboto:900,700);',
        	'css'		=> "font-family: 'Roboto', sans-serif;"
        ),
        'lato' => array(
            'name' 		=> 'Lato',
            'value' 	=> 'lato',
            'import' 	=> '@import url(http://fonts.googleapis.com/css?family=Lato:900,700);',
            'css' 		=> "font-family: 'Lato', sans-serif;"
        ),
        'arial' => array(
            'name' 		=> 'Arial',
            'value' 	=> 'arial',
            'import' 	=> '',
            'css' 		=> "font-family: Arial, sans-serif;"
        ),
        'droid-sans' => array(
        	'name'		=> 'Droid Sans',
        	'value'		=> 'droid-sans',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Droid+Sans:700);',
        	'css'		=> "font-family: 'Droid Sans', sans-serif;"
        ),
        'pt-sans' => array(
        	'name'		=> 'PT Sans',
        	'value'		=> 'pt-sans',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=PT+Sans:700,700italic);',
        	'css'		=> "font-family: 'PT Sans', sans-serif"
        ),
        'ubuntu' => array(
        	'name'		=> 'Ubuntu',
        	'value'		=> 'ubuntu',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Ubuntu:700,700italic);',
        	'css'		=> "font-family: 'Ubuntu', sans-serif;"
        ),
        'source-sans-pro' => array(
        	'name'		=> 'Source Sans Pro',
        	'value'		=> 'source-sans-pro',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:900);',
        	'css'		=> "font-family: 'Source Sans Pro', sans-serif"
        ),
        'yanone-kaffeesatz' => array(
        	'name'		=> 'Yanone Kaffeesatz',
        	'value'		=> 'yanone-kaffeesatz',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:700);',
        	'css'		=> "font-family: 'Yanone Kaffeesatz', sans-serif;"
        ),
        'titillium-web' => array(
        	'name'		=> 'Titillium Web',
        	'value'		=> 'titillium-web',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Titillium+Web:700);',
        	'css'		=> "font-family: 'Titillium Web', sans-serif;"
        ),
        'georgia' => array(
        	'name'		=> 'Georgia',
        	'value'		=> 'georgia',
        	'import'	=> '',
        	'css'		=> "font-family: Georgia, serif;"
        )
    );
 
	return apply_filters( 'lucid_header_font_options', $header_font_options );
}
