<?php
/*
Template Name: Página San Valentín - Sí (celebración)
*/
$theme_uri = get_stylesheet_directory_uri();
$default_music = content_url( '/uploads/2026/02/01.-Alex-Warren-Ordinary-Wedding-Version.mp3' );
$music_field = get_field( 'valentine_yes_music' );
$music_url = ( is_array( $music_field ) && ! empty( $music_field['url'] ) ) ? esc_url( $music_field['url'] ) : esc_url( $default_music );

$title_yes  = get_field( 'valentine_yes_title' ) ?: "I knew you'd say yes! 🎉";
$subtitle   = get_field( 'valentine_yes_subtitle' ) ?: 'Thank you for being my Valentine. I love you! 💕';
$together   = get_field( 'valentine_yes_together' ) ?: 'Together for';
$more       = get_field( 'valentine_yes_more' ) ?: 'And many more to come! 🌹';
// Contador "Together for": desde las 00:00 de la fecha de inicio, hora de Cuba.
// El PHP pinta el valor inicial y el JS de abajo lo actualiza cada segundo.
$start_date = get_field( 'valentine_yes_start' ) ?: '2025-01-14';
$counter_tz = new DateTimeZone( 'America/Havana' );
$counter_start = DateTimeImmutable::createFromFormat( '!Y-m-d', $start_date, $counter_tz ) ?: new DateTimeImmutable( '2025-01-14', $counter_tz );
$counter_now = new DateTimeImmutable( 'now', $counter_tz );
$elapsed = valentine_counter_parts( $counter_start, $counter_now );
$counter_units = array(
    'years'   => array( $elapsed['years'], 'year', 'years' ),
    'months'  => array( $elapsed['months'], 'month', 'months' ),
    'days'    => array( $elapsed['days'], 'day', 'days' ),
    'hours'   => array( $elapsed['hours'], 'hour', 'hours' ),
    'minutes' => array( $elapsed['minutes'], 'min', 'min' ),
    'seconds' => array( $elapsed['seconds'], 'sec', 'sec' ),
);

