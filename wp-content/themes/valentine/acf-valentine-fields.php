<?php
/**
 * ACF: Grupo de campos para la plantilla de San Valentín
 * Se carga solo si el plugin Advanced Custom Fields está activo.
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

$theme_images = array(
    'heart-i-love-you.gif'   => 'Gatito con corazón (heart-i-love-you)',
    'peachcat-cat.gif'       => 'Peach cat',
    'mochi-mochi-peach-cat.gif' => 'Mochi Mochi Peach Cat',
    'hearts-heart-cats.gif'  => 'Dos gatos con corazón',
    'rr.gif'                 => 'Gatos beso (rr)',
    'seviyorum.gif'          => 'Seviyorum',
    'cats-kittens.gif'       => 'Huggies & Kisses (cats-kittens)',
);

$cat_choices = array( '' => '— Ninguno —' ) + $theme_images;

acf_add_local_field_group( array(
    'key'                   => 'group_valentine_page',
    'title'                 => 'Contenido San Valentín',
    'fields'                 => array(
        array(
            'key'   => 'field_valentine_title',
            'label' => 'Título principal',
            'name'  => 'valentine_title',
            'type'  => 'text',
            'default_value' => 'Will You Be My Valentine?',
            'placeholder'   => 'Will You Be My Valentine?',
        ),
        array(
            'key'   => 'field_valentine_together',
            'label' => 'Texto "juntos por"',
            'name'  => 'valentine_together',
            'type'  => 'text',
            'default_value' => 'Together for',
            'placeholder'   => 'Together for',
        ),
        array(
            'key'   => 'field_valentine_years',
            'label' => 'Años juntos',
            'name'  => 'valentine_years',
            'type'  => 'number',
            'default_value' => 1,
            'min'   => 0,
        ),
        array(
            'key'   => 'field_valentine_months',
            'label' => 'Meses adicionales',
            'name'  => 'valentine_months',
            'type'  => 'number',
            'default_value' => 2,
            'min'   => 0,
            'max'   => 11,
        ),
        array(
            'key'   => 'field_valentine_more',
            'label' => 'Texto debajo del tiempo',
            'name'  => 'valentine_more',
            'type'  => 'text',
            'default_value' => 'And many more to come! 🌹',
            'placeholder'   => 'And many more to come! 🌹',
        ),
        array(
            'key'     => 'field_valentine_cat_1',
            'label'   => 'Gatito / imagen 1',
            'name'    => 'valentine_cat_1',
            'type'    => 'select',
            'choices' => $theme_images,
            'default_value' => 'heart-i-love-you.gif',
        ),
        array(
            'key'     => 'field_valentine_cat_2',
            'label'   => 'Gatito / imagen 2',
            'name'    => 'valentine_cat_2',
            'type'    => 'select',
            'choices' => $cat_choices,
            'default_value' => 'peachcat-cat.gif',
        ),
        array(
            'key'   => 'field_valentine_btn_yes',
            'label' => 'Texto botón Sí',
            'name'  => 'valentine_btn_yes',
            'type'  => 'text',
            'default_value' => 'Yes! 💍',
        ),
        array(
            'key'   => 'field_valentine_btn_no',
            'label' => 'Texto botón No',
            'name'  => 'valentine_btn_no',
            'type'  => 'text',
            'default_value' => 'No 😢',
        ),
        array(
            'key'   => 'field_valentine_celebration',
            'label' => 'Mensaje al decir Sí',
            'name'  => 'valentine_celebration',
            'type'  => 'text',
            'default_value' => "I knew you'd say yes! 🎉",
        ),
        array(
            'key'   => 'field_valentine_redirect_url',
            'label' => 'URL de redirección (al pulsar Sí)',
            'name'  => 'valentine_redirect_url',
            'type'  => 'url',
            'placeholder' => 'https://ejemplo.com/pagina',
            'instructions' => 'URL a la que redirigir cuando se pulse el botón "Sí". Déjalo vacío si no quieres redirección.',
        ),
        array(
            'key'           => 'field_valentine_music',
            'label'         => 'Música de fondo (MP3)',
            'name'          => 'valentine_music',
            'type'          => 'file',
            'return_format' => 'array',
            'mime_types'    => 'mp3',
            'instructions'  => 'Sube un archivo MP3. Si lo dejas vacío, se usará el que está en Medios (uploads/2026/02/).',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'template-valentine.php',
            ),
        ),
    ),
) );

// Grupo ACF para la página "Sí" (celebración) - slug: yes
acf_add_local_field_group( array(
    'key'                   => 'group_valentine_yes_page',
    'title'                 => 'Contenido Página Sí (celebración)',
    'fields'                 => array(
        array(
            'key'   => 'field_valentine_yes_title',
            'label' => 'Título principal',
            'name'  => 'valentine_yes_title',
            'type'  => 'text',
            'default_value' => "I knew you'd say yes! 🎉",
        ),
        array(
            'key'   => 'field_valentine_yes_subtitle',
            'label' => 'Subtítulo / mensaje',
            'name'  => 'valentine_yes_subtitle',
            'type'  => 'textarea',
            'default_value' => 'Thank you for being my Valentine. I love you! 💕',
            'rows'  => 3,
        ),
        array(
            'key'   => 'field_valentine_yes_together',
            'label' => 'Texto "Together for"',
            'name'  => 'valentine_yes_together',
            'type'  => 'text',
            'default_value' => 'Together for',
        ),
        array(
            'key'   => 'field_valentine_yes_more',
            'label' => 'Texto "And many more to come!"',
            'name'  => 'valentine_yes_more',
            'type'  => 'text',
            'default_value' => 'And many more to come! 🌹',
        ),
        array(
            'key'            => 'field_valentine_yes_start',
            'label'          => 'Fecha de inicio (contador)',
            'name'           => 'valentine_yes_start',
            'type'           => 'date_picker',
            'display_format' => 'd/m/Y',
            'return_format'  => 'Y-m-d',
            'first_day'      => 1,
            'instructions'   => 'El contador "Together for" cuenta desde las 00:00 de este día, hora de Cuba. Vacío = 14/01/2025.',
        ),
        array(
            'key'           => 'field_valentine_yes_music',
            'label'         => 'Música de fondo (MP3)',
            'name'          => 'valentine_yes_music',
            'type'          => 'file',
            'return_format' => 'array',
            'mime_types'    => 'mp3',
            'instructions'  => 'Opcional. Si está vacío, se usa la misma música que en la página principal.',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'template-valentine-yes.php',
            ),
        ),
    ),
) );
