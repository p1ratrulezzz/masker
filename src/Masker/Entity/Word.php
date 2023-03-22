<?php

namespace P1ratRuleZZZ\Masker\Entity;

use P1ratRuleZZZ\Masker\Entity\EntityAbstract;
use P1ratRuleZZZ\Masker\Options;

class Word extends EntityAbstract {

    /**
     * @{inheritDoc}
     */
    public function mask() : EntityInterface {
        if (!$this->isMasked()) {
            $this->maskedValue = $this->value;
            $min = $this->getPresaveChars();
            if ($this->length() > $min) {
                $this->maskedValue = mb_substr($this->value, 0, $min) . $this->getMaskTemplate($this->options->getOption('chars_max', $this->length() - $min));
            }
        }

        return $this;
    }
}
