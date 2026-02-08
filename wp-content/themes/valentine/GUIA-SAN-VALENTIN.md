# Guía: Regalo de San Valentín en WordPress

Tema **Valentine** con Tailwind local, página “Will You Be My Valentine?”, botón “No” huidizo, gatitos y música de fondo.

---

## Requisitos previos

- WordPress instalado (ya lo tienes).
- PHP 7.4+.
- Node.js y npm (para compilar Tailwind localmente, sin CDN).

---

## Paso 1: Estructura del tema

El tema está en:

```
wp-content/themes/valentine/
├── assets/
│   ├── css/
│   │   ├── valentine.css      ← generado por Tailwind (npm run build)
│   │   └── valentine-extra.css
│   ├── images/
│   │   ├── heart-i-love-you.gif
│   │   ├── peachcat-cat.gif
│   │   ├── cats-kittens.gif
│   │   └── ... (resto de GIFs)
│   └── js/
│       └── valentines.js
├── template-valentine.php
├── functions.php
├── style.css
├── index.php
├── input.css           ← fuente de Tailwind
├── tailwind.config.js
├── package.json
└── GUIA-SAN-VALENTIN.md (esta guía)
```

---

## Paso 2: Activar el tema

1. En WordPress: **Apariencia → Temas**.
2. Activa el tema **Valentine** (o el tema hijo si usas uno).
3. El tema Valentine usa como padre **Twenty Twenty-Four** (`Template: twentytwentyfour` en `style.css`). Si no lo tienes, instala el tema “Twenty Twenty-Four” desde Apariencia → Añadir.

---

## Paso 3: Subir la música (si no está)

1. **Medios → Añadir nuevo**.
2. Sube el archivo: `01.-Alex-Warren-Ordinary-Wedding-Version.mp3`.
3. La ruta que usa el tema es:  
   `wp-content/uploads/AÑO/MES/01.-Alex-Warren-Ordinary-Wedding-Version.mp3`  
   Por ejemplo: `uploads/2026/02/01.-Alex-Warren-Ordinary-Wedding-Version.mp3`.

Si ya está en `wp-content/uploads/2026/02/...`, no hace falta hacer nada.

---

## Paso 4: Crear la página de San Valentín

1. **Páginas → Añadir**.
2. Título: por ejemplo **“San Valentín”** o **“Will You Be My Valentine?”**.
3. No hace falta escribir contenido en el editor.
4. En el panel derecho, en **Atributos de página** (o **Plantilla**), elige: **“Página de San Valentín”**.
5. Publica la página.
6. Abre la URL de esa página (ej.: `http://www.valentine.local.com/san-valentin/`).

---

## Paso 5: Tailwind (todo local, sin internet)

Tailwind se compila en tu máquina; no se usa CDN.

1. Abre una terminal en la carpeta del tema:
   ```bash
   cd /srv/http/valentine/wp-content/themes/valentine
   ```
2. Instalar dependencias (solo la primera vez):
   ```bash
   npm install
   ```
3. Compilar CSS:
   ```bash
   npm run build
   ```
   Esto genera/actualiza `assets/css/valentine.css`.

Cada vez que cambies clases de Tailwind en `template-valentine.php` o en `input.css`, vuelve a ejecutar `npm run build`.

Para desarrollo con recarga automática al guardar:
```bash
npm run watch
```
Dejas la terminal abierta mientras editas.

---

## Paso 6: Probar en local (testing)

1. Asegúrate de que tu servidor local (XAMPP, Laragon, `php -S`, etc.) esté levantado y que la URL de WordPress sea la correcta (ej. `http://www.valentine.local.com` o `http://localhost/valentine`).
2. Entra en la página que tiene la plantilla “Página de San Valentín”.
3. Comprueba:
   - Frase **“Will You Be My Valentine?”** en inglés.
   - Texto **“1 year + 2 months”** (y “Together for” / “And many more to come!”).
   - Dos gatitos (GIFs): `heart-i-love-you.gif` y `peachcat-cat.gif`.
   - Botón **Yes**: al pulsar, mensaje de celebración y confeti.
   - Botón **No**: al acercar el ratón, el botón se mueve y no se puede pulsar.
   - Música: se intenta reproducir al cargar; si el navegador la bloquea, al hacer el primer click en la página o en el botón de música debería empezar. El botón 🎵 arriba a la derecha enciende/apaga la música.

Si algo no se ve (estilos o animaciones), revisa que hayas ejecutado `npm run build` y que no haya errores en la consola del navegador (F12).

---

## Paso 7: Desplegar en algún lugar (gratis)

Opciones típicas para dejar la página accesible por internet sin coste:

### A) WordPress.com (plan gratuito)

- Crea una cuenta en [wordpress.com](https://wordpress.com).
- Crea un sitio y elige tema (puede ser uno por defecto).
- En el plan gratuito **no puedes subir temas personalizados** (solo temas de su directorio). Para usar este tema tal cual necesitarías un plan de pago.  
- Alternativa: recrear el contenido a mano en una página con el editor de bloques y un tema que se parezca (sin el botón “No” huidizo ni la lógica exacta).

### B) Hosting gratuito con WordPress (por ejemplo 000webhost, InfinityFree)

- Regístrate en un hosting gratuito que permita WordPress (o instala WordPress tú en el hosting).
- Sube la carpeta del tema `valentine` por FTP o gestor de archivos a `wp-content/themes/valentine`.
- Sube el MP3 a **Medios** para que esté en `wp-content/uploads/...`.
- Crea la página y asígnale la plantilla “Página de San Valentín”.
- En el servidor **no hace falta Node.js**: solo subes el `valentine.css` ya generado (el que tienes después de `npm run build` en tu PC).

### C) VPS / servidor propio (ej. Oracle Cloud Free Tier, AWS Free Tier)

- Tienes un servidor con PHP y base de datos.
- Instalas WordPress y subes el tema `valentine` completo (incluido `assets/css/valentine.css`).
- Configuras el dominio o IP y accedes a la página de San Valentín.

### D) Exportar solo la página estática (sin WordPress)

Si en el futuro quisieras una versión estática (solo HTML/CSS/JS):

- Podrías guardar el HTML generado por la plantilla, copiar `valentine.css` y `valentine-extra.css`, el JS y las imágenes/GIFs, y subir eso a **GitHub Pages**, **Netlify** o **Vercel** (planes gratuitos). La música tendría que estar en una URL pública (por ejemplo en el mismo sitio). Esto requiere adaptar un poco las rutas (ya no serían de WordPress).

Para tu caso actual (WordPress + tema Valentine), la opción más directa es **B** o **C**: subir el tema completo y el MP3 a un hosting que permita WordPress.

---

## Resumen rápido

| Paso | Acción |
|------|--------|
| 1 | Revisar que la estructura del tema esté como arriba. |
| 2 | Activar tema **Valentine** (y tener Twenty Twenty-Four instalado). |
| 3 | Tener el MP3 en Medios (ruta `uploads/...`). |
| 4 | Crear una página y asignar plantilla **“Página de San Valentín”**. |
| 5 | En tu PC: `npm install` y `npm run build` en la carpeta del tema. |
| 6 | Abrir la página en el navegador y probar botones, música y gatitos. |
| 7 | Para publicar: subir tema + MP3 a un hosting con WordPress (o VPS) y repetir pasos 2, 3 y 4. |

Todo el CSS y la lógica están en el tema; no se usa CDN ni ACF. Tailwind se compila localmente con `npm run build`.
