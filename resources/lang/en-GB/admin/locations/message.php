<?php

return array(

    'does_not_exist' => 'Location does not exist.',
<<<<<<< HEAD
    'assoc_users'    => 'This location is not currently deletable because it is the location of record for at least one asset or user, has assets assigned to it, or is the parent location of another location. Please update your models to no longer reference this company and try again. ',
    'assoc_assets'	 => 'This location is currently associated with at least one asset and cannot be deleted. Please update your assets to no longer reference this location and try again. ',
    'assoc_child_loc'	 => 'This location is currently the parent of at least one child location and cannot be deleted. Please update your locations to no longer reference this location and try again. ',
    'assigned_assets' => 'Assigned Assets',
    'current_location' => 'Current Location',
=======
    'assoc_users'	 => 'This location is currently associated with at least one user and cannot be deleted. Please update your users to no longer reference this location and try again. ',
    'assoc_assets'	 => 'This location is currently associated with at least one asset and cannot be deleted. Please update your assets to no longer reference this location and try again. ',
    'assoc_child_loc'	 => 'This location is currently the parent of at least one child location and cannot be deleted. Please update your locations to no longer reference this location and try again. ',
>>>>>>> 64747d0fb (updates based on review)


    'create' => array(
        'error'   => 'Location was not created, please try again.',
        'success' => 'Location created successfully.'
    ),

    'update' => array(
        'error'   => 'Location was not updated, please try again',
        'success' => 'Location updated successfully.'
    ),

    'delete' => array(
        'confirm'   	=> 'Are you sure you wish to delete this location?',
        'error'   => 'There was an issue deleting the location. Please try again.',
        'success' => 'The location was deleted successfully.'
    )

);
