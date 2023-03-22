<?php

namespace P1ratRuleZZZ\Masker\Entity;

use P1ratRuleZZZ\Masker\Entity\EntityInterface;
use Masker\Options;

abstract class EntityAbstract implements EntityInterface {
    protected string $value;
    protected string $maskedValue = '';

    protected Options $options;

    public function __construct(mixed $value, Options $config) {
        $this->options = $config;
        $this->value = is_null($value) ? '' : (string) $value;
    }

    public function __toString(): string {
        return $this->isMasked() ? $this->maskedValue : $this->value;
    }

    protected function isMasked() {
        return $this->maskedValue !== '';
    }

    public function unmask() : static {
        $this->maskedValue = '';

        return $this;
    }
}
