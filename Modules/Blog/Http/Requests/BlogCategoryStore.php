<?php

namespace Modules\Blog\Http\Requests;

use App\Http\Requests\ApiForm;
use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryStore extends ApiForm
{
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
            'title' => 'required',
            'description' => 'required',
        ];
    }
}
