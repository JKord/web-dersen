<?php
namespace Catalog\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CatalogUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
