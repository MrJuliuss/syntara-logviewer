<?php

View::composer('syntara-logviewer::viewer', function($view)
{
    $view->with('title', 'Logviewer');
    $view->with('breadcrumb',  array(
        array(
            'title' => 'Logs',
            'link' => Config::get('syntara::config.uri')."/logviewer",
            'icon' => 'glyphicon-list-alt'
        )   
    ));
});