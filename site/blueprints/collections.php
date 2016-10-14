<?php if(!defined('KIRBY')) exit ?>

title: Collections
files: true
pages:
  template: collection
deletable: false
preview: false
fields:
  title:
    label: Title
    type:  text
  collaborations:
    label: Collaborations
    type: structure
    entry: >
      <table style="width:100%; font-size: 11px">
      	<tr>
            <td style="width:25%;">Link type</td>
            <td style="width:25%;">Image</td>
            <td style="width:25%;">Local page</td>
      		<td style="width:25%;">External Link</td>
      	</tr>
      	<tr>
      	    <td>{{collabtype}}</td>
      		<td><img src="{{_fileUrl}}{{image}}" width="60px"/><br>{{image}}</td>
      		<td>{{collabpage}}</td>
      		<td>{{link}}</td>
      	</tr>
      </table>
    fields:
      collabtype:
        label: Link type
        type: fieldtoggle
        options:
          local: Website page
          external: External link
        show:
          local: collabpage
          external: year season collabtitle collabtext link
        hide:
          local: year season collabtitle collabtext link
          external: collabpage
      year:
        label: Year
        type:  text
        width: 1/2
      season:
        label: Season
        type: select
        width: 1/2
        options:
          ss: Spring Summer
          aw: Autumn Winter
      collabtitle:
        label: Title
        type:  text
      collabtext:
        label: Text
        type:  textarea
      image:
        label: Image
        type:  image
        width: 1/2
      collabpage:
        label: Collection page
        type: select 
        options: query
        width: 1/2
        query: 
          page: collections
          fetch: children
          value: '{{uid}}'
          text: '{{title}}'
      link:
        label: Link
        type:  url
        width: 1/2