

		Single File PHP Gallery 4.14.0 (SFPG)

		See END USER LICENSE AGREEMENT for commercial

		Released: 2024-Dec-17
		https://sye.dk/sfpg/
		By Kenny Svalgaard


____________________________________________________________
WHAT IS IN THIS FILE

 * WHAT IS IN THIS FILE
 * WHAT IS SINGLE FILE PHP GALLERY?
 * END USER LICENSE AGREEMENT / EULA
 * FEATURES
 * IMPORTANT INFORMATION
 * NEWS IN THIS VERSION
 * REQUIREMENTS
 * HOW TO USE / QUICK START
 * USING A WRAPPER FILE
 * TIPS / FAQ
 * KNOWN ISSUES
 * SUPPORT / REQUESTS / HELP / CONTACT
 * CONFIGURATION INFORMATION


____________________________________________________________
WHAT IS SINGLE FILE PHP GALLERY?

Single File PHP Gallery is a web gallery in one single file. All you have to do is copy the script to any directory containing images to make a gallery. Sub directories will be sub galleries. Thumbnails for images and directories are generated automatically. Descriptions for galleries and images can be added by making a simple text file.
Single File PHP Gallery does not require any configuration or programming skills to use.

You can see how it looks in the demo here:

  https://sye.dk/sfpg/


____________________________________________________________
END USER LICENSE AGREEMENT / EULA

For private non commercial use Single File PHP Gallery can be used for free. When used commercially a donation for at least 10$ must be made per domain where it is used.

You are of course still more than welcome to donate if you like the gallery, even though you only use it privately.

Under no circumstances can Single File PHP Gallery or any part of it be distributed or sold, or be part of another work that is being distributed or sold.

Making a donation:
Domain name must be clearly stated in the donation, otherwise the donation will not grant use of the script under donating conditions. Donations are not refundable.

Use the PayPal donate button on the page for donations:
  https://sye.dk/sfpg/

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


____________________________________________________________
FEATURES

 * Gallery in one single file
 * Free for private non commercial use
 * Very simple Plug'n'Play like ease of use
 * Uses no Database
 * Automatically creates thumbnails
 * GPS link and map for images with GPS information
 * Zip option for download of gallery images and files
 * Slideshow option
 * PayPal integration for simple selling
 * Displays EXIF, IPTC and PNG text chunks information
 * Option to password protect gallery
 * Administrator options to upload, rename, move, delete and create directories, images and files
 * Administrator options to manage description and selling information
 * Rotates images using EXIF information
 * 3D MPO red/cyan anaglyph and stereo image generation
 * Keyboard navigation
 * Option to add watermark to all images in gallery
 * Supports JPG, JPEG, PNG, GIF, WebP and MPO
 * Unlimited numbers of sub galleries
 * See configuration information for all features


____________________________________________________________
IMPORTANT INFORMATION

 * Make sure to NOT place any content from untrusted sources in the gallery. Code or scripts embedded in files could be sent to the end users, and could be executed.

 * The gallery contains an Admin option, which allow users to upload, delete, move, rename and create directories, images and files in the gallery.
   If using this option, make sure that only administrators have access to the gallery.
   Do not put the gallery unprotected on a public web server with this option enabled. See the ADMIN option for details.
   For this to work, PHP needs permission to create, modify and delete in the GALLERY_ROOT.

 * The gallery contains an automatic clean-up function that deletes unused files in DATA_ROOT.
   The gallery will delete files in the DATA_ROOT that are no longer used by the gallery. So make sure not to use the DATA_ROOT for storing anything.
   The clean-up routine is activated when viewing a directory where the number of subdirectories, images and/or files have changed since last access to the directory.
   For this to work, PHP needs permission to delete in the DATA_ROOT.

 * The gallery contains options to delete images older than a set number of days, and empty directories. If using these options, make sure to have a backup of the GALLERY_ROOT.
   For these options to work, PHP needs permission to delete in the GALLERY_ROOT.


____________________________________________________________
NEWS IN THIS VERSION (4.14.0)

 * Added function to automatically reload thumbnails that have failed to load.
 * Added options RELOAD_IMAGE_MIN to allow setting lower limit for when to trigger a reload of thumbnails that have failed to load.
 * Added options RELOAD_IMAGE_MAX to allow setting upper limit for when to trigger a reload of thumbnails that have failed to load.
 * Added option DIR_NAME_AS_BANNER to allow showing directory names as banners above the thumbnails.
 * Optimized so that the Info box is not updated by thumbnail mouseover when the Info box is not shown.

News from previous version (4.12.0):
 * Added a "spider" function that can be activated to generate thumbnails for new images in the gallery without having to browse the gallery.
 * Added support for WebP images (Animated WebP images are not supported).
 * Added WEBP_EXIF option for configuration of EXIF extraction from WebP images.
 * Renamed THUMB_PNG_ALPHA to THUMB_TRANSPARENCY. The option now affect both PNG and WebP images.
 * Added SHOW_IMAGE_NAME_BELOW_FULL option to allow showing the image name below the full size image.
 * Added option to set TEXT_ACTUAL_SIZE to '' to remove the "Actual Size" button.
 * Added shortening of EXIF ExposureTime like 10/10000. Will now be shown as 1/1000.
 * Fixed an issue where the ROTATE_IMAGES option would only function if SHOW_EXIF_INFO was also set to TRUE.
 * Fixed incorrect EXIF rotation for images with orientation 5 and 7.
 * Fixed an issue where the DELETE_EMPTY_DIRS option would only function if GALLERY_ROOT was set to the default './' setting.
 * Other minor fixes, changes and enhancements.


For changes in previous versions see here: https://sye.dk/sfpg/


____________________________________________________________
REQUIREMENTS

For this gallery to function you will need the following:
 * A web server capable of running PHP 7.0, or higher, scripts.
 * The PHP GD library (php_gd) installed. See here for information: https://www.php.net/manual/en/book.image.php
 * PHP write access to server.
 * PHP memory limit large enough to contain both full size image and thumbnail. See the FAQ section for further information on this.


____________________________________________________________
HOW TO USE / QUICK START

The only thing you have to do is place a copy of the index.php file to any directory of your web.
When this is done all images (jpg, jpeg, png, gif, WebP) and files if enabled, in that directory and all sub directories will be shown in the gallery.

By default the script will try to create a directory called "_sfpg_data" in which thumbnails and information is saved. If PHP only have write access in a certain directory, change the DATA_ROOT to point there.


____________________________________________________________
USING A WRAPPER FILE

You can create a wrapper script where you can define only the options you want to change, and include the Single File PHP Gallery script at the bottom. The wrapper script will then behave like Single File PHP Gallery.

Using a wrapper file for sfpg is great:
 * If you want to have a compact view on your changed options.
 * If you want to preserve changed options when upgrading the sfpg script.
 * If you do not want to make changes in the sfpg script file.
 * If you want to keep the sfpg script read-only.
 * If you have multiple galleries - they can then share the same sfpg script.

If you want the wrapper script named index.php, you have to either rename the sfpg script or move it to another place. You can even move the sfpg script outside DOCUMENT_ROOT.

IMPORTANT: In a wrapper file you must use 'define()' instead of 'option()' (as the 'option' function is not yet declared).
IMPORTANT: In a wrapper file the php tag "<?php" must be the very first thing in the wrapper. A blank line above or even a space before the tag will render the script useless.

TIP: Default error reporting in sfpg is set to 0, but it can be overrided in wrapper by defining ERROR_REPORT to needed reporting level.

In the below example wrapper script the sfpg index.php have been renamed to sfpg.php (see the last include in the wrapper).

------ EXAMPLE WRAPPER SCRIPT STARTS BELOW THIS LINE ------
<?php
	// SFPG local configuration
	define('TEXT_GALLERY_NAME', 'Sailing Trip with Bob');
	define('TEXT_BANNER', '<h1>'.TEXT_GALLERY_NAME.'</h1>');
	define('GALLERY_ROOT', '/users/bob_the_user/wwwroot/images/my_pictures/');
	define('DIR_EXCLUDE', ['_sfpg_data', '_sfpg_icons', 'private_images']);
	define('HTML_DESCRIPTIONS', '<h1><h2><p><br><span>');
	@include '/srv/www/tools/sfpg_language_dk.php';   // include local language TEXTs if any
	include '/srv/www/tools/sfpg.php';
?>
------ EXAMPLE WRAPPER SCRIPT ENDS ABOVE THIS LINE ------


____________________________________________________________
TIPS / FAQ

 * If some or all thumbnails are missing or show up as a red X, the reason could be that the full images are too big for the php-engine to load them into memory. You will then have to do one of the following:
     1. Make the full images smaller.
     2. Increase the memory_limit in php.ini. (If the memory_limit is 8MB, it gives a maximum image size on about 1600*1600 pixels).
 * If no thumbnails or images show, it could be that the script does not have the php tag "<?php" as the very first. This tag must come before any other output. A blank line above or even a space before the tag will render the script useless. This can also happen if the auto_prepend_file option in php is used.
 * Single File PHP Gallery does not have to be called index.php, you can rename it to whatever you like.
 * If you have files outside web root that you want to include in the gallery, you can make a symbolic link to the directory. In commandline go to the gallery root and type this command:
     For Windows: mklink /d MyVideos d:\videos\
	 For Linux: ln -s /mnt/usb/videos/ MyVideos
     A symbolic link called MyVideos will be created that will point to the path.
 * If Upload option is not working, check the following PHP settings: file_uploads, upload_max_filesize, max_file_uploads, post_max_size.


____________________________________________________________
KNOWN ISSUES

 * If a thumbnail for a given image exists, it will be used. So remember to delete old thumbnails if you make changes to the way thumbnails are created. If, for an example, you change the size of thumbnails, you will need to delete the old ones already saved, in order to have the changes apply, and have new thumbnails created. This is by design, and will not be fixed.
 * First access to a gallery containing many images or directories, will take a long time to load, because the script have to create thumbnails for all the images. If the script timeout, the rest of the images will be left without thumbnails and information. Then just refresh the page and the script will continue from where it came. The directory where the script stopped might not have a thumbnail. If this is so just click the directory, and the thumbnail will be created. This is by design.
 * Single File PHP Gallery is a stand-alone gallery. It is not designed to be included on existing pages. This is by design.
 * Editing description for images, files or directories using the admin option will remove line breaks from the description file. HTML line breaks made with <br> will of course still be effective when viewing the gallery.


