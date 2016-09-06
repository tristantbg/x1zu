<?php if(!defined('KIRBY')) exit ?>

title: Collection
files: true
pages: false
deletable: true
preview: false
fields:
  title:
    label: Title
    type:  text
    width: 1/3
  category:
    label: Optional title
    type:  text
    width: 2/3
  year:
    label: Year
    type:  text
    width: 1/3
  season:
    label: Season
    type: select
    width: 2/3
    default: ss
    options:
      ss: Spring Summer
      aw: Autumn Winter
  gallery:
    label: Gallery
    type: gallery