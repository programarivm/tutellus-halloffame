<?php

namespace TutellusHall;

class Fame
{
    private $query;

    private $layout;

    public function __construct(array $query, string $layout)
    {
        $this->query = $query;
        $this->layout = $layout;
    }

    public function html()
    {
        return 'TODO';
    }
}
