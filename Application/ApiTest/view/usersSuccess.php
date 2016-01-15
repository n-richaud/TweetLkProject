<table class="highlight hoverable centered">
	<thead>
		<tr>
			<th data-field="id">Avatar</th>
			<th data-field="id">Profil</th>
			<th data-field="name">Nom</th>
			<th data-field="price">Prénom</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($context->data as $data) {
			if(!is_array(@getimagesize($data->avatar))) {
				$data->avatar = "././images/avatar-default.png";
			}
	    echo '
	    <tr>
				<td><img width="50" height="50" class="circle responsive-img" onerror="this.onerror=null;this.src="././images/avatar-default.png;" src="'.$data->avatar.'"></td>
				<td data-field="id"><a href="././ApiTest.php?action=user&id='.$data->id.'">'.$data->identifiant.'</a></td>
				<td data-field="name">'.$data->nom.'</td>
				<td data-field="price">'.$data->prenom.'</td>
	    </tr>
	    ';
	  }
	  ?>
	</tbody>
</table>