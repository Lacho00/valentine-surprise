<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html( get_field( 'valentine_title' ) ?: 'Will You Be My Valentine?' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
$theme_uri   = get_stylesheet_directory_uri();
$default_music = content_url( '/uploads/2026/02/01.-Alex-Warren-Ordinary-Wedding-Version.mp3' );

$title          = get_field( 'valentine_title' ) ?: 'Will You Be My Valentine?';
$btn_yes_text   = get_field( 'valentine_btn_yes' ) ?: 'Yes! 💍';
$btn_no_text    = get_field( 'valentine_btn_no' ) ?: 'No 😢';
$celebration_text = get_field( 'valentine_celebration' ) ?: "I knew you'd say yes! 🎉";
$redirect_url   = get_field( 'valentine_redirect_url' );
if ( empty( $redirect_url ) ) {
    $redirect_url = home_url( '/yes/' );
}

$music_field = get_field( 'valentine_music' );
$music_url = ( is_array( $music_field ) && ! empty( $music_field['url'] ) ) ? esc_url( $music_field['url'] ) : esc_url( $default_music );
?>

    <div class="min-h-screen bg-gradient-to-br from-pink-100 via-red-50 to-rose-100 flex items-center justify-center relative overflow-hidden py-12 md:py-16">

        <div id="hearts-container" class="absolute inset-0 pointer-events-none"></div>

        <audio id="bg-music" loop preload="auto" autoplay>
            <source src="<?php echo $music_url; ?>" type="audio/mpeg">
        </audio>

        <button id="music-toggle" type="button" class="absolute top-6 right-6 z-50 bg-white/80 backdrop-blur-sm p-3 rounded-full shadow-lg hover:scale-110 transition-transform duration-300 group" aria-label="Reproducir o pausar música">
            <span id="music-icon" class="text-2xl">🎵</span>
            <span class="absolute right-full mr-2 top-1/2 -translate-y-1/2 bg-black/75 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Click para música</span>
        </button>

        <div class="relative z-10 max-w-lg mx-4 text-center valentine-main-content lg:py-[3.125rem]">

            <div class="mb-6 animate-float lg:pt-[3.125rem]">
                <span class="text-5xl">💝</span>
            </div>

            <h1 class="valentine-title text-4xl md:text-6xl font-bold text-valentine-red mb-8 drop-shadow-lg animate-fade-in">
                <?php echo esc_html( $title ); ?>
            </h1>

            <!-- Solo el gatito con corazón -->
            <div class="mb-10 flex justify-center">
                <div class="relative inline-block valentine-cat-hero">
                    <img
                        src="<?php echo esc_url( $theme_uri . '/assets/images/heart-i-love-you.gif' ); ?>"
                        alt=""
                        class="w-48 h-48 md:w-64 md:h-64 object-contain rounded-3xl border-4 border-white shadow-2xl transform hover:scale-105 transition-transform duration-500"
                    >
                </div>
            </div>

            <div class="button-area flex flex-row flex-wrap gap-4 md:gap-6 justify-center items-center">

                <button
                    id="btn-yes"
                    type="button"
                    data-redirect-url="<?php echo esc_attr( $redirect_url ); ?>"
                    class="bg-gradient-to-r from-valentine-red to-valentine-pink hover:from-red-600 hover:to-rose-500 text-white font-bold py-4 px-12 rounded-full text-xl shadow-lg transform hover:scale-110 transition-all duration-300 hover:shadow-2xl border-4 border-white/50"
                >
                    <?php echo esc_html( $btn_yes_text ); ?>
                </button>

                <button
                    id="btn-no"
                    type="button"
                    class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-4 px-12 rounded-full text-xl shadow-lg border-4 border-white/50 no-select"
                >
                    <?php echo esc_html( $btn_no_text ); ?>
                </button>
            </div>

            <div id="celebration" class="hidden mt-8 animate-bounce">
                <p class="text-2xl md:text-3xl font-bold text-valentine-red mb-4"><?php echo esc_html( $celebration_text ); ?></p>
                <div class="text-5xl">🌹💑🎊</div>
            </div>
        </div>
    </div>

<?php wp_footer(); ?>
</body>
</html>
