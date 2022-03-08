<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Entity\Subject;


trait SubjectFilterableTrait {
    /**
     * @return $this
     */
    public abstract function setOption(string $option, $value);

    /**
     * @param Subject|int $subject
     * @return $this
     */
    public function withSubject($subject) {
        return $this->setOption('subject_id', $subject instanceof Subject ? $subject->getId() : $subject);
    }

}
