<?php

namespace App\Services;

use App\Models\GovernmentEntity;
use Illuminate\Pagination\LengthAwarePaginator;

class GovernmentEntityService
{
    /**
     * Get paginated government entities with optional search
     *
   
     */
    public function getEntities(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = GovernmentEntity::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->paginate($perPage);
    }
}
