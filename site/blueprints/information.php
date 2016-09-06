<?php if(!defined('KIRBY')) exit ?>

title: Information
files: false
pages:
  template: section
deletable: false
preview: false
fields:
  title:
    label: Title
    type:  text
  text:
    label: About
    type:  textarea
  socials:
    label: Social Links
    type: structure
    entry: >
      {{name}} - {{link}}
    fields:
      name:
        label: Name
        type: text
        icon: font
      link:
        label: Link
        type: url