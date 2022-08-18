<?php

namespace App\Domains\Product\Http\Requests;

use App\Core\Traits\ResponseJSON;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ProductSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }

    use ResponseJSON;

    /**
     * Change form request failure response
     *
     * @param Validator $validator
     * @return HttpResponseException 
     */
    protected function failedValidation(Validator $validator)
    {

        $response = $this->response([
            'message' => $validator->errors()->first(),
        ], Response::HTTP_BAD_REQUEST);

        throw new HttpResponseException($response);
    }
}
