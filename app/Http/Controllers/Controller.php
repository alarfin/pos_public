<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranch;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function clientCheck($data)
    {
        if (Auth::user()->client_id == $data['client_id']) {
            return true;
        } else {
            abort(404);
        }
    }


    public function getCompanyBranches()
    {
        return CompanyBranch::get();
    }

    public function fileUpload($file, $path, $width = null, $height = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file_url = $path . Str::random(50) . preg_replace('~[\\\\/:*? "<>|@!#%&]~', '-', $file->getClientOriginalName());
        $upload = Image::make($file);
        if ($width && $height) {
            $upload->resize($width, $height);
        }
        $upload->save($file_url);
        return $file_url;
    }
}
