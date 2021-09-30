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

    ?>
    <!-- Form display card w/ options -->
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">Sign-up form</h5>
            <?php
            RegForm($api_url,$jsCallBack);
            ?>
        </div>
        <div class="card-footer">
            <div>Please ensure all manadatory details are completed</div>
        </div>
    </div>
    <?

    //RegForm($api_url,$jsCallBack);

    PageLevelJs();

}

function PageLevelJs() {

	?>
	<script>
	function postFormProcessing(response) {
        if (response.status=="ok") {
			// do something , eg redirect to login page?
            $('#api_response').html(JSON.stringify(response));
        } else {
            $('#response').html("<div class='alert alert-danger'>Registration failed. Email probably already registered.</div>");
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
                <input type="text" class="form-control" name="firstname" id="firstname" value="Fred" required />
            </div>

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="Basset" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="fred@mainsite.co.uk" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="testing!" required />
            </div>

            <button type='submit' class='btn btn-primary'>Sign Up</button>
        </form>

    <?php
    
}

