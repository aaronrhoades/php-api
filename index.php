<?php
    $apiUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . 
        $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $requestUri = "api/";
    $subscribers = $apiUrl . $requestUri . 'subscribers' 
?>
<html>
<h1>Php REST API</h1>
<p>This is a boilerplate for a Php REST API. It contains POST, GET, UPDATE, and DELETE endpoints. The data example given is set up for an email subscriber list. Adjustments will be needed:</p>
<ul>
    <li>Adjust <b>api/connect.php</b> to be configured for your database. The db connection is setup for MySQL using mysqli.</li>
    <li>Adjust the SQL under <b>api/index.php</b> to match your table names. Add and remove endpoints as needed.</li>
    <li>If you do not wish to have your api to sit under the /api/ subdirectory, edit the <b>.htaccess</b> file as desired (and update $requestUri parameter in root index.php.)</li>
    <li>For cross origin access:</li>
    <ol>
        <li>Enable the Apache Headers Module</li>
        <li>In httpd.conf, add the line under directory tag: Header set Access-Control-Allow-Origin "http://my-website-to-allow-access.com"</li>
        <li>Restart Apache</li>
    </ol>
</ul>
<h2>GET (All) — JavaScript</h2>
<p></p>
<code>
    <?php ;
    echo "<a href=\"".$subscribers."\">".$subscribers."</a>" ?>
</code>
<h2>GET (by Id) — JavaScript</h2>
<code>

</code>
<h2>POST — JavaScript</h2>
<code>

</code>
<h2>UPDATE — JavaScript</h2>
<code>

</code>
<h2>DELETE — JavaScript</h2>
<code>

</code>

</html>