<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Permission;

class PermissionUpdateRequest extends FormRequest
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
        $id = $this->route()->parameter('permission');
        return [
            'name' => 'required|unique:permissions,name,'.$id,
            'description' => 'nullable',
            'permission_roles' => 'array|nullable'
        ];
    }
}
