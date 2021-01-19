<?php
  $query = new WP_Query(array(
    'post_type' => 'projects',
    'posts_per_page' => -1,
    'order_by' => 'menu_order',
    'order' => 'ASC'
  ));

  if ($query->have_posts()): ?>

<div class='projects'>
  <div class='projects__inner'>
    <div class='projects__inner__columns tablet-hide'>
      <?php
          $columns = array(0, 1, 2);
          foreach ($columns as $col):
            $count = 0; ?>

            <div class='project-column col-third third'>
              <?php while ($query->have_posts()) {
                $query->the_post();
                if ($count % 3 == $col) { ?>

              <?php
                // GRID ITEM
                $title = get_the_title();
                $number = $count + 1;
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
                data-number=<?php echo $number;?>
                data-scroll='.slider'
                data-side='top'
                >
                <div class='inner'>
                  <a href='#<?php echo $title; ?>'>
                    <img src='<?php echo $first['sizes']['large']?>' />
                  </a>
                </div>
              </div>

                <?php
               }
                $count += 1;
              }?>
            </div>

          <?php
          endforeach;
      ?>
    </div>
    <div class='projects__inner__columns tablet-show'>
    <?php
      $columns = array(0, 1);
      foreach ($columns as $col):
        $count = 0; ?>

        <div class='project-column col-half half'>
          <?php while ($query->have_posts()) {
            $query->the_post();
            if ($count % 2 == $col) { ?>

              <?php
                // GRID ITEM
                $title = get_the_title();
                $number = $count + 1;
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
                data-number=<?php echo $number;?>
                data-scroll='.slider'
                data-side='top'
                >
                <div class='inner'>
                  <a href='#<?php echo $title; ?>'>
                    <img src='<?php echo $first['sizes']['large']?>' />
                  </a>
                </div>
              </div>

          <?php
            }
            $count += 1;
          }?>
        </div>

      <?php
      endforeach;
    ?>
    </div>
  </div>
</div>

<?php endif; ?>
