# Oxid Error 404

## Description 

If the user get a 404 Page display, the user will automaticlly redirect to the start page.

This module was created for Oxid 6.x, Wave Theme.

## Install

1. Copy files into following directory

        source/modules/rs/deactivate
        
        
2. Add to composer.json at shop root
  
        "autoload": {
            "psr-4": {
                "rs\\error404\\": "./source/modules/rs/error404"
            }
        },

3. Refresh autoloader files with composer in the oxid root directory.

        composer dump-autoload
        
4. Enable module in the oxid admin area, Extensions => Modules