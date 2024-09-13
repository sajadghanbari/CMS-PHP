<?php
require 'vendor/autoload.php' ;
class Notifications
{
    public function sendNotifications($data)
    {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '024cfc8920c19b59aac9',
            '645c8b66f815d38b4a5c',
            '1861764',
            $options
          );
        
          $pusher->trigger('my-channel', 'my-event', $data);
    }
}
?>