<?php

namespace Brofist\Configuration;

interface ConfigurationInterface
{
    /**
     * @return array
     */
    public function toArray();

    /**
     * @return ConfigurationInterface
     */
    public function merge(ConfigurationInterface $config);
}
