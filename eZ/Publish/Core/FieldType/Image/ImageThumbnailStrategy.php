<?php

namespace eZ\Publish\Core\FieldType\Image;

use eZ\Publish\API\Repository\Values\Content\Field;
use eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\Field\ThumbnailStrategy;

class ImageThumbnailStrategy implements ThumbnailStrategy
{
    public function getThumbnail(Field $field): string
    {
        return $field->value->uri;
    }
}