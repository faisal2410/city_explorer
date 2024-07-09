<?php

namespace App;

class Pagination
{
    private $page;
    private $perPage;

    public function __construct($page = 1, $perPage = 15)
    {
        $this->page = max(1, (int)$page);
        $this->perPage = $perPage;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }
}
