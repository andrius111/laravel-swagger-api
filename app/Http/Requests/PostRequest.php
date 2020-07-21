<?php

  namespace App\Http\Requests;

  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Contracts\Validation\Validator;
  use Illuminate\Validation\ValidationException;
  use Illuminate\Http\Exceptions\HttpResponseException;
  use Illuminate\Http\JsonResponse;

  /**
   * Class PostRequest
   * @package App\Http\Requests
   *
   * @OA\Schema(
   *   schema="PostRequisicao",
   *   type="object",
   *   required={"nm_post", "ds_post"},
   *
   *   @OA\Property(
   *     property="nm_post",
   *     description="Nome do post",
   *     type="string",
   *   ),
   *
   *   @OA\Property(
   *     property="ds_post",
   *     description="Descrição do post",
   *     type="string",
   *   )
   * ),
   */
  class PostRequest extends FormRequest
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
        "nm_post" => "required",
        "ds_post" => "required",
      ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
      $errors = (new ValidationException($validator))->errors();

      throw new HttpResponseException(
        response()->json(["error" => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
      );
    }
  }
