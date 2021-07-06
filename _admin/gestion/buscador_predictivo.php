	<style>
        .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-no-suggestion { padding: 2px 5px;}
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: bold; color: #000; }
        .autocomplete-group { padding: 2px 5px; font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
   </style>
 
 <?
$result = mysqli_query($cnx, "SELECT id_apli_".strtolower($apli).", titulo FROM apli_$apli WHERE titulo != ''");
if(mysqli_num_rows($result) > 5)
{
 ?>
    <input class="form-control form-control-sm" name="country" id="autocomplete" onfocus="" placeholder="buscar" type="text">
    <script type="text/javascript" src="../../_js/jquery.autocomplete.js"></script>
	<script>
    $(function () {
        'use strict';
		
	var Marcas = {<? 
	while($row = mysqli_fetch_array($result)) 
	{ echo '"'.preg_replace('/[^a-zA-Z áéíóúÁÉÍÓÚñÑ #-_]/', ' ', $row['titulo']).'": "'.$row['id_apli_'.strtolower($apli)].'", '; }
		?>} 
    
        var MarcasArray = $.map(Marcas, function (value, key) { return { value:key, data2:value ,data: { category: 'Resultados:' }}; });
		var teams = MarcasArray
        // Initialize autocomplete with local lookup:
        $('#autocomplete').devbridgeAutocomplete({
			
           

            lookup: teams,
            minChars: 1,
            onSelect: function (suggestion) 
			{
     //            recibeid('#', 'q='+suggestion.value+'&categoria='+suggestion.data.category+'&data='+suggestion.data2, '', 'div_predictivo');
      //          limpia(this);



//                location.href = "?editar=1&play=<? echo $play; ?>&order_que=<? echo $order_que; ?>&order=<? echo $order; ?>&filtro_tag=<? echo $filtro_tag; ?>&id="+suggestion.data2;
                  location.href = "?filtro_id="+suggestion.data2;




//              location.href = "?email=&accion=imp&lugar="+suggestion.value+" ("+suggestion.data.category+")";
    //            $('#selection').html('You selected: ' + suggestion.value + ', ' + suggestion.data.category);
            },
    

			// para que busque solo al inicio de las palabras --->
 //           lookupFilter: function (suggestion, originalQuery, queryLowerCase) 
 //           {
 //               return suggestion.value.toLowerCase().indexOf(queryLowerCase) === 0;
 //           }, 
			// fin para que busque solo al inicio de las palabras --->
			
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'No tenemos resultados posibles para la elección',
            groupBy: 'category'
        });

    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-custom-append').autocomplete({ lookup: MarcasArray, appendTo: '#suggestions-container' });

    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-dynamic').autocomplete({ lookup: MarcasArray });
        
    });
    </script>
<?
}
?>