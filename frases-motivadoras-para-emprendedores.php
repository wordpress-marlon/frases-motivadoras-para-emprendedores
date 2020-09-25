<?php
/**
 * @package Frases-Motivadoras-Para-Emprendedores
 * @version 1.7.2
 */
/*
Plugin Name: Frases Motivadoras Para Emprendedores
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Marlon Falcon Hernández
Version: 1.7.2
Author URI: http://marlonfalcon.cl
*/

function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Las oportunidades no pasan, las creas
El poder de la imaginación nos hace infinitos
No puedes vencer a alguien que nunca se rinde
He fallado una y otra vez y es por ello que he tenido éxito
Si puedes soñarlo, puedes hacerlo
Si crees que puedes, ya estás a medio camino
Elige un trabajo que te guste y no tendrás que trabajar ni un día de tu vida
La motivación nos impulsa a comenzar y el hábito nos permite continuar
Un hombre con una nueva idea es un loco, hasta que ésta triunfa
La cosa no va de tener ideas, es de hacer que sucedan
Mucha gente tiene ideas pero solo unos pocos deciden llevarlas a cabo hoy y no mañana
Si trabajas en algo que te gusta y te apasiona no necesitas tener un plan maestro de cómo hacer las cosas, sucederán
Cuando todo parezca ir en contra tuyo, recuerda que el avión despega con el viento en contra, no a favor
No importa lo lento que vayas mientras no te pares
No hay nada malo en una empresa pequeña. Puedes hacer grandes cosas con un equipo pequeño
Si quieres hacerlo, hazlo ahora, sino, te arrepentirás
Entrega siempre más de lo que se espera de ti
“Si puedes soñarlo, puedes hacerlo
Tus clientes más insatisfechos son tu mejor fuente de aprendizaje
Sueña en grande y atrévete a fallar";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello Dolly song, by Jerry Herman:' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_dolly' );

// We need some CSS to position the paragraph.
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );
