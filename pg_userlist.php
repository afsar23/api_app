<?php

use Afsar\lib\Database;
use Afsar\lib\User;

require_once "classes\all_classes.php";

// load cookies

RunPage();

/////

function RunPage() {

    $webpage = new WebPage();

    $webpage->Title  = "User List";

    // utlimately the page class will call function PageContent() which is defined here in the page file


    // validate token and check access level....!!!!!


    $webpage->RenderPage("PageContent");        

}

/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {

    echo '<div id="example-table"></div>';

    ?>
    <script>
    //Build Tabulator
    api_url = "api_controller.php?obj=user&operation=userlist";

    var axTable = new Tabulator("#example-table", {
        xheight:"500px",
        layout:"fitColumns",
        ajaxURL:api_url,

        pagination:"local",
        paginationSize:6,
        paginationSizeSelector:[3, 6, 8, 10],

        placeholder:"No Data Set",
        columns:[
            {title:"id", field:"id", sorter:"number"},
            {title:"firstname", field:"firstname"},
            {title:"lastname", field:"lastname"},
            {title:"email", field:"email"},
                {title:"Access Level", field:"access_level", width:200, formatter:function(cell, formatterParams){
                var value = cell.getValue();
                if(value=='Admin'){
                        return "<span style='color:red; font-weight:bold;'>" + value + "</span>";
                    }else{
                        return value;
                    }
                }
            },
        ],
        });

        axTable.setData(api_url);
        
        </script>

    <?php

}
