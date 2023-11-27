<?php

namespace App\Repositories;

use App\Interfaces\PaginationInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class PaginationPresenter implements PaginationInterface
{
    /** @var stdClass[] */
    private array $items;

    public function __construct(
        protected LengthAwarePaginator $pagination
    ) {
        $this->items = $this->items = $this->resolveItems($this->pagination->items());
    }

    /**
     * @return stdClass[]
     */
    public function items(): array
    {
        return (array) $this->items;
    }

    public function currentPage(): int
    {
        return $this->pagination->currentPage();
    }

    public function perPage(): int
    {
        return $this->pagination->perPage();
    }

    public function total(): int
    {
        return $this->pagination->total();
    }

    public function lastPage(): int
    {
        return $this->pagination->lastPage();
    }

    public function firstItem(): int
    {
        return $this->pagination->firstItem();
    }

    public function lastItem(): int
    {
        return $this->pagination->lastItem();
    }

    public function hasMorePages(): bool
    {
        return $this->pagination->hasMorePages();
    }

    public function hasPages(): bool
    {
        return $this->pagination->hasPages();
    }

    public function nextPageUrl(): ?string
    {
        return $this->pagination->nextPageUrl();
    }

    public function previousPageUrl(): ?string
    {
        return $this->pagination->previousPageUrl();
    }

    public function url(int $page): string
    {
        return $this->pagination->url($page);
    }

    public function toArray(): array
    {
        return $this->pagination->toArray();
    }

    private function resolveItems(array $items): array
    {
        $response = [];
        foreach ($items as $item) {
            $stdClassObject = new stdClass;
            foreach ($item->toArray() as $key => $value) {
                $stdClassObject->{$key} = $value;
            }
            array_push($response, $stdClassObject);
        }

        return $response;
    }
}
