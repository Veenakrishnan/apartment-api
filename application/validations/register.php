<?php
$register = array(
    array(
        "field" => "name",
        "label" => "Username",
        "rules" => "trim|required|alpha_numeric_spaces",
        "errors" => array(
            "required" => 'You must provide a %s.',
        ),
    ),
    array(
        "field" => "mobile",
        "label" => "Mobile number",
        "rules" => "trim|required|numeric|is_unique[registration.mobile]|exact_length[10]",
        "errors" => array(
            "required" => 'You must provide a %s.',
            "valid_email" => "Invalid %s",
            "is_unique" => "%s already registered",
            "exact_length" => "Invalid %s"
        ),
    ),
    array(
        "field" => "email",
        "label" => "Email",
        "rules" => "trim|required|valid_email|is_unique[registration.email]",
        "errors" => array(
            "required" => 'You must provide a %s.',
            "valid_email" => "Invalid email",
            "is_unique" => "%s already registered"
        ),
    ),   
    array(
        "field" => "password",
        "label" => "Password",
        "rules" => "trim|required|min_length[8]",
        "errors" => array(
            "required" => 'You must provide a %s.',
            "valid_email" => "Invalid %s",
            "is_unique" => "%s already registered",
            "min_length" => "%s must have minimum 8 charecters"
        ),
    ),
    array(
        "field" => "address",
        "label" => "Address",
        "rules" => "trim|required",
        "errors" => array(
            "required" => "You must provide a %s.",
        ),
    ),
);