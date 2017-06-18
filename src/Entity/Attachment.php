<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read string $fileName
 * @property-read string $contentType
 * @property-read string $downloadUrl
 *
 * @method string getFileName()
 * @method string getContentType()
 * @method string getDownloadUrl()
 *
 * @method bool hasFileName()
 * @method bool hasContentType()
 * @method bool hasDownloadUrl()
 */
class Attachment extends AbstractEntity {

    /** @var string */
    private $path = null;

    /** @var string */
    private $mimeType = null;

    /**
     * @param array|string $data
     */
    public function __construct($data) {
        if (is_string($data)) {
            $this->path = $data;
            $data = [];

            if (func_num_args() === 2) {
                $this->mimeType = func_get_arg(1);
            }
        }

        parent::__construct($data);
    }

    /**
     * @return bool
     */
    public function isNew() {
        return !empty($this->path);
    }

    /**
     * @return string
     */
    public function toDataUrl() {
        if (!is_file($this->path) || !is_readable($this->path)) {
            throw new \RuntimeException("Cannot read attachment file '{$this->path}'");
        }

        if (!$this->mimeType) {
            $this->mimeType = @finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->path);

            if (!$this->mimeType) {
                throw new \RuntimeException("Cannot detect MIME-type of attachment file '{$this->path}'");
            }
        }

        return 'data:' . $this->mimeType . ';base64,' . base64_encode(file_get_contents($this->path));
    }

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'fileName',
            'contentType',
            'downloadUrl',
        ];
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return $this->getKnownProperties();
    }


}
