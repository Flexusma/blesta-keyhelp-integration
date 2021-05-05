<?php
/**
 * en_us language for the cpanel module
 */
// Basics
$lang['KeyHelp.name'] = 'cPanel';
$lang['KeyHelp.description'] = 'cPanel & WHM have been the industry leading web hosting platform for over 20 years. Trusted world-wide by technology partners Wordpress, CloudLinux, Lighstpeed, and more.';
$lang['KeyHelp.module_row'] = 'Server';
$lang['KeyHelp.module_row_plural'] = 'Servers';
$lang['KeyHelp.module_group'] = 'Server Group';
$lang['KeyHelp.tab_stats'] = 'Statistics';
$lang['KeyHelp.tab_client_stats'] = 'Statistics';
$lang['KeyHelp.tab_client_actions'] = 'Actions';

// Module management
$lang['KeyHelp.add_module_row'] = 'Add Server';
$lang['KeyHelp.add_module_group'] = 'Add Server Group';
$lang['KeyHelp.manage.module_rows_title'] = 'Servers';
$lang['KeyHelp.manage.module_groups_title'] = 'Server Groups';
$lang['KeyHelp.manage.module_rows_heading.name'] = 'Server Label';
$lang['KeyHelp.manage.module_rows_heading.hostname'] = 'Hostname';
$lang['KeyHelp.manage.module_rows_heading.accounts'] = 'Accounts';
$lang['KeyHelp.manage.module_rows_heading.options'] = 'Options';
$lang['KeyHelp.manage.module_groups_heading.name'] = 'Group Name';
$lang['KeyHelp.manage.module_groups_heading.servers'] = 'Server Count';
$lang['KeyHelp.manage.module_groups_heading.options'] = 'Options';
$lang['KeyHelp.manage.module_rows.count'] = '%1$s / %2$s'; // %1$s is the current number of accounts, %2$s is the total number of accounts available
$lang['KeyHelp.manage.module_rows.count_server_group'] = '%1$s / %2$s (%3$s Available)'; // %1$s is the current number of accounts, %2$s is the total number of accounts available, %3$s is the total number of accounts available without over-subscription
$lang['KeyHelp.manage.module_rows.edit'] = 'Edit';
$lang['KeyHelp.manage.module_groups.edit'] = 'Edit';
$lang['KeyHelp.manage.module_rows.delete'] = 'Delete';
$lang['KeyHelp.manage.module_groups.delete'] = 'Delete';
$lang['KeyHelp.manage.module_rows.confirm_delete'] = 'Are you sure you want to delete this server?';
$lang['KeyHelp.manage.module_groups.confirm_delete'] = 'Are you sure you want to delete this server group?';
$lang['KeyHelp.manage.module_rows_no_results'] = 'There are no servers.';
$lang['KeyHelp.manage.module_groups_no_results'] = 'There are no server groups.';


$lang['KeyHelp.order_options.first'] = 'First Non-full Server';
$lang['KeyHelp.order_options.roundrobin'] = 'Evenly Distribute Among Servers';

// Add row
$lang['KeyHelp.add_row.box_title'] = 'Add cPanel Server';
$lang['KeyHelp.add_row.basic_title'] = 'Basic Settings';
$lang['KeyHelp.add_row.name_servers_title'] = 'Name Servers';
$lang['KeyHelp.add_row.notes_title'] = 'Notes';
$lang['KeyHelp.add_row.name_server_btn'] = 'Add Additional Name Server';
$lang['KeyHelp.add_row.name_server_col'] = 'Name Server';
$lang['KeyHelp.add_row.name_server_host_col'] = 'Hostname';
$lang['KeyHelp.add_row.name_server'] = 'Name server %1$s'; // %1$s is the name server number (e.g. 3)
$lang['KeyHelp.add_row.remove_name_server'] = 'Remove';
$lang['KeyHelp.add_row.add_btn'] = 'Add Server';

$lang['KeyHelp.edit_row.box_title'] = 'Edit cPanel Server';
$lang['KeyHelp.edit_row.basic_title'] = 'Basic Settings';
$lang['KeyHelp.edit_row.name_servers_title'] = 'Name Servers';
$lang['KeyHelp.edit_row.notes_title'] = 'Notes';
$lang['KeyHelp.edit_row.name_server_btn'] = 'Add Additional Name Server';
$lang['KeyHelp.edit_row.name_server_col'] = 'Name Server';
$lang['KeyHelp.edit_row.name_server_host_col'] = 'Hostname';
$lang['KeyHelp.edit_row.name_server'] = 'Name server %1$s'; // %1$s is the name server number (e.g. 3)
$lang['KeyHelp.edit_row.remove_name_server'] = 'Remove';
$lang['KeyHelp.edit_row.add_btn'] = 'Edit Server';

