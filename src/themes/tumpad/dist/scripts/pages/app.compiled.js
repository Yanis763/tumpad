/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/scripts/util/getBrowser.js":
/*!*****************************************************!*\
  !*** ./resources/assets/scripts/util/getBrowser.js ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ getBrowser; }
/* harmony export */ });
// allows javascript to know on what browser we are
function getBrowser() {
  var ua = navigator.userAgent;
  var tem;
  var M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];

  if (/trident/i.test(M[1])) {
    tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
    return "IE " + (tem[1] || "");
  }

  if (M[1] === "Chrome") {
    tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
    if (tem != null) return tem.slice(1).join(" ").replace("OPR", "Opera");
  }

  M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, "-?"];
  if ((tem = ua.match(/version\/(\d+)/i)) != null) M.splice(1, 1, tem[1]);
  return M;
}

/***/ }),

/***/ "./resources/assets/scripts/util/hideOutline.js":
/*!******************************************************!*\
  !*** ./resources/assets/scripts/util/hideOutline.js ***!
  \******************************************************/
/***/ (function() {

(function (document, window) {
  if (!document || !window) {
    return;
  }

  var styleText = "::-moz-focus-inner{border:0 !important;}:focus{outline: none !important;";
  var unfocus_style = document.createElement("STYLE");

  window.unfocus = function () {
    document.getElementsByTagName("HEAD")[0].appendChild(unfocus_style);
    document.addEventListener("mousedown", function () {
      unfocus_style.innerHTML = styleText + "}";
    });
    document.addEventListener("keydown", function () {
      unfocus_style.innerHTML = "";
    });
  };

  unfocus.style = function (style) {
    styleText += style;
  };

  unfocus();
})(document, window);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!********************************************************!*\
  !*** ./resources/assets/scripts/pages/app.compiled.js ***!
  \********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util_getBrowser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../util/getBrowser */ "./resources/assets/scripts/util/getBrowser.js");
/* harmony import */ var _util_hideOutline__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../util/hideOutline */ "./resources/assets/scripts/util/hideOutline.js");
/* harmony import */ var _util_hideOutline__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_util_hideOutline__WEBPACK_IMPORTED_MODULE_1__);
/* global jQuery */


jQuery(document).ready(function ($) {
  /**
   * Adds browser class to body
   */
  (function () {
    var who = (0,_util_getBrowser__WEBPACK_IMPORTED_MODULE_0__["default"])();

    if (who[0]) {
      if (!Array.isArray(who)) {
        who = who.split(" ");
      }

      jQuery("body").addClass("is-" + who[0].toLowerCase());
    }
  })();
});
}();
/******/ })()
;