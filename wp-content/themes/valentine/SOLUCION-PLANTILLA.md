# Solución: La plantilla no aparece en WordPress

Si no ves la plantilla **"Página de San Valentín"** en el selector de plantillas, sigue estos pasos:

## Pasos para solucionarlo:

### 1. **Verificar que el tema esté activado**
   - Ve a **Apariencia → Temas**
   - Asegúrate de que el tema **"Valentine Theme"** esté **activado** (no solo instalado)
   - Si no está activado, haz clic en **"Activar"**

### 2. **Verificar que el tema padre esté instalado**
   - El tema **"Twenty Twenty-Four"** debe estar instalado (no necesariamente activo)
   - Ve a **Apariencia → Temas** y verifica que aparezca en la lista

### 3. **Refrescar la página del editor**
   - En la página que estás editando, **recarga la página** (F5 o Ctrl+R)
   - A veces WordPress necesita refrescar para detectar nuevas plantillas

### 4. **Limpiar caché (si usas plugins de caché)**
   - Si tienes plugins como WP Super Cache, W3 Total Cache, etc., **límpialos**
   - Ve a **Configuración → WP Super Cache** (o el plugin que uses) y haz clic en **"Borrar caché"**

### 5. **Verificar permisos de archivos**
   - Asegúrate de que el archivo `template-valentine.php` tenga permisos de lectura
   - En Linux/Mac: `chmod 644 template-valentine.php`

### 6. **Forzar refresco de WordPress**
   - Ve a **Apariencia → Temas**
   - **Desactiva** el tema Valentine
   - **Actívalo de nuevo**
   - Esto fuerza a WordPress a refrescar las plantillas disponibles

### 7. **Verificar en el editor de páginas**
   - Abre la página que quieres editar
   - En el panel derecho, busca la sección **"Plantilla"** o **"Template"**
   - Haz clic en el menú desplegable
   - Deberías ver **"Página de San Valentín"** en la lista

### 8. **Si aún no aparece, verifica manualmente**
   - Abre el archivo: `wp-content/themes/valentine/template-valentine.php`
   - Verifica que las primeras líneas sean exactamente:
     ```php
     <?php
     /*
     Template Name: Página de San Valentín
     */
     ```
   - No debe haber espacios antes de `<?php`
   - El nombre debe estar exactamente como aparece arriba

### 9. **Alternativa: Usar el editor de código**
   - Si estás en el editor de bloques de WordPress, cambia a **"Editor de código"** (icono de `</>`)
   - Busca la línea que dice `<!-- wp:template-part...` o similar
   - O simplemente guarda la página y recarga

## Si nada funciona:

1. **Desactiva todos los plugins** temporalmente (excepto los esenciales)
2. **Cambia a un tema por defecto** (Twenty Twenty-Four) y vuelve a activar Valentine
3. **Verifica los logs de error** de WordPress en `wp-content/debug.log` (si tienes debug activado)

## Verificación rápida:

Ejecuta esto en la terminal para verificar que el archivo existe y tiene el formato correcto:

```bash
cd /srv/http/valentine/wp-content/themes/valentine
head -5 template-valentine.php
```

Deberías ver:
```
<?php
/*
Template Name: Página de San Valentín
*/
```

---

**Nota importante:** En WordPress moderno (con el editor de bloques), las plantillas de página personalizadas pueden aparecer en diferentes lugares según la versión. Si estás usando WordPress 6.0+, busca la opción **"Cambiar plantilla"** en el panel derecho del editor de páginas.
