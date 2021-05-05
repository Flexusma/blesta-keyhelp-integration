<?php
/**
 * en_us language for the Keyhelp module
 */
// Basics
$lang['Keyhelp.name'] = 'cPanel';
$lang['Keyhelp.description'] = 'Keyhelp integration by Flexusma';
$lang['Keyhelp.module_row'] = 'Server';
$lang['Keyhelp.module_row_plural'] = 'Servers';
$lang['Keyhelp.module_group'] = 'Server Group';
$lang['Keyhelp.tab_stats'] = 'Statistics';
$lang['Keyhelp.tab_client_stats'] = 'Statistics';
$lang['Keyhelp.tab_client_actions'] = 'Actions';

// Module management
$lang['Keyhelp.add_module_row'] = 'Add Server';
$lang['Keyhelp.add_module_group'] = 'Add Server Group';
$lang['Keyhelp.manage.module_rows_title'] = 'Servers';
$lang['Keyhelp.manage.module_groups_title'] = 'Server Groups';
$lang['Keyhelp.manage.module_rows_heading.name'] = 'Server Label';
$lang['Keyhelp.manage.module_rows_heading.hostname'] = 'Hostname';
$lang['Keyhelp.manage.module_rows_heading.accounts'] = 'Accounts';
$lang['Keyhelp.manage.module_rows_heading.options'] = 'Options';
$lang['Keyhelp.manage.module_groups_heading.name'] = 'Group Name';
$lang['Keyhelp.manage.module_groups_heading.servers'] = 'Server Count';
$lang['Keyhelp.manage.module_groups_heading.options'] = 'Options';
$lang['Keyhelp.manage.module_rows.count'] = '%1$s / %2$s'; // %1$s is the current number of accounts, %2$s is the total number of accounts available
$lang['Keyhelp.manage.module_rows.count_server_group'] = '%1$s / %2$s (%3$s Available)'; // %1$s is the current number of accounts, %2$s is the total number of accounts available, %3$s is the total number of accounts available without over-subscription
$lang['Keyhelp.manage.module_rows.edit'] = 'Edit';
$lang['Keyhelp.manage.module_groups.edit'] = 'Edit';
$lang['Keyhelp.manage.module_rows.delete'] = 'Delete';
$lang['Keyhelp.manage.module_groups.delete'] = 'Delete';
$lang['Keyhelp.manage.module_rows.confirm_delete'] = 'Are you sure you want to delete this server?';
$lang['Keyhelp.manage.module_groups.confirm_delete'] = 'Are you sure you want to delete this server group?';
$lang['Keyhelp.manage.module_rows_no_results'] = 'There are no servers.';
$lang['Keyhelp.manage.module_groups_no_results'] = 'There are no server groups.';


$lang['Keyhelp.order_options.first'] = 'First Non-full Server';
$lang['Keyhelp.order_options.roundrobin'] = 'Evenly Distribute Among Servers';

// Add row
$lang['Keyhelp.add_row.box_title'] = 'Add cPanel Server';
$lang['Keyhelp.add_row.basic_title'] = 'Basic Settings';
$lang['Keyhelp.add_row.name_servers_title'] = 'Name Servers';
$lang['Keyhelp.add_row.notes_title'] = 'Notes';
$lang['Keyhelp.add_row.name_server_btn'] = 'Add Additional Name Server';
$lang['Keyhelp.add_row.name_server_col'] = 'Name Server';
$lang['Keyhelp.add_row.name_server_host_col'] = 'Hostname';
$lang['Keyhelp.add_row.name_server'] = 'Name server %1$s'; // %1$s is the name server number (e.g. 3)
$lang['Keyhelp.add_row.remove_name_server'] = 'Remove';
$lang['Keyhelp.add_row.add_btn'] = 'Add Server';

$lang['Keyhelp.edit_row.box_title'] = 'Edit cPanel Server';
$lang['Keyhelp.edit_row.basic_title'] = 'Basic Settings';
$lang['Keyhelp.edit_row.name_servers_title'] = 'Name Servers';
$lang['Keyhelp.edit_row.notes_title'] = 'Notes';
$lang['Keyhelp.edit_row.name_server_btn'] = 'Add Additional Name Server';
$lang['Keyhelp.edit_row.name_server_col'] = 'Name Server';
$lang['Keyhelp.edit_row.name_server_host_col'] = 'Hostname';
$lang['Keyhelp.edit_row.name_server'] = 'Name server %1$s'; // %1$s is the name server number (e.g. 3)
$lang['Keyhelp.edit_row.remove_name_server'] = 'Remove';
$lang['Keyhelp.edit_row.add_btn'] = 'Edit Server';

