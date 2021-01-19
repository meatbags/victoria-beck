<?php
  $title = get_the_title();
  $images = get_field('project_images');
  $first = $images[0];
  $credits = get_field('project_credits');
  $imgString = '';
  $roleString = '';

  foreach ($credits as $cred) {
    $roleString .= $cred['project_role'] . '$SPLIT' . $cred['project_person'] . '$PERSON';
  }

  foreach ($images as $img) {
    $imgString .=  $img['sizes']['large'] . '$IMG';
  }
?>

<div class='item cascade-fade cascade-rise scrollto'
  data-title='<?php echo $title; ?>'
  data-images='<?php echo $imgString; ?>'
  data-credits='<?php echo $roleString; ?>'
  data-scroll='.slider'
  data-side='top'
  >
  <div class='inner'>
    <a href='#<?php echo $title; ?>'>
      <img src='<?php echo $first['sizes']['large']?>' />
    </a>
  </div>
</div>
