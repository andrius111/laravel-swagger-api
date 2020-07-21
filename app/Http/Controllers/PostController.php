<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\JsonResponse;
  use App\Http\Requests\PostRequest;
  use App\Post;
  use App\Services\PostService;

  class PostController extends Controller
  {
    /**
     * @var PostService
     */
    protected $PostService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
      $this->PostService = $postService;
    }

    /**
     * @OA\Get(
     *   path="/posts",
     *   summary="Listagem de Posts",
     *   tags={"Posts"},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/Post"),
     *     ),
     *   ),
     * )
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
      return $this->PostService->obterPosts();
    }

    /**
     * @OA\Get(
     *   path="/posts/{cd_post}",
     *   summary="Lista um post pelo código",
     *   tags={"Posts"},
     *   @OA\Parameter(
     *     name="cd_post",
     *     in="path",
     *     description="Código do post a ser listado",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64",
     *       example=1,
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/Post"),
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Post não encontrado",
     *     @OA\JsonContent(ref="#/components/schemas/Erro"),
     *   ),
     * )
     *
     * @param Post $post
     * @return Post
     */
    public function show(Post $post)
    {
      return $post;
    }

    /**
     * @OA\Post(
     *   path="/posts",
     *   summary="Cadastro de posts",
     *   tags={"Posts"},
     *   @OA\RequestBody(
     *     description="Dados para requisição",
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/PostRequisicao"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Post salvo com sucesso",
     *     @OA\JsonContent(ref="#/components/schemas/Post")
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Falha de validação",
     *     @OA\JsonContent(ref="#/components/schemas/Erro"),
     *   ),
     * )
     *
     * @param PostRequest $request
     * @return mixed
     */
    public function store(PostRequest $request)
    {
      return $this->PostService->salvarPost($request);
    }

    /**
     * @OA\Put(
     *   path="/posts/{cd_post}",
     *   summary="Atualizar um post pelo código",
     *   tags={"Posts"},
     *   @OA\Parameter(
     *     name="cd_post",
     *     in="path",
     *     description="Código do post a ser atualizado",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64",
     *       example=1,
     *     ),
     *   ),
     *   @OA\RequestBody(
     *     description="Dados para requisição",
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/PostRequisicao"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/Post"),
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Post não encontrado",
     *     @OA\JsonContent(ref="#/components/schemas/Erro"),
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Falha de validação",
     *     @OA\JsonContent(ref="#/components/schemas/Erro"),
     *   ),
     * )
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
      return $this->PostService->atualizarPost($request, $post);
    }

    /**
     * @OA\Delete(
     *   path="/posts/{cd_post}",
     *   summary="Deletar um post pelo código",
     *   tags={"Posts"},
     *   @OA\Parameter(
     *     name="cd_post",
     *     in="path",
     *     description="Código do post a ser deletado",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64",
     *       example=1,
     *     ),
     *   ),
     *   @OA\Response(
     *     response=204,
     *     description="Post deletado com sucesso",
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Post não encontrado",
     *     @OA\JsonContent(ref="#/components/schemas/Erro"),
     *   ),
     * )
     *
     * @param Post $post
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
      return $this->PostService->deletarPost($post);
    }
  }
