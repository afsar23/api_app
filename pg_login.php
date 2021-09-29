<?php

require_once "classes\all_classes.php";

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


    $api_url        = "api_controller.php?obj=user&operation=get_token";
    $jsCallBack     = "postFormProcessing";

    loginform($api_url,$jsCallBack);

    PageLevelJs();

}

function PageLevelJs() {

	?>
	<script>
	function postFormProcessing(response) {
        setCookie('jwt_token',"<null>",1);    // clear the cook
		if (response.status=="ok") {
			if (response.data.jwt) {
				setCookie('jwt_token',response.data.jwt,1);
    		}
        }
        $("#cookie_token").html(getCookie("jwt_token")); 
	}
	</script>
	<?php
}

function loginform($api_url,$jsCallBack) {

    ?>
        <form id='login_form' action='javascript:;' onsubmit="submitForm(this,'<?=$api_url?>',<?=$jsCallBack?>);"> 
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

    <?php
    
}

