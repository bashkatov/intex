<?php

namespace App\Http\Requests\Marker;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'latitude'  => [
                'required',
                'regex:/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,14})?))$/i',
            ],
            'longitude' => [
                'required',
                'regex:/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,14})?))$/i',
            ],
            'comment'   => [
                'nullable',
            ],
            'types'   => [
                'array',
                'required',
                'min:1'
            ],
            'types.*'   => [
                'exists:types,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => 'Необходимо указать широту',
            'latitude.regex'    => 'Неверный формат широты',

            'longitude.required' => 'Необходимо указать долготу',
            'longitude.regex'    => 'Неверный формат долготы',

            'types.*.required' => 'Необходимо указать хотя бы одну категорию',
            'types.*.exists'   => 'Категория не найдена',
        ];
    }
}
