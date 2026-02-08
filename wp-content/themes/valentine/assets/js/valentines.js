document.addEventListener('DOMContentLoaded', function() {
    const btnNo = document.getElementById('btn-no');
    const btnYes = document.getElementById('btn-yes');
    const celebration = document.getElementById('celebration');
    const musicToggle = document.getElementById('music-toggle');
    const bgMusic = document.getElementById('bg-music');
    const musicIcon = document.getElementById('music-icon');
    let isPlaying = false;
    let musicStartedOnce = false;

    // Intentar reproducir música al cargar la página (algunos navegadores lo permiten)
    function tryStartMusic() {
        if (musicStartedOnce) return;
        musicStartedOnce = true;
        bgMusic.play().then(function() {
            isPlaying = true;
            if (musicIcon) musicIcon.textContent = '🎶';
        }).catch(function() {});
    }

    // Reproducir música nada más cargar la página
    if (bgMusic) {
        bgMusic.play().then(function() {
            isPlaying = true;
            if (musicIcon) musicIcon.textContent = '🎶';
        }).catch(function() {});
    }
    tryStartMusic();

    // Si el navegador bloqueó autoplay, iniciar en el primer click o toque
    function startMusicOnFirstInteraction() {
        tryStartMusic();
        document.body.removeEventListener('click', startMusicOnFirstInteraction);
        document.body.removeEventListener('touchstart', startMusicOnFirstInteraction);
    }
    document.body.addEventListener('click', startMusicOnFirstInteraction);
    document.body.addEventListener('touchstart', startMusicOnFirstInteraction, { passive: true });

    // --- Botón NO huidizo: se mueve al acercar el mouse para que no se pueda tocar ---
    function moveButton(e) {
        if (!btnNo) return;
        const button = btnNo;
        const buttonRect = button.getBoundingClientRect();
        const mouseX = e.clientX;
        const mouseY = e.clientY;

        const buttonCenterX = buttonRect.left + buttonRect.width / 2;
        const buttonCenterY = buttonRect.top + buttonRect.height / 2;

        const distance = Math.sqrt(
            Math.pow(mouseX - buttonCenterX, 2) +
            Math.pow(mouseY - buttonCenterY, 2)
        );

        if (distance < 150) {
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;

            let newX = Math.random() * (viewportWidth - buttonRect.width - 40) + 20;
            let newY = Math.random() * (viewportHeight - buttonRect.height - 40) + 20;

            const minDistance = 200;
            const distToMouse = Math.sqrt(
                Math.pow(newX - mouseX, 2) +
                Math.pow(newY - mouseY, 2)
            );

            if (distToMouse < minDistance) {
                newX = mouseX > viewportWidth / 2 ? mouseX - 250 : mouseX + 250;
                newY = mouseY > viewportHeight / 2 ? mouseY - 250 : mouseY + 250;
                newX = Math.max(20, Math.min(viewportWidth - buttonRect.width - 20, newX));
                newY = Math.max(20, Math.min(viewportHeight - buttonRect.height - 20, newY));
            }

            button.style.position = 'fixed';
            button.style.left = newX + 'px';
            button.style.top = newY + 'px';
            button.style.transform = 'none';

            var texts = ['No 😢', 'Sure? 🤔', 'Think about it 😰', 'Please 🥺', 'Nooo 😭'];
            button.textContent = texts[Math.floor(Math.random() * texts.length)];
        }
    }

    document.addEventListener('mousemove', moveButton);

    btnNo.addEventListener('mouseenter', function(e) {
        moveButton({ clientX: e.clientX, clientY: e.clientY });
    });

    btnNo.addEventListener('touchstart', function(e) {
        e.preventDefault();
        var touch = e.touches[0];
        moveButton({ clientX: touch.clientX, clientY: touch.clientY });
    });

    btnNo.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    // --- Botón SÍ ---
    btnYes.addEventListener('click', function() {
        const redirectUrl = this.getAttribute('data-redirect-url');
        
        celebration.classList.remove('hidden');
        createConfetti();
        if (navigator.vibrate) {
            navigator.vibrate([100, 50, 100, 50, 200]);
        }
        tryStartMusic();
        if (!isPlaying) {
            bgMusic.play();
            isPlaying = true;
            if (musicIcon) musicIcon.textContent = '🎶';
        }
        this.style.transform = 'scale(1.2)';
        this.textContent = 'I love you! ❤️';
        setTimeout(function() {
            btnYes.style.transform = 'scale(1.1)';
        }, 300);
        
        // Redirigir después de mostrar el mensaje (2.5 segundos)
        if (redirectUrl && redirectUrl.trim() !== '') {
            setTimeout(function() {
                window.location.href = redirectUrl;
            }, 2500);
        }
    });

    // Control de música (toggle)
    musicToggle.addEventListener('click', function() {
        if (isPlaying) {
            bgMusic.pause();
            if (musicIcon) musicIcon.textContent = '🎵';
        } else {
            bgMusic.play();
            if (musicIcon) musicIcon.textContent = '🎶';
        }
        isPlaying = !isPlaying;
    });

    function createConfetti() {
        var colors = ['#e11d48', '#fb7185', '#fda4af', '#fbbf24', '#f59e0b', '#ec4899'];
        for (var i = 0; i < 50; i++) {
            (function(j) {
                setTimeout(function() {
                    var confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                    document.body.appendChild(confetti);
                    setTimeout(function() { confetti.remove(); }, 4000);
                }, j * 50);
            })(i);
        }
    }

    function createFloatingHearts() {
        var container = document.getElementById('hearts-container');
        if (!container) return;
        var hearts = ['❤️', '💕', '💖', '💗', '💝', '💘'];
        setInterval(function() {
            var heart = document.createElement('div');
            heart.textContent = hearts[Math.floor(Math.random() * hearts.length)];
            heart.style.position = 'absolute';
            heart.style.left = Math.random() * 100 + '%';
            heart.style.top = '-50px';
            heart.style.fontSize = (Math.random() * 20 + 10) + 'px';
            heart.style.opacity = Math.random() * 0.5 + 0.1;
            heart.style.animation = 'float ' + (Math.random() * 3 + 4) + 's linear forwards';
            heart.style.pointerEvents = 'none';
            container.appendChild(heart);
            setTimeout(function() { heart.remove(); }, 7000);
        }, 800);
    }

    createFloatingHearts();
});
