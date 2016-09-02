<?php if(!defined('KIRBY')) exit ?>

title: Sub-section
files: false
pages: false
deletable: true
preview: false
visible: false
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
      		<td style="width:25%">Content</td>
      	</tr>
      	<tr>
      		<td style="width:25%">{{title}}</td>
      		<td style="width:25%">{{text}}</td>
      	</tr>
      </table>
    fields:
      title:
        label: Title
        type:  text
      text:
        label: Content
        type:  textarea