<?php


namespace Filters;


class TrimC implements FilterContract
{
    /**
     * @param $filter string
     * @return string
     */
    public function handle($filter)
    {
        return str_replace('c', '', $filter);
    }
}
