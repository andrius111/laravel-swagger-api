<?php

  namespace App\Services;

  use Illuminate\Http\JsonResponse;
  use App\Post;
  use App\Http\Requests\PostRequest;

  class PostService
  {
    /**
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function obterPosts()
    {
      return Post::all();
    }

    /**
     * @param PostRequest $request
     * @return mixed
     */
    public function salvarPost(PostRequest $request)
    {
      return Post::create($request->only(["nm_post", "ds_post"]));
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function atualizarPost(PostRequest $request, Post $post)
    {
      $post->update($request->only(["nm_post", "ds_post"]));

      return response()->json($post, JsonResponse::HTTP_OK);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @throws \Exception
     */
    public function deletarPost(Post $post)
    {
      $post->delete();

      return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
  }
