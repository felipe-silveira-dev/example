<?php

namespace App\Interfaces;

interface BaseRepository
{
    public function getAll(string $filter = null): array;

    public function findOnebyId(int $id): object;

    public function store(object $dto): object;

    public function update(object $dto): object;

    public function delete(int $id): bool;
}
