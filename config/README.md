# Configuración principal de Laravel: config/app.php

El archivo `config/app.php` es **uno de los archivos de configuración más importantes de Laravel**. Define parámetros globales de la aplicación que afectan su comportamiento general.

---

## 1️⃣ Nombre de la aplicación

```php
'name' => env('APP_NAME', 'Laravel'),
```

* Define el **nombre de la app**.
* Se puede usar en notificaciones, correos, títulos de página, etc.
* Se puede configurar desde el archivo `.env`.

## 2️⃣ Entorno de la aplicación

```php
'env' => env('APP_ENV', 'production'),
```

* Indica si la app está en `local`, `production`, `staging`, etc.
* Determina cómo se configuran servicios y logging.

## 3️⃣ Debug

```php
'debug' => (bool) env('APP_DEBUG', false),
```

* Si `true`, Laravel muestra **detalles completos de errores** y stack traces.
* Si `false`, muestra páginas de error genéricas.

## 4️⃣ URL de la aplicación

```php
'url' => env('APP_URL', 'http://localhost'),
```

* URL base de la aplicación.
* Se usa para generar enlaces correctos en Artisan y en rutas.

## 5️⃣ Zona horaria

```php
'timezone' => 'UTC',
```

* Define la **zona horaria por defecto** de la aplicación.
* Se utiliza en funciones de fecha y hora de PHP.

## 6️⃣ Localización / Idioma

```php
'locale' => env('APP_LOCALE', 'en'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
```

* `locale`: idioma principal de la aplicación.
* `fallback_locale`: idioma alternativo si no hay traducción.
* `faker_locale`: idioma para generar datos de prueba con Faker.

## 7️⃣ Clave de encriptación

```php
'cipher' => 'AES-256-CBC',
'key' => env('APP_KEY'),
'previous_keys' => [...array_filter(explode(',', env('APP_PREVIOUS_KEYS', '')))],
```

* `key`: clave de 32 caracteres usada para cifrado y seguridad.
* `cipher`: algoritmo de encriptación.
* `previous_keys`: mantiene claves antiguas si se cambia la clave principal.

## 8️⃣ Modo mantenimiento

```php
'maintenance' => [
    'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
    'store' => env('APP_MAINTENANCE_STORE', 'database'),
],
```

* Controla el **modo mantenimiento** (`php artisan down/up`).
* `driver`: `'file'` o `'cache'`.
* `store`: `'database'` si quieres guardar el estado en la base de datos.

---

# Configuración de Autenticación en Laravel: config/auth.php

El archivo `config/auth.php` define cómo Laravel maneja **la autenticación de usuarios**, incluyendo guards, providers y restablecimiento de contraseñas.

---

## 1️⃣ Defaults (Valores por defecto)

```php
'defaults' => [
    'guard' => env('AUTH_GUARD', 'web'),
    'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
],
```

* Define el **guard** por defecto y el broker de contraseñas.
* Se puede cambiar desde `.env`.

---

## 2️⃣ Authentication Guards (Guards de autenticación)

```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
],
```

* Un **guard** define cómo se autentican los usuarios.
* `driver`: método de autenticación (`session` para web o `token` para API).
* `provider`: indica de dónde se obtienen los usuarios.

---

## 3️⃣ User Providers (Proveedores de usuarios)

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', App\Models\User::class),
    ],
],
```

* Define **cómo se obtienen los usuarios**.
* `eloquent`: usa modelos de Laravel (`User::class`).
* `database`: usa la tabla directamente.
* Permite múltiples providers si hay diferentes tablas de usuarios.

---

## 4️⃣ Password Reset (Restablecimiento de contraseñas)

```php
'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
        'expire' => 60,
        'throttle' => 60,
    ],
],
```

* `table`: donde se guardan los tokens de reset.
* `expire`: duración en minutos de validez del token.
* `throttle`: segundos que debe esperar el usuario antes de solicitar otro token.

---

## 5️⃣ Password Confirmation Timeout

```php
'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
```

* Tiempo en segundos antes de que se pida nuevamente la contraseña.
* Por defecto son 3 horas (10800 segundos).

---

# Configuración CORS en Laravel: config/cors.php

El archivo `config/cors.php` configura **las políticas de CORS** (Cross-Origin Resource Sharing) para la aplicación. Esto es importante cuando tu frontend (React, Vue, etc.) y backend (Laravel) están en **diferentes dominios o puertos**.

---

## 1️⃣ Paths (Rutas)

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
```

* Define **qué rutas** aplican las reglas de CORS.
* Por ejemplo, todas las rutas de `api/*` y la ruta de `sanctum/csrf-cookie`.

---

## 2️⃣ Allowed Methods (Métodos permitidos)

```php
'allowed_methods' => ['*'],
```

* Qué métodos HTTP están permitidos (`GET`, `POST`, `PUT`, etc.).
* `'*'` permite todos.

