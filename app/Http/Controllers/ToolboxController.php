<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Types\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolboxController extends Controller
{
    public function imageUpload(Request $request)
    {
        $path = Storage::put('/', $request->image);
        return Storage::url($path);
    }
}
