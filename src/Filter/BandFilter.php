<?php

namespace App\Filter;

class BandFilter
{
    public ?string $searchParam = null;

    public function getSearchParam(): ?string
    {
        return $this->searchParam;
    }

    public function setSearchParam(?string $searchParam): void
    {
        $this->searchParam = $searchParam;
    }
}