---

## 3️⃣ Allowed Origins (Orígenes permitidos)

```php
'allowed_origins' => ['http://localhost:3000'],
```

* Qué dominios pueden hacer requests al backend.
* Aquí el frontend de React corriendo en `localhost:3000` está permitido.

---

## 4️⃣ Allowed Origins Patterns (Patrones de origen)

```php
'allowed_origins_patterns' => [],
```

* Permite usar **expresiones regulares** para definir orígenes.
* Útil si hay múltiples subdominios dinámicos.

---

## 5️⃣ Allowed Headers (Cabeceras permitidas)

```php
'allowed_headers' => ['*'],
```

* Qué headers HTTP pueden enviarse en la request.
* `'*'` permite todos.

---

## 6️⃣ Exposed Headers (Cabeceras expuestas)

```php
'exposed_headers' => [],
```

* Headers que el navegador puede acceder desde la respuesta.

---

## 7️⃣ Max Age

```php
'max_age' => 0,
```

* Tiempo en segundos que el navegador puede cachear la política de CORS.
* `0` significa que no se cachea.

---

## 8️⃣ Supports Credentials (Soporta credenciales)

```php
'supports_credentials' => true,
```

* Si es `true`, permite enviar **cookies o headers de autenticación** en requests cross-origin.

---

# Configuración de Servicios de Terceros en Laravel: config/services.php

El archivo `config/services.php` se utiliza para **almacenar credenciales y configuración de servicios externos** que la aplicación pueda necesitar, como correos, notificaciones o APIs.

---

## 1️⃣ Postmark

```php
'postmark' => [
    'token' => env('POSTMARK_TOKEN'),
],
```

* Configuración para el servicio de correo **Postmark**.
* `token`: clave de API almacenada en `.env`.

---

## 2️⃣ AWS SES (Simple Email Service)

```php
'ses' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
],
```

* Servicio de envío de correos de AWS.
* `key` y `secret`: credenciales de AWS.
* `region`: región de los servicios (por defecto `us-east-1`).

---

## 3️⃣ Resend

```php
'resend' => [
    'key' => env('RESEND_KEY'),
],
```

* Servicio externo de envío de correos.
* `key`: clave API desde `.env`.

---

## 4️⃣ Slack

```php
'slack' => [
    'notifications' => [
        'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
        'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
    ],
],
```

* Configuración para enviar notificaciones a **Slack**.
* `bot_user_oauth_token`: token de autenticación del bot.
* `channel`: canal predeterminado para notificaciones.

---

# Configuración de Sesiones en Laravel: config/session.php

El archivo `config/session.php` permite **configurar cómo Laravel maneja las sesiones** de los usuarios. Las sesiones almacenan información entre peticiones HTTP.

---

## 1️⃣ Driver de sesión

```php
'driver' => env('SESSION_DRIVER', 'file'),
```

* Define dónde se guardan las sesiones.
* Opciones comunes:

  * `file`: archivos en `storage/framework/sessions`
  * `database`: tabla `sessions`
  * `redis`, `memcached`, `cookie`

---

## 2️⃣ Lifetime (Tiempo de vida)

```php
'lifetime' => env('SESSION_LIFETIME', 120),
'expire_on_close' => false,
```

* `lifetime`: minutos que dura la sesión si el usuario está inactivo.
* `expire_on_close`: si `true`, la sesión termina al cerrar el navegador.

---

## 3️⃣ Encryption (Encriptación)

```php
'encrypt' => false,
```

* Define si los datos de sesión se almacenan **encriptados**.
* Recomendado para sesiones sensibles.

---

## 4️⃣ Session Cookie

```php
'cookie' => env('SESSION_COOKIE', Str::slug(env('APP_NAME', 'laravel'), '_').'_session'),
'path' => '/',
domain' => env('SESSION_DOMAIN', null),
'same_site' => 'lax',
```

* `cookie`: nombre de la cookie que almacena la sesión.
* `path`: ruta donde es válida la cookie.
* `domain`: dominio permitido.
* `same_site`: política SameSite (`lax`, `strict`, `none`).

---

## 5️⃣ Other Options

* `secure`: si la cookie solo se envía por HTTPS.
* `http_only`: si la cookie es accesible solo vía HTTP, no JavaScript.
* `lottery`: probabilidad de limpiar sesiones expiradas (solo para driver file).

---

## ✅ Resumen

El archivo `config/session.php` controla **el comportamiento de las sesiones** en Laravel:

* Dónde se almacenan (`driver`)
* Tiempo de vida (`lifetime`)
* Seguridad y encriptación (`encrypt`, `http_only`, `secure`)
* Cookies asociadas a la sesión (`cookie`, `path`, `domain`, `same_site`)

Configurar correctamente este archivo es **clave para la seguridad y consistencia de los datos de los usuarios**.