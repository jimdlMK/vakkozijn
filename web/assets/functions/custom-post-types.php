<?php

function mk_cpt_deuren_kozijnen() {
    register_post_type('deuren-kozijnen', [
        'public'        => true,
        'has_archive'   => false,
        'show_in_rest'  => false, // klassieke editor
        'menu_icon'     => 'dashicons-admin-home',
        'supports'      => ['title', 'thumbnail', 'editor'],
        'rewrite'       => ['slug' => 'deuren-kozijnen'],
        'labels'        => [
            'name'               => 'Deuren & Kozijnen',
            'singular_name'      => 'Deur / Kozijn',
            'add_new'            => 'Nieuwe toevoegen',
            'add_new_item'       => 'Nieuwe deur/kozijn toevoegen',
            'edit_item'          => 'Bewerken',
            'new_item'           => 'Nieuw',
            'view_item'          => 'Bekijken',
            'search_items'       => 'Zoeken',
            'not_found'          => 'Niets gevonden',
            'not_found_in_trash' => 'Niets gevonden in de prullenbak',
            'menu_name'          => 'Deuren & Kozijnen',
        ],
    ]);
}
add_action('init', 'mk_cpt_deuren_kozijnen');


function mk_cpt_projecten() {
    register_post_type('projecten', [
        'public'        => true,
        'has_archive'   => false,
        'show_in_rest'  => false,
        'menu_icon'     => 'dashicons-building',
        'supports'      => ['title', 'thumbnail', 'editor'],
        'rewrite'       => ['slug' => 'projecten'],
        'labels'        => [
            'name'               => 'Projecten',
            'singular_name'      => 'Project',
            'add_new'            => 'Nieuw toevoegen',
            'add_new_item'       => 'Nieuw project toevoegen',
            'edit_item'          => 'Bewerken',
            'new_item'           => 'Nieuw',
            'view_item'          => 'Bekijken',
            'search_items'       => 'Zoeken',
            'not_found'          => 'Niets gevonden',
            'not_found_in_trash' => 'Niets gevonden in de prullenbak',
            'menu_name'          => 'Projecten',
        ],
    ]);

    register_taxonomy('project-categorie', 'projecten', [
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'project-categorie'],
        'labels'            => [
            'name'          => 'Project categorieën',
            'singular_name' => 'Project categorie',
            'add_new_item'  => 'Nieuwe categorie toevoegen',
            'edit_item'     => 'Categorie bewerken',
            'menu_name'     => 'Categorieën',
        ],
    ]);
}
add_action('init', 'mk_cpt_projecten');
