<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class TestAzureStorageController extends Controller
{
    public function putFile()
    {
        Storage::disk('azure')->put('test.txt', 'ok?');
        echo "uploaded?";
        return;
    }
}