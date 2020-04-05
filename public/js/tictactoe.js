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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/tictactoe.js":
/*!***********************************!*\
  !*** ./resources/js/tictactoe.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

$(document).ready(function () {
  // Add event-listeners
  // event-listener for the "Restart" button
  $('#restart_button').on('click', startGame); // Set up the environment for playing the game

  var startBoard;
  var player1 = 'O';
  var player2 = 'X';
  var winCombos = [[0, 1, 2], [3, 4, 5], [6, 7, 8], [0, 3, 6], [1, 4, 7], [2, 5, 8], [0, 4, 8], [2, 4, 6]];
  var cells = document.querySelectorAll('.cell');
  startGame();

  function startGame() {
    document.querySelector(".endgame").classList.remove("d-flex");
    document.querySelector(".endgame").classList.add("d-none");
    startBoard = Array.from(Array(9).keys());

    for (var i = 0; i < cells.length; i++) {
      cells[i].innerText = '';
      cells[i].style.removeProperty('background-color');
      cells[i].addEventListener('click', turnClick, false);
    }
  }

  function turnClick(square) {
    if (typeof startBoard[square.target.id] == 'number') {
      turn(square.target.id, player1);
      if (!checkTie()) turn(bestSpot(), player2);
    }
  }

  function turn(squareId, player) {
    // squareId = squareId.substring(4,4);
    startBoard[squareId] = player;
    document.getElementById(squareId).innerText = player;
    var gameWon = checkWin(startBoard, player);
    if (gameWon) gameOver(gameWon);
  }

  function checkWin(board, player) {
    var plays = board.reduce(function (a, e, i) {
      return e === player ? a.concat(i) : a;
    }, []); //console.log('plays: '+plays)

    var gameWon = null;
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = winCombos.entries()[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var _step$value = _slicedToArray(_step.value, 2),
            index = _step$value[0],
            win = _step$value[1];

        if (win.every(function (elem) {
          return plays.indexOf(elem) > -1;
        })) {
          gameWon = {
            index: index,
            player: player
          }; //console.log(gameWon)
          //console.log(elem)
          //console.log(win.every(elem => plays.indexOf(elem > -1)))

          break;
        }
      }
    } catch (err) {
      _didIteratorError = true;
      _iteratorError = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion && _iterator.return != null) {
          _iterator.return();
        }
      } finally {
        if (_didIteratorError) {
          throw _iteratorError;
        }
      }
    }

    return gameWon;
  }

  function gameOver(gameWon) {
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = winCombos[gameWon.index][Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var index = _step2.value;
        document.getElementById(index).style.backgroundColor = gameWon.player == player1 ? "#66ccff" : "red";
      }
    } catch (err) {
      _didIteratorError2 = true;
      _iteratorError2 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion2 && _iterator2.return != null) {
          _iterator2.return();
        }
      } finally {
        if (_didIteratorError2) {
          throw _iteratorError2;
        }
      }
    }

    for (var i = 0; i < cells.length; i++) {
      cells[i].removeEventListener('click', turnClick, false);
    }

    declareWinner(gameWon.player == player1 ? "Player 1 win!" : "Player 2 win!");
  }

  function declareWinner(who) {
    document.querySelector(".endgame").classList.remove("d-none");
    document.querySelector(".endgame").classList.add("d-flex");
    document.querySelector(".endgame .text").innerText = who;
  }

  function emptySquares() {
    return startBoard.filter(function (square) {
      return typeof square == 'number';
    });
  }

  function bestSpot() {
    return emptySquares()[0];
  }

  function checkTie() {
    if (emptySquares().length == 0) {
      for (var i = 0; i < cells.length; i++) {
        cells[i].style.backgroundColor = "green";
        cells[i].removeEventListener('click', turnClick, false);
      }

      declareWinner("Tie Game!");
      return true;
    }
  } // stopped at 35:15 of video

}); //end of $(document).ready(function()

/***/ }),

/***/ 2:
/*!*****************************************!*\
  !*** multi ./resources/js/tictactoe.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/time-machine-new/resources/js/tictactoe.js */"./resources/js/tictactoe.js");


/***/ })

/******/ });