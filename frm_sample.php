<?php

require_once "classes\all_classes.php";

// load cookies

// load request

// 
RunPage();

/////

function RunPage() {

    $webpage = new WebPage();
    $webpage->Title  = "Sample Form";

    // utlimately the page class will call function PageContent() which is defined here in the page file
    $webpage->RenderPage("PageContent");        

}


/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {

	$api_url = "api/get_userlist.php";


	test_bs_jsonform();
	//test_jsonform();


}

function test_bs_jsonform() {


	?>

        <!-- Content -->
        <div class="container">

            <div class="row mt-5">

                <div class="col-12 col-md-6">

                    <h5>JSON</h5>
                    <pre id="rawJson"></pre>

                </div>

                <div class="col-12 col-md-6">
                    <!-- Form display card w/ options -->
                    <div class="card shadow">
                        <div class="card-body">
                            <form id="Form1"></form>
                        </div>
                        <div class="card-footer">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="inspectFieldsToggle" onchange="toggleFieldInspection()">
                                <label class="custom-control-label" for="inspectFieldsToggle">Inspect fields</label>
                            </div>
                            <!-- <div class="custom-control custom-switch mt-1">
                                <input type="checkbox" class="custom-control-input" id="submitOnChange" onchange="toggleSubmitOnChange()">
                                <label class="custom-control-label" for="submitOnChange">Submit on change</label>
                            </div> -->
                        </div>
                    </div>

                    <!-- Data display card -->
                    <div class="card shadow mt-5">
                        <div class="card-body">
                            <h5 class="card-title">Data</h5>
                            <p>When the form is submitted it will call your passed data handler function with the form instance, validation state and the form data.<br />Submit the form above to see the output below.</p>

                            <h6>Form Data</h6>
                            <p id="Form1Status" class="mb-1">Status unknown</p>
                            <pre id="Form1Data" class="px-2">Waiting for submission...</pre>

                            <details>
                                <summary>Form Instance</summary>
                                <pre id="Form1Instance" class="px-2 mb-0 mt-2">Waiting for submission...</pre>
                            </details>
                        </div>
                    </div>

                </div>

            </div>

        </div>

	<script type="text/javascript" src="js/bs-jsonformV2.js"></script>

	<script>

		const my_BS4_JsonForm = new BS4_JsonForm(true)
		const rawJson = document.getElementById("rawJson")
		const Form1Data = document.getElementById("Form1Data")
		const Form1Instance = document.getElementById("Form1Instance")
		const Form1Status = document.getElementById("Form1Status")

		const config = {
			fields: [
				{
					id: "form_header",
					type: "text",
					validate: false,
					config: {
						element: "h5",
						classes: "card-title",
						content: "Form"
					}
				},
				{
					id: "wiki_link",
					type: "link",
					config: {
						content: "Wikipedia article on Names",
						url: "https://en.wikipedia.org/wiki/Name",
						classes: "link-primary"
					}
				},
				{
					id: "first_name",
					type: "input",
					width: 6,
					config: {
						label: "What is your first name?",
						placeholder: "Bob"
					}
				},
				{
					id: "last_name",
					type: "input",
					width: 6,
					config: {
						label: "What is your last name?",
						placeholder: "Smith"
					}
				},
				{
					id: "enable_easter_eggs",
					type: "switch",
					config: {
						label: "Turn on easter eggs?",
						sublabel: "Shows some super cool hidden features :)"
					}
				},
				{
					id: "very_cool_person",
					type: "checkbox",
					config: {
						label: "I am a cool person"
					}
				}
			]
		}

		// Builds the form in the UI
		function buildForm() {
			rawJson.innerHTML = JSON.stringify(config, null, 2)
			my_BS4_JsonForm.createForm("Form1", "Form1", config, handleData)
		}

		// Handle the data from the form instance
		function handleData(formInstance, isValid, formData) {
			Form1Status.innerText = isValid ? "Form valid!" : "Form invalid! :("
			Form1Instance.innerHTML = JSON.stringify(formInstance, null, 2)
			Form1Data.innerHTML = JSON.stringify(formData, null, 2)
		}

		// Control super_debug status in jsonform & update form once changed
		const inspectFieldsToggle = document.getElementById("inspectFieldsToggle")
		function toggleFieldInspection() {
			my_BS4_JsonForm.JsonForm.SUPER_DEBUG = inspectFieldsToggle.checked
			console.log(inspectFieldsToggle.checked)
			buildForm()
		}

		buildForm()

	</script>

	<?php

}

function test_jsonform() {

	?>

	<h1>Getting started with JSON Form</h1>
    <form></form>
    <div id="res" class="alert"></div>

    <script type="text/javascript" src="js/jsonform/underscore.js"></script>
    <script type="text/javascript" src="js/jsonform/jsv.js"></script>
    <script type="text/javascript" src="js/jsonform/jsonform.js"></script>	

    <script type="text/javascript">

      $('form').jsonForm({
		{
			"schema": {
				"message": {
				"type": "string",
				"title": "Message"
				},
				"author": {
				"type": "object",
				"title": "Author",
				"properties": {
					"name": {
					"type": "string",
					"title": "Name"
					},
					"gender": {
					"type": "string",
					"title": "Gender",
					"enum": [ "male", "female", "alien" ]
					},
					"magic": {
					"type": "integer",
					"title": "Magic number",
					"default": 42
					}
				}
				}
			}
			}
		,
        onSubmit: function (errors, values) {
          if (errors) {
            $('#res').html('<p>I beg your pardon?</p>');
          }
          else {
            $('#res').html('<p>Hello ' + values.name + '.' +
              (values.age ? '<br/>You are ' + values.age + '.' : '') +
              '</p>');
          }
        }
      });

    </script> 
	 
 
    <!-- Some containers to use by your script -->
    <div id="form-container"></div>
    <pre id="json-result"></pre>


	<?php

}



