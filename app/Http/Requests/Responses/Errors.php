<?php

namespace App\Http\Requests\Responses;

class Errors
{
    const NAME_REQUIRED = ["cod" => "E-00", "msg" => "El nomobre es requerido."];
    const NAME_STRING = ["cod" => "E-01", "msg" => "El nombre debe de ser texto."];
    const LAST_NAME_REQUIRED = ["cod" => "E-02", "msg" => "El apellido es requerido."];
    const LAST_NAME_STRING = ["cod" => "E-03", "msg" => "El apellido debe de ser texto."];
    const EMAIL_REQUIRED = ["cod" => "E-04", "msg" => "El email es obligatorio."];
    const EMAIL_TYPE = ["cod" => "E-05", "msg" => "El email tiene un error de escritura."];
    const EMAIL_UNIQUE = ["cod" => "E-06", "msg" => "Ya existe un usuario con este email."];
    const PASSWORD_REQUIRED = ["cod" => "E-07", "msg" => "La contraseña es obligatoria."];
    const PASSWORD_STRING = ["cod" => "E-08", "msg" => "La contraseña tiene un error en su escritura."];

    const LOGIN_FAIL = ["cod" => "E-10", "msg" => "Error al intentar iniciar sesion."];

    const CONFIRM_PASSWORD_REQUIRED = ["cod" => "E-11", "msg" => "Tiene que confirmar La contraseña"];
    const CONFIRM_PASSWORD_SAME = ["cod" => "E-12", "msg" => "Al confirmar La contraseña deberia de ser la misma que La contraseña principal"];
    const USER_NOT_FOUNT = ["cod" => "E-12", "msg" => "El usuario no tiene una cuenta creada en el sistema"];
}
