<?php

use Ramsey\Uuid\Uuid;

if (!function_exists('create_uuid')) {
    function create_uuid()
    {
        return Uuid::uuid4()->toString();
    }
}