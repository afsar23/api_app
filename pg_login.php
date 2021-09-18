<?php

require_once "common_app_includes";

if (!isset($cfg)) {
    $cfg = new CommonConfig();
}

// load cookies

// load request

// 
RunPage();

/////

function RunPage() {

    $webpage = new WebPage();

    $webpage->Title  = "Login";

    // utlimately the page class will call function PageContent() which is defined here in the page file
    $webpage->RenderPage("PageContent");        

}

/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {

    $api_url = '"api/get_token.php"';

    $login_html = "
        <h2>Login</h2>
        <form id='login_form' action='javascript:;' onsubmit='submitForm(this,".$api_url.");'>
            <div class='form-group'>
                <label for='email'>Email address</label>
                <input type='email' class='form-control' id='email' name='email' placeholder='Enter email' value='tom@mainsite.co.uk'>
            </div>

            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' class='form-control' id='password' name='password' placeholder='Password' value='tomcat'>
             </div>
            <button type='submit' class='btn btn-primary'>Login</button>
        </form>
        ";

    echo $login_html;

}


