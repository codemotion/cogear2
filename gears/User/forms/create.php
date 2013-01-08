<?php

return array(
    'name' => 'user.create',
    'elements' => array(
        'login' => array(
            'label' => t('Имя пользователя'),
            'type' => 'text',
            'validators' => array(array('Length', 3), 'AlphaNum', 'Required', 'User_Validate_Login'),
        ),
        'name' => array(
            'label' => t('Реальное имя'),
            'type' => 'text',
            'access' => access('user_edit_realname'),
            'validators' => array(array('Length', 5), 'Name'),
        ),
        'password' => array(
            'label' => t('Пароль'),
            'type' => 'text',
            'validators' => array(array('Length', 3), 'AlphaNum', 'Required')
        ),
        'email' => array(
            'label' => t('Электронная почта'),
            'type' => 'text',
            'placeholder' => t('Укажите адрес электронной почты…'),
            'validators' => array('Email', 'Required', 'User_Validate_EmailReg'),
        ),
        'actions' => array(
            'elements' => array(
                'save' => array(
                    'name' => 'save',
                    'type' => 'submit',
                    'label' => t('Создать'),
                )
            )
        )
    ),
);