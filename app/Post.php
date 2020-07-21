<?php

  namespace App;

  use Illuminate\Database\Eloquent\Model;

  /**
   * Class Post
   * @package App
   *
   * @OA\Schema(
   *   schema="Post",
   *   type="object",
   *
   *   @OA\Property(
   *     property="cd_post",
   *     description="Código do post",
   *     type="integer",
   *   ),
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
   *   ),
   *
   *   @OA\Property(
   *     property="created_at",
   *     description="Data de criação do Post",
   *     type="string",
   *   ),
   *
   *   @OA\Property(
   *     property="updated_at",
   *     description="Data de atualização do Post",
   *     type="string",
   *   ),
   * )
   */
  class Post extends Model
  {
    /**
     * @var string
     */
    protected $primaryKey = "cd_post";

    /**
     * @var array
     */
    protected $guarded = [
      "cd_pessoa"
    ];
  }
