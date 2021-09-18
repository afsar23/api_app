<?php

RunPage();

/////


function RunPage() {

    global $webpage;    // page object instantiated in class_app_page
    global $oUser;      //
    
    $webpage->Title  = "Home Page";

    // utlimately the page class will call function PageContent() which is defined here in the page file
    $webpage->RenderPage("PageContent");        

}

/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {

    echo file_get_contents("lorem_ipsum.html");

}