____________________________________________________________
SUPPORT / REQUESTS / HELP / CONTACT

If you need help getting Single File PHP Gallery to work, then please start by running the SFPG TEST script file on the server. The SFPG TEST script is a normal PHP file, you can download it from the Single File PHP Gallery page. The script tests to see if the requirements for the script to run are met, and generates an output explaining what could be the issue. If the output from the script does not provide enough information for you to make the script work, then please use the contact form on the Single File PHP Gallery page. Describe the issue you are having and also copy/paste the information from the SFPG TEST script along with the description.

If you have comments, questions, requests, greetings etc. regarding Single File PHP Gallery, please use the contact form on my page.

  https://sye.dk/


____________________________________________________________
CONFIGURATION INFORMATION

The script can be edited in a plain text editor. Open the index.php and you will find the configuration section at the top of the script.

Refer to the descriptions below for configuration.


____________________________________________________________
option('GALLERY_ROOT', './');

Set the path of the gallery root, where the images and sub directories containing images are placed.
The default value is './' which is the directory where the script is placed.

If GALLERY_ROOT is set to an absolute path and SHOW_FILES is set to TRUE, then a symbolic link called "_sfpg_download" will be created in script directory. This link gives web access to the GALLERY_ROOT, enabling download of files.

IMPORTANT: GALLERY_ROOT should always end with a slash like the examples below.

Example 1: './images/'
Example 2: $_SERVER['DOCUMENT_ROOT'].'/gallery/images/'
Example 3: '/users/bob_the_user/wwwroot/images/my_pictures/'


____________________________________________________________
option('DATA_ROOT', './_sfpg_data/');

Set the path to where thumbnails and other data should be saved. PHP needs to have write access to this directory. If PHP only have write access in a certain directory, change the DATA_ROOT to point there.

By default DATA_ROOT points to a directory called _sfpg_data in the same directory where the script is placed. If the directory do not exists, the script will try to create it. The _sfpg_data directory is by default excluded from the gallery, using the DIR_EXCLUDE option.

IMPORTANT: DATA_ROOT should always end with a slash like these examples:

Example 1: './thumbs/'
Example 2: $_SERVER['DOCUMENT_ROOT'].'/gallery/thumbs/'
Example 3: '/users/bob_the_user/data/sfpg_thumbs/'

SECURITY_PHRASE
One of the files created in the DATA_ROOT is a file called sp.php. It contains the definition of the SECURITY_PHRASE. The SECURITY_PHRASE is used to make the gallery URL's tamper resistant to avoid creative or malicious use.
Creation of the sp.php file and a random SECURITY_PHRASE is handled automatically by the script and you do normally not need to think about this.

You should however know that all links to the gallery containing the sfpg parameter uses this SECURITY_PHRASE. So if the sp.php file is deleted, all previous links to the gallery will end up in the root of the gallery.
Data stored in the DATA_ROOT also uses the SECURITY_PHRASE, so if the sp.php file is deleted or if the SECURITY_PHRASE is changed then all other contents of DATA_ROOT directory must be deleted.

If PHP do not have write access to any useable directory, or if you have a SECURITY_PHRASE from a previous version of the script that you want to use, then follow the guide below and create your own sp.php.

To create the sp.php file manually, do this:

 1. Create the DATA_ROOT directory.
 2. Create a file called "sp.php" in the DATA_ROOT directory.
 3. Edit the sp.php file and copy this one line of code to the file:

<?php if(function_exists('option')) option('SECURITY_PHRASE', ''); ?>

 4. Insert a random string of chars between the last two ''.
 5. Save the file.


____________________________________________________________
option('PASSWORD', '');

Set the password that will give access to the gallery.
Set to '' to not password protect the gallery.

If set to anything but '', the gallery will be protected by password.
The gallery uses PHP sessions when logging in, which require the client to accept cookies. If the client do not accept cookies, the user will be prompted for password over and over again.
Entering a wrong password or not accepting cookies will simply display the login form again. No error is displayed.

IMPORTANT: Setting a password will only restrict access to images and files through the gallery. If someone knows or can guess the path to images or files, they will be able to access them without entering the password.
IMPORTANT: If GALLERY_ROOT is set to an absolute path and SHOW_FILES is set to TRUE, then a symbolic link called "_sfpg_download" will be created in script directory. This link gives web access to the GALLERY_ROOT, enabling download of files.
IMPORTANT: Know that images can, and most likely will, be cached by the browser. So make sure to only access the gallery when using a "Private Window", "Incognito", "InPrivate Browsing" or what ever your browser calls it when not logging and saving anything.
IMPORTANT: Know that unless you are using a HTTPS connection, the entire content of the gallery including the password when you login, text and images are sent unencrypted over the internet.
IMPORTANT: Remember that the password is stored in the gallery script in clear text, so anyone with access to the files on the server, can read it.


____________________________________________________________
option('ADMIN', FALSE);

** WARNING ** SETTING THIS OPTION TO ANYTHING OTHER THAN FALSE WILL ALLOW USERS TO UPLOAD, DELETE, RENAME, MOVE and CREATE DIRECTORIES, IMAGES AND FILES IN THE GALLERY_ROOT **

Set to FALSE to disable the administrator functions.
Set to TRUE to enable users to access the administrator menu.

When enable the following admin options are available:
 1. Upload of files to the gallery.
 2. Rename, move, and delete images and files.
 3. Rename, move, delete and create directories.
 4. Create, edit and remove descriptions for directories, images and files.
 5. Create, edit and remove PayPal selling information for images.
 6. Select custom image to be used as thumbnail for directories.

IMPORTANT: Do not put the gallery unprotected on a public server with this option enabled. (The PASSWORD option can be used to protect the gallery.)
IMPORTANT: Make sure that only administrators have access to the gallery, when this option is enabled (set to TRUE).

INFO: Using these options require PHP to have permission to create, edit and delete in the GALLERY_ROOT.
INFO: Uploading or Moving files to a directory that already contains files with the same name, will overwrite the files without confirmation.
INFO: Deleting a directory will also delete all files and sub directories inside the directory - Keep in mind that there could be files that are not shown in the gallery.
INFO: Deleting, moving or renaming a file will also, if they exists, delete, move or rename the thumbnail (defined by FILE_THUMB_EXT) and the description (defined by DESC_EXT) for the file.
INFO: Deleting, moving or renaming an image will also, if they exists, delete, move or rename the description file (defined by DESC_EXT) and the selling file (defined by PAYPAL_EXTENSION) for the image.


If you want to have a public gallery and also want to allow administrators to login and use the admin functions, the easiest would be to use a wrapper script for the admins. To make an admin wrapper script do this:

 1. Configure the public gallery as you want. Leave the ADMIN option to FALSE, and the PASSWORD option to '', which will make it accessible for public use.
 2. Create a php file, name it as you like and copy the below admin wrapper script to the file.

------ ADMIN WRAPPER SCRIPT STARTS BELOW THIS LINE ------
<?php
	define('PASSWORD', 'Your Password Here');
	define('ADMIN', TRUE);  // WARNING - See description in readme.txt before setting to TRUE
	include 'index.php';
?>
------ ADMIN WRAPPER SCRIPT ENDS ABOVE THIS LINE ------
 
 3. Set a good, secure and unique password in the PASSWORD option in the admin wrapper script.
 4. Place the admin wrapper php file in the same directory as the gallery script.
 5. Now only link to the public gallery on your page. And use the admin wrapper script to login and administer the gallery.


USING THE ADMIN FUNCTIONS:

When this option is set to TRUE, the "Admin" button will be shown in the bottom menu. Click it to enter administrator menu.
While in the administrator menu: Clicking an element (directory, image or file), will select the element (will be highlighted). Clicking a selected elements will deselected the element again.

To upload files or images to the current directory:
 1. Click the "Admin" button.
 2. Click the "Upload" button.
 3. Click the button normally called "Browse" or "Choose Files" (browser dependend).
 4. Select the files you want to upload. (On Windows multiple files can be selected by holding CTRL down).
 5. Click the "Upload" button.

To delete elements from the gallery:
 1. Click the "Admin" button.
 2. Select the elements that should be deleted.
 3. Click "Delete".
 4. Confirm.

To move elements in the gallery:
 1. Click the "Admin" button.
 2. Select the elements that should be moved.
 3. Click "Move" (a tree view of the directories in the GALLERY_ROOT will be shown).
 4. Browse to the directory you want to move the selected elements.
 5. Confirm.

To rename elements from the gallery:
 1. Click the "Admin" button.
 2. Select the element (only one) that should be renamed.
 3. Click "Rename".
 4. Enter new name.
 5. Confirm.

To create a new directory in the current directory:
 1. Click the "Admin" button.
 2. Click "Create Directory".
 3. Enter new directory name.
 4. Confirm.

To set a thumbnail for the current directory:
 1. Click the "Admin" button.
 2. Click the image that should be used as thumbnail for the directory. The chosen image must be of same type as DIR_THUMB_FILE. (A copy of the chosen image will be named as DIR_THUMB_FILE and will used as thumbnail. The chosen image will stay untouched in the gallery).
 3. Click "Dir Thumb".
 4. Confirm.

To remove the thumbnail for the current directory: (Will delete the DIR_THUMB_FILE in current directory. Script will chose a new image to use as thumbnail if any is available):
 1. Click the "Admin" button.
 2. Click "Dir Thumb" (without selecting any images).
 3. Confirm.

To set, remove or edit description for elements in the gallery:
 1. Click the "Admin" button.
 2. Select the element (only one) that should have set, removed or edited description. The current directory is selected by default, if nothing else is selected.
 3. Click "Description".
 4. Set or edit the description and click OK - or - Click "Delete" to remove the description.
 5. Confirm.


____________________________________________________________
option('DIR_NAME_FILE', '_name.txt');