$lang['KeyHelp.row_meta.server_name'] = 'Server Label';
$lang['KeyHelp.row_meta.host_name'] = 'Hostname';
$lang['KeyHelp.row_meta.user_name'] = 'User Name';
$lang['KeyHelp.row_meta.key'] = 'Token (or Remote Key)';
$lang['KeyHelp.row_meta.use_ssl'] = 'Use SSL when connecting to the API (recommended)';
$lang['KeyHelp.row_meta.account_limit'] = 'Account Limit';

// Package fields
$lang['KeyHelp.package_fields.type'] = 'Account Type';
$lang['KeyHelp.package_fields.type_standard'] = 'Standard';
$lang['KeyHelp.package_fields.type_reseller'] = 'Reseller';
$lang['KeyHelp.package_fields.package'] = 'cPanel Package';
$lang['KeyHelp.package_fields.acl'] = 'Access Control List';
$lang['KeyHelp.package_fields.acl_default'] = 'Default';
$lang['KeyHelp.package_fields.account_limit'] = 'Account Limit';
$lang['KeyHelp.package_fields.dedicated_ip'] = 'Dedicated IP';
$lang['KeyHelp.package_fields.sub_domains'] = 'Enable Selling Sub-Domains';
$lang['KeyHelp.package_fields.sub_domains_enable'] = 'Enable';
$lang['KeyHelp.package_fields.sub_domains_disable'] = 'Disable';
$lang['KeyHelp.package_fields.domains_list'] = 'Available Domains List';
$lang['KeyHelp.package_fields.dedicated_ip_no'] = 'No';
$lang['KeyHelp.package_fields.dedicated_ip_yes'] = 'Yes';

// Service fields
$lang['KeyHelp.service_field.domain'] = 'Domain';
$lang['KeyHelp.service_field.sub_domain'] = 'Sub-Domain';
$lang['KeyHelp.service_field.username'] = 'Username';
$lang['KeyHelp.service_field.password'] = 'Password';
$lang['KeyHelp.service_field.confirm_password'] = 'Confirm Password';

// Service management
$lang['KeyHelp.tab_stats.info_title'] = 'Information';
$lang['KeyHelp.tab_stats.info_heading.field'] = 'Field';
$lang['KeyHelp.tab_stats.info_heading.value'] = 'Value';
$lang['KeyHelp.tab_stats.info.domain'] = 'Domain';
$lang['KeyHelp.tab_stats.info.ip'] = 'IP Address';
$lang['KeyHelp.tab_stats.bandwidth_title'] = 'Bandwidth';
$lang['KeyHelp.tab_stats.bandwidth_heading.used'] = 'Used';
$lang['KeyHelp.tab_stats.bandwidth_heading.limit'] = 'Limit';
$lang['KeyHelp.tab_stats.bandwidth_value'] = '%1$s MB'; // %1$s is the amount of bandwidth in MB
$lang['KeyHelp.tab_stats.bandwidth_unlimited'] = 'unlimited';
$lang['KeyHelp.tab_stats.disk_title'] = 'Disk';
$lang['KeyHelp.tab_stats.disk_heading.used'] = 'Used';
$lang['KeyHelp.tab_stats.disk_heading.limit'] = 'Limit';
$lang['KeyHelp.tab_stats.disk_value'] = '%1$s MB'; // %1$s is the amount of disk in MB
$lang['KeyHelp.tab_stats.disk_unlimited'] = 'unlimited';


// Client actions
$lang['KeyHelp.tab_client_actions.change_password'] = 'Change Password';
$lang['KeyHelp.tab_client_actions.field_cpanel_password'] = 'Password';
$lang['KeyHelp.tab_client_actions.field_cpanel_confirm_password'] = 'Confirm Password';
$lang['KeyHelp.tab_client_actions.field_password_submit'] = 'Update Password';


