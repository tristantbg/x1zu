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
            <td style="width:10%;">Season</td>
      		<td style="width:10%;">Year</td>
      		<td style="width:10%;">Title</td>
      		<td style="width:50%;">Text</td>
      		<td style="width:10%;">Image</td>
      		<td style="width:10%;">Link</td>
      	</tr>
      	<tr>
      	    <td>{{season}}</td>
      	    <td>{{year}}</td>
      		<td>{{title}}</td>
      		<td>{{text}}</td>
      		<td><img src="{{_fileUrl}}{{image}}" width="60px"/><br>{{image}}</td>
      		<td>{{link}}</td>
      	</tr>
      </table>
    fields:
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
      title:
        label: Title
        type:  text
      text:
        label: Text
        type:  textarea
      image:
        label: Image
        type:  image
        width: 1/2
      link:
        label: Link
        type:  url
        width: 1/2