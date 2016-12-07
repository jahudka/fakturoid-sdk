<?php


namespace Jahudka\FakturoidSDK\Entity;


trait TaggableTrait {

    /**
     * @param string $tag
     * @return $this
     */
    public function addTag($tag) {
        if (!isset($this->data['tags']) || !in_array($tag, $this->data['tags'], true)) {
            $this->data['tags'][] = $tag;
        }

        return $this;
    }

    /**
     * @param string $tag
     * @return bool
     */
    public function hasTag($tag) {
        return isset($this->data['tags']) && in_array($tag, $this->data['tags'], true);
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function removeTag($tag) {
        if (isset($this->data['tags']) && ($i = array_search($tag, $this->data['tags'], true)) !== false) {
            array_splice($this->data['tags'], $i, 1);
        }

        return $this;
    }

}
