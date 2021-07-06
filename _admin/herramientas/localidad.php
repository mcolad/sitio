    <script src="_js/jquery.autocomplete.js"></script>
	<style>
        .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-no-suggestion { padding: 2px 5px;}
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: bold; color: #000; }
        .autocomplete-group { padding: 2px 5px; font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
/*     input { font-size: 24px; padding: 3px; border: 1px solid #CCC; display: block; margin: 20px 0; }
        option { font-size: 24px; padding: 3px; border: 1px solid #CCC; display: block; margin: 20px 0; }
*/    </style>
 
 
        <div class="input-group mb-3">
            <input name="country" id="autocomplete" onfocus="" placeholder="Escriba localidad, provincia o país de interés" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
            <button class="btn-primary btn " type="submit" id="edit-submit" name="op" value="<i class=&quot;fa fa-search&quot;></i>"><i class="fa fa-search"></i></button>
            </div>
        </div>

	<script>
    $(function () {
        'use strict';

<?
$flag = 1;
$result_prov = mysqli_query($cnx, "SELECT DISTINCT provincia FROM gps");
while($row_prov = mysqli_fetch_array($result_prov)) 
{
	$prov_js = str_replace(" ", "",$row_prov['provincia']);
	?>
		var <? echo $prov_js ?> = {<? 
		$result = mysqli_query($cnx, "SELECT id_gps, localidad FROM gps WHERE provincia = '".$row_prov['provincia']."'");
		while($row = mysqli_fetch_array($result)) 
		{ echo '"'.$row['localidad'].'": "'.$row['id_gps'].'", '; }
			?>} 
			var <? echo $prov_js ?>Array = $.map(<? echo $prov_js ?>, function (value, key) { return { value:key, data2:value ,data: { category: 'Provincia de <? echo $row_prov['provincia'] ?>' }}; });
	<?
	if($flag == 1){ $team = $prov_js.'Array'; $flag = 0; }
	else{ $team = $team.'.concat('.$prov_js.'Array)'; }
}
?>
		var teams = <? echo $team ?>;

        $('#autocomplete').devbridgeAutocomplete({
            
            lookup: teams,
            minChars: 3,
            onSelect: function (suggestion) 
			{
                recibeid('busqueda/r_predictivo.php', 'q='+suggestion.value+'&categoria='+suggestion.data.category+'&data='+suggestion.data2, '', 'div_predictivo');
                limpia(this);
    //           location.href = "index.php?email=&accion=imp&lugar="+suggestion.value+" ("+suggestion.data.category+")";
    //            $('#selection').html('You selected: ' + suggestion.value + ', ' + suggestion.data.category);
            },
    

			// para que busque solo al inicio de las palabras --->
            lookupFilter: function (suggestion, originalQuery, queryLowerCase) 
            {
                return suggestion.value.toLowerCase().indexOf(queryLowerCase) === 0;
            }, 
			// fin para que busque solo al inicio de las palabras --->
			
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'No tenemos resultados posibles para la elección',
            groupBy: 'category'
        });

    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-custom-append').autocomplete({
        lookup: MarcasArray,
        appendTo: '#suggestions-container'
    });

    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-dynamic').autocomplete({
        lookup: MarcasArray
    });
        
    });
    </script>	