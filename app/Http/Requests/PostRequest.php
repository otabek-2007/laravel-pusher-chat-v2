<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class PostRequest extends FormRequest
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
        $actionMethod = $this->route()->getActionMethod();
        $rules = [];
        if($actionMethod == 'store'){
            $rules = $this->storeRules();
        } else if($actionMethod == 'edit'){
            $rules = $this->editRules();
        }
        return $rules;
    }
    public function storeRules(): array
    {
        return 
        [ 
            'title' => ['required', 'max:50','min:2'],
            'body' => ['required', 'max:255'],
            'image' => ['nullable', 'sometimes', 'image'],
            'user_id' => ['nullable']
        ];
    }
    public function editRules(): array
    {
        return 
        [
            'title' => ['required', 'min:2', 'max:50'],
            'body' => ['required', 'min:3', 'max:250'],
            'image' => ['nullable', 'sometimes', 'image'],
        ];
    }
}
