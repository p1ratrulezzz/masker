<?php

namespace P1ratRuleZZZ\Masker\Entity;

class Email extends Word {
    public function mask(): EntityInterface {
        if (!$this->isMasked()) {
            $arobase_pos = strpos($this->value, '@');
            $first_part = mb_substr($this->value, 0, $arobase_pos);
            $len = mb_strlen($this->value);
            $chars_to_presave = $this->calcPercentage($this->options->getOption('presave_percent', 30));
            $mask = $this->getMaskTemplate($this->options->getOption('chars_max', $len - $chars_to_presave));
            $this->maskedValue = mb_substr($first_part, 0, $chars_to_presave) . $mask . mb_substr($this->value, $arobase_pos);
        }

        return $this;
    }
}
