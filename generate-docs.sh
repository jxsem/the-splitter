#!/bin/bash
# Script para generar documentación con phpDocumentor

echo "🔄 Generando documentación con phpDocumentor..."

# Verificar que Docker está corriendo
if ! docker info >/dev/null 2>&1; then
    echo "❌ Docker no está corriendo. Por favor inicia Docker Desktop."
    echo "   open -a Docker"
    exit 1
fi

# Crear directorio de documentación si no existe
mkdir -p docs/api

# Ejecutar phpDocumentor en Docker
docker run --rm -v $(pwd):/data -w /data phpdoc/phpdoc:3.10 \
    -d app,routes,config \
    -t docs/api \
    --title "The Splitter API" \
    --force

if [ $? -eq 0 ]; then
    echo "✅ Documentación generada exitosamente en docs/api/index.html"
    echo ""
    echo "📖 Para ver la documentación:"
    echo "   open docs/api/index.html"
    echo "   open docs/index.html"
else
    echo "❌ Error al generar la documentación"
    exit 1
fi
