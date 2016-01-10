<table class="highlight hoverable">
  <thead>
    <tr>
      <th data-field="id">Avatar</th>
      <th data-field="id">Profil</th>
      <th data-field="name">Nom </th>
      <th data-field="price">Prénom</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($context->data as $key => $data) { 
      if((strpos($data['avatar'], 'http') === true && !filter_var($data['avatar'], FILTER_VALIDATE_URL) !== false) || !file_exists($data['avatar'])) {
        $data['avatar'] = '././images/avatar-default.png';
      }
    ?>
    <tr>   
      <td><img width="50" height="50" class="circle responsive-img" onerror="this.onerror=null;this.src='././images/avatar-default.png';" src="<?php echo $data['avatar'];?>"></td>
      <td data-field="id"><a href="././ApiTest.php?action=user&id=<?php echo $data['id'];?>"><?php $data['identifiant']; ?></a></td>
      <td data-field="name"><?php echo $data['nom']; ?></td>
      <td data-field="price"><?php echo $data['prenom']; ?></td>
    </tr>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>