<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Shoprenter API Documentation",
 *     description="This is the swagger endpoint documentation of the project for Shoprenter."
 * )
 */
abstract class Controller
{
    protected string $model;
    protected string $resource;

    protected abstract function setModel(): string;
    protected abstract function setResource(): string;

    public function __construct()
    {
        $this->model = $this->setModel();
        $this->resource = $this->setResource();
    }
}
