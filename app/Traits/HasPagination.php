<?php

namespace App\Traits;

trait HasPagination
{
    protected $perPageMax = 100;

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage(): int
    {
        $perPage = $this->perPage;

        if (request()->has('per_page') && (is_numeric(request('per_page')))) {
            $perPage = (int) request('per_page');
        }

        return max(1, min($this->perPageMax, (int) $perPage));
    }

    /**
     * @param int $perPageMax
     */
    public function setPerPageMax(int $perPageMax): void
    {
        $this->perPageMax = $perPageMax;
    }
}
