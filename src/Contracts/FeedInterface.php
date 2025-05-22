<?php

namespace Feeds\XmlGenerator\Contracts;

interface FeedInterface
{
    public function generate(): string;
    public function save(string $filename): bool;
    public function addItem(array $item): self;
    public function setItems(array $items): self;
    public function getItems(): array;
} 