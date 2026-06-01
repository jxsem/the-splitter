📖 # Documentación del Proyecto - The Splitter

## ✅ Estatus

La documentación del proyecto ha sido **generada exitosamente** usando **phpDocumentor 3.10** con Docker.

## 📍 Ubicaciones

### Documentación interactiva
- **`docs/index.html`** - Página de inicio con resumen visual de modelos y relaciones
- **`docs/api/index.html`** - Documentación HTML completa generada automáticamente

### Archivo de configuración
- **`phpdoc.xml`** - Configuración de phpDocumentor

### Script de utilidad
- **`generate-docs.sh`** - Script para regenerar la documentación fácilmente

## 🚀 Cómo Usar

### Ver la documentación
```bash
# Opción 1: Página de inicio (resumen visual)
open docs/index.html

# Opción 2: Documentación completa
open docs/api/index.html

# Opción 3: Archivo Markdown
cat docs/README.md
```

### Regenerar la documentación
```bash
# Usando el script (recomendado)
./generate-docs.sh

# O manualmente con Docker
docker run --rm -v $(pwd):/data -w /data phpdoc/phpdoc:3.10 \
    -d app,routes,config \
    -t docs/api \
    --title "The Splitter API" \
    --force
```

## 📚 Contenido Documentado

La documentación incluye:

### Modelos Documentados
- ✅ `App\Models\User` - Modelo de usuario autenticado
- ✅ `App\Models\Service` - Modelo de servicio/plataforma
- ✅ `App\Models\Subscription` - Modelo de suscripción compartida
- ✅ `App\Models\Member` - Modelo de miembro/compartidor

### Información Incluida
- 📄 Descripción detallada de cada modelo
- 🔗 Relaciones entre modelos
- 🏷️ Propiedades con tipos de datos
- 🔌 Métodos públicos
- 📊 Diagrama de relaciones

## 🛠️ Tecnologías

- **phpDocumentor 3.10** - Generador de documentación
- **Docker** - Ejecución de phpDocumentor sin conflictos de dependencias
- **PHP 8.3** - Parsing de código
- **Laravel 13** - Framework del proyecto

## 📝 Archivos Mejorados con PHPDoc

Todos los modelos principales ahora tienen documentación PHPDoc completa:
- Descripciones detalladas
- Type hints en propiedades
- Métodos documentados
- Relaciones Eloquent

## ⚠️ Notas

- La documentación se regenera automáticamente analizando el código fuente
- Se ignoran los archivos de configuración del proyecto (config/)
- Las rutas en `routes/` se documentan automáticamente
- Los modelos en `app/Models/` son el foco principal

## 🔄 Próximas Actualizaciones

Para añadir más documentación:
1. Mejora los comentarios PHPDoc en el código
2. Ejecuta `./generate-docs.sh`
3. La documentación se actualizará automáticamente

---

📅 Última actualización: 1 de junio de 2026
🏗️ Proyecto: The Splitter v1.0.0