Set the name of the file that can be placed in every directory of the gallery.
If a file with the given name is found, the first line of text from the file will be used instead of the directory name. Directories will still be sorted after the actual name.

IMPORTANT: The file name in this option must end with the extension in DESC_EXT. Default value for DESC_EXT is '.txt'.

TIP 1: This is useful if you would like to use chars that cannot be used in directory names.
TIP 2: See SORT_DIVIDER for an easy way of sorting directories, images and files.


____________________________________________________________
option('DIR_THUMB_FILE', '_image.jpg');

Set the name of the image that can be placed in every directory in the gallery.
If an image with the given name is found, it will be used as thumbnail for that directory. The image will not be displayed inside the directory.

You can also place an image with the given name in the ICONS_DIR, to have it used as thumbnail on all directories that do not have images inside.
To use the ICONS_DIR image as thumbnail on all directories, with or without images inside, set the DIR_THUMB_FROM_ICONS_DIR to TRUE.

TIP 1: This is very useful when having directories with only files of non-supported image types for download.
TIP 2: You do not have to resize the image, it will be resized like all other images in the gallery.


____________________________________________________________
option('DIR_THUMB_FROM_ICONS_DIR', FALSE);

Set to TRUE to have the DIR_THUMB_FILE from the ICONS_DIR used as thumbnail on all directories.
Set to FALSE to let the script follow normal selection for directory thumbnails.

Order for selection of thumbnails for a directories (the first existing image is chosen):
 1. DIR_THUMB_FILE from the directory.
 2. If DIR_THUMB_FROM_ICONS_DIR is set to TRUE: DIR_THUMB_FILE from ICONS_DIR.
 3. First image in the directory.
 4. First DIR_THUMB_FILE or image from subdirectories.
 5. DIR_THUMB_FILE from ICONS_DIR.


____________________________________________________________
option('DIR_DESC_FILE', '_desc.txt');

Set the name of the description file that can be placed in every directory of the gallery (including the GALLERY_ROOT).
If a file with the given name is found, the text will be shown in the gallery. If text includes HTML tags, HTML_DESCRIPTIONS must be set to TRUE.

IMPORTANT: The file name in this option must end with the extension in DESC_EXT. Default value for DESC_EXT is '.txt'.
INFO: See DIR_DESC_IN_GALLERY and DIR_DESC_IN_INFO for placing the description in the gallery.


____________________________________________________________
option('DIR_BANNER_FILE', '_banner.txt');

Set the name of the banner file that can be placed in every directory of the gallery (including the GALLERY_ROOT).
If a file with the given name is found, the text in the file will be shown in the gallery, above the thumbnail boxes. If text includes HTML tags, HTML_DESCRIPTIONS must be set to TRUE.

If the TEXT_BANNER option is defined, and the DIR_BANNER_FILE is found in a directory, only the DIR_BANNER_FILE text is displayed as banner in the gallery.


____________________________________________________________
option('DIR_ROOT_BANNER_IN_SUBDIRS', TRUE);

Set to TRUE to have the DIR_BANNER_FILE, that is placed in the root of the gallery, used as banner in all sub directories.
Set to FALSE to only show the DIR_BANNER_FILE, that is placed in the root of the gallery, when viewing the root directory (also called Home).

INFO: When this is set to TRUE, you can still override the root banner in a sub directory by placing a banner file in a sub directory.


____________________________________________________________
option('DIR_NAME_AS_BANNER', FALSE);

Set to TRUE to have directory names shown as a banner above the thumbnails.
Set to FALSE to not have directory names shown as a banner above the thumbnails.

INFO: Placing a DIR_BANNER_FILE in a directory will override this option. A DIR_BANNER_FILE in the root of the gallery with the DIR_ROOT_BANNER_IN_SUBDIRS set to TRUE will also override this option.


____________________________________________________________
option('DIR_DESC_IN_GALLERY', TRUE);

Set to TRUE to have description shown in the gallery as the first element, using a thumbnail box that is twice as wide as normal thumbnail boxes.
Set to FALSE to not show description in the gallery.


____________________________________________________________
option('DIR_DESC_IN_INFO', TRUE);

Set to TRUE to have description shown in the information panel.
Set to FALSE to not have description shown in the information panel.


____________________________________________________________
option('DIR_SORT_REVERSE', FALSE);

Set to TRUE to sort directories in reverse order (highest to lowest).
Set to FALSE to sort directories in normal order (lowest to highest).

See also DIR_SORT_BY_TIME and SORT_ALL_NATURAL for other sorting options for dirs.


____________________________________________________________
option('DIR_SORT_BY_TIME', FALSE);

Set to TRUE to sort directories by modified time.
Set to FALSE to sort directories by name.

The modified time of a directory is normally updated when changes are made to the contents of the given directory. Even deleting a file or image can make the directory "new". (This might differ from platform to platform).

See also DIR_SORT_REVERSE and SORT_ALL_NATURAL for other sorting options for dirs.


____________________________________________________________
option('DIR_EXCLUDE', ['_sfpg_data', '_sfpg_zip', '_sfpg_icons']);

Set an array of directory names that should not be shown in the gallery.

Directory names should be entered in lower case.
Exclusion is not case sensitive. If you exclude 'oldimages', all the following directories will all be excluded: 'OldImages', 'oldImages', 'OLDIMAGES' and so on.

Example 1: option('DIR_EXCLUDE', ['cgi-bin']);
Example 1: option('DIR_EXCLUDE', ['_sfpg_data', 'include', 'old_images']);

See also DIR_EXCLUDE_REGEX, FILE_EXCLUDE and FILE_EXT_EXCLUDE for other ways of excluding elements from the gallery.


____________________________________________________________
option('DIR_EXCLUDE_REGEX', '');

Use regular expressions to exclude directories from gallery view.
See here for syntax: https://php.net/manual/en/pcre.pattern.php


____________________________________________________________
option('SHOW_IMAGE_EXT', FALSE);

Set to TRUE to show image name extensions.
Set to FALSE to not show image name extensions.


____________________________________________________________
option('SHOW_IMAGE_NAME_BELOW_FULL', FALSE);

Set to TRUE to show the image name below the full size image.
Set to FALSE to not the show image name below the full size image.


____________________________________________________________
option('IMAGE_SORT_REVERSE', FALSE);

Set to TRUE to sort images in reverse order (highest to lowest).
Set to FALSE to sort images in normal order (lowest to highest).

See also IMAGE_SORT_BY_TIME, SORT_ALL_NATURAL and IMAGE_EXIF_TIME for other sorting options for images.


____________________________________________________________
option('IMAGE_SORT_BY_TIME', FALSE);

Set to TRUE to sort images by modified time.
Set to FALSE to sort images by name.

See also IMAGE_SORT_REVERSE, SORT_ALL_NATURAL and IMAGE_EXIF_TIME for other sorting options for images.


____________________________________________________________
option('IMAGE_EXIF_TIME', FALSE);

Set to TRUE to have images sorted by time found in EXIF, when sorting images by time.
Set to FALSE to use filetime when sorting images by time.

The EXIF information, including EXIF time, is extracted when the thumbnails are generated, so sorting images by EXIF time will first be effective from second view of the gallery.


____________________________________________________________
option('ROTATE_IMAGES', TRUE);

Set to TRUE to have images rotated according to the orientation information in EXIF.
Set to FALSE to not rotate images.

Rotated images are saved on the server in the DATA_ROOT. This could take up a lot of disk space.
If images have been saved on server you will have to delete them in order to have changes to this option apply.
Rotating images will require twice the amount of memory, than that for generating thumbs.


____________________________________________________________
option('IMAGE_JPEG_QUALITY', 90);

Set the quality for jpeg images. Range from 0 (worst quality and smallest file size) to 100 (best quality and largest file size).
If images have been saved on server you will have to delete them in order to have changes to this option apply.
This setting is used for full size images. These are saved on server after being rotated or watermark have been added.


____________________________________________________________
option('IMAGE_EXCLUDE_REGEX', '');

Use regular expressions to exclude images from gallery view.
See here for syntax: https://php.net/manual/en/pcre.pattern.php


____________________________________________________________
option('SHOW_FILES', TRUE);

Set to TRUE to show non-image files and images of non-supported types as download links in the gallery.
Set to FALSE to only show images of supported types in the gallery.

If GALLERY_ROOT is set to an absolute path and SHOW_FILES is set to TRUE, then a symbolic link called "_sfpg_download" will be created in script directory. This link gives web access to the GALLERY_ROOT, enabling download of files.
If PHP do not have write access to script directory, this link can't be created and you will get a message saying "Unable to access file." when trying to download a file. To fix this create the "_sfpg_download" link manually, like this:

For Windows:
 1. In a Command Prompt go to the script directory.
 2. Run this command (insert the path from your GALLERY_ROOT except the last / instead of X): mklink /d _sfpg_download "X"

For Linux:
 1. In a Terminal go to the script directory.
 2. Run this command (insert the path from your GALLERY_ROOT except the last / instead of X): ln -s "X" _sfpg_download

TIP: Use FILE_EXCLUDE, FILE_EXT_EXCLUDE and FILE_EXCLUDE_REGEX to exclude files you do not want to have displayed.


____________________________________________________________
option('SHOW_FILE_EXT', TRUE);

Set to TRUE to show file name extensions.
Set to FALSE to not show file name extensions.


____________________________________________________________
option('FILE_IN_NEW_WINDOW', TRUE);

Set to TRUE to have files open in a new window.
Set to FALSE to have files open in the same window.


____________________________________________________________
option('FILE_THUMB_EXT', '.jpg');

Set the extension of file thumbnail files. Place an image with the same name as a file with the set extension added to the file name, to have the image used as a thumbnail for the file. The image will be resized like any other thumbnail in the gallery.

INFO 1: Can be set to any of the supported image types.
INFO 2: Case sensitivity in this option follows the case sensitivity of the server on which the script runs.
INFO 3: Extensions should be entered with a dot in front, like the default and the example below.

Example: If set to '.jpg' and one of the files is named 'In_The_Snow.mp4'. You can then make an image called 'In_The_Snow.mp4.jpg', and place it in the same directory as the image.


