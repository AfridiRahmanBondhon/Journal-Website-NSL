<?php

use App\Action\CloudFlare\CloudFlareStoreAction;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (! function_exists('boilerplate')) {
    function boilerplate()
    {
        // Code Here...
    }
}

if (! function_exists('model')) {
    function model($name)
    {
        $model = '\\App\\Models\\'.$name;

        if (! class_exists($model)) {
            throw new \Exception("Model class '$model' does not exist.");
        }

        return new $model();
    }
}

if (! function_exists('artisan')) {
    function artisan($command)
    {
        $exitCode = Artisan::call($command);

        if ($exitCode === 0) {
            echo "Command '$command' executed successfully.".PHP_EOL;
        } else {
            echo "Command '$command' failed with exit code $exitCode.".PHP_EOL;
        }

        return $exitCode;
    }
}

if (! function_exists('vue_to_server_date')) {
    function vue_to_server_date($value)
    {
        $dateArray = explode(' ', $value);
        $day = $dateArray[0];
        $month = date_parse($value);
        $year = $dateArray[2];
        $date = $year.'-'.$month['month'].'-'.$day;

        return $date;
    }
}

if (! function_exists('is_base64')) {
    function is_base64($string)
    {
        $string = str_replace('data:image/jpeg;base64,', '', $string);
        $string = str_replace(' ', '+', $string);
        $decoded = base64_decode($string, true);

        return ($decoded !== false) && (base64_encode($decoded) === $string);
    }
}

if (! function_exists('base64_to_upload_instance')) {
    function base64_to_upload_instance($base64)
    {
        $baseController = new BaseController();
        $rawImage = $baseController->upload($base64, 'admin', null, $base64 = true);

        $remoteUrl = url('/').'/public/storage/'.$rawImage;
        $fileContents = file_get_contents($remoteUrl);

        $tmpFile = tmpfile();
        fwrite(
            $tmpFile,
            $fileContents
        );

        $tmpFileInfo = stream_get_meta_data($tmpFile);

        $instance = new UploadedFile(
            $tmpFileInfo['uri'],
            basename($remoteUrl),
            mime_content_type($tmpFileInfo['uri']),
            filesize($tmpFileInfo['uri']),
            UPLOAD_ERR_OK,
            true
        );

        return $instance;
    }
}

if (! function_exists('cloudflare')) {
    function cloudflare($file, $folder, $resizeSize, $base64 = false)
    {
        if (empty($file) || $file == 'undefined' || $file == 'null') {
            return;
        }

        if ($base64) {
            $baseController = new BaseController();
            $rawImage = $baseController->upload($file, 'admin', null, $base64 = true);

            $remoteUrl = url('/').'/public/storage/'.$rawImage;
            $fileContents = file_get_contents($remoteUrl);

            $tmpFile = tmpfile();
            fwrite(
                $tmpFile,
                $fileContents
            );

            $tmpFileInfo = stream_get_meta_data($tmpFile);

            $instance = new UploadedFile(
                $tmpFileInfo['uri'],
                basename($remoteUrl),
                mime_content_type($tmpFileInfo['uri']),
                filesize($tmpFileInfo['uri']),
                UPLOAD_ERR_OK,
                true
            );

            $file = $instance;
        }

        $baseFolder = "upload/{$folder}";

        if (config('app.cloudflare_resize')) {
            $cloudFlareStoreAction = new CloudFlareStoreAction();
            $paths = $cloudFlareStoreAction->execute($file, true, $baseFolder, $resizeSize);

            return $paths;
        }

        return use_intervation($file, $baseFolder, $resizeSize);
    }
}

if (! function_exists('use_intervation')) {
    function use_intervation($file, $baseFolder, $resizeSizes)
    {
        $resultArray = [];
        $image = Image::make($file);
        $resizeArray = explode(',', $resizeSizes);

        // Make sure you have the original image...
        $originalFilename = Str::uuid().'.webp';
        $subFolder = "{$baseFolder}/original";
        $path = "{$subFolder}/{$originalFilename}";
        Storage::put($path, $image->encode('webp', 90)->encoded);
        $resultArray['original'] = $path;

        // Now resize the image as per instruction...
        foreach ($resizeArray as $size) {
            [$width, $height] = explode('x', $size);

            if (! is_numeric($width) || ! is_numeric($height)) {
                continue;
            }

            $resizedImage = $image->resize($width, $height);
            $filename = Str::uuid().'.webp';
            $subFolder = "{$baseFolder}/{$size}";

            if (! Storage::exists($subFolder)) {
                Storage::makeDirectory($subFolder);
            }

            Storage::put("{$subFolder}/{$filename}", $resizedImage->encode('webp', 90)->encoded);
            $resultArray["$width".'x'."$height"] = "{$subFolder}/{$filename}";
        }

        return $resultArray;
    }
}

if (! function_exists('backend_password_reset_url')) {
    function backend_password_reset_url($email)
    {
        $token = Str::uuid();
        $expiredAt = time() + (60 * 60 * 2);

        $token = Str::uuid();
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'expired_at' => $expiredAt,
        ]);

        $query = http_build_query([
            'token' => $token,
        ]);

        $data = DB::table('password_resets')->where('email', $email)->first();

        return url("/backend/password-reset?token={$data->token}");
    }
}

if (! function_exists('uuid')) {
    function uuid()
    {
        return Str::uuid();
    }
}

if (! function_exists('without_cache')) {
    function without_cache($path)
    {
        return asset($path).cache_busting($path);
    }
}

if (! function_exists('cache_busting')) {
    function cache_busting($path)
    {
        if (file_exists(public_path($path))) {
            $timestamp = filemtime(public_path($path));
            $version = '?id='.md5($timestamp);

            return $version;
        }

        $alternative = '?id='.md5(time());

        return $alternative;
    }
}
