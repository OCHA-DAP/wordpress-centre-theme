<?php foreach ( $this->get_order_elements() as $element => $label ) { ?>
<?php $this->maybe_print_element( $element ); ?>
<?php } ?>