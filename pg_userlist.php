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

    $webpage->RenderPage("PageContent","jsWhenReady");        

}

/*
    This is where stuff happens for this page!!!!
*/
function PageContent() {

    $api_url = "api_controller.php?obj=user&operation=userlist";

    echo("<a href='$api_url'>".$api_url."</a><br/>");
    echo '<div id="dgUserList"></div>';
    
    echo '<div id="quickGrid" style="margin-top:20px"></div>';
    
}

#####################################################################################

// js to run when doc ready 
?>
<script>
function jsWhenReady() {

    var api_url = "api_controller.php?obj=user&operation=userlist";

    $("#copyleft").html("<i>&copy; 2021 - All writes reversed</i>");
    tabulatorDataGrid(api_url);
    doQuickGrid(api_url);
    //queryDataGrid(api_url);

}

function tabulatorDataGrid(api_url) {

    //Build Tabulator
    var axTable = new Tabulator("#dgUserList", {
        xlayout:"fitData",
        responsiveLayout:"collapse",
        ajaxURL:api_url,

        pagination:"local", //enable remote pagination
        //ajaxParams:{paginated_response:"Y"}, //set any standard parameters to pass with the request
        paginationSize:6, //optional parameter to request a certain number of rows per page
        //paginationInitialPage:2, //optional parameter to set the initial page to load        
        paginationSizeSelector:[3, 6, 8, 10, 20],

        placeholder:"No Data Set",
        columns:[
            {title:"Users Unique id", field:"id", sorter:"number",
                tooltip: function(cell) {
                        return JSON.stringify(cell.getRow().getData());
                    }
             },
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

            // non-field related columns:
            //column definition in the columns array
            {   title:"Options",
                formatter:  function(cell, formatterParams, onRendered){ //plain text value
                                var out = '<a class="btn btn-danger" href="#"><i class="fa fa-trash-o fa-lg"></i>Delete</a>';                                
                                return out;
                            }, 
            },            

        ],

        initialSort:[
            {column:"firstname",    dir:"asc"},       //sort by this first
            {column:"lastname",     dir:"asc"},   //then sort by this second
        ],        
        /*
        dataSorting:function(sorters){
            //sorters - an array of the sorters currently applied
            //alert("SORTERS<br/>"+JSON.stringify(sorters));
        },

        dataFiltering:function(filters){
            //filters - an array of the filters currently applied
            //alert("FILTERS<br/>"+JSON.stringify(filters));
        },
        */

    });

    //axTable.setData(api_url);

}


function doQuickGrid(api_url) {

    //Build Tabulator
    var quickTable = new Tabulator("#quickGrid", {
        ajaxURL:api_url,
        autoColumns:true,
        placeholder:"No Data Set",
        });

}


</script>

<?php



