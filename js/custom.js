

function submitForm(frm,api_url, jsCallBack) {

    // get form data
    
    var this_form = $(frm);
    var form_data=JSON.stringify(this_form.serializeObject());
    
    CallAPI(api_url, form_data,jsCallBack)

}

function CallAPI(api_url, form_data,jsCallBack) {

  $("#api_url").html("<a href='"+api_url+"'>"+api_url+"</a>");
  $("#api_post").html(form_data);

  fetch(api_url, {
    method: 'POST', // or 'PUT'
    headers: {
      'Content-Type': 'application/json',
    },
    body: form_data,
  })
  .then( async(response) => {
    if (response.ok)  {
        //alert("here");
        const result = await response.json();
        $('#api_response').html("<pre>" + JSON.stringify(result,null,2) + "</pre>");
        if (result.status == "ok") {
            $('#response').html("<div class='alert alert-success'>" + result.message + "</div>");
        }
        else {
                $('#response').html("<div class='alert alert-danger'>" + result.message + "</div>");
        }
            // the call back function will normally live in the page script containing the form being processed
            jsCallBack(result);
    }   
    else {
        throw new Error(response.url + ": " + response.status + " - " + response.statusText);
        }
    })
  .catch(error => {
    $('#api_response').html("<pre>" + error + "</pre>");
    $('#response').html("<div class='alert alert-danger'>" + error + "</div>");
  });

}
