# CNR Music Radio Meeting-room Booking System and Memo Board

## Introduction

This is an internal website running in LAN for meeting-room booking and news sharing and discussion.  It also has an user management console for only administrators to add, modify, delete users and assign user groups.  

This application is built on PHP 5.X.  No support for 7.X and above version. The displaying language is Chinese.  Maybe it will cause trouble in non-Chinese environment.

### **Meeting-room Booking Page**

This part is complete.  

The page will display a calendar of five-day (Mon - Fri) with nine-hour (from 9 - 17) for every day.  Users can book the meeting-roon by clicking hour grids.  In every hour, there are beginning time and finishing time needed to be chosen. A chosen time zone is not available for other users to pick up.

### **Memo Board for sharing and discussion**

This is complete.  

This is a monthly calendar.  Users can leave memos on day grids and the memos on one day will stack on the grid. Users can click day grid to create a new memo or click the existing memo to edit or delete.

### **User Management Console**

This is complete.  

Only administrators can has the right to use this module.

## Usage

- Download all the code into your web root folder, for example `\bk`.

- Create a database named `bk` in MySQL with `utf8_general_ci`. Download the `bk.sql` file and import it.  Now you have a database ready.

- Then open the browser and type `localhost/bk/index.php`. This will open the booking page. This page can be accessed by anyone with a visitor identity.

- To enter user management console, there is a link on the booking page.  You need an administrator account to log in.  Try **admin** for username and **123456** for password.

- To access the memo board, type `localhost/bk/calendar/calendar.php`.

## Comments from the author

My debut work, simple and raw.