$lang['Keyhelp.row_meta.server_name'] = 'Server Label';
$lang['Keyhelp.row_meta.host_name'] = 'Hostname';
$lang['Keyhelp.row_meta.user_name'] = 'User Name';
$lang['Keyhelp.row_meta.key'] = 'Token (or Remote Key)';
$lang['Keyhelp.row_meta.use_ssl'] = 'Use SSL when connecting to the API (recommended)';
$lang['Keyhelp.row_meta.account_limit'] = 'Account Limit';

// Package fields
$lang['Keyhelp.package_fields.type'] = 'Account Type';
$lang['Keyhelp.package_fields.type_standard'] = 'Standard';
$lang['Keyhelp.package_fields.type_reseller'] = 'Reseller';
$lang['Keyhelp.package_fields.package'] = 'cPanel Package';
$lang['Keyhelp.package_fields.acl'] = 'Access Control List';
$lang['Keyhelp.package_fields.acl_default'] = 'Default';
$lang['Keyhelp.package_fields.account_limit'] = 'Account Limit';
$lang['Keyhelp.package_fields.dedicated_ip'] = 'Dedicated IP';
$lang['Keyhelp.package_fields.sub_domains'] = 'Enable Selling Sub-Domains';
$lang['Keyhelp.package_fields.sub_domains_enable'] = 'Enable';
$lang['Keyhelp.package_fields.sub_domains_disable'] = 'Disable';
$lang['Keyhelp.package_fields.domains_list'] = 'Available Domains List';
$lang['Keyhelp.package_fields.dedicated_ip_no'] = 'No';
$lang['Keyhelp.package_fields.dedicated_ip_yes'] = 'Yes';

// Service fields
$lang['Keyhelp.service_field.domain'] = 'Domain';
$lang['Keyhelp.service_field.sub_domain'] = 'Sub-Domain';
$lang['Keyhelp.service_field.username'] = 'Username';
$lang['Keyhelp.service_field.password'] = 'Password';
$lang['Keyhelp.service_field.confirm_password'] = 'Confirm Password';

// Service management
$lang['Keyhelp.tab_stats.info_title'] = 'Information';
$lang['Keyhelp.tab_stats.info_heading.field'] = 'Field';
$lang['Keyhelp.tab_stats.info_heading.value'] = 'Value';
$lang['Keyhelp.tab_stats.info.domain'] = 'Domain';
$lang['Keyhelp.tab_stats.info.ip'] = 'IP Address';
$lang['Keyhelp.tab_stats.bandwidth_title'] = 'Bandwidth';
$lang['Keyhelp.tab_stats.bandwidth_heading.used'] = 'Used';
$lang['Keyhelp.tab_stats.bandwidth_heading.limit'] = 'Limit';
$lang['Keyhelp.tab_stats.bandwidth_value'] = '%1$s MB'; // %1$s is the amount of bandwidth in MB
$lang['Keyhelp.tab_stats.bandwidth_unlimited'] = 'unlimited';
$lang['Keyhelp.tab_stats.disk_title'] = 'Disk';
$lang['Keyhelp.tab_stats.disk_heading.used'] = 'Used';
$lang['Keyhelp.tab_stats.disk_heading.limit'] = 'Limit';
$lang['Keyhelp.tab_stats.disk_value'] = '%1$s MB'; // %1$s is the amount of disk in MB
$lang['Keyhelp.tab_stats.disk_unlimited'] = 'unlimited';


// Client actions
$lang['Keyhelp.tab_client_actions.change_password'] = 'Change Password';
$lang['Keyhelp.tab_client_actions.field_cpanel_password'] = 'Password';
$lang['Keyhelp.tab_client_actions.field_cpanel_confirm_password'] = 'Confirm Password';
$lang['Keyhelp.tab_client_actions.field_password_submit'] = 'Update Password';


