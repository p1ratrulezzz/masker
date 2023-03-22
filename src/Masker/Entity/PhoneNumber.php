<?php

namespace P1ratRuleZZZ\Masker\Entity;

class PhoneNumber extends Word {

    public function mask(): EntityInterface {
        if (!$this->isMasked()) {
            $this->maskedValue = mb_substr($this->value, 0, $this->length() - 3) . $this->getMaskTemplate(3);
        }

        return $this;
    }
}
