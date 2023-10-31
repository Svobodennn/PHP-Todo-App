<?php


function status($status)
{
    if ($status === 'a') {

        return [
            'title' => 'Active',
            'badge' => 'success',
            'icon' => 'fa fa-check'
        ];

    }
    elseif ($status === 'p'){
        return [
            'title' => 'Passive',
            'badge' => 'danger',
            'icon' => 'fa fa-trash'
        ];
    }
    elseif ($status === 'o'){
        return [
            'title' => 'Ongoing',
            'badge' => 'warning',
            'icon' => 'fa fa-info'
        ];
    }
}