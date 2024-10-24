<?php

namespace App\Http\Requests;

use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd('kk');
        return [
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns',
            'age' => 'required|integer',
            'role_id' => 'required|integer',
            'password' => 'required|string|max:50',
            'phone_number' => 'required|string',
        ];
        
    }

    protected function failedValidation(Validator $validator){
        // dd("io");

        throw new HttpResponseException(response()->json([
            'success'=>"failure",
            'message'=>"invalid arguments",
            'data'=>$validator->errors()->messages()
        ],422));



        // return response()->json([
        //     'success'=>"failure",
        //     'message'=>"invalid arguments",
        //     'data'=>$validator->errors()->messages()
        // ],422);
    }
}
