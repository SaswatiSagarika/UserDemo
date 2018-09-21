
<div class="result" id="result">
	<form action="">
	  Verb:<br>
	  <input type="text" id="verb" class="verb" name="Verb" value="GET">
	  <br>
	 
	  Content:<br>
	  <textarea  id="content" class="content" name="content" required></textarea>
	  <div class="error" style="background-color:red"></div>	  <br><br>
	    <p><button type="button">Get Value</button></p>
	</form> 

	<p>Please fill the content in the format below: Json with filter values:</p><hr>
	<p> <strong>Request Type:</strong> 
	{"year":"2018","productType":"Cooking Gear","productLine":"Camping Equipment","retailerType":"Outdoors Shop","product":"Camping Equipment","retailerCountry":"United States","quater":"Q1 2012","orderType":"Fax"}</p>
</div>
<table class="table">
    <thead>
      <tr>
        <th>Type</th>
        <th>Request Type</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Json</td>
        <td>{"year":"2018","productType":"Cooking Gear","productLine":"Camping Equipment","retailerType":"Outdoors Shop","product":"Camping Equipment","retailerCountry":"United States","quater":"Q1 2012","orderType":"Fax"}</td>
        <td>Json with filter values</td>
      </tr>
      
    </tbody>
  </table>
