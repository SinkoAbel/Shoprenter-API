<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IConvertable;
use App\Http\Requests\StoreSecretRequest;
use App\Http\Resources\SecretResource;
use App\Http\Services\SecretService;
use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

final class SecretController extends Controller
{
    protected function setModel(): string
    {
        return Secret::class;
    }

    protected function setResource(): string
    {
        return SecretResource::class;
    }

    public function __construct(
        protected IConvertable $dataConverter,
        protected SecretService $service
    )
    {
        parent::__construct();
    }

    /**
     * Get a secret by ID.
     *
     * @param Request $request
     * @param Secret $hash
     * @return Response
     *
     * @OA\Get(
     *     path="/api/secret/{hash}",
     *     operationId="showSecret",
     *     summary="Show a secret.",
     *     tags={"Secret"},
     *     description="Returns a secret item from DB.",
     *     @OA\Parameter(
     *          name="hash",
     *          in="path",
     *          description="Hash/ID of secret item.",
     *          @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation.",
     *          @OA\JsonContent(ref="#/components/schemas/Secret"),
     *          @OA\XmlContent(ref="#/components/schemas/Secret")
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Secret is expired.",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="nubmer", example="404"),
     *              @OA\Property(property="error_message", type="string", example="Secret expired")
     *          ),
     *          @OA\XmlContent(
     *              type="object",
     *              @OA\Property(property="status", type="nubmer", example="404"),
     *          )
     *     )
     * )
     */
    public function show(Request $request, Secret $hash): Response
    {
        $accept = $request->header('Accept');

        if (! $this->service->checks($hash)) {
            $hash->delete();

            return response(
                $this->dataConverter->decideConversion($accept, ['message' => 'Secret expired']),
                404
            );
        }

        $hash->remaining_views = $hash->remaining_views - 1;
        $hash->save();

        $resource = new $this->resource($hash);

        return response(
            $this->dataConverter->decideConversion($accept, $resource->toArray(request()))
        );
    }

    /**
     * Store a new Secret.
     *
     * @OA\Post(
     *     path="/api/secret",
     *     operationId="storeSecret",
     *     summary="Store a new secret.",
     *     tags={"Secret"},
     *     description="Store a new secret.",
     *     @OA\RequestBody(
     *          required=true,
     *          description="Data for post request.",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="secret", type="string", example="New secret"),
     *              @OA\Property(property="expire_after_views", type="number", example="5"),
     *              @OA\Property(property="expire_after_minutes", type="number", example="3")
     *          )
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(ref="#/components/schemas/Secret"),
     *          @OA\XmlContent(ref="#/components/schemas/Secret")
     *     ),
     *     @OA\Response(
     *          response=405,
     *          description="Invalid input."
     *     )
     * )
     *
     * @param StoreSecretRequest $request
     * @return Response
     */
    public function store(StoreSecretRequest $request): Response
    {
        $accept = $request->header('Accept');
        $result = $this->model::create($request->getRequestParams());

        $resource = new $this->resource($result);

        return response(
            $this->dataConverter->decideConversion($accept, $resource->toArray(request())),
            201
        );
    }
}
