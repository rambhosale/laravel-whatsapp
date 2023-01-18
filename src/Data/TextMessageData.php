<?php

namespace Rambhosale\LaravelWhatsapp\Data;

use Rambhosale\LaravelWhatsapp\Interfaces\HasMessageData;

class TextMessageData implements HasMessageData
{
    public function __construct(private string $body, private bool $previewUrl = false)
    {
        $this->body       = $body;
        $this->previewUrl = $previewUrl;
    }

    public static function make($body, $previewUrl = false): self
    {
        return new static($body, $previewUrl);
    }

    public function withPreviewUrl(): self
    {
        $this->previewUrl = true;

        return $this;
    }

    public function body($content): self
    {
        $this->body = $content;

        return $this;
    }

    public function getType(): string
    {
        return 'text';
    }

    public function toArray(): array
    {
        return [
            'body'        => $this->body,
            'preview_url' => $this->previewUrl,
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
