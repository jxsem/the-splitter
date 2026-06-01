# The Splitter - Documentación API

Esta carpeta contiene la documentación técnica de **The Splitter**, una aplicación Laravel para gestionar suscripciones compartidas entre múltiples usuarios.

## Modelos Principales

### 1. User (Autenticable)
**Ubicación:** `app/Models/User.php`

Representa a un usuario autenticado en la aplicación. Cada usuario:
- Tiene un email único y contraseña hash
- Puede tener múltiples suscripciones
- Es el propietario de sus suscripciones

**Relaciones:**
- `subscriptions()` - HasMany: Suscripciones del usuario

**Atributos:**
- `id` (integer) - Identificador único
- `name` (string) - Nombre del usuario
- `email` (string) - Email único
- `password` (string) - Contraseña hasheada
- `email_verified_at` (datetime|null) - Verificación de email
- `created_at` (datetime) - Fecha de creación
- `updated_at` (datetime) - Última actualización

---

### 2. Service
**Ubicación:** `app/Models/Service.php`

Representa una plataforma o servicio (Netflix, Spotify, etc.) que puede ser compartida.

**Relaciones:**
- `subscriptions()` - HasMany: Suscripciones de este servicio

**Atributos:**
- `id` (integer) - Identificador único
- `name` (string) - Nombre del servicio
- `price` (float) - Precio del servicio
- `created_at` (datetime) - Fecha de creación
- `updated_at` (datetime) - Última actualización

---

### 3. Subscription
**Ubicación:** `app/Models/Subscription.php`

Actúa como el "pegamento" central conectando usuarios, servicios y miembros. Representa una suscripción compartida.

**Relaciones:**
- `user()` - BelongsTo: Usuario propietario
- `service()` - BelongsTo: Servicio suscrito
- `members()` - HasMany: Miembros que comparten la suscripción

**Atributos:**
- `id` (integer) - Identificador único
- `user_id` (integer FK) - Usuario propietario
- `service_id` (integer FK) - Servicio suscrito
- `price` (float) - Precio total de la suscripción
- `renewal_date` (date) - Fecha de renovación
- `period` (string) - Período (monthly, trimesterly, annually)
- `created_at` (datetime) - Fecha de creación
- `updated_at` (datetime) - Última actualización

---

### 4. Member
**Ubicación:** `app/Models/Member.php`

Representa a una persona que comparte una suscripción (amigos del usuario propietario).

**Relaciones:**
- `subscription()` - BelongsTo: Suscripción a la que pertenece

**Atributos:**
- `id` (integer) - Identificador único
- `subscription_id` (integer FK) - Suscripción
- `name` (string) - Nombre del miembro
- `created_at` (datetime) - Fecha de creación
- `updated_at` (datetime) - Última actualización

---

## Diagrama de Relaciones

```
┌─────────┐
│  User   │ (Autenticable)
└────┬────┘
     │ (hasMany)
     │
     ▼
┌──────────────────┐
│  Subscription    │ (Punto central)
└───┬──────────┬───┘
    │          │
    │ (belongsTo) - Service
    │              (Plataforma)
    │
    ├─ (hasMany)
    │
    ▼
┌─────────┐
│ Member  │ (Compartidores)
└─────────┘
```

## Tecnologías

- **PHP 8.3+** - Lenguaje base
- **Laravel 13** - Framework
- **Inertia.js v2** - SPA moderna
- **Tailwind CSS v3** - Estilos
- **PostgreSQL** - Base de datos
- **phpDocumentor 3** - Generador de documentación

---

## Notas de Desarrollo

1. **Type Hints** - Todos los métodos deben incluir type hints en parámetros y retorno
2. **PHPDoc** - Cada clase y método público debe tener documentación PHPDoc
3. **Validación** - Usar Form Requests para validación en controladores
4. **Relaciones** - Las relaciones se definen explícitamente en los modelos

Para más información sobre la configuración del proyecto, ver `CLAUDE.md` en la raíz.
