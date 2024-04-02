<?php

namespace App\Http\Requests\Responses;

class Success
{
    const CREATED = ["cod" => "S-00", "msg" => "Record created successfully."];
    const LOGGED_IN = ["cod" => "S-01", "msg" => "User logged in correctly."];
}
