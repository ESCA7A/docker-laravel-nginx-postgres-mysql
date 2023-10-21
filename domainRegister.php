<?php

use Illuminate\Support\Str;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

function domainsRegister()
{
    $path = base_path('app');
    $recursiveIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::KEY_AS_PATHNAME));
    $routes  = collect();

    /**
     * @var RecursiveDirectoryIterator $item
     */
    foreach ($recursiveIterator as $item) {
        if ($item->isDir()) {
            continue;
        }

        $path = $item->getPathname();
        $pathContainRoutesDir = Str::contains($path, 'routes');

        if ($pathContainRoutesDir) {
            $routes->push($path);
        }
    }

    return $routes;
}