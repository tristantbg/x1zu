<?php

kirbytext::$tags['gps'] = array(
'attr' => array(
	'name',
    'address'
  ),
  'html' => function($tag) {
  	$gps = $tag->attr('gps');
  	$name = $tag->attr('name', 'Name');
    $address = $tag->attr('address', 'Address');
    return '<div class="gps"><span>' . $name . '</span><br><span class="gps">' . $gps . '</span><span class="address">' . $address . '</span></div>';
  }
);