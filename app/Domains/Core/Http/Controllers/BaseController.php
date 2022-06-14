<?php

namespace App\Domains\Core\Http\Controllers;

use App\Domains\Core\Traits\ResponseJSON;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{
    private $domains;
    private $responseType;

    public function __construct()
    {
        $this->domains = Cache::get('app_domains', []);
        $this->responseType = config('app.response-type', 'blade');
    }

    use ResponseJSON;

    public function render(array $data = [], string $view = '')
    {
        if ($this->responseType === 'api') {
            return $this->response($data);
        }

        return view($view ? $view : 'index', $data);
    }
}
