<?php if(!defined('KIRBY')) exit ?>

title: Project
files: true
pages: false
fields:
  date:
    label: Year
    type:  date
    format: DD/MM/YYYY
    width: 1/3
  title:
    label: Title
    type:  text
    width: 1/3
  subtitle:
    label: Subtitle
    type: text
    width: 1/3
    help: Only for exhibitions
  category:
    label: Category
    type: text
    width: 1/3
  featured:
    label: Featured image
    type: image
    width: 1/3
  textmenu:
    label: Text menu
    type: select
    options:
      text: Text
      credits: Credits
    default: text
    width: 1/3
  text:
    label: Description
    type: textarea
  medias: 
    label: Images
    type: gallery