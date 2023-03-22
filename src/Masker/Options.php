<?php

namespace P1ratRuleZZZ\Masker;

class Options {
    protected $_options;

    public function setOption(string $name, $value) {
        $this->_options[$name] = $value;

        return $this;
    }

    public function getOption(string $name, $default = null) {
        return $this->_options[$name] ?? $default;
    }

    public function __construct(array $config = []) {
        if (is_array($config)) {
            $this->_options = $config;
        }
        elseif ($config instanceof \stdClass) {
            $this->_options = (array) $config;
        }
    }
}
