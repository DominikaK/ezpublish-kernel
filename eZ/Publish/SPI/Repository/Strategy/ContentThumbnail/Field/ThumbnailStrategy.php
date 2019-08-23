<?php

namespace eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\Field;

use eZ\Publish\API\Repository\Values\Content\Field;

interface ThumbnailStrategy
{
    public function getThumbnail(Field $field): ?string;
}