____________________________________________________________
option('FILE_THUMB_DEFAULT', '');

Set the name of the file that will be used as thumbnail for files that do not have a thumbnail file of its own, and which extension do not match any of the files in the ICONS_DIR.
The FILE_THUMB_DEFAULT image have to be placed in the ICONS_DIR. 


____________________________________________________________
option('FILE_SORT_REVERSE', FALSE);

Set to TRUE to sort files in reverse order (highest to lowest).
Set to FALSE to sort files in normal order (lowest to highest).

See also FILE_SORT_BY_TIME and SORT_ALL_NATURAL for other sorting options for files.


____________________________________________________________
option('FILE_SORT_BY_TIME', FALSE);

Set to TRUE to sort files by modified time.
Set to FALSE to sort files by name.

See also FILE_SORT_REVERSE and SORT_ALL_NATURAL for other sorting options for files.


____________________________________________________________
option('FILE_EXCLUDE', ['_sfpg_zip']);

Set an array of file names that should not be shown in the gallery.

INFO 1: File names should be entered in lower case.
INFO 2: Exclusions works only on non-supported file types.
INFO 3: Exclusion is not case sensitive. If you exclude "readme.txt", all the following files will be excluded: "readme.txt", "ReadMe.Txt","README.TXT" and so on.

Example 1: option('FILE_EXCLUDE', ['readme.txt']);
Example 2: option('FILE_EXCLUDE', ['readme.txt', 'admin.php', 'style.css']);

See also FILE_EXT_EXCLUDE, FILE_EXCLUDE_REGEX and DIR_EXCLUDE for other ways of excluding elements from the gallery.


____________________________________________________________
option('FILE_EXT_EXCLUDE', ['.php', '.txt', '.sell']);

Set an array of file extensions for files that should not be shown in the gallery.

INFO 1: Extensions should be entered in lower case with a dot in front, like the examples below.
INFO 2: Exclusions works only on non-supported file types. You cannot exclude the supported image types.
INFO 3: Exclusion is not case sensitive. If you exclude ".txt", all files with the following extensions will be excluded: ".txt", ".Txt", ".TXT" and so on.

The default exclusions are there because:
'.php' to not show the gallery it self, or other php files.
'.txt' to not show text files, as they by default are used for description.
'.sell' to not show the PayPal sell files. See PayPal options for more information on that.

Example 1: option('FILE_EXT_EXCLUDE', ['.php']);
Example 2: option('FILE_EXT_EXCLUDE', ['.php', '.txt', '.inc', '.html']);

Also see FILE_EXCLUDE, FILE_EXCLUDE_REGEX, DIR_EXCLUDE and DIR_EXCLUDE_REGEX for other ways of excluding elements from the gallery.


____________________________________________________________
option('FILE_EXCLUDE_REGEX', '');

Use regular expressions to exclude files from gallery view.
See here for syntax: https://php.net/manual/en/pcre.pattern.php

Example for excluding all files starting with a dot: option('FILE_EXCLUDE_REGEX', '/^[.]/');

____________________________________________________________
option('ICONS_DIR', '_sfpg_icons/');

Set the name of the directory where images to be used as thumbs for file types can be placed. If changed remember to also change the DIR_EXCLUDE option to not show it inside the gallery.
The directory must be placed inside the GALLERY_ROOT. The directory needs to end with a slash, like the default one: '_sfpg_icons/'.

The files in this directory must be the type defined by the option FILE_THUMB_EXT, by default: '.jpg'.
The name of the files should be the name of the extensions that they should be used for.
For an example if a file named "iso.jpg" is placed in this directory, all files ending with .iso will be given this image as thumbnail.

INFO: All images in ICONS_DIR should be entered in lower case, like the example above.
INFO: This option is optional. If not used, the directory does not need to exist.


____________________________________________________________
option('LINK_BACK', '');

Set an URL to show a button that will function as a link to the set URL. This can be used as a "Back to my site" button.
Set to '' to not show the button.

Example 1: Set to '/' to have button take you to the root of your web.
Example 2: Set to 'https://www.yoursite.com/page.html'.

See TEXT_LINK_BACK for the text on the button.


____________________________________________________________
option('CHARSET', 'utf-8');

Set the charset to be used. In order to have special chars display correctly, a charset that support the chars used in the gallery, must be set.

Below is a short list of charsets that can be used (use a search engine on the internet for others):

Universal Alphabet:        'utf-8'
Western Alphabet:          'iso-8859-1'
Central European Alphabet: 'iso-8859-2'
Latin 3 Alphabet:          'iso-8859-3'
Baltic Alphabet:           'iso-8859-4'
Cyrillic Alphabet:         'iso-8859-5'
Arabic Alphabet:           'iso-8859-6'
Greek Alphabet:            'iso-8859-7'
Hebrew Alphabet:           'iso-8859-8'
Japanese:                  'shift-jis'
Chinese Traditional:       'big5'


____________________________________________________________
option('DATE_FORMAT', 'Day Date Month Year Hour:Min:Sec');

Set the format of the date/time to be used in the gallery.
The following variables can be used:

Day      : Day name. Shown as: Mon, Tue, Wed, Thu, Fri, Sat, Sun
Date     : Day number. Shown as: 1-31
Month    : Month name. Shown as: Jan, Feb, Mar...
Nrmonth  : Month number. Shown as: 1-12
Year     : Year. Shown as: 1960-
Hour     : Hours. Shown as: 00-23
Min      : Minutes. Shown as: 00-59
Sec      : Seconds. Shown as: 00-59


____________________________________________________________
option('DESC_EXT', '.txt');

Set the extension of the description files. Place a file with the same name as an image or file with the set extension added to the image name, to have the text shown with the image or file.

Case sensitivity in this option follows the case sensitivity of the server on which the script runs.
Extensions should be entered with a dot in front, like the example below.

Example: If set to '.txt' and one of the images is named
         "IMG_10a.jpg". You can then make a file called
         "IMG_10a.jpg.txt", and place it in the same directory as the image.

If SHOW_FILES is set to TRUE you can use FILE_EXT_EXCLUDE to exclude the description files from the view. So if you would like to list .txt but don't want the descriptions files shown, you should set to any other extension that you do not use (feel free to use ".sfpg") and exclude that one using FILE_EXT_EXCLUDE.
	 

____________________________________________________________
option('HTML_DESCRIPTIONS', FALSE);

WARNING: Setting this option to anything but FALSE could allow malicious scripts embedded in images and from description files to be executed in end user browser.
IMPORTANT: If files from untrusted sources are in the gallery, this option should be set to FALSE.

This setting have effect on contents from the following files: DIR_NAME_FILE, DIR_DESC_FILE, DIR_BANNER_FILE and description files for images and files defined by DESC_EXT.

Set to TRUE to allow all HTML from the above files.
Set to FALSE to block all HTML from the above files.
Set to a string of allowed HTML tags. HTML tags not listed will be stripped.
Set to an array of allowed HTML tags. HTML tags not listed will be stripped.

Example string configuration: option('HTML_DESCRIPTIONS', '<a><br><p>');
Example array configuration: option('HTML_DESCRIPTIONS', ['a', 'br', 'p']);

The two above examples will allow only <a>, <br> and <p> HTML tags. All other HTML tags will be stripped. Using the array option will require minimum PHP 7.4.


____________________________________________________________
option('DESC_NL_TO_BR', FALSE);

Set to TRUE to have line breaks in description files translated to the HTML <br> tag, to act as a line break in the browser.
Set to FALSE to ignore line breaks in description files. To make a line break with this setting, simply add <br> at the end of each line in the description file. HTML_DESCRIPTIONS must then also be configured.


____________________________________________________________
option('SORT_DIVIDER', '--');

Set the string that will function as a divider between the part of the name to sort after and the name to be shown.
SORT_DIVIDER works on directories, images and files.

Example: If you have a directory called "Apples" and one called "Bananas", and would like "Bananas" to be the first one on the list. You could then call them: "001--Bananas" and "002--Apples". The directories will then be listed in the order you like, and only the text after the SORT_DIVIDER string will be shown.


____________________________________________________________
option('SORT_ALL_NATURAL', TRUE);

Set to TRUE to have directories, images and files sorted in a case insensitive "natural order".
Set to FALSE to have elements sorted normally.

See here for information: https://php.net/natcasesort


____________________________________________________________
option('FONT_SIZE', 12);

Set the Font size.

If changing this option, then you should probably also have a look at MENU_BOX_HEIGHT and NAV_BAR_HEIGHT.


____________________________________________________________
option('UNDERSCORE_AS_SPACE', TRUE);

Set to TRUE to have underscores in names shown as spaces.
Set to FALSE to have names shown as is.

Works on directory, image and file names.


____________________________________________________________
option('SHOW_EXIF_INFO', TRUE);

Set to TRUE to have the script extract and show EXIF information like Camera Model, Shutter Speed and Focal Length.
Set to FALSE to not extract and show EXIF information.

INFO: The extraction of information is done when the thumbnail is generated. So changing from FALSE to TRUE requires you to delete the contents of the DATA_ROOT, to have new thumbnails generated.


____________________________________________________________
option('SHOW_IPTC_INFO', TRUE);

Set to TRUE to have the script extract and show IPTC information like Category, Title and Copyright.
Set to FALSE to not extract and show IPTC information.

INFO: The extraction of information is done when the thumbnail is generated. So changing from FALSE to TRUE requires you to delete the contents of the DATA_ROOT, to have new thumbnails generated.


____________________________________________________________
option('PNG_TEXT_CHUNKS', TRUE);

Option to extract and show PNG text chunks in the gallery information panel. Only "tEXt" is extracted. "iTXt" and "zTXt" is not extracted.

Set to TRUE to extract and show all PNG text chunks.
Set to an array of selected PNG text chunks to extract and show.
Set to FALSE to not extract or show PNG text chunks.

INFO 1: When setting to an array, all keywords should be entered in lower case.
INFO 2: The extraction of information is done when the thumbnail is generated. So changing what is extracted requires you to delete the contents of the DATA_ROOT, to have new thumbnails generated.

