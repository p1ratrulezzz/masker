<?php

namespace P1ratRuleZZZ\Masker;

use P1ratRuleZZZ\Masker\Entity\PhoneNumber;
use P1ratRuleZZZ\Masker\Entity\Word;
use P1ratRuleZZZ\Masker\Entity\Words;

class Masker {
    protected Options $config;

    public function __construct(array $config = []) {
        $defaults = [
            'char' => '*',
            'min' => 3,
        ];

        $config = $config + $defaults;

        $this->config = new Options($config);
    }

    public function options() {
        return $this->config;
    }

    protected $typeDefinitions = [
        'word' => Word::class,
        'words' => Words::class,
        'phone' => PhoneNumber::class,
    ];

    public function __call(string $name, array $arguments) {
        if (count($arguments) > 0 && substr($name, 0, 2) === 'as' && ($type = substr($name, 2)) && isset($this->typeDefinitions[strtolower($type)])) {
            return new $this->typeDefinitions[strtolower($type)](reset($arguments), $this->config);
        }

        throw new \Exception('method ' . $name . ' not found');
    }
}
