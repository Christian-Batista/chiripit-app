<?php

namespace App\Http\Requests\Responses;

class Success
{
    const CREATED = ["cod" => "S-00", "msg" => "Registro guardado."];
    const LOGGED_IN = ["cod" => "S-01", "msg" => "Usuario logueado correctamente."];
}
