<?php

namespace Join;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Router\Http\Literal;

return [
    'router' => [
        'routes' => [

            'barcode' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/barcode[/:type/:label]',
                    'constraints' => [
                        'type' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'label' => '[a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        Controller\CategoriasController::class,
                        'action' => 'criar',
                    ],
                ],
            ],

            'join-categoria' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/categorias',
                    'defaults' => [
                        'controller' => Controller\CategoriasController::class,
                        'action'=> 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-z][a-zA-Z_]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),

            ],
            'join-produto' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/produtos',
                    'defaults' => [
                        'controller' => Controller\ProdutosController::class,
                        'action'=> 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-z][a-zA-Z_]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),

            ],

        ]
    ],

    'controllers' => [
        'factories' => [
            Controller\CategoriasController::class => InvokableFactory::class,
            Controller\ProdutosController::class => InvokableFactory::class
        ]
    ],

    
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];
