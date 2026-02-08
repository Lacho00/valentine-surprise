# Guía: Usar ACF con la plantilla de San Valentín

Con el plugin **Advanced Custom Fields (ACF)** puedes editar todos los textos, números e imágenes de la página de San Valentín desde el editor de WordPress, sin tocar código.

---

## 1. Instalar ACF

1. En WordPress: **Plugins → Añadir nuevo**.
2. Busca **"Advanced Custom Fields"**.
3. Instala y **activa** el plugin (versión gratuita basta).

---

## 2. Dónde se configuran los campos

Los campos del San Valentín **no se crean a mano** en ACF. El tema los registra por código. Solo tienes que:

1. **Activar el tema Valentine** y el plugin ACF.
2. Crear o editar una **página** y asignarle la plantilla **"Página de San Valentín"**.
3. En el editor de esa página, **guardar o publicar** una vez.
4. En el panel derecho (o debajo del contenido) verás la caja **"Contenido San Valentín"** con todos los campos.

Si no ves la caja:

- Asegúrate de que la plantilla de la página sea **"Página de San Valentín"**.
- Recarga la página del editor (F5).
- Comprueba que ACF esté activo en **Plugins**.

---

## 3. Campos disponibles

| Campo | Qué es | Valor por defecto |
|--------|--------|--------------------|
| **Título principal** | La frase grande (ej. "Will You Be My Valentine?") | Will You Be My Valentine? |
| **Texto "juntos por"** | Texto encima de años/meses | Together for |
| **Años juntos** | Número de años | 1 |
| **Meses adicionales** | Meses además de los años (0–11) | 2 |
| **Texto debajo del tiempo** | Frase bajo años/meses | And many more to come! 🌹 |
| **Gatito / imagen 1** | Primer GIF (lista de los del tema) | heart-i-love-you.gif |
| **Gatito / imagen 2** | Segundo GIF (o "— Ninguno —") | peachcat-cat.gif |
| **Texto botón Sí** | Texto del botón "Sí" | Yes! 💍 |
| **Texto botón No** | Texto del botón "No" | No 😢 |
| **Mensaje al decir Sí** | Texto que sale al pulsar Sí | I knew you'd say yes! 🎉 |
| **Música de fondo (MP3)** | Archivo de audio (subir o dejar vacío) | (usa el MP3 por defecto del tema) |

Si dejas un campo vacío, se usa el valor por defecto de la tabla.

---

## 4. Imágenes de gatitos (GIFs)

Las opciones del desplegable son los GIFs que hay en el tema:

- **heart-i-love-you** – Gatito con corazón  
- **peachcat-cat** – Peach cat  
- **mochi-mochi-peach-cat** – Mochi Mochi Peach Cat  
- **hearts-heart-cats** – Dos gatos con corazón  
- **rr** – Gatos beso  
- **seviyorum** – Seviyorum  
- **cats-kittens** – Huggies & Kisses  

Para la **imagen 2** puedes elegir **"— Ninguno —"** y solo se mostrará la primera.

---

## 5. Música de fondo

- **Sin ACF / campo vacío:** se usa el MP3 por defecto del tema (por ejemplo `uploads/2026/02/01.-Alex-Warren-Ordinary-Wedding-Version.mp3`).
- **Con ACF:** en **Música de fondo (MP3)** puedes subir otro archivo MP3; la página usará ese en lugar del por defecto.

---

## 6. Sin ACF

Si **no** tienes ACF activo, la plantilla sigue funcionando con los valores por defecto (los mismos que en la tabla de la sección 3). No hace falta instalar ACF para que la página se vea.

---

## 7. Archivos del tema relacionados con ACF

- **`acf-valentine-fields.php`** – Define el grupo de campos (solo se carga si ACF está activo).
- **`functions.php`** – Carga ese archivo en el hook `acf/init`.
- **`template-valentine.php`** – Usa `get_field()` para cada valor y, si no hay valor, usa el valor por defecto.

No es necesario crear grupos de campos a mano en **ACF → Grupos de campos**; el tema ya los registra para la plantilla "Página de San Valentín".
