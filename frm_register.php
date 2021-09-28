<?php

require_once "classes\all_classes.php";

// load cookies

// load request

// 
RunPage();

/////

function RunPage() {

    $webpage = new WebPage();
    $webpage->Title  = "Register / Sign Up";

    // utlimately the page class will call function PageContent() which is defined here in the page file
    $webpage->RenderPage("PageContent");        

}


/*
    This is where stuff happens for this page!!!!
*/

function PageContent() {

	$api_url = "api/get_userlist.php";


	test_bs_jsonform();

}

function test_bs_jsonform() {


	?>

        <!-- Content -->
        <div class="container">

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
                                            
                    <div class="custom-control custom-switch mt-1">
                        <input type="checkbox" class="custom-control-input" id="submitOnChange" onchange="toggleSubmitOnChange()">
                        <label class="custom-control-label" for="submitOnChange">Submit on change</label>
                    </div> 
                    

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

	<script>

		const my_BS4_JsonForm = new BS4_JsonForm(true)
		const Form1Data = document.getElementById("Form1Data")
		const Form1Instance = document.getElementById("Form1Instance")
		const Form1Status = document.getElementById("Form1Status")

		const config = {
			fields: [
				{
					id: "form_header",
					type: "text",
					validate: true,
					config: {
						element: "h5",
						classes: "card-title",
						content: "Registration Details"
					}
				},
				{
					id: "firstname",
					type: "input",
					width: 6,
					config: {
						label: "First Name",
						placeholder: "Bob"
					}
				},
				{
					id: "lastname",
					type: "input",
					width: 6,
					config: {
						label: "Last Name",
						placeholder: "Smith"
					}
				},
				{
					id: "email",
					type: "input",
                    width: 6,
                    default: "tom@mainsite.co.uk",
					config: {
                        //subtype: "email",
						label: "Email",
                        icon: "fa-email"
    				}
				},      
				{
					id: "password",
					type: "input",
                    width: 6,
					config: {
                        subtype:"Password",
					    value: "tomcat",
						label: "Password",
					}
				},            
				{
					id: "dob",
					type: "input",
					width: 6,
					config: {
                        subtype: "datetime-local",
                        label: "Date of Birth",
						placeholder: ""
					}
				},            
			]
		}

		// Builds the form in the UI
		function buildForm() {
			my_BS4_JsonForm.createForm("Form1", "Form1", config, handleData)
		}

		// Handle the data from the form instance
		function handleData(formInstance, isValid, formData) {
			Form1Status.innerText = isValid ? "Form valid!" : "Form invalid! :("
			Form1Instance.innerHTML = JSON.stringify(formInstance, null, 2)
			
            form_data = JSON.stringify(formData, null, 2)
            Form1Data.innerHTML = form_data
            CallAPI('api/get_token.php',form_data)
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