// Gatitos alrededor en escritorio (6). En el centro móvil se usa cats-kittens.gif; aquí usamos cutecats-kitten para no repetir.
$yes_cats = array(
    'peachcat-cat.gif',
    'mochi-mochi-peach-cat.gif',
    'hearts-heart-cats.gif',
    'rr.gif',
    'seviyorum.gif',
    'cutecats-kitten.gif',
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html( $title_yes ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div class="valentine-yes-wrap min-h-screen bg-gradient-to-br from-rose-100 via-pink-50 to-red-50 flex items-center justify-center relative overflow-hidden">

        <div id="hearts-container" class="absolute inset-0 pointer-events-none"></div>

        <audio id="bg-music" loop preload="auto" autoplay>
            <source src="<?php echo $music_url; ?>" type="audio/mpeg">
        </audio>

        <button id="music-toggle" type="button" class="absolute top-6 right-6 z-50 bg-white/80 backdrop-blur-sm p-3 rounded-full shadow-lg hover:scale-110 transition-transform duration-300 group" aria-label="Reproducir o pausar música">
            <span id="music-icon" class="text-2xl">🎵</span>
            <span class="absolute right-full mr-2 top-1/2 -translate-y-1/2 bg-black/75 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Click para música</span>
        </button>

        <!-- Gatitos alrededor en escritorio: 6 posiciones, mismo tamaño, última es cutecats-kitten -->
        <div class="yes-cats-around absolute inset-0 pointer-events-none z-0 hidden md:block" aria-hidden="true">
            <div class="yes-cat-box absolute" style="top: 1.5rem; left: 1.5rem;">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $yes_cats[0] ); ?>" alt="" class="yes-cat-img">
            </div>
            <div class="yes-cat-box absolute" style="top: 1.5rem; right: 1.5rem;">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $yes_cats[1] ); ?>" alt="" class="yes-cat-img">
            </div>
            <div class="yes-cat-box absolute" style="top: 50%; transform: translateY(-50%); left: 1.5rem;">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $yes_cats[2] ); ?>" alt="" class="yes-cat-img">
            </div>
            <div class="yes-cat-box absolute" style="top: 50%; transform: translateY(-50%); right: 1.5rem;">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $yes_cats[3] ); ?>" alt="" class="yes-cat-img">
            </div>
            <div class="yes-cat-box absolute" style="bottom: 1.5rem; left: 1.5rem;">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $yes_cats[4] ); ?>" alt="" class="yes-cat-img">
            </div>
            <div class="yes-cat-box absolute" style="bottom: 1.5rem; right: 1.5rem;">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $yes_cats[5] ); ?>" alt="" class="yes-cat-img">
            </div>
        </div>

        <div class="valentine-yes-content relative z-10 w-full max-w-xl mx-4 px-4 text-center">

            <div class="valentine-yes-header mb-6">
                <div class="mb-4 animate-float inline-block valentine-yes-emoji">💑</div>
                <h1 class="valentine-title valentine-yes-title text-3xl md:text-5xl font-bold text-valentine-red mb-4 drop-shadow-lg">
                    <?php echo esc_html( $title_yes ); ?>
                </h1>
                <p class="valentine-yes-subtitle text-lg md:text-xl text-gray-700 leading-relaxed max-w-xl mx-auto mb-6">
                    <?php echo esc_html( $subtitle ); ?>
                </p>
            </div>

            <!-- Una sola fotito en móvil (orden: título, subtítulo, fotito, resto) -->
            <div class="flex justify-center mb-8 md:hidden">
                <img
                    src="<?php echo esc_url( $theme_uri . '/assets/images/cats-kittens.gif' ); ?>"
                    alt=""
                    class="w-48 h-48 object-contain rounded-2xl border-4 border-white shadow-xl"
                >
            </div>

            <!-- Bloque Together for centrado horizontalmente -->
            <div class="valentine-yes-card bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 mb-10 shadow-xl border-2 border-valentine-pink/30 max-w-md mx-auto text-center">
                <p class="valentine-yes-card-label text-gray-700 text-lg mb-3">💕 <?php echo esc_html( $together ); ?></p>
                <div class="valentine-yes-card-numbers valentine-yes-counter text-valentine-red font-bold text-2xl md:text-3xl" data-start="<?php echo esc_attr( $counter_start->format( 'Y-m-d' ) ); ?>" data-tz="America/Havana">
                    <?php foreach ( $counter_units as $unit => $parts ) : ?>
                        <div class="bg-valentine-rose/30 rounded-xl p-3 min-w-[72px]">
                            <span data-unit="<?php echo esc_attr( $unit ); ?>"><?php echo in_array( $unit, array( 'hours', 'minutes', 'seconds' ), true ) ? sprintf( '%02d', $parts[0] ) : (int) $parts[0]; ?></span>
                            <span class="block text-sm font-normal text-gray-600" data-label="<?php echo esc_attr( $parts[1] . '|' . $parts[2] ); ?>"><?php echo esc_html( 1 === $parts[0] ? $parts[1] : $parts[2] ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="text-valentine-red mt-4 font-medium valentine-yes-card-more"><?php echo esc_html( $more ); ?></p>
            </div>

            <div class="font-size-responsive valentine-yes-emojis text-5xl mb-10">🌕🧡🌹🌈🌑</div>

            <!-- Botón humor: "Would you want to break up with me?" → popup con gatita riendo -->
            <button type="button" id="btn-breakup" class="text-sm md:text-base text-gray-500 hover:text-valentine-red border border-gray-300 hover:border-valentine-pink rounded-full px-4 py-2 transition-colors">
                Would you ever want to break up with me? 😢
            </button>
        </div>
    </div>

    <!-- Popup: gatita riendo + mensaje "we're never breaking up" -->
    <div id="popup-breakup" class="valentine-popup-overlay hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50" aria-hidden="true">
        <div class="valentine-popup-box">
            <img src="<?php echo esc_url( $theme_uri . '/assets/images/orange-cat-laughing.gif' ); ?>" alt="" class="valentine-popup-cat">
            <p class="valentine-popup-title">We're never breaking up! 😂❤️</p>
            <p class="valentine-popup-text">No matter what you tap — you're stuck with me forever. No take-backs!</p>
            <button type="button" id="popup-breakup-close" class="valentine-popup-btn">
                Yes, I'm stuck with you
            </button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var bgMusic = document.getElementById('bg-music');
        var musicToggle = document.getElementById('music-toggle');
        var musicIcon = document.getElementById('music-icon');
        var isPlaying = false;

        function tryPlay() {
            if (!bgMusic) return;
            bgMusic.play().then(function() {
                isPlaying = true;
                if (musicIcon) musicIcon.textContent = '🎶';
            }).catch(function() {});
        }
        tryPlay();

        if (musicToggle && bgMusic) {
            musicToggle.addEventListener('click', function() {
                if (isPlaying) { bgMusic.pause(); if (musicIcon) musicIcon.textContent = '🎵'; }
                else { bgMusic.play(); if (musicIcon) musicIcon.textContent = '🎶'; }
                isPlaying = !isPlaying;
            });
        }

        var container = document.getElementById('hearts-container');
        if (container) {
            var hearts = ['❤️', '💕', '💖', '💗', '💝', '💘'];
            setInterval(function() {
                var heart = document.createElement('div');
                heart.textContent = hearts[Math.floor(Math.random() * hearts.length)];
                heart.style.position = 'absolute';
                heart.style.left = Math.random() * 100 + '%';
                heart.style.top = '-50px';
                heart.style.fontSize = (Math.random() * 16 + 8) + 'px';
                heart.style.opacity = Math.random() * 0.4 + 0.1;
                heart.style.animation = 'float ' + (Math.random() * 3 + 4) + 's linear forwards';
                heart.style.pointerEvents = 'none';
                container.appendChild(heart);
                setTimeout(function() { heart.remove(); }, 7000);
            }, 900);
        }

        var btnBreakup = document.getElementById('btn-breakup');
        var popupBreakup = document.getElementById('popup-breakup');
        var popupClose = document.getElementById('popup-breakup-close');
        if (btnBreakup && popupBreakup) {
            btnBreakup.addEventListener('click', function() {
                popupBreakup.classList.remove('hidden');
                popupBreakup.setAttribute('aria-hidden', 'false');
            });
        }
        if (popupClose && popupBreakup) {
            popupClose.addEventListener('click', function() {
                popupBreakup.classList.add('hidden');
                popupBreakup.setAttribute('aria-hidden', 'true');
            });
        }
        if (popupBreakup) {
            popupBreakup.addEventListener('click', function(e) {
                if (e.target === popupBreakup) {
                    popupBreakup.classList.add('hidden');
                    popupBreakup.setAttribute('aria-hidden', 'true');
                }
            });
        }
    });

    // Contador "Together for": diferencia de calendario en la hora de pared de data-tz.
    (function () {
        var counter = document.querySelector('.valentine-yes-counter');
        if (!counter) return;
        var start = counter.dataset.start.split('-').map(Number);
        var fmt = new Intl.DateTimeFormat('en-US', {
            timeZone: counter.dataset.tz, hourCycle: 'h23',
            year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'
        });
        function nowParts() {
            var p = {};
            fmt.formatToParts(new Date()).forEach(function (x) { p[x.type] = Number(x.value); });
            return p;
        }
        function daysIn(y, m) { return new Date(Date.UTC(y, m, 0)).getUTCDate(); }
        // Mismo cálculo que valentine_counter_parts() en functions.php.
        function render() {
            var n = nowParts();
            var months = (n.year - start[0]) * 12 + (n.month - start[1]);
            if (n.day < Math.min(start[2], daysIn(n.year, n.month))) months--;
            var values = { years: 0, months: 0, days: 0, hours: 0, minutes: 0, seconds: 0 };
            if (months >= 0) {
                var total = (start[1] - 1) + months;
                var ay = start[0] + Math.floor(total / 12), am = total % 12 + 1;
                var ad = Math.min(start[2], daysIn(ay, am));
                values = {
                    years: Math.floor(months / 12), months: months % 12,
                    days: Math.round((Date.UTC(n.year, n.month - 1, n.day) - Date.UTC(ay, am - 1, ad)) / 86400000),
                    hours: n.hour, minutes: n.minute, seconds: n.second
                };
            }
            Object.keys(values).forEach(function (unit) {
                var num = counter.querySelector('[data-unit="' + unit + '"]');
                var label = num.nextElementSibling;
                var forms = label.dataset.label.split('|');
                num.textContent = ['hours', 'minutes', 'seconds'].indexOf(unit) > -1 ? String(values[unit]).padStart(2, '0') : values[unit];
                label.textContent = values[unit] === 1 ? forms[0] : forms[1];
            });
        }
        render();
        setInterval(render, 1000);
    })();
    </script>
<?php wp_footer(); ?>
</body>
</html>
