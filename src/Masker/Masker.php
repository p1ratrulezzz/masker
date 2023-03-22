<?php

namespace P1ratRuleZZZ\Masker;

use P1ratRuleZZZ\Masker\Entity\Email;
use P1ratRuleZZZ\Masker\Entity\PhoneNumber;
use P1ratRuleZZZ\Masker\Entity\Word;
use P1ratRuleZZZ\Masker\Entity\Words;

class Masker {
    const MODE_PERCENT = 'percent';
    const MODE_CHARCOUNT = 'charcount';

    protected Options $config;

    public function __construct(array $config = []) {
        $defaults = [
            // 'automasking' => true,
            'presave_mode' => static::MODE_CHARCOUNT,
            'presave_amount' => 3,
            'presave_min_chars' => 3,
            'char' => '*',
        ];

        $config = $config + $defaults;

        $this->config = new Options($config);
    }

    public function options() : Options {
        return $this->config;
    }

    protected $typeDefinitions = [
        'word' => Word::class,
        'words' => Words::class,
        'phonenumber' => PhoneNumber::class,
        'email' => Email::class,
    ];

    public function __call(string $name, array $arguments) {
        if (count($arguments) > 0 && substr($name, 0, 2) === 'as' && ($type = substr($name, 2)) && isset($this->typeDefinitions[strtolower($type)])) {
            return new $this->typeDefinitions[strtolower($type)](reset($arguments), $this->config);
        }

        throw new \Exception('method ' . $name . ' not found. available types are ' . implode(', ', array_keys($this->typeDefinitions)));
    }

    public function &getTypeDefinitions() : array {
        return $this->typeDefinitions;
    }
}
