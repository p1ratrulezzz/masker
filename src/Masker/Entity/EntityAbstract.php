<?php

namespace P1ratRuleZZZ\Masker\Entity;

use P1ratRuleZZZ\Masker\Entity\EntityInterface;
use P1ratRuleZZZ\Masker\Masker;
use P1ratRuleZZZ\Masker\Options;

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

    public function calcPercentage(float $percent) : int {
        return floor(($percent * mb_strlen($this->value)) / 100);
    }

    public function length() : int {
        return mb_strlen($this->value);
    }

    protected function getPresaveChars() : int {
        $min_chars = $this->options->getOption('presave_min_chars');
        $chars_count = $this->options->getOption('presave_amount');

        switch ($this->options->getOption('presave_mode')) {
            case Masker::MODE_PERCENT:
                $chars_count = $this->calcPercentage($chars_count);
            default:
                break;
        }

        return $chars_count < $min_chars ? $min_chars : $chars_count;
    }

    public function getMaskTemplate(int $chars) : string {
        return str_repeat($this->options->getOption('char'), $chars);
    }
}
