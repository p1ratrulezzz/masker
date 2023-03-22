<?php

namespace P1ratRuleZZZ\Masker\Entity;

use P1ratRuleZZZ\Masker\Entity\EntityAbstract;
use P1ratRuleZZZ\Masker\Entity\Word;
use P1ratRuleZZZ\Masker\Options;

class Words extends EntityAbstract {

    /**
     * @var Word[]
     */
    protected array $valueArray;

    public function __construct(string $value, Options $config) {
        parent::__construct($value, $config);

        $value = preg_replace('/\s+/i', ' ', $this->value);
        $words = explode(' ', $value);
        $this->valueArray = [];
        foreach ($words as $_word) {
            $this->valueArray[] = new Word($_word, $this->options);
        }
    }

    public function mask() : EntityInterface {
        if (!$this->isMasked()) {
            $words = [];
            foreach ($this->valueArray as $_word) {
                $words[] = (string) $_word->mask();
            }

            $this->maskedValue = implode(' ', $words);
        }

        return $this;
    }
}
