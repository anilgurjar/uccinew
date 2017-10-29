<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::extensions('csv');
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
     //$routes->connect('/pages/*', ['controller' => 'Display', 'action' => 'index']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});
Router::prefix('api', function ($routes) {
    $routes->extensions(['json', 'xml']);
	$routes->resources(
		'Users', [
		   'map' => [
			    'login' => [
				   'action' => 'login',
				   'method' => 'POST'
			    ],
			    'signup' => [
				   'action' => 'signup',
				   'method' => 'POST'
			    ],
			    'profile' => [
			   		'action' => 'profile_data',
					'method' => 'GET'
			    ],
			    'tokenupdate' => [
			   		'action' => 'TokenUpdate',
					'method' => 'POST'
			    ],
			    'profileupdate' => [
			   		'action' => 'ProfileUpdate',
					'method' => 'POST'
			    ],
			    'companyupdate' => [
			   		'action' => 'CompanyUpdate',
					'method' => 'POST'
			    ],
			    'nomineeupdate' => [
			   		'action' => 'NomineeUpdate',
					'method' => 'POST'
			    ],
				'sociallogin' => [
			   		'action' => 'SocialLogin',
					'method' => 'POST'
			    ],
				'homescreen' => [
			   		'action' => 'homescreen',
					'method' => 'GET'
			    ],
				'list' => [
			   		'action' => 'memberList',
					'method' => 'GET'
			    ],
				'search' => [
			   		'action' => 'memberSearch',
					'method' => 'GET'
			    ],
				'memberdata' => [
			   		'action' => 'memberData',
					'method' => 'GET'
			    ],
				'weblogin' => [
			   		'action' => 'weblogin',
					'method' => 'POST'
			    ]
				
		    ]
		]
	);

	$routes->resources(
		'MemberRequests', [
		   'map' => [
			    'member' => [
				   'action' => 'member',
				   'method' => 'POST'
			    ],
			   'member_types' => [
				   'action' => 'MemberTypes',
				   'method' => 'GET'
				]
		   ]
		]
	);
	
	$routes->resources(
		'Events', [
		   'map' => [
			    'eventlist' => [
				   'action' => 'EventList',
				   'method' => 'GET'
			    ],
				'eventdetails'=> [
				   'action' => 'EventDetails',
				   'method' => 'GET'
			    ],
				'search'=> [
				   'action' => 'EventSearch',
				   'method' => 'GET'
			    ]				
		   ]
		]
	);
	
	$routes->resources(
		'EventAttendees', [
			'map' => [
				'event_attend_or_not'=> [
				   'action' => 'EventAttendorNot',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'NewsLetters', [
			'map' => [
				'list'=> [
				   'action' => 'newsletterlist',
				   'method' => 'GET'
			    ],
				'search'=> [
				   'action' => 'NewsSearch',
				   'method' => 'GET'
			    ]
				
			]
		]
	);
	
	$routes->resources(
		'Blogs', [
			'map' => [
				'list'=> [
				   'action' => 'BlogList',
				   'method' => 'GET'
			    ],
				'details'=> [
					'action' => 'blogDetails',
					'method' => 'GET'
				],
				'search'=> [
					'action' => 'BlogSearch',
					'method' => 'GET'
				]
			]
		]
	);
	
	$routes->resources(
		'BlogLikes', [
			'map' => [
				'action'=> [
				   'action' => 'LikeAction',
				   'method' => 'POST'
			    ]
			]
		]
	);
	
	$routes->resources(
		'Galleries', [
			'map' => [
				'list'=> [
				   'action' => 'GalleryList',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'GalleryPhotos', [
			'map' => [
				'details'=> [
				   'action' => 'GalleryDetails',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'Suggestions', [
			'map' => [
				'add'=> [
				   'action' => 'add',
				   'method' => 'POST'
			    ]
			]
		]
	);
	
	$routes->resources(
		'FacilityBookings', [
			'map' => [
				'add'=> [
				   'action' => 'add',
				   'method' => 'POST'
			    ]
			]
		]
	);
	
	$routes->resources(
		'Venues', [
			'map' => [
				'view'=> [
				   'action' => 'index',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'ExecutiveMembers', [
			'map' => [
				'view'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'MasterFinancialYears', [
			'map' => [
				'view'=> [
				   'action' => 'index',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'IndustrialGrievances', [
			'map' => [
				'add'=> [
				   'action' => 'add',
				   'method' => 'POST'
			    ],
				'data'=> [
				   'action' => 'index',
				   'method' => 'GET'
			    ],
				'view'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'Abouts', [
			'map' => [
				'aboutus'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'Projects', [
			'map' => [
				'projectlist'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	$routes->resources(
		'HomeMenus', [
			'map' => [
				'menu'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	$routes->resources(
		'Advertisements', [
			'map' => [
				'list'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'AffilationRegistrations', [
			'map' => [
				'list'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'subCommittees', [
			'map' => [
				'view'=> [
				   'action' => 'view',
				   'method' => 'GET'
			    ]
			]
		]
	);
	
	$routes->resources(
		'SurveyQuestions', [
		   'map' => [
			    'survey' => [
				   'action' => 'survey',
				   'method' => 'GET'
			    ],
				'surveyadd'=> [
				   'action' => 'surveyadd',
				   'method' => 'POST'
			    ]
		   ]
		]
	);
	
	$routes->resources(
		'Companies', [
		   'map' => [
			    'nonmemberexporter' => [
				   'action' => 'nonmemberexporter',
				   'method' => 'POST'
			    ],
			   'nonmemberdata' => [
				   'action' => 'nonmemberdata',
				   'method' => 'GET'
				],
				'nonmemberwpsuccess' => [
				   'action' => 'nonmemberwpsuccess',
				   'method' => 'GET'
				],
				'nonmemberwpfail' => [
				   'action' => 'nonmemberwpfail',
				   'method' => 'GET'
				]
		   ]
		]
	);
	
});
/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
