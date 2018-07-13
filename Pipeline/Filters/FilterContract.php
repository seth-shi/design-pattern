<?php

namespace Filters;

interface FilterContract
{
    /**
     * @param $filter string
     * @return string
     */
    public function handle($filter);
}
