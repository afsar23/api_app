



function submitForm(frm,api_url) {

    // get form data
    
    var this_form = $(frm);
    var form_data=JSON.stringify(this_form.serializeObject());

    alert(form_data);

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
            eval(result.jsCallBack);
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

function CallAPI(api_url, form_data) {

  fetch(api_url, {
    method: 'POST', // or 'PUT'
    headers: {
      'Content-Type': 'application/json',
    },
    body: form_data,
  })
  .then( async(response) => {
    if (response.ok)  {
        alert("here");
        const result = await response.json();
        $('#api_response').html("<pre>" + JSON.stringify(result,null,2) + "</pre>");
        if (result.status == "ok") {
            $('#response').html("<div class='alert alert-success'>" + result.message + "</div>");
        }
        else {
                $('#response').html("<div class='alert alert-danger'>" + result.message + "</div>");
        }
        eval(result.jsCallBack);
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
