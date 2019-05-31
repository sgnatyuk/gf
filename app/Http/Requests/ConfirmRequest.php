<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmRequest extends FormRequest
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
            'name'        => 'required|max:255',
            'phone'       => 'required|min:12|max:12',
            'address'     => 'required',
            'tariff_id'   => 'required|exists:tariffs,id',
            'amount_days' => 'required|integer|min:6|max:24',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'Обязательное поле',
            'name.max'           => 'Поле должно быть не более 255 символов',
            'phone.required'     => 'Обязательное поле',
            'phone.min'          => 'Неверный формат',
            'phone.max'          => 'Неверный формат',
            'address.required'   => 'Обязательное поле',
            'tariff_id.required' => 'Обязательное поле',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('phone')) {

            $phone = '+7' . preg_replace('/[^0-9]/', '', $this->phone);

            $this->merge(['phone' => $phone]);
        }
    }
}
