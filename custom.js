
function submitForm(frm,api_url) {

    // get form data
    
    var this_form = $(frm);
    var form_data=JSON.stringify(this_form.serializeObject());

    alert(form_data);

    // submit form data to api
    $("#api_url").html(api_url);
    $("#api_post").html(JSON.stringify(form_data));
    

    $.ajax({
        url: api_url,
        method : "POST",
        contentType : 'application/json',
        data : form_data,
        success : function(result){

            $('#api_response').html(JSON.stringify(result));

            // store jwt to cookie
            setCookie("jwt", result.jwt, 1);

            // show home page & tell the user it was a successful login
            //showHomePage();
            $('#response').html("<div class='alert alert-success'>Successful login.</div>");
            
        },
        error: function(xhr, resp, text){
            
            $('#api_response').html(JSON.stringify(xhr));

            // on error, tell the user login has failed & empty the input boxes
            $('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.");
            //login_form.find('input').val('');
        }
    });

}

// if the user is logged in
function showLoggedInMenu(access_level){
   // hide login and sign up from navbar & show logout button
    $("#login, #sign_up").hide();
    $("#logout").show();

    //if(access_level=="Admin")  { 
        $("#read_users").show(); 
    //}
}
