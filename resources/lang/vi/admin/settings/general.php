<?php

return array(
    'ad'				        => 'Active Directory',
    'ad_domain'				    => 'Active Directory domain',
    'ad_domain_help'			=> 'This is sometimes the same as your email domain, but not always.',
    'is_ad'				        => 'Đây là một máy chủ Active Directory',
	'alert_email'				=> 'Gửi cảnh báo đến',
	'alerts_enabled'			=> 'Alerts Enabled',
	'alert_interval'			=> 'Expiring Alerts Threshold (in days)',
	'alert_inv_threshold'		=> 'Inventory Alert Threshold',
	'asset_ids'					=> 'ID tài sản',
	'auto_increment_assets'		=> 'Tạo ID tài sản tự động tăng',
	'auto_increment_prefix'		=> 'Tiền tố (tùy chọn)',
	'auto_incrementing_help'    => 'Cho phép ID tài sản tự động tăng đầu tiên được đặt cho nó',
	'backups'					=> 'Sao lưu',
	'barcode_settings'			=> 'Cài đặt mã vạch',
    'confirm_purge'			    => 'Confirm Purge',
    'confirm_purge_help'		=> 'Enter the text "DELETE" in the box below to purge your deleted records. This action cannot be undone.',
	'custom_css'				=> 'CSS tùy chỉnh',
	'custom_css_help'			=> 'Nhập bất kỳ CSS tùy chỉnh. Không bao gồm thẻ &lt;style&gt;&lt;/style&gt.',
	'default_currency'  		=> 'Tiền tệ mặc định',
	'default_eula_text'			=> 'EULA mặc định',
  'default_language'					=> 'Default Language',
	'default_eula_help_text'	=> 'Bạn cũng có thể liên kế EULA tùy chỉnh đến danh mục tài sản riêng biệt.',
    'display_asset_name'        => 'Hiển thị tên tài sản',
    'display_checkout_date'     => 'Hiển thị ngày checkout',
    'display_eol'               => 'Hiển thị EOL ở bảng',
    'display_qr'                => 'Display Square Codes',
	'display_alt_barcode'		=> 'Display 1D barcode',
	'barcode_type'				=> '2D Barcode Type',
	'alt_barcode_type'			=> '1D barcode type',
    'eula_settings'				=> 'Cài đặt EULA',
    'eula_markdown'				=> 'Đây là EULA cho phép <a href="https://help.github.com/articles/github-flavored-markdown/">Github flavored markdown</a>.',
    'general_settings'			=> 'Cài đặt thường',
	'generate_backup'			=> 'Generate Backup',
    'header_color'              => 'Màu Header',
    'info'                      => 'Các thiết lập này cho phép bạn tùy chỉnh một số khía cạnh của quá trình cài đặt.',
    'laravel'                   => 'Phiên bản Laravel',
    'ldap_enabled'              => 'LDAP enabled',
    'ldap_integration'          => 'LDAP Integration',
    'ldap_settings'             => 'LDAP Settings',
    'ldap_server'               => 'LDAP Server',
    'ldap_server_help'          => 'This should start with ldap:// (for unencrypted or TLS) or ldaps:// (for SSL)',
	'ldap_server_cert'			=> 'LDAP SSL certificate validation',
	'ldap_server_cert_ignore'	=> 'Allow invalid SSL Certificate',
	'ldap_server_cert_help'		=> 'Select this checkbox if you are using a self signed SSL cert and would like to accept an invalid SSL certificate.',
    'ldap_tls'                  => 'Use TLS',
    'ldap_tls_help'             => 'This should be checked only if you are running STARTTLS on your LDAP server. ',
    'ldap_uname'                => 'LDAP Bind Username',
    'ldap_pword'                => 'LDAP Bind Password',
    'ldap_basedn'               => 'Base Bind DN',
    'ldap_filter'               => 'LDAP Filter',
    'ldap_pw_sync'              => 'LDAP Password Sync',
    'ldap_pw_sync_help'         => 'Uncheck this box if you do not wish to keep LDAP passwords synced with local passwords. Disabling this means that your users may not be able to login if your LDAP server is unreachable for some reason.',
    'ldap_username_field'       => 'Username Field',
    'ldap_lname_field'          => 'Last Name',
    'ldap_fname_field'          => 'LDAP First Name',
    'ldap_auth_filter_query'    => 'LDAP Authentication query',
    'ldap_version'              => 'LDAP Version',
    'ldap_active_flag'          => 'LDAP Active Flag',
    'ldap_emp_num'              => 'LDAP Employee Number',
    'ldap_email'                => 'LDAP Email',
    'load_remote_text'          => 'Remote Scripts',
    'load_remote_help_text'		=> 'This Snipe-IT install can load scripts from the outside world.',
    'logo'                    	=> 'Logo',
    'full_multiple_companies_support_help_text' => 'Restricting users (including admins) assigned to companies to their company\'s assets.',
    'full_multiple_companies_support_text' => 'Full Multiple Companies Support',
    'optional'					=> 'tùy ý',
    'per_page'                  => 'Kết quả trên trang',
    'php'                       => 'Phiên bản PHP',
    'php_gd_info'               => 'Bạn phải cài đặt php-gd để hiển thị QR codes, xem cấu trúc cài đặt.',
    'php_gd_warning'            => 'PHP Image Processing và GD plugin thì CHƯA cài đặt.',
    'qr_help'                   => 'Bật QR Code đầu tiên để gán cho nó',
    'qr_text'                   => 'Chuỗi QR Code',
    'setting'                   => 'Cài đặt',
    'settings'                  => 'Cài đặt',
    'site_name'                 => 'Tên trang web',
    'slack_botname'             => 'Slack Botname',
    'slack_channel'             => 'Slack Channel',
    'slack_endpoint'            => 'Slack Endpoint',
    'slack_integration'         => 'Cài đặt Slack',
    'slack_integration_help'    => 'Slack integration is optional, however the endpoint and channel are required if you wish to use it. To configure Slack integration, you must first <a href=":slack_link" target="_new">create an incoming webhook</a> on your Slack account.',
    'snipe_version'  			=> 'Phiên bản Snipe-IT',
    'system'                    => 'Thông tin hệ thống',
    'update'                    => 'Cập nhật cài đặt',
    'value'                     => 'Giá trị',
    'brand'                     => 'Branding',
    'about_settings_title'      => 'About Settings',
    'about_settings_text'       => 'These settings let you customize certain aspects of your installation.',
    'labels_per_page'           => 'Labels per page',
    'label_dimensions'          => 'Label dimensions (inches)',
    'next_auto_tag_base'        => 'Next auto-increment',
    'page_padding'             => 'Page margins (inches)',
    'purge'                    => 'Purge Deleted Records',
    'labels_display_bgutter'    => 'Label bottom gutter',
    'labels_display_sgutter'    => 'Label side gutter',
    'labels_fontsize'           => 'Label font size',
    'labels_pagewidth'          => 'Label sheet width',
    'labels_pageheight'         => 'Label sheet height',
    'label_gutters'        => 'Label spacing (inches)',
    'page_dimensions'        => 'Page dimensions (inches)',
    'label_fields'          => 'Label visible fields',
    'inches'        => 'inches',
    'width_w'        => 'w',
    'height_h'        => 'h',
    'text_pt'        => 'pt',
    'two_factor'        => 'Two Factor Authentication',
    'two_factor_secret'        => 'Two-Factor Code',
    'two_factor_enrollment'        => 'Two-Factor Enrollment',
    'two_factor_enabled_text'        => 'Enable Two Factor',
    'two_factor_reset'        => 'Reset Two-Factor Secret',
    'two_factor_reset_help'        => 'This will force the user to enroll their device with Google Authenticator again. This can be useful if their currently enrolled device is lost or stolen. ',
    'two_factor_reset_success'          => 'Two factor device successfully reset',
    'two_factor_reset_error'          => 'Two factor device reset failed',
    'two_factor_enabled_warning'        => 'Enabling two-factor if it is not currently enabled will immediately force you to authenticate with a Google Auth enrolled device. You will have the ability to enroll your device if one is not currently enrolled.',
    'two_factor_enabled_help'        => 'This will turn on two-factor authentication using Google Authenticator.',
    'two_factor_optional'        => 'Selective (Users can enable or disable if permitted)',
    'two_factor_required'        => 'Required for all users',
    'two_factor_disabled'        => 'Disabled',
    'two_factor_enter_code'	=> 'Enter Two-Factor Code',
    'two_factor_config_complete'	=> 'Submit Code',
    'two_factor_enabled_edit_not_allowed' => 'Your administrator does not permit you to edit this setting.',
    'two_factor_enrollment_text'	=> "Two factor authentication is required, however your device has not been enrolled yet. Open your Google Authenticator app and scan the QR code below to enroll your device. Once you've enrolled your device, enter the code below",
    'require_accept_signature'      => 'Require Signature',
    'require_accept_signature_help_text'      => 'Enabling this feature will require users to physically sign off on accepting an asset.',
    'left'        => 'left',
    'right'        => 'right',
    'top'        => 'top',
    'bottom'        => 'bottom',
    'vertical'        => 'vertical',
    'horizontal'        => 'horizontal',
    'zerofill_count'        => 'Length of asset tags, including zerofill',
);
