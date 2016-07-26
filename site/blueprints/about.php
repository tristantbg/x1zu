<?php if(!defined('KIRBY')) exit ?>

title: About
files: true
pages: false
deletable: false
preview: false
fields:
  title:
    label: Title
    type:  text
  text:
    label: Introduction
    type:  textarea
  awards:
    label: Awards
    type:  textarea
  books:
    label: Books
    type: structure
    entry: >
      <table style="width:100%; font-size: 11px">
      	<tr>
      		<td style="width:25%">Image</td>
      		<td style="width:25%">Text</td>
      	</tr>
      	<tr>
      		<td style="width:25%"><img src="{{_fileUrl}}{{content}}" width="60px"/><br>{{content}}</td>
      		<td style="width:25%">{{text}}</td>
      	</tr>
      </table>
    fields:
      content: 
        label: Image
        type:  image
        width: 1/2
      text: 
        label: Text
        type:  text
  texts:
    label: Interviews, Texts & Reviews
    type: textarea
  contact:
    label: Contact
    type:  textarea
  blog:
    label: Blog
    type:  textarea