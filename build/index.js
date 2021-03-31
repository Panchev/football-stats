/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

module.exports = _arrayLikeToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithHoles.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}

module.exports = _arrayWithHoles;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

function _arrayWithoutHoles(arr) {
  if (Array.isArray(arr)) return arrayLikeToArray(arr);
}

module.exports = _arrayWithoutHoles;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/asyncToGenerator.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }

  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}

function _asyncToGenerator(fn) {
  return function () {
    var self = this,
        args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);

      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }

      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }

      _next(undefined);
    });
  };
}

module.exports = _asyncToGenerator;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArray.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArray.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _iterableToArray(iter) {
  if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter);
}

module.exports = _iterableToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _iterableToArrayLimit(arr, i) {
  if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return;
  var _arr = [];
  var _n = true;
  var _d = false;
  var _e = undefined;

  try {
    for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
      _arr.push(_s.value);

      if (i && _arr.length === i) break;
    }
  } catch (err) {
    _d = true;
    _e = err;
  } finally {
    try {
      if (!_n && _i["return"] != null) _i["return"]();
    } finally {
      if (_d) throw _e;
    }
  }

  return _arr;
}

module.exports = _iterableToArrayLimit;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableRest.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableRest.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableRest;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableSpread.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableSpread.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _nonIterableSpread() {
  throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableSpread;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithHoles = __webpack_require__(/*! ./arrayWithHoles.js */ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js");

var iterableToArrayLimit = __webpack_require__(/*! ./iterableToArrayLimit.js */ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js");

var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

var nonIterableRest = __webpack_require__(/*! ./nonIterableRest.js */ "./node_modules/@babel/runtime/helpers/nonIterableRest.js");

function _slicedToArray(arr, i) {
  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();
}

module.exports = _slicedToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/toConsumableArray.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/toConsumableArray.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithoutHoles = __webpack_require__(/*! ./arrayWithoutHoles.js */ "./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js");

var iterableToArray = __webpack_require__(/*! ./iterableToArray.js */ "./node_modules/@babel/runtime/helpers/iterableToArray.js");

var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

var nonIterableSpread = __webpack_require__(/*! ./nonIterableSpread.js */ "./node_modules/@babel/runtime/helpers/nonIterableSpread.js");

function _toConsumableArray(arr) {
  return arrayWithoutHoles(arr) || iterableToArray(arr) || unsupportedIterableToArray(arr) || nonIterableSpread();
}

module.exports = _toConsumableArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
}

module.exports = _unsupportedIterableToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/classnames/index.js":
/*!******************************************!*\
  !*** ./node_modules/classnames/index.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
  Copyright (c) 2017 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames () {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg) && arg.length) {
				var inner = classNames.apply(null, arg);
				if (inner) {
					classes.push(inner);
				}
			} else if (argType === 'object') {
				for (var key in arg) {
					if (hasOwn.call(arg, key) && arg[key]) {
						classes.push(key);
					}
				}
			}
		}

		return classes.join(' ');
	}

	if ( true && module.exports) {
		classNames.default = classNames;
		module.exports = classNames;
	} else if (true) {
		// register as 'classnames', consistent with npm package name
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
			return classNames;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}());


/***/ }),

/***/ "./src/components/AddNotification.js":
/*!*******************************************!*\
  !*** ./src/components/AddNotification.js ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__);




var _wp$element = wp.element,
    useState = _wp$element.useState,
    useEffect = _wp$element.useEffect;

var AddNotification = function AddNotification(_ref) {
  var streaksLabels = _ref.streaksLabels,
      leagues = _ref.leagues,
      addNotification = _ref.addNotification,
      setShowAddNew = _ref.setShowAddNew,
      showAddNew = _ref.showAddNew;

  var _useState = useState([]),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState, 2),
      selectedLeague = _useState2[0],
      setSelectedLeague = _useState2[1];

  var _useState3 = useState([]),
      _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState3, 2),
      selectedTeam = _useState4[0],
      setSelectedTeam = _useState4[1];

  var _useState5 = useState(''),
      _useState6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState5, 2),
      selectedNumberOfMatches = _useState6[0],
      setSelectedNumberOfMatches = _useState6[1];

  var _useState7 = useState(''),
      _useState8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState7, 2),
      selectedEvent = _useState8[0],
      setSelectedEvent = _useState8[1];

  var _useState9 = useState([]),
      _useState10 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState9, 2),
      teams = _useState10[0],
      setTeams = _useState10[1];

  var loadTeams = /*#__PURE__*/function () {
    var _ref2 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee(event) {
      var leagueID, teamsResponse;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              leagueID = event.target.value;
              _context.next = 3;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'get_league_teams_list',
                league_id: leagueID
              }), {
                method: 'GET'
              }).then(function (res) {
                return res.json();
              }).then(function (data) {
                setTeams(data);
                setSelectedLeague(leagueID);
                setSelectedTeam('any');
              });

            case 3:
              teamsResponse = _context.sent;

            case 4:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function loadTeams(_x) {
      return _ref2.apply(this, arguments);
    };
  }();

  var saveNotification = /*#__PURE__*/function () {
    var _ref3 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee2() {
      var notificationResponse;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'add_user_notification',
                selectedTeam: selectedTeam,
                selectedNumberOfMatches: selectedNumberOfMatches,
                selectedEvent: selectedEvent,
                selectedLeague: selectedLeague
              }), {
                method: 'GET'
              }).then(function (res) {
                return res.json();
              }).then(function (data) {
                if (data.valid) {
                  addNotification(data.notification, data.message);
                  setSelectedTeam('any');
                  setSelectedLeague('any');
                  setSelectedNumberOfMatches('');
                  setSelectedEvent('');
                }
              });

            case 2:
              notificationResponse = _context2.sent;

            case 3:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    return function saveNotification() {
      return _ref3.apply(this, arguments);
    };
  }();

  var chooseLeagueHTML = 'Loading leagues...';
  var chooseTeamHTML = '';
  var chooseEventHTML = '';

  if (leagues.length) {
    chooseLeagueHTML = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("label", null, "Choose a League"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("select", {
      class: "notification-leagues",
      onChange: loadTeams
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
      value: ""
    }, "Choose"), leagues.map(function (league) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
        value: league.term_id
      }, league.name);
    })));
  }

  if (teams.length) {
    chooseTeamHTML = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("label", null, "Choose a team"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("select", {
      class: "notification-teams",
      multiselect: true,
      onChange: function onChange(e) {
        return setSelectedTeam(e.target.value);
      },
      value: selectedTeam
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
      value: "any"
    }, "Any"), teams.map(function (team) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
        value: team.ID
      }, team.post_title);
    })));
  }

  if (streaksLabels) {
    chooseEventHTML = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("label", null, "Choose event"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("select", {
      class: "number-of-matches",
      onChange: function onChange(e) {
        return setSelectedEvent(e.target.value);
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
      value: ""
    }, "Choose"), Object.keys(streaksLabels).map(function (key) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
        value: key
      }, streaksLabels[key]);
    })));
  }

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "add-notification-section"
  }, !showAddNew ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("button", {
    className: "btn btn-add-new-notification",
    onClick: function onClick() {
      setShowAddNew(true);
      setTeams([]);
      setSelectedTeam('any');
      setSelectedLeague('any');
      setSelectedNumberOfMatches('');
      setSelectedEvent('');
    }
  }, "Add New Notification") : Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", null, chooseLeagueHTML, chooseTeamHTML, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("label", null, "Choose number of matches"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("select", {
    class: "notification-number-of-matches",
    onChange: function onChange(e) {
      return setSelectedNumberOfMatches(e.target.value);
    }
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
    value: ""
  }, "Choose"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
    value: "1"
  }, "1"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
    value: "2"
  }, "2"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
    value: "3"
  }, "3"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
    value: "4"
  }, "4"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("option", {
    value: "5"
  }, "5"))), chooseEventHTML, !!selectedLeague && !!selectedTeam && !!selectedEvent && !!selectedNumberOfMatches ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("button", {
    className: "btn",
    onClick: saveNotification
  }, "Add"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("button", {
    className: "btn",
    onClick: function onClick() {
      return setShowAddNew(false);
    }
  }, "Cancel")) : ''));
};

/* harmony default export */ __webpack_exports__["default"] = (AddNotification);

/***/ }),

/***/ "./src/components/Admin/LeagueSeasons.js":
/*!***********************************************!*\
  !*** ./src/components/Admin/LeagueSeasons.js ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);





var LeagueSeasons = function LeagueSeasons(_ref) {
  var league = _ref.league;

  var fetchTeams = /*#__PURE__*/function () {
    var _ref2 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default.a.mark(function _callee(season, leagueName) {
      var teams, data;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'fetch_teams_by_league_id',
                league_api_id: season.league_id,
                parent_league_id: league.term_id,
                league_name: leagueName,
                season: season.season
              }));

            case 2:
              teams = _context.sent;
              _context.next = 5;
              return teams.json();

            case 5:
              data = _context.sent;

            case 6:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function fetchTeams(_x, _x2) {
      return _ref2.apply(this, arguments);
    };
  }();

  var fetchMatches = /*#__PURE__*/function () {
    var _ref3 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default.a.mark(function _callee2(season, leagueName) {
      var matches, data;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'fetch_matches_by_league_id',
                league_api_id: season.league_id,
                parent_league_id: league.term_id,
                league_name: leagueName,
                season: season.season
              }));

            case 2:
              matches = _context2.sent;
              _context2.next = 5;
              return matches.json();

            case 5:
              data = _context2.sent;
              console.log(data);

            case 7:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    return function fetchMatches(_x3, _x4) {
      return _ref3.apply(this, arguments);
    };
  }();

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "league-seasons"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("ul", null, league.seasons.map(function (season) {
    var leagueName = "".concat(season.name, " ( Season ").concat(season.season, "-").concat(season.season + 1, " )");
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("li", {
      key: season.league_id
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", null, leagueName), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("button", {
      onClick: function onClick() {
        return fetchTeams(season, leagueName);
      }
    }, "Fetch teams"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("button", {
      onClick: function onClick() {
        return fetchMatches(season, leagueName);
      }
    }, "Fetch matches")));
  })));
};

/* harmony default export */ __webpack_exports__["default"] = (LeagueSeasons);

/***/ }),

/***/ "./src/components/Admin/LeaguesApp.js":
/*!********************************************!*\
  !*** ./src/components/Admin/LeaguesApp.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _LeaguesLeftMenu__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./LeaguesLeftMenu */ "./src/components/Admin/LeaguesLeftMenu.js");
/* harmony import */ var _MainContent__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./MainContent */ "./src/components/Admin/MainContent.js");








var LeaguesApp = function LeaguesApp(props) {
  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_4__["useState"])([]),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState, 2),
      leagues = _useState2[0],
      setLeagues = _useState2[1];

  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_4__["useState"])(false),
      _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_1___default()(_useState3, 2),
      activeLeague = _useState4[0],
      setActiveLeague = _useState4[1];

  Object(react__WEBPACK_IMPORTED_MODULE_4__["useEffect"])(function () {
    fetchLeagues();
  }, []);

  var fetchLeagues = /*#__PURE__*/function () {
    var _ref = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee() {
      var result, data;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'admin_get_leagues_list'
              }));

            case 2:
              result = _context.sent;
              _context.next = 5;
              return result.json();

            case 5:
              data = _context.sent;
              setLeagues(data);

            case 7:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function fetchLeagues() {
      return _ref.apply(this, arguments);
    };
  }();

  var changeActiveLeague = function changeActiveLeague(id) {
    var newLeagues = leagues.map(function (league) {
      league.active = league.term_id == id ? 1 : 0;

      if (league.active) {
        setActiveLeague(league);
      }

      return league;
    });
  };

  var addLeagueSeasons = function addLeagueSeasons(league_id, seasons) {
    var newLeagues = leagues.map(function (league) {
      if (league.term_id == league_id) {
        league.seasons = seasons;
      }

      return league;
    });
    setLeagues(newLeagues);
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])("div", {
    className: "admin-leagues"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(_LeaguesLeftMenu__WEBPACK_IMPORTED_MODULE_5__["default"], {
    leagues: leagues,
    changeActiveLeague: changeActiveLeague
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_2__["createElement"])(_MainContent__WEBPACK_IMPORTED_MODULE_6__["default"], {
    league: activeLeague,
    addLeagueSeasons: addLeagueSeasons
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (LeaguesApp);

/***/ }),

/***/ "./src/components/Admin/LeaguesLeftMenu.js":
/*!*************************************************!*\
  !*** ./src/components/Admin/LeaguesLeftMenu.js ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);



var LeaguesLeftMenu = function LeaguesLeftMenu(_ref) {
  var leagues = _ref.leagues,
      changeActiveLeague = _ref.changeActiveLeague;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "admin-leagues-left-menu"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("ul", null, leagues.map(function (league) {
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", {
      onClick: function onClick() {
        return changeActiveLeague(league.term_id);
      }
    }, league.name);
  })));
};

/* harmony default export */ __webpack_exports__["default"] = (LeaguesLeftMenu);

/***/ }),

/***/ "./src/components/Admin/MainContent.js":
/*!*********************************************!*\
  !*** ./src/components/Admin/MainContent.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _LeagueSeasons__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./LeagueSeasons */ "./src/components/Admin/LeagueSeasons.js");






var MainContent = function MainContent(_ref) {
  var league = _ref.league,
      addLeagueSeasons = _ref.addLeagueSeasons;

  var fetchSeasons = /*#__PURE__*/function () {
    var _ref2 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default.a.mark(function _callee() {
      var seasons, data;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_2___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'admin_get_league_seasons',
                league_id: league.term_id
              }));

            case 2:
              seasons = _context.sent;
              _context.next = 5;
              return seasons.json();

            case 5:
              data = _context.sent;

              if (data) {
                addLeagueSeasons(league.term_id, data);
              }

            case 7:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function fetchSeasons() {
      return _ref2.apply(this, arguments);
    };
  }();

  var showFetchSeasonsBtn = typeof league.seasons !== 'undefined' && !league.seasons.length;
  var hasSeasons = typeof league.seasons !== 'undefined' && league.seasons.length;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "admin-leagues-main-content"
  }, "Active league : ", league.name, typeof league.child_leagues !== 'undefined' ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("ul", {
    className: "child-leagues-list"
  }, league.child_leagues.map(function (league) {
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("li", {
      key: league.term_id
    }, league.name);
  })) : '', Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("ul", {
    className: "league-actions"
  }, showFetchSeasonsBtn ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("li", {
    onClick: function onClick() {
      return fetchSeasons();
    }
  }, "Fetch Available Seasons") : ''), hasSeasons ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_LeagueSeasons__WEBPACK_IMPORTED_MODULE_4__["default"], {
    league: league
  }) : '');
};

/* harmony default export */ __webpack_exports__["default"] = (MainContent);

/***/ }),

/***/ "./src/components/Notification.js":
/*!****************************************!*\
  !*** ./src/components/Notification.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_1__);



var Notification = function Notification(_ref) {
  var notification = _ref.notification,
      deleteNotification = _ref.deleteNotification,
      streaksLabels = _ref.streaksLabels,
      isParent = _ref.isParent,
      isSubnotification = _ref.isSubnotification;
  var ID = notification.ID,
      team_name = notification.team_name,
      event = notification.event,
      number_of_matches = notification.number_of_matches,
      actual_number_of_matches = notification.actual_number_of_matches,
      league_name = notification.league_name;
  var isParentNotification = isParent ? 1 : 0;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", {
    key: ID,
    className: classnames__WEBPACK_IMPORTED_MODULE_1___default()({
      'active': parseInt(actual_number_of_matches) >= parseInt(number_of_matches),
      'parent-notification': isParent,
      'sub-notification': isSubnotification
    })
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", null, isParent ? "Any In ".concat(league_name) : team_name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", null, streaksLabels[event]), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", null, number_of_matches), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", null, actual_number_of_matches), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("button", {
    className: "btn",
    onClick: function onClick() {
      return deleteNotification(ID, isParentNotification);
    }
  }, "Delete"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("button", {
    className: "btn",
    onClick: function onClick() {
      return console.log('test');
    }
  }, "Modify")));
};

/* harmony default export */ __webpack_exports__["default"] = (Notification);

/***/ }),

/***/ "./src/components/NotificationsList.js":
/*!*********************************************!*\
  !*** ./src/components/NotificationsList.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Notification__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Notification */ "./src/components/Notification.js");



var NotificationsList = function NotificationsList(_ref) {
  var notifications = _ref.notifications,
      deleteNotification = _ref.deleteNotification,
      streaksLabels = _ref.streaksLabels;
  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, !notifications.length ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("h5", null, "Currently, you do not have any notifications. You can use the \"Add New Notification\" button.") : Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "profile-notifications"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("p", null, "You have ", notifications.length, " notifications"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("ul", {
    className: "profile-notifications-header"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", null, "Team"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", null, "Event"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", null, "Matches required"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", null, "Matches so far"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("li", null)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("ul", {
    className: "profile-notifications-list"
  }, notifications.map(function (notification) {
    return notification.team_id != '0' ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_Notification__WEBPACK_IMPORTED_MODULE_1__["default"], {
      streaksLabels: streaksLabels,
      notification: notification,
      deleteNotification: deleteNotification
    }) : Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(React.Fragment, null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_Notification__WEBPACK_IMPORTED_MODULE_1__["default"], {
      streaksLabels: streaksLabels,
      notification: notification,
      deleteNotification: deleteNotification,
      isParent: true
    }), notification.sub_notifications.map(function (subnotification) {
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_Notification__WEBPACK_IMPORTED_MODULE_1__["default"], {
        streaksLabels: streaksLabels,
        notification: subnotification,
        deleteNotification: deleteNotification,
        isSubnotification: true
      });
    }));
  }))));
};

/* harmony default export */ __webpack_exports__["default"] = (NotificationsList);

/***/ }),

/***/ "./src/components/Profile.js":
/*!***********************************!*\
  !*** ./src/components/Profile.js ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/toConsumableArray */ "./node_modules/@babel/runtime/helpers/toConsumableArray.js");
/* harmony import */ var _babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _AddNotification__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./AddNotification */ "./src/components/AddNotification.js");
/* harmony import */ var _NotificationsList__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./NotificationsList */ "./src/components/NotificationsList.js");





var _wp$element = wp.element,
    useState = _wp$element.useState,
    useEffect = _wp$element.useEffect;



var Profile = function Profile() {
  var _useState = useState([]),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState, 2),
      notifications = _useState2[0],
      setNotifications = _useState2[1];

  var _useState3 = useState([]),
      _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState3, 2),
      leagues = _useState4[0],
      setLeagues = _useState4[1];

  var _useState5 = useState([]),
      _useState6 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState5, 2),
      streaksLabels = _useState6[0],
      setStreaksLabels = _useState6[1];

  var _useState7 = useState(false),
      _useState8 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState7, 2),
      message = _useState8[0],
      setMessage = _useState8[1];

  var _useState9 = useState(false),
      _useState10 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_2___default()(_useState9, 2),
      showAddNew = _useState10[0],
      setShowAddNew = _useState10[1];

  useEffect( /*#__PURE__*/_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee() {
    var response;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
              action: 'fetch_profile_init_data'
            }), {
              method: 'GET'
            }).then(function (res) {
              return res.json();
            }).then(function (data) {
              setLeagues(data.leagues);
              setStreaksLabels(data.streaks_labels);
              setNotifications(data.notifications);
            });

          case 2:
            response = _context.sent;

          case 3:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  })), []);

  var deleteNotification = /*#__PURE__*/function () {
    var _ref2 = _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1___default()( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.mark(function _callee2(id, isParentNotification) {
      var response;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_4___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
                action: 'delete_user_notification',
                notification_id: id,
                is_parent: isParentNotification
              }), {
                method: 'POST'
              }).then(function (res) {
                return res.json();
              }).then(function (data) {
                if (data.valid) {
                  var newNotifications = notifications.filter(function (notification) {
                    return notification.ID != id;
                  });
                  setNotifications(newNotifications);
                }

                showMessage(data.message);
              });

            case 2:
              response = _context2.sent;

            case 3:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    return function deleteNotification(_x, _x2) {
      return _ref2.apply(this, arguments);
    };
  }();

  var addNotification = function addNotification(notification, message) {
    var newNotifications = [].concat(_babel_runtime_helpers_toConsumableArray__WEBPACK_IMPORTED_MODULE_0___default()(notifications), [notification]);
    console.log(notification);
    console.log(newNotifications);
    setNotifications(newNotifications);
    showMessage(message);
    setShowAddNew(false);
  };

  var showMessage = function showMessage(message) {
    setMessage(message);
    setTimeout(function () {
      setMessage(false);
    }, 1500);
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])("div", {
    class: "profile-content"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])("h2", null, "Profile"), !!message ? Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])("p", {
    className: "notification-message"
  }, message) : '', Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])(_NotificationsList__WEBPACK_IMPORTED_MODULE_6__["default"], {
    streaksLabels: streaksLabels,
    notifications: notifications,
    deleteNotification: deleteNotification
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__["createElement"])(_AddNotification__WEBPACK_IMPORTED_MODULE_5__["default"], {
    streaksLabels: streaksLabels,
    leagues: leagues,
    addNotification: addNotification,
    setShowAddNew: setShowAddNew,
    showAddNew: showAddNew
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (Profile);

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_Profile__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/Profile */ "./src/components/Profile.js");
/* harmony import */ var _components_Admin_LeaguesApp__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/Admin/LeaguesApp */ "./src/components/Admin/LeaguesApp.js");

var _wp$element = wp.element,
    render = _wp$element.render,
    useState = _wp$element.useState;



if (document.getElementById('profile-app')) {
  render(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_components_Profile__WEBPACK_IMPORTED_MODULE_1__["default"], null), document.getElementById("profile-app"));
}

if (document.getElementById('leagues-admin-app')) {
  render(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_components_Admin_LeaguesApp__WEBPACK_IMPORTED_MODULE_2__["default"], null), document.getElementById('leagues-admin-app'));
}

/***/ }),

/***/ "@babel/runtime/regenerator":
/*!*************************************!*\
  !*** external "regeneratorRuntime" ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["regeneratorRuntime"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["element"]; }());

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["React"]; }());

/***/ })

/******/ });
//# sourceMappingURL=index.js.map