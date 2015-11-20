<?php
/**
 * ZF3 book Vote my Pizza Example Application
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/zf3buch/vote-my-pizza
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    1  => [
        'id'          => '1',
        'name'        => 'Pizza Mista',
        'image'       => '/assets/custom/pizza/001.jpg',
        'pos'         => 10,
        'neg'         => 3,
        'rate'        => 10 / (10 + 3),
        'restaurants' => [
            1 => [
                'date'  => '2015-11-19 15:31:34',
                'name'  => 'Luigis Pizza Service',
                'price' => '7.95',
            ],
        ],
    ],
    2  => [
        'id'          => '2',
        'name'        => 'Pizza Oliva',
        'image'       => '/assets/custom/pizza/002.jpg',
        'pos'         => 12,
        'neg'         => 5,
        'rate'        => 12 / (12 + 5),
        'restaurants' => [
            2 => [
                'date'  => '2015-11-19 15:32:59',
                'name'  => 'Luigis Pizza Service',
                'price' => '6.95',
            ],
        ],
    ],
    3  => [
        'id'          => '3',
        'name'        => 'Pizza Margherita',
        'image'       => '/assets/custom/pizza/003.jpg',
        'pos'         => 5,
        'neg'         => 8,
        'rate'        => 5 / (5 + 8),
        'restaurants' => [
            3  => [
                'date'  => '2015-11-19 15:33:12',
                'name'  => 'Luigis Pizza Service',
                'price' => '5.95',
            ],
            14 => [
                'date'  => '2015-11-19 15:35:17',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '6.50',
            ],
        ],
    ],
    4  => [
        'id'          => '4',
        'name'        => 'Pizza Gambero',
        'image'       => '/assets/custom/pizza/004.jpg',
        'pos'         => 3,
        'neg'         => 11,
        'rate'        => 3 / (3 + 11),
        'restaurants' => [
            4 => [
                'date'  => '2015-11-19 15:33:21',
                'name'  => 'Luigis Pizza Service',
                'price' => '9.95',
            ],
        ],
    ],
    5  => [
        'id'          => '5',
        'name'        => 'Pizza Verdura',
        'image'       => '/assets/custom/pizza/005.jpg',
        'pos'         => 6,
        'neg'         => 7,
        'rate'        => 6 / (6 + 7),
        'restaurants' => [],
    ],
    6  => [
        'id'          => '6',
        'name'        => 'Pizza Peperone',
        'image'       => '/assets/custom/pizza/006.jpg',
        'pos'         => 2,
        'neg'         => 9,
        'rate'        => 2 / (2 + 9),
        'restaurants' => [
            5 => [
                'date'  => '2015-11-19 15:33:31',
                'name'  => 'Luigis Pizza Service',
                'price' => '7.95',
            ],
        ],
    ],
    7  => [
        'id'          => '7',
        'name'        => 'Pizza Vegetariana',
        'image'       => '/assets/custom/pizza/007.jpg',
        'pos'         => 4,
        'neg'         => 13,
        'rate'        => 4 / (4 + 13),
        'restaurants' => [
            6  => [
                'date'  => '2015-11-19 15:33:45',
                'name'  => 'Luigis Pizza Service',
                'price' => '6.95',
            ],
            15 => [
                'date'  => '2015-11-19 15:37:10',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '7.50',
            ],
        ],
    ],
    8  => [
        'id'          => '8',
        'name'        => 'Pizza Salame',
        'image'       => '/assets/custom/pizza/008.jpg',
        'pos'         => 15,
        'neg'         => 3,
        'rate'        => 15 / (15 + 3),
        'restaurants' => [
            16 => [
                'date'  => '2015-11-19 15:37:28',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '6.50',
            ],
        ],
    ],
    9  => [
        'id'          => '9',
        'name'        => 'Pizza Funghi e Oliva',
        'image'       => '/assets/custom/pizza/009.jpg',
        'pos'         => 6,
        'neg'         => 8,
        'rate'        => 6 / (6 + 8),
        'restaurants' => [
            7 => [
                'date'  => '2015-11-19 15:33:53',
                'name'  => 'Luigis Pizza Service',
                'price' => '6.95',
            ],
        ],
    ],
    10 => [
        'id'          => '10',
        'name'        => 'Pizza Salame e Pomodoro',
        'image'       => '/assets/custom/pizza/010.jpg',
        'pos'         => 8,
        'neg'         => 5,
        'rate'        => 8 / (8 + 5),
        'restaurants' => [
            8  => [
                'date'  => '2015-11-19 15:34:01',
                'name'  => 'Luigis Pizza Service',
                'price' => '6.95',
            ],
            17 => [
                'date'  => '2015-11-19 15:37:43',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '7.50',
            ],
        ],
    ],
    11 => [
        'id'          => '11',
        'name'        => 'Pizza Frutti di Mare',
        'image'       => '/assets/custom/pizza/011.jpg',
        'pos'         => 7,
        'neg'         => 9,
        'rate'        => 7 / (7 + 9),
        'restaurants' => [
            18 => [
                'date'  => '2015-11-19 15:38:48',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '9.50',
            ],
        ],
    ],
    12 => [
        'id'          => '12',
        'name'        => 'Pizza Salame e Speciale',
        'image'       => '/assets/custom/pizza/012.jpg',
        'pos'         => 15,
        'neg'         => 1,
        'rate'        => 15 / (15 + 1),
        'restaurants' => [
            9  => [
                'date'  => '2015-11-19 15:34:11',
                'name'  => 'Luigis Pizza Service',
                'price' => '8.95',
            ],
            19 => [
                'date'  => '2015-11-19 15:39:05',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '7.50',
            ],
        ],
    ],
    13 => [
        'id'          => '13',
        'name'        => 'Pizza Prosciutto',
        'image'       => '/assets/custom/pizza/013.jpg',
        'pos'         => 9,
        'neg'         => 4,
        'rate'        => 9 / (9 + 4),
        'restaurants' => [
            10 => [
                'date'  => '2015-11-19 15:34:20',
                'name'  => 'Luigis Pizza Service',
                'price' => '7.95',
            ],
            20 => [
                'date'  => '2015-11-19 15:39:16',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '7.50',
            ],
        ],
    ],
    14 => [
        'id'          => '14',
        'name'        => 'Pizza Melanzane',
        'image'       => '/assets/custom/pizza/014.jpg',
        'pos'         => 8,
        'neg'         => 8,
        'rate'        => 8 / (8 + 8),
        'restaurants' => [
            11 => [
                'date'  => '2015-11-19 15:34:31',
                'name'  => 'Luigis Pizza Service',
                'price' => '6.95',
            ],
        ],
    ],
    15 => [
        'id'          => '15',
        'name'        => 'Pizza Salame e Prosciutto',
        'image'       => '/assets/custom/pizza/015.jpg',
        'pos'         => 13,
        'neg'         => 5,
        'rate'        => 13 / (13 + 5),
        'restaurants' => [
            12 => [
                'date'  => '2015-11-19 15:34:36',
                'name'  => 'Luigis Pizza Service',
                'price' => '8.95',
            ],
            21 => [
                'date'  => '2015-11-19 15:39:33',
                'name'  => 'Alessandros Pizza Flitzer',
                'price' => '7.50',
            ],
        ],
    ],
    16 => [
        'id'          => '16',
        'name'        => 'Pizza alla Mamma',
        'image'       => '/assets/custom/pizza/016.jpg',
        'pos'         => 9,
        'neg'         => 7,
        'rate'        => 9 / (9 + 7),
        'restaurants' => [
            13 => [
                'date'  => '2015-11-19 15:34:43',
                'name'  => 'Luigis Pizza Service',
                'price' => '9.95',
            ],
        ],
    ],
];