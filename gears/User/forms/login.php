<?php

return array(
    '#name' => 'user.login',
    'login' => array(
        'label' => t('Имя пользователя или электронная почта'),
        'placeholder' => t('Укажите имя пользователя или адрес электронной почты…'),
        'type' => 'text',
        'validators' => array('Required'),
    ),
    'password' => array(
        'label' => t('Пароль'),
        'type' => 'password',
        'validators' => array(array('Length', 3), 'AlphaNum', 'Required'),
    ),
    'saveme' => array(
        'label' => t('запомнить'),
        'type' => 'checkbox',
    ),
    'buttons' => array(
        '#type' => 'group',
        '#class' => 'form-actions',
        'submit' => array(
            'label' => t('Войти'),
            'class' => 'btn btn-primary',
        ),
        'lostpassword' => array(
            'type' => 'link',
            'label' => t('Забыли пароль?'),
            'link' => l('/lostpassword'),
            'class' => 'btn btn-mini',
        ),
    )
);