<?php
/**
* cPanel XMLAPI Client Class
*
* This class allows for easy interaction with cPanel's XML-API allow functions within the XML-API to be called
* by calling funcions within this class
*
* LICENSE:
*
* Copyright (c) 2012, cPanel, Inc.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without modification, are permitted provided
* that the following conditions are met:
*
* * Redistributions of source code must retain the above copyright notice, this list of conditions and the
*   following disclaimer.
* * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the
*   following disclaimer in the documentation and/or other materials provided with the distribution.
* * Neither the name of the cPanel, Inc. nor the names of its contributors may be used to endorse or promote
*   products derived from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED
* WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A
* PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
* ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
* TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
* HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
* NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* Version: 1.0.13
* Last updated: 19 November 2012
*
* Changes
*
* 1.0.13:
* Tidy
*
* 1.0.12:
* github#2 - [Bugfix]: typo related to environment variable XMLAPI_USE_SSL
*
* 1.0.11:
* [Feature]: Remove value requirement for park()'s 'topdomain' argument
*  (Case 51116)
*
* 1.0.10:
* github#1 - [Bugfix]: setresellerpackagelimits() does not properly prepare
*  input arguments for query (Case 51076)
*
* 1.0.9:
* added input argument to servicestatus method which allows single service
*  filtering (Case 50804)
*
* 1.0.8:
* correct unpark bug as reported by Randall Kent
*
* 1.0.7:
* Corrected typo for setrellerlimits where xml_query incorrectly called xml-api's setresellerips
*
* 1.0.6:
* Changed 'user' URL parameter for API1/2 calls to 'cpanel_xmlapi_user'/'cpanel_jsonapi_user' to resolve conflicts with API2 functions that use 'user' as a parameter
* Relocated exmaple script to Example subdirectory
* Modified example scripts to take remote server IP and root password from environment variables REMOTE_HOST and REMOTE_PASSWORD, respectively
* Created subdirectory Tests for PHPUnit tests
* Add PHPUnit test BasicParseTest.php
*
* 1.0.5:
* fix bug where api1_query and api2_query would not return JSON data
*
* 1.0.4:
* set_port will now convert non-int values to ints
*
* 1.0.3:
* Fixed issue with set_auth_type using incorrect logic for determining acceptable auth types
* Suppress non-UTF8 encoding when using curl
*
* 1.0.2:
* Increased curl buffer size to 128kb from 16kb
* Fix double encoding issue in terminateresellers()
*
* 1.0.1:
* Fixed use of wrong variable name in curl error checking
* adjust park() to use api2 rather than API1
*
* 1.0
* Added in 11.25 functions
* Changed the constructor to allow for either the "DEFINE" config setting method or using parameters
* Removed used of the gui setting
* Added fopen support
* Added auto detection for fopen or curl (uses curl by default)
* Added ability to return in multiple formats: associative array, simplexml, xml, json
* Added PHP Documentor documentation for all necessary functions
* Changed submission from GET to POST
*
*
* @copyright 2012 cPanel, Inc
* @license http://sdk.cpanel.net/license/bsd.html
* @version 1.0.13
* @link http://twiki.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/XmlApi
* @since File available since release 0.1
**/

/**
* The base XML-API class
*
* The XML-API class allows for easy execution of cPanel XML-API calls.  The goal of this project is to create
* an open source library that can be used for multiple types of applications.  This class relies on PHP5 compiled
* with both curl and simplexml support.
*
* Making Calls with this class are done in the following steps:
*
* 1.) Instaniating the class:
* $xmlapi = new xmlapi($host);
*
* 2.) Setting access credentials within the class via either set_password, set_token, or set_hash:
* $xmlapi->set_hash("username", $accessHash);
* $xmlapi->set_token("username", $accessToken);
* $xmlapi->set_password("username", "password");
*
* 3.) Execute a function
* $xmlapi->listaccts();
*
* @category Cpanel
* @package xmlapi
* @copyright 2012 cPanel, Inc.
* @license http://sdk.cpanel.net/license/bsd.html
* @version Release: 1.0.13
* @link http://twiki.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/XmlApi
* @since Class available since release 0.1
**/

class KeyHelpApi
{
    // should debugging statements be printed?
    private $debug			= false;

    // The host to connect to
    private $host				=	'127.0.0.1';

    // should be the literal strings http or https
    private $protocol		=	'https';

    // output that should be given by the xml-api
    private $output		=	'json';

    // literal strings hash, token, or password
    private $auth_type 	= token;


    // username to authenticate as
    private $userId				= null;

    // The HTTP Client to use

    private $http_client		= 'curl';

    /**
    * Instantiate the XML-API Object
    * All parameters to this function are optional and can be set via the accessor functions or constants
    * This defaults to password auth, however set_hash can be used to use hash authentication and set_token to use
    * token authentication
    *
    * @param string $host The host to perform queries on
    * @param string $userID The username to authenticate as
    * @param string $password The password to authenticate with
    * @return Xml_Api object
    */
    public function __construct($host = null, $userId = null, $password = null )
    {
        // Check if debugging must be enabled
        if ( (defined('XMLAPI_DEBUG')) && (XMLAPI_DEBUG == '1') ) {
             $this->debug = true;
        }

        // Check if raw xml output must be enabled
        if ( (defined('XMLAPI_RAW_XML')) && (XMLAPI_RAW_XML == '1') ) {
             $this->raw_xml = true;
        }

        /**
        * Authentication
        * This can either be passed at this point or by using the set_hash, set_token, or set_password functions
        **/

       /* if ( ( defined('XMLAPI_USER') ) && ( strlen(XMLAPI_USER) > 0 ) ) {
            $this->user = XMLAPI_USER;

            // set the authtype to pass and place the password in $this->pass
            if ( ( defined('XMLAPI_PASS') ) && ( strlen(XMLAPI_PASS) > 0 ) ) {
                $this->auth_type = 'pass';
                $this->auth = XMLAPI_PASS;
            }

            // set the authtype to hash and place the hash in $this->auth
            if ( ( defined('XMLAPI_HASH') ) && ( strlen(XMLAPI_HASH) > 0 ) ) {
                $this->auth_type = 'hash';
                $this->auth = preg_replace("/(\n|\r|\s)/", '', XMLAPI_HASH);
            }

            // set the authtype to token and place the token in $this->auth
            if ( ( defined('XMLAPI_TOKEN') ) && ( strlen(XMLAPI_TOKEN) > 0 ) ) {
                $this->auth_type = 'token';
                $this->auth = XMLAPI_TOKEN;
            }

            // Throw warning if XMLAPI_HASH and XMLAPI_PASS are defined
            if ( ( ( defined('XMLAPI_HASH') ) && ( strlen(XMLAPI_HASH) > 0 ) )
                && ( ( defined('XMLAPI_PASS') ) && ( strlen(XMLAPI_PASS) > 0 ) ) ) {
                error_log('warning: both XMLAPI_HASH and XMLAPI_PASS are defined, defaulting to XMLAPI_HASH');
            }


            // Throw a warning if XMLAPI_HASH and XMLAPI_PASS are undefined and XMLAPI_USER is defined
            if ( !(defined('XMLAPI_HASH') ) || !defined('XMLAPI_PASS') ) {
                error_log('warning: XMLAPI_USER set but neither XMLAPI_HASH or XMLAPI_PASS have not been defined');
            }

        }*/

        if ( ( $userId != null ) && ( is_int( $userId ) ) ) {
            $this->userId = $userId;
        }

        if ($password != null) {
            $this->set_password($password);
        }

        /**
        * Connection
        *
        * $host/XMLAPI_HOST should always be equal to either the IP of the server or it's hostname
        */

        // Set the host, error if not defined
        if ($host == null) {
            if ( (defined('XMLAPI_HOST')) && (strlen(XMLAPI_HOST) > 0) ) {
                $this->host = XMLAPI_HOST;
            } else {
                throw new Exception("No host defined");
            }
        } else {
            $this->host = $host;
        }

        // disabling SSL is probably a bad idea.. just saying.
        if ( defined('XMLAPI_USE_SSL' ) && (XMLAPI_USE_SSL == '0' ) ) {
            $this->protocol = "http";
        }

        // Detemine what the default http client should be.
        if ( function_exists('curl_setopt') ) {
            $this->http_client = "curl";
        } elseif ( ini_get('allow_url_fopen') ) {
            $this->http_client = "fopen";
        } else {
            throw new Exception('allow_url_fopen and curl are neither available in this PHP configuration');
        }

    }

    /**
    * Accessor Functions
    **/
    /**
    * Return whether the debug option is set within the object
    *
    * @return boolean
    * @see set_debug()
    */
    public function get_debug()
    {
        return $this->debug;
    }

    /**
    * Turn on debug mode
    *
    * Enabling this option will cause this script to print debug information such as
    * the queries made, the response XML/JSON and other such pertinent information.
    * Calling this function without any parameters will enable debug mode.
    *
    * @param bool $debug turn on or off debug mode
    * @see get_debug()
    */
    public function set_debug( $debug = 1 )
    {
        $this->debug = $debug;
    }

    /**
    * Get the host being connected to
    *
    * This function will return the host being connected to
    * @return string host
    * @see set_host()
    */
    public function get_host()
    {
        return $this->host;
    }

    /**
    * Set the host to query
    *
    * Setting this will set the host to be queried
    * @param string $host The host to query
    * @see get_host()
    */
    public function set_host( $host )
    {
        $this->host = $host;
    }

    /**
    * Return the protocol being used to query
    *
    * This will return the protocol being connected to
    * @return string
    * @see set_protocol()
    */
    public function get_protocol()
    {
        return $this->protocol;
    }

    /**
    * Set the protocol to use to query
    *
    * This will allow you to set the protocol to query cpsrvd with.  The only to acceptable values
    * to be passed to this function are 'http' or 'https'.  Anything else will cause the class to throw
    * an Exception.
    * @param string $proto the protocol to use to connect to cpsrvd
    * @see get_protocol()
    */
    public function set_protocol( $proto )
    {
        if ($proto != 'https' && $proto != 'http') {
            throw new Exception('https and http are the only protocols that can be passed to set_protocol');
        }
        $this->protocol = $proto;
    }

    /**
    * Return what format calls with be returned in
    *
    * This function will return the currently set output format
    * @see set_output()
    * @return string
    */
    public function get_output()
    {
        return $this->output;
    }

    /**
    * Set the output format for call functions
    *
    * This class is capable of returning data in numerous formats including:
    *   - json
    *   - xml
    *   - {@link http://php.net/simplexml SimpleXML}
    *   - {@link http://us.php.net/manual/en/language.types.array.php Associative Arrays}
    *
    * These can be set by passing this class any of the following values:
    *   - json - return JSON string
    *   - xml - return XML string
    *   - simplexml - return SimpleXML object
    *   - array - Return an associative array
    *
    * Passing any value other than these to this class will cause an Exception to be thrown.
    * @param string $output the output type to be set
    * @see get_output()
    */
    public function set_output( $output )
    {
        if ($output != 'json' && $output != 'xml' && $output != 'array' && $output != 'simplexml') {
            throw new Exception('json, xml, array and simplexml are the only allowed values for set_output');
        }
        $this->output = $output;
    }

    /**
    * Return the auth_type being used
    *
    * This function will return a string containing the auth type in use
    * @return string auth type
    * @see set_auth_type()
    */
    public function get_auth_type()
    {
        return $this->auth_type;
    }

    /**
    * Set the auth type
    *
    * This class is capable of authenticating with hash auth, token auth, and password auth
    * This function will allow you to manually set which auth_type you are using.
    *
    * the only accepted parameters for this function are "hash", "token", and "pass" anything else will cuase
    * an exception to be thrown
    *
    * @see set_password()
    * @see set_hash()
    * @see set_token()
    * @see get_auth_type()
    * @param string auth_type the auth type to be set
    */
    public function set_auth_type( $auth_type )
    {
        if (!in_array($auth_type, array('hash', 'token', 'pass'))) {
            throw new Exception('the only allowable auth types are hash, token, and pass');
        }
        $this->auth_type = $auth_type;
    }

    /**
    * Set the password to be autenticated with
    *
    * This will set the password to be authenticated with, the auth_type will be automatically adjusted
    * when this function is used
    *
    * @param string $pass the password to authenticate with
    * @see set_hash()
    * @see set_token()
    * @see set_auth_type()
    * @see set_user()
    */
    public function set_password( $pass )
    {
        $this->auth_type = 'pass';
        $this->auth = $pass;
    }

    /**
    * Set the hash to authenticate with
    *
    * This will set the hash to authenticate with, the auth_type will automatically be set when this function
    * is used.  This function will automatically strip the newlines from the hash.
    * @param string $hash the hash to autenticate with
    * @see set_password()
    * @see set_token()
    * @see set_auth_type()
    * @see set_user()
    */
    public function set_hash( $hash )
    {
        $this->auth_type = 'hash';
        $this->auth = preg_replace("/(\n|\r|\s)/", '', $hash);
    }

    /**
    * Set the token to authenticate with
    *
    * This will set the token to authenticate with, the auth_type will automatically be set when this function
    * is used.
    *
    * @param string $token the token to autenticate with
    * @see set_password()
    * @see set_hash()
    * @see set_auth_type()
    * @see set_user()
    */
    public function set_token( $token )
    {
        $this->auth_type = 'token';
        $this->auth = $token;
    }

    /**
    * Return the user being used for authtication
    *
    * This will return the username being authenticated against.
    *
    * @return string
    */
    public function get_user()
    {
        return $this->user;
    }

    /**
    * Set the user to authenticate against
    *
    * This will set the user being authenticated against.
    * @param string $user username
    * @see set_password()
    * @see set_token()
    * @see set_hash()
    * @see get_user()
    */
    public function set_user( $user )
    {
        $this->user = $user;
    }


    /**
    * Set the HTTP client to use
    *
    * This class is capable of two types of HTTP Clients:
    *   - curl
    *   - fopen
    *
    * When using allow url fopen the class will use get_file_contents to perform the query
    * The only two acceptable parameters for this function are 'curl' and 'fopen'.
    * This will default to fopen, however if allow_url_fopen is disabled inside of php.ini
    * it will switch to curl
    *
     * @param string client The http client to use
    * @see get_http_client()
    */

    public function set_http_client( $client )
    {
        if ( ( $client != 'curl' ) && ( $client != 'fopen' ) ) {
            throw new Exception('only curl and fopen and allowed http clients');
        }
        $this->http_client = $client;
    }

    /**
    * Get the HTTP Client in use
    *
    * This will return a string containing the HTTP client currently in use
    *
    * @see set_http_client()
    * @return string
    */
    public function get_http_client()
    {
        return $this->http_client;
    }

     /*
    *	Query Functions
    *	--
    *	This is where the actual calling of the XML-API, building API1 & API2 calls happens
    */

    /**
    * Perform an XML-API Query
    *
    * This function will perform an XML-API Query and return the specified output format of the call being made
    *
    * @param string $function The XML-API call to execute
    * @param array $vars An associative array of the parameters to be passed to the XML-API Calls
    * @return mixed
    */
    public function xmlapi_query( $function, $rtype = 0,$vars = array(), $postdata ="" )
    {
        // Check to make sure all the data needed to perform the query is in place
        if (!$function) {
            throw new Exception('xmlapi_query() requires a function to be passed to it');
        }

        if ($this->user == null) {
            throw new Exception('no user has been set');
        }

        if ($this->auth ==null) {
            throw new Exception('no authentication information has been set');
        }

        // Build the query:


        $args = http_build_query($vars, '', '&');
        $url =  $this->protocol . '://' . $this->host . "/api/v1/"./*':' . $this->port . $query_type .*/ $function;

        if ($this->debug) {
            error_log('URL: ' . $url);
            error_log('DATA: ' . $args);
        }

        // Set the $auth string

        if ($this->auth_type == 'hash' || $this->auth_type == 'token') {
            $authstr = 'Authorization: Bearer ' . $this->auth . "\r\n";
        } elseif ($this->auth_type == 'pass') {
            $authstr = 'Authorization: Basic ' . base64_encode($this->user .':'. $this->auth) . "\r\n";
        } else {
            throw new Exception('invalid auth_type set');
        }

        if ($this->debug) {
            error_log("Authentication Header: " . $authstr ."\n");
        }

        // Perform the query (or pass the info to the functions that actually do perform the query)

        $response = $this->curl_query($url, $args, $authstr, $rtype, $postdata);

        /*
        *	Post-Query Block
        * Handle response, return proper data types, debug, etc
        */

        // print out the response if debug mode is enabled.
        if ($this->debug) {
            error_log("RESPONSE:\n " . $response);
        }

        // The only time a response should contain <html> is in the case of authentication error
        // cPanel 11.25 fixes this issue, but if <html> is in the response, we'll error out.

        if (stristr($response, '<html>') == true) {
            if (stristr($response, 'Login Attempt Failed') == true) {
                error_log("Login Attempt Failed");

                return;
            }
            if (stristr($response, 'action="/login/"') == true) {
                error_log("Authentication Error");

                return;
            }

            return;
        }


        // perform simplexml transformation (array relies on this)
        if ( ($this->output == 'simplexml') || $this->output == 'array') {
            $response = simplexml_load_string($response, null, LIBXML_NOERROR | LIBXML_NOWARNING);
            if (!$response) {
                    error_log("Some error message here");

                    return;
            }
            if ($this->debug) {
                error_log("SimpleXML var_dump:\n" . print_r($response, true));
            }
        }

        // perform array tranformation
        if ($this->output == 'array') {
            $response = $this->unserialize_xml($response);
            if ($this->debug) {
                error_log("Associative Array var_dump:\n" . print_r($response, true));
            }
        }

        return $response;
    }

    private function curl_query( $url, $postdata, $authstr, $rtype, $body)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        // Return contents of transfer on curl_exec
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // Allow self-signed certs
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        // Set the URL
        curl_setopt($curl, CURLOPT_URL, $url);
        // Increase buffer size to avoid "funny output" exception
        curl_setopt($curl, CURLOPT_BUFFERSIZE, 131072);

        // Pass authentication header
        $header[0] =$authstr .
            "Content-Type: application/x-www-form-urlencoded\r\n";

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        if($rtype = 1){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $body );
        }else if($rtype = 2){
            curl_setopt($curl, CURLOPT_PUT, 1);
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $body );
        }else if($rtype = 3){
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $result = curl_exec($curl);
        if ($result == false) {
            throw new Exception("curl_exec threw error \"" . curl_error($curl) . "\" for " . $url . "?" . $postdata );
        }
        curl_close($curl);

        return $result;
    }

    private function fopen_query( $url, $postdata, $authstr )
    {
        if ( !(ini_get('allow_url_fopen') ) ) {
            throw new Exception('fopen_query called on system without allow_url_fopen enabled in php.ini');
        }

        $opts = array(
            'http' => array(
                'allow_self_signed' => true,
                'method' => 'POST',
                'header' => $authstr .
                    "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen($postdata) . "\r\n" .
                    "\r\n" . $postdata
            )
        );
        $context = stream_context_create($opts);

        return file_get_contents($url, false, $context);
    }


    /*
    * Convert simplexml to associative arrays
    *
    * This function will convert simplexml to associative arrays.
    */
    private function unserialize_xml($input, $callback = null, $recurse = false)
    {
        // Get input, loading an xml string with simplexml if its the top level of recursion
        $data = ( (!$recurse) && is_string($input) ) ? simplexml_load_string($input) : $input;
        // Convert SimpleXMLElements to array
        if ($data instanceof SimpleXMLElement) {
            $data = (array) $data;
        }
        // Recurse into arrays
        if (is_array($data)) {
            foreach ($data as &$item) {
                $item = $this->unserialize_xml($item, $callback, true);
            }
        }
        // Run callback and return
        return (!is_array($data) && is_callable($callback)) ? call_user_func($callback, $data) : $data;
    }



    ####
    # Account functions
    ####


    //get userId from username

    public function getByUsername($username){
        $user = $this->xmlapi_query('clients/name/'.$username, 0 );
        if(isset($user) && is_int($user->id) ){
            return $user;
        }
    }

    /**
    * Create a cPanel Account
    *
    * This function will allow one to create an account, the $acctconf parameter requires that the follow
    * three associations are defined:
    *	- username
    *	- password
    *	- domain
    *
    * Failure to prive these will cause an error to be logged.  Any other key/value pairs as defined by the createaccount call
    * documentation are allowed parameters for this call.
    *
    * @param array $acctconf
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/CreateAccount XML API Call documentation
    */

    public function createacct($acctconf)
    {
        if (!is_array($acctconf)) {
            error_log("createacct requires that first parameter passed to it is an array");

            return false;
        }
        if (!isset($acctconf['username']) || !isset($acctconf['password'])) {
            error_log("createacct requires that username, password elements are in the array passed to it");

            return false;
        }

        $body = json_encode(array(
            "username" => $acctconf['username'],
            "email" => $acctconf["contactemail"],
            //set later!!!
            "id_hosting_plan" => $acctconf["plan"],
            "password" => $acctconf["password"],
            "send_login_credentials"=> true,


        ));

        return $this->xmlapi_query('clients', 1, array(), $body);
    }

    /**
    * Change a cPanel Account's Password
    *
    * This function will allow you to change the password of a cpanel account
    *
    * @param string $username The username to change the password of
    * @param string $pass The new password for the cPanel Account
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ChangePassword XML API Call documentation
    */
    public function passwd($username, $pass)
    {
        if (!isset($username) || !isset($pass)) {
            error_log("passwd requires that an username and password are passed to it");

            return false;
        }

        $body = json_encode(array(
           "password" => $pass
        ));

        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}", 2, null, $body);
        else error_log("no user found for username: {$username}");
    }

    /**
    * List accounts on Server
    *
    * This call will return a list of account on a server, either no parameters or both parameters may be passed to this function.
    *
    * @param string $searchtype Type of account search to use, allowed values: domain, owner, user, ip or package
    * @param string $search the string to search against
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ListAccounts XML API Call documentation
    */
    public function listaccts($searchtype = null, $search = null)
    {
        if ($search) {
            return $this->xmlapi_query("clients/{$search}");
        }

        return $this->xmlapi_query('clients');
    }

    /**
    * Modify a cPanel account
    *
    * This call will allow you to change limitations and information about an account.  See the XML API call documentation for a list of
    * acceptable values for args.
    *
    * @param string $username The username to modify
    * @param array $args the new values for the modified account (see {@link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ModifyAccount modifyacct documentation})
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ModifyAccount XML API Call documentation
    */
    public function modifyacct($username, $args = array())
    {
        if (!isset($username)) {
            error_log("modifyacct requires that username is passed to it");

            return false;
        }
        if (sizeof($args) < 1) {
            error_log("modifyacct requires that at least one attribute is passed to it");

            return false;
        }
        $chng = array();
        if(isset($args["newuser"]))
            $chng= array("username" => $args["newuser"]);

        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}", 2, null, json_encode($chng));
        else error_log("no user found for username: {$username}");

    }

    /**
    * Return a summary of the account's information
    *
    * This call will return a brief report of information about an account, such as:
    *	- Disk Limit
    *	- Disk Used
    *	- Domain
    *	- Account Email
    *	- Theme
    * 	- Start Data
    *
    * Please see the XML API Call documentation for more information on what is returned by this call
    *
    * @param string $username The username to retrieve a summary of
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ShowAccountInformation XML API Call documenation
    */
    public function accountsummary($username)
    {
        if (!isset($username)) {
            error_log("accountsummary requires that an username is passed to it");

            return false;
        }

        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}");
        else error_log("no user found for username: {$username}");
    }

    /**
    * Suspend a User's Account
    *
    * This function will suspend the specified cPanel users account.
    * The $reason parameter is optional, but can contain a string of any length
    *
    * @param string $username The username to suspend
    * @param string $reason The reason for the suspension
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/SuspendAccount XML API Call documentation
    */
    public function suspendacct($username, $reason = null)
    {
        if (!isset($username)) {
            error_log("suspendacct requires that an username is passed to it");

            return false;
        }

        $chng = array(
            "is_suspended" => true
        );

        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}", 2, null, json_encode($chng));
        else error_log("no user found for username: {$username}");
    }


    /**
    * Remove an Account
    *
    * This XML API call will remove an account on the server
    * The $keepdns parameter is optional, when enabled this will leave the DNS zone on the server
    *
    * @param string $username The usename to delete
    * @param bool $keepdns When pass a true value, the DNS zone will be retained
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/TerminateAccount
    */
    public function removeacct($username, $keepdns = false)
    {
        if (!isset($username)) {
            error_log("removeacct requires that a username is passed to it");

            return false;
        }
        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}", 3);
        else error_log("no user found for username: {$username}");

    }

    /**
    * Unsuspend an Account
    *
    * This XML API call will unsuspend an account
    *
    * @param string $username The username to unsuspend
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/UnsuspendAcount XML API Call documentation
     */
    public function unsuspendacct($username)
    {
        if (!isset($username)) {
            error_log("unsuspendacct requires that a username is passed to it");

            return false;
        }
        $chng = array(
            "is_suspended" => false
        );

        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}", 2, null, json_encode($chng));
        else error_log("no user found for username: {$username}");
    }

    /**
    * Change an Account's Package
    *
    * This XML API will change the package associated account.
    *
    * @param string $username the username to change the package of
    * @param string $pkg The package to change the account to.
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ChangePackage XML API Call documentation
    */
    public function changepackage($username, $pkg)
    {
        if (!isset($username) || !isset($pkg)) {
            error_log("changepackage requires that username and pkg are passed to it");

            return false;
        }
        $chng = array(
            "id_hosting_plan" => $pkg
        );

        $user = $this->getByUsername($username);
        if(is_int($user->id))
            return $this->xmlapi_query("clients/{$user->id}", 2, null, json_encode($chng));
        else error_log("no user found for username: {$username}");
    }


    ####
    # Package Functions
    ####


    /**
    * List Packages
    *
    * This function will list all packages available to the user
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ListPackages XML API Call documentation
    */
    public function listpkgs()
    {
        return $this->xmlapi_query('hosting-plans');
    }


    /**
    * Display bandwidth Usage
    *
    * This function will return all bandwidth usage information for the server,
    * The arguments for this can be passed in via an associative array, the elements of this array map directly to the
    * parameters of the call, please see the XML API Call documentation for more information
    * @param array $args The configuration for what bandwidth information to display
    * @return mixed
    * @link http://docs.cpanel.net/twiki/bin/view/AllDocumentation/AutomationIntegration/ShowBw XML API Call documentation
    */
    public function showbw($args = null)
    {
        if($args["searchtype"]=="user") {
            $user = $this->getByUsername($args->search);
            if (is_int($user->id))
                return $this->xmlapi_query("clients/{$user->id}/stats");
            else error_log("no user found for username: {$args->search}");
        }else error_log("no user information found in args: {$args}");
    }


}
