<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ApartementStoreRequest extends FormRequest
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
      'number' => 'required|string',
      'additional_cost' => 'required',
      'rent_net' => 'required',
      'rent_gross' => 'required',
      'state' => 'required',
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  public function messages()
  {
    return [
      'number.required' => 'number is required!',
      'additional_cost.required' => 'additional cost is required',
      'rent_net.required' => 'rent net is required',
      'rent_gross.required' => 'rent gross is required',
      'state.required' => 'state is required',
    ];
  }
}
