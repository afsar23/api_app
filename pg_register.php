<?php

require_once "classes\all_classes.php";

// load cookies

// load request

// 
RunPage();

/////

function RunPage() {

    $webpage = new WebPage();

    $webpage->Title  = "Register";

    // utlimately the page class will call function PageContent() which is defined here in the page file
    $webpage->RenderPage("PageContent");        

}

/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {


    $api_url        = "api_controller.php?obj=user&operation=create";
    $jsCallBack     = "postFormProcessing";

    RegForm($api_url,$jsCallBack);

    PageLevelJs();

}

function PageLevelJs() {

	?>
	<script>
	function postFormProcessing(response) {
        if (response.status=="ok") {
			if (response.data.jwt) {
                // do something , eg redirect to login page?
            }
        }
 	}
	</script>
	<?php
}

function RegForm($api_url,$jsCallBack) {

    ?>
        <form id='reg_form' action='javascript:;' onsubmit="submitForm(this,'<?=$api_url?>',<?=$jsCallBack?>);"> 
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" name="firstname" id="firstname" required />
            </div>

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" name="lastname" id="lastname" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required />
            </div>

            <button type='submit' class='btn btn-primary'>Sign Up</button>
        </form>

    <?php
    
}

