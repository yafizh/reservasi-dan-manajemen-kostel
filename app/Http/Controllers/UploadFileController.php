<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadFileController extends Controller
{
    public function process(Request $request): string
    {
        $files = $request->allFiles();

        if (empty($files)) {
            abort(422, 'No files were uploaded.');
        }

        // Now that we know there's only one key, we can grab it to get
        // the file from the request.
        $requestKey = array_key_first($files);

        $file = is_array($request->input($requestKey))
            ? $request->file($requestKey)[0]
            : $request->file($requestKey);


        $path = $file->store(
            path: 'temp/' . now()->timestamp . '-' . Str::random(20)
        );

        UploadFile::create([
            'filename' => $path,
            'filename_original' => $file->getClientOriginalName()
        ]);
        return $path;
    }
}
