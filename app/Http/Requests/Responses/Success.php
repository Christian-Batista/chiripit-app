<?php

namespace App\Http\Requests\Responses;

class Success
{
    const CREATED = ['cod' => 'S-00', 'msg' => 'User created.'];
    const LOGGED_IN = ['cod' => 'S-01', 'msg' => 'Usuario logueado correctamente.'];
    const UPDATED = ['cod' => 'S-02', 'msg' => 'Registro actualizado.'];
    const DELETED = ['cod' => 'S-03', 'msg' => 'Registro Borrado.'];
}
