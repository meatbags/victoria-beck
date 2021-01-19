</div> <!-- /.content -->

<?php
	$portfolio = '';
	$query = new WP_Query(array(
		'post_type' => 'portfolio',
		'posts_per_page' => 1,
		'order_by' => 'menu_order',
		'order' => 'ASC'
	));
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$portfolio = get_field('portfolio_pdf');
		}
	}
?>

<div class='footer raised grid grid-fill info-hide'>
	<div class='half text-left'>
		STYLING &amp;<br />
		CONSULTING
	</div>
	<div class='half text-right'>
		<a class='hover' href="<?php echo $portfolio['url']; ?>" class='hover' download>
			DOWNLOAD<br />
			PORTFOLIO<span class='tablet-hide'>&nbsp;PDF</span>
		</a>
	</div>
</div>

<div class='footer__clients'>
	<span class='tablet-hide'>SELECTED CLIENTS</span>
	<span class='tablet-show'>CLIENTS</span>
	<br /><br />
	<div class='footer__clients__wrapper'>
		<div class='footer__clients__wrapper__inner scrollable'>

		<?php $query = new WP_Query(array(
			'post_type' => 'clients',
			'posts_per_page' => -1,
			'order_by' => 'menu_order',
			'order' => 'ASC'
		));

		if ($query->have_posts()):
			while ($query->have_posts()):
				$query->the_post();
				$title = get_the_title();
				$clients = get_field('client_list');
				?>
				<div class='client__list'>
					<div class='client__title medium'>
						<?php echo $title; ?>
					</div>
					<br />
					<div class='client__name em small'>
					<?php
					$count = 0;
					foreach ($clients as $client):
						$break = ', ';
						$len = count($clients) - 1;
						if ($count == $len) {
							$break = '.';
						}
						if ($client['url'] === ''): ?>
								<?php echo $client['client'] . $break; ?>
						<?php else: ?>
								<a target='_blank' href='<?php echo $client['url']; ?>'><?php echo $client['client'] . $break; ?></a>
						<?php
						endif;
						$count ++;
					endforeach;
					?>
					</div>
					<br /><br />
				</div>
				<?php
			endwhile; endif;
		?>

		</div>
	</div>
</div>

<div class='footer grid grid-fill mobile-hide'>
  <div class='em quarter small align-end'>
    &copy; 2017 Victoria Beck. All rights reserved
  </div>
  <div class='half text-centre nowrap'>
		<a class='hover' href='mailto:mail@victoria-beck.com'>
			MAIL@VICTORIA-BECK.COM
		</a><br />
		+(49) 0176 5609 7737<br /><br />
		LAHNSTRAßE 89<br />
		12055 BERLIN, GERMANY<br />
  </div>
  <div class='em quarter small align-end justify-end'>
    <a href='http://www.teuberkohlhoff.com/' class='hover'>Design: Teuber Kohlhoff</a>
  </div>
</div>

<!-- mobile -->

<div class='footer footer__mobile'>
  <div class='nowrap'>
		<a href='mailto:mail@victoria-beck.com'>
			MAIL@VICTORIA-BECK.COM
		</a><br />
		+(49) 0176 5609 7737<br /><br />
		LAHNSTRAßE 89<br />
		12055 BERLIN, GERMANY<br />
  </div>
  <div class='em small'>
		<br />
    <a href='http://www.teuberkohlhoff.com/' class='hover'>Design: “Teuber Kohlhoff”</a>
  </div>
	<div class='em small'>
		<br />
    &copy; 2017 Victoria Beck.<br />All rights reserved
  </div>
</div>

</body>
</html>
