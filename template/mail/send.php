<?php

/**
 * 示例:
 *
 * 'template_name' => array(
 *      'api_user' => 'xxx',
 *      'api_key' => 'xxx',             // 不建议在模板中设置api_key,请在config/config.php中统一设置
 *      'from' => 'example@example.com',
 *      'to' => 'example1@example.com;example2@example.com',
 *      'subject' => 'xxxxx',
 *      'html' => 'xxxxx',
 *      'fromname' => 'from_name',
 *      'bcc' => 'example1@example.com;example2@example.com',
 *      'cc' => 'example1@example.com;example2@example.com',
 *      'replyto' => 'example@example.com',
 *      'label' => 'label ID',          // int
 *      'headers' => '{"key1": "val1", "key2": "val2"}',
 *      'files' => 'file data',
 *      'x_smtpapi' => 'xxxxxx',
 *      'resp_email_id' => 'true',      // ('true'|'false')
 *      'use_maillist' => 'true',       // ('true'|'false')
 *      'gzip_compress' => 'true',      // ('true'|'false')
 * ),
 * ...
 */
return array();