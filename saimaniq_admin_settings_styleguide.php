<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Style guide
 *
 * @package     theme_saimaniq
 * @copyright   2023 Concordia University
 * @author      Brandon Jimenez
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * adapted from theme_trema
 */

/**
 * Style guide
 *
 * @package     theme_trema
 * @copyright   2019 Trema - {@link https://trema.tech/}
 * @author      Rodrigo Mady
 * @author      Trevor Furtado
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class trema_admin_settings_styleguide
 *
 * @package     theme_trema
 * @copyright   2019 Trema - {@link https://trema.tech/}
 * @author      Rodrigo Mady
 * @author      Trevor Furtado
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class saimaniq_admin_settings_styleguide extends admin_setting_heading {

    /**
     * not a setting, just text
     * @param string $name unique ascii name, either 'mysetting' for settings that in config, or 'myplugin/mysetting'
     *  for ones in config_plugins.
     * @param string $heading heading
     * @param string $description text in box
     */
    public function __construct($name, $heading, $description = '') {
        $this->nosave = true;
        parent::__construct($name, $heading, $description, '');
    }

    /**
     * Returns an HTML string
     *
     * @param mixed $data array or string depending on setting
     * @param string $query
     * @return string
     */
    public function output_html($data, $query = '') {
        global $OUTPUT;
        $context = new stdClass();
        $context->title = $this->visiblename;
        $context->description = (!empty($this->description));
        $context->descriptionformatted = highlight($query, markdown_to_html($this->description));
        $colors = [
            [
                'name'      => 'burgundy',
                'color'     => '#912338',
                'compliant' => 'AAA',
            ],
            [
                'name'      => 'magenta',
                'color'     => '#db0272',
                'compliant' => 'AA',
            ],
            [
                'name'      => 'orange',
                'color'     => '#da3a16',
                'compliant' => 'AA',
            ],
            [
                'name'      => 'mauve',
                'color'     => '#573996',
                'compliant' => 'AAA',
            ],
            [
                'name'      => 'dark-blue',
                'color'     => '#004085',
                'compliant' => 'AAA',
            ],
            [
                'name'      => 'blue',
                'color'     => '#0072a8',
                'compliant' => 'AA',
            ],
            [
                'name'      => 'turquoise',
                'color'     => '#057d78',
                'compliant' => 'AA',
            ],
            [
                'name'      => 'green',
                'color'     => '#508212',
                'compliant' => 'AA',
            ],
            [
                'name'      => 'dark-green',
                'color'     => '#34550C',
                'compliant' => 'AA?',
            ],
            [
                'name'      => 'dark-gold',
                'color'     => '#554720',
                'compliant' => 'AA?',
            ],
        ];
        $context->colors = $colors;

        $secondaries = [
            [
                'name'      => 'yellow',
                'color'     => '#e5a712',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'gold',
                'color'     => '#cbb576',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'cyan',
                'color'     => '#00adef',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'lime',
                'color'     => '#8cc63e',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
        ];
        $context->secondaries = $secondaries;

        $tints = [
            [
                'name'      => 'tint-burgundy',
                'color'     => '#E9D3D7',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-magenta',
                'color'     => '#FACDE3',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-orange',
                'color'     => '#f9cdc3',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-mauve',
                'color'     => '#dcd6e8',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-dark-blue',
                'color'     => '#B2C5DA',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-blue',
                'color'     => '#d3e1e9',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-turquoise',
                'color'     => '#CCE3E4',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-green',
                'color'     => '#dfeccf',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'tint-gold',
                'color'     => '#e9e3d3',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
        ];
        $context->tints = $tints;

        $neutrals = [
            [
                'name'      => 'light-grey',
                'color'     => '#f0f0f0',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'medium-grey',
                'color'     => '#c8c8c8',
                'compliant' => 'AAA (black text)',
                'black'     => true,
            ],
            [
                'name'      => 'dark-grey',
                'color'     => '#6e6e6e',
                'compliant' => 'AAA',
            ],
            [
                'name'      => 'very-dark-grey',
                'color'     => '#2c2c2c',
                'compliant' => 'AAA',
            ],
            [
                'name'      => 'black',
                'color'     => 'black',
                'compliant' => 'AAA',
            ],
        ];
        $context->neutrals = $neutrals;

        return $OUTPUT->render_from_template('theme_saimaniq/admin_setting_styleguide', $context);
    }

}