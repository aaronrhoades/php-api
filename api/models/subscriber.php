<?php
class Subscriber
{
    public $id;
    public $email;
    public $phone;
    public $f_name;
    public $l_name;
    public $is_subscribed_email;
    public $is_subscribed_phone;
    public $tags;

    public function __construct(array $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                $this->$key = $val;
            }
            else {
                die("Unknown params for class Subscriber.");
            }
        } 
    }

    public function get_insert_string() {
        $dbString = '';
        $thisSubscriber = get_object_vars($this);
        
        foreach($thisSubscriber as $propName => $value){
            if ($propName != "id"){
                $dbString = $dbString . ($value != null ? $value : "null");
                if ($propName != array_key_last($thisSubscriber))
                    $dbString = $dbString . ',';
            }
        }
        return $dbString; 
    }
    public function return_json()
    {
        return json_encode($this); 
    }  
}
?>