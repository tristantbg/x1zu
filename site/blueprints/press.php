<?php if(!defined('KIRBY')) exit ?>

title: Press
files: true
pages: false
deletable: false
preview: true
fields:
  title:
    label: Title
    type:  text
  entries:
    label: Entries
    type: structure
    entry: >
      <table style="width:100%; font-size: 11px">
      	<tr>
      		<td style="width:25%">Title</td>
      		<td style="width:25%">Date</td>
      		<td style="width:25%">Link</td>
      		<td style="width:25%">Image</td>
      	</tr>
      	<tr>
      		<td style="width:25%">{{title}}</td>
      		<td style="width:25%">{{date}}</td>
      		<td style="width:25%">{{link}}</td>
      		<td style="width:25%"><img src="{{_fileUrl}}{{content}}" width="60px"/><br>{{content}}</td>
      	</tr>
      </table>
    fields:
      title:
        label: Title
        type:  text
        width: 1/2
      date:
        label: Date
        type:  date
        width: 1/2
      link:
        label: Link
        type:  url
        width: 1/2
      content:
        label: Image
        type:  image
        width: 1/2