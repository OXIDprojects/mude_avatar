== Title ==
Musterdenker Avatar for OXID eShop CE 4

== Author ==
Christian Zacharias
Mathias Fiedler
Henry

== Prefix ==
mude

== Version ==
0.9

== Link ==
http://www.musterdenker.de/

== Mail ==
info@musterdenker.de

== Description ==
With this module each registered user of an OXID eShop (>4.0.0.0) can upload an image or register it Gravatar image. The user avatar will be displayed next to the users comments and the recommend lists. Making the eShop more "community like".

== Extends ==
 * oxuser (hasMudeAvatar, getMudeAvatarUrl)
 * oxreview (assign, getMudeAvatarUrl)
 * oxrecommlist (assign, getMudeAvatarUrl)
 

== Instalation ==
copy the contents of the folder "copy_this" to shop root
look in the folder "change_full" if any customized templates are affected, if not just copy content to shop folder
execute install.sql
put the avatar size into the config.inc.php:
$this->mude_avatar_picture_height = 80;
$this->mude_avatar_picture_width = 80;
add a new seo route in admin for teh URL: "index.php?cl=mude_account_avatar"

== Modules ==
oxuser => mude_avatar/mude_avatar_oxuser
oxreview => mude_avatar/mude_avatar_oxreview
oxrecommlist => mude_avatar/mude_avatar_recommlist

== Libraries ==