#!/usr/bin/env python3
"""Exporta el sitio WordPress local a HTML estático en public/ para GitHub Pages.

Uso: python3 bin/export-static.py [--base http://www.valentine.local.com]

Renderiza cada página con el WordPress local, quita las etiquetas que solo
tienen sentido con WordPress detrás (REST API, feeds, emoji, oEmbed), descarga
los assets que usan las páginas y reescribe todas las URLs a rutas relativas,
para que el sitio funcione en cualquier subruta (p. ej. usuario.github.io/repo/).
"""

import argparse
import re
import shutil
import ssl
import sys
import tempfile
import urllib.error
import urllib.parse
import urllib.request
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
OUT = ROOT / "public"

# URL de la página en WordPress -> fichero de salida.
PAGES = {
    "/": "index.html",
    "/yes/": "yes/index.html",
}

# Etiquetas que dependen de WordPress en servidor y no sirven en estático.
STRIP_PATTERNS = [
    r"<link[^>]+rel=[\"'](?:alternate|EditURI|https://api\.w\.org/|shortlink|canonical|dns-prefetch)[\"'][^>]*>\s*",
    r"<script type=\"speculationrules\">.*?</script>\s*",
    r"<script id=\"wp-emoji-settings\"[^>]*>.*?</script>\s*",
    r"<script type=\"module\">.*?wp-emoji.*?</script>\s*",
    r"<meta name=\"generator\"[^>]*>\s*",
]

CTX = ssl.create_default_context()
CTX.check_hostname = False
CTX.verify_mode = ssl.CERT_NONE


def fetch(url: str) -> bytes:
    with urllib.request.urlopen(url, context=CTX, timeout=30) as resp:
        return resp.read()


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--base", default="http://www.valentine.local.com")
    base = parser.parse_args().base.rstrip("/")
    host_re = re.escape(base).replace(r"/", r"\\?/")

    # Se genera en un directorio temporal y solo sustituye a public/ si todo va bien.
    tmp = Path(tempfile.mkdtemp(prefix=".public-", dir=ROOT))
    try:
        export(base, host_re, tmp)
    except (urllib.error.URLError, OSError) as exc:
        shutil.rmtree(tmp, ignore_errors=True)
        print(f"ERROR: export cancelado, public/ no se ha tocado: {exc}", file=sys.stderr)
        return 1

    leftovers = [p for p in tmp.rglob("*.html") if base.split("//")[1] in p.read_text(encoding="utf-8")]
    if leftovers:
        shutil.rmtree(tmp, ignore_errors=True)
        print("ERROR: quedan URLs locales en: " + ", ".join(p.name for p in leftovers), file=sys.stderr)
        return 1

    if OUT.exists():
        shutil.rmtree(OUT)
    tmp.chmod(0o755)
    tmp.rename(OUT)
    return 0


def export(base: str, host_re: str, out: Path) -> None:
    assets: set[str] = set()
    for page, out_name in PAGES.items():
        html = fetch(base + page).decode("utf-8")
        for pattern in STRIP_PATTERNS:
            html = re.sub(pattern, "", html, flags=re.S | re.I)

        # Assets locales que usa la página (sin query string).
        for match in re.finditer(host_re + r"(\\?/(?:wp-content|wp-includes)[^\"'\s)<>?]*)", html):
            assets.add(match.group(1).replace("\\/", "/"))

        # Rutas relativas según la profundidad del fichero de salida.
        prefix = "../" * out_name.count("/") or "./"
        html = re.sub(r"(" + host_re + r"\\?/[^\"'\s)<>?]*)\?ver=[^\"'\s)<>&]*", r"\1", html)
        html = re.sub(host_re + r"\\?/", prefix, html)

        target = out / out_name
        target.parent.mkdir(parents=True, exist_ok=True)
        target.write_text(html, encoding="utf-8")
        print(f"page  {page} -> public/{out_name}")

    for path in sorted(assets):
        target = out / urllib.parse.unquote(path.lstrip("/"))
        target.parent.mkdir(parents=True, exist_ok=True)
        target.write_bytes(fetch(base + path))
        print(f"asset {path}")


if __name__ == "__main__":
    sys.exit(main())
