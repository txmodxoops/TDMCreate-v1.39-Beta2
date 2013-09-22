<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.5.0
 * @author          Txmod Xoops http://www.txmodxoops.org
 * @version         $Id: admin.php 11084 2013-02-23 15:44:20Z timgno $
 */
//Menu
define('_AM_TDMCREATE_ADMIN_INDEX', "Index");
define('_AM_TDMCREATE_ADMIN_MODULES', "Add Module");
define('_AM_TDMCREATE_ADMIN_TABLES', "Add Table");
define('_AM_TDMCREATE_ADMIN_CONST', "Build Module");
define('_AM_TDMCREATE_ADMIN_ABOUT', "About");
define('_AM_TDMCREATE_ADMIN_PREFERENCES', "Preferences");
define('_AM_TDMCREATE_ADMIN_UPDATE', "Update");
define('_AM_TDMCREATE_ADMIN_NUMMODULES', "Statistics");
define('_AM_TDMCREATE_THEREARE_NUMMODULES', "There are <span class='red bold'>%s</span> modules stored in the Database");
define('_AM_TDMCREATE_THEREARE_NUMTABLES', "There are <span class='red bold'>%s</span> tables stored in the Database");

define('_AM_TDMCREATE_TABLES_FIELDS_MORE_ELEMENTS', "Forms: Elements");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_PARENT_ID', "Parent: Category id");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_DISPLAY_ADMIN', "Page: Show admin");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_DISPLAY_USER', "Page: View User");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_BLOC', "Block: View");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_MAIN_FIELD', "Table: Main Field");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_SEARCH', "Search: Index");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE_REQUIRED', "Forms: Required field");

//General
define('_AM_TDMCREATE_FORMOK', "Successfully saved");
define('_AM_TDMCREATE_FORMDELOK', "Successfully deleted");
define('_AM_TDMCREATE_FORMSUREDEL', "Are you sure to delete: <b><span style='color : Red'>%s </span></b>");
define('_AM_TDMCREATE_FORMSURERENEW', "Are you sure to update: <b><span style='color : Red'>%s </span></b>");
define('_AM_TDMCREATE_FORMUPLOAD', "Upload file");
define('_AM_TDMCREATE_FORMIMAGE_PATH', "Files in %s ");
define('_AM_TDMCREATE_FORMACTION', "Action");
define('_AM_TDMCREATE_FORMEDIT', "Modification");
define('_AM_TDMCREATE_FORMDEL', "Clear");
define('_AM_TDMCREATE_FORMFIELDS', "Edit fields");
define('_AM_TDMCREATE_FORM_INFO_TABLE_OPTIONAL_FIELD', "Optional fields");
define('_AM_TDMCREATE_FORM_INFO_TABLE_STRUCTURES_FIELD', "Structures fields");
define('_AM_TDMCREATE_FORM_INFO_TABLE_ICON_FIELD', "Icon fields");

define('_AM_TDMCREATE_ID', "ID");
define('_AM_TDMCREATE_NAME', "Name");
define('_AM_TDMCREATE_BLOCKS', "Blocks");
define('_AM_TDMCREATE_NB_FIELDS', "Number of fields");
define('_AM_TDMCREATE_IMAGE', "Image");
define('_AM_TDMCREATE_DISPLAY_ADMIN', "Visible in Admin Panel");
// 1.37
define('_AM_TDMCREATE_DISPLAY_USER', "Visible in User View");

//Modules.php
//Form
define('_AM_TDMCREATE_MODULES_ADD', "Add a new module");
define('_AM_TDMCREATE_MODULES_EDIT', "Create a module");
define('_AM_TDMCREATE_MODULES_IMPORTANT', "Required Information");
define('_AM_TDMCREATE_MODULES_NOTIMPORTANT', "Optional Information");
define('_AM_TDMCREATE_MODULES_NAME', "Name");
define('_AM_TDMCREATE_MODULES_VERSION', "Version");
define('_AM_TDMCREATE_MODULES_SINCE', "Since");
define('_AM_TDMCREATE_MODULES_DESCRIPTION', "Description");
define('_AM_TDMCREATE_MODULES_AUTHOR', "Author");
define('_AM_TDMCREATE_MODULES_AUTHOR_MAIL', "Author's Email");
define('_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_URL', "Author's Website");
define('_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_NAME', "Website's Name");

define('_AM_TDMCREATE_MODULES_CREDITS', "Credits");	
define('_AM_TDMCREATE_MODULES_LICENSE', "License");
define('_AM_TDMCREATE_MODULES_RELEASE_INFO', "Release Info");	
define('_AM_TDMCREATE_MODULES_RELEASE_FILE', "File attached to the release");
define('_AM_TDMCREATE_MODULES_MANUAL', "Manual");	
define('_AM_TDMCREATE_MODULES_MANUAL_FILE', "Manual file");
define('_AM_TDMCREATE_MODULES_IMAGE', "Logo of the module");
define('_AM_TDMCREATE_MODULES_DEMO_SITE_URL', "URL of the demo site");
define('_AM_TDMCREATE_MODULES_DEMO_SITE_NAME', "Title of the demo site");	

define('_AM_TDMCREATE_MODULES_CREDITS', "Credits");
define('_AM_TDMCREATE_MODULES_LICENSE', "License");
define('_AM_TDMCREATE_MODULES_RELEASE_INFO', "Release Info");
define('_AM_TDMCREATE_MODULES_RELEASE_FILE', "File attached to the release");
define('_AM_TDMCREATE_MODULES_MANUAL', "Manual");
define('_AM_TDMCREATE_MODULES_MANUAL_FILE', "Manual file");
define('_AM_TDMCREATE_MODULES_IMAGE', "Logo of the module");
define('_AM_TDMCREATE_MODULES_DEMO_SITE_URL', "URL of the demo site");
define('_AM_TDMCREATE_MODULES_DEMO_SITE_NAME', "Title of the demo site");

define('_AM_TDMCREATE_MODULES_FORUM_SITE_URL', "Forum URL");
define('_AM_TDMCREATE_MODULES_FORUM_SITE_NAME', "Forum URL Title");
define('_AM_TDMCREATE_MODULES_WEBSITE_URL', "Module Website");
define('_AM_TDMCREATE_MODULES_WEBSITE_NAME', "Module Website Title");
define('_AM_TDMCREATE_MODULES_RELEASE', "Release");
define('_AM_TDMCREATE_MODULES_STATUS', "Status");
define('_AM_TDMCREATE_MODULES_DISPLAY_ADMIN', "Visible in Admin");
define('_AM_TDMCREATE_MODULES_DISPLAY_USER', "Visible in User side");

define('_AM_TDMCREATE_MODULES_ACTIVE_SEARCH', "Enable search");
define('_AM_TDMCREATE_MODULES_ACTIVE_COMMENTS', "Enable comments");
define('_AM_TDMCREATE_MODULES_ACTIVE_NOTIFICATIONS', "Enable notifications");
define('_AM_TDMCREATE_MODULES_ACTIVE_PERMISSIONS', "Enable permissions");
define('_AM_TDMCREATE_MODULES_INROOT_INSTALL', "Install this module directly in root/modules?");
define('_AM_TDMCREATE_MODULES_PAYPAL_BUTTON', "Paypal Button");

define('_AM_TDMCREATE_MODULES_ACTIVE_SEARCH', "Enable Search");
define('_AM_TDMCREATE_MODULES_ACTIVE_COMMENTS', "Enable Comments");
define('_AM_TDMCREATE_MODULES_ACTIVE_NOTIFICATIONS', "Enable Notifications");
define('_AM_TDMCREATE_MODULES_ACTIVE_PERMISSIONS', "Enable Permissions");
define('_AM_TDMCREATE_MODULES_INROOT_INSTALL', "Install this module directly in root/modules?");
define('_AM_TDMCREATE_MODULES_PAYPAL_BUTTON', "PayPal Button");

define('_AM_TDMCREATE_MODULES_SUBVERSION', "Subversion");
//Tables.php
//Form1
define('_AM_TDMCREATE_TABLES_ADD', "Add tables to the form:");
define('_AM_TDMCREATE_TABLES_EDIT', "Edit Module Tables");
define('_AM_TDMCREATE_TABLES_MODULES', "Select a module");

define('_AM_TDMCREATE_TABLES_NAME', "Name of the table <br> <i>(The name of the module will automatically be added to the prefix)</i> <br> Example: &#39;mod_module-name_table&#39;");
define('_AM_TDMCREATE_TABLES_FIELDNAME', "Prefix of the fields <br> <i>(The prefix name will automatically be added in the next step)</i><br />Example: &#39;fieldname&#39;<br />Attention: Don't use underscore first of fieldname - this is what TDMCreate was generating");
define('_AM_TDMCREATE_TABLES_NUMBER_FIELDS', "Number of fields for this table");
define('_AM_TDMCREATE_TABLES_IMAGE', "Table Icon");
define('_AM_TDMCREATE_TABLES_CATEGORY', "This table is a category or topic?");

define('_AM_TDMCREATE_TABLES_NAME', "Name of the table <br> <i>(The name of the module will automatically be added to the prefix)</i> <br> Example: &#39;mod_module_name_table&#39;");
define('_AM_TDMCREATE_TABLES_FIELDNAME', "Prefix of the fields <br> <i>(The prefix name will automatically be added in the next step)</i> <br> Example: &#39;fieldname&#39;_ (optional)");
define('_AM_TDMCREATE_TABLES_NUMBER_FIELDS', "Number of fields for this table");
define('_AM_TDMCREATE_TABLES_IMAGE', "Table Icon");
define('_AM_TDMCREATE_TABLES_CATEGORY', "This table is a category?");

define('_AM_TDMCREATE_TABLES_CATEGORY_DESC', "<i>Once you have used this field,<br />will not be displayed following the creation of other tables</i>");
define('_AM_TDMCREATE_TABLES_BLOCKS', "Create block for this table");
define('_AM_TDMCREATE_TABLES_ADMIN', "Visible in Admin View");
define('_AM_TDMCREATE_TABLES_USER', "Visible in User View");
define('_AM_TDMCREATE_TABLES_SUBMITTER', "Add submitter");
define('_AM_TDMCREATE_TABLES_CREATED', "Add created");
define('_AM_TDMCREATE_TABLES_ONLINE', "Add online");
define('_AM_TDMCREATE_TABLES_SEARCH', "Active research for this table <br> <i>The form for the moment, is able to handle the search on the table <br> If you confirm the search option will be disabled</i>");
define('_AM_TDMCREATE_TABLES_EXIST', "The name specified for this table is already in use");
define('_AM_TDMCREATE_TABLES_COMMENTS', "Active comments for this table <br> <i>The module can manage for the moment, the comments on a table <br> Comments option will be disabled if you Confirmed</i>");
define('_AM_TDMCREATE_TABLES_NOTIFICATIONS', "Active notifications for this table.");
define('_AM_TDMCREATE_TABLES_PERMISSIONS', "Active permissions for this table <br /> <i><span class='red big'>Attention</span>: you can use only for this table</i>");
define('_AM_TDMCREATE_TABLES_CATEGORY_ADD', "Add the table to the category");
//Form2
define('_AM_TDMCREATE_TABLES_FIELDS_ADD', "Add the fields");
define('_AM_TDMCREATE_TABLES_FIELDS_EDIT', "Edit your field");
define('_AM_TDMCREATE_TABLES_FIELDS_NAME', "Field Name");
define('_AM_TDMCREATE_TABLES_FIELDS_TYPE', "Type");
define('_AM_TDMCREATE_TABLES_FIELDS_VALUE', "Value");
define('_AM_TDMCREATE_TABLES_FIELDS_ATTRIBUTES', "Attributes");
define('_AM_TDMCREATE_TABLES_FIELDS_NULL', "Null");
define('_AM_TDMCREATE_TABLES_FIELDS_DEFAULT', "Default");
define('_AM_TDMCREATE_TABLES_FIELDS_INDEX', "Index");
define('_AM_TDMCREATE_TABLES_FIELDS_MORE', "Other");
define('_AM_TDMCREATE_ADMIN_SUBMIT', "Submit");
//Const.php
define('_AM_TDMCREATE_CONST_MODULES', "Select the module you want to build");
define('_AM_TDMCREATE_CONST_TABLES', "Select the table you want to build");
//Creation
//OK
define('_AM_TDMCREATE_CONST_OK_ARCHITECTURE', "<span class='green'>The structure of the module was created (index.html, folders, ...)</span>");
define('_AM_TDMCREATE_CONST_OK_COMMENTS', "The file <b>%s</b> is created in the <span class='green bold'>directory</span> of module");
define('_AM_TDMCREATE_CONST_OK_DOCS', "The file <b>%s</b> is created in the <span class='green bold'>docs</span> folder");
define('_AM_TDMCREATE_CONST_OK_CSS', "The file <b>%s</b> is created in the <span class='green bold'>css</span> folder");
define('_AM_TDMCREATE_CONST_OK_ROOTS', "The file <b>%s</b> is created in the <span class='green bold'>directory</span> of the module");
define('_AM_TDMCREATE_CONST_OK_CLASSES', "The file <b>%s</b> is created in the <span class='green bold'>class</span> folder");
define('_AM_TDMCREATE_CONST_OK_BLOCKS', "The file <b>%s</b> is created in the <span class='green bold'>blocks</span> folder");
define('_AM_TDMCREATE_CONST_OK_SQL', "The file <b>%s</b> is created in the <span class='green bold'>sql</span> folder");
define('_AM_TDMCREATE_CONST_OK_ADMINS', "The file <b>%s</b> is created in the <span class='green bold'>admin</span> folder");
define('_AM_TDMCREATE_CONST_OK_LANGUAGES', "The file <b>%s</b> is created in the <span class='green bold'>language</span> folder");
define('_AM_TDMCREATE_CONST_OK_INCLUDES', "The file <b>%s</b> is created in the <span class='green bold'>include</span> folder");
define('_AM_TDMCREATE_CONST_OK_TEMPLATES', "The file <b>%s</b> is created in the <span class='green bold'>templates</span> folder");
define('_AM_TDMCREATE_CONST_OK_TEMPLATES_BLOCKS', "The file <b>%s</b> is created in the <span class='green bold'>templates/blocks</span> folder");
define('_AM_TDMCREATE_CONST_OK_TEMPLATES_ADMIN', "The file <b>%s</b> is created in the <span class='green bold'>templates/admin</span> folder");

//NOTOK
define('_AM_TDMCREATE_CONST_NOTOK_ARCHITECTURE', "<span class='red'>Problems: Creating the structure of the module (index.html, icons ,...)</span>");
define('_AM_TDMCREATE_CONST_NOTOK_COMMENTS', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>directory</span> of module");
define('_AM_TDMCREATE_CONST_NOTOK_DOCS', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>docs</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_CSS', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>css</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_ROOTS', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>directory</span> of the module");
define('_AM_TDMCREATE_CONST_NOTOK_CLASSES', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>class</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_BLOCKS', "Problems: Creating file <b class='red'>%s</b> in <span class='red bold'>blocks</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_SQL', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>sql</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_ADMINS', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>admin</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_LANGUAGES', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>language</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_INCLUDES', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>include</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_TEMPLATES', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>templates</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_TEMPLATES_BLOCKS', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>templates/blocks</span> folder");
define('_AM_TDMCREATE_CONST_NOTOK_TEMPLATES_ADMIN', "Problems: Creating file <b class='red'>%s</b> in the <span class='red bold'>templates/admin</span> folder");

//------------ new additions: Ver. 1.11 -----------------------

define('_AM_TDMCREATE_ADMIN_PERMISSIONS', "Permissions");
define('_AM_TDMCREATE_FORMON', "Online");
define('_AM_TDMCREATE_FORMOFF', "Offline");

define('_AM_TDMCREATE_TRANSLATION_PERMISSIONS_ACCESS', "Allowed to access");
define('_AM_TDMCREATE_TRANSLATION_PERMISSIONS_SUBMIT', "Allowed to post");

//blocks
define('_AM_TDMCREATE_BLOCK_DAY', "Today");
define('_AM_TDMCREATE_BLOCK_RANDOM', "Random");
define('_AM_TDMCREATE_BLOCK_RECENT', "Recent");

define('_AM_TDMCREATE_THEREARE_DATABASE1', "There <span style='color: #ff0000; font-weight: bold'>are %s </span>");
define('_AM_TDMCREATE_THEREARE_DATABASE2', "in the database");
define('_AM_TDMCREATE_THEREARE_PENDING', "There <span style='color: #ff0000; font-weight: bold'>are %s </span>");
define('_AM_TDMCREATE_THEREARE_PENDING2', "waiting");

define('_AM_TDMCREATE_FORMADD', "Add");

define('_AM_TDMCREATE_MIMETYPES', "Mime types authorized for:");
define('_AM_TDMCREATE_MIMESIZE', "Allowable size:");
define('_AM_TDMCREATE_EDITOR', "Editor:");

//------------ new additions: Ver. 1.15 -----------------------

define('_AM_TDMCREATE_ABOUT_WEBSITE_FORUM', "Forum Web Site");

//------------ new additions: Ver. 1.37 -----------------------
define('_AM_TDMCREATE_MODULES_LIST', "Module List");
define('_AM_TDMCREATE_MODULES_NEW', "New Module");
define('_AM_TDMCREATE_TABLES_LIST', "Tables List");
define('_AM_TDMCREATE_TABLES_NEW', "New Table");
define('_AM_TDMCREATE_TABLES_NEW_CATEGORY', "New Category");

//1.38
define('_AM_TDMCREATE_TABLES_STATUS', "Show Table Status");
define('_AM_TDMCREATE_TABLES_WAITING', "Show Table Waiting");

//1.39
define('_AM_TDMCREATE_MODULES_MIN_PHP', "Minimum Php");
define('_AM_TDMCREATE_MODULES_MIN_XOOPS', "Minimum Xoops");

define('_AM_TDMCREATE_MODULES_MIN_PHP', "Minimum PHP");
define('_AM_TDMCREATE_MODULES_MIN_XOOPS', "Minimum XOOPS");

define('_AM_TDMCREATE_MODULES_MIN_ADMIN', "Minimum Admin");
define('_AM_TDMCREATE_MODULES_MIN_MYSQL', "Minimum Database");
define('_AM_TDMCREATE_BUILDING_FILES', "Files that have been compiled");
define('_AM_TDMCREATE_BUILDING_SUCCESS', "Success build");
define('_AM_TDMCREATE_BUILDING_FAILED', "Failed build");
define('_AM_TDMCREATE_CONST_OK_ARCHITECTURE_ROOT', "The structure of the module was created in root/modules (index.html, folders, ...)");

define('_AM_TDMCREATE_CONST_NOTOK_ARCHITECTURE_ROOT', "Problems: Creating the structure of the module in root/modules (index.html, icons ,...)");