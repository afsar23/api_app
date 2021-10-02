<?php

require_once "classes\all_classes.php";


// load cookies

// load request

// 
RunPage();

/////

function RunPage() {

    $webpage = new WebPage();
    $webpage->Title  = "Home Page";

    // utlimately the page class will call function PageContent() which is defined here in the page file
    $webpage->RenderPage("PageContent", "jsWhenReady");        

}

/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {

    echo file_get_contents("lorem_ipsum.html");
    echo "<div id='copyleft'></div>";
}


// js to run when doc ready 
?>
<script>
function jsWhenReady() {

    $("#copyleft").html("<i>&copy; 2021 - All writes reversed</i>");

}
</script>

<?php

### THE END ###





