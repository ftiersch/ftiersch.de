<?php

namespace App\Repositories;

use App\Models\ContentPiece;
use Illuminate\Support\Collection;

class ContentPieceRepository {
    public function getByNamespace(string $namespace): Collection {
        return ContentPiece::inNamespace($namespace)
                ->get();
    }

    public function getByIdentifier(string $identifier): ?ContentPiece {
        return ContentPiece::where('identifier', $identifier)->first();
    }

    public function exists(string $identifier): bool {
        return ContentPiece::where('identifier', $identifier)->exists();
    }
}
