<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [];
    }//end registerBundles()

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }//end registerContainerConfiguration()
}//end class

