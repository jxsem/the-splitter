<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email'    => 'Debes introducir un correo electrónico válido.',
    'unique'   => 'Este :attribute ya está en uso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'min'      => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max'      => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'numeric'  => 'El campo :attribute debe ser un número.',
    
    
    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'service_id' => 'servicio',
        'amount' => 'monto',
    ],
];