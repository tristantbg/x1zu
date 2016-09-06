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
  category:
    label: Optional title
    type:  text
  collabtitle:
    label: Collaboration title
    type: text
    width: 1/2
  collabimg:
    label: Collaboration image
    type: image
    width: 1/2
  collabtext:
    label: Collaboration text
    type: textarea
  year:
    label: Year
    type:  text
    width: 1/3
  season:
    label: Season
    type: select
    width: 1/3
    default: ss
    options:
      ss: Spring Summer
      aw: Autumn Winter
  collabtoggle:
    label: Collaboration
    type: fieldtoggle
    on: collabtitle collabtext collabimg
    off: category
    default: false
    width: 1/3
  gallery:
    label: Gallery
    type: gallery