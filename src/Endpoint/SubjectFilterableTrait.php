<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Entity\Subject;


trait SubjectFilterableTrait {

    /**
     * @param string $option
     * @param mixed $value
     * @return $this
     */
    public abstract function setOption($option, $value);

    /**
     * @param Subject|int $subject
     * @return $this
     */
    public function withSubject($subject) {
        return $this->setOption('subject_id', $subject instanceof Subject ? $subject->getId() : $subject);
    }

}
