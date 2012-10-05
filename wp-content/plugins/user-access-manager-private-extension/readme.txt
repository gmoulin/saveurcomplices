=== User Access Manager Private Extension ===
Contributors: eberzosa
Donate link:
Tags: access, members, member, member access, post, posts, private, privacy, restrict, user, user access manager, user access manager private posts, protect, protected, allow, deny, hide
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 0.1

Protect parts of posts from unauthorized users. Requires User Access Manager.

== Description ==

User Access Manager Private Extension (UAMPE) protects parts of the content of your posts from the view of unauthorized users. Unregistered users can't read the information that you mark as private, but you can show them an anternative message to require for register to access the information.
Also you can block parts of your posts to some groups or allow some groups to view it, this plugin works connected with User Access Manager plugin and uses groups defined in UAM to block posts. When a user can't access the private part of a post a message an anternative may be displayed.

**Feature list**

* Multiple protected parts in each post
* Allow / Deny view of the protected parts to one/multiple groups of users
* Use ID or Name to specify UAM groups
* Show/Hide private message in each protected part individually
* Show/Hide not authorized text in each protected part individually
* Customizable private message
* Customizable not authorized message

**Usage**

* Privatize a part of a post: [private]Protected text[/private]
* Allow visibility to one group by group ID: [private group=1]Protected text[/private]
* Allow visibility to one group by group Name: [private group='Group1']Protected text[/private]
* Allow visibility to more than one: [private group=1,2,3]Protected text[/private]
* Allow visibility to more than one by Name: [private group='Grp1,Grp2']Protected text[/private]
* Deny visibility to more than one group by Name: [private group='!Grp1,!Grp2']Protected text[/private]
* Show private message: [private showprivate=y]Protected text[/private]
* Hide private message: [private showprivate=n]Protected text[/private]
* Show not authorized message: [private shownotauthorized=y]Protected text[/private]
* Hide not authorized message: [private shownotauthorized=n]Protected text[/private]

**Lacks**

* No configuration page (yet) to change protected and not authorized text messages, have to be done manually changing it at the options table.
* No configuration page (yet) to define default visibility (yes/no) of protected and not authorized messages. Can be archieved with shortcode attributes list above.

== Installation ==
 
1. Upload the full directory, with the folder, into your 'wp-content/plugins' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use [private][/private] shortcodes to protect the information you want. *Remember you can use attributes.


== Frequently Asked Questions ==

= Not FAQ yet =
Sorry

== Screenshots ==

1. None


== Changelog ==

= 0.1 =
Beta version

== Upgrade Notice ==

= 0.1 =
Beta version