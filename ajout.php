<?php
  $AppelInclude = './include/';
  require($AppelInclude . "header.inc.html");
?>
 <div  id = "pagelist">
	<p>
		<label>Matières </label>
		<select name="matiere" id="mat">
		<option value="0"></option>
		<option value="1">MATHEMATIQUES</option>
		<option value="2">ANGLAIS</option>
		<option value="3">SCIENCES PHYSIQUES</option>
		<option value="3">FRANÇAIS</option>
		<option value="3">HISTOIRE-GEOGRAPHIE</option>
		</select>
	</p>
	
	<p>
		<label> Classes </label>
		<select  id="classe">
		<option value="0"></option>
		<option value="1">2nd</option>
		<option value="2">1er</option>
		<option value="3">Terminal</option>
         
		</select>
	</p>
	
	<p>
	  <label for="list">Fournitures conseillées</label>
          <textarea name="list" id="list"></textarea>
	</p>
	
	
   
<p>
<input type="submit" id="login" value="Ajouter fourniture" />
</p>
</div>
<?php
  require($AppelInclude . "footer.inc.html");
?>