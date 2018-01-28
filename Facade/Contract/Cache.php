<?php

namespace Contract;

interface Cache
{
    public function put();
    public function get();
    public function has();
}