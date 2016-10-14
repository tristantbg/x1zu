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
    required: true
  category:
    label: Optional title
    type:  text
    width: 2/3
    required: true
  year:
    label: Year
    type:  text
    width: 1/3
    required: true
  season:
    label: Season
    type: select
    width: 1/3
    default: ss
    options:
      ss: Spring Summer
      aw: Autumn Winter
  incollection:
    label: Show in collections ?
    type: toggle
    text: yes/no
    default: yes
    width: 1/3
  text:
    label: Description for SEO or collaborations
    type: textarea
  gallery:
    label: Gallery
    type: gallery