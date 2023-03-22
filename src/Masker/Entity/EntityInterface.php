<?php

namespace P1ratRuleZZZ\Masker\Entity;

interface EntityInterface {

    public function mask(): EntityInterface;

    public function unmask(): EntityInterface;
}
