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
 * Plugin strings are defined here.
 *
 * @package     theme_saimaniq
 * @category    string
 * @copyright   2023 Brandon Jimenez <brandon.jimenez@concordia.ca>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']   = 'Saimaniq';
$string['choosereadme'] = 'Saimaniq, de la palabra Inuktitut para Paz, es nuestro nuevo tema Moodle basado en Boost. Refleja la marca de Concordia, y además incluye algunas características adicionales, como una página de inicio completamente personalizable.';
// Name of the settings pages.
$string['configtitle'] = 'Ajustes de Saimaniq';
// Name of the first settings tab.
$string['generalsettings'] = 'Ajustes generales';
// Preset setting.
$string['preset'] = 'Preconfiguración de tema';
// Preset help text.
$string['preset_desc'] = 'Escoja una preconfiguración para cambiar de manera general como se ve el tema.';
// Preset files setting.
$string['presetfiles'] = 'Archivos de preconfiguración de tema adicionales.';
// Preset files help text.
$string['presetfiles_desc'] = 'Los archivos de preconfiguración pueden usarse para alterar drasticamente la apariencia de un tema. Ver <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> para información acerca de cómo crear y compartir sus propios archivos de preconfiguración, y vea el <a href=http://moodle.net/boost>Repositorio de Preconfiguraciones</a> para preconfiguraciones que otros hayan compartido.';
// The background color choices as a general adjustment for all the site.
$string['backgroundcolorchoices'] = 'Color de fondo';
// The background color choices setting description.
$string['backgroundcolorchoices_desc'] = 'El color que será aplicado como fondo a través de todo el sitio';
// The brand colour setting.
$string['brandcolor'] = 'Color de marca';
// The brand colour setting description.
$string['brandcolor_desc'] = 'El color de acento.';

// The name of the second tab in the theme settings.        
$string['settingsrawscss'] = 'Ajustes SCSS en bruto';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'SCSS inicial en bruto';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'En este campo puede proveer codigo de inicialización SCSS, el cual será inyectado antes de cualquier otra cosa. La mayoria del tiempo usará este ajuste para definir variables.';
// Raw SCSS setting.
$string['rawscss'] = 'SCSS en bruto'; 
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Utilice este campo para proveer codigo CSS o SCSS a ser inyectado al final de la hoja de estilos.';

// The name of the third tab in the theme settings.        
$string['settingsloginpage'] = 'Ajustes de pagina de inicio';

$string['loginsettingsheading'] = 'Personalizar la pagina de inicio';
$string['logindesc'] = 'Personalizar la pagina de inicio añadiendo una imagen de fondo y textos encima y debajo de la caja de inicio.';
$string['loginbgimage']     = 'Imagen de fondo';
$string['loginbgimagedesc'] = 'Añada una imagen de fondo a la página a tamaño completo.';
$string['loginbgopacity']     = 'Opacidad de la imagen de fondo';
$string['loginbgopacitydesc'] = 'Opacidad para el fondo en la imagen de inicio. Opacidad 1 significa completamente visible y 0 completamente transparente.';
$string['loginformopacity']     = 'Opacidad de forma de inicio';
$string['loginformopacitydesc'] = 'Opacidad para el fondo en la forma de inicio. Opacidad 1 significa completamente visible y 0 completamente transparente.';
$string['loginlogoposition']     = 'Posición de logo de inicio';
$string['loginlogopositiondesc'] = 'Posición de logo de inicio. Puede tener uno de dos valores y determina la posición del logo en la página de inicio';
$string['loginformposition']     = 'Posición de forma de inicio';
$string['loginformpositiondesc'] = 'Posicion de forma de inicio. Puede tener uno de tres valores y determina la posición de loginbottomtext';
$string['loginnobackground']     = 'Por defecto sin imagen';
$string['loginnobackgrounddesc'] = 'Comportamiento por defecto cuando no hay imagen de fondo.';
$string['loginbackgroundcolor']     = 'Color de fondo';
$string['loginbackgroundcolordesc'] = 'Color de fondo cuando no se provee ninguna imagen';
$string['loginjsrectangles']     = 'Rectangulos JS';
$string['loginjsrectanglesdesc'] = 'Cuando JS está activado, este es el número de figuras que serán producidas';
$string['loginbottomtextshow']     = 'Mostrar texto de inicio inferior';
$string['loginbottomtextshowdesc'] = 'Ocultar/mostrar texto de inicio inferior';
$string['loginbottomtext']     = 'Texto inferior inicio';
$string['loginbottomtextdesc'] = 'Texto a ser incluído en la parte inferior de la página de inicio';
$string['loginnobformatfrontpagebody']     = 'Formato de la sección inferior';
$string['loginnobformatfrontpagebodydesc'] = 'El formato de estilo del texto que será mostrado en la página de inicio';

$string['settingstestpage'] = 'Página de prueba de elementos';
$string['testsettingsheading']     = 'Prueba los elementos que corresponden a la UI Concordia';
$string['testsettingsheadingdesc'] = 'Página de prueba para verificar los elementos de la UI Concordia diseñados para el tema Saimaniq';
$string['styleguide'] = 'Guía de estilos';

$string['learnmore'] = 'Saber más';
$string['learnmoreurl'] = 'https://www.concordia.ca/it.html#notices';
$string['contactit'] = 'Contactar al Servicio de Soporte IT';
$string['contactiturl'] = 'https://www.concordia.ca/it/support.html';

$string['loginmaintext'] = ' ingreso estudiantes, facultad y personal';

// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Derecha';

$string['adminlogin'] = 'Ingreso Admin';
$string['forgotpassword'] = '¿Olvidó su contraseña?';