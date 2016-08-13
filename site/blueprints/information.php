<?php if(!defined('KIRBY')) exit ?>

title: Information
files: true
pages: false
deletable: false
preview: false
fields:
  title:
    label: Title
    type:  text
  text:
    label: About
    type:  textarea
  contact:
    label: Contact
    type: builder
    fieldsets:
      section:
        label: Section
        entry: >
               <table style="width:100%; font-size: 11px">
               <tr>
               <td style="width:25%">Title</td>
               <td style="width:75%">Text</td>
               </tr>
               <tr>
               <td style="width:25%">{{sectiontitle}}</td>
               <td style="width:75%">{{sectiontext}}</td>
               </tr>
               </table>
        fields:
          sectiontitle:
            label: Title
            type: text
          sectiontext:
            label: Text
            type: textarea
  stockists:
    label: Stockists
    type: builder
    fieldsets:
      section:
        entry: >
               <table style="width:100%; font-size: 11px">
               <tr>
               <td style="width:25%">Title</td>
               <td style="width:75%">Text</td>
               </tr>
               <tr>
               <td style="width:25%">{{sectiontitle}}</td>
               <td style="width:75%">{{sectiontext}}</td>
               </tr>
               </table>
        label: Section
        fields:
          sectiontitle:
            label: Title
            type: text
          sectiontext:
            label: Text
            type: textarea