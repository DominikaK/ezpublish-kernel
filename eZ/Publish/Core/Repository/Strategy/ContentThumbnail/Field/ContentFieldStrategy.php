<?php

namespace eZ\Publish\Core\Repository\Strategy\ContentThumbnail\Field;

use eZ\Publish\API\Repository\Values\Content\Field;
use eZ\Publish\Core\Base\Exceptions\NotFoundException;
use eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\Field\ThumbnailStrategy;

class ContentFieldStrategy implements ThumbnailStrategy
{
    /** @var \eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\Field\ThumbnailStrategy[] */
    protected $strategies = [];

    public function __construct(array $strategies = [])
    {
        $this->setStrategies($strategies);
    }

    /**
     * @throws \eZ\Publish\Core\Base\Exceptions\NotFoundException
     */
    public function getThumbnail(Field $field): ?string
    {
        if (!$this->hasStrategy($field->fieldTypeIdentifier)) {
            throw new NotFoundException('Field\ThumbnailStrategy', $field->fieldTypeIdentifier);
        }

        return $this->strategies[$field->fieldTypeIdentifier]->getThumbnail($field);
    }

    public function hasStrategy(string $fieldTypeIdentifier): bool
    {
        return isset($this->strategies[$fieldTypeIdentifier]);
    }

    public function addStrategy(string $fieldTypeIdentifier, ThumbnailStrategy $thumbnailStrategy): void
    {
        $this->strategies[$fieldTypeIdentifier] = $thumbnailStrategy;
    }

    public function setStrategies(array $thumbnailStrategies): void
    {
        foreach ($thumbnailStrategies as $fieldTypeIdentifier => $thumbnailStrategy) {
            $this->addStrategy($fieldTypeIdentifier, $thumbnailStrategy);
        }
    }
}