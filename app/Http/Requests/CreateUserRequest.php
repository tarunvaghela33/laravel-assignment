<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        if(request()->route('user') > 0){
            return [
                'first_name'        => 'required|min:2|max:55',
                'last_name'         => 'required|min:2|max:55',
                'email'             => 'required|email|unique:users,email,'.request()->route('user'),
                'image'             => 'mimes:png,jpg,jpeg',
                'dob'               => 'required|before:-10 years',
                'age'               => 'required|numeric',
                'home_phone'        => 'required|numeric',
                'mobile_phone'      => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'street_address'    => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
                'city'              => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'state'             => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'zip_code'          => 'required',
            ];
        }else{
            return [
                'first_name'        => 'required|min:2|max:55',
                'last_name'         => 'required|min:2|max:55',
                'email'             => 'required|email|unique:users,email',
                'image'             => 'required|mimes:png,jpg,jpeg',
                'dob'               => 'required|before:-10 years',
                'age'               => 'required|numeric',
                'home_phone'        => 'required|numeric',
                'mobile_phone'      => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'street_address'    => 'required|regex:/([- ,\/0-9a-zA-Z]+)/',
                'city'              => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'state'             => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'zip_code'          => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'regex' => 'Only characters are allowed.',
        ];
    }
}