Example array configuration: option('PNG_TEXT_CHUNKS', ['title', 'author', 'description']);


____________________________________________________________
option('SPIDER_PASSWORD', '');

This option can be used to have the gallery script generate thumbnails for new images in the gallery without having to browse the gallery.
This can lower the waiting time when entering a directory containing many new and/or large images.

To activate the spider function:

 1. Set a password in the SPIDER_PASSWORD option.

 2. In the gallery, click the directory where you want the spider to start. Thumbnails for all new images in this directory and all subdirectories will be generated.
    If you want it to generate thumbnails for the entire gallery, then click the "Home" link in the bottom of the gallery.
	You should now have an URL in your browser containig the long sfpg= parameter, which is needed.

 3. Add this string to the end of the URL (where xxx is the SPIDER_PASSWORD that you have set): &spider=xxx

An example from my demo gallery. This is the URL I get when I click the "Home":
https://sye.dk/sfpg/demo/index.php?sfpg=Kio0YWYzNzViZWY3NDMzYWIyN2UzOGZjOTQ2YzE5NTc5Y2ZlNzM5NzI4MzQxYjMyNjYxNzM3MGM1ZDhiNGE4OGRi&info=0
To activate the spider on my gallery, I set the SPIDER_PASSWORD and add &spider=xxx to the end of the URL, like this:
https://sye.dk/sfpg/demo/index.php?sfpg=Kio0YWYzNzViZWY3NDMzYWIyN2UzOGZjOTQ2YzE5NTc5Y2ZlNzM5NzI4MzQxYjMyNjYxNzM3MGM1ZDhiNGE4OGRi&info=0&spider=xxx

No output will be sent before the spider have finished. So if there are many new images and the spider request times out, nothing will be returned.
You can then call the same URL again, to have the spider continue from where it ended.
When the spider finishes this string will be returned: spider_done

You can schedule a job to run, where wget is used to trigger the spider function, like this:
wget -qO- "https://sye.dk/sfpg/demo/index.php?sfpg=Kio0YWYzNzViZWY3NDMzYWIyN2UzOGZjOTQ2YzE5NTc5Y2ZlNzM5NzI4MzQxYjMyNjYxNzM3MGM1ZDhiNGE4OGRi&info=0&spider=xxx"

You could then have a script check the output, and if the output is not spider_done, then call wget again.


____________________________________________________________
option('WEBP_EXIF', [
	'COMPUTED'=>['ApertureFNumber', 'UserComment'],
	'IFD0'=>['Make', 'Model'],
	'EXIF'=>['ExposureTime', 'FNumber', 'ISOSpeedRatings', 'DateTimeOriginal', 'FocalLength']
]);

Set to an array of arrays of EXIF information to extract from WebP images. See examples below.
Set to FALSE to not extract EXIF information from WebP images.

Configuration Tool:
Configuring this option manually can be quite difficult, as it require knowledge about where in the EXIF part of the WebP image the wanted information is stored.
I have made a tool called "SFPG WebP EXIF Configuration Tool", to make configuring this option easier.
SFPG WebP EXIF Configuration Tool takes a WebP image as input. It will show a list of the EXIF elements found in the image. You can then simply mark the wanted information and have the tool generate the configuration.
You can find the tool for download on the SFPG page.

INFO: This option is case sensitive.

Example setting for disabling WebP EXIF extraction:
	option('WEBP_EXIF', FALSE);

Example setting for extracting only UserComment from the COMPUTED section:
	option('WEBP_EXIF',['COMPUTED'=>['UserComment']]);

Example setting for extracting different information from different sections:
	option('WEBP_EXIF', [
		'COMPUTED'=>['ApertureFNumber', 'UserComment'],
		'IFD0'=>['Make', 'Model'],
		'EXIF'=>['ExposureTime', 'FNumber', 'ISOSpeedRatings', 'DateTimeOriginal', 'FocalLength']
	]);


____________________________________________________________
option('SHOW_INFO_BY_DEFAULT', FALSE);

Set to TRUE to have the gallery open the Information panel by default, the user can still click the Information button to hide the panel.
Set to FALSE to have the gallery wait for the user to click the Information button, before showing the Information panel.


____________________________________________________________
option('ROUND_CORNERS', 3);

Set the number of pixels that the corners should be rounded with. A higher number will make the corners more round.
Set to FALSE to not have rounded corners.


____________________________________________________________
option('ZIP_ENABLE', FALSE);

Set to TRUE to enable generation and download of zip files.

When enabled a zip button will be shown in the information panel.
By default only images from the current directory will be included in the zip file. See other zip options below.

Generated zip files are saved in DATA_ROOT/zip/ for when the same zip file is requested again.
To determine if a new zip file should be created, the gallery only looks at the list of elements in the zip file, not the contents of the files.
So editing a file will not generate a new zip file. But changing the name of a file will. Adding, deleting or moving files in the gallery will also generate a new zip file.

A symbolic link "_sfpg_zip" will be created where the script is run from, giving access to the zip files.
The "_sfpg_zip" is excluded in both DIR_EXCLUDE and FILE_EXCLUDE, as on Windows a symbolic link is seen as a directory and on Linux as a file.

Cached zip files for a directory will be deleted if the source directory is deleted, moved or renamed. See the IMPORTANT INFORMATION section about the clean-up function.


____________________________________________________________
option('ZIP_FILES', FALSE);

Set to TRUE to include files in the zip files.
Set to FALSE to not include files in the zip files.

INFO: If changing this option, remember to also change the TEXT_ZIP_DL accordingly.


____________________________________________________________
option('ZIP_FILE_THUMBS', FALSE);

Set to TRUE to include thumbnails for files in zip files.
Set to FALSE to not include thumbnails for files in zip files.


____________________________________________________________
option('ZIP_SUB_GALLERIES', FALSE);

WARNING: Setting this to TRUE will allow users to zip the entire gallery in one click. Depending of the amount of contents in the gallery this could use a lot of CPU and disk space.

Set to TRUE to include sub galleries (sub directories) in zip files.
Set to FALSE to not include sub galleries (sub directories) in zip files.

INFO: If changing this option, remember to also change the TEXT_ZIP_DL accordingly.


____________________________________________________________
option('ZIP_DESCRIPTIONS', FALSE);

Set to TRUE to include description files in zip files.
Set to FALSE to not include description files in zip files.

Description files include the following:
 * Description files for images, files and directories.
 * Banner files defined by DIR_BANNER_FILE.
 * Directory name files defined by DIR_NAME_FILE.
 * PayPal sell files defined by PAYPAL_EXTENSION.


____________________________________________________________
option('ZIP_COMPRESSION', FALSE);

Set to TRUE to compress zip files. It will take longer time and use more CPU to generate the zip files, but the zip files will be smaller.
Set to FALSE to store (no compression). It will generate zip files faster and uses less CPU, but will generates larger zip files.

INFO: JPG/JPEG images do not compress very much. So if used mainly for these file types, then it is best to set this option to FALSE.


____________________________________________________________
option('ZIP_CACHE_DAYS', 180);

Set number of days to cache zip files.
Set to FALSE to not delete zip files due to age.

IMPORTANT: Do not set this option below 1 (one), as it could result in zip files being deleted before they are downloaded.

Deletion of zip files older than the set number of days are activated when new zip files are requested.


____________________________________________________________
option('TEXT_ZIP_ROOT_NAME', 'Single File PHP Gallery');

Set the name of the zip file if downloaded at root of gallery.

All other zip files will be named like the directory from where they are downloaded.


____________________________________________________________
option('TEXT_ZIP_NOTHING', 'Nothing to zip.');

Set the text that is shown if the zip button is pressed and no images or files are found.

If no images or files are found matching zip configuration this text is shown.


____________________________________________________________
option('TEXT_ZIP_DL', 'Download all images in this directory as a zip file:');

Set the text that is shown above the zip button in the information panel.

If allowing download of only images, set to: 'Download all images in this directory as a zip file:'
If allowing download of images and files set to: 'Download all images and files in this directory as a zip file:'
If allowing download of images in subdirectories set to: 'Download all images in this directory and all subdirectories as a zip file:'
If allowing download of images and files in subdirectories set to: 'Download all images and files in this directory and all subdirectories as a zip file:'


____________________________________________________________
option('TEXT_ZIP_BUTTON', 'Generate zip-file and download');

Set the text on the zip button.

The button is shown in the information panel.


____________________________________________________________
option('TEXT_ZIP_WAIT', 'Zip is being generated. Please wait...');

Set the text that replaces the zip button when clicked.


____________________________________________________________
option('THUMB_MAX_WIDTH', 200);

Set the maximum number of pixels a thumbnails width may be.
If thumbnails have been saved on server you will have to delete them in order to have changes to this option apply.


____________________________________________________________
option('THUMB_MAX_HEIGHT', 150);

Set the maximum number of pixels a thumbnails height may be.
If thumbnails have been saved on server you will have to delete them in order to have changes to this option apply.


____________________________________________________________
option('THUMB_SQUARE', FALSE);

Set to TRUE to have thumbnails cropped to a square.
Set to FALSE to have thumbnails maintain aspect ratio.

When setting this option to TRUE, then THUMB_MAX_WIDTH and THUMB_MAX_HEIGHT should be set to the same number.


____________________________________________________________
option('THUMB_ENLARGE', FALSE);

Set to TRUE to have thumbnails for images that is smaller than THUMB_MAX_WIDTH and THUMB_MAX_HEIGHT enlarged.
Set to FALSE to have thumbnails for images that are smaller than THUMB_MAX_WIDTH and THUMB_MAX_HEIGHT stay the size they are.


____________________________________________________________
option('THUMB_JPEG_QUALITY', 75);

Set the quality for jpeg thumbnails. Range from 0 (worst quality and smallest file size) to 100 (best quality and largest file size).
If thumbnails have been saved on server you will have to delete them in order to have changes to this option apply.


____________________________________________________________
option('THUMB_TRANSPARENCY', TRUE);

Set to TRUE to preserve transparency (alpha channel) for PNG and WebP thumbnails.
Set to FALSE to not preserve transparency (alpha channel) for PNG and WebP thumbnails.


