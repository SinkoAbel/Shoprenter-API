<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Secret",
 *     title="Secret",
 *     @OA\Property(
 *          property="secret_text",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="remaining_views",
 *          type="number"
 *     ),
 *     @OA\Property(
 *         property="expires_at",
 *         type="string"
 *     )
 * )
 */
class Secret extends Model
{
    use HasFactory;

    /**
     * Mass assigned values.
     *
     * @var array
     */
    protected $fillable = [
        'secret_text',
        'remaining_views',
        'expires_at',
    ];

    /**
     * Casts values for DB.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime'
    ];
}
