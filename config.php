<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * The configuration for theme_saimaniq is defined here.
 *
 * @package     theme_saimaniq
 * @copyright   2023 Brandon Jimenez <brandon.jimenez@concordia.ca>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'saimaniq';

$THEME->doctype = '1';
$THEME->parents = ['boost'];


$THEME->sheets = [];
$THEME->editor_sheets = [];

// Most themes will use this rendererfactory as this is the one that allows the theme to override any other renderer.      
$THEME->rendererfactory = 'theme_overridden_renderer_factory';       
 
// This is a list of blocks that are required to exist on all pages for this theme to function correctly. For example      
// bootstrap base requires the settings and navigation blocks because otherwise there would be no way to navigate to all the        
// pages in Moodle. Boost does not require these blocks because it provides other ways to navigate built into the theme.   
$THEME->requiredblocks = '';   
 
// This is a feature that tells the blocks library not to use the "Add a block" block. We don't want this in boost based themes because
// it forces a block region into the page when editing is enabled and it takes up too much room.
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;

$THEME->haseditswitch = true;
$THEME->enable_dock = false;

//Or else it won't show in the theme selector
$THEME->hidefromselector = FALSE;

$THEME->usefallback = true;

$THEME->scss = function($theme) {
    return theme_saimaniq_get_main_scss_content($theme);
};

$THEME->prescsscallback = 'theme_saimaniq_get_pre_scss';
// $THEME->extrascsscallback = 'theme_boost_get_extra_scss';
// $THEME->precompiledcsscallback = 'theme_boost_get_precompiled_css';
$THEME->yuicssmodules = [];

$THEME->iconsystem = '\\core\\output\\icon_system::FONTAWESOME';

//$THEME->iconsystem = '\\theme_classic\\output\\icon_system_fontawesome';

// The theme needs to be added to all Moodle layouts.
$THEME->layouts = [

    // Most backwards compatible layout without the blocks.
    // This is the layout used by default.
    'base' => [
        'file' => 'drawers.php',
        'regions' => [],
    ],
    // Standard layout with blocks.
    'standard' => [
        'file' => 'drawers.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
    ],
    'login' => [
        'file' => 'saimaniq-login.php',
        'regions' => [],
        'options' => [
            'langmenu' => true
        ],
    ],
    // My dashboard page.
    'mydashboard' => [
        'file' => 'saimaniq-drawers.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ],
    // Main course page.
    'course' => array(
        'file' => 'course.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true),
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'saimaniq-drawers.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // My courses page.
    'mycourses' => array(
        'file' => 'saimaniq-drawers.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true),
    ),
    // Part of course, typical for modules. Default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'saimaniq-drawers.php',
        'regions' => ['side-pre'],
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true),
    ),
    // The pagelayout used for reports.
    'report' => array(
        'file' => 'saimaniq-drawers.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
/*
    'coursecategory' => [
        'file' => 'layout4',
        'regions' => [],
    ],
    // The site home page.
    'frontpage' => [
        'file' => 'layout6',
        'regions' => [],
    ],

    // My public page.
    'mypublic' => [
        'file' => 'layout9',
        'regions' => [],
    ],

    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => [
        'file' => 'layout11',
        'regions' => [],
        'options' => [
            'nofooter' => true,
            'noblocks' => true,
            'nonavbar' => true,
            'nocourseheaderfooter' => true
        ],
    ],

    // No blocks and minimal footer - used for legacy frame layouts.
    'frametop' => [
        'file' => 'layout12',
        'regions' => [],
        'options' => [
            'nofooter' => true,
            'nocoursefooter' => true
        ],
    ],

    // Used during upgrade and install, and for the 'This site is undergoing maintenance message.
    // This must not have any blocks, and it is a good idea if it does not have links to other pages.
    'maintenance' => [
        'file' => 'layout13',
        'regions' => [],
        'options' => [
            'noblocks' => true,
            'nofooter' => true,
            'nonavbar' => true,
            'nocourseheaderfooter' => true
        ],
    ],

    // Embedded pages, like iframe/object embedded in moodleform. Needs as much space as possible.
    'embedded' => [
        'file' => 'layout14',
        'regions' => [],
        'options' => [
            'nofooter' => true,
            'nonavbar' => true,
            'nocourseheaderfooter' => true
        ],
    ],

    // Should display the content and basic headers only.
    'print' => [
        'file' => 'layout15',
        'regions' => [],
        'options' => [
            'nofooter' => true,
            'nonavbar' => false,
            'noblocks' => true,
            'nocourseheaderfooter' => true
        ],
    ],

    // The pagelayout used when a redirection is occuring.
    'redirect' => [
        'file' => 'layout16',
        'regions' => [],
        'options' => [
            'nofooter' => true,
            'nonavbar' => true,
            'nocourseheaderfooter' => true
        ],
    ],


    // The pagelayout used for safebrowser and securewindow.
    'secure' => [
        'file' => 'layout18',
        'regions' => [],
        'options' => [
            'nofooter' => true,
            'nonavbar' => true,
            'nocustommenu' => true,
            'nologinlinks' => true,
            'nocourseheaderfooter' => true
        ],
    ],*/
];