____________________________________________________________
option('WATERMARK', '');

Set the filename of the image that is to be used as watermark on all images in gallery.
This will make all images and thumbnails contain the watermark in the lower right corner of the image.

To use this option you must:
 1. Create a directory named like set in the ICONS_DIR option (by default named "_sfpg_icons" and placed in the GALLERY_ROOT).
 2. Place the image that is to be used as watermark in the directory.
 3. Add the name of the image to the WATERMARK option.

Example: option('WATERMARK', 'watermark.png');

In the example above, an image called "watermark.png" have been created and placed in the "_sfpg_icons" directory in the GALLERY_ROOT.

INFO 1: If set, all images containing watermark will be cached in the DATA_ROOT.
INFO 2: If set or changed after images or thumbnails have been created, then all thumbnails need to be deleted from the DATA_ROOT in order to have new images including watermark created.
INFO 3: Case sensitivity in this option follows the case sensitivity of the server on which the script runs.
INFO 4: Depending on the set IMAGE_JPEG_QUALITY, this could take up the same or more space than the original images in GALLERY_ROOT.
INFO 5: Generating the full size image with watermark will require about twice the memory than when generating the thumbnail.

The watermark image will be resized using the WATERMARK_FRACTION option.


____________________________________________________________
option('WATERMARK_FRACTION', 0.1);

Set the fraction for how large the watermark should be compared to the full image. When setting the watermark size, the shortest side of the full image is used.
Set to FALSE to always have the watermark applied as is, in its actual size.

The default value 0.1 is 10%. With this setting and with a full size image that is 1600*1200 pixels, the watermark will set to have a height of 120 pixels (the width is scaled to maintain the aspect ratio).


____________________________________________________________
option('LOW_IMAGE_RESAMPLE_QUALITY', FALSE);

Set to TRUE to have the script use a less CPU demanding function to generate thumbnails. This will make thumbs generate much faster, but will make them grainy looking.
Set to FALSE to use a function generating high quality thumbs.

INFO: Thumbs are saved on server, so they only needs to be generated once.


____________________________________________________________
option('KEYBOARD_NAVIGATION', TRUE);

Set to TRUE to enable gallery navigation using the keyboard.
Set to FALSE to not enable gallery navigation using the keyboard.

Change to the next picture: Arrow Down, Arrow Right, Page Down, Space.
Change to the previous picture: Arrow Up, Arrow Left, Page Up.
While showing an image ESC can be used to close image view. While viewing thumbs ESC can be used to go one directory up/out.
Open and close the Information panel: i.


____________________________________________________________
option('MPO_STEREO_IMAGE', TRUE);

Set to TRUE to have the script extract images from .mpo files and make a stereo preview of the 3D image.
Set to FALSE to treat .mpo files as just files.

INFO: To actually treat .mpo files as just files, the MPO_FULL_IMAGE option must also be set to FALSE.


____________________________________________________________
option('MPO_STEREO_DOTS', TRUE);


Set to TRUE to add a white dot above the middle of stereo image for easier viewing.
Set to FALSE to not add anything to the stereo image.

INFO: This option only have effect if MPO_STEREO_IMAGE is also set to TRUE.


____________________________________________________________
option('MPO_STEREO_MAX_WIDTH', 300);

Set the max width in pixels of each of the stereo images.


____________________________________________________________
option('MPO_STEREO_MAX_HEIGHT', 300);

Set the max height in pixels of each of the stereo images.


____________________________________________________________
option('MPO_FULL_IMAGE', TRUE);

Set to TRUE to have the script extract images from .mpo files and make a 2D or 3D anaglyph preview.
Set to FALSE to treat .mpo files as just files.

INFO: To actually treat .mpo files as just files, the MPO_STEREO_IMAGE option must also be set to FALSE.


____________________________________________________________
option('MPO_FULL_ANAGLYPH', TRUE);

Set to TRUE to have the script extract images from .mpo files and generate a red/cyan Anaglyph image.
Set to FALSE to show MPO_FULL_IMAGE as normal 2D.

INFO: This option only have effect if also MPO_FULL_IMAGE is set to TRUE.


____________________________________________________________
option('MPO_FULL_MAX_WIDTH', 1200);

Set the max width in pixels of the full .mpo image.


____________________________________________________________
option('MPO_FULL_MAX_HEIGHT', 800);

Set the max height in pixels of the full .mpo image.


____________________________________________________________
option('MPO_SPACING', 20);

Set the width in pixels of the space added between the stereo images and the full image.


____________________________________________________________
option('INFO_BOX_WIDTH', 250);

Set the width in pixels of the information panel. If thumbnail size is increased, this probably also needs to be increased.


____________________________________________________________
option('MENU_BOX_HEIGHT', 70);

Set the height in pixels of the menu box. If FONT_SIZE is increased, this probably also needs to be increased.


____________________________________________________________
option('NAV_BAR_HEIGHT', 25);

Set the height in pixels of the navigation bar. If FONT_SIZE is increased, this probably also needs to be increased.


____________________________________________________________
option('THUMB_BORDER_WIDTH', 1);

Set the number of pixels for the thumbnail border width.


____________________________________________________________
option('THUMB_MARGIN', 10);

Set the number of pixels that the thumbnail box should be larger than the thumbnail all the way round.


____________________________________________________________
option('THUMB_BOX_MARGIN', 7);

Set the number of pixels the thumbnail boxes margin should be. The thumbnail boxes will be two times the set number apart.


____________________________________________________________
option('THUMB_BOX_EXTRA_HEIGHT', 14);

Set the number of pixels that will be added to the thumbnail boxes height. This would normally be a little larger than the set FONT_SIZE. So if the FONT_SIZE is increased, this probably also needs to be increased.
If THUMB_CHARS_MAX is set to 0, to not show thumbnail names, this should also be set to 0.


____________________________________________________________
option('THUMB_CHARS_MAX', 20);

Set the maximum number of chars that will be printed below thumbnails.
Set to 0 to not show thumbnail names. If set to 0 THUMB_BOX_EXTRA_HEIGHT should also be set to 0.


____________________________________________________________
option('FULLIMG_BORDER_WIDTH', 5);

Set the number of pixels for the border width of the full image.


____________________________________________________________
option('NAVI_CHARS_MAX', 100);

Set the maximum number of chars that will be printed in the navigation bar. When the navigation path gets longer than the set number, then the first links/buttons will be replaced with "..."


____________________________________________________________
option('OVERLAY_OPACITY', 0.9);

Set the opacity for the overlaying layer that hides the thumbnails when a full image is shown.
Set to 0 to have the layer be invisible.
Set to 0.5 to have the layer half transparent.
Set to 1 to have a solid color.


____________________________________________________________
option('SLIDESHOW_DELAY_SEC', 5);

Set the number of seconds between each image in the slideshow. The next image will load in the background while the current is showing. The gallery will only change to the next image when both the time have gone, and the next image are fully loaded. So if the images are large and/or the client connection slow, then images may be displayed longer than the set value.
To disable the slideshow option, simply remove the text from the TEXT_SLIDESHOW option.


____________________________________________________________
option('SHOW_MAX_IMAGES', FALSE);

Set the maximum number of images to be shown in the gallery. If set to 50, only the first 50 images will be shown in the gallery.
Set to FALSE to show all images.

INFO: This option will only limit the number of images. All directories and files are always shown.
INFO: Directory information will always show the actual number of images in the directory.
TIP: Remember to set sorting to show the images that you want listed first.


____________________________________________________________
option('SHOW_IMAGE_DAYS', FALSE);

This option will limit the images being shown in the gallery to only include images that are no older than the set value. If set to 30, only images from the last 30 days will be shown in the gallery.
Set to FALSE to show all images.

INFO: The date being used for this option is the file time, which is not necessary the same as when the image was taken.
INFO: Directory information will always show the actual number of images in the directory.
INFO: This option will only limit the number of images. All directories and files are always shown.


____________________________________________________________
option('DELETE_IMAGE_DAYS', FALSE);

** WARNING ** SETTING THIS OPTION TO ANYTHING OTHER THAN FALSE WILL DELETE IMAGES IN THE GALLERY_ROOT **

This option will delete images that are older than the set value. If set to 90, all images older than 90 days, will be deleted from the GALLERY_ROOT.
Set to FALSE to never delete images.

If using this option, make sure to always have a backup of the images. Changing the server date, for instance, can cause images to be deleted.

INFO: Using this option require PHP to have permission to delete in the GALLERY_ROOT.
INFO: The date being used for this option is the file time, which is not necessary the same as when the image was taken.
INFO: This option will only delete images. Directories and files are never deleted.


____________________________________________________________
option('DELETE_EMPTY_DIRS', FALSE);

** WARNING ** SETTING THIS OPTION TO ANYTHING OTHER THAN FALSE WILL MAKE THE GALLERY DELETE EMPTY DIRECTORIES IN THE GALLERY_ROOT **

Set to TRUE to have the gallery delete empty directories.
Set to FALSE to have the gallery leave empty directories as is.

WARNING: A directory not containing directories, images or files, that is to be shown in the gallery is considered empty. This means that a directory containing banner, description, hidden files or hidden directories, will still be considered empty, and will be deleted if the option is set to TRUE.

Information about what is inside a directory is updated when entering the directory. So if all content have been deleted in a directory, you will have to enter the directory to update the information. First then will the directory be deleted.
Empty directories are deleted when they are about to be listed as an element in the gallery.


____________________________________________________________
option('RELOAD_IMAGE_MIN', 5000);

Set the minimum wait in milliseconds before a reload of the image/thumb is activated.

Some servers have configurations that limit the number of calls they can accept within a given period. This may affect the functionality of loading thumbnails. Additionally, connection or performance issues could also prevent thumbnails from loading.
If a thumbnail fails to load, a reload attempt will trigger at a random time between the specified number of milliseconds set in RELOAD_IMAGE_MIN and RELOAD_IMAGE_MAX.


____________________________________________________________
option('RELOAD_IMAGE_MAX', 10000);

Set the maximum wait time in milliseconds before a thumbnail reload is triggered.

Some servers have configurations that limit the number of calls they can accept within a given period. This may affect the functionality of loading thumbnails. Additionally, connection or performance issues could also prevent thumbnails from loading.
If a thumbnail fails to load, a reload attempt will trigger at a random time between the specified number of milliseconds set in RELOAD_IMAGE_MIN and RELOAD_IMAGE_MAX.


____________________________________________________________
option('PAYPAL_ENABLED', FALSE);

Set to TRUE to enable selling items in the gallery using PayPal.
Set to FALSE to disable PayPal selling.

Using the PayPal option:
If you have an item you want to sell, you first need to have an image of it, as only images can have a price. Files and directories in the gallery can't have a price.

To enable selling first set PAYPAL_ENABLED to TRUE, and fill in an account in PAYPAL_ACCOUNT, then either use the administrator option to set the price, or do it manually.

Using the administrator option to sell an item (See ADMIN option for information on activating this):
 1. Click the "Admin" button.
 2. Click the image (only one) that should be set for sale.
 3. Click the "Sales information" button.
 4. Fill in price, select Available or Sold, and optionally fill in the item identifier.
 5. Click OK.

To manually set an image up for sale:
Lets say you have an image called 'My first painting.jpg'. You then have to make a .sell file, which is a text file with the same name as the image with the PAYPAL_EXTENSION added.
By default the PAYPAL_EXTENSION is '.sell'. Making the two files look like this:

My first painting.jpg
My first painting.jpg.sell

In the 'My first painting.jpg.sell' file there should be two or three lines (the third line is optional), like this:

------ FILE CONTENT STARTS BELOW THIS LINE ------
19.95
1
Paint001
------ FILE CONTENT ENDS ABOVE THIS LINE ------

The first line '19.95' is the price for the item. You can set the currency you use in PayPal in PAYPAL_CURRENCY. Default is USD.
The second line is the items status, it should be either '1' for Available or '0' for Sold.
The third line is optional. In this example 'Paint001' is a unique identifier you can use to keep track of your inventory. It will be written in the information from PayPal when a sell is completed. If the third line is omitted the path and image name is put in its place. Just keep in mind that the path and image together, may not be longer than 127 chars(a limit set by PayPal).

When image and .sell file is placed in the gallery, the price, status and unique item identifier will be shown in the information panel when you hover the mouse over the thumb, and also when the image is shown in full.

Buying an item:
As long as the status on the item is Available (1), the 'Buy this item' button (shown in information panel) will be active. If the status is set to Sold (0) the 'Buy this item' button will be disabled.

When a user clicks the 'Buy this item' button, then first the .sell file is checked to see if the item is still available, if it is then the user will be redirected to PayPal.
If the user completes the PayPal payment, the user is then sent back to the gallery and the TEXT_PAYPAL_THANKS message is shown.
If the user cancels the buy, the user will just be sent back to the gallery.

You should configure your PayPal account to send you a notification when someone pays you. So that you are notified by PayPal, when an item have been sold.
When an item is sold out, you should change the item status to sold. Do this manually in the .sell file or use the admin option.


____________________________________________________________
option('PAYPAL_ACCOUNT', '');

Set the PayPal account. The email address you login to PayPal with.

EXAMPLE: option('PAYPAL_ACCOUNT', 'me@mydomain.com');


____________________________________________________________
option('PAYPAL_CURRENCY', 'USD');

Set the currency used for selling.
See here of possible options: https://developer.paypal.com/api/rest/reference/currency-codes/


____________________________________________________________
option('PAYPAL_EXTENSION', '.sell');

Set the extension for the sell file. See PAYPAL_ENABLED for further description.
If this option is changed, you should also change the FILE_EXT_EXCLUDE option, to not have the sell files shown inside the gallery as files.


____________________________________________________________
option('RETURN_PROTOCOL', 'https');

Set the protocl to use when users are returned to your site from PayPal.
If your site is unable to use 'https', then change to 'http'.


____________________________________________________________
option('TEXT_PAYPAL_FOR_SALE', 'Sales information');

Set the text for the "Sales information" box inside information panel.


____________________________________________________________
option('TEXT_PAYPAL_PRICE', 'Price');

Set the text for the Price label.


____________________________________________________________
option('TEXT_PAYPAL_STATUS', 'Status');

Set the text for the status label.


____________________________________________________________
option('TEXT_PAYPAL_AVAILABLE', 'Available');

Set the text for when an item is available.


____________________________________________________________
option('TEXT_PAYPAL_SOLD', 'Sold');

Set the text for when an item is sold out.


____________________________________________________________
option('TEXT_PAYPAL_ITEM_ID', 'Item ID');

Set the text for the item identification label.


____________________________________________________________
option('TEXT_PAYPAL_BUY', 'Buy this item');

Set the text for the "Buy this item" button.


____________________________________________________________
option('TEXT_PAYPAL_OUT_BACK', 'Item is no longer available. Click back and refresh the page to update status.');

Set the text for when a user tries to buy an item, after it have been sold out.
When an item is sold out, the "Buy this item" button will be disabled. So this text will only be used if the item is marked as sold after the user loaded the page.


____________________________________________________________
option('TEXT_PAYPAL_THANKS', 'Thank you for your purchase. The item will remain listed as available until seller have verified the purchase. Click here to return to the gallery: ');

Set the text shown to a customer returned from PayPal after completing a purchase. A link to the gallery is shown after the defined text. The link is named like defined in TEXT_HOME.


____________________________________________________________
option('TEXT_PAYPAL_REDIRECT', 'Redirecting to PayPal. Please wait...');

Set the text for the redirect screen, when redirecting to PayPal.


____________________________________________________________
option('HTML_LANGUAGE', 'en-US');

Set the language identifier of the language used in the gallery.


____________________________________________________________
option('TEXT_DAYS', "['Sun','Mon','Tue','Wed','Thu','Fri','Sat']");

Set the representation of the week days. Must start with Sunday and have all seven days.
Make sure not to change the syntax of the option. Change only the text.


____________________________________________________________
option('TEXT_MONTHS', "['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']");

Set the representation of the months. Must start with January and have all 12 months.
Make sure not to change the syntax of the option. Change only the text.


____________________________________________________________
option('TEXT_GALLERY_NAME', 'Single File PHP Gallery');

Text that will be set as title on the page.


____________________________________________________________
option('TEXT_BANNER', '');

Set the text that will be shown as the first thing in every gallery, above the thumbnail boxes. This option can include HTML.

You can set to: '<h1>Welcome to my Gallery</h1>' to have text made large.


____________________________________________________________
option('TEXT_HOME', 'Home');

Text on first button in the navigation bar that takes you back to the root of the gallery.


____________________________________________________________
option('TEXT_CLOSE_IMG_VIEW', 'Close Image');

Text on button that closes full size image view.


____________________________________________________________
option('TEXT_ACTUAL_SIZE', 'Actual Size');

Text on button that can switch between fitting image to screen and actual size.
Set to '' to remove button from menu.


____________________________________________________________
option('TEXT_PREVIOUS', '&#x25C4;&#xFE0E; Previous');

Text on previous button.


____________________________________________________________
option('TEXT_NEXT', 'Next &#x25BA;&#xFE0E;');

Text on next button.


____________________________________________________________
option('TEXT_INFO', '<u>I</u>nfo');

Text on button that will show/hide the information panel.
Set to '' to remove button from menu.


____________________________________________________________
option('TEXT_INFO_LABEL', 'Information');

Text for the information box label.
Set to '' to remove the information box in the information panel.

The information box will show different information 

For directories the information box will show: Date, number of directories, number of images and number of files in the gallery.
For images the information box will show: Date, Image size, Scaled to, File size and Image number (like: 2 / 5).
For files the information box will show: Date and File size.


____________________________________________________________
option('TEXT_DOWNLOAD', 'Download image');

Text for the link in information panel that allows download of the image.
Set to '' to have download link removed and function disabled. Just keep in mind that users still can save all images in a number of ways.


____________________________________________________________
option('TEXT_SLIDESHOW', 'Slideshow');

Set the text for the slideshow button.
Set to '' to remove the slideshow button.


____________________________________________________________
option('TEXT_NO_IMAGES', 'No Images in gallery');

Text for the information to be shown instead of a thumbnail if there are no images in a directory.


____________________________________________________________
option('TEXT_DATE', 'Date');

Text for the date label.


____________________________________________________________
option('TEXT_FILESIZE', 'File size');

Text for the file size label.


____________________________________________________________
option('TEXT_IMAGESIZE', 'Image size');

Text for the image size label.


____________________________________________________________
option('TEXT_DIR_NAME', 'Gallery Name');

Text for the gallery name label.


____________________________________________________________
option('TEXT_IMAGE_NAME', 'Image Name');

Text for the image name label.


____________________________________________________________
option('TEXT_FILE_NAME', 'File Name');

Text for the file name label.


____________________________________________________________
option('TEXT_DIRS', 'Directories');

Text for the directories label.


____________________________________________________________
option('TEXT_DIR_MARK_START', '&#128193;&#xFE0E; ');

