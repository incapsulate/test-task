<?php

namespace App\Http\Requests;

use App\Exceptions\Custom\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Arr;

abstract class Request extends FormRequest
{

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $error = $this->getFormattedMessage($validator->getMessageBag());

        throw new ValidationException($error);
    }

    public function authorize()
    {
        return true;
    }

    private function getFormattedMessage(\Illuminate\Support\MessageBag $msgBag)
    {
        return Arr::collapse($msgBag->getMessages())[0];
    }

    abstract public function rules();
}
