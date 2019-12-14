<?php

namespace App\Http\Requests;

use App\Profile;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        preg_match('~/profile/(.+)$~',$this->url(),$matches);
        return $this->user()->can('update', Profile::find($matches[1]));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|',
            'image' => '',
        ];
    }
}
