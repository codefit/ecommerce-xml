<?php

namespace Feeds\XmlGenerator;

use Feeds\XmlGenerator\Contracts\FeedInterface;
use Spatie\ArrayToXml\ArrayToXml;
use Feeds\XmlGenerator\Exceptions\ValidationException;

use Feeds\XmlGenerator\Entities\GoogleItem;
use Feeds\XmlGenerator\Entities\ZboziItem;
use Feeds\XmlGenerator\Entities\HeurekaItem;

abstract class AbstractFeed implements FeedInterface
{
    protected array $items = [];
    protected string $namespace;
    protected string $rootElement;

    public function __construct(array $config = [])
    {
        $this->namespace = $config['namespace'] ?? '';
        $this->rootElement = $config['root_element'] ?? 'SHOP';
    }

    public function generate(): string
    {
        $array = [
            '_attributes' => [
                'xmlns' => $this->namespace
            ],
            'SHOPITEM' => $this->items
        ];

        return ArrayToXml::convert($array, $this->rootElement, true, 'UTF-8');
    }

    public function save(string $filename): bool
    {
        return file_put_contents($filename, $this->generate()) !== false;
    }

    public function addItem(
        $item
    ): self
    {
        $this->items[] = $item;
        return $this;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setMemoryLimit(string $limit): self
    {
        ini_set('memory_limit', $limit);
        return $this;
    }
} 