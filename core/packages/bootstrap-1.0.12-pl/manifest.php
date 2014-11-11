<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'The MIT License (MIT)

Copyright (c) 2014 Dmitry Ponomarev (email: ponomarev.dev@gmail.com)

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
',
    'readme' => '=== Bootstrap ===
Extra Version: 1.0.12-pl
Requires at least: Revolution 2.2.x
Contributor: earthperson (Dmitry Ponomarev) <ponomarev.dev@gmail.com>
Donate link: 
Contributor Website: http://earthperson.info
Extra Website: http://modx.com/extras/package/bootstrap
Extra GitHub page: https://github.com/earthperson/MODX-Bootstrap
Tags: bootstrap, twitter bootstrap, template, style
License: The MIT License (MIT)
License URI: http://opensource.org/licenses/MIT

== Description ==

Extra for starting with Twitter Bootstrap - open source front-end framework. This extra is especially useful for MODX Revo beginners and/or for the blank (fresh) MODX Revo installation with Twitter Bootstrap framework in the future.

Dependencies (will be installed automatically): BreadCrumb, If, Wayfinder.

You can go to the System Settings and set setting bootstrap.dropdown_disabled to 0 or 1. If equal to 1 then the upper menu item that has child pages will be possible to click and go to the corresponding page.

== Installation ==

Install via Package Management. Use the BootstrapTemplate for your resources (pages).
',
    'changelog' => 'Changelog file for Bootstrap.

Bootstrap 1.0.12-pl
====================================
- Removed donate link in the readme.txt

Bootstrap 1.0.11-pl
====================================
- Updated dependency BreadCrumb in the _build/subpackages to 1.4.2-pl

Bootstrap 1.0.10-pl
====================================
- Updated bootstrap/dist to v3.2.0
- Updated bootstrap/vendor/js/html5shiv.js to v3.7.2

Bootstrap 1.0.9-pl
====================================
- Updated bootstrap/vendor/js/jquery.js to v1.11.1

Bootstrap 1.0.8-pl
====================================
- Minor BootstrapTemplate cleanup
- Added URL of this extra at the bottom right of the chunk Footer
- Added donate link in the readme.txt

Bootstrap 1.0.7-pl
====================================
- This update is actual for new installation only, because templates and chunks are not overridden during extra update or reinstall
- Added lang="[[++cultureKey]]" instead of lang="en" in the BootstrapTemplate
- Updated BootstrapTemplate, chunk Head and style.css for new "Sticky footer" implementation

Bootstrap 1.0.6-pl
====================================
- Skip update templates and chunks during extra update or reinstall
- Setting bootstrap.dropdown_disabled equal to 1 by default

Bootstrap 1.0.5-pl
====================================
- Updated bootstrap/dist to v3.1.1

Bootstrap 1.0.4-pl
====================================
- Fixed bootstrap dist contents

Bootstrap 1.0.3-pl
====================================
- Updated readme

Bootstrap 1.0.3-beta-1
====================================
- Added lexicons
- Updated readme
- Fixed setting bootstrap.dropdown_disabled
- Zip up transport package via the Build script instead of the extra PackMan

Bootstrap 1.0.2-beta-1
====================================
- Updated readme

Bootstrap 1.0.1-beta-1
====================================
- Updated template BootstrapTemplate
- Updated chunk Header
- Added [[++site_url]] instead of "/" in the chunk Navbar
- Updated bootstrap/dist to v3.1.0
- Updated bootstrap/vendor/html5shiv.js to v3.7.0
- Updated bootstrap/vendor/respond.min.js to v1.4.2
- Updated bootstrap/vendor/jquery.js to v1.11.0
 
Bootstrap 1.0.0-beta-1
====================================
- Initial release
',
    'setup-options' => 'bootstrap-1.0.12-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'f5eb3d29603dfd644537135564916849',
      'native_key' => 'bootstrap',
      'filename' => 'modNamespace/38ef303071046636c2e706f543c77082.vehicle',
      'namespace' => 'bootstrap',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOTransportVehicle',
      'class' => 'xPDOTransportVehicle',
      'guid' => '07bf2f4b312019adb2a3b056e17e3449',
      'native_key' => '07bf2f4b312019adb2a3b056e17e3449',
      'filename' => 'xPDOTransportVehicle/6b0858f7bdeb1d5f6cb38490bc1f4097.vehicle',
      'namespace' => 'bootstrap',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOTransportVehicle',
      'class' => 'xPDOTransportVehicle',
      'guid' => '1c06218ed91ae6986290ab09af51e972',
      'native_key' => '1c06218ed91ae6986290ab09af51e972',
      'filename' => 'xPDOTransportVehicle/879c31e675d31298eb12cc48d60fb6a1.vehicle',
      'namespace' => 'bootstrap',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOTransportVehicle',
      'class' => 'xPDOTransportVehicle',
      'guid' => 'd7cf4e83761d7e0c1395014fca223b04',
      'native_key' => 'd7cf4e83761d7e0c1395014fca223b04',
      'filename' => 'xPDOTransportVehicle/d084e72f2a1537ff036a73c63560b05e.vehicle',
      'namespace' => 'bootstrap',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => 'e51318b2eb3b3ae21ce5e790f7640817',
      'native_key' => 0,
      'filename' => 'modCategory/ff422ca45c5abcf2f9867e82025b7c35.vehicle',
      'namespace' => 'bootstrap',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '407001af86914d634d9cd1f99a569923',
      'native_key' => 'bootstrap.dropdown_disabled',
      'filename' => 'modSystemSetting/9c62c339c01781d843f122067201e697.vehicle',
      'namespace' => 'bootstrap',
    ),
  ),
);