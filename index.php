<!DOCTYPE html>
<html>
<head>
	<title>Search Server-side Scripting using PHP, JSON, and eBay API</title>
	<link href="https://fonts.googleapis.com/css?family=Merriweather:900" rel="stylesheet">
	<style type="text/css">
		.content {
			max-width: 1330px;
			margin: auto;
		}

		#input_form strong {
			/*This is done to give a bit of spacing between texts describing the inputs 
			and the input elements*/
			margin-right: 5px;
		}

		hr {
			/*width of the underline below project search text*/
			margin-top: 0px;
			max-width: 650px;
			margin: auto;
			border: 1px solid #A6A5A5;
		}

		#mile_input:disabled+label, #here_input:disabled+label {
			color: #ccc;
		}
		#dom_table, #dom_table tr, #dom_table th, #dom_table td {
			/*border style for the first dom*/
			border: 1px solid #CCCCCD;
		}

		#product_title p {
			/*This is center alignment for "Product Search" text*/
			text-align: center;
			font-size: 40px;
			margin: 10px auto;
		}

		#input_form  {
			/*Property of the actual form. The padding is there to make sure the
			input texts aren't right next to the border*/
			padding-left: 10px;
		}

		#form_inputs {
			/*This is div containing the form. max-width is chosen to be 700px
			so that the radio buttons can be aligned properly*/
			padding-left: 40px;
			max-width: 700px;
			margin: auto;
		}

		#table_header {
			/*Header styling for the main content*/
			font-size: 20px;
			padding-left: 3px;
			white-space: nowrap;
			padding-right: 5px;
		}

		#submit_button {
			margin-top: 30px;
			margin-bottom: 20px;
			margin-left: 240px;
		}

		#reset_button {
			margin-left: 10px;
		}

		@media screen and (-webkit-min-device-pixel-ratio:0) {
			#zip_check_input {
				/*This is used to readjust the radio button position*/
				margin-left: 445px;
			}
		}

		@-moz-document url-prefix() {
			#zip_check_input {
				/*This is used to readjust the radio button position*/
				margin-left: 420px;
			}
		}

		#form_table {
			/*This is div containing the overall title and form on the first page*/
			border: 4px solid #C4C4C4;
			background-color: #F1F1F2;
			max-width: 700px;
			margin: auto;
		}

		#no_record, #regex_p, #post_error, #no_item {
			/*CSS styling for the case when no matching items are found*/
			text-align: center;
			border: 1px solid #C1C1C2;
			background-color: #ECECEE;
			max-width: 800px;
			margin: 20px auto;
			font-size: 20px;
		}

		#no_description {
			/*Styling for no seller information*/
			text-align: center;
			border: 1px solid #C1C1C2;
			background-color: #ECECEE;
			max-width: 800px;
			margin: 20px auto;
			font-size: 20px;
		}

		form {
			/*This is to put search and clear buttons next to each other*/
			display: inline;
		}

		#content {
			/*Styling to center the main search content in the middle*/
			max-width: 2500px;
			margin: 25px auto;
		}

		#detail_p {
			/*Item details text styling*/
			text-align: center;
			font-family: 'Merriweather', serif;
			font-size: 50px;
			margin: 20px 0 auto;
		}

		#detail_table {
			/*Styling to center align the detail table*/
			max-width: 800px;
			margin: 25px auto;
		}

		#detail_image {
			/*To make sure the detail image isn't too large*/
			height: 350px;
			width: 350px;
		}

		#price_col {
			/*Column styling for the price info in the main content*/
			padding-right: 8px;
		}

		#item_col {
			/*Styling for other sections where the text needs to extend*/
			white-space: nowrap;
		}

		#detail_strong {
			font-size: 20px;
			padding-left: 3px;
			white-space: nowrap;
			padding-right: 5px;
		}

		#detail_content {
			font-size: 20px;
			padding-left: 3px;
		}

		#first_button {
			border: none;
			background: white;
		}

		#first_button p, #second_button p {
			color: #767676;
		}

		#first_button_image {
			background: white;
		}

		#second_button {
			border: none;
			background: white;
		}

		#second_button_image {
			background: white;
		}

		#seller_div {
			/*Fix some random width for seller info and this is used to center align
			the seller information content*/
			max-width: 1000px;
			height: 100%;
			margin: auto;
		}

		iframe {
			/*Configuring iframe to have no scrolling bar and have dynamic height*/
			width: 1000px;
			overflow: hidden;
			display: block;
		}

		.control_button {
			/*These are for seller info and similar items buttons*/
			max-width: 180px;
			margin: auto;
		}

		#similar_table {
			/*Apply horizontal scrolling to the similar items menu*/
			table-layout: fixed;
			display: inline-block;
			max-width: 1000px;
			overflow-x: auto;
			
		}

		#similar_table td, #similar_table td p {
			/*Setting width of the paragraph and td components inside similar_table*/
			word-wrap: break-word;
			width: 250px;
		}

		#similar_anchor, #item_anchor {
			text-decoration: none;
			color: black;
		}

		#similar_anchor:hover, #item_anchor:hover {
			text-decoration: none;
			color: #A7A5A5;
		}

		#similar_div {
			/*For center aligning the similar menu content*/
			max-width: 1000px;
			margin: auto;
			border: 2px solid #DBDBDD;
		}

		#no_similar_p {
			text-align: center;
			border-style: solid;
			border-color: #C1C1C2;
			border-width: 1px;
			padding-top: 5px;
			padding-bottom: 2px;
			margin-top: 2px;
			margin-bottom: 5px;
			margin-left: 10px;
			margin-right: 10px;
			font-weight: bold;
			font-size: 18px;
		}

		#no_similar_div {
			padding-top: 5px;
			padding-bottom: 5px;
			border-color: #C1C1C2;
			border-width: 1px;
			border-style: solid;
			max-width: 800px;
			margin: auto;
		}

		#no_description {
			text-align: center;
			border: 1px solid #C1C1C2;
			background-color: #C1C1C2;
			max-width: 800px;
			margin: 20px auto;
		}

		#similar_image_tag {
			display: block;
			margin: auto;
		}

		#similar_p, #similar_h4 {
			/*Center align the texts for similar items*/
			max-width: 250px;
			text-align: center;
		}
	</style>
</head>
<body onload = "currentZip()">
	<!-- Main body, form and div where the DOM content will be attached to -->
	<div class = "content">
		<div id = "form_table">
			<div id = "product_title">
				<p><i>Product Search</i></p>
				<hr>
			</div>

			<div id = "form_inputs">
				<!-- This is the main form tag that contains most of the inputs except for 
				reset input -->
				<form id = "input_form" method = "get">
					<p><strong>Keyword</strong><input type="text" name="keyword" id = "text_input" required></p>
					<p><strong>Category</strong>
					<select name = 'category' id = "category_input">
						<option value = "undecided">All Categories</option>
						<option value = "art">Art</option>
						<option value = "baby">Baby</option>
						<option value = "books">Books</option>
						<option value = "clothing">Clothing, Shoes & Accessories</option>
						<option value = "computer">Computers/Tablets & Networking</option>
						<option value = "health">Health & Beauty</option>
						<option value = "music">Music</option>
						<option value = "games">Video Games & Consoles</option>
					</select>
					</p>
					<p>
						<strong>Condition</strong><input type = "checkbox" name = "condition_new" id = "cond_new_input">New
						<input type = "checkbox" name = "condition_used" id = "cond_used_input">Used
						<input type = "checkbox" name = "condition_unspecified" id = "cond_unspecified_input" >Unspecified
					</p>
					<p>
						<strong>Shipping Options</strong><input type = "checkbox" name = "shipping_local" id = "local_ship_input">Local Pickup
						<input type = "checkbox" name = "shipping_free" id = "free_ship_input">Free Shipping
					</p>
					<input type="checkbox" name="enable" id = "enable" onClick = "turnOff()"><strong>Enable Nearby Search</strong>
					<!-- This is the input for putting in the numeric value for mile radius -->
					<input type="text" class = "dist" name="mile" placeholder = "10" value = "10" pattern = "^[0-9]{0,4}$" title = "Valid mile is an integer between 0 and 9999" id = "mile_input" disabled> <label for = "mile_input"><strong>miles from</strong></label>
					<!-- <input type="number" class = "dist" name="mile" min = "0" max = "9999" placeholder = "10" value = "10" id = "mile_input" disabled> miles from-->
					<!-- These correspond to the radio button here and zip code  -->
					<input type="radio" class = "dist" name="cur_loc" value = "here" id = "here_input" onClick = "zipOff()" required checked disabled><label for = "here_input">Here</label><br>
					<!-- Checking this input enables the zip code entry -->
					<input type="radio" class = "dist" name="cur_loc" value = "zipcode" id = "zip_check_input" onload = "changeId()" onClick = "zipOff()" required disabled>
					<!-- This is the numeric value of zip code -->
					<input type="text" class = "dist" name="zip_code" id = "zip_code_input" placeholder = "zip code" required disabled><br>
					<!-- This hidden input carries the current location zip code -->
					<input type="hidden" name="cur_zip" id = "hidden_input">
					<input type = "submit" id = "submit_button" name = "submit" value = "search" disabled>
				</form>
				
				<!-- I tried using input type reset and pass that as $_GET["reset"] to perform certain actions
				when the reset button was pressed but that didn't work. Also, if I set another submit button with
				reset value within the above from, it requires me putting in a keyword. Consequently, I constructed a
				separate form to handle the reset action -->
				<form method = "get" action = <?php echo $_SERVER['PHP_SELF']; ?>>
					<input type = "button" id = "reset_button" name = "reset" value = "clear" onClick = "resetAll()">
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function changeId() {

		}

		/*This function is used to turn on/off the distance inputs in the form*/
		function turnOff() {
			var distance_menu = document.getElementsByClassName("dist");
			var enable_menu = document.getElementById("enable");
			var zip_check = document.getElementById("zip_check_input");
			var here_check = document.getElementById("here_input");
			var zip_input = document.getElementById("zip_code_input");
			var mile_input = document.getElementById("mile_input");

			for (var i = 0; i < distance_menu.length - 1; i++) {
				if (enable_menu.checked) {
					distance_menu[i].disabled = false;
				} else {
					distance_menu[i].disabled = true;
					zip_input.disabled = true;
				}
			}

		}
		/*This function is used to toggle the zip code information depending on 
		whether it is checked or not*/
		function zipOff() {
			var zip_check = document.getElementById("zip_check_input");
			var zip_input = document.getElementById("zip_code_input");
			if (zip_check.checked) {
				zip_input.disabled = false;
				zip_input.required = true;
			}
			if (!zip_check.checked) {
				zip_input.disabled = true;
				zip_input.required = false;
			}
		}
		// This function grabs the zip code on the client side and passes the information
		// to the hidden input in the main form. Also, if json request is carried out properly,
		// enable the submit button which is disabled by default
		function currentZip() {
			var zip_url = "http://ip-api.com/json";
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", zip_url, false);
			xmlhttp.send();
			if (xmlhttp.status == 200) {
				jsonObj = JSON.parse(xmlhttp.responseText);
				var submit_button = document.getElementById("submit_button");
				// Enable the submit button once API call passes properly
				submit_button.disabled = false;
				// Assign this value to the hidden input
				var hidden_input = document.getElementById("hidden_input");
				hidden_input.value = jsonObj["zip"];
			} else if (xmlhttp.status == 404){
				window.alert("There is something wrong with zip code request!");
				return;
			}
		}

		function resetAll() {
			// Reset all form values to default when clear is pressed and also cleaned up the
			// DOM content
			var text_input = document.getElementById("text_input");
			text_input.value = "";
			var category_input = document.getElementById("category_input");

			category_input.value = "undecided";

			var cond_new_input = document.getElementById("cond_new_input");
			cond_new_input.checked = false;

			var cond_used_input = document.getElementById("cond_used_input");
			cond_used_input.checked = false;

			var cond_unspecified_input = document.getElementById("cond_unspecified_input");
			cond_unspecified_input.checked = false;

			var shipping_local = document.getElementById("local_ship_input");
			shipping_local.checked = false;

			var free_ship_input = document.getElementById("free_ship_input");
			free_ship_input.checked = false;

			var enable = document.getElementById("enable");
			enable.checked = false;

			var mile_input = document.getElementById("mile_input");
			mile_input.disabled = true;
			mile_input.value = "10";

			var here_input = document.getElementById("here_input");
			here_input.checked = true;
			here_input.disabled = true;

			var zip_check_input = document.getElementById("zip_check_input");
			zip_check_input.checked = false;
			zip_check_input.disabled = true;

			var zip_code_input = document.getElementById("zip_code_input");
			zip_code_input.value = "";
			zip_code_input.disabled = true;

			currentZip();

			// Now clear any DOM stuff that might be hanging about
			if (document.getElementById("content") != null) {
				var delete_div = document.getElementById("content");
				delete_div.remove();
			}

			// Remove item detail section if it exists
			if (document.getElementById("detail_div") != null) {
				var detail_delete_div = document.getElementById("detail_div");
				detail_delete_div.remove();

				var first_button_div = document.getElementById("first_button_div");
				first_button_div.remove();

				var second_button_div = document.getElementById("second_button_div");
				second_button_div.remove();

				if (document.getElementById("seller_div")) {
					var seller_content = document.getElementById("seller_div");
					seller_content.remove();
				}

				if (document.getElementById("no_description")) {
					var no_description = document.getElementById("no_description");
					no_description.remove();
				}
				
				if (document.getElementById("similar_div")) {
					var similar_content = document.getElementById("similar_div");
					similar_content.remove();
				}

				if (document.getElementById("no_similar_div")) {
					var no_similar_div = document.getElementById("no_similar_div");
					no_similar_div.remove();
				}	
			}

			// We also have to clear in case of error messages
			// 1) Invalid zip code regex check
			if (document.getElementById("regex_p") != null) {
				var regex_p = document.getElementById("regex_p");
				regex_p.remove();
			}

			// 2) Invalid main content error message
			if (document.getElementById("post_error") != null) {
				var post_error = document.getElementById("post_error");
				post_error.remove();
			}

			// 3) Main content contains no items
			if (document.getElementById("no_record") != null) {
				var no_record = document.getElementById("no_record");
				no_record.remove();
			}

			// 4) Incorrect item detail API request
			if (document.getElementById("no_item") != null) {
				var no_item = document.getElementById("no_item");
				no_item.remove();

				var first_button_div = document.getElementById("first_button_div");
				first_button_div.remove();

				var second_button_div = document.getElementById("second_button_div");
				second_button_div.remove();

				var seller_content = document.getElementById("no_description");
				seller_content.remove();

				if (document.getElementById("similar_div")) {
					var similar_content = document.getElementById("similar_div");
					similar_content.remove();
				}

				if (document.getElementById("no_similar_div")) {
					var no_similar_div = document.getElementById("no_similar_div");
					no_similar_div.remove();
				}
				
			}
		}

	</script>


	<!-- php body for receiving data from form tag and send API request -->
	<?php 
		if(isset($_GET["submit"])) { 
			$cat_array = [
				"undecided" => '',
				"art" => "550",
				"baby" => "2984",
				"books" => "267",
				"clothing" => "11450",
				"computer" => "58058",
				"health" => "26395",
				"music" => "11233",
				"games" => "1249"
			];
			$curr_zip = $_GET["cur_zip"];
			$keyword_origin = $_GET["keyword"];
			// If there is a space between keywords, replace with underscore
			$keyword = str_replace(' ', '_', $keyword_origin);
			$category = $_GET["category"];
			$cat_id = $cat_array[$category];

			// We need to get the disabled state of the distance fields using php
			// If one tries to access them simply through javascript it doesn't work because
			// everytime the page is submitted and refreshed, the .disabled is set to the default value
			// This portion of the code manually hand codes the expected disabled status
			if(isset($_GET["mile"])) {
				$mile_disabled = false;
			} else {
				$mile_disabled = true;
			}

			if(isset($_GET["zip_code"])) {
				$zip_disabled = false;
			} else {
				$zip_disabled = true;
			}

			if(isset($_GET["cur_loc"])) {
				if ($_GET["cur_loc"] == "here") {
					$here_disabled = false;
					$here_checked = true;
					$zipcode_disabled = false;
					$zipcode_checked = false;
				} else if ($_GET["cur_loc"] == "zipcode") {
					$here_disabled = false;
					$here_checked = false;
					$zipcode_disabled = false;
					$zipcode_checked = true;
				}
			} else {
				$here_disabled = true;
				$here_checked = true;
				$zipcode_disabled = true;
				$zipcode_checked = false;
			}

			if($category == "undecided") {
				$request = "http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=  [[API Key]]  &RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&paginationInput.entriesPerPage=20&keywords=" . $keyword;
			} else {
				$request = "http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=  [[API Key]]  &RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&paginationInput.entriesPerPage=20&keywords=" . $keyword . "&categoryId=" . $cat_id;
			}

			$filter_index = 0;
			// Adding distance postal code and distance metric
			if(isset($_GET["enable"])) {
				if ($_GET["cur_loc"] == "here") {
					$postal_code = $_GET["cur_zip"];
					$max_distance = $_GET["mile"];
					$request = $request . "&buyerPostalCode=" . $postal_code . "&itemFilter(" . $filter_index . ").name=MaxDistance&itemFilter(" . $filter_index . ").value=" . $max_distance;
					$filter_index += 1;
				} elseif ($_GET["cur_loc"] == "zipcode") {
					$postal_code = $_GET["zip_code"];
					$max_distance = $_GET["mile"];
					$request = $request . "&buyerPostalCode=" . $postal_code . "&itemFilter(" .$filter_index. ").name=MaxDistance&itemFilter(" .$filter_index. ").value=" . $max_distance;
					$filter_index += 1;
				}
			} 
			// Add shipping condition
			if (isset($_GET["shipping_local"]) && isset($_GET["shipping_free"])) {
				$request = $request . "&itemFilter(" . $filter_index . ").name=FreeShippingOnly&itemFilter(" . $filter_index . ").value=true";
				$filter_index += 1;
				$request = $request . "&itemFilter(" . $filter_index . ").name=LocalPickupOnly&itemFilter(" . $filter_index . ").value=true";
			} else if (isset($_GET["shipping_local"]) && !isset($_GET["shipping_free"])) {
				$request = $request . "&itemFilter(" . $filter_index . ").name=FreeShippingOnly&itemFilter(" . $filter_index . ").value=false";
				$filter_index += 1;
				$request = $request . "&itemFilter(" . $filter_index . ").name=LocalPickupOnly&itemFilter(" . $filter_index . ").value=true";
			} else if (!isset($_GET["shipping_local"]) && isset($_GET["shipping_free"])) {
				$request = $request . "&itemFilter(" . $filter_index . ").name=FreeShippingOnly&itemFilter(" . $filter_index . ").value=true";
				$filter_index += 1;
				$request = $request . "&itemFilter(" . $filter_index . ").name=LocalPickupOnly&itemFilter(" . $filter_index . ").value=false";
			} else {
				$request = $request . "&itemFilter(" . $filter_index . ").name=FreeShippingOnly&itemFilter(" . $filter_index . ").value=false";
				$filter_index += 1;
				$request = $request . "&itemFilter(" . $filter_index . ").name=LocalPickupOnly&itemFilter(" . $filter_index . ").value=false";
			}
			$filter_index += 1;
			
			// add the hide duplicate field
			$request = $request . "&itemFilter(" . $filter_index . ").name=HideDuplicateItems&itemFilter(" . $filter_index . ").value=true";
			$filter_index += 1;

			// Add whether new, used or unspecified
			$value_index = 0;
			if (isset($_GET["condition_new"]) || isset($_GET["condition_used"]) || isset($_GET["condition_unspecified"])) {
				$request = $request . "&itemFilter(" . $filter_index . ").name=Condition";
				if (isset($_GET["condition_new"])) {
					$request = $request . "&itemFilter(" . $filter_index . ").value(" . $value_index . ")=New";
					$value_index += 1;
				}
				if (isset($_GET["condition_used"])) {
					$request = $request . "&itemFilter(" . $filter_index . ").value(" . $value_index . ")=Used";
					$value_index += 1;
				}
				if (isset($_GET["condition_unspecified"])) {
					$request = $request . "&itemFilter(" . $filter_index . ").value(" . $value_index . ")=Unspecified";
					$value_index += 1;
				}

			}
			$response = file_get_contents($request);
			$response = json_decode($response);
	?>

		<!-- Javascript portion to handle the DOM manipulation from form input -->
		<script type="text/javascript">
			/*This portion is for saving the form inputs and maintaining the information after
			submit button has been pressed. This information is used to maintain the input information
			to the form throughout the program's run*/
			var keyword = "<?php echo $keyword_origin?>";
			document.getElementById("text_input").value = keyword;

			var category = "<?php echo $category; ?>";
			document.getElementById("category_input").value = category;

			var condition_new = "<?php echo $_GET['condition_new']; ?>";
			document.getElementById("cond_new_input").checked = condition_new;

			var condition_used = "<?php echo $_GET['condition_used']; ?>";
			document.getElementById("cond_used_input").checked = condition_used;

			var condition_unspecified = "<?php echo $_GET['condition_unspecified']; ?>";
			document.getElementById("cond_unspecified_input").checked = condition_unspecified;

			var shipping_local = "<?php echo $_GET['shipping_local']; ?>";
			document.getElementById("local_ship_input").checked = shipping_local;

			var shipping_free = "<?php echo $_GET['shipping_free']; ?>";
			document.getElementById("free_ship_input").checked = shipping_free;

			var enable_retain = "<?php echo $_GET['enable']; ?>";
			document.getElementById("enable").checked = enable_retain;

			var mile_retain = "<?php echo $_GET['mile']; ?>";
			var mile_retain_status = "<?php echo $mile_disabled; ?>";
			if (mile_retain === '' || mile_retain === undefined) {
				document.getElementById("mile_input").value = "10";
			} else {
				document.getElementById("mile_input").value = mile_retain;
			}
			document.getElementById("mile_input").disabled = mile_retain_status;

			var zip_code_retain = "<?php echo $_GET['zip_code']; ?>";
			var zip_code_retain_status = "<?php echo $zip_disabled;?>";
			document.getElementById("zip_code_input").value = zip_code_retain;
			document.getElementById("zip_code_input").disabled = zip_code_retain_status;

			var zip_retain = "<?php echo $zipcode_disabled; ?>";
			var zip_retain_checked = "<?php echo $zipcode_checked; ?>";
			var here_retain = "<?php echo $here_disabled; ?>";
			var here_retain_checked = "<?php echo $here_checked; ?>";

			document.getElementById("zip_check_input").disabled = zip_retain;
			document.getElementById("zip_check_input").checked = zip_retain_checked;
			document.getElementById("here_input").disabled = here_retain;
			document.getElementById("here_input").checked = here_retain_checked;

			/*Re-assign the jsons onto a new variable in javascript*/
			var json_response = <?php echo json_encode($response); ?>;
			var zip_code = "<?php echo $postal_code; ?>";

			// match regular expression for zip code
			var zip_regex = /^$|[0-9]{5}/;
			var regex_result = zip_regex.test(zip_code);

			// Create a table tag
			var form_table = document.getElementById("form_table");
			if (regex_result == false) {
				var regex_p = document.createElement("p");
				regex_p.innerHTML = "Zipcode is invalid";
				regex_p.id = "regex_p";
				form_table.insertAdjacentElement("afterend", regex_p);
			} else {
				var dom_table = document.createElement("table");
				dom_table.id = "dom_table";
				// variable that refers to the div for all the contents
				var content_div = document.createElement("div");
				content_div.id = "content";
				// First check if any error messages are sent back by Ebay and print out appropriate error message
				if (json_response["findItemsAdvancedResponse"][0]["errorMessage"]) {
					var post_error = document.createElement("p");
					post_error.innerHTML = json_response["findItemsAdvancedResponse"][0]["errorMessage"][0]["error"][0]["message"][0];
					post_error.id = "post_error";
					form_table.insertAdjacentElement("afterend", post_error);
					// Check empty items case
				} else if (json_response["findItemsAdvancedResponse"][0]["searchResult"][0]["@count"] == "0") {
					var no_record = document.createElement("p");
					no_record.innerHTML = "No Records has been found";
					no_record.id = "no_record";
					form_table.insertAdjacentElement("afterend", no_record);
				} else {
					// No error proceed
					var items = json_response["findItemsAdvancedResponse"][0]["searchResult"][0]["item"];
					// Array containing name of the header
					var header = ["Index", "Photo", "Name", "Price", "Zip Code", "Condition", "Shipping Option"];
					// Row element for the header
					var header_tr = document.createElement("tr");
					// index for each item
					var index = 1;
					// Iterating and attaching header string to th element
					for (var j = 0; j < header.length; j++) {
						var table_header = document.createElement("th");
						table_header.id = "table_header";
						table_header.innerHTML = header[j];
						header_tr.appendChild(table_header);
					}
					// Attach the header to the header_tr and then to the div that displays the content
					dom_table.appendChild(header_tr);
					content_div.appendChild(dom_table);
					form_table.insertAdjacentElement("afterend", content_div);
					// Iterating through the items in the list and creating appropriate rows
					for (var i = 0; i < items.length; i++) {
						var item_row = document.createElement("tr");
						var row_dict = {};

						if (items[i]["galleryURL"] !== undefined) {
							var image = items[i]["galleryURL"][0];
						} else {
							var image = "N/A";
						}

						if (items[i]["postalCode"] !== undefined) {
							var postalCode = items[i]["postalCode"][0];
						} else {
							var postalCode = "N/A";
						}

						if (items[i]["sellingStatus"][0]["currentPrice"][0]["__value__"] !== undefined) {
							var price = items[i]["sellingStatus"][0]["currentPrice"][0]["__value__"];
							price = "$" + price;
						} else {
							var price = "N/A";
						}

						if (items[i]["shippingInfo"][0]["shippingServiceCost"] === undefined) {
							var shippingType = "N/A"; 
						} else if (items[i]["shippingInfo"][0]["shippingServiceCost"][0]["__value__"] == "0.0") {
							var shippingType = "Free Shipping"; 
						} else if (items[i]["shippingInfo"][0]["shippingServiceCost"][0]["__value__"] != "0.0") {
							var shippingType = items[i]["shippingInfo"][0]["shippingServiceCost"][0]["__value__"];
							shippingType = "$" + shippingType;
						}

						if (items[i]["condition"] !== undefined) {
							var condition = items[i]["condition"][0]["conditionDisplayName"][0];
						} else {
							var condition = "N/A";
						}

						if (items[i]["title"] !== undefined) {
							var name = items[i]["title"][0];
						} else {
							var name = "N/A";
						}
						
						// ItemID is later used such that when a user clicks on the name and wants to get the
						// details of the item, this id is used to make another API call to get details of
						// single item
						var itemID = items[i]["itemId"][0];
						row_dict["index"] = index;
						row_dict["image"] = image;
						row_dict["name"] = name;
						row_dict["price"] = price;
						row_dict["postalCode"] = postalCode;
						row_dict["condition"] = condition;
						row_dict["shippingType"] = shippingType;
						// This item will not be explicitly iterated through, but it will be
						// used when dealing withe key = name case
						row_dict["itemid"] = itemID;
						// Create each column here
						for (var key in row_dict) {
							// Handle Images Separately
							if (key === "image") {
								var item_col = document.createElement("td");
								item_col.id = "image_col";
								var img = document.createElement("img");
								if (row_dict[key] === 'N/A') {
									item_col.innerHTML = 'N/A';
								} else {
									img.src = row_dict[key];
									item_col.appendChild(img);
								}
							} else if (key === "name") { 
								// Name also requires separate handling because when user
								// clicks on the name, we have to another set of DOM manipulation
								// to display more detailed information about the product
								// We use the trick of giving it link with string ?link= so that we
								// can trigger php to recognize when the name is clicked and use
								// $_GET to access individual link
								var item_col = document.createElement("td");
								item_col.id = "name_col";
								item_col.width = "700";
								var anchor = document.createElement("a");
								anchor.id = "item_anchor";
								// Make the URL address such that it passes all the necessary information to 
								// retain the form input information
								anchor.href = "?link=" + row_dict["itemid"] + "&keyword=" + keyword + "&category=" + category + 
								              "&condition_new=" + condition_new + "&condition_used=" + condition_used +
								              "&condition_unspecified=" + condition_unspecified + "&shipping_local=" + shipping_local +
								              "&shipping_free=" + shipping_free + "&enable_retain=" + enable_retain + "&mile_retain=" + mile_retain +
								              "&mile_retain_status=" + mile_retain_status + "&zip_code_retain=" + zip_code_retain + 
								              "&zip_code_retain_status=" + zip_code_retain_status + "&zip_retain=" + zip_retain + 
								              "&zip_retain_checked=" + zip_retain_checked + "&here_retain=" + here_retain + "&here_retain_checked=" + here_retain_checked;
								anchor.innerHTML = row_dict[key];
								item_col.appendChild(anchor);
							} else if (key == "itemid") {
								// Do nothing for this key, itemid is used in key == name handling case
							} else if (key == "price") {
								var item_col = document.createElement("td");
								item_col.id = "item_col";
								item_col.innerHTML = row_dict[key];
							} else if (key == "index") {
								var item_col = document.createElement("td");
								item_col.id = "item_col";
								item_col.innerHTML = row_dict[key];
							} else if (key == "postalCode") {
								var item_col = document.createElement("td");
								item_col.id = "item_col";
								item_col.innerHTML = row_dict[key];
							} else if (key == "condition") {
								var item_col = document.createElement("td");
								item_col.id = "item_col";
								item_col.innerHTML = row_dict[key];
							} else if (key == "shippingType") {
								var item_col = document.createElement("td");
								item_col.id = "item_col";
								item_col.innerHTML = row_dict[key];
							}
							// attach the preprocessed column to the current row
							item_row.appendChild(item_col);
						}
						// increment index
						index++;
						// attach the current completed row to the dom table
						dom_table.appendChild(item_row);
					}
				}
			}	
	  	</script>
	<?php } ?>

	<?php
		// Incase user clicks on one of the items on the initial DOM table
		// access detailed information on the item using another API call with
		// with itemID which is passed to the link parameter
		if (isset($_GET["link"])) {
			$item_id = $_GET["link"];
			// Following is API request for detailed information on one item
			$detail_request = "http://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=   [[API Key]]   &siteid=0&version=967&ItemID=". $item_id . "&IncludeSelector=Description,Details,ItemSpecifics";
			$detail_response = file_get_contents($detail_request);
			$detail_response = json_decode($detail_response);
			// These are for similar items API request
			$similar_request = "http://svcs.ebay.com/MerchandisingService?OPERATION-NAME=getSimilarItems&SERVICE-NAME=MerchandisingService&SERVICE-VERSION=1.1.0&CONSUMER-ID=   [[API Key]]   &RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&itemId=". $item_id . "&maxResults=8";
			$similar_response = file_get_contents($similar_request);
			$similar_response = json_decode($similar_response);		
	?>

		<script type="text/javascript">
			/*Functions used in the script*/
			/*firstButtonFucntion and secondButtonFunction are used to carry out the logic for drop down
			menu corresponding to the seller information and similar items*/
			function firstButtonFunction() {
				if (document.getElementById("seller_div")) {
					var seller_div_tag = document.getElementById("seller_iframe");
				}
				if (document.getElementById("no_description")) {
					var seller_div_tag = document.getElementById("no_description");
				}

				if (document.getElementById("similar_div")) {
					var similar_div_tag = document.getElementById("similar_div");
				}
				if (document.getElementById("no_similar_div")) {
					var similar_div_tag = document.getElementById("no_similar_div");
				}

				var first_button_image = document.getElementById("first_button_image");
				var first_button_p = document.getElementById("first_button_p");
				var second_button_image = document.getElementById("second_button_image");
				var second_button_p = document.getElementById("second_button_p");

				if (seller_div_tag.style.display == "none") {
				    seller_div_tag.style.display = "block";
				    similar_div_tag.style.display = "none";
				    first_button_image.src = "http://csci571.com/hw/hw6/images/arrow_up.png";
				    first_button_p.innerHTML = "click to hide seller message";
				    second_button_image.src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				    second_button_p.innerHTML = "click to show similar items";
				} else {
				    seller_div_tag.style.display = "none";
				    first_button_image.src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				    first_button_p.innerHTML = "click to show seller message";
  				}
			}

			function secondButtonFunction() {
				if (document.getElementById("seller_div")) {
					var seller_div_tag = document.getElementById("seller_iframe");
				}
				if (document.getElementById("no_description")) {
					var seller_div_tag = document.getElementById("no_description");
				}

				if (document.getElementById("similar_div")) {
					var similar_div_tag = document.getElementById("similar_div");
				}
				if (document.getElementById("no_similar_div")) {
					var similar_div_tag = document.getElementById("no_similar_div");
				}

				var first_button_image = document.getElementById("first_button_image");
				var first_button_p = document.getElementById("first_button_p");
				var second_button_image = document.getElementById("second_button_image");
				var second_button_p = document.getElementById("second_button_p");

				if (similar_div_tag.style.display == "none") {
				    similar_div_tag.style.display = "block";
				    seller_div_tag.style.display = "none";
				    first_button_image.src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				    first_button_p.innerHTML = "click to show seller message";
				    second_button_image.src = "http://csci571.com/hw/hw6/images/arrow_up.png";
				    second_button_p.innerHTML = "click to hide similar items";
				} else {
				    similar_div_tag.style.display = "none";
				    second_button_image.src = "http://csci571.com/hw/hw6/images/arrow_down.png";
				    second_button_p.innerHTML = "click to show similar items";
  				}
			}

 			/*First unfold all the form input parameters that were passed using the URL and assign them
 			to appropriate inputs*/
 			var keyword_link = "<?php echo $_GET['keyword']?>";
			document.getElementById("text_input").value = keyword_link;

			var category_link = "<?php echo $_GET['category']; ?>";
			document.getElementById("category_input").value = category_link;

			var condition_new_link = "<?php echo $_GET['condition_new']; ?>";
			document.getElementById("cond_new_input").checked = condition_new_link;

			var condition_used_link = "<?php echo $_GET['condition_used']; ?>";
			document.getElementById("cond_used_input").checked = condition_used_link;

			var condition_unspecified_link = "<?php echo $_GET['condition_unspecified']; ?>";
			document.getElementById("cond_unspecified_input").checked = condition_unspecified_link;

			var shipping_local_link = "<?php echo $_GET['shipping_local']; ?>";
			document.getElementById("local_ship_input").checked = shipping_local_link;

			var shipping_free_link = "<?php echo $_GET['shipping_free']; ?>";
			document.getElementById("free_ship_input").checked = shipping_free_link;

			var enable_retain_link = "<?php echo $_GET['enable_retain']; ?>";
			document.getElementById("enable").checked = enable_retain_link;

			var mile_retain_link = "<?php echo $_GET['mile_retain']; ?>";
			var mile_retain_status_link = "<?php echo $_GET['mile_retain_status']; ?>";
			if (mile_retain_link === '' || mile_retain_link === undefined) {
				document.getElementById("mile_input").value = "10";
			} else {
				document.getElementById("mile_input").value = mile_retain_link;
			}
			document.getElementById("mile_input").disabled = mile_retain_status_link;

			var zip_code_retain_link = "<?php echo $_GET['zip_code_retain']; ?>";
			var zip_code_retain_status_link = "<?php echo $_GET['zip_code_retain_status']; ?>";
			document.getElementById("zip_code_input").value = zip_code_retain_link;
			document.getElementById("zip_code_input").disabled = zip_code_retain_status_link;

			var zip_retain_link = "<?php echo $_GET['zip_retain']; ?>";
			var zip_retain_checked_link = "<?php echo $_GET['zip_retain_checked']; ?>";
			var here_retain_link = "<?php echo $_GET['here_retain']; ?>";
			var here_retain_checked_link = "<?php echo $_GET['here_retain_checked']; ?>";

			document.getElementById("zip_check_input").disabled = zip_retain_link;
			document.getElementById("zip_check_input").checked = zip_retain_checked_link;
			document.getElementById("here_input").disabled = here_retain_link;
			document.getElementById("here_input").checked = here_retain_checked_link;

			/* This portion of javascript code handles the individual item detail, seller information
			and similar items. */
			var json_detail = <?php echo json_encode($detail_response); ?>;
			// div that contains all the information
			var detail_div = document.createElement('div');
			detail_div.id = "detail_div";

			// h1 tag for containing the title string
			var detail_p = document.createElement('p');
			detail_p.innerHTML = "Item Details";
			detail_p.id = "detail_p";
			// Create a new table for product detail
			var detail_table = document.createElement('table');
			detail_table.border = '1';
			detail_table.id = "detail_table";

			// This variable is used to check conditions for first button append
			var no_detail = false;
			// If the API request for item details is missing, handle the error here
			if (json_detail["Errors"]) {
				var error_message = json_detail["Errors"][0]["ErrorClassification"] + " : " + json_detail["Errors"][0]["LongMessage"];
				var no_item = document.createElement("p");
				no_item.innerHTML = error_message;
				no_item.id = "no_item";
				form_table.insertAdjacentElement("afterend", no_item);
				no_detail = true;
			} else {
				// If correct request is sent attach proper detail, seller and similar items results
				// Attribute needed to construct the table
				var photo = json_detail["Item"]["PictureURL"];
				var title = json_detail["Item"]["Title"];
				var subtitle = json_detail["Item"]["Subtitle"];
				var price = json_detail["Item"]["CurrentPrice"]["Value"] + " " + json_detail["Item"]["CurrentPrice"]["CurrencyID"];
				var loc = json_detail["Item"]["Location"] + ", " + json_detail["Item"]["PostalCode"];
				var seller = json_detail["Item"]["Seller"]["UserID"];
				var returnpolicy = json_detail["Item"]["ReturnPolicy"]["ReturnsAccepted"];
				if (json_detail["Item"]["ReturnPolicy"]["ReturnsWithin"]) {
					returnpolicy += " within " + json_detail["Item"]["ReturnPolicy"]["ReturnsWithin"];
				}
				// This is the seller information that will be added to iframe tag later in the code
				var description = json_detail["Item"]["Description"];
				//var description = undefined;
				// Put all information under detail_dict dictionary and loop through it
				var detail_dict = {}
				// Only add fields that are actually present
				if (photo && photo["length"] > 0) {
					var photo = json_detail["Item"]["PictureURL"][0];
					detail_dict["Photo"] = photo;
				}

				if (title) {
					detail_dict["Title"] = title;
				}

				if (subtitle) {
					detail_dict["Subtitle"] = subtitle;
				}

				if (price) {
					detail_dict["Price"] = price;
				}

				if (loc) {
					detail_dict["Location"] = loc;
				}

				if (seller) {
					detail_dict["Seller"] = seller;
				}

				if (returnpolicy) {
					detail_dict["Return Policy (US)"] = returnpolicy;
				}

				// Also need to add item specific information - this will vary depending on the item
				if (json_detail["Item"]["ItemSpecifics"] === undefined) {
					// No additional item information, do nothing
				} else {
					// If there are other contents, starting adding it to the detail_dict dictionary
					var detail_specifics = json_detail["Item"]["ItemSpecifics"]["NameValueList"]
					for (var i = 0; i < detail_specifics.length; i++) {
						var name = detail_specifics[i]["Name"];
						var value = detail_specifics[i]["Value"][0];
						detail_dict[name] = value;
					}
				}
				for (var key in detail_dict) {
					var detail_row = document.createElement("tr");
					var detail_title = document.createElement("td");
					var detail_strong = document.createElement("strong");
					detail_title.id = "detail_title";
					detail_strong.id = "detail_strong";
					detail_strong.innerHTML = key;
					detail_title.appendChild(detail_strong);
					var detail_content = document.createElement("td");
					detail_content.id = "detail_content";
					if (key == "Photo") {
						var image_content = document.createElement("img");
						image_content.src = detail_dict[key];
						image_content.id = "detail_image";
						detail_content.appendChild(image_content);
					} else {
						detail_content.innerHTML = detail_dict[key];
					}
					
					detail_row.appendChild(detail_title);
					detail_row.appendChild(detail_content);
					detail_table.appendChild(detail_row);
				}
				detail_div.appendChild(detail_p);
				detail_div.appendChild(detail_table);
				form_table.insertAdjacentElement("afterend", detail_div);
			}

			// Function for resizing the iframe
			function resizeIframe() {
				var iFrame = document.getElementById("seller_iframe");
				iFrame.height = "";
				iFrame.height = iFrame.contentWindow.document.body.scrollHeight + 20 + "px";
				iFrame.style.display = "none";
			}

			// Add first collapsible button for seller information
			var first_button_div = document.createElement("div");
			var first_button = document.createElement("button");
			var first_button_image = document.createElement("img");
			var first_button_p = document.createElement("p");
			first_button_image.src = "http://csci571.com/hw/hw6/images/arrow_down.png";
			first_button_image.id = "first_button_image"
			first_button_image.style.height = "30px";
			first_button_image.style.width = "80px";
			first_button_div.classList.add("control_button");
			first_button_div.id = "first_button_div";
			first_button.id = "first_button";
			first_button_p.innerHTML = "click to show seller message";
			first_button_p.style.width = "200px";
			first_button_p.id = "first_button_p"
			first_button.appendChild(first_button_p);
			first_button.appendChild(first_button_image);
			first_button.setAttribute("onclick","firstButtonFunction();");
			first_button_div.appendChild(first_button);
			// Different insertAdjacentElement is carried out depending on whether the previous element
			// was a no item id error message or valid content
			if (no_detail === true) {
				no_item.insertAdjacentElement("afterend", first_button_div);
			} else {
				detail_div.insertAdjacentElement("afterend", first_button_div);
			}

			// DOM manipulation for seller information
			// if description key doesn't exist or its content is emtpy, print out an error message
			if (description === undefined || description == '') {
				var seller_div = document.createElement("h3");
				seller_div.innerHTML = "No Seller Message found.";
				seller_div.id = "no_description";
				seller_div.style.display = "none";
				first_button_div.insertAdjacentElement("afterend", seller_div);
			} else {
				var seller_div = document.createElement("div");
				var seller_info = document.createElement("iframe");
				seller_div.id = "seller_div";
				seller_info.id = "seller_iframe";
				seller_div.appendChild(seller_info);
				seller_info.srcdoc = description;
				seller_info.setAttribute("onload", "resizeIframe()");
				seller_info.frameBorder = "0";
				seller_info.scrolling = "no";
				first_button_div.insertAdjacentElement("afterend", seller_div);
			}

			//Add a space 
			var space_p = document.createElement("p");
			seller_div.insertAdjacentElement("afterend", space_p);

			// Add second collapsible button for similar items menu
			var second_button_div = document.createElement("div");
			var second_button = document.createElement("button");
			var second_button_image = document.createElement("img");
			var second_button_p = document.createElement("p");
			second_button_image.src = "http://csci571.com/hw/hw6/images/arrow_down.png";
			second_button_image.id = "second_button_image"
			second_button_image.style.height = "30px";
			second_button_image.style.width = "80px";
			second_button_div.classList.add("control_button");
			second_button_div.id = "second_button_div";
			second_button.id = "second_button";
			second_button_p.innerHTML = "click to show similar items";
			second_button_p.style.width = "200px";
			second_button_p.id = "second_button_p";
			second_button.appendChild(second_button_p);
			second_button.appendChild(second_button_image);
			second_button.setAttribute("onclick","secondButtonFunction();");
			second_button_div.appendChild(second_button);
			space_p.insertAdjacentElement("afterend", second_button_div);

			// DOM manipulation for similar items menu
			var json_similar = <?php echo json_encode($similar_response); ?>;

			var similar_table = document.createElement("table");
			similar_table.id = "similar_table";
			var similar_div = document.createElement("div");
			similar_div.id = "similar_div";
			similar_div.style.display = "none";
			var similar_row = document.createElement("tr");

			if (json_similar['getSimilarItemsResponse']) {
				var similar_items = json_similar["getSimilarItemsResponse"]["itemRecommendations"]["item"];
			} else {
				var similar_items = [];
			}

			var no_similar_items = false;
			// Handle cases when there are no similar items
			if (similar_items.length == 0 || !json_similar["getSimilarItemsResponse"])  {
					var no_similar_p = document.createElement("p");
					var no_similar_div = document.createElement("div");
					no_similar_p.id = "no_similar_p";
					no_similar_div.id = "no_similar_div";
					no_similar_p.innerHTML = "No Similar Item found.";
					no_similar_div.style.display = "none";

					no_similar_div.appendChild(no_similar_p);

					no_similar_items = true;
			} else {
				for (var i = 0; i < similar_items.length; i++) {
					var similar_column = document.createElement("td");
					// First access necessary information from the item
					var similar_image = similar_items[i]["imageURL"];
					var similar_title = similar_items[i]["title"];
					var similar_price = "$" + similar_items[i]["buyItNowPrice"]["__value__"];
					var similar_item_id = similar_items[i]["itemId"];
					// Create anchor, img, p and h4 tag which will be the contents inside
					// column of the similar_table
					var similar_anchor = document.createElement("a");
					similar_anchor.id = "similar_anchor";
					// Likewise construct the anchor tag so that it passes proper information to maintain the form input information
					similar_anchor.href = "?link=" + similar_item_id + "&keyword=" + keyword_link + "&category=" + category_link + 
								              "&condition_new=" + condition_new_link + "&condition_used=" + condition_used_link +
								              "&condition_unspecified=" + condition_unspecified_link + "&shipping_local=" + shipping_local_link +
								              "&shipping_free=" + shipping_free_link + "&enable_retain=" + enable_retain_link + "&mile_retain=" + mile_retain_link +
								              "&mile_retain_status=" + mile_retain_status_link + "&zip_code_retain=" + zip_code_retain_link + 
								              "&zip_code_retain_status=" + zip_code_retain_status_link + "&zip_retain=" + zip_retain_link + 
								              "&zip_retain_checked=" + zip_retain_checked_link + "&here_retain=" + here_retain_link + "&here_retain_checked=" + here_retain_checked_link;
					var similar_image_tag = document.createElement("img");
					similar_image_tag.id = "similar_image_tag";
					similar_image_tag.src = similar_image;
					var similar_p = document.createElement("p");
					var similar_h4 = document.createElement("h4");
					similar_p.id = "similar_p";
					similar_h4.id = "similar_h4";
					similar_p.innerHTML = similar_title;
					similar_h4.innerHTML = similar_price;
					similar_anchor.appendChild(similar_p);
					similar_column.appendChild(similar_image_tag);
					similar_column.appendChild(similar_anchor);
					similar_column.appendChild(similar_h4);
					similar_row.appendChild(similar_column);
				}
			}
			
			// Attach the row that is constrcuted inside the for loop to 
			// the similar_table which then will be placed after seller info
			if (no_similar_items === true) {
				second_button_div.insertAdjacentElement("afterend", no_similar_div);
			} else {
				similar_table.appendChild(similar_row);
				similar_div.appendChild(similar_table);
				second_button_div.insertAdjacentElement("afterend", similar_div);
			}
		</script>
	<?php } ?>
</body>
</html>