<?php
// Authentication
define('LOGIN_URL', BASE_URL.'containers/auth/login/');
define('FORGOT_PASSWORD_URL', BASE_URL.'containers/auth/forgot-password/');

// Registration
define('SIGN_UP_URL', BASE_URL.'containers/registration/');

// Account
define('ACCOUNT_URL', BASE_URL.'containers/account/');
define('ACC_PROFILE_URL', BASE_URL.'containers/account/profile/');
define('ACC_PACKAGES_URL', BASE_URL.'containers/account/packages/');
define('ACC_FILES_URL', BASE_URL.'containers/account/files/');
define('ACC_ORDERS_URL', BASE_URL.'containers/account/orders/');
define('ACC_ORDER_DETAILS_URL', BASE_URL.'containers/account/orders/?oid=');
define('ACC_INVOICES_URL', BASE_URL.'containers/account/invoices/');
define('ACC_INVOICE_DETAILS_URL', BASE_URL.'containers/account/invoices/?oid=');
define('ACC_INVOICE_PAYMENT_URL', BASE_URL.'containers/account/invoices/payment/?oid=');
define('ACC_TRANSACTIONS_URL', BASE_URL.'containers/account/transactions/');
define('ACC_TRANSFERS_URL', BASE_URL.'containers/account/transfers/');
define('ACC_DOWNLOADS_URL', BASE_URL.'containers/account/downloads/');

// containers
define('RECENT_FILE_URL', BASE_URL.'containers/recent-files/');
define('PACKAGE_URL', BASE_URL.'containers/packages/');
define('REQUEST_FILE_URL', BASE_URL.'containers/request-file/');
define('BLOG_URL', BASE_URL.'containers/blog/');
define('ANNOUNCEMENT_URL', BASE_URL.'containers/announcements/');
define('CONTACT_US_URL', BASE_URL.'containers/contact-us/');

//Folders and Files
define('FILE_DETAILS_URL', BASE_URL.'containers/folders-and-files/file-details/?fid=');
define('FILE_PATH', BASE_URL.'admin/files/');
define('FOLDER_URL', BASE_URL.'containers/folders-and-files/?fid=');

// Cart 
define('CART_URL', BASE_URL.'containers/cart/');



//Defaults
define('DEFAULT_FOLDER_ICON_SRC', BASE_URL.'admin/files/icons/folder-icon-default.png');
define('DEFAULT_FILE_ICON_SRC', BASE_URL.'admin/files/icons/file-icon-default.png');
define('DEFAULT_FOLDER_ICON_PATH', BASE_URL.'admin/files/icons/');
define('DEFAULT_FILE_ICON_PATH', BASE_URL.'admin/files/icons/');

?>