<?php

namespace EventBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventBundle extends Bundle
{
    public function getParent()
    {
        return 'ADesignsCalendarBundle';
    }
}
