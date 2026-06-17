<?php

class MK_Nav_Walker extends Walker_Nav_Menu {

    private $img_uri;
    private $total_items = 0;
    private $current_item = 0;

    public function __construct() {
        $this->img_uri = get_stylesheet_directory_uri() . '/dist/images';
    }

    // Tel het totaal aantal items voor we beginnen
    public function walk( $elements, $max_depth, ...$args ) {
        $this->total_items = count( $elements );
        $this->current_item = 0;
        return parent::walk( $elements, $max_depth, ...$args );
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $this->current_item++;
        $is_last = ( $this->current_item === $this->total_items );

        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $class_str = implode( ' ', array_filter( $classes ) );
        $li_class  = $class_str ? ' class="' . esc_attr( $class_str ) . '"' : '';

        $output .= '<li' . $li_class . '>';

        $url    = esc_url( $item->url );
        $target = $item->target ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $title  = apply_filters( 'the_title', $item->title, $item->ID );

        if ( $is_last && $depth === 0 ) {
            // Laatste top-level item: render als echte mk-btn
            $output .= '<a href="' . $url . '" class="mk-btn"' . $target . '>';
            $output .= '<span class="mk-btn__label">' . esc_html( $title ) . '</span>';
            $output .= '<span class="mk-btn__arrow-box">';
            $output .= '<img src="' . esc_url( $this->img_uri . '/Icon feather-arrow-right.svg' ) . '" alt="">';
            $output .= '</span>';
            $output .= '</a>';
        } else {
            $output .= '<a href="' . $url . '"' . $target . '>' . esc_html( $title ) . '</a>';
        }
    }
}
