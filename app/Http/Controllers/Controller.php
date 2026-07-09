<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\FrontDataTrait;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, FrontDataTrait;
    
    public function __construct()
    {
        $this->shareGlobalData();
    }
    
    protected function shareGlobalData()
    {
        view()->share('smallGallery', $this->getSmallGallery());
    }
}