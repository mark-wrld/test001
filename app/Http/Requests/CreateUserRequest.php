<?php

namespace App\Http\Requests;

use App\Regex\PhoneRegex;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullName' => 'required|string|min:2|max:250',
            'country' => 'required|string|min:2|max:200',
            'phone' => 'required|string|unique:phone_book|regex:#' . PhoneRegex::getRegex() . '#',
            'email' => 'required|unique:users|email:rfc,dns'
        ];
    }

    public function getUserData()
    {
        return [
            'full_name' => $this->input('fullName'),
            'email' => $this->input('email'),
        ];
    }

    public function getPhoneBookData()
    {
        return [
            'phone' => $this->input('phone'),
        ];
    }

    public function getUserCountryData()
    {
        return [
            'name' => $this->input('country'),
        ];
    }
}
