<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
     * @return array <string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $actionMethod = $this->route()->getActionMethod();
        
        $rules = [];
        
        if ($actionMethod == 'store' || $actionMethod == 'update') {
            $rules = $this->updateOrStoreRules();
        } else if ($actionMethod == 'reset') {
            $rules = $this->resetRules();
        }
        // dd($rules);
        return $rules;
    }
    /** 
     * 
     * @return array
     * */  

    public function updateOrStoreRules(): array
    {
        $id = $this->route()->parameter('id');
        
        return [
            'name' => ['required', 'max:255', 'min:2'],
            'username' => ['required','max:255', 'min:3', 'unique:users,username,' . $id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            'phone' => ['required', 'max:9', 'unique:users,phone,' . $id],
            'password' => [ Rule::requiredIf(!(bool)$id), 'min:7', 'max:255'],
            'confirm_password' => ['required_with:password' ,'same:password', 'min:7'],
            'image' => ['nullable', 'sometimes', 'image'],
        ];
    }
        /** 
     * 
     * @return array
     * */ 
    public function resetRules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],   
        ];
    }
}
