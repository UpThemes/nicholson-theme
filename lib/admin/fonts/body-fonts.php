<?php
/**
 * Returns an array of sample select options registered for nicholson.
 *
 * @since nicholson 1.0.2
 */
function lucid_body_font_options() {
	$body_font_options = array(
        'open-sans' => array(
            'name' 		=> 'Open Sans',
            'value'		=> 'open-sans',
            'import' 	=> '@import url(http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700);',
            'css' 		=> "font-family: 'Open Sans', sans-serif;"
        ),
        'lato' => array(
            'name' 		=> 'Lato',
            'value' 	=> 'lato',
            'import' 	=> '@import url(http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic);',
            'css' 		=> "font-family: 'Lato', sans-serif;"
        ),
        'roboto' => array(
            'name' 		=> 'Roboto',
            'value' 	=> 'roboto',
            'import' 	=> '@import url(http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic);',
            'css' 		=> "font-family: 'Roboto', sans-serif;"
        ),
        'roboto-slab' => array(
        	'name'		=> 'Roboto Slab',
        	'value'		=> 'roboto-slab',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Roboto+Slab:400,700);',
        	'css'		=> "font-family: 'Roboto Slab', serif;"
        ),
        'droid-sans' => array(
            'name' 		=> 'Droid Sans',
            'value' 	=> 'droid-sans',
            'import' 	=> '@import url(http://fonts.googleapis.com/css?family=Droid+Sans:400,700);',
            'css' 		=> "font-family: 'Droid Sans', sans-serif;"
        ),
        'pt-sans' => array(
        	'name'		=> 'PT Sans',
        	'value'		=> 'pt-sans',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic);',
        	'css'		=> "font-family: 'PT Sans', sans-serif;"
        ),
        'ubuntu' => array(
        	'name'		=> 'Ubuntu',
        	'value'		=> 'ubuntu',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic);',
        	'css'		=> "font-family: 'Ubuntu', sans-serif;"
        ),
        'source-sans-pro' => array(
        	'name'		=> 'Source Sans Pro',
        	'value'		=> 'source-sans-pro',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic);',
        	'css'		=> "font-family: 'Source Sans Pro', sans-serif;"
        ),
        'arimo'	=> array(
        	'name'		=> 'Arimo',
        	'value'		=> 'arimo',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic);',
        	'css'		=> "font-family: 'Arimo', sans-serif;"
        ),
        'cabin' => array(
        	'name'		=> 'Cabin',
        	'value'		=> 'cabin',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Cabin:400,700,400italic,700italic);',
        	'css'		=> "font-family: 'Cabin', sans-serif;"
        ),
        'droid-serif' => array(
        	'name'		=> 'Droid Serif',
        	'value'		=> 'droid-serif',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic);',
        	'css'		=> "font-family: 'Droid Serif', serif;"
        ),
        'titillium-web' => array(
        	'name'		=> 'Titillium Web',
        	'value'		=> 'titillium-web',
        	'import'	=> '@import url(http://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,700,700italic);',
        	'css'		=> "font-family: 'Titillium Web', sans-serif;"
        ),
        'arial' => array(
            'name' 		=> 'Arial',
            'value' 	=> 'arial',
            'import' 	=> '',
            'css' 		=> "font-family: Arial, sans-serif;"
        ),
        'georgia' => array(
        	'name'		=> 'Georgia',
        	'value'		=> 'georgia',
        	'import'	=> '',
        	'css'		=> "font-family: Georgia, serif;"
        )
    );
 
	return apply_filters( 'lucid_body_font_options', $body_font_options );
}