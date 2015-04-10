<?php	

if(isset($_GET['Submit'])){
	
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('sqliwsdl', 'urn:sqliwsdl');
// Register the method to expose
$server->register('sqli',                // method name
    array('name' => 'xsd:string'),        // input parameters
    array('return' => 'xsd:string'),      // output parameters
    'urn:sqliwsdl',                      // namespace
    'urn:sqliwsdl#sqli',                // soapaction
    'rpc',                                // style
    'encoded',                            // use
    'Queries the database of contacts'            // documentation
);
// Define the method as a PHP function
function sqli($id) {

	// Retrieve all the data from the "example" table
	$result = mysql_query("SELECT first_name, last_name FROM users WHERE user_id = '$id'") or die(mysql_error());
	
	while($row = mysql_fetch_array( $result )) {
	// Print out the contents of the entry 

	$results = "First Name: ".$row['first_name'];
	$results = $results . " Last Name: ".$row['last_name'];

	}
        return $results;
}
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
