<?php

namespace Liloi\Euphoria\Domains\Failures;

use Liloi\Stylo\Parser;
use Liloi\Tools\Entity as AbstractEntity;

/**
 * @method string getTitle()
 * @method void setTitle(string $value)
 *
 * @method string getDt()
 * @method void setDt(string $value)
 *
 * @method string getSummary()
 * @method void setSummary(string $value)
 *
 * @method string getData()
 * @method void setData(string $value)
 */
class Entity extends AbstractEntity
{
    public function getKey(): string
    {
        return $this->getField('key_failure');
    }

    public function parseSummary(): string
    {
        return Parser::parseString($this->getSummary());
    }

    public function save(): void
    {
        Manager::save($this);
    }

    public function getDataElement(string $key)
    {
        $data = (array)json_decode($this->getData(), true, 512, JSON_UNESCAPED_UNICODE);

        if(!array_key_exists($key, $data))
        {
            return '';
        }

        return $data[$key];
    }

    public function setDataElement(string $key, $value): void
    {
        $data = (array)json_decode($this->getData(), true, 512, JSON_UNESCAPED_UNICODE);

        $data[$key] = $value;

        $this->setData(json_encode($data));
    }

    /**
     * @return string
     * @todo Move JSON decode to more abstract layer.
     */
    public function getDataBeauty(): string
    {
        $data = (array)json_decode($this->getData());
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function getTimestamp(string $format = "Y-m-d H:i:s")
    {
        return date($format, strtotime($this->getDt()));
    }
}