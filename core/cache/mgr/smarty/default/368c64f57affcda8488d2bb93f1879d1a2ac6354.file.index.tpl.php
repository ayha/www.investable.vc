<?php /* Smarty version Smarty-3.0.4, created on 2014-11-11 09:54:30
         compiled from "/var/www/html/manager/templates/default/browser/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38627685554616c56e38158-25225736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '368c64f57affcda8488d2bb93f1879d1a2ac6354' => 
    array (
      0 => '/var/www/html/manager/templates/default/browser/index.tpl',
      1 => 1415598434,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38627685554616c56e38158-25225736',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php if ((isset($_smarty_tpl->getVariable('_config')->value['manager_direction']) ? $_smarty_tpl->getVariable('_config')->value['manager_direction'] : null)=='rtl'){?>dir="rtl"<?php }?> lang="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_lang_attribute']) ? $_smarty_tpl->getVariable('_config')->value['manager_lang_attribute'] : null);?>
" xml:lang="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_lang_attribute']) ? $_smarty_tpl->getVariable('_config')->value['manager_lang_attribute'] : null);?>
">
<head>
<title>MODX :: <?php echo (isset($_smarty_tpl->getVariable('_lang')->value['modx_resource_browser']) ? $_smarty_tpl->getVariable('_lang')->value['modx_resource_browser'] : null);?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo (isset($_smarty_tpl->getVariable('_config')->value['modx_charset']) ? $_smarty_tpl->getVariable('_config')->value['modx_charset'] : null);?>
" />


<?php if ((isset($_smarty_tpl->getVariable('_config')->value['compress_css']) ? $_smarty_tpl->getVariable('_config')->value['compress_css'] : null)){?>
<link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/ext3/resources/css/ext-all-notheme-min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
min/index.php?f=<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
templates/default/css/xtheme-modx.css,<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
templates/default/css/index.css" />
<?php }else{ ?>
<link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/ext3/resources/css/ext-all-notheme-min.css" />
<!--link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
templates/default/css/xtheme-modx.css" /-->
<link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
templates/default/css/index.css" />
<?php }?>

<?php if ((isset($_smarty_tpl->getVariable('_config')->value['ext_debug']) ? $_smarty_tpl->getVariable('_config')->value['ext_debug'] : null)){?>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/ext3/adapter/ext/ext-base-debug.js" type="text/javascript"></script>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/ext3/ext-all-debug.js" type="text/javascript"></script>
<?php }else{ ?>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/ext3/adapter/ext/ext-base.js" type="text/javascript"></script>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/ext3/ext-all.js" type="text/javascript"></script>
<?php }?>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/modext/core/modx.js" type="text/javascript"></script>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['connectors_url']) ? $_smarty_tpl->getVariable('_config')->value['connectors_url'] : null);?>
lang.js.php?ctx=mgr&topic=category,file,resource&action=<?php echo preg_replace('!<[^>]*?>!', ' ', (isset($_GET['a'])? $_GET['a'] : null));?>
" type="text/javascript"></script>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['connectors_url']) ? $_smarty_tpl->getVariable('_config')->value['connectors_url'] : null);?>
modx.config.js.php?action=<?php echo preg_replace('!<[^>]*?>!', ' ', (isset($_GET['a'])? $_GET['a'] : null));?>
<?php if ($_smarty_tpl->getVariable('_ctx')->value){?>&wctx=<?php echo $_smarty_tpl->getVariable('_ctx')->value;?>
<?php }?>" type="text/javascript"></script>

<?php if ((isset($_smarty_tpl->getVariable('_config')->value['compress_js_groups']) ? $_smarty_tpl->getVariable('_config')->value['compress_js_groups'] : null)){?>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
min/index.php?g=coreJs1" type="text/javascript"></script>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
min/index.php?g=coreJs2" type="text/javascript"></script>
<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
min/index.php?g=coreJs3" type="text/javascript"></script>
<?php }?>

<?php echo $_smarty_tpl->getVariable('maincssjs')->value;?>

<script src="<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
assets/modext/widgets/core/modx.rte.browser.js" type="text/javascript"></script>

<?php  $_smarty_tpl->tpl_vars['scr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cssjs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['scr']->key => $_smarty_tpl->tpl_vars['scr']->value){
?>
<?php echo (isset($_smarty_tpl->tpl_vars['scr']->value) ? $_smarty_tpl->tpl_vars['scr']->value : null);?>

<?php }} ?>

<?php echo $_smarty_tpl->getVariable('rteincludes')->value;?>

<!--[if IE]>
<style type="text/css">body { behavior: url("<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_url']) ? $_smarty_tpl->getVariable('_config')->value['manager_url'] : null);?>
templates/<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_theme']) ? $_smarty_tpl->getVariable('_config')->value['manager_theme'] : null);?>
/css/csshover3.htc"); }</style>
<link rel="stylesheet" type="text/css" href="templates/<?php echo (isset($_smarty_tpl->getVariable('_config')->value['manager_theme']) ? $_smarty_tpl->getVariable('_config')->value['manager_theme'] : null);?>
/css/ie.css" />
<![endif]-->
</head>
<body>


<script type="text/javascript">
Ext.onReady(function() {
    Ext.QuickTips.init();
    Ext.BLANK_IMAGE_URL = MODx.config.manager_url+'assets/ext3/resources/images/default/s.gif';
    MODx.onBrowserReturn = <?php echo $_smarty_tpl->getVariable('rtecallback')->value;?>
;
    MODx.ctx = "<?php if ($_smarty_tpl->getVariable('_ctx')->value){?><?php echo $_smarty_tpl->getVariable('_ctx')->value;?>
<?php }else{ ?>web<?php }?>";
    MODx.load({
       xtype: 'modx-browser-rte'
       ,auth: '<?php echo $_smarty_tpl->getVariable('site_id')->value;?>
'
    });
});
</script>

</body>
</html>
