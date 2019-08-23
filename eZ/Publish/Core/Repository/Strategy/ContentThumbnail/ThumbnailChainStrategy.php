<?php

namespace eZ\Publish\Core\Repository\Strategy\ContentThumbnail;

use eZ\Publish\API\Repository\Values\ContentType\ContentType;
use eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\ThumbnailStrategy;

class ThumbnailChainStrategy implements ThumbnailStrategy
{
    protected $strategies = [];

    public function __construct(array $strategies)
    {
        $this->setStrategies($strategies);
    }

    public function getThumbnail(ContentType $contentType, array $fields): ?string
    {
        foreach ($this->strategies as $priority => $strategies) {
            $strategies = (array)$strategies;

            /** @var \eZ\Publish\SPI\Repository\Strategy\ContentThumbnail\ThumbnailStrategy $strategy */
            foreach ($strategies as $strategy) {
                $thumbnail = $strategy->getThumbnail($contentType, $fields);

                if ($thumbnail !== null) {
                    return $thumbnail;
                }
            }
        }
    }

    public function setStrategies(array $strategies): void
    {
        $this->strategies = [];

        foreach ($strategies as $priority => $strategy) {
            $this->addStrategy($strategy, $priority);
        }
    }

    public function addStrategy(ThumbnailStrategy $strategy, int $priority = 0): void
    {
        $this->strategies[$priority][] = $strategy;

        ksort($this->strategies);
    }
}