<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    private $arrBlog = [
        [
            "cd_blog" => 1,
            "nm_blog" => "Teste 1",
            "ds_blog" => "Descrição blog 1"
        ],

        [
            "cd_blog" => 2,
            "nm_blog" => "Teste 2",
            "ds_blog" => "Descrição blog 2"
        ],

        [
            "cd_blog" => 3,
            "nm_blog" => "Teste 3",
            "ds_blog" => "Descrição blog 3"
        ],

        [
            "cd_blog" => 4,
            "nm_blog" => "Teste 4",
            "ds_blog" => "Descrição blog 4"
        ],

        [
            "cd_blog" => 5,
            "nm_blog" => "Teste 5",
            "ds_blog" => "Descrição blog 5"
        ],
    ];

    /**
     * @OA\Get(
     *   path="/blogs",
     *   summary="Listagem de blogs",
     *   @OA\Response(
     *     response=200,
     *     description="Lista todas as postagens do blog"
     *   )
     * )
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->arrBlog, JsonResponse::HTTP_OK);
    }

    /**
     * @OA\Get(
     *   path="/blogs/{cd_blog}",
     *   summary="Listar um blog pelo código",
     *   @OA\Parameter(
     *     name="cd_blog",
     *     in="path",
     *     description="Código do blog a ser listado",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64",
     *       example=1
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Mostrará o blog"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Blog não encontrado"
     *   )
     * )
     *
     * @param $cd_blog
     * @return JsonResponse
     */
    public function show($cd_blog)
    {
        if (isset($this->arrBlog[$cd_blog]))
            return response()->json($this->arrBlog[$cd_blog], JsonResponse::HTTP_OK);

        return response()->json(["error" => "Blog com código {$cd_blog} não encontrado"], JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @OA\Post(
     *   path="/blogs",
     *   summary="Cadastro de blogs",
     *   @OA\RequestBody(
     *     description="Input data format",
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         type="object",
     *         required={"nm_blog", "ds_blog"},
     *         @OA\Property(
     *           property="nm_blog",
     *           description="Nome do blog",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="ds_blog",
     *           description="Descrição do blog",
     *           type="string",
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="JSON com o blog criado"
     *   )
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json(
            [
                "cd_blog" => 5,
                "nm_blog" => $request["nm_blog"],
                "ds_blog" => $request["ds_blog"]
            ],

            JsonResponse::HTTP_OK
        );
    }

    /**
     * @OA\Put(
     *   path="/blogs/{cd_blog}",
     *   summary="Atualizar um blog pelo código",
     *   @OA\Parameter(
     *     name="cd_blog",
     *     in="path",
     *     description="Código do blog a ser atualizado",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64",
     *       example=1
     *     )
     *   ),
     *   @OA\RequestBody(
     *     description="Input data format",
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         type="object",
     *         required={"nm_blog", "ds_blog"},
     *         @OA\Property(
     *           property="nm_blog",
     *           description="Nome do blog",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="ds_blog",
     *           description="Descrição do blog",
     *           type="string",
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Mostrará o blog atualizado"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Blog não encontrado"
     *   )
     * )
     * @param Request $request
     * @param $cd_blog
     * @return JsonResponse
     */
    public function update(Request $request, $cd_blog)
    {
        if (isset($this->arrBlog[$cd_blog]))
            return response()->json(
                [
                    "cd_blog" => $cd_blog,
                    "nm_blog" => $request["nm_blog"],
                    "ds_blog" => $request["ds_blog"]
                ],

                JsonResponse::HTTP_OK
            );

        return response()->json(["error" => "Blog com código {$cd_blog} não encontrado"], JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @OA\Delete(
     *   path="/blogs/{cd_blog}",
     *   summary="Deletar um blog pelo código",
     *   @OA\Parameter(
     *     name="cd_blog",
     *     in="path",
     *     description="Código do blog a ser deletado",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64",
     *       example=1
     *     )
     *   ),
     *   @OA\Response(
     *     response=204,
     *     description="Blog excluído com sucesso"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Blog não encontrado"
     *   )
     * )
     *
     * @param $cd_blog
     * @return JsonResponse
     */
    public function destroy($cd_blog)
    {
        if (isset($this->arrBlog[$cd_blog]))
            return response()->json(null, JsonResponse::HTTP_NO_CONTENT);

        return response()->json(["error" => "Blog com código {$cd_blog} não encontrado"], JsonResponse::HTTP_NOT_FOUND);
    }
}
