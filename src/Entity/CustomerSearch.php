<?php


namespace App\Entity;

class CustomerSearch
{
    /**
     * @var string | null
     */
    private $searchText;

    /**
     * @var Nationality | null
     */
    private $nationality;

    /**
     * @return string|null
     */
    public function getSearchText(): ?string
    {
        return $this->searchText;
    }

    /**
     * @param string|null $searchText
     */
    public function setSearchText(?string $searchText): void
    {
        $this->searchText = $searchText;
    }

    /**
     * @return Nationality|null
     */
    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    /**
     * @param Nationality|null $nationality
     */
    public function setNationality(?Nationality $nationality): void
    {
        $this->nationality = $nationality;
    }
}