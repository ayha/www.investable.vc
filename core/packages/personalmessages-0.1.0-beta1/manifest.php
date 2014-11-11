<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'readme' => 'Simple snippets to work with private messages.

Examples:

1. List of received (sent) messages:
[[!pmInbox:default=`No messages`? 
&mode=`receive` (or sent) // `receive` or `sent`
&tpl=`pmMessageTpl` //template for the output of each message
&markAsRead=`0` // unreaded messages will be marked as read
&targetId=`111` // page with call of "pmRead" snippet
]]

2. Reading the message.
[[!pmRead]] 
<p>Subject: [[+pm.subject]]</p>
<p>Message: [[+pm.message]]</p>
<p>User: [[+pm.sender.username]] - [[+pm.sender.profile.fullname]] </p>

You can use any fields in your page from modUserMessage, modUser, modUserProfile

3. Sending a message.
<!-- load recipient details from request: (example /send/?recipient=15, where 15 -  user identifier)
[[!pmRecipientDetails?
&placeholderPrefix=`pm.recipient.`
&paramName=`recipient`
]]

[[!FormIt? 
&hooks=`pmSend`
&validate=`recipient:required:isNumber,subject:required,message:required`
&submitVar=`send`
]]
<form action="[[~[[*id]]]]" method="post">
  To: [[+pm.recipient.username]]
  <input type="hidden" name="recipient" value="[[+pm.recipient.id]]"/>
  
  <label>Subject:</label>
  <input type="text" name="subject" value="[[!+fi.subject]]"/>
  <span class="error">[[!+fi.error.subject]]</span>  

  <label>Message:</label>
  <textarea name="message">[[!+fi.message]]</textarea>             
  <span class="error">[[!+fi.error.message]]</span>
  
  <div class="form-buttons">
    <input type="submit" name="send" value="Send"/>
  </div>
</form>

4. The number of unread messages
[[!pmUnreadCount? &toPlaceholder=`0`]] // this is default
or
[[!pmUnreadCount? &toPlaceholder=`1` &placeholderPrefix=`pm.`]]
[[+pm.unread]]',
    'changelog' => '0.1.0
 - initial release',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '3d5d9862a48ee9d5de1be825ec7fe74d',
      'native_key' => 'personalmessages',
      'filename' => 'modNamespace/e075ce0e726af454d4870033ff5ae73e.vehicle',
      'namespace' => 'personalmessages',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => 'd3ab049797ff61bf6b52031b5de00004',
      'native_key' => 1,
      'filename' => 'modCategory/a1ec1ffae44748d9f2aa424f050c4580.vehicle',
      'namespace' => 'personalmessages',
    ),
  ),
);