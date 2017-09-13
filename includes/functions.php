<?php

function listOfCategories(){
	return query('SELECT * FROM categories');
}


function generateTable($head, $queryResult, $baseUrl){
	print '<table class="table table-sm table-striped">';
	print '<thead class="thead-inverse"><tr><th>#</th>';
	foreach($head as $k=>$v){
		printf('<th>%s</th>', $v);
	}
	print '<th>Act</th></tr></thead><tbody>';

	foreach ($queryResult as $key => $value) {
		print '<tr>';
		printf('<td>%s</td>', $key+1);
		foreach ($head as $k => $v) {
			printf('<td>%s</td>', $value[$k]);
		}
		printf('<td><a href="%s">Edit</a> | <a href="%s">Delete</a> </td>', $baseUrl.'&act=edit&id='.$value['id'], $baseUrl.'&act=delete&id='.$value['id']);
		print '</tr>';
	}

	print '</tbody></table>';
}

function generateForm($header, $baseUrl, $id='', $data = []){
	printf('<form  method="POST" action="%s"> ', $baseUrl);
	foreach ($header as $key => $value) {

		if(is_array($value)){
			$val = '';
			foreach ($value as $k  => $v) {
				$val .= sprintf('<option value="%s">%s</option>', $k, $v);
			}
			printf('<div class="form-group">
				    	<label for="%s">%s</label>
				    	<select class="form-control" name="%s">%s</select>		    
			  		</div>', $key, $key, $key, $val);
		}else{
			if(count($data) && isset($data[$key])){
				$d = sprintf('value="%s"', $data[$key]);
			}else{
				$d = '';
			}

			printf('<div class="form-group">
				    	<label for="%s">%s</label>
				    	<input type="text" class="form-control" name="%s"  placeholder="Enter %s" %s >		    
			  		</div>', $key, $value, $key, $value, $d);	
		}			  	
	  }  
	if($id != ''){
		printf('<input type="hidden" name="id" value="%s" />',$id);
	}
	printf('<button type="submit" class="btn btn-primary">Save</button></form>');

}