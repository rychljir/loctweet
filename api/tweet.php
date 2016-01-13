<?php
require_once("twitteroauth/twitteroauth.php"); // Path to twitteroauth library
require_once('config.php'); // Path to config file

// Check if keys are in place
if (CONSUMER_KEY === '' || CONSUMER_SECRET === '' || CONSUMER_KEY === 'CONSUMER_KEY_HERE' || CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {
    echo 'You need a consumer key and secret keys. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';

    exit;
}

// If count of tweets is not fall back to default setting
$lat = filter_input(INPUT_GET, 'lat', FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$long = filter_input(INPUT_GET, 'long', FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$max_result = filter_input(INPUT_GET, 'max_results', FILTER_SANITIZE_NUMBER_INT);

if(CACHE_ENABLED) {
    // Generate cache key from query data
    $cache_key = md5(
        var_export(array($username, $number, $exclude_replies, $list_slug, $hashtag), true) . HASH_SALT
    );

    // Remove old files from cache dir
    $cache_path  = dirname(__FILE__) . '/cache/';
    foreach (glob($cache_path . '*') as $file) {
        if (filemtime($file) < time() - CACHE_LIFETIME) {
            unlink($file);
        }
    }

    // If cache file exists - return it
    if(file_exists($cache_path . $cache_key)) {
        header('Content-Type: application/json');

        echo file_get_contents($cache_path . $cache_key);
        exit;
    }
}

/**
 * Gets connection with user Twitter account
 * @param  String $cons_key     Consumer Key
 * @param  String $cons_secret  Consumer Secret Key
 * @param  String $oauth_token  Access Token
 * @param  String $oauth_secret Access Secrete Token
 * @return Object               Twitter Session
 */
function getConnectionWithToken($cons_key, $cons_secret, $oauth_token, $oauth_secret)
{
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_secret);

    return $connection;
}

// Connect
$connection = getConnectionWithToken(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);

$url = '/geo/search';
$params = array(
    'lat' => $lat,
    'long' => $long,
    'max_results' => $max_result
);
$tweets = $connection->get($url, $params);


// Return JSON Object
header('Content-Type: application/json');

$tweets = json_encode($tweets);
$par = json_encode($params);
if(CACHE_ENABLED) file_put_contents($cache_path . $cache_key, $tweets);
echo $tweets;
//echo $par;
