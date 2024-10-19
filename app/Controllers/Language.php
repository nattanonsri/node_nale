<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
    public function switch($lang)
    {
        set_language($lang);

        return redirect()->back();
    }
}
