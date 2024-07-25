<?php

namespace App\Http\Services;

use App\Models\Secret;

final class SecretService
{
    /**
     * Perform checks on the
     * provided Secret record
     * and decide if it is valid or not.
     *
     * true - secret is valid
     * false - secret is expired
     *
     * @param Secret $secret
     * @return bool
     */
    public function checks(Secret $secret): bool
    {
        if ($secret->remaining_views == 0) {
            return false;
        }

        if (! $secret->expires_at) {
            return true;
        }

        if ($secret->expires_at < now()) {
            return false;
        }

        return true;
    }
}
