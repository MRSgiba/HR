<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191|unique:books,name',
            'price' => 'numeric|min:0.01|max:9999999.99',
            'author_id' => 'required'
            
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Заполните обязательное поле: название книги',
            'name.max' => 'Длина поля название превышает допустимое количество символов',
            'name.unique' => 'Книга с таким названием уже существует',
            'price.numeric' => 'Поле цена должно быть числом',
            'price.min' => 'Цена должна быть положительным числом',
            'price.max' => 'Цена должна быть меньше 100000000',
            'author_id.required' => 'У каждой книги должен быть автор'
        ];
    }
}
