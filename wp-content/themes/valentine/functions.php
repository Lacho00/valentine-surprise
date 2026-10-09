<?php
/**
 * Valentine Theme - Funciones (sin CDN, todo local)
 */

// Asegurar que el tema padre esté disponible
if ( ! function_exists( 'get_template_directory' ) ) {
    return;
}

// Cargar estilos del tema padre
function valentine_enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'valentine_enqueue_parent_styles' );

function valentine_theme_scripts() {
    // Cargar en la plantilla de San Valentín y en la página Sí (yes)
    $is_valentine = is_page_template( 'template-valentine.php' );
    $is_yes       = is_page_template( 'template-valentine-yes.php' );
    if ( ! $is_valentine && ! $is_yes ) {
        return;
    }

    // CSS compilado de Tailwind (generado con npm run build)
    wp_enqueue_style(
        'valentine-tailwind',
        get_stylesheet_directory_uri() . '/assets/css/valentine.css',
        array(),
        '1.0'
    );

    // Estilos extra (confeti, heartbeat, etc.)
    wp_enqueue_style(
        'valentine-extra',
        get_stylesheet_directory_uri() . '/assets/css/valentine-extra.css',
        array('valentine-tailwind'),
        '1.0'
    );

    // JavaScript (solo en página principal: botón No huidizo, música, confeti)
    if ( $is_valentine ) {
        wp_enqueue_script(
            'valentine-script',
            get_stylesheet_directory_uri() . '/assets/js/valentines.js',
            array(),
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'valentine_theme_scripts');

// Forzar refresco de plantillas disponibles (ayuda a que WordPress detecte la plantilla)
function valentine_refresh_templates() {
    // Limpiar caché de plantillas
    delete_transient( 'wp_get_theme_data_' . get_stylesheet() );
}
add_action( 'after_switch_theme', 'valentine_refresh_templates' );

// Asegurar que WordPress detecte la plantilla personalizada
function valentine_add_page_template( $templates ) {
    $templates['template-valentine.php']   = 'Página de San Valentín';
    $templates['template-valentine-yes.php'] = 'Página San Valentín - Sí (celebración)';
    return $templates;
}
add_filter( 'theme_page_templates', 'valentine_add_page_template' );

// Cargar definición de campos ACF para la plantilla San Valentín (solo si ACF está activo)
function valentine_load_acf_fields() {
    if ( function_exists( 'acf_add_local_field_group' ) ) {
        require_once get_stylesheet_directory() . '/acf-valentine-fields.php';
    }
}
add_action( 'acf/init', 'valentine_load_acf_fields' );

/**
 * Tiempo transcurrido para el contador "Together for", en hora de pared.
 *
 * Los meses se cuentan por calendario; si el día de inicio no existe en un mes
 * (29-31), se toma el último día de ese mes. Un inicio futuro devuelve todo a 0.
 * El JS de template-valentine-yes.php usa el mismo cálculo.
 *
 * @param DateTimeImmutable $start Inicio a las 00:00.
 * @param DateTimeImmutable $now   Ahora, en la misma zona horaria.
 * @return array<string,int>
 */
function valentine_counter_parts( DateTimeImmutable $start, DateTimeImmutable $now ) {
	$sy = (int) $start->format( 'Y' );
	$sm = (int) $start->format( 'n' );
	$sd = (int) $start->format( 'j' );
	$ny = (int) $now->format( 'Y' );
	$nm = (int) $now->format( 'n' );
	$nd = (int) $now->format( 'j' );

	$months = ( $ny - $sy ) * 12 + ( $nm - $sm );
	if ( $nd < min( $sd, (int) gmdate( 't', gmmktime( 0, 0, 0, $nm, 1, $ny ) ) ) ) {
		$months--;
	}

	$parts = array_fill_keys( array( 'years', 'months', 'days', 'hours', 'minutes', 'seconds' ), 0 );
	if ( $months < 0 ) {
		return $parts;
	}

	$total = ( $sm - 1 ) + $months;
	$ay    = $sy + intdiv( $total, 12 );
	$am    = $total % 12 + 1;
	$ad    = min( $sd, (int) gmdate( 't', gmmktime( 0, 0, 0, $am, 1, $ay ) ) );

	$parts['years']   = intdiv( $months, 12 );
	$parts['months']  = $months % 12;
	$parts['days']    = (int) round( ( gmmktime( 0, 0, 0, $nm, $nd, $ny ) - gmmktime( 0, 0, 0, $am, $ad, $ay ) ) / DAY_IN_SECONDS );
	$parts['hours']   = (int) $now->format( 'G' );
	$parts['minutes'] = (int) $now->format( 'i' );
	$parts['seconds'] = (int) $now->format( 's' );
	return $parts;
}

