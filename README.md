![Concordia logo](https://www.concordia.ca/etc/designs/concordia/clientlibs/img/logo-concordia-university-montreal.png)

# Saimaniq Theme for Moodle #

Named after the inuit word for "Peace", Saimaniq is a theme created for Concordia University, 
using Boost 3.9 as it's main inspirtation.


### FEATURES: ###
1. Configurable login page via settings
2. Concordia branding (fonts and colors)
3. Colors applied as per Concordia rules regarding accesibility
4. Custom branding and visuals for plugins
   - a. Poodll audio player
   - b. Multiblock
   - c. ConU Library Search
   - d. Components for Learning
5. Mobile log-in

### TODO LIST: ###
- [ ] MS01 - Integrations
- - [ ] MS0101 Build settings page to include integrations
- - [ ] MS0102 Build LivePerson integration
- - [ ] MS0102 Build Proctorio integration
- - [ ] MS0103 Build Conquizzer integration
- [ ] MS02 - Features coming from COLEv2
- - [ ] MS0201 Branding
- - [ ] MS0202 Support FAQ Sidebar
- - [ ] MS0203 General Quiz UX/UI
- - [ ] MS0204 Summary of questions
- - [ ] MS0204 Prevent clicking on exam exit
- - [ ] MS0205 Customized checkboxes for the Copyright notice and the Terms and conditions
- - [ ] MS0206 Add second verification for Copyright notice and Terms and conditions checkboxes


1. Review fonts, especially main Concordia font, due to the issues (ethical) regarding gill sans
2. M4-047 - Provide a way of highlighting new activities, so students are alerted to new activities
   Indicate on the front page when the item was last updated (so students know if a document was recently updated)
3. Dark mode
4. Home page design and settings
5. Review table css
6. Review add/remove users css

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/theme/saimaniq

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

Created for Concordia University by:
2023 Brandon Jimenez <brandon.jimenez@concordia.ca>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
