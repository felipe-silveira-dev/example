<?php

namespace App\Interfaces;

interface PaginationInterface
{
    public function items(): array;

    public function currentPage(): int;

    public function perPage(): int;

    public function total(): int;

    public function lastPage(): int;

    public function firstItem(): int;

    public function lastItem(): int;

    public function hasMorePages(): bool;

    public function hasPages(): bool;

    public function nextPageUrl(): ?string;

    public function previousPageUrl(): ?string;

    public function url(int $page): string;

    public function toArray(): array;
}
