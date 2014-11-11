<?php /* Smarty version Smarty-3.0.4, created on 2014-11-11 09:50:27
         compiled from "/var/www/html/manager/templates/default/element/tv/renders/input/listbox-single.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22761350754616b63ad31c2-87292635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b2e1514894071f8e7a9c5fa8e1a51f9d68efb4d' => 
    array (
      0 => '/var/www/html/manager/templates/default/element/tv/renders/input/listbox-single.tpl',
      1 => 1415598434,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22761350754616b63ad31c2-87292635',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<select id="tv<?php echo $_smarty_tpl->getVariable('tv')->value->id;?>
" name="tv<?php echo $_smarty_tpl->getVariable('tv')->value->id;?>
">
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('opts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
	<option value="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['value']) ? $_smarty_tpl->tpl_vars['item']->value['value'] : null);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['selected']) ? $_smarty_tpl->tpl_vars['item']->value['selected'] : null)){?> selected="selected"<?php }?>><?php echo (isset($_smarty_tpl->tpl_vars['item']->value['text']) ? $_smarty_tpl->tpl_vars['item']->value['text'] : null);?>
</option>
<?php }} ?>
</select>


<script type="text/javascript">
// <![CDATA[

Ext.onReady(function() {
    var fld = MODx.load({
    
        xtype: 'combo'
        ,transform: 'tv<?php echo $_smarty_tpl->getVariable('tv')->value->id;?>
'
        ,id: 'tv<?php echo $_smarty_tpl->getVariable('tv')->value->id;?>
'
        ,triggerAction: 'all'
        ,width: 400
        ,allowBlank: <?php if ((isset($_smarty_tpl->getVariable('params')->value['allowBlank']) ? $_smarty_tpl->getVariable('params')->value['allowBlank'] : null)==1||(isset($_smarty_tpl->getVariable('params')->value['allowBlank']) ? $_smarty_tpl->getVariable('params')->value['allowBlank'] : null)=='true'){?>true<?php }else{ ?>false<?php }?>

        <?php if ((isset($_smarty_tpl->getVariable('params')->value['title']) ? $_smarty_tpl->getVariable('params')->value['title'] : null)){?>,title: '<?php echo (isset($_smarty_tpl->getVariable('params')->value['title']) ? $_smarty_tpl->getVariable('params')->value['title'] : null);?>
'<?php }?>
        <?php if ((isset($_smarty_tpl->getVariable('params')->value['listWidth']) ? $_smarty_tpl->getVariable('params')->value['listWidth'] : null)){?>,listWidth: <?php echo (isset($_smarty_tpl->getVariable('params')->value['listWidth']) ? $_smarty_tpl->getVariable('params')->value['listWidth'] : null);?>
<?php }?>
        ,maxHeight: <?php if ((isset($_smarty_tpl->getVariable('params')->value['maxHeight']) ? $_smarty_tpl->getVariable('params')->value['maxHeight'] : null)){?><?php echo (isset($_smarty_tpl->getVariable('params')->value['maxHeight']) ? $_smarty_tpl->getVariable('params')->value['maxHeight'] : null);?>
<?php }else{ ?>300<?php }?>
        <?php if ((isset($_smarty_tpl->getVariable('params')->value['typeAhead']) ? $_smarty_tpl->getVariable('params')->value['typeAhead'] : null)){?>
            ,typeAhead: true
            ,typeAheadDelay: <?php if ((isset($_smarty_tpl->getVariable('params')->value['typeAheadDelay']) ? $_smarty_tpl->getVariable('params')->value['typeAheadDelay'] : null)&&(isset($_smarty_tpl->getVariable('params')->value['typeAheadDelay']) ? $_smarty_tpl->getVariable('params')->value['typeAheadDelay'] : null)!=''){?><?php echo (isset($_smarty_tpl->getVariable('params')->value['typeAheadDelay']) ? $_smarty_tpl->getVariable('params')->value['typeAheadDelay'] : null);?>
<?php }else{ ?>250<?php }?>
        <?php }else{ ?>
            ,editable: false
            ,typeAhead: false
        <?php }?>
        <?php if ((isset($_smarty_tpl->getVariable('params')->value['listEmptyText']) ? $_smarty_tpl->getVariable('params')->value['listEmptyText'] : null)){?>
            ,listEmptyText: '<?php echo (isset($_smarty_tpl->getVariable('params')->value['listEmptyText']) ? $_smarty_tpl->getVariable('params')->value['listEmptyText'] : null);?>
'
        <?php }?>
        ,forceSelection: <?php if ((isset($_smarty_tpl->getVariable('params')->value['forceSelection']) ? $_smarty_tpl->getVariable('params')->value['forceSelection'] : null)&&(isset($_smarty_tpl->getVariable('params')->value['forceSelection']) ? $_smarty_tpl->getVariable('params')->value['forceSelection'] : null)!='false'){?>true<?php }else{ ?>false<?php }?>
        ,msgTarget: 'under'

    
        ,listeners: { 'select': { fn:MODx.fireResourceFormChange, scope:this}}
    });
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
});

// ]]>
</script>
