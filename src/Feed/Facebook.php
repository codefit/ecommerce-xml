<?php

namespace Feeds\XmlGenerator\Feed;

use Feeds\XmlGenerator\AbstractFeed;
use Feeds\XmlGenerator\Exceptions\ValidationException;
use Feeds\XmlGenerator\Entities\FacebookItem;
use Spatie\ArrayToXml\ArrayToXml;

class Facebook extends AbstractFeed
{
    protected string $author = 'Lekia';
    protected string $link = 'https://www.lekia.cz/';
    protected string $title = 'Produkty';

    public function __construct(array $config = [])
    {
        parent::__construct([
            'namespace' => 'http://base.google.com/ns/1.0',
            'root_element' => 'rss'
        ]);
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function generate(): string
    {
        $array = [
            '_attributes' => [
                'version' => '2.0',
                'xmlns:g' => 'http://base.google.com/ns/1.0'
            ],
            'channel' => [
                'title' => $this->title,
                'link' => $this->link,
                'description' => $this->title,
                'item' => $this->items
            ]
        ];

        return ArrayToXml::convert($array, $this->rootElement, true, 'UTF-8');
    }

    public function addItem($item): self
    {
        $this->validateItem($item);
        $this->items[] = $item->toArray();
        return $this;
    }

    protected function validateItem(FacebookItem $item): void
    {
        $requiredProperties = [
            'id' => 'g:id',
            'title' => 'g:title',
            'description' => 'g:description',
            'link' => 'g:link',
            'imageLink' => 'g:image_link',
            'priceVat' => 'g:price',
            'brand' => 'g:brand',
            'availability' => 'g:availability',
            'condition' => 'g:condition'
        ];

        foreach ($requiredProperties as $property => $tag) {
            $getter = 'get' . ucfirst($property);
            if (is_null($item->$getter())) {
                throw new ValidationException("Missing required property: {$tag}");
            }
        }
    }
} 