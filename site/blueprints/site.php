<?php if(!defined('KIRBY')) exit ?>

title: Site
fields:
  generalSettings:
    label: Site Settings
    type: headline
  title:
    label: Title
    type:  text
    width: 1/2
  home:
    label: Homepage
    type: select 
    options: query
    width: 1/2
    query: 
      page: collections
      fetch: children
      value: "{{uri}}"
      text: "{{title}}"
  description:
    label: Description
    type:  textarea
  keywords:
    label: Keywords
    type:  tags
  customcss:
    label: Custom CSS
    type: textarea
    buttons: false
  googleAnalytics:
    label: Google Analytics ID
    type: text
    icon: code
    help: Tracking ID in the form UA-XXXXXXXX-X. Keep this field empty if you are not using it.
    width: 1/2
  ogimage:
    label: Facebook OpenGraph image
    type: image
    help: 1200x630px minimum
    width: 1/2