<?php
class SubscribersController
{
    public $subscribers = [];
    private $con;

    function __construct($con){
        $this->con = $con;
    }
    /* getAllSubscribers
     * Returns complete list of all subscribers
     */
    function getAllSubscribers(){
        global $con;
        $sql = "SELECT * FROM subscribers";
        
        if($result = mysqli_query($con,$sql))
        {
            $subsc = 0;
            while($row = mysqli_fetch_assoc($result))
            {
                $subscribers[$subsc]['id']    = $row['id'];
                $subscribers[$subsc]['email'] = $row['email'];
                $subscribers[$subsc]['phone'] = $row['phone'];
                $subscribers[$subsc]['f_name'] = $row['f_name'];
                $subscribers[$subsc]['l_name'] = $row['l_name'];
                $subscribers[$subsc]['is_subscribed_email'] = $row['is_subscribed_email'];
                $subscribers[$subsc]['is_subscribed_phone'] = $row['is_subscribed_phone'];
                $subscribers[$subsc]['tags']    = $row['tags'];
                $subsc++;
            }
            return json_encode(['data'=>$subscribers]);
        }
        else
        {
            http_response_code(500);
            return json_encode(['success'=>false]); 
        }
    }
    /* postSubscriber
     * @param string $email, $phone, $f_name, $l_name, $tags
     * @param bool $is_subscribed_email, $is_subscribed_phone,  
     */
    function postSubscriber($email, $phone, $f_name, $l_name, $is_subscribed_email, $is_subscribed_phone, $tags) {
        global $con;
        
        $sql = "INSERT INTO subscribers (email, phone, f_name, l_name, is_subscribed_email, is_subscribed_phone, tags) VALUES(?,?,?,?,?,?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssiis", $email, $phone, $f_name, $l_name, $is_subscribed_email, $is_subscribed_phone, $tags);
        
        //TODO: Parameterize - https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        //https://www.php.net/manual/en/mysqli-stmt.bind-param.php
        if($stmt->execute())
        {
            return json_encode(['success' => true]);
        }
        else {
            http_response_code(500); //TODO: determine when should be 400? https://www.php.net/manual/en/function.http-response-code.php
            return json_encode(['success'=>false]);
        }
        $stmt->close();
    }
    /* getSubscriberById
       @param $id the id of the user to retrieve
     */
    function getSubscriberById(string $id){
        global $con;
        $sql = "SELECT * FROM subscribers WHERE id = " . $id;
        
        if($result = mysqli_query($con,$sql))
        {
            $subsc = 0;
            while($row = mysqli_fetch_assoc($result))
            {
                $subscribers[$subsc]['id']    = $row['id'];
                $subscribers[$subsc]['email'] = $row['email'];
                $subscribers[$subsc]['phone'] = $row['phone'];
                $subscribers[$subsc]['f_name'] = $row['f_name'];
                $subscribers[$subsc]['l_name'] = $row['l_name'];
                $subscribers[$subsc]['is_subscribed_email'] = $row['is_subscribed_email'];
                $subscribers[$subsc]['is_subscribed_phone'] = $row['is_subscribed_phone'];
                $subscribers[$subsc]['tags']    = $row['tags'];
                $subsc++;
            }
            return json_encode(['data'=>$subscribers]);
        }
        else
        {
            http_response_code(500); //'Internal Server Error' - https:// www.php.net/manual/en/function.http-response-code.php
            return json_encode(['success'=>false]); 
        }
    }
}
?>