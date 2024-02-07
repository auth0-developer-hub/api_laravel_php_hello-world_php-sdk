<?php

namespace App\Models;

class Message
{
    public string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text
        ];
    }
}
