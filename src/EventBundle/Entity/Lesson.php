<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use APY\DataGridBundle\Grid\Mapping as GRID;

/**
  * @ORM\Entity
  * @ORM\Table(name="agenda__lesson")
  */
class Lesson extends Event
{
    public function __construct()
    {
    }

    public function getType()
    {
        return "lesson";
    }
}
