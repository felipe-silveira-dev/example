<?php

namespace App\DTO;

use App\Http\Requests\StoreSupportRequest;
use Illuminate\Contracts\Support\Arrayable;

class CreateSupportDTO implements Arrayable
{
    public function __construct(
        public string $subject,
        public string $status,
        public string $body,
    ) { }

    public static function makeFromRequest(StoreSupportRequest $request): self
    {
        return new self(
            $request->input('subject'),
            'open',
            $request->input('body'),
        );
    }

    public function getName(): string
    {
        return $this->subject;
    }

    public function getDescription(): string
    {
        return $this->body;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'status' => $this->status,
            'body' => $this->body,
        ];
    }
}
