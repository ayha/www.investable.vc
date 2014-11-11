<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => '',
    'readme' => 'modAvatar allow to update user profile photo via adminpanel (manager)

Note! If you set another Media source than default, use modAvatar snippet for
get correct path.',
    'changelog' => 'modAvatar-1.1.0-beta
============================================
- [#2] Added MediaSources support
- Added snippet modAvatar
- Added chunk modAvatar.output_tpl

modAvatar-1.0.2-beta
============================================
- [#1] Fix JS error - MODX.ux undefined

modAvatar-1.0.1-beta
============================================
- Remove waste code

modAvatar-1.0.0-beta
============================================
First release
',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'e2e84054caf2a69e6d2aa28ef8a96a6e',
      'native_key' => 'modavatar',
      'filename' => 'modNamespace/d61e733239cd407648ddd05894a1fcf2.vehicle',
      'namespace' => 'modavatar',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '19915c84e54300b98e48e11bd2647587',
      'native_key' => 'modavatar.default_media_source',
      'filename' => 'modSystemSetting/93a6a6a0066f1574575760e9f088c6a1.vehicle',
      'namespace' => 'modavatar',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => 'd53e1832e19e0713a1b21d68bd56b62f',
      'native_key' => 1,
      'filename' => 'modCategory/02ab7ee806c19e64552325f32676430b.vehicle',
      'namespace' => 'modavatar',
    ),
  ),
);