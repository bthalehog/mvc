var classes = [
    {
        "name": "App\\Controller\\SessionController",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "sessionStart",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "initSession",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "sessionDelete",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "deleteSession",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "debugSession",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 5,
        "nbMethods": 5,
        "nbMethodsPrivate": 2,
        "nbMethodsPublic": 3,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 13,
        "ccn": 9,
        "ccnMethodMax": 7,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\CardHand",
            "App\\Cards\\DeckOfCards",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "Symfony\\Component\\HttpFoundation\\Response"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 2,
        "length": 111,
        "vocabulary": 34,
        "volume": 564.71,
        "difficulty": 9,
        "effort": 5082.38,
        "level": 0.11,
        "bugs": 0.19,
        "time": 282,
        "intelligentContent": 62.75,
        "number_operators": 27,
        "number_operands": 84,
        "number_operators_unique": 6,
        "number_operands_unique": 28,
        "cloc": 4,
        "loc": 69,
        "lloc": 65,
        "mi": 58.19,
        "mIwoC": 39.97,
        "commentWeight": 18.22,
        "kanDefect": 0.71,
        "relativeStructuralComplexity": 81,
        "relativeDataComplexity": 0.42,
        "relativeSystemComplexity": 81.42,
        "totalStructuralComplexity": 405,
        "totalDataComplexity": 2.1,
        "totalSystemComplexity": 407.1,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 6,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\ReportsController",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "showSelected",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 1,
        "nbMethods": 1,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 1,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 2,
        "ccn": 2,
        "ccnMethodMax": 2,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException",
            "Symfony\\Component\\HttpFoundation\\Response"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 1,
        "length": 19,
        "vocabulary": 15,
        "volume": 74.23,
        "difficulty": 2.55,
        "effort": 188.95,
        "level": 0.39,
        "bugs": 0.02,
        "time": 10,
        "intelligentContent": 29.16,
        "number_operators": 5,
        "number_operands": 14,
        "number_operators_unique": 4,
        "number_operands_unique": 11,
        "cloc": 1,
        "loc": 13,
        "lloc": 12,
        "mi": 83.92,
        "mIwoC": 63.09,
        "commentWeight": 20.83,
        "kanDefect": 0.22,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 1,
        "relativeSystemComplexity": 2,
        "totalStructuralComplexity": 1,
        "totalDataComplexity": 1,
        "totalSystemComplexity": 2,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 3,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\BookController",
        "interface": false,
        "abstract": false,
        "final": true,
        "methods": [
            {
                "name": "index",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "showAllBook",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "showBookById",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "createBook",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "deleteBookById",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateBookById",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "viewBookDetails",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 7,
        "nbMethods": 7,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 7,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 13,
        "ccn": 7,
        "ccnMethodMax": 3,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Doctrine\\Persistence\\ManagerRegistry",
            "App\\Repository\\BookRepository",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\BookRepository",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Request",
            "Doctrine\\Persistence\\ManagerRegistry",
            "App\\Entity\\Book",
            "Symfony\\Component\\Validator\\Constraints\\File",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Request",
            "Doctrine\\Persistence\\ManagerRegistry",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Request",
            "Doctrine\\Persistence\\ManagerRegistry",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\BookRepository"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 1,
        "length": 184,
        "vocabulary": 48,
        "volume": 1027.63,
        "difficulty": 6.86,
        "effort": 7053.3,
        "level": 0.15,
        "bugs": 0.34,
        "time": 392,
        "intelligentContent": 149.72,
        "number_operators": 33,
        "number_operands": 151,
        "number_operators_unique": 4,
        "number_operands_unique": 44,
        "cloc": 26,
        "loc": 103,
        "lloc": 77,
        "mi": 71.92,
        "mIwoC": 36.82,
        "commentWeight": 35.11,
        "kanDefect": 0.57,
        "relativeStructuralComplexity": 441,
        "relativeDataComplexity": 0.55,
        "relativeSystemComplexity": 441.55,
        "totalStructuralComplexity": 3087,
        "totalDataComplexity": 3.82,
        "totalSystemComplexity": 3090.82,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 7,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\MyControllerTwig",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "home",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "about",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "report",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "viewReport",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "number",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "apiLanding",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "currentScore",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "libraryBooks",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "libraryBookByIsbn",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 9,
        "nbMethods": 9,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 9,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 11,
        "ccn": 3,
        "ccnMethodMax": 2,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "App\\Repository\\BookRepository",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "App\\Repository\\BookRepository",
            "Doctrine\\Persistence\\ManagerRegistry"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 2,
        "length": 168,
        "vocabulary": 86,
        "volume": 1079.61,
        "difficulty": 3.32,
        "effort": 3581.15,
        "level": 0.3,
        "bugs": 0.36,
        "time": 199,
        "intelligentContent": 325.47,
        "number_operators": 32,
        "number_operands": 136,
        "number_operators_unique": 4,
        "number_operands_unique": 82,
        "cloc": 12,
        "loc": 75,
        "lloc": 63,
        "mi": 68.15,
        "mIwoC": 39.11,
        "commentWeight": 29.04,
        "kanDefect": 0.22,
        "relativeStructuralComplexity": 121,
        "relativeDataComplexity": 0.8,
        "relativeSystemComplexity": 121.8,
        "totalStructuralComplexity": 1089,
        "totalDataComplexity": 7.17,
        "totalSystemComplexity": 1096.17,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 6,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\MyControllerJson",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "jsonNumber",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "quote",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "deck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "shuffle",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "draw1",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "draw",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 6,
        "nbMethods": 6,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 6,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 10,
        "ccn": 5,
        "ccnMethodMax": 2,
        "externals": [
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "Symfony\\Component\\HttpFoundation\\JsonResponse",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\CardHand",
            "Symfony\\Component\\HttpFoundation\\JsonResponse"
        ],
        "parents": [],
        "implements": [],
        "lcom": 6,
        "length": 175,
        "vocabulary": 53,
        "volume": 1002.39,
        "difficulty": 5.76,
        "effort": 5768.83,
        "level": 0.17,
        "bugs": 0.33,
        "time": 320,
        "intelligentContent": 174.17,
        "number_operators": 34,
        "number_operands": 141,
        "number_operators_unique": 4,
        "number_operands_unique": 49,
        "cloc": 12,
        "loc": 77,
        "lloc": 65,
        "mi": 67.48,
        "mIwoC": 38.77,
        "commentWeight": 28.71,
        "kanDefect": 0.43,
        "relativeStructuralComplexity": 100,
        "relativeDataComplexity": 0.62,
        "relativeSystemComplexity": 100.62,
        "totalStructuralComplexity": 600,
        "totalDataComplexity": 3.73,
        "totalSystemComplexity": 603.73,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 5,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\TwentyOneController",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getDoc",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "twentyOne",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "start",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 3,
        "nbMethods": 3,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 3,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 22,
        "ccn": 20,
        "ccnMethodMax": 16,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Request",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\TwentyOne",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\TwentyOne",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "Symfony\\Component\\HttpFoundation\\Request"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 1,
        "length": 422,
        "vocabulary": 87,
        "volume": 2718.92,
        "difficulty": 24.46,
        "effort": 66506.27,
        "level": 0.04,
        "bugs": 0.91,
        "time": 3695,
        "intelligentContent": 111.16,
        "number_operators": 84,
        "number_operands": 338,
        "number_operators_unique": 11,
        "number_operands_unique": 76,
        "cloc": 43,
        "loc": 192,
        "lloc": 149,
        "mi": 59.32,
        "mIwoC": 25.86,
        "commentWeight": 33.46,
        "kanDefect": 0.92,
        "relativeStructuralComplexity": 1089,
        "relativeDataComplexity": 0.25,
        "relativeSystemComplexity": 1089.25,
        "totalStructuralComplexity": 3267,
        "totalDataComplexity": 0.74,
        "totalSystemComplexity": 3267.74,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 6,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\ProductController",
        "interface": false,
        "abstract": false,
        "final": true,
        "methods": [
            {
                "name": "index",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "createProduct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "showAllProduct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "showProductById",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "deleteProductById",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateProduct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "viewAllProduct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "viewProductWithMinimumValue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "showProductByMinimumValue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 9,
        "nbMethods": 9,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 9,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 11,
        "ccn": 3,
        "ccnMethodMax": 2,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Doctrine\\Persistence\\ManagerRegistry",
            "App\\Entity\\Product",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\ProductRepository",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\ProductRepository",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Doctrine\\Persistence\\ManagerRegistry",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Doctrine\\Persistence\\ManagerRegistry",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\ProductRepository",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\ProductRepository",
            "Symfony\\Component\\HttpFoundation\\Response",
            "App\\Repository\\ProductRepository"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 4,
        "length": 144,
        "vocabulary": 44,
        "volume": 786.16,
        "difficulty": 7.31,
        "effort": 5745,
        "level": 0.14,
        "bugs": 0.26,
        "time": 319,
        "intelligentContent": 107.58,
        "number_operators": 30,
        "number_operands": 114,
        "number_operators_unique": 5,
        "number_operands_unique": 39,
        "cloc": 14,
        "loc": 83,
        "lloc": 69,
        "mi": 68.92,
        "mIwoC": 39.21,
        "commentWeight": 29.71,
        "kanDefect": 0.29,
        "relativeStructuralComplexity": 289,
        "relativeDataComplexity": 0.59,
        "relativeSystemComplexity": 289.59,
        "totalStructuralComplexity": 2601,
        "totalDataComplexity": 5.28,
        "totalSystemComplexity": 2606.28,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 5,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Controller\\CardGameController",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "cardsHome",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "sortDeck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "drawCard",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "drawAmount",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "shuffleDeck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 5,
        "nbMethods": 5,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 5,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 10,
        "ccn": 6,
        "ccnMethodMax": 2,
        "externals": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\CardHand",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\CardHand",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards",
            "Symfony\\Component\\HttpFoundation\\Response",
            "Symfony\\Component\\HttpFoundation\\Session\\SessionInterface",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\DeckOfCards"
        ],
        "parents": [
            "Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController"
        ],
        "implements": [],
        "lcom": 1,
        "length": 227,
        "vocabulary": 39,
        "volume": 1199.79,
        "difficulty": 7.67,
        "effort": 9198.36,
        "level": 0.13,
        "bugs": 0.4,
        "time": 511,
        "intelligentContent": 156.49,
        "number_operators": 43,
        "number_operands": 184,
        "number_operators_unique": 3,
        "number_operands_unique": 36,
        "cloc": 15,
        "loc": 98,
        "lloc": 83,
        "mi": 64.25,
        "mIwoC": 35.77,
        "commentWeight": 28.48,
        "kanDefect": 0.5,
        "relativeStructuralComplexity": 196,
        "relativeDataComplexity": 0.76,
        "relativeSystemComplexity": 196.76,
        "totalStructuralComplexity": 980,
        "totalDataComplexity": 3.8,
        "totalSystemComplexity": 983.8,
        "package": "App\\Controller\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 5,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Repository\\LibraryRepository",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 1,
        "nbMethods": 1,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 1,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 1,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository",
            "Doctrine\\Persistence\\ManagerRegistry"
        ],
        "parents": [
            "Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository"
        ],
        "implements": [],
        "lcom": 1,
        "length": 2,
        "vocabulary": 1,
        "volume": 0,
        "difficulty": 0,
        "effort": 0,
        "level": 1,
        "bugs": 0,
        "time": 0,
        "intelligentContent": 0,
        "number_operators": 0,
        "number_operands": 2,
        "number_operators_unique": 0,
        "number_operands_unique": 1,
        "cloc": 27,
        "loc": 34,
        "lloc": 8,
        "mi": 220.1,
        "mIwoC": 171,
        "commentWeight": 49.1,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 0.5,
        "relativeSystemComplexity": 1.5,
        "totalStructuralComplexity": 1,
        "totalDataComplexity": 0.5,
        "totalSystemComplexity": 1.5,
        "package": "App\\Repository\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 2,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Repository\\ProductRepository",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "findByMinimumValue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 2,
        "nbMethods": 2,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 2,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 2,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository",
            "Doctrine\\Persistence\\ManagerRegistry"
        ],
        "parents": [
            "Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository"
        ],
        "implements": [],
        "lcom": 2,
        "length": 17,
        "vocabulary": 9,
        "volume": 53.89,
        "difficulty": 1.86,
        "effort": 100.08,
        "level": 0.54,
        "bugs": 0.02,
        "time": 6,
        "intelligentContent": 29.02,
        "number_operators": 4,
        "number_operands": 13,
        "number_operators_unique": 2,
        "number_operands_unique": 7,
        "cloc": 53,
        "loc": 71,
        "lloc": 19,
        "mi": 108.5,
        "mIwoC": 59.85,
        "commentWeight": 48.66,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 25,
        "relativeDataComplexity": 0.33,
        "relativeSystemComplexity": 25.33,
        "totalStructuralComplexity": 50,
        "totalDataComplexity": 0.67,
        "totalSystemComplexity": 50.67,
        "package": "App\\Repository\\",
        "pageRank": 0.03,
        "afferentCoupling": 1,
        "efferentCoupling": 2,
        "instability": 0.67,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Repository\\BookRepository",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "findByMinimumValue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 2,
        "nbMethods": 2,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 2,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 2,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [
            "Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository",
            "Doctrine\\Persistence\\ManagerRegistry"
        ],
        "parents": [
            "Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository"
        ],
        "implements": [],
        "lcom": 2,
        "length": 11,
        "vocabulary": 8,
        "volume": 33,
        "difficulty": 0.71,
        "effort": 23.57,
        "level": 1.4,
        "bugs": 0.01,
        "time": 1,
        "intelligentContent": 46.2,
        "number_operators": 1,
        "number_operands": 10,
        "number_operators_unique": 1,
        "number_operands_unique": 7,
        "cloc": 32,
        "loc": 43,
        "lloc": 12,
        "mi": 114.32,
        "mIwoC": 65.69,
        "commentWeight": 48.63,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 49,
        "relativeDataComplexity": 0.25,
        "relativeSystemComplexity": 49.25,
        "totalStructuralComplexity": 98,
        "totalDataComplexity": 0.5,
        "totalSystemComplexity": 98.5,
        "package": "App\\Repository\\",
        "pageRank": 0.03,
        "afferentCoupling": 2,
        "efferentCoupling": 2,
        "instability": 0.5,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Product",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getName",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setName",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getValue",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setValue",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 5,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 3,
        "nbMethodsSetters": 2,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 19,
        "vocabulary": 6,
        "volume": 49.11,
        "difficulty": 3,
        "effort": 147.34,
        "level": 0.33,
        "bugs": 0.02,
        "time": 8,
        "intelligentContent": 16.37,
        "number_operators": 7,
        "number_operands": 12,
        "number_operators_unique": 2,
        "number_operands_unique": 4,
        "cloc": 6,
        "loc": 35,
        "lloc": 29,
        "mi": 86.04,
        "mIwoC": 56.12,
        "commentWeight": 29.92,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 5.4,
        "relativeSystemComplexity": 5.4,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 27,
        "totalSystemComplexity": 27,
        "package": "App\\Entity\\",
        "pageRank": 0.02,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Library",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getTitle",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setTitle",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getIsbn",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setIsbn",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getFauthor",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setFauthor",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getImage",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setImage",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLibrary",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setLibrary",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 11,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 6,
        "nbMethodsSetters": 5,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 46,
        "vocabulary": 12,
        "volume": 164.91,
        "difficulty": 3,
        "effort": 494.72,
        "level": 0.33,
        "bugs": 0.05,
        "time": 27,
        "intelligentContent": 54.97,
        "number_operators": 16,
        "number_operands": 30,
        "number_operators_unique": 2,
        "number_operands_unique": 10,
        "cloc": 9,
        "loc": 68,
        "lloc": 59,
        "mi": 72.42,
        "mIwoC": 45.71,
        "commentWeight": 26.71,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 11.45,
        "relativeSystemComplexity": 11.45,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 126,
        "totalSystemComplexity": 126,
        "package": "App\\Entity\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Entity\\Book",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "getId",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getTitle",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setTitle",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getIsbn",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setIsbn",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAuthor",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setAuthor",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getImage",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setImage",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 9,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 5,
        "nbMethodsSetters": 4,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 0,
        "length": 38,
        "vocabulary": 10,
        "volume": 126.23,
        "difficulty": 3.13,
        "effort": 394.48,
        "level": 0.32,
        "bugs": 0.04,
        "time": 22,
        "intelligentContent": 40.39,
        "number_operators": 13,
        "number_operands": 25,
        "number_operators_unique": 2,
        "number_operands_unique": 8,
        "cloc": 8,
        "loc": 57,
        "lloc": 49,
        "mi": 75.7,
        "mIwoC": 48.28,
        "commentWeight": 27.42,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 9.44,
        "relativeSystemComplexity": 9.44,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 85,
        "totalSystemComplexity": 85,
        "package": "App\\Entity\\",
        "pageRank": 0.02,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Kernel",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [],
        "nbMethodsIncludingGettersSetters": 0,
        "nbMethods": 0,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 0,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 0,
        "ccn": 1,
        "ccnMethodMax": 0,
        "externals": [
            "Symfony\\Component\\HttpKernel\\Kernel"
        ],
        "parents": [
            "Symfony\\Component\\HttpKernel\\Kernel"
        ],
        "implements": [],
        "lcom": 0,
        "length": 0,
        "vocabulary": 0,
        "volume": 0,
        "difficulty": 0,
        "effort": 0,
        "level": 0,
        "bugs": 0,
        "time": 0,
        "intelligentContent": 0,
        "number_operators": 0,
        "number_operands": 0,
        "number_operators_unique": 0,
        "number_operands_unique": 0,
        "cloc": 0,
        "loc": 5,
        "lloc": 5,
        "mi": 171,
        "mIwoC": 171,
        "commentWeight": 0,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 0,
        "relativeSystemComplexity": 0,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 0,
        "totalSystemComplexity": 0,
        "package": "App\\",
        "pageRank": 0.02,
        "afferentCoupling": 0,
        "efferentCoupling": 1,
        "instability": 1,
        "numberOfUnitTests": 0,
        "violations": {}
    },
    {
        "name": "App\\Cards\\TwentyOne",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setCurrentPlayerIndex",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getCurrentPlayerIndex",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "addDeck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "addPlayer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setDifficulty",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setStake",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDifficulty",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getBank",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDeck",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDeckString",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getPlayer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAllPlayers",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getStake",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getCurrentPlayer",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setCurrentPlayer",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "playerCount",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setBank",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "jsonSerialize",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "cardValueIndexer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getStatus",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getWinner",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getRules",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "firstTurn",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "nextPlayer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "lastPlayer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "playerMove",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "bankMoveAI",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "autoPull",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "is21",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "compareHands",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "determineWinner",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 32,
        "nbMethods": 22,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 22,
        "nbMethodsGetter": 7,
        "nbMethodsSetters": 3,
        "wmc": 91,
        "ccn": 70,
        "ccnMethodMax": 19,
        "externals": [
            "JsonSerializable",
            "App\\Cards\\DeckOfCards",
            "App\\Cards\\CardHand",
            "App\\Cards\\CardHand",
            "OutOfBoundsException",
            "App\\Cards\\CardHand"
        ],
        "parents": [],
        "implements": [
            "JsonSerializable"
        ],
        "lcom": 3,
        "length": 643,
        "vocabulary": 105,
        "volume": 4317.26,
        "difficulty": 42.5,
        "effort": 183483.54,
        "level": 0.02,
        "bugs": 1.44,
        "time": 10194,
        "intelligentContent": 101.58,
        "number_operators": 203,
        "number_operands": 440,
        "number_operators_unique": 17,
        "number_operands_unique": 88,
        "cloc": 250,
        "loc": 630,
        "lloc": 380,
        "mi": 50.27,
        "mIwoC": 8.86,
        "commentWeight": 41.41,
        "kanDefect": 3.79,
        "relativeStructuralComplexity": 676,
        "relativeDataComplexity": 1.09,
        "relativeSystemComplexity": 677.09,
        "totalStructuralComplexity": 21632,
        "totalDataComplexity": 34.93,
        "totalSystemComplexity": 21666.93,
        "package": "App\\Cards\\",
        "pageRank": 0.03,
        "afferentCoupling": 1,
        "efferentCoupling": 4,
        "instability": 0.8,
        "numberOfUnitTests": 35,
        "violations": {}
    },
    {
        "name": "App\\Cards\\Card",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "asString",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getValue",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getGraphics",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getOrder",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getStatus",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getRelations",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 7,
        "nbMethods": 1,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 1,
        "nbMethodsGetter": 6,
        "nbMethodsSetters": 0,
        "wmc": 1,
        "ccn": 1,
        "ccnMethodMax": 1,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 39,
        "vocabulary": 12,
        "volume": 139.81,
        "difficulty": 2.8,
        "effort": 391.48,
        "level": 0.36,
        "bugs": 0.05,
        "time": 22,
        "intelligentContent": 49.93,
        "number_operators": 11,
        "number_operands": 28,
        "number_operators_unique": 2,
        "number_operands_unique": 10,
        "cloc": 19,
        "loc": 60,
        "lloc": 41,
        "mi": 87.93,
        "mIwoC": 49.66,
        "commentWeight": 38.27,
        "kanDefect": 0.15,
        "relativeStructuralComplexity": 0,
        "relativeDataComplexity": 6.43,
        "relativeSystemComplexity": 6.43,
        "totalStructuralComplexity": 0,
        "totalDataComplexity": 45,
        "totalSystemComplexity": 45,
        "package": "App\\Cards\\",
        "pageRank": 0.35,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "numberOfUnitTests": 31,
        "violations": {}
    },
    {
        "name": "App\\Cards\\CardHand",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "asString",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "asCards",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "isHead",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setHead",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHand",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setHand",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "discardHand",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getWallet",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setWallet",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setScore",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getScore",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getStatus",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setStatus",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getPlayer",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setPlayer",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getHandValue",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "sacrifice",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "cardToHand",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLastSacrifice",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLastDraw",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "jsonSerialize",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 22,
        "nbMethods": 11,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 11,
        "nbMethodsGetter": 8,
        "nbMethodsSetters": 3,
        "wmc": 17,
        "ccn": 7,
        "ccnMethodMax": 3,
        "externals": [
            "App\\Cards\\DeckOfCards"
        ],
        "parents": [],
        "implements": [],
        "lcom": 2,
        "length": 159,
        "vocabulary": 40,
        "volume": 846.19,
        "difficulty": 16.69,
        "effort": 14125.86,
        "level": 0.06,
        "bugs": 0.28,
        "time": 785,
        "intelligentContent": 50.69,
        "number_operators": 44,
        "number_operands": 115,
        "number_operators_unique": 9,
        "number_operands_unique": 31,
        "cloc": 102,
        "loc": 238,
        "lloc": 136,
        "mi": 74.47,
        "mIwoC": 32.02,
        "commentWeight": 42.45,
        "kanDefect": 1.14,
        "relativeStructuralComplexity": 36,
        "relativeDataComplexity": 1.79,
        "relativeSystemComplexity": 37.79,
        "totalStructuralComplexity": 792,
        "totalDataComplexity": 39.29,
        "totalSystemComplexity": 831.29,
        "package": "App\\Cards\\",
        "pageRank": 0.06,
        "afferentCoupling": 4,
        "efferentCoupling": 1,
        "instability": 0.2,
        "numberOfUnitTests": 19,
        "violations": {}
    },
    {
        "name": "App\\Cards\\DeckOfCards",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "asString",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "asCards",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "dealCard",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getLastDeal",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDeck",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getSize",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getType",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "sortDeck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "shuffleDeck",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "findByOrder",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "decks",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "jsonSerialize",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 13,
        "nbMethods": 10,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 10,
        "nbMethodsGetter": 3,
        "nbMethodsSetters": 0,
        "wmc": 23,
        "ccn": 14,
        "ccnMethodMax": 5,
        "externals": [
            "JsonSerializable",
            "App\\Cards\\Card",
            "App\\Cards\\Card"
        ],
        "parents": [],
        "implements": [
            "JsonSerializable"
        ],
        "lcom": 2,
        "length": 800,
        "vocabulary": 202,
        "volume": 6126.57,
        "difficulty": 25.79,
        "effort": 158026.59,
        "level": 0.04,
        "bugs": 2.04,
        "time": 8779,
        "intelligentContent": 237.52,
        "number_operators": 50,
        "number_operands": 750,
        "number_operators_unique": 13,
        "number_operands_unique": 189,
        "cloc": 33,
        "loc": 140,
        "lloc": 107,
        "mi": 61.49,
        "mIwoC": 27.33,
        "commentWeight": 34.16,
        "kanDefect": 1.28,
        "relativeStructuralComplexity": 25,
        "relativeDataComplexity": 2.4,
        "relativeSystemComplexity": 27.4,
        "totalStructuralComplexity": 325,
        "totalDataComplexity": 31.17,
        "totalSystemComplexity": 356.17,
        "package": "App\\Cards\\",
        "pageRank": 0.22,
        "afferentCoupling": 6,
        "efferentCoupling": 2,
        "instability": 0.25,
        "numberOfUnitTests": 69,
        "violations": {}
    }
]