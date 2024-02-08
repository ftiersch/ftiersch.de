<?php

namespace App\Services;

use App\Enums\ContentPieceType;
use App\Models\ContentPiece;
use App\Repositories\ContentPieceRepository;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ContentPieceService {
    protected Collection $contentPieces;
    protected ContentPieceRepository $contentPieceRepo;

    public function __construct(ContentPieceRepository $contentPieceRepo) {
        $this->contentPieces = new Collection();
        $this->contentPieceRepo = $contentPieceRepo;
    }

    public function loadNamespace(string $namespace): void {
        $this
            ->contentPieceRepo
            ->getByNamespace($namespace)
            ->each(function (ContentPiece $contentPiece) {
                $this->contentPieces[$contentPiece->identifier] = $contentPiece;
            });
    }

    public function loadPiece(string $identifier): ?ContentPiece {
        $contentPiece = $this
            ->contentPieceRepo
            ->getByIdentifier($identifier);

        if (!$contentPiece) {
            return null;
        }

        $this->contentPieces[$identifier] = $contentPiece;

        return $contentPiece;
    }

    public function exists(string $identifier): bool {
        return $this->contentPieceRepo->exists($identifier);
    }

    public function __(string $identifier): ?string {
        $contentPiece = $this->contentPieces[$identifier] ?? null;

        if (empty($contentPiece)) {
            $contentPiece = $this->loadPiece($identifier);
        }

        if (empty($contentPiece)) {
            $this->createDefault($identifier);
            return null;
        }

        return $contentPiece->text;
    }

    public function media(string $identifier): ?Media {
        $contentPiece = $this->contentPieces[$identifier] ?? null;

        if (empty($contentPiece)) {
            $contentPiece = $this->loadPiece($identifier);
        }

        if (empty($contentPiece)) {
            return null;
        }

        return $contentPiece->getFirstMedia('image');
    }

    protected function createDefault(string $identifier, ContentPieceType $type = ContentPieceType::Text): ContentPiece {
        $piece = new ContentPiece();
        $piece->identifier = $identifier;
        $piece->type = $type;
        $piece->save();

        return $piece;
    }
}
