<?php

namespace eZ\Publish\Core\Repository\Strategy\ContentThumbnail;

use eZ\Publish\API\Repository\Values\ContentType\ContentType;
use eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\ThumbnailStrategy;

class StaticStrategy implements ThumbnailStrategy
{
    /** @var string */
    private $staticThumbnail;

    public function __construct(string $staticThumbnail)
    {
        $this->staticThumbnail = $staticThumbnail;
    }

    public function getThumbnail(ContentType $contentType, array $fields): ?string
    {
        return $this->staticThumbnail;
    }
}