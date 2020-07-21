<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @OA\Schema(
     *   schema="Erro",
     *   type="object",
     *   @OA\Property(
     *     property="error",
     *     description="Mensagem de erro/validação.",
     *     type="string",
     *   ),
     * )
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $message = Lang::get('exceptions.model_not_found', ['model' => $exception->getModel(), 'codigo' => $exception->getIds()[0] ?? '']);

            return response()->json(['error' => $message ?? 'Registro não encontrado.'], JsonResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $message = Lang::get('exceptions.method_not_allowed', ['metodo' => $request->method(), 'suportados' => $exception->getHeaders()["Allow"] ?? '']);

            return response()->json(['error' => $message ?? 'Método não permitido.'], $exception->getStatusCode());
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json(['error' => $exception->getMessage()], JsonResponse::HTTP_UNAUTHORIZED);
        }

        if ($exception->getMessage() == '') {
            return response()->json(['error' => 'Acesso Negado.'], JsonResponse::HTTP_FORBIDDEN);
        }

        if ($exception->getCode() == '23000') {
            return response()->json(['error' => 'Unable to delete data that has 1 or more reference(s).'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json(['error' => $exception->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
    }
}