// Client Service management
$lang['KeyHelp.tab_client_stats.info_title'] = 'Information';
$lang['KeyHelp.tab_client_stats.info_heading.field'] = 'Field';
$lang['KeyHelp.tab_client_stats.info_heading.value'] = 'Value';
$lang['KeyHelp.tab_client_stats.info.domain'] = 'Domain';
$lang['KeyHelp.tab_client_stats.info.ip'] = 'IP Address';
$lang['KeyHelp.tab_client_stats.bandwidth_title'] = 'Bandwidth Usage (Month to Date)';
$lang['KeyHelp.tab_client_stats.disk_title'] = 'Disk Usage';
$lang['KeyHelp.tab_client_stats.usage'] = '(%1$s MB/%2$s MB)'; // %1$s is the amount of resource usage, %2$s is the resource usage limit
$lang['KeyHelp.tab_client_stats.usage_unlimited'] = '(%1$s MB/∞)'; // %1$s is the amount of resource usage


// Service info
$lang['KeyHelp.service_info.username'] = 'Username';
$lang['KeyHelp.service_info.password'] = 'Password';
$lang['KeyHelp.service_info.server'] = 'Server';
$lang['KeyHelp.service_info.options'] = 'Options';
$lang['KeyHelp.service_info.option_login'] = 'Log in';


// Tooltips
$lang['KeyHelp.package_fields.tooltip.domains_list'] = 'Enter a CSV list of domains that will be available to provision sub-domains for, e.g. "domain1.com,domain2.com,domain3.com"';
$lang['KeyHelp.service_field.tooltip.username'] = 'You may leave the username blank to automatically generate one.';
$lang['KeyHelp.service_field.tooltip.password'] = 'You may leave the password blank to automatically generate one.';


// Errors
$lang['KeyHelp.!error.server_name_valid'] = 'You must enter a Server Label.';
$lang['KeyHelp.!error.host_name_valid'] = 'The Hostname appears to be invalid.';
$lang['KeyHelp.!error.user_name_valid'] = 'The User Name appears to be invalid.';
$lang['KeyHelp.!error.remote_key_valid'] = 'The Token (or Remote Key) appears to be invalid.';
$lang['KeyHelp.!error.remote_key_valid_connection'] = 'A connection to the server could not be established. Please check to ensure that the Hostname, User Name, and Token (or Remote Key) are correct.';
$lang['KeyHelp.!error.account_limit_valid'] = 'Account Limit must be left blank (for unlimited accounts) or set to some integer value.';
$lang['KeyHelp.!error.name_servers_valid'] = 'One or more of the name servers entered are invalid.';
$lang['KeyHelp.!error.name_servers_count'] = 'You must define at least 2 name servers.';
$lang['KeyHelp.!error.meta[type].valid'] = 'Account type must be either standard or reseller.';
$lang['KeyHelp.!error.meta[sub_domains].valid'] = 'Enable Sub-Domains must be set to either enable or disable.';
$lang['KeyHelp.!error.meta[domains_list].valid'] = 'At least one available domain must be set and they must all represent a valid host name.';
$lang['KeyHelp.!error.meta[account_limit].valid'] = 'Account limit must be a number.';
$lang['KeyHelp.!error.meta[package].empty'] = 'A cPanel Package is required.';
$lang['KeyHelp.!error.meta[dedicated_ip].format'] = 'The dedicated IP must be set to 0 or 1.';
$lang['KeyHelp.!error.api.internal'] = 'An internal error occurred, or the server did not respond to the request.';
$lang['KeyHelp.!error.module_row.missing'] = 'An internal error occurred. The module row is unavailable.';

$lang['KeyHelp.!error.cpanel_domain.format'] = 'Please enter a valid domain name, e.g. domain.com.';
$lang['KeyHelp.!error.cpanel_domain.valid'] = 'Invalid domain name.';
$lang['KeyHelp.!error.cpanel_sub_domain.format'] = 'Please enter a valid sub-domain name, e.g. "site".';
$lang['KeyHelp.!error.cpanel_sub_domain.availability'] = 'The sub-domain provided is not available.';
$lang['KeyHelp.!error.cpanel_username.format'] = 'The username may contain only letters and numbers and may not start with a number.';
$lang['KeyHelp.!error.cpanel_username.test'] = "The username may not begin with 'test'.";
$lang['KeyHelp.!error.cpanel_username.length'] = 'The username must be between 1 and 16 characters in length.';
$lang['KeyHelp.!error.cpanel_password.valid'] = 'Password must be at least 8 characters in length.';
$lang['KeyHelp.!error.cpanel_password.matches'] = 'Password and Confirm Password do not match.';
$lang['KeyHelp.!error.configoptions[dedicated_ip].format'] = 'The dedicated IP must be set to 0 or 1.';
