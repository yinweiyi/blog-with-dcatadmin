<?php

namespace App\Http\Requests;


class CreateHtmlToImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url'    => ['bail', 'required', 'url'],
            'width'  => ['bail', 'integer', 'min:20'],
            'height' => ['bail', 'integer', 'min:20'],
        ];
    }

    public function messages()
    {
        return [
            'url.required'   => '链接地址不能为空',
            'url.url'        => '链接地址格式不正确',
            'width.integer'  => '宽度格式不正确',
            'width.min'      => '宽度必须大于等于:min',
            'height.integer' => '高度格式不正确',
            'height.min'     => '高度必须大于等于:min',
        ];
    }
}
