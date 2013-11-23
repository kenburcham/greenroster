<?php
/**
 * Sends a text message.  currently you have to specify (line 13) which engine to use.
 * Ken Burcham 4/27
 * 
 */
class TxtSender
{
    public $senderClass;
    
    public function TxtSender()
    {
        $this->senderClass  = new SendHub(); //DI needed!
    }
    
    public function send($number, $message)
    {
        if(!is_array($number))
            $number = array($number);
        
        return $this->senderClass->sendText($number, $message);
    }
}

?>