// Client Service management
$lang['Keyhelp.tab_client_stats.info_title'] = 'Information';
$lang['Keyhelp.tab_client_stats.info_heading.field'] = 'Field';
$lang['Keyhelp.tab_client_stats.info_heading.value'] = 'Value';
$lang['Keyhelp.tab_client_stats.info.domain'] = 'Domain';
$lang['Keyhelp.tab_client_stats.info.ip'] = 'IP Address';
$lang['Keyhelp.tab_client_stats.bandwidth_title'] = 'Bandwidth Usage (Month to Date)';
$lang['Keyhelp.tab_client_stats.disk_title'] = 'Disk Usage';
$lang['Keyhelp.tab_client_stats.usage'] = '(%1$s MB/%2$s MB)'; // %1$s is the amount of resource usage, %2$s is the resource usage limit
$lang['Keyhelp.tab_client_stats.usage_unlimited'] = '(%1$s MB/∞)'; // %1$s is the amount of resource usage


// Service info
$lang['Keyhelp.service_info.username'] = 'Username';
$lang['Keyhelp.service_info.password'] = 'Password';
$lang['Keyhelp.service_info.server'] = 'Server';
$lang['Keyhelp.service_info.options'] = 'Options';
$lang['Keyhelp.service_info.option_login'] = 'Log in';


// Tooltips
$lang['Keyhelp.package_fields.tooltip.domains_list'] = 'Enter a CSV list of domains that will be available to provision sub-domains for, e.g. "domain1.com,domain2.com,domain3.com"';
$lang['Keyhelp.service_field.tooltip.username'] = 'You may leave the username blank to automatically generate one.';
$lang['Keyhelp.service_field.tooltip.password'] = 'You may leave the password blank to automatically generate one.';


// Errors
$lang['Keyhelp.!error.server_name_valid'] = 'You must enter a Server Label.';
$lang['Keyhelp.!error.host_name_valid'] = 'The Hostname appears to be invalid.';
$lang['Keyhelp.!error.user_name_valid'] = 'The User Name appears to be invalid.';
$lang['Keyhelp.!error.remote_key_valid'] = 'The Token (or Remote Key) appears to be invalid.';
$lang['Keyhelp.!error.remote_key_valid_connection'] = 'A connection to the server could not be established. Please check to ensure that the Hostname, User Name, and Token (or Remote Key) are correct.';
$lang['Keyhelp.!error.account_limit_valid'] = 'Account Limit must be left blank (for unlimited accounts) or set to some integer value.';
$lang['Keyhelp.!error.name_servers_valid'] = 'One or more of the name servers entered are invalid.';
$lang['Keyhelp.!error.name_servers_count'] = 'You must define at least 2 name servers.';
$lang['Keyhelp.!error.meta[type].valid'] = 'Account type must be either standard or reseller.';
$lang['Keyhelp.!error.meta[sub_domains].valid'] = 'Enable Sub-Domains must be set to either enable or disable.';
$lang['Keyhelp.!error.meta[domains_list].valid'] = 'At least one available domain must be set and they must all represent a valid host name.';
$lang['Keyhelp.!error.meta[account_limit].valid'] = 'Account limit must be a number.';
$lang['Keyhelp.!error.meta[package].empty'] = 'A cPanel Package is required.';
$lang['Keyhelp.!error.meta[dedicated_ip].format'] = 'The dedicated IP must be set to 0 or 1.';
$lang['Keyhelp.!error.api.internal'] = 'An internal error occurred, or the server did not respond to the request.';
$lang['Keyhelp.!error.module_row.missing'] = 'An internal error occurred. The module row is unavailable.';

$lang['Keyhelp.!error.cpanel_domain.format'] = 'Please enter a valid domain name, e.g. domain.com.';
$lang['Keyhelp.!error.cpanel_domain.valid'] = 'Invalid domain name.';
$lang['Keyhelp.!error.cpanel_sub_domain.format'] = 'Please enter a valid sub-domain name, e.g. "site".';
$lang['Keyhelp.!error.cpanel_sub_domain.availability'] = 'The sub-domain provided is not available.';
$lang['Keyhelp.!error.cpanel_username.format'] = 'The username may contain only letters and numbers and may not start with a number.';
$lang['Keyhelp.!error.cpanel_username.test'] = "The username may not begin with 'test'.";
$lang['Keyhelp.!error.cpanel_username.length'] = 'The username must be between 1 and 16 characters in length.';
$lang['Keyhelp.!error.cpanel_password.valid'] = 'Password must be at least 8 characters in length.';
$lang['Keyhelp.!error.cpanel_password.matches'] = 'Password and Confirm Password do not match.';
$lang['Keyhelp.!error.configoptions[dedicated_ip].format'] = 'The dedicated IP must be set to 0 or 1.';
