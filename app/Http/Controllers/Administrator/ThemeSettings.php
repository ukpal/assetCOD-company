<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeSettings extends Controller
{
    // public string $company_logo;
    
    public static function group(): string
    {
        return 'theme';
    }
}
