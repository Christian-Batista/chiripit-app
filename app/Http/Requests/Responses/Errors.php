<?php

namespace App\Http\Requests\Responses;

class Errors
{
    const NAME_REQUIRED = ["cod" => "E-00", "msg" => "The name field is required."];
    const NAME_STRING = ["cod" => "E-01", "msg" => "The name field must be a string."];
    const LAST_NAME_REQUIRED = ["cod" => "E-02", "msg" => "The last_name field is required."];
    const LAST_NAME_STRING = ["cod" => "E-03", "msg" => "The last_name field must be a string."];
    const EMAIL_REQUIRED = ["cod" => "E-04", "msg" => "The email field is required."];
    const EMAIL_TYPE = ["cod" => "E-05", "msg" => "The email field must be email type."];
    const EMAIL_UNIQUE = ["cod" => "E-06", "msg" => "The email field must be unique."];
    const PASSWORD_REQUIRED = ["cod" => "E-07", "msg" => "The password is required."];
    const PASSWORD_STRING = ["cod" => "E-08", "msg" => "The password must be a string."];
    const EMAIL_EXISTS = ["cod" => "E-09", "msg" => "The user doesn't exist in the database."];

    const LOGIN_FAIL = ["cod" => "E-10", "msg" => "Error when trying to log in the user."];
}
