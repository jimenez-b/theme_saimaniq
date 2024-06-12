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
- [ ] CONUMDLS01 - Integrations
- - [x] CONUMDLS0101 Build settings page to include integrations
- - [ ] CONUMDLS0102 Build LivePerson integration
- - ~~[ ] CONUMDLS0102 Build Proctorio integration (deemed not necessary)~~ 
- - ~~[ ] CONUMDLS0103 Build Conquizzer integration (deemed not necessary)~~
- [ ] CONUMDLS02 - Features coming from COLEv2
- - [ ] CONUMDLS0201 Branding
- - [ ] CONUMDLS0202 Support FAQ Sidebar
- - [ ] CONUMDLS0203 General Quiz UX/UI
- - [ ] CONUMDLS0204 Summary of questions
- - [ ] CONUMDLS0205 Prevent clicking on exam exit
- - [ ] CONUMDLS0206 Customized checkboxes for the Copyright notice and the Terms and conditions
- - [ ] CONUMDLS0207 Add second verification for Copyright notice and Terms and conditions checkboxes
- [ ] CONUMDLS03 - Miscellaneous
- - [ ] CONUMDLS0301 Review table css
- - [ ] CONUMDLS0302 Review add/remove users css
- - [ ] CONUMDLS0303 Cleanup code lib.php
- - [ ] CONUMDLS0303 Cleanup code settings_general.php
- [ ] CONUMDLS04 - Settings
- - [ ] CONUMDLS0401 Create course settings page
- - [ ] CONUMDLS0402 Create home settings page
- - [ ] CONUMDLS0403 Review the order for the Test settings page
- [ ] CONUMDLS05 - Features
- - [ ] CONUMDLS0501 Provide a way of highlighting new activities, so students are alerted to new activities
- - [ ] CONUMDLS0502 Dark mode
- - [ ] CONUMDLS0503 Review fonts, especially main Concordia font, due to the issues (ethical) regarding gill sans
- [ ] CONUMDLS06 - Languages
- - [ ] CONUMDLS0601 Update language strings in additional languages for settings pages
- [ ] CONUMDLS07 - Bugs
- - [ ] CONUMDLS0701 columnresizer bug on selector

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
