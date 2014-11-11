<?php return array (
  'e2e84054caf2a69e6d2aa28ef8a96a6e' => 
  array (
    'criteria' => 
    array (
      'name' => 'modavatar',
    ),
    'object' => 
    array (
      'name' => 'modavatar',
      'path' => '{core_path}components/modavatar/',
      'assets_path' => '',
    ),
  ),
  '19915c84e54300b98e48e11bd2647587' => 
  array (
    'criteria' => 
    array (
      'key' => 'modavatar.default_media_source',
    ),
    'object' => 
    array (
      'key' => 'modavatar.default_media_source',
      'value' => '1',
      'xtype' => 'modx-combo-source',
      'namespace' => 'modavatar',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'd53e1832e19e0713a1b21d68bd56b62f' => 
  array (
    'criteria' => 
    array (
      'category' => 'modAvatar',
    ),
    'object' => 
    array (
      'id' => 19,
      'parent' => 0,
      'category' => 'modAvatar',
    ),
    'files' => 
    array (
      0 => '/var/www/vhosts/v2.investable.vc/html/manager/components',
    ),
  ),
  '2abbc66077e35700eda6770397703de6' => 
  array (
    'criteria' => 
    array (
      'name' => 'modAvatar.output_tpl',
    ),
    'object' => 
    array (
      'id' => 51,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'modAvatar.output_tpl',
      'description' => 'Template for userphoto output',
      'editor_type' => 0,
      'category' => 19,
      'cache_type' => 0,
      'snippet' => '<img src="[[+photo]]" title="[[+username]]" />',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<img src="[[+photo]]" title="[[+username]]" />',
    ),
  ),
  'c8e4cab7c7d9620217fadb58c4b31dc0' => 
  array (
    'criteria' => 
    array (
      'name' => 'modAvatar',
    ),
    'object' => 
    array (
      'id' => 58,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'modAvatar',
      'description' => 'Get user photo',
      'editor_type' => 0,
      'category' => 19,
      'cache_type' => 0,
      'snippet' => '$output = \'\';

// Check filters
if(!$userid && !$username && !$email){
    $modx->log(xPDO::LOG_LEVEL_ERROR, "You should set userid or username or email");
    return $output;
}

// Create query
$where = array(
    \'Profile.photo:!=\' => \'\',
);
$q = $modx->newQuery(\'modUser\');
$q->join(\'modUserProfile\', \'Profile\');
$q->select(array(
    \'modUser.id\',
    \'modUser.username\',
    \'Profile.photo\',
    \'Profile.email\',
    \'Profile.fullname\',
));
$q->limit(1);

if($userid){
    $where[\'modUser.id\'] = $userid;
}
if($username){
    $where[\'modUser.username\'] = $username;
}
if($email){
    $where[\'Profile.email\'] = $email;
}
$q->where($where);

if(!$q->prepare() || !$q->stmt->execute()){
    return $output;
}

// get photo
$data = $q->stmt->fetch(PDO::FETCH_ASSOC);

// get mediasource id
if(!$sourceid = $modx->getOption(\'modavatar.default_media_source\', null)){
    $sourceid = $modx->getOption(\'default_media_source\', null, 1);
}
// get full path
if($source = $modx->getObject(\'sources.modMediaSource\', $sourceid) AND $source->initialize()){
    $data[\'photo\'] = $source->getObjectUrl($data[\'photo\']);
}
if($tpl){
    return $modx->getChunk($tpl, $data);
}
return $data[\'photo\'];',
      'locked' => 0,
      'properties' => 'a:4:{s:6:"userid";a:9:{s:4:"name";s:6:"userid";s:4:"desc";s:15:"Find user by id";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:0:"";s:4:"area";s:0:"";s:10:"desc_trans";s:15:"Find user by id";s:10:"area_trans";s:0:"";}s:8:"username";a:9:{s:4:"name";s:8:"username";s:4:"desc";s:21:"Find user by username";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:0:"";s:4:"area";s:0:"";s:10:"desc_trans";s:21:"Find user by username";s:10:"area_trans";s:0:"";}s:5:"email";a:9:{s:4:"name";s:5:"email";s:4:"desc";s:18:"Find user by email";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:0:"";s:4:"area";s:0:"";s:10:"desc_trans";s:18:"Find user by email";s:10:"area_trans";s:0:"";}s:3:"tpl";a:9:{s:4:"name";s:3:"tpl";s:4:"desc";s:43:"If set tpl, output will be return via chunk";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:20:"modAvatar.output_tpl";s:7:"lexicon";s:0:"";s:4:"area";s:0:"";s:10:"desc_trans";s:43:"If set tpl, output will be return via chunk";s:10:"area_trans";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '$output = \'\';

// Check filters
if(!$userid && !$username && !$email){
    $modx->log(xPDO::LOG_LEVEL_ERROR, "You should set userid or username or email");
    return $output;
}

// Create query
$where = array(
    \'Profile.photo:!=\' => \'\',
);
$q = $modx->newQuery(\'modUser\');
$q->join(\'modUserProfile\', \'Profile\');
$q->select(array(
    \'modUser.id\',
    \'modUser.username\',
    \'Profile.photo\',
    \'Profile.email\',
    \'Profile.fullname\',
));
$q->limit(1);

if($userid){
    $where[\'modUser.id\'] = $userid;
}
if($username){
    $where[\'modUser.username\'] = $username;
}
if($email){
    $where[\'Profile.email\'] = $email;
}
$q->where($where);

if(!$q->prepare() || !$q->stmt->execute()){
    return $output;
}

// get photo
$data = $q->stmt->fetch(PDO::FETCH_ASSOC);

// get mediasource id
if(!$sourceid = $modx->getOption(\'modavatar.default_media_source\', null)){
    $sourceid = $modx->getOption(\'default_media_source\', null, 1);
}
// get full path
if($source = $modx->getObject(\'sources.modMediaSource\', $sourceid) AND $source->initialize()){
    $data[\'photo\'] = $source->getObjectUrl($data[\'photo\']);
}
if($tpl){
    return $modx->getChunk($tpl, $data);
}
return $data[\'photo\'];',
    ),
  ),
  '0848c145d0b8236f78c7f4caaf0b86fc' => 
  array (
    'criteria' => 
    array (
      'name' => 'modavatar',
    ),
    'object' => 
    array (
      'id' => 6,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'modavatar',
      'description' => '',
      'editor_type' => 0,
      'category' => 19,
      'cache_type' => 0,
      'plugincode' => 'switch($modx->event->name){
    case \'OnUserFormPrerender\':
        $modx->lexicon->load(\'modavatar:default\');
        
        $mgrUrl = $modx->getOption(\'manager_url\',null,MODX_MANAGER_URL);
        $modx->regClientStartupScript($mgrUrl.\'assets/modext/widgets/element/modx.panel.tv.renders.js\');
         
        $photo;
        
        if($scriptProperties[\'user\']->Profile){
            $photo = $scriptProperties[\'user\']->Profile->get(\'photo\');
        }
        
        if(!$path = $modx->getOption(\'modavatar.manager_url\', null)){
            $path = $modx->getOption(\'manager_url\', null).\'components/modavatar/\';
        }
        $path .= \'js/\';
        
        if(!$source = $modx->getOption(\'modavatar.default_media_source\', null)){
            $source = $modx->getOption(\'default_media_source\', null, 1);
        }
        
        $modx->regClientStartupScript($path.\'core/modavatar.js\');
        
        $lexicon = (array)$modx->lexicon->loadCache(\'modavatar\');
        $modx->regClientStartupScript( \'<script type="text/javascript">
            MODx.ux.modAvatar = new MODx.ux.modAvatar({
                lexicon: \'.$modx->toJSON($lexicon).\'
            });
</script>\',true);
        $modx->regClientStartupScript($path.\'widgets/userpanel.js\');
        $modx->regClientStartupScript( \'<script type="text/javascript">
            Ext.onReady(function(){
                var tab = Ext.getCmp("modx-user-tabs");
                var panel = Ext.getCmp("modx-panel-user");
                var infotab = tab.find("title", _("general_information"));
                var infopanel;
                var user;
                try{
                    user = infotab[0].get(0);
                    infopanel = user.get(0);
                }
                catch(e){
                    return;
                }  
                var fieldset = new MODx.ux.modAvatar.widget.UserPanel({
                    panel: panel
                    ,photo: "\'.$photo.\'"
                    ,source: \'.$source.\'
                });
                infopanel.add(fieldset);
            });
</script>\',true);
        break;
}',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => 'switch($modx->event->name){
    case \'OnUserFormPrerender\':
        $modx->lexicon->load(\'modavatar:default\');
        
        $mgrUrl = $modx->getOption(\'manager_url\',null,MODX_MANAGER_URL);
        $modx->regClientStartupScript($mgrUrl.\'assets/modext/widgets/element/modx.panel.tv.renders.js\');
         
        $photo;
        
        if($scriptProperties[\'user\']->Profile){
            $photo = $scriptProperties[\'user\']->Profile->get(\'photo\');
        }
        
        if(!$path = $modx->getOption(\'modavatar.manager_url\', null)){
            $path = $modx->getOption(\'manager_url\', null).\'components/modavatar/\';
        }
        $path .= \'js/\';
        
        if(!$source = $modx->getOption(\'modavatar.default_media_source\', null)){
            $source = $modx->getOption(\'default_media_source\', null, 1);
        }
        
        $modx->regClientStartupScript($path.\'core/modavatar.js\');
        
        $lexicon = (array)$modx->lexicon->loadCache(\'modavatar\');
        $modx->regClientStartupScript( \'<script type="text/javascript">
            MODx.ux.modAvatar = new MODx.ux.modAvatar({
                lexicon: \'.$modx->toJSON($lexicon).\'
            });
</script>\',true);
        $modx->regClientStartupScript($path.\'widgets/userpanel.js\');
        $modx->regClientStartupScript( \'<script type="text/javascript">
            Ext.onReady(function(){
                var tab = Ext.getCmp("modx-user-tabs");
                var panel = Ext.getCmp("modx-panel-user");
                var infotab = tab.find("title", _("general_information"));
                var infopanel;
                var user;
                try{
                    user = infotab[0].get(0);
                    infopanel = user.get(0);
                }
                catch(e){
                    return;
                }  
                var fieldset = new MODx.ux.modAvatar.widget.UserPanel({
                    panel: panel
                    ,photo: "\'.$photo.\'"
                    ,source: \'.$source.\'
                });
                infopanel.add(fieldset);
            });
</script>\',true);
        break;
}',
    ),
  ),
  '9b651d78bdc185854262ed38d04f343b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 6,
      'event' => 'OnUserFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 6,
      'event' => 'OnUserFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);