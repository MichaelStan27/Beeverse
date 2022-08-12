<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLang($lang)
    {
        if (!in_array($lang, ['en', 'id'])) {
            abort(400);
        }

        Session::put('applocale', $lang);
        if (App::isLocale('id')) {
            return redirect()->back()->with('message', "Website language is now changed to $lang");
        }
        return redirect()->back()->with('message', "Bahasa website berubah menjadi $lang");
    }

    public function viewError()
    {
        abort(404);
    }
}
