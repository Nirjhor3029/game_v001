<?php


return [
    'financialOption' => [
        [
            'name' => 'Revenue from A',
            'status' => 1
        ],
        [
            'name' => 'Revenue from B',
            'status' => 1
        ],
        [
            'name' => 'Lunch cost',
            'status' => 1
        ],
        [
            'name' => 'Labour cost',
            'status' => 1
        ],
        [
            'name' => 'salaries expenses',
            'status' => 0
        ]
    ],
    'type' =>[
        /*[
            'id' => 1,
            'name' => 'admin'
        ],
        [
            'id' => 2,
            'name' => 'teacher'
        ],*/
        [
            'id' => 3,
            'name' => 'student'
        ],
    ],
    'game2' =>[
        'options' => [
            [
                'id' => 1,
                'name' => 'Product Range'
            ],
            [
                'id' => 2,
                'name' => 'Price'
            ],
            [
                'id' => 3,
                'name' => 'Location Breadth'
            ],
            [
                'id' => 4,
                'name' => 'Vertical Integration'
            ],
            [
                'id' => 5,
                'name' => 'Product Quality'
            ],
            [
                'id' => 6,
                'name' => 'Dining Option'
            ],
            [
                'id' => 7,
                'name' => 'types of food'
            ],
        ],
        'promotion_options' => [
            [
                'id' => 1,
                'name' => 'discount_within_store',
                'required_amount' => 3.5,
            ],
            [
                'id' => 2,
                'name' => 'discount_through_delivery_services',
                'required_amount' => 2,
            ],
            [
                'id' => 3,
                'name' => 'advertising_through_social_media',
                'required_amount' => 2.5,
            ],
            [
                'id' => 4,
                'name' => 'branding',
                'required_amount' => 5,
            ],
            [
                'id' => 5,
                'name' => 'other',
                'required_amount' => 8,
            ],
        ],

        'asset' => [
            'invest' => 20,
        ],
    ]
];
