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

    $api_url = "api_controller.php?obj=user&operation=userlist";

    echo("<a href='$api_url'>".$api_url."</a><br/>");

    //tabulatorTable($api_url);
    datagrid1($api_url);
}

function tabulatorTable($api_url) {

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
        paginationSizeSelector:[3, 6, 8, 10, 20, 1000],

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

function datagrid1($api_url) {
     
    // demo...
    // https://www.cssscript.com/demo/data-grid-fathgrid/
    // https://github.com/admirhodzic/FathGrid

    // doc
    // https://www.fathsoft.com/grid/fathgrid.pdf
    ?>

    <script type="text/javascript" src="js3rdparty/fathgrid.js?dd"></script>
    
    <table id="ftab1" class="table table-hover table-bordered ">
    <thead class="thead-light"></thead>
    <tbody></tbody>
    </table>

    <script>
        var t1  =   FathGrid("ftab1", {
            //…configuration_options 
            serverURL   : "<?=$api_url?>",
            //size:10,
            editable:true,
            filterable:false,
            pageable:false,
            sortable:true,
            //showFooter:true,
            //onChange:function(item,col,old,value){console.log("onChange:",item.id,col,old,value);return value==''?false:true;},
            //rowClass:function(dr,idx){return dr.id==3?'table-info':(dr.id==9?'table-warning':'')},
            sortBy:[1],//group on first column
            selectColumns:true,
            columns:[
            {   xheader:'ID',            name:'id',          visible:false}, //invisible grouping column
            {   xheader:'ID',            name:'id',          editable:false },
            {   xheader:'First Name',    name:'firstname',
                //listOfValues:["Abel","Ahmed"],//list of values for edit, or a function(data,col) which returns list of values
            },
            {   xheader:'Last Name',     name:'lastname',
                //listOfValues:["Abel","Ahmed"],//list of values for edit, or a function(data,col) which returns list of values
            },
            {   xheader:'Email',         name:'email',          editable:false,
                //filter:null,//array or null for auto-generation of filter list
                //editable:function(data,col){return data.id>3}, //is field editable
            },
            {   xheader:'Access Level',  name:'access_level',   editable:false,
                //listOfValues:["Abel","Ahmed"],//list of values for edit, or a function(data,col) which returns list of values
            },
            /*
            //{   name:'dob',header:'DOB',
            //    type:'date', //edit input type: text, date, email, checkbox
            //},
            {type:'text',editable:true,
                name:'salary',header:'Salary',class:"text-right",
                footer:function(data){return (data.map(x=>parseFloat(x.salary.replace('$',''))).reduce((x,s)=>x+s,0).toFixed(2))},
                groupFooter:function(data){return (data.map(x=>parseFloat(x.salary.replace('$',''))).reduce((x,s)=>x+s,0).toFixed(2))}
            },
            {name:'gender',filter:['Female','Male'],header:'Gender',listOfValues:['Female','Male']},
            {name:'active',type:'checkbox',header:'Active',filter:[{value:0,name:'No'},{value:1,name:'Yes'}]},
            */
            {filterable:false,editable:false,html:function(item){return `<blockquote>All for one and one for all!<br/>So there!<br/></blockquote>`},header:'Quote'},
            ],
        });
    </script>

    <?php

}