<?php

namespace App\Data;

class Search
{
    /**
     *  @var int/integer
     */
    public int $page = 1;


    /**
     * @var string
     */
    public ?string $recherche = null;

    /**
     * @var array
     */
    public array $genrelitteraire = [];

}
