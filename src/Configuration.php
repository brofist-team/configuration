<?php

namespace Brofist\Configuration;

class Configuration implements ConfigurationInterface
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function toArray()
    {
        return $this->config;
    }

    public function merge(ConfigurationInterface $other)
    {
        $arrayConfig = $this->mergeArray($this->toArray(), $other->toArray());
        return new self($arrayConfig);
    }

    /**
     * @return array
     */
    protected function mergeArray(array $original, array $other)
    {
        $newConfig = $original;

        foreach ($other as $key => $value) {
            $oldValue = isset($newConfig[$key]) ? $newConfig[$key] : null;
            $newConfig[$key] = $this->getMergedValue($oldValue, $value);
        }

        return $newConfig;
    }

    /**
     * @param mixed $old
     * @param mixed $old
     *
     * @return mixed
     */
    protected function getMergedValue($old, $new)
    {
        if (is_array($old) && is_array($new)) {
            return array_merge($old, $new);
        }

        return $new;
    }
}