Text that will be shown before the name on all directorie thumbnails. The default '&#128193;&#xFE0E; ' is an icon showing a directory.
The two parts of this is the directory icon (&#128193;) and a code (&#xFE0E;) to make sure that the browser do not turn the icon into an emoji.


____________________________________________________________
option('TEXT_DIR_MARK_END', '');

Text that will be shown after the name on all directorie thumbnails.


____________________________________________________________
option('TEXT_IMAGES', 'Images');

Text for the images label.


____________________________________________________________
option('TEXT_IMAGE_NUMBER', 'Image number');

Text for the image number label.


____________________________________________________________
option('TEXT_FILES', 'Files');

Text for the files label.


____________________________________________________________
option('TEXT_DESCRIPTION', 'Description');

Text for the description label.

____________________________________________________________
option('TEXT_DIRECT_LINK_GALLERY', 'Direct link to Gallery');

Text for the direct link to gallery. The link is shown in the information panel, and can be used to link directly to the current sub gallery.


____________________________________________________________
option('TEXT_DIRECT_LINK_IMAGE', 'Direct link to Image');

Text for the direct link to image. The link is shown in the information panel, and can be used to link directly to the current image.


____________________________________________________________
option('TEXT_NO_THUMB_FOR_FILE', 'No thumbnail for file');

Text for the information to be shown instead of a thumbnail if there is no thumbnail for a file.


____________________________________________________________
option('TEXT_IMAGE_LOADING', 'Image Loading ');

Text for the information to show when images are loading.


____________________________________________________________
option('TEXT_LINKS', 'Links');

Text for the links label.


____________________________________________________________
option('TEXT_NOT_SCALED', 'Not Scaled');

Text for the label that will be shown in information box if the current image is not resized to fit screen.


____________________________________________________________
option('TEXT_LINK_BACK', 'Back to my site');

Text for an optional link button. See LINK_BACK for further information.


____________________________________________________________
option('TEXT_SCALED_TO', 'Scaled to');

Text for the scaled to label.


____________________________________________________________
option('TEXT_YES', 'Yes');

Text for the yes label.


____________________________________________________________
option('TEXT_NO', 'No');

Text for the no label.


____________________________________________________________
option('TEXT_FIRST_VIEW', 'This is first view of this image. Refresh page to get information.');

As image data, EXIF and IPTC information is first generated when the thumbnail is generated, the information will first be available the second time it is accessed.
This text will be shown in the information panel only the first time a thumbnail is shown.


____________________________________________________________
option('TEXT_LOGIN', 'Login');

Text for the login button, when using the PASSWORD option.


____________________________________________________________
option('TEXT_LOGOUT', 'Logout');

Text for the logout button, when using the PASSWORD option.


____________________________________________________________
option('TEXT_ADMIN', 'Admin');

Text for the Select button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_OK', 'OK');

Text for the OK button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_CANCEL', 'Cancel');

Text for the Cancel button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_DELETE', 'Delete');

Text for the Delete button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_RENAME', 'Rename');

Text for the Rename button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_MOVE', 'Move');

Text for the Move button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_MOVE_TO', 'Move to');

Text for the Move to label, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_MKDIR', 'Create Directory');

Text for the Create Directory button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_SET_DIR_THUMB', 'Dir Thumb');

Text for the "Set directory thumbnail" button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_REMOVE_THUMB', 'No images selected. Will remove current directory thumbnail and select new thumbnail.');

Text for when about to remove current set thumbnail, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_SETTING_THUMB', 'Setting directory thumbnail to: ');

Text for when about to set a directory thumbnail, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_WRONG_FILETYPE', 'Wrong filetype selected. Filetype must be same as set in DIR_THUMB_FILE: ');

Text shown if a wrong filetype is chosen as directory thumbnail, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_UPLOAD', 'Upload');

Text for the Upload button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_INVERT_SELECTION', 'Invert Select');

Text for the Invert Selection button, used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_NOTHING', 'Nothing Selected');

Text for the information if nothing is selected. Used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_ONLY_ONE', 'Select only one element to use this function');

Text shown if more than one element is selected and function only allows one. Used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_ONE_IMAGE', 'Select only one image to use this function');

Text shown if more than one image is selected and function only allows one. Used when the ADMIN option have been set to TRUE.


____________________________________________________________
option('TEXT_EXIF', 'EXIF');

Title for the EXIF box.


____________________________________________________________
option('TEXT_EXIF_DATE', 'Date');

Text for the EXIF Date label.


____________________________________________________________
option('TEXT_EXIF_CAMERA', 'Camera');

Text for the Camera label.


____________________________________________________________
option('TEXT_EXIF_ISO', 'ISO');

Text for the ISO label.


____________________________________________________________
option('TEXT_EXIF_SHUTTER', 'Shutter Speed');

Text for the Shutter Speed label.


____________________________________________________________
option('TEXT_EXIF_APERTURE', 'Aperture');
	
Text for the Aperture label.


____________________________________________________________
option('TEXT_EXIF_FOCAL', 'Focal Length');
	
Text for the Focal Length label.


____________________________________________________________
option('TEXT_EXIF_FLASH', 'Flash fired');
	
Text for the Flash Fired label.


____________________________________________________________
option('TEXT_EXIF_LATITUDE', 'Latitude');

Text for GPS Latitude label.


____________________________________________________________
option('TEXT_EXIF_LONGITUDE', 'Longitude');

Text for GPS Longitude label.


____________________________________________________________
option('TEXT_EXIF_MAP', 'See on Google map');

Text for GPS map link.
Set to '' to not show the map link.


____________________________________________________________
option('EXIF_MAP_LINK', 'https://maps.google.com/maps?q=[lat],[long]');

Set the link to map function like Google maps. When clicked link will be launched in a new page.
Latitude in decimal will be filled in where this string is: [lat]
Longitude in decimal will be filled in where this string is: [long]

OpenStreetMap can be used like this: 'https://www.openstreetmap.org/#map=19/[lat]/[long]'

Set to '' to not show the map link.


____________________________________________________________
option('TEXT_EXIF_MAP_EMBED', 'Image map');

Set text for embedded map label.
Set to '' to disable the embedded map in the gallery.


____________________________________________________________
option('EXIF_MAP_EMBED_LINK', 'https://maps.google.com/maps?q=[lat],[long]&output=embed');

Set the link to map function like Google maps. The map is embedded in the information panel in the gallery.

Latitude in decimal will be filled in where this string is: [lat]
Longitude in decimal will be filled in where this string is: [long]

Set to '' to disable the embedded map in the gallery.


____________________________________________________________
option('TEXT_PNG_CHUNKS', 'PNG text chunks');

Text for the title of the PNG text chunks box in the information panel.


____________________________________________________________
option('TEXT_WEBP_EXIF', 'WebP EXIF');

Text for the title of the WebP EXIF box in the information panel.


____________________________________________________________
option('TEXT_IPTC', 'IPTC');

Text for the title of the IPTC box.


____________________________________________________________
option('IPTC', [
	'2#005' => 'Document Title',
	'2#010' => 'Urgency',
	'2#015' => 'Category',
	'2#020' => 'Subcategories',
	'2#040' => 'Special Instructions',
	'2#055' => 'Creation Date',
	'2#080' => 'Author Byline',
	'2#085' => 'Author Title',
	'2#090' => 'City',
	'2#095' => 'State',
	'2#101' => 'Country',
	'2#103' => 'OTR',
	'2#105' => 'Headline',
	'2#110' => 'Source',
	'2#115' => 'Photo Source',
	'2#116' => 'Copyright',
	'2#120' => 'Caption',
	'2#122' => 'Caption Writer',
]);

Set which IPTC data to extract and what to call the caption for it.
If new lines are added to the list, the content of the DATA_ROOT should be deleted to allow extraction of new data.

INFO: The , at the end of the last line is not an error. It is allowed and makes moving the lines easier.


____________________________________________________________
Set the colors to be used. If the color variable names are not enough to indicate where it goes, then just change it to red (#ff0000) or blue (#0000ff) and refresh the page, you should then be able to spot it.

option('COLOR_BODY_BACK', '#000000');
option('COLOR_BODY_TEXT', '#aaaaaa');
option('COLOR_BODY_LINK', '#ffffff');
option('COLOR_BODY_HOVER', '#aaaaaa');

option('COLOR_THUMB_BORDER', '#606060');
option('COLOR_FULLIMG_BORDER', '#ffffff');

option('COLOR_MARKED_BACK', '#ff0000');
option('COLOR_MARKED_TEXT', '#000000');

option('COLOR_DIR_BOX_BORDER', '#505050');
option('COLOR_DIR_BOX_BACK', '#000000');
option('COLOR_DIR_BOX_TEXT', '#aaaaaa');
option('COLOR_DIR_HOVER', '#ffffff');
option('COLOR_DIR_HOVER_TEXT', '#000000');

option('COLOR_IMG_BOX_BORDER', '#505050');
option('COLOR_IMG_BOX_BACK', '#202020');
option('COLOR_IMG_BOX_TEXT', '#aaaaaa');
option('COLOR_IMG_HOVER', '#ffffff');
option('COLOR_IMG_HOVER_TEXT', '#000000');

option('COLOR_FILE_BOX_BORDER', '#404040');
option('COLOR_FILE_BOX_BACK', '#101010');
option('COLOR_FILE_BOX_TEXT', '#aaaaaa');
option('COLOR_FILE_HOVER', '#ffffff');
option('COLOR_FILE_HOVER_TEXT', '#000000');

option('COLOR_DESC_BOX_BORDER', '#404040');
option('COLOR_DESC_BOX_BACK', '#202020');
option('COLOR_DESC_BOX_TEXT', '#aaaaaa');

option('COLOR_MENU_BACK', '#000000');
option('COLOR_MENU_TOP', '#303030');

option('COLOR_NAVBAR_BACK', '#202020');
option('COLOR_NAVBAR_TOP', '#303030');

option('COLOR_BUTTON_NAV_BORDER', '#404040');
option('COLOR_BUTTON_NAV_BACK', '#101010');
option('COLOR_BUTTON_NAV_TEXT', '#808080');

option('COLOR_INFO_BACK', '#000000');
option('COLOR_INFO_BORDER', '#606060');
option('COLOR_INFO_TEXT', '#aaaaaa');

option('COLOR_INFOBOX_BORDER', '#404040');
option('COLOR_INFOBOX_BACK', '#101010');

option('COLOR_BUTTON_BORDER', '#808080');
option('COLOR_BUTTON_BACK', '#000000');
option('COLOR_BUTTON_TEXT', '#aaaaaa');
option('COLOR_BUTTON_BORDER_OFF', '#505050');
option('COLOR_BUTTON_BACK_OFF', '#000000');
option('COLOR_BUTTON_TEXT_OFF', '#505050');
option('COLOR_BUTTON_HOVER', '#ffffff');
option('COLOR_BUTTON_HOVER_TEXT', '#000000');
option('COLOR_BUTTON_ON', '#aaaaaa');
option('COLOR_BUTTON_TEXT_ON', '#000000');

option('COLOR_OVERLAY', '#000000');


____________________________________________________________
EOF