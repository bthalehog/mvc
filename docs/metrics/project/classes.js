var classes = [
    {
        "name": "App\\Proj\\RoomHandler",
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
                "name": "getRoomData",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getAllRooms",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "move",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 4,
        "nbMethods": 4,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 4,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 17,
        "ccn": 14,
        "ccnMethodMax": 8,
        "externals": [
            "App\\Proj\\StorageHandler"
        ],
        "parents": [],
        "implements": [],
        "lcom": 3,
        "length": 109,
        "vocabulary": 34,
        "volume": 554.53,
        "difficulty": 6.38,
        "effort": 3537.54,
        "level": 0.16,
        "bugs": 0.18,
        "time": 197,
        "intelligentContent": 86.93,
        "number_operators": 35,
        "number_operands": 74,
        "number_operators_unique": 5,
        "number_operands_unique": 29,
        "cloc": 10,
        "loc": 72,
        "lloc": 62,
        "mi": 67.1,
        "mIwoC": 39.8,
        "commentWeight": 27.29,
        "kanDefect": 1.54,
        "relativeStructuralComplexity": 4,
        "relativeDataComplexity": 3.67,
        "relativeSystemComplexity": 7.67,
        "totalStructuralComplexity": 16,
        "totalDataComplexity": 14.67,
        "totalSystemComplexity": 30.67,
        "package": "App\\Proj\\",
        "pageRank": 0.1,
        "afferentCoupling": 0,
        "efferentCoupling": 1,
        "instability": 1,
        "violations": {}
    },
    {
        "name": "App\\Proj\\StorageHandler",
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
                "name": "initializeDatabase",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "saveGameData",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getGameData",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getDatabaseFromStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateDatabaseInStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getInventoryFromStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateRoom",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateInventory",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateObjectStates",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "updateItemStatus",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getRoomFromStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getRoomData",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getRoomStatusFromStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "removeItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "clearSaveFile",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "clearStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "clearCache",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setObjectState",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getObjectState",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "matchItemState",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "setItemStatus",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getItemStatus",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "findItemFromStorage",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "isSelected",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 27,
        "nbMethods": 27,
        "nbMethodsPrivate": 1,
        "nbMethodsPublic": 26,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 0,
        "wmc": 73,
        "ccn": 47,
        "ccnMethodMax": 8,
        "externals": [
            "App\\Proj\\Inventory",
            "App\\Proj\\Inventory",
            "App\\Proj\\Inventory",
            "App\\Proj\\Inventory",
            "App\\Proj\\Inventory",
            "Symfony\\Component\\Cache\\Adapter\\FilesystemAdapter",
            "App\\Proj\\StorageHandler"
        ],
        "parents": [],
        "implements": [],
        "lcom": 26,
        "length": 431,
        "vocabulary": 51,
        "volume": 2444.82,
        "difficulty": 30.43,
        "effort": 74392.24,
        "level": 0.03,
        "bugs": 0.81,
        "time": 4133,
        "intelligentContent": 80.35,
        "number_operators": 147,
        "number_operands": 284,
        "number_operators_unique": 9,
        "number_operands_unique": 42,
        "cloc": 64,
        "loc": 302,
        "lloc": 238,
        "mi": 50.82,
        "mIwoC": 18.11,
        "commentWeight": 32.71,
        "kanDefect": 3.3,
        "relativeStructuralComplexity": 49,
        "relativeDataComplexity": 4.14,
        "relativeSystemComplexity": 53.14,
        "totalStructuralComplexity": 1323,
        "totalDataComplexity": 111.88,
        "totalSystemComplexity": 1434.88,
        "package": "App\\Proj\\",
        "pageRank": 0.36,
        "afferentCoupling": 3,
        "efferentCoupling": 4,
        "instability": 0.57,
        "violations": {}
    },
    {
        "name": "App\\Proj\\Inventory",
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
                "name": "getAllItems",
                "role": "getter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "addItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "removeItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "select",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "getSelectedItem",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "clearInventory",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 7,
        "nbMethods": 6,
        "nbMethodsPrivate": 0,
        "nbMethodsPublic": 6,
        "nbMethodsGetter": 1,
        "nbMethodsSetters": 0,
        "wmc": 16,
        "ccn": 11,
        "ccnMethodMax": 5,
        "externals": [],
        "parents": [],
        "implements": [],
        "lcom": 1,
        "length": 84,
        "vocabulary": 16,
        "volume": 336,
        "difficulty": 26,
        "effort": 8736,
        "level": 0.04,
        "bugs": 0.11,
        "time": 485,
        "intelligentContent": 12.92,
        "number_operators": 32,
        "number_operands": 52,
        "number_operators_unique": 8,
        "number_operands_unique": 8,
        "cloc": 13,
        "loc": 78,
        "lloc": 65,
        "mi": 70.84,
        "mIwoC": 41.28,
        "commentWeight": 29.56,
        "kanDefect": 1.03,
        "relativeStructuralComplexity": 1,
        "relativeDataComplexity": 4.29,
        "relativeSystemComplexity": 5.29,
        "totalStructuralComplexity": 7,
        "totalDataComplexity": 30,
        "totalSystemComplexity": 37,
        "package": "App\\Proj\\",
        "pageRank": 0.54,
        "afferentCoupling": 1,
        "efferentCoupling": 0,
        "instability": 0,
        "violations": {}
    }
]