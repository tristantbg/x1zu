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
      		<td style="width:25%">Address</td>
      		<td style="width:25%">Address Link</td>
      		<td style="width:25%">Content</td>
      	</tr>
      	<tr>
      		<td style="width:25%">{{title}}</td>
      		<td style="width:25%">{{address}}</td>
      		<td style="width:25%">{{addresslink}}</td>
      		<td style="width:25%">{{text}}</td>
      	</tr>
      </table>
    fields:
      title:
        label: Title
        type:  text
      address:
        label: Address
        type:  textarea
        width: 1/2
      addresslink:
        label: Address Link
        type:  url
        width: 1/2
      text:
        label: Content
        type:  textarea