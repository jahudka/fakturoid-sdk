<?php

declare(strict_types=1);

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
    private ?string $path = null;
    private ?string $mimeType = null;

    /**
     * @param array|string $dataOrPath
     */
    public function __construct($dataOrPath, ?string $mimeType = null) {
        if (is_string($dataOrPath)) {
            $this->path = $dataOrPath;
            $this->mimeType = $mimeType;
            $dataOrPath = [];
        }

        parent::__construct($dataOrPath);
    }

    public function isNew(): bool {
        return !empty($this->path);
    }

    public function toDataUrl(): string {
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

    public function getKnownProperties(): array {
        return [
            'fileName',
            'contentType',
            'downloadUrl',
        ];
    }

    public function getReadonlyProperties(): array {
        return $this->getKnownProperties();
    }
}
