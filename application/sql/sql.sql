CREATE TABLE `tag` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`created_at` datetime ,
`name` varchar(100) ,
`updated_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `tag_object` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`tag_id` bigint(20) unsigned ,
`type` varchar(100) ,
`created_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `list` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`created_at` datetime ,
`description` varchar(100) ,
`is_crm_visible` tinyint(1) ,
`is_dynamic` tinyint(1) ,
`is_public` tinyint(1) ,
`name` varchar(100) ,
`title` varchar(100) ,
`updated_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `list_membership` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`list_id` bigint(20) unsigned ,
`prospect_id` bigint(20) unsigned ,
`created_at` datetime ,
`opted_out` tinyint(1) ,
`updated_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `email_click` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`prospect_id` bigint(20) unsigned ,
`created_at` datetime ,
`drip_program_action_id` bigint(20) unsigned ,
`email_template_id` bigint(20) unsigned ,
`list_email_id` bigint(20) unsigned ,
`tracker_redirect_id` bigint(20) unsigned ,
`url` varchar(100)
) ENGINE = InnoDB;

CREATE TABLE `user` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`created_at` datetime ,
`email` varchar(100) ,
`first_name` varchar(100) ,
`job_title` varchar(100) ,
`last_name` varchar(100) ,
`role` varchar(100) ,
`updated_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `prospect_account` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`assigned_to_user_id` bigint(20) unsigned ,
`created_at` datetime ,
`updated_at` datetime ,
`field_name` varchar(100)
) ENGINE = InnoDB;

CREATE TABLE `prospect` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`address_one` varchar(100) ,
`address_two` varchar(100) ,
`annual_revenue` decimal ,
`campaign_id` bigint(20) unsigned ,
`crm_campaign_fid` bigint(20) unsigned ,
`city` varchar(100) ,
`comments` varchar(100) ,
`company` varchar(100) ,
`country` varchar(100) ,
`created_at` datetime ,
`created_by_id` bigint(20) unsigned ,
`crm_account_fid` varchar(100) ,
`crm_contact_fid` varchar(100) ,
`crm_last_sync` datetime ,
`crm_lead_fid` varchar(100) ,
`crm_owner_fid` varchar(100) ,
`department` varchar(100) ,
`email` varchar(100) ,
`employees` bigint(20) unsigned ,
`fax` bigint(20) unsigned ,
`first_name` varchar(100) ,
`industry` varchar(100) ,
`is_archived` tinyint(1) ,
`is_do_not_call` tinyint(1) ,
`is_do_not_email` tinyint(1) ,
`is_reviewed` tinyint(1) ,
`is_starred` tinyint(1) ,
`job_title` varchar(100) ,
`last_activity_at` datetime ,
`last_name` varchar(100) ,
`opted_out` tinyint(1) ,
`password` varchar(100) ,
`phone` varchar(100) ,
`prospect_account_id` bigint(20) unsigned ,
`salesforce_fid` varchar(100) ,
`salutation` varchar(100) ,
`score` bigint(20) unsigned ,
`source` varchar(100) ,
`state` varchar(100) ,
`territory` varchar(100) ,
`updated_at` datetime ,
`updated_by_id` bigint(20) unsigned ,
`user_id` bigint(20) unsigned ,
`website` varchar(100) ,
`years_in_business` bigint(20) unsigned ,
`zip` bigint(20) unsigned
) ENGINE = InnoDB;

CREATE TABLE `visitor` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`prospect_id` bigint(20) unsigned ,
`campaign_parameter` varchar(100) ,
`content_parameter` varchar(100) ,
`created_at` datetime ,
`hostname` varchar(100) ,
`ip_address` varchar(100) ,
`medium_parameter` varchar(100) ,
`page_view_count` bigint(20) unsigned ,
`source_parameter` varchar(100) ,
`term_parameter` varchar(100) ,
`updated_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `opportunity_prospect` (
`opportunity_id` bigint(20) unsigned ,
`prospect_id` bigint(20) unsigned ,
`prospect_company` varchar(100)
) ENGINE = InnoDB;

CREATE TABLE `campaign` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`name` varchar(100) ,
`cost` bigint(20) unsigned
) ENGINE = InnoDB;

CREATE TABLE `opportunity` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`campaign_id` bigint(20) unsigned ,
`closed_at` datetime ,
`created_at` datetime ,
`name` varchar(100) ,
`probability` bigint(20) unsigned ,
`stage` varchar(100) ,
`status` varchar(100) ,
`type` varchar(100) ,
`updated_at` datetime ,
`value` bigint(20) unsigned
) ENGINE = InnoDB;

CREATE TABLE `visit` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`visitor_id` bigint(20) unsigned ,
`prospect_id` bigint(20) unsigned ,
`visitor_page_view_count` bigint(20) unsigned ,
`first_visitor_page_view_at` datetime ,
`last_visitor_page_view_at` datetime ,
`duration_in_seconds` bigint(20) unsigned ,
`campaign_parameter` varchar(100) ,
`medium_parameter` varchar(100) ,
`source_parameter` varchar(100) ,
`content_parameter` varchar(100) ,
`term_parameter` varchar(100) ,
`created_at` datetime ,
`updated_at` datetime
) ENGINE = InnoDB;

CREATE TABLE `visitor_page_view` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`url` varchar(100) ,
`title` varchar(100) ,
`created_at` datetime ,
`visit_id` bigint(20) unsigned ,
`visitor_id` bigint(20) unsigned
) ENGINE = InnoDB;

CREATE TABLE `visitor_activity` (
`id` bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY ,
`campaign_id` bigint(20) unsigned ,
`prospect_id` bigint(20) unsigned ,
`visitor_id` bigint(20) unsigned ,
`email_id` varchar(100) ,
`created_at` datetime ,
`custom_redirect_id` bigint(20) unsigned ,
`details` varchar(100) ,
`email_template_id` bigint(20) unsigned ,
`file_id` bigint(20) unsigned ,
`form_handler_id` bigint(20) unsigned ,
`form_id` bigint(20) unsigned ,
`landing_page_id` bigint(20) unsigned ,
`list_email_id` bigint(20) unsigned ,
`multivariate_test_variation_id` bigint(20) unsigned ,
`paid_search_ad_id` bigint(20) unsigned ,
`site_search_query_id` bigint(20) unsigned ,
`type` bigint(20) unsigned ,
`type_name` varchar(100) ,
`updated_at` datetime
) ENGINE = InnoDB;
