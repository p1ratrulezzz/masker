<?php

namespace P1ratRuleZZZ\Masker\Entity;

use P1ratRuleZZZ\Masker\Entity\EntityAbstract;
use Masker\Options;

class Word extends EntityAbstract {

    /**
     * @{inheritDoc}
     */
    public function mask() : EntityInterface {
        if (!$this->isMasked()) {
            $this->maskedValue = $this->value;
            $len = mb_strlen($this->value);
            $min = $this->options->getOption('min');
            if ($len > $min) {
                $this->maskedValue = mb_substr($this->value, 0, $min) . str_repeat($this->options->getOption('char'), $this->options->getOption('chars_max', $len - $min));
            }
        }

        return $this;
    }
}
