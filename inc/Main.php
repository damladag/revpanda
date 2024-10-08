<?php

declare(strict_types=1);

namespace RVP;

use RVP\Admin\Menu;
use RVP\Admin\MetaBox;
use RVP\Admin\ThemeSupport;
use RVP\Assets\Assets;
use RVP\Admin\PostType;
use RVP\Modules\Rest;

class Main
{
    protected $classList = [
            'Assets' => Assets::class,
            'ThemeSupport' => ThemeSupport::class,
            'PostType' => PostType::class,
            'MetaBox' => MetaBox::class,
            'Menu' => Menu::class,
            'Rest' => Rest::class
    ];

    public function __construct()
    {
	    foreach ($this->classList as $className => $classInstance) {
		     new $classInstance;
	    }
    }
}