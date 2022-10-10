<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required'
        ]);

        session()->put('language', $request->language);
        return redirect()->back();
    }
}
