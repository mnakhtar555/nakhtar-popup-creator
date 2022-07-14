<?php
/*
Title: Popup Settings
Type: popups

*/

piklist('field', array(
    'type' => 'checkbox',
    'field' => 'popupcreator_active',
    'label' => __( 'Active', 'popupcreator' ),
    'value' => 0,
    'choices'=> array(
        1=> __( 'Active', 'popupcreator' )
    )
));

piklist('field', array(
    'type' => 'text',
    'field' => 'popupcreator_display_after',
    'label' => __( 'Display Popup After', 'popupcreator' ),
    'value' => '5',
    'help'  => __( 'In Seconds', 'popupcreator' ),
));

piklist('field', array(
    'type' => 'url',
    'field' => 'popupcreator_url',
    'label' => __( 'URL', 'popupcreator' ),
));

piklist('field', array(
    'type' => 'checkbox',
    'field' => 'popupcreator_auto_hide',
    'label' => __( 'Auto Hide', 'popupcreator' ),
    'value' => 1,
    'choices'=> array(
        1=> __( 'Don\'t hide', 'popupcreator' )
    )
));

piklist('field', array(
    'type' => 'radio',
    'field' => 'popupcreator_display_exit',
    'label' => __( 'Display On Exit', 'popupcreator' ),
    'value' => 1,
    'choices'=> array(
        0=> __( 'Display On Exit', 'popupcreator' ),
        1=>__( 'Display On Page Load', 'popupcreator' )
    )
));

piklist('field', array(
    'type' => 'select',
    'field' => 'popupcreator_popup_size',
    'label' => __( 'Popup Size', 'popupcreator' ),
    'value' => 'landscape',
    'choices'=> array(
        'landscape' => __( 'Landscape', 'popupcreator' ),
        'square'    => __( 'Square', 'popupcreator' ),
        'full'      => __( 'Original', 'popupcreator' )
    )
));