# Modelos en Laravel

Este documento explica cómo funcionan los **Modelos en Laravel** y cómo estructurarlos correctamente.  
Está orientado a personas que **nunca usaron Laravel** y necesitan una guía clara para empezar.

---

## ¿Qué es un Modelo?
Un **Modelo** en Laravel es una clase en PHP que representa una **tabla en la base de datos**.  
Con los modelos podemos:
- Consultar datos (`Institution::all()`).
- Insertar registros (`Institution::create([...])`).
- Definir relaciones entre tablas (ej: un usuario tiene muchos posts).
- Proteger datos sensibles (ej: nunca exponer contraseñas).

Por convención:
- El **nombre del modelo** va en **PascalCase y en singular** (ej: `Institution`, `User`, `JobCategory`).  
- La **tabla asociada** se llama en **snake_case y plural** (ej: `institutions`, `users`, `job_categories`).  

---

## Estructura recomendada de un Modelo

Ejemplo con `Institution.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory;

    # 1) Campos que se pueden asignar de forma masiva
    protected $fillable = ['name'];

    # 2) Campos que no deben exponerse (ejemplo)
    // protected $hidden = ['password'];

    # 3) Conversión automática de datos (ejemplo)
    // protected function casts(): array
    // {
    //     return [
    //         'created_at' => 'datetime',
    //     ];
    // }

    # 4) Relaciones (ejemplo)
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
```

---

## Explicación de cada parte

### 1. `$fillable`
Define qué columnas se pueden asignar de forma masiva, por ejemplo al crear un registro desde un request.

```php
protected $fillable = ['name'];
```

Esto permite hacer:
```php
Institution::create(['name' => 'UTN']);
```

⚠️ **Nunca pongas la `id` ni campos generados automáticamente** en `$fillable`.

---

### 2. `$hidden`
Define los campos que **no deben mostrarse** al devolver un modelo como JSON o array.

Ejemplo típico:
```php
protected $hidden = ['password', 'remember_token'];
```

---

### 3. `casts()`
Sirve para **convertir tipos de datos automáticamente**.

Ejemplo:
```php
protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
```

Así, cuando leas un campo `created_at`, Laravel lo convierte en un objeto `Carbon` (fecha).

---

### 4. Relaciones
Laravel permite definir relaciones entre tablas de forma sencilla.

Ejemplos:
- **Uno a muchos** (`hasMany` / `belongsTo`):
```php
public function users()
{
    return $this->hasMany(User::class);
}
```

- **Muchos a muchos** (`belongsToMany`):
```php
public function roles()
{
    return $this->belongsToMany(Role::class);
}
```

---

## Buenas prácticas
✅ Usa **PascalCase** para el nombre del modelo (`JobCategory`).  
✅ Usa **snake_case plural** para las tablas (`job_categories`).  
✅ Nunca incluyas `id` en `$fillable`.  
✅ Oculta información sensible con `$hidden`.  
✅ Usa `casts()` para manejar fechas y tipos de datos.  
✅ Declara relaciones (`hasMany`, `belongsTo`, etc.) en el modelo, no en el controlador.

---

## Ejemplo práctico
Supongamos que tenemos **Instituciones y Usuarios**:

- Una institución tiene muchos usuarios.  
- Un usuario pertenece a una institución.

### Modelo `Institution`
```php
class Institution extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
```

### Modelo `User`
```php
class User extends Model
{
    protected $fillable = ['name', 'email'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
```

### Uso en código
```php
$institution = Institution::create(['name' => 'UTN']);
$institution->users()->create(['name' => 'Juan', 'email' => 'juan@mail.com']);

$user = User::first();
echo $user->institution->name; // "UTN"
```

---

## Conclusión
Los **Modelos en Laravel** son la base para trabajar con la base de datos.  
Siguiendo esta estructura (fillable → hidden → casts → relaciones), tendrás un código claro, seguro y fácil de mantener.
