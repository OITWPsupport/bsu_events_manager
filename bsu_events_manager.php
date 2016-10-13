<?php
/*
Plugin Name: BSU Events Manager
Description: Plugin for adding and viewing Google Calendar events
Version: 1.0.0
Author: Boise State Student Affairs Web Team
 */

require_once('plugin/Data.php');
require_once('plugin/Controller.php');
require_once('plugin/Settings.php');

add_shortcode('bsu_events_manager', 'getEventsManagerView');

if(is_admin()) {
    new  BoiseState\Events\Settings();
}

function getEventsManagerView($params)
{
    $controller = new  BoiseState\Events\Controller();
    return $controller->display(
        eventsSafeParameter($params, 'categories'),
        eventsSafeParameter($params, 'view'),
        eventsSafeParameter($_GET, 'cal'),
        eventsSafeParameter($_GET, 'id')
    );
}

function eventsSafeParameter($params, $id)
{
    return isset($params[$id]) ? $params[$id] : null;
}