<?php

namespace Feeds\XmlGenerator\Contracts;

use Feeds\XmlGenerator\Entities\GoogleItem;
use Feeds\XmlGenerator\Entities\ZboziItem;
use Feeds\XmlGenerator\Entities\HeurekaItem;

interface FeedInterface
{
    public function generate(): string;
    public function save(string $filename): bool;
    public function addItem($item): self;
    public function setItems(array $items): self;
    public function getItems(): array;
} 