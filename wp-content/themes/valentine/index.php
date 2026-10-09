<?php
/**
 * Tema hijo Valentine - Index
 * 
 * Este archivo es necesario para que WordPress reconozca el tema hijo.
 * Si no existe una plantilla específica, usa la del tema padre.
 */

// Si el tema padre no está disponible, mostrar error
if ( ! function_exists( 'get_template_directory' ) ) {
    wp_die( 'Error: El tema padre Twenty Twenty-Four no está instalado.' );
}

// Cargar la plantilla del tema padre
locate_template( 'index.php', true );
