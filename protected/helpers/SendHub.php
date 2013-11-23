<?php
/*
 * SendHub text message sending engine
 * Ken Burcham 4/27/13
 * 
 */
class SendHub implements ITxtSenderEngine
{
        private $sendhubapi;
        private $sendhubnumber;
        private $sendhuburl = 'https://api.sendhub.com/v1/';
        private $sendhubcredential;
        
    
        public function SendHub()
        {
            $this->sendhubapi = Yii::app()->params['sendHubApiKey'];
            $this->sendhubnumber = Yii::app()->params['sendHubNumber'];
            $this->sendhubcredential = array('username' => $this->sendhubnumber, 'api_key' => $this->sendhubapi);
        }
    
        /**
         * send a text message to a mobile number
         * 
         * @param array $numbers the array of numbers you want to send the message to
         * @param string $message the text message you want to send
         * @return boolean did we send it ok?
         */
        public function sendText($numbers, $message)
        {
            $contact_ids = $this->getContactIds($numbers);
            
            $ids_to_send = array();
            
            foreach($numbers as $number)
            {
                $number = "+1".$number; //all of the numbers have this prepended.
                if(array_key_exists($number, $contact_ids))
                {
                    $ids_to_send = $contact_ids[$number];
                }
            }
            
            $url = $this->sendhuburl . 'messages/';
            
            $payload = array('contacts' => array($ids_to_send), 'text' => $message);
            $payload = CJSON::encode($payload);
            
            $result = Yii::app()->curl->post($url, $payload, $this->sendhubcredential);
            
            return (is_array($result));
        }
        
        /**
         * Look up the contacts in my sendhub account
         *  you have to send the text messages using the contact id not the phone number
         *  so we have to whip up a little cross reference.
         * @return array of contacts
         */
        private function getContacts()
        {
            $url = $this->sendhuburl . 'contacts/'; // . $this->sendhubcredential;
                        
            $output = Yii::app()->curl->get($url, $this->sendhubcredential);            
            $contacts = CJSON::decode($output);
            
            array_shift($contacts);
            
            return $contacts;
            
        }
        
        /**
         * Get the contacts id cross ref array
         * @param type $numbers numbers we need to find
         * @return type array of: [number]=id
         */
        private function getContactIds($numbers)
        {
            $contacts = array_shift($this->getContacts());
            
            $contact_ids = array();
            
            if($contacts)
            foreach($contacts as $contact)
            {
                //echo "<br/>--<br/>" . print_r($contact, true);
                $contact_ids[$contact['number']] = $contact['id'];
            }
            
            return $contact_ids;

        }

}
?>
