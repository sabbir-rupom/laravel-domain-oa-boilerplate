<?php

namespace App\Core;

use App\Core\Traits\ResponseJSON;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Specify response type of general http request
     *
     * @var string
     */
    private $responseType;

    public function __construct()
    {
        $this->responseType = config('app.response-type', 'blade');
    }

    use ResponseJSON;

    /**
     * Return blade view data
     *
     * @param  (string|int|array|object|null)[]  $data
     * @param  string  $view
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse
     */
    public function render(array $data = [], string $view = '')
    {
        if ($this->responseType === 'api') {
            return $this->response($data);
        }

        return view($view ? $view : 'index', $data);
    }
}
