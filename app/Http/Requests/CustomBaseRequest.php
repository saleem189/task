<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class CustomBaseRequest extends FormRequest
{
    private string $_action;

    public function __construct()
    {
        parent::__construct();
    }

    private function action(): string
    {
        if (isset($this->_action)) {
            return $this->_action;
        }

        return $this->_action = $this->route()->getActionMethod();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    final public function authorize(): bool
    {
        $action = $this->action().'Authorize';

        if (!method_exists($this, $action)) {
            return true;
        }

        return $this->{$action}();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    final public function rules(): array
    {
        if (!method_exists($this, $this->action())) {
            return [];
        }

        return $this->{$this->action()}();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    final public function validationData(): array
    {
        $action = $this->action().'Data';

        if (!method_exists($this, $action)) {
            return $this->all();
        }

        return $this->{$action}();
    }
}
