<?php

return [
    'email' => 'E-mail',
    'my_account' => 'My Account',
    'name' => 'Name',
    'profile' => [
        'label' => 'Profile Information',
        'hint' => 'Update your account\'s profile information and email address.',
        'updated' => 'Profile information updated',
    ],
    'password' => [
        'forgot' => 'Forgot your password?',
        'label' => 'Password',
        'update' => 'Update Password',
        'hint' => 'Ensure your account is using a long, random password to stay secure.',
        'updated' => 'Account password updated',
        'current' => 'Current Password',
        'new' => 'New Password',
        'confirm' => 'Confirm Password',
        'confirm_hint' => 'This is a secure area of the application. Please confirm your password before continuing.'
    ],
    '2fa' => [
        'configure' => 'Configure Two Factor Authentication',
        'disable' => 'Disable Two Factor Authentication',
        'disabled' => [
            'label' => 'Two Factor Authentication disabled',
            'hint' => 'You\'re account <strong class="tw-text-danger-500">is NOT protected</strong> with Two Factor Authentication.',
        ],
        'enable' => 'Enable Two Factor Authentication',
        'enabled' => [
            'label' => 'Two Factor Authentication enabled',
            'hint' => 'You\'re account <strong class="tw-text-success-500">is protected</strong> with Two Factor Authentication.',
        ],
        'hint' => 'Add additional security to you r account using two factor authentication.',
        'label' => 'Two Factor Authentication',
        'read_qr_code' => [
            'label' => 'Read the QR Code',
            'hint' => 'Use your phone\'s authenticator app to read the following QR code then click ',
        ],
        'recovery_codes' => [
            'enter' => 'Enter one of your account\'s Recovery Codes',
            'label' => 'Recovery Codes',
            'hint' => 'Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.',
            'show' => 'Show Recovery Codes',
            'regenerate' => 'Regenerate Recovery Codes',
            'renewed' => 'Your recovery codes have been renewed'
        ],
        'unconfirmed' => 'Read the QR Code to finish setting up Two Factor Authentication',
        'verification_code' => [
            'label' => 'Verification Code',
            'hint' => 'Enter the verification code on your phone\'s authenticator app.'
        ]
    ]
];
