<?php

// app/Http/Controllers/VendorController.php
namespace App\Http\Controllers;

use App\Imports\MenuImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function uploadMenu(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new MenuImport(auth()->user()->id), $request->file('file'));

        return response()->json(['message' => 'منو با موفقیت آپلود شد']);
    }
}
