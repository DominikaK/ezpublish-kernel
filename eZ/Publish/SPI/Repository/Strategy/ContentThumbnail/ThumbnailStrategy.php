<?php

namespace eZ\Publish\SPI\Repository\Strategy\ContentThumbnail;

use eZ\Publish\API\Repository\Values\ContentType\ContentType;

interface ThumbnailStrategy
{
    public function getThumbnail(ContentType $contentType, array $fields): ?string;
}