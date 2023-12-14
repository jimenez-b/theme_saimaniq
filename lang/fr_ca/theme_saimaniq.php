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
$string['choosereadme'] = '« Saimaniq », mot inuktitut signifiant « paix », est notre nouveau thème Boost dans Moodle. Il reflète la signature de Concordia et comporte quelques caractéristiques supplémentaires, comme une page de connexion personnalisable.';
// Name of the settings pages.
$string['configtitle'] = 'Paramètres de Saimaniq';
// Name of the first settings tab.
$string['generalsettings'] = 'Paramètres généraux';
// Preset setting.
$string['preset'] = 'Configuration préalable du thème';
// Preset help text.
$string['preset_desc'] = 'Choisissez une configuration préalable pour changer l\'aspect général du thème.';
// Preset files setting.
$string['presetfiles'] = 'Fichiers supplémentaires de configuration préalable du thème';
// Preset files help text.
$string['presetfiles_desc'] = 'Les fichiers de configuration préalable peuvent être utilisés pour modifier considérablement l\'aspect du thème. Voir <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> pour information sur la creation et le partage des fichiers préalables, et voir le <a href=http://moodle.net/boost>Presets repository</a> pour les configurations préalables partagées par d\'autres utilisateurs.';
// The background color choices as a general adjustment for all the site.
$string['backgroundcolorchoices'] = 'Couleur d\'arrière-plan';
// The background color choices setting description.
$string['backgroundcolorchoices_desc'] = 'Couleur appliquée à l\'arrière-plan de tout le site';
// The brand colour setting.
$string['brandcolor'] = 'Couleur signature';
// The brand colour setting description.
$string['brandcolor_desc'] = 'Couleur d\'accent.';

// The name of the second tab in the theme settings.        
$string['settingsrawscss'] = 'Paramètres SCSS bruts';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'SCSS initial brut';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'Ce champ permet d\'entrer un code SCSS d\'initialisation qui est pris en compte avant tout autre. La plupart du temps, ce paramètre est utilisé pour définir des variables.';
// Raw SCSS setting.
$string['rawscss'] = 'SCSS brut'; 
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Utilisez ce champ pour entrer un code SCSS ou CSS qui est pris en compte à la fin de la feuille de style.';

// The name of the third tab in the theme settings.        
$string['settingsloginpage'] = 'Paramètres de la page de connexion';

$string['loginsettingsheading'] = 'Personnaliser la page de connexion';
$string['logindesc'] = 'Personnalisez la page de connexion en ajoutant une image d\'arrière-plan et du texte au-dessus et au-dessous de la boîte de connexion.';
$string['loginbgimage']     = 'Image d\'arrière-plan';
$string['loginbgimagedesc'] = 'Ajoutez une image d\'arrière-plan à la page pleine grandeur.';
$string['loginmaintextconf']     = 'Texte de page de connexion';
$string['loginmaintextconfdesc'] = 'Texte à inclure comme guide dans la page de connexion.';
$string['loginbgopacity']     = 'Opacité de l\'image d\'arrière-plan';
$string['loginbgopacitydesc'] = 'Opacité de l\'image d\'arrière-plan de la page de connexion - opacité 1 signifie entièrement visible, et 0 entièrement transparente.';
$string['loginformopacity']     = 'Opacité du formulaire de connexion';
$string['loginformopacitydesc'] = 'Opacité du formulaire de la page de connexion - opacité 1 signifie entièrement visible, et 0 entièrement transparent.';
$string['loginlogoposition']     = 'Position du logo de connexion';
$string['loginlogopositiondesc'] = 'Position du logo de connexion - l\'une des deux valeurs possibles détermine la position du logo sur la page de connexion.';
$string['loginformposition']     = 'Position du formulaire de connexion';
$string['loginformpositiondesc'] = 'Position du formulaire de connexion - l\'une des trois valeurs possibles détermine la position du loginbottomtext';
$string['loginnobackground']     = 'Défaut sans image';
$string['loginnobackgrounddesc'] = 'Comportement par défaut lorsque aucune image d\'arrière-plan n\'est présente.';
$string['loginbackgroundcolor']     = 'Couleur d\'arrière-plan';
$string['loginbackgroundcolordesc'] = 'Couleur d\'arrière-plan lorsque aucune image n\'est fournie.';
$string['loginjsrectangles']     = 'Rectangles JS';
$string['loginjsrectanglesdesc'] = 'Nombre de figures à produire lorsque JS est activé.';
$string['loginbottomtextshow']     = 'Afficher le texte de bas de page de connexion';
$string['loginbottomtextshowdesc'] = 'Cachez ou affichez le texte de bas de page de connexion.';
$string['loginbottomtext']     = 'Texte de bas de page de connexion';
$string['loginbottomtextdesc'] = 'Texte à inclure au bas de la page de connexion.';
$string['loginnobformatfrontpagebody']     = 'Format du bas de page';
$string['loginnobformatfrontpagebodydesc'] = 'Style du texte qui apparaît sur la page de connexion.';

$string['settingstestpage'] = 'Page d\'essai des paramètres';
$string['testsettingsheading']     = 'Tester les éléments correspondant à l\'interface utilisateur de Concordia';
$string['testsettingsheadingdesc'] = 'Page de teste pour vérifier les éléments de l\'interface utilisateur de Concordia conçus pour le thème Saimaniq.';
$string['styleguide'] = 'Guide de style';

$string['learnmore'] = 'En savoir plus';
$string['learnmoreurl'] = 'https://www.concordia.ca/it.html#notices';
$string['contactit'] = 'Contacter le Service d’assistance des TI';
$string['contactiturl'] = 'https://www.concordia.ca/it/support.html';

$string['loginmaintext'] = ' connexion – effectif étudiant, corps professoral et personnel';

// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Droit';

$string['adminlogin'] = 'Connexion – administrateur';
$string['forgotpassword'] = 'Mot de passe oublié?';