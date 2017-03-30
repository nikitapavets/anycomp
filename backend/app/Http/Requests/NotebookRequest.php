<?php

namespace App\Http\Requests;

/**
 * Class NotebookRequest
 * @package App\Http\Requests
 */
class NotebookRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        switch ($this->method()) {
            case 'POST': {
                $rules = [
                    'message' => 'required',
                    'channel_id' => 'required|integer|exists:channels,id',
                    'user_id' => 'required|integer|exists:users,id',
                ];

                break;
            }
            case 'PUT': {
                $rules = [
                    'message' => 'required',
                    'channel_id' => 'integer|exists:channels,id',
                    'user_id' => 'integer|exists:users,id',
                ];

                break;
            }
            default:
                break;
        }

        return $rules;
    }
}