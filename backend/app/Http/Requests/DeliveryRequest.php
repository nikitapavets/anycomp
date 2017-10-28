<?php

namespace App\Http\Requests;

class DeliveryRequest extends Request
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
            'delivered_at' => 'required|date|before:now',
            'employee_id' => 'exists:admins,id',
        ];
    }
}
