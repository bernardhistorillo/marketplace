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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function define(obj, key, value) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
    return obj[key];
  }
  try {
    // IE 8 has a broken Object.defineProperty that only works on DOM objects.
    define({}, "");
  } catch (err) {
    define = function(obj, key, value) {
      return obj[key] = value;
    };
  }

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = GeneratorFunctionPrototype;
  define(Gp, "constructor", GeneratorFunctionPrototype);
  define(GeneratorFunctionPrototype, "constructor", GeneratorFunction);
  GeneratorFunction.displayName = define(
    GeneratorFunctionPrototype,
    toStringTagSymbol,
    "GeneratorFunction"
  );

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      define(prototype, method, function(arg) {
        return this._invoke(method, arg);
      });
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      define(genFun, toStringTagSymbol, "GeneratorFunction");
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return PromiseImpl.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return PromiseImpl.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  });
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    if (PromiseImpl === void 0) PromiseImpl = Promise;

    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList),
      PromiseImpl
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  define(Gp, toStringTagSymbol, "Generator");

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  define(Gp, iteratorSymbol, function() {
    return this;
  });

  define(Gp, "toString", function() {
    return "[object Generator]";
  });

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : undefined
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, in modern engines
  // we can explicitly access globalThis. In older engines we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

var appUrl;
var currentRouteName;
var searchTimeout;
var address = null;
var mainWeb3 = null;

var pageOnload = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return allOnload();

          case 2:
            if (currentRouteName === "home.index") {
              homeOnload();
            } else if (currentRouteName === "collection.index") {
              collectionOnload();
            } else if (currentRouteName === "token.index") {
              tokenOnload();
            } else if (currentRouteName === "profile.index") {
              profileOnload();
            } else if (currentRouteName === "sales.index") {
              salesOnload();
            } else if (currentRouteName === "email.signup.get") {
              emailSignupsOnload();
            }

          case 3:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));

  return function pageOnload() {
    return _ref.apply(this, arguments);
  };
}();

var allOnload = /*#__PURE__*/function () {
  var _ref2 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            appUrl = $("input[name='app_url']").val();
            currentRouteName = $("input[name='route_name']").val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            if (!$("#account-container").length) {
              _context2.next = 8;
              break;
            }

            initializeWalletConnect();
            _context2.next = 7;
            return getConnectedAddress();

          case 7:
            fetchAccount();

          case 8:
            initializeTooltip(); // localStorage.removeItem("acceptCookie");

            if (currentRouteName !== "model.mustachio.index" && localStorage.getItem("acceptCookie") !== "1") {
              $("#cookie-popup").removeClass("d-none");
            }

          case 10:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2);
  }));

  return function allOnload() {
    return _ref2.apply(this, arguments);
  };
}();

var homeOnload = function homeOnload() {
  $(".clamp").each(function () {
    new MultiClamp($(this), {
      ellipsis: '...',
      clamp: 3
    });
  });
  var width = $(window).width();
  var perPage = 1;

  if (width >= 992) {
    perPage = 3;
  } else if (width >= 768) {
    perPage = 2;
  }

  startCountdown();
  new Splide('.splide', {
    type: 'loop',
    start: 1,
    perPage: perPage,
    perMove: 1
  }).mount();
};

var collectionOnload = function collectionOnload() {
  var page = findGetParameter('page');

  if (page) {
    $(document.documentElement).scrollTop($("#collection-tokens-top").offset().top);
  }

  fetchTokenActionButtons();

  if ($('#rarity-table')[0]) {
    $('#rarity-table').DataTable();
  }

  startCountdown();
};

var tokenOnload = function tokenOnload() {
  fetchTokenActionButtons();
};

var profileOnload = function profileOnload() {
  var account = $("input[name='account']").val();
  var currentTab = $("input[name='current_tab']").val();
  var ownedTabUrl = $("input[name='owned_tab_url']").val();

  if (account !== address.toLowerCase()) {
    if (!currentTab) {
      window.location.href = ownedTabUrl;
    }
  }

  if (account === address.toLowerCase()) {
    $("#account-settings-tab").removeClass("d-none");
    var accountSettingsForm = $("#account-settings-form");
    accountSettingsForm.find("input").prop("disabled", false);
    accountSettingsForm.find("[type='submit']").removeClass("d-none");
    accountSettingsForm.find(".action-btn").removeClass("d-none");
  }

  fetchTokenActionButtons();
};

var salesOnload = function salesOnload() {
  var data = JSON.parse($("#sales-chart-container").attr("data-graph"));
  var ctx = document.getElementById('sales-chart');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [{
        label: 'OWN (per million)',
        data: data.own,
        backgroundColor: ['rgba(22,185,154,0.3)'],
        borderColor: ['#16b99a'],
        fill: true,
        tension: 0.3,
        borderWidth: 2
      }, {
        label: 'ETH',
        data: data.eth,
        backgroundColor: ['rgba(73,79,124,0.3)'],
        borderColor: ['#494f7c'],
        fill: true,
        tension: 0.3,
        borderWidth: 2
      }, {
        label: 'BNB',
        data: data.bnb,
        backgroundColor: ['rgba(243,187,50,0.3)'],
        borderColor: ['#f3bb32'],
        fill: true,
        tension: 0.3,
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
};

var emailSignupsOnload = function emailSignupsOnload() {
  $('.table').DataTable({
    order: [[0, 'desc']]
  });
};

var numberFormat = function numberFormat(x, decimal) {
  x = parseFloat(x);
  var parts = x;

  if (decimal !== false) {
    parts = parts.toFixed(decimal);
  }

  parts = parts.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  if (decimal !== 0) {
    return parts.join(".");
  } else {
    return parts[0];
  }
};

var initializeReloadButton = function initializeReloadButton(link) {
  var modalSuccess = $("#modal-success");
  modalSuccess.attr("data-bs-backdrop", "static");
  modalSuccess.attr("data-bs-keyboard", "false");
  modalSuccess.find("button").removeAttr("data-bs-dismiss");
  modalSuccess.find("button").addClass("reload-page");
  modalSuccess.find("button").attr("data-link", link);
};

var initializeTooltip = function initializeTooltip() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
};

$(document).ready(function () {
  pageOnload();
});
$(document).on("click", ".reload-page", function () {
  $(this).prop("disabled", true);
  var link = $(this).attr("data-link");

  if (link) {
    $(this).text("Redirecting");
    window.location.href = link;
  } else {
    $(this).text("Reloading Page");
    window.location.reload();
  }
}); // Home Page

var findGetParameter = function findGetParameter(parameterName) {
  var result = null,
      tmp = [];
  var items = location.search.substr(1).split("&");

  for (var index = 0; index < items.length; index++) {
    tmp = items[index].split("=");
    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
  }

  return result;
};

var padZeroes = function padZeroes(number) {
  number = number.toString();

  while (number.length < 2) {
    number = "0" + number;
  }

  return number;
};

var startCountdown = function startCountdown() {
  if ($("#countdown")[0]) {
    $.ajax({
      url: appUrl + "/api/get-remaining-time/2022-11-01%2000:00:00",
      method: "GET"
    }).done(function (remaining_time) {
      var countDownDate = new Date().getTime() + remaining_time * 1000; // countDownDate = new Date("Sep 30, 2021 17:00:00").getTime();

      var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = padZeroes(Math.floor(distance / (1000 * 60 * 60 * 24)));
        var hours = padZeroes(Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60)));
        var minutes = padZeroes(Math.floor(distance % (1000 * 60 * 60) / (1000 * 60)));
        var seconds = padZeroes(Math.floor(distance % (1000 * 60) / 1000));
        $("#days").text(days);
        $("#hours").text(hours);
        $("#minutes").text(minutes);
        $("#seconds").text(seconds);
        $("#days").removeClass("invisible");
        $("#hours").removeClass("invisible");
        $("#minutes").removeClass("invisible");
        $("#seconds").removeClass("invisible");

        if (distance < 0) {
          clearInterval(x);
          $("#days").text("00");
          $("#hours").text("00");
          $("#minutes").text("00");
          $("#seconds").text("00");
          clearInterval(x);
          $("#countdown").addClass("invisible");
        }
      }, 500);
    }).fail(function (error) {
      console.log(error);
    });
  }
}; // Profile


$(document).on("click", "#select-photo", function () {
  $("input[name='photo']").trigger("click");
});
$(document).on("change", "input[name='photo']", function () {
  var reader = new FileReader();

  reader.onload = function (event) {
    var img = new Image();

    img.onload = function () {
      var photoContainer = $("#photo-container");
      photoContainer.html("");
      photoContainer.css("background-image", "url('" + img.src + "')");
    };

    img.src = event.target.result;
  };

  if ($(this)[0].files.length) {
    reader.readAsDataURL($(this)[0].files[0]);
    $(".field-error-message[data-name='asa_certificate']").addClass("d-none");
  } else {
    $("#photo-container").css("background-image", "initial");
  }
});
$(document).on("submit", "#account-settings-form", /*#__PURE__*/function () {
  var _ref3 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(e) {
    var button, message, signature, form_data, url;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
      while (1) {
        switch (_context3.prev = _context3.next) {
          case 0:
            e.preventDefault();
            button = $(this).find("[type='submit']");
            mainWeb3 = new Web3(ethereum);
            message = "I am confirming this action in Ownly Marketplace.";
            _context3.next = 6;
            return mainWeb3.eth.personal.sign(message, ethereum.selectedAddress);

          case 6:
            signature = _context3.sent;

            if (signature) {
              form_data = new FormData($(this)[0]);
              form_data.append('signature', signature);
              button.prop("disabled", true);
              button.text("Saving Changes");
              url = $(this).attr("action");
              $.ajax({
                url: url,
                method: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data
              }).done(function () {
                initializeReloadButton("");
                $("#modal-success .message").text("Changes Saved");
                $("#modal-success").modal("show");
              }).fail(function (error) {
                console.log(error);
              }).always(function () {
                button.prop("disabled", false);
                button.text("Save Changes");
              });
            }

          case 8:
          case "end":
            return _context3.stop();
        }
      }
    }, _callee3, this);
  }));

  return function (_x) {
    return _ref3.apply(this, arguments);
  };
}()); // Collection

var fetchTokenActionButtons = function fetchTokenActionButtons() {
  $(".collection-token-form").each(function () {
    var container = $(this).closest(".token-action-buttons");
    var formData = new FormData($(this)[0]);
    var url = $(this).attr("action");
    var tries = 0;

    var fetchTokenFooter = function fetchTokenFooter() {
      $.ajax({
        url: url,
        method: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData
      }).done( /*#__PURE__*/function () {
        var _ref4 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4(response) {
          var favorite_status, addToFavoritesButton, heart;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
            while (1) {
              switch (_context4.prev = _context4.next) {
                case 0:
                  container.html(response);
                  favorite_status = container.find("input[name='favorite_status']").val();
                  addToFavoritesButton = container.closest(".token-card").find(".add-to-favorites");
                  heart = container.closest(".token-card").find(".fa-heart");
                  addToFavoritesButton.prop("disabled", false);

                  if (favorite_status) {
                    heart.removeClass("far");
                    heart.addClass("fas");
                    addToFavoritesButton.attr("data-status", 1);
                  }

                case 6:
                case "end":
                  return _context4.stop();
              }
            }
          }, _callee4);
        }));

        return function (_x2) {
          return _ref4.apply(this, arguments);
        };
      }()).fail(function (error) {
        console.log(error);

        if (tries < 3) {
          fetchTokenFooter(tries++);
        }
      });
    };

    fetchTokenFooter(tries++);
  });
};

var getFilteredTokensByProperties = function getFilteredTokensByProperties() {
  var filters = [];
  $(".property-filter-item:checked").each(function () {
    var property = $(this).attr("data-property");
    var value = $(this).attr("data-value");
    filters.push({
      property: property,
      value: value
    });
  });
  var formData = new FormData();
  formData.append('filters', JSON.stringify(filters));
  $.ajax({
    url: $("#token-cards-container").attr("data-url"),
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    data: formData
  }).done(function (response) {
    $("#token-cards-container").html(response);
    fetchTokenActionButtons();
    $("#collection-loading").addClass("d-none");
    $(".property-filter-item").prop("disabled", false);
  }).fail(function (error) {
    console.log(error);
  });
};

$(document).on("click", ".change-token-view", function () {
  var view = $(this).val();
  var tokenItem = $(".token-item");
  $(".change-token-view").removeClass("active");

  if (view === 'small-grid') {
    tokenItem.removeClass(['col-sm-6 col-xl-4']);
    tokenItem.addClass(['col-6 col-sm-4', 'col-xl-3', 'font-size-10']);
    $(this).addClass("active");
  } else {
    tokenItem.removeClass(['col-6 col-sm-4', 'col-xl-3', 'font-size-10']);
    tokenItem.addClass(['col-sm-6 col-xl-4']);
    $(this).addClass("active");
  }

  var formData = new FormData();
  formData.append('view', view);
  $.ajax({
    url: $("#view-options").attr("data-url"),
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    data: formData
  }).fail(function (error) {
    console.log(error);
  });
});
$(document).on("change", ".property-filter-item", function () {
  $(".property-filter-item").prop("disabled", true);
  $("#token-cards-container").html("");
  $("#collection-loading").removeClass("d-none");
  var property = $(this).attr("data-property");
  var value = $(this).attr("data-value");
  var propertyFilterSelectedItems = $("#property-filter-selected-items");

  if ($(this).prop("checked")) {
    var content = ' <div class="property-filter-selected-item d-flex align-items-center font-size-90 ps-4 pe-2 py-2 me-2 mb-2">';
    content += '        <div class="pe-2">' + property + ':</div>';
    content += '        <div class="fw-bold">' + value + '</div>';
    content += '        <div class="px-3 cursor-pointer remove-property-filter-selected-item" data-property="' + property + '" data-value="' + value + '">';
    content += '            <i class="fas fa-times font-size-120"></i>';
    content += '        </div>';
    content += '    </div>';
    propertyFilterSelectedItems.append(content);
    $("#no-selected-filters").addClass("d-none");
  } else {
    $(".remove-property-filter-selected-item[data-property='" + property + "'][data-value='" + value + "']").closest(".property-filter-selected-item").remove();
  }

  var propertyFilterCount = $(".property-filter-item:checked").length;

  if (!propertyFilterCount) {
    $("#no-selected-filters").removeClass("d-none");
    $("#reset-property-filters").addClass("d-none");
  } else {
    $("#reset-property-filters").removeClass("d-none");
  }

  var propertyFilterCountElement = $("#property-filter-count");
  propertyFilterCountElement.html(propertyFilterCount);

  if (propertyFilterCount > 0) {
    propertyFilterCountElement.removeClass("d-none");
  } else {
    propertyFilterCountElement.addClass("d-none");
  }

  getFilteredTokensByProperties();
});
$(document).on("click", ".remove-property-filter-selected-item", function () {
  $(".property-filter-item").prop("disabled", true);
  $("#token-cards-container").html("");
  $("#collection-loading").removeClass("d-none");
  $(this).closest(".property-filter-selected-item").remove();
  var property = $(this).attr("data-property");
  var value = $(this).attr("data-value");
  $(".property-filter-item[data-property='" + property + "'][data-value='" + value + "']").prop("checked", false);
  var propertyFilterCount = $(".property-filter-item:checked").length;
  console.log(propertyFilterCount);

  if (!propertyFilterCount) {
    $("#no-selected-filters").removeClass("d-none");
    $("#reset-property-filters").addClass("d-none");
  } else {
    $("#reset-property-filters").removeClass("d-none");
  }

  var propertyFilterCountElement = $("#property-filter-count");
  propertyFilterCountElement.html(propertyFilterCount);

  if (propertyFilterCount > 0) {
    propertyFilterCountElement.removeClass("d-none");
  } else {
    propertyFilterCountElement.addClass("d-none");
  }

  getFilteredTokensByProperties();
});
$(document).on("click", "#reset-property-filters", function () {
  $(".property-filter-item").prop("disabled", true);
  $(".property-filter-item:checked").each(function () {
    var property = $(this).attr("data-property");
    var value = $(this).attr("data-value");
    $(".property-filter-item[data-property='" + property + "'][data-value='" + value + "']").prop("checked", false);
    $(".remove-property-filter-selected-item[data-property='" + property + "'][data-value='" + value + "']").closest(".property-filter-selected-item").remove();
  });
  $("#no-selected-filters").removeClass("d-none");
  $("#reset-property-filters").addClass("d-none");
  $("#property-filter-count").addClass("d-none");
  getFilteredTokensByProperties();
}); // Newsletter

$(document).on("submit", ".newsletter-form", function (e) {
  e.preventDefault();
  var newsletter_form = $(this);

  if (newsletter_form.find("#agreement").prop("checked")) {
    newsletter_form.find("[type='submit']").prop("disabled", true);
    var data = new FormData($(this)[0]);
    $.ajax({
      url: "https://ownly.market/api/store-mustachio-subscriber",
      // url: "http://ownly-api.test/api/store-mustachio-subscriber",
      method: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: data
    }).done(function (response) {
      newsletter_form.find("input").val("");
      newsletter_form.find("#agreement").prop("checked", false);
      $("#modal-subscribe-success").modal("show");
    }).fail(function (error) {
      console.log(error);
    }).always(function () {
      newsletter_form.find("[type='submit']").prop("disabled", false);
    });
  } else {
    newsletter_form.find("#agreement").focus();
  }
}); // Search Function

$(document).on("input", ".search-field", function () {
  var search = $(this).val();
  var searchSuggestionsContainer = $(this).closest(".search-field-container").find(".search-suggestions-container");

  if (search.length > 1) {
    var content = ' <div class="card">';
    content += '        <div class="card-body">';
    content += '            <div class="d-flex justify-content-center align-items-center">';
    content += '                <div class="spinner-grow background-image-cover bg-transparent me-2" style="width:1.5rem; height:1.5rem; background-image:url(\'../img/ownly/own-token.png\')" role="status">';
    content += '                    <span class="visually-hidden">Loading...</span>';
    content += '                </div>';
    content += '                <div class="font-size-80">Loading</div>';
    content += '            </div>';
    content += '        </div>';
    content += '    </div>';
    searchSuggestionsContainer.html(content);
    searchSuggestionsContainer.removeClass("d-none");
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function () {
      var searchForm = $("#search-form");
      var formData = new FormData(searchForm[0]);
      $.ajax({
        url: searchForm.attr("action"),
        method: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData
      }).done( /*#__PURE__*/function () {
        var _ref5 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5(result) {
          var i, thumbnail;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
            while (1) {
              switch (_context5.prev = _context5.next) {
                case 0:
                  result = result.data;
                  content = '     <div class="list-group overflow-auto" style="max-height:400px">';

                  for (i = 0; i < result.length; i++) {
                    thumbnail = JSON.parse(result[i].thumbnail);
                    content += '    <a href="' + result[i].url + '" class="list-group-item list-group-item-action">';
                    content += '        <div class="d-flex align-items-center">';
                    content += '            <div class="pe-3" style="min-width:55px; width:55px">';
                    content += '                <div class="background-image-contain bg-color-1" style="padding-top:100%; border:1px solid #dddddd; background-image:url(\'' + thumbnail.webp256 + '\')"></div>';
                    content += '            </div>';
                    content += '            <div class="flex-fill">';

                    if (result[i].type === "token") {
                      content += '            <div class="text-color-7 font-size-80 mb-1">' + result[i].collection + '</div>';
                    }

                    content += '                <div class="d-flex w-100 justify-content-between align-items-center">';
                    content += '                    <div class="font-size-90 pe-4">' + result[i].name + '</div>';

                    if (result[i].type === "token") {
                      content += '                <div class="text-color-7 font-size-70">ID:&nbsp;' + result[i].id + '</div>';
                    }

                    content += '                </div>';
                    content += '            </div>';
                    content += '         </div>';
                    content += '    </a>';
                  }

                  content += '    </div>';

                  if (result.length === 0) {
                    content = '     <div class="card">';
                    content += '        <div class="card-body">';
                    content += '            <div class="text-center">';
                    content += '                <div class="font-size-80">No Result Found</div>';
                    content += '            </div>';
                    content += '        </div>';
                    content += '    </div>';
                  }

                  searchSuggestionsContainer.html(content);

                case 6:
                case "end":
                  return _context5.stop();
              }
            }
          }, _callee5);
        }));

        return function (_x3) {
          return _ref5.apply(this, arguments);
        };
      }()).fail(function (error) {
        console.log(error);
      });
    }, 1000);
  } else {
    searchSuggestionsContainer.addClass("d-none");
  }
});
$(document).on("click", 'html', function (e) {
  if ($(e.target).closest('#search-field').length || $(e.target).closest('.search-suggestions-container').length) {
    if ($(".search-field").val().length > 1) {
      $(".search-suggestions-container").removeClass("d-none");
    }
  } else {
    $(".search-suggestions-container").addClass("d-none");
  }
}); // Wallet Connection

var walletConnectProvider;

var initializeWalletConnect = function initializeWalletConnect() {
  var rpc;
  rpc = {
    1: "https://mainnet.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161",
    56: "https://bsc-dataseed.binance.org/",
    137: "https://polygon-rpc.com/"
  };
  walletConnectProvider = new WalletConnectProvider["default"]({
    rpc: rpc
  });
};

var getConnectedAddress = /*#__PURE__*/function () {
  var _ref6 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee6() {
    var accounts;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee6$(_context6) {
      while (1) {
        switch (_context6.prev = _context6.next) {
          case 0:
            if (address) {
              _context6.next = 11;
              break;
            }

            _context6.prev = 1;
            _context6.next = 4;
            return ethereum.request({
              method: 'eth_requestAccounts'
            });

          case 4:
            accounts = _context6.sent;
            address = accounts.length > 0 ? accounts[0] : false;
            ethereum.on('accountsChanged', function (_chainId) {
              return window.location.reload();
            });
            _context6.next = 11;
            break;

          case 9:
            _context6.prev = 9;
            _context6.t0 = _context6["catch"](1);

          case 11:
          case "end":
            return _context6.stop();
        }
      }
    }, _callee6, null, [[1, 9]]);
  }));

  return function getConnectedAddress() {
    return _ref6.apply(this, arguments);
  };
}();

var connectWallet = /*#__PURE__*/function () {
  var _ref7 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee7() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee7$(_context7) {
      while (1) {
        switch (_context7.prev = _context7.next) {
          case 0:
            if (mainWeb3) {
              _context7.next = 15;
              break;
            }

            _context7.prev = 1;
            _context7.next = 4;
            return getConnectedAddress();

          case 4:
            fetchAccount();
            mainWeb3 = new Web3(ethereum);
            return _context7.abrupt("return", true);

          case 9:
            _context7.prev = 9;
            _context7.t0 = _context7["catch"](1);
            $("#modal-no-metamask-installed").modal("show");
            return _context7.abrupt("return", false);

          case 13:
            _context7.next = 16;
            break;

          case 15:
            return _context7.abrupt("return", true);

          case 16:
          case "end":
            return _context7.stop();
        }
      }
    }, _callee7, null, [[1, 9]]);
  }));

  return function connectWallet() {
    return _ref7.apply(this, arguments);
  };
}();

var connectWalletConnect = /*#__PURE__*/function () {
  var _ref8 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee8() {
    var accounts;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee8$(_context8) {
      while (1) {
        switch (_context8.prev = _context8.next) {
          case 0:
            _context8.next = 2;
            return walletConnectProvider.enable();

          case 2:
            //  Create Web3 instance
            mainWeb3 = new Web3(walletConnectProvider);
            _context8.next = 5;
            return mainWeb3.eth.getAccounts();

          case 5:
            accounts = _context8.sent;
            // get all connected accounts
            address = accounts[0];
            _context8.next = 9;
            return updateConnectToWallet();

          case 9:
          case "end":
            return _context8.stop();
        }
      }
    }, _callee8);
  }));

  return function connectWalletConnect() {
    return _ref8.apply(this, arguments);
  };
}();

var fetchAccount = function fetchAccount() {
  var getAccountProfileForm = $("#get-account-profile-form");
  $("input[name='address']").val(address);
  var formData = new FormData(getAccountProfileForm[0]); // Get Account Profile

  $.ajax({
    url: getAccountProfileForm.attr("action"),
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    data: formData
  }).done( /*#__PURE__*/function () {
    var _ref9 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee9(response) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee9$(_context9) {
        while (1) {
          switch (_context9.prev = _context9.next) {
            case 0:
              $("#account-container").html(response);

              if ($("#profile-link").attr("data-discount-signature") === "") {
                if (localStorage.getItem("closedClaimElixirPopup") && parseInt(localStorage.getItem("closedClaimElixirPopup")) < new Date().getTime()) {
                  $("#elixir-alert").addClass("show");
                }
              }

            case 2:
            case "end":
              return _context9.stop();
          }
        }
      }, _callee9);
    }));

    return function (_x4) {
      return _ref9.apply(this, arguments);
    };
  }()).fail(function (error) {
    console.log(error);
  });
};

var checkNetwork = /*#__PURE__*/function () {
  var _ref10 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee10(chainId) {
    var connectedChainId;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee10$(_context10) {
      while (1) {
        switch (_context10.prev = _context10.next) {
          case 0:
            _context10.next = 2;
            return connectWallet();

          case 2:
            if (!_context10.sent) {
              _context10.next = 13;
              break;
            }

            _context10.next = 5;
            return mainWeb3.eth.getChainId();

          case 5:
            connectedChainId = _context10.sent;

            if (!(connectedChainId === chainId)) {
              _context10.next = 10;
              break;
            }

            return _context10.abrupt("return", true);

          case 10:
            _context10.next = 12;
            return switchNetwork(chainId);

          case 12:
            return _context10.abrupt("return", _context10.sent);

          case 13:
            return _context10.abrupt("return", false);

          case 14:
          case "end":
            return _context10.stop();
        }
      }
    }, _callee10);
  }));

  return function checkNetwork(_x5) {
    return _ref10.apply(this, arguments);
  };
}();

var switchNetwork = /*#__PURE__*/function () {
  var _ref11 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee11(chainId) {
    var chainIdInHex;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee11$(_context11) {
      while (1) {
        switch (_context11.prev = _context11.next) {
          case 0:
            _context11.prev = 0;
            chainIdInHex = "0x" + chainId.toString(16);
            _context11.next = 4;
            return window.ethereum.request({
              method: 'wallet_switchEthereumChain',
              params: [{
                chainId: chainIdInHex
              }]
            });

          case 4:
            return _context11.abrupt("return", true);

          case 7:
            _context11.prev = 7;
            _context11.t0 = _context11["catch"](0);

            if (!(_context11.t0.code === 4902)) {
              _context11.next = 15;
              break;
            }

            _context11.next = 12;
            return addNetwork(chainId);

          case 12:
            return _context11.abrupt("return", _context11.sent);

          case 15:
            return _context11.abrupt("return", false);

          case 16:
          case "end":
            return _context11.stop();
        }
      }
    }, _callee11, null, [[0, 7]]);
  }));

  return function switchNetwork(_x6) {
    return _ref11.apply(this, arguments);
  };
}();

var addNetwork = /*#__PURE__*/function () {
  var _ref12 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee12(chainId) {
    var data, networkIsAdded;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee12$(_context12) {
      while (1) {
        switch (_context12.prev = _context12.next) {
          case 0:
            _context12.prev = 0;

            if (chainId === 56) {
              data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'BNB Chain',
                rpcUrls: ['https://bsc-dataseed.binance.org/'],
                blockExplorerUrls: ['https://bscscan.com/'],
                nativeCurrency: {
                  symbol: 'BNB',
                  decimals: 18
                }
              };
            } else if (chainId === 97) {
              console.log('0x' + chainId.toString(16));
              data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'BNB Chain Testnet',
                rpcUrls: ['https://data-seed-prebsc-1-s1.binance.org:8545/'],
                blockExplorerUrls: ['https://testnet.bscscan.com/'],
                nativeCurrency: {
                  symbol: 'BNB',
                  decimals: 18
                }
              };
            } else if (chainId === 137) {
              data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'Polygon',
                rpcUrls: ['https://polygon-rpc.com'],
                blockExplorerUrls: ['https://polygonscan.com/'],
                nativeCurrency: {
                  symbol: 'MATIC',
                  decimals: 18
                }
              };
            } else if (chainId === 80001) {
              data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'Polygon Mumbai',
                rpcUrls: ['https://rpc-mumbai.maticvigil.com/'],
                blockExplorerUrls: ['https://mumbai-explorer.matic.today/'],
                nativeCurrency: {
                  symbol: 'MATIC',
                  decimals: 18
                }
              };
            } else if (chainId === 1) {
              data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'Ethereum Mainnet',
                rpcUrls: ['https://mainnet.infura.io/v3/'],
                blockExplorerUrls: ['https://etherscan.io'],
                nativeCurrency: {
                  symbol: 'ETH',
                  decimals: 18
                }
              };
            } else if (chainId === 4) {
              data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'Rinkeby Test Network',
                rpcUrls: ['https://rinkeby.infura.io/v3/'],
                blockExplorerUrls: ['https://rinkeby.etherscan.io'],
                nativeCurrency: {
                  symbol: 'ETH',
                  decimals: 18
                }
              };
            }

            _context12.next = 4;
            return window.ethereum.request({
              method: 'wallet_addEthereumChain',
              params: [data]
            });

          case 4:
            networkIsAdded = _context12.sent;
            return _context12.abrupt("return", !!networkIsAdded);

          case 8:
            _context12.prev = 8;
            _context12.t0 = _context12["catch"](0);
            console.log(_context12.t0);
            return _context12.abrupt("return", false);

          case 12:
          case "end":
            return _context12.stop();
        }
      }
    }, _callee12, null, [[0, 8]]);
  }));

  return function addNetwork(_x7) {
    return _ref12.apply(this, arguments);
  };
}();

$(document).on("click", "#connect-wallet", function () {
  $("#modal-wallet-options").modal("show");
});
$(document).on("click", ".wallet-options", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee13() {
  var wallet;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee13$(_context13) {
    while (1) {
      switch (_context13.prev = _context13.next) {
        case 0:
          wallet = $(this).attr("data-wallet");
          $("#modal-wallet-options").modal("hide");

          if (!(wallet === "MetaMask")) {
            _context13.next = 7;
            break;
          }

          _context13.next = 5;
          return connectWallet();

        case 5:
          _context13.next = 10;
          break;

        case 7:
          if (!(wallet === "WalletConnect")) {
            _context13.next = 10;
            break;
          }

          _context13.next = 10;
          return connectWalletConnect();

        case 10:
        case "end":
          return _context13.stop();
      }
    }
  }, _callee13, this);
}))); // Create Market Item

$(document).on("click", ".create-market-item-confirmation", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee14() {
  var button, tokenForm, chainId, contractAddress, contractAbi, tokenID, marketplaceContractAddress, marketplaceContractAbi, contract;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee14$(_context14) {
    while (1) {
      switch (_context14.prev = _context14.next) {
        case 0:
          button = $(this);
          button.prop("disabled", true);
          tokenForm = $(this).closest(".token-action-buttons").find(".token-form");
          chainId = tokenForm.find("input[name='chain_id']").val();
          contractAddress = tokenForm.find("input[name='contract_address']").val();
          contractAbi = tokenForm.find("input[name='contract_abi']").val();
          tokenID = tokenForm.find("input[name='token_id']").val();
          marketplaceContractAddress = tokenForm.find("input[name='marketplace_contract_address']").val();
          marketplaceContractAbi = tokenForm.find("input[name='marketplace_contract_abi']").val();
          _context14.next = 11;
          return checkNetwork(parseInt(chainId));

        case 11:
          if (_context14.sent) {
            _context14.next = 14;
            break;
          }

          button.prop("disabled", false);
          return _context14.abrupt("return", false);

        case 14:
          contract = new mainWeb3.eth.Contract(JSON.parse(contractAbi), contractAddress);
          contract.methods.isApprovedForAll(address, marketplaceContractAddress).call().then(function (isApprovedForAll) {
            button.prop("disabled", false);
            var createMarketItemButton = $("#create-market-item");
            createMarketItemButton.attr("data-token-id", tokenID);
            createMarketItemButton.attr("data-contract-address", contractAddress);
            createMarketItemButton.attr("data-marketplace-contract-address", marketplaceContractAddress);
            createMarketItemButton.attr("data-marketplace-contract-abi", marketplaceContractAbi);

            if (isApprovedForAll) {
              $("#modal-create-market-item").modal("show");
            } else {
              var approveButton = $("#approve");
              approveButton.attr("data-contract-address", contractAddress);
              approveButton.attr("data-contract-abi", contractAbi);
              approveButton.attr("data-marketplace-contract-address", marketplaceContractAddress);
              $("#modal-approve").modal("show");
            }
          });

        case 16:
        case "end":
          return _context14.stop();
      }
    }
  }, _callee14, this);
})));
$(document).on("click", "#approve", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee15() {
  var approveButton, contractAddress, contractAbi, marketplaceContractAddress, contract;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee15$(_context15) {
    while (1) {
      switch (_context15.prev = _context15.next) {
        case 0:
          approveButton = $("#approve");
          approveButton.prop("disabled", true);
          contractAddress = $(this).attr("data-contract-address");
          contractAbi = $(this).attr("data-contract-abi");
          marketplaceContractAddress = $(this).attr("data-marketplace-contract-address");
          console.log(contractAddress);
          console.log(contractAbi);
          $("#modal-approve").modal("hide");
          contract = new mainWeb3.eth.Contract(JSON.parse(contractAbi), contractAddress);
          contract.methods.setApprovalForAll(marketplaceContractAddress, true).send({
            from: mainWeb3.utils.toChecksumAddress(address)
          }).on('transactionHash', function (hash) {
            $("#modal-processing").modal("show");
          }).on('error', function (error) {
            $("#modal-processing").modal("hide");
            $("#modal-error .message").text(error.code + ": " + error.message);
            $("#modal-error").modal("show");
          }).then(function (receipt) {
            $("#modal-processing").modal("hide");
            $("#modal-create-market-item").modal("show");
          });

        case 10:
        case "end":
          return _context15.stop();
      }
    }
  }, _callee15, this);
})));
$(document).on("click", ".select-price-current", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee16() {
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee16$(_context16) {
    while (1) {
      switch (_context16.prev = _context16.next) {
        case 0:
          $("#price-currency img").attr("src", $(this).data("image"));
          $("#price-currency span").text($(this).data("currency"));
          $("#price-currency").val($(this).data("currency"));

        case 3:
        case "end":
          return _context16.stop();
      }
    }
  }, _callee16, this);
})));
$(document).on("click", "#create-market-item", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee17() {
  var createMarketItemButton, contractAddress, tokenId, marketplaceContractAddress, marketplaceContractAbi, currency, price, marketplaceContract;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee17$(_context17) {
    while (1) {
      switch (_context17.prev = _context17.next) {
        case 0:
          createMarketItemButton = $("#create-market-item");
          contractAddress = createMarketItemButton.attr("data-contract-address");
          tokenId = createMarketItemButton.attr("data-token-id");
          marketplaceContractAddress = createMarketItemButton.attr("data-marketplace-contract-address");
          marketplaceContractAbi = createMarketItemButton.attr("data-marketplace-contract-abi");
          currency = $("#price-currency").val();
          price = $("#price").val();

          if (price > 0) {
            $("#modal-create-market-item").modal("hide");
            marketplaceContract = new mainWeb3.eth.Contract(JSON.parse(marketplaceContractAbi), marketplaceContractAddress);
            marketplaceContract.methods.getListingPrice().call().then(function (listingPrice) {
              marketplaceContract.methods.createMarketItem(contractAddress, tokenId, mainWeb3.utils.toWei(price, 'ether'), currency, 0, 0).send({
                from: mainWeb3.utils.toChecksumAddress(address),
                value: listingPrice
              }).on('transactionHash', function (transactionHash) {
                $("#modal-processing").modal("show");
              }).on('error', function (error) {
                $("#modal-processing").modal("hide");
                $("#modal-error .message").text(error.code + ": " + error.message);
                $("#modal-error").modal("show");
              }).then(function (receipt) {
                $("#modal-processing").modal("hide");
                initializeReloadButton("");
                $("#modal-success .message").text("You have successfully posted your item for sale.");
                $("#modal-success").modal("show");
              });
            });
          }

        case 8:
        case "end":
          return _context17.stop();
      }
    }
  }, _callee17);
}))); // Cancel Market Item

$(document).on("click", ".cancel-market-item-confirmation", function () {
  var tokenForm = $(this).closest(".token-action-buttons").find(".token-form");
  var chainId = tokenForm.find("input[name='chain_id']").val();
  var marketplaceContractAddress = tokenForm.find("input[name='marketplace_contract_address']").val();
  var marketplaceContractAbi = tokenForm.find("input[name='marketplace_contract_abi']").val();
  var version = tokenForm.find("input[name='version']").val();
  var itemID = tokenForm.find("input[name='item_id']").val();
  var cancelMarketItemButton = $("#cancel-market-item");
  cancelMarketItemButton.attr("data-chain-id", chainId);
  cancelMarketItemButton.attr("data-marketplace-contract-address", marketplaceContractAddress);
  cancelMarketItemButton.attr("data-marketplace-contract-abi", marketplaceContractAbi);
  cancelMarketItemButton.attr("data-version", version);
  cancelMarketItemButton.val(itemID);
  $("#modal-cancel-market-item").modal("show");
});
$(document).on("click", "#cancel-market-item", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee18() {
  var chainId, marketplaceContractAddress, marketplaceContractAbi, itemID, marketplaceContract, transaction;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee18$(_context18) {
    while (1) {
      switch (_context18.prev = _context18.next) {
        case 0:
          $("#modal-cancel-market-item").modal("hide");
          chainId = $(this).attr("data-chain-id");
          marketplaceContractAddress = $(this).attr("data-marketplace-contract-address");
          marketplaceContractAbi = $(this).attr("data-marketplace-contract-abi");
          itemID = $(this).val();
          _context18.next = 7;
          return checkNetwork(parseInt(chainId));

        case 7:
          if (_context18.sent) {
            _context18.next = 9;
            break;
          }

          return _context18.abrupt("return", false);

        case 9:
          marketplaceContract = new mainWeb3.eth.Contract(JSON.parse(marketplaceContractAbi), marketplaceContractAddress);
          transaction = marketplaceContract.methods.cancelMarketItem(itemID);
          transaction.send({
            from: mainWeb3.utils.toChecksumAddress(address)
          }).on('transactionHash', function (transactionHash) {
            $("#modal-processing").modal("show");
          }).on('error', function (error) {
            $("#modal-processing").modal("hide");
            $("#modal-error .message").text(error.code + ": " + error.message);
            $("#modal-error").modal("show");
          }).then(function (receipt) {
            $("#modal-processing").modal("hide");
            initializeReloadButton("");
            $("#modal-success .message").text("You have successfully cancelled your item for sale.");
            $("#modal-success").modal("show");
          });

        case 12:
        case "end":
          return _context18.stop();
      }
    }
  }, _callee18, this);
}))); // Create Market Sale

var updateBuyingToken = /*#__PURE__*/function () {
  var _ref19 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee21() {
    var buyingPriceLoadingContainer, createMarketSale, price, currency, token, sparkSwapContract, _sparkSwapContract;

    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee21$(_context21) {
      while (1) {
        switch (_context21.prev = _context21.next) {
          case 0:
            buyingPriceLoadingContainer = $("#buying-price-loading-container");
            buyingPriceLoadingContainer.removeClass("d-none");
            $(".buying-price-container").addClass("d-none");
            createMarketSale = $(".create-market-sale");
            price = createMarketSale.attr("data-price");
            currency = createMarketSale.attr("data-currency");
            token = $("input[name='buy_through_token']:checked").val();

            if (!(currency === "BNB" && token === "OWN")) {
              _context21.next = 13;
              break;
            }

            sparkSwapContract = new new Web3("https://bsc-dataseed.binance.org/").eth.Contract([{
              "inputs": [{
                "internalType": "address",
                "name": "_factory",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "_WETH",
                "type": "address"
              }],
              "stateMutability": "nonpayable",
              "type": "constructor"
            }, {
              "inputs": [],
              "name": "WETH",
              "outputs": [{
                "internalType": "address",
                "name": "",
                "type": "address"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "tokenA",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "tokenB",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "amountADesired",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBDesired",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountAMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "addLiquidity",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "amountTokenDesired",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "addLiquidityETH",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountToken",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [],
              "name": "factory",
              "outputs": [{
                "internalType": "address",
                "name": "",
                "type": "address"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveOut",
                "type": "uint256"
              }],
              "name": "getAmountIn",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }],
              "stateMutability": "pure",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveOut",
                "type": "uint256"
              }],
              "name": "getAmountOut",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }],
              "stateMutability": "pure",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }],
              "name": "getAmountsIn",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }],
              "name": "getAmountsOut",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveB",
                "type": "uint256"
              }],
              "name": "quote",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }],
              "stateMutability": "pure",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "tokenA",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "tokenB",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountAMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "removeLiquidity",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "removeLiquidityETH",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountToken",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "removeLiquidityETHSupportingFeeOnTransferTokens",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }, {
                "internalType": "bool",
                "name": "approveMax",
                "type": "bool"
              }, {
                "internalType": "uint8",
                "name": "v",
                "type": "uint8"
              }, {
                "internalType": "bytes32",
                "name": "r",
                "type": "bytes32"
              }, {
                "internalType": "bytes32",
                "name": "s",
                "type": "bytes32"
              }],
              "name": "removeLiquidityETHWithPermit",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountToken",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }, {
                "internalType": "bool",
                "name": "approveMax",
                "type": "bool"
              }, {
                "internalType": "uint8",
                "name": "v",
                "type": "uint8"
              }, {
                "internalType": "bytes32",
                "name": "r",
                "type": "bytes32"
              }, {
                "internalType": "bytes32",
                "name": "s",
                "type": "bytes32"
              }],
              "name": "removeLiquidityETHWithPermitSupportingFeeOnTransferTokens",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "tokenA",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "tokenB",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountAMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }, {
                "internalType": "bool",
                "name": "approveMax",
                "type": "bool"
              }, {
                "internalType": "uint8",
                "name": "v",
                "type": "uint8"
              }, {
                "internalType": "bytes32",
                "name": "r",
                "type": "bytes32"
              }, {
                "internalType": "bytes32",
                "name": "s",
                "type": "bytes32"
              }],
              "name": "removeLiquidityWithPermit",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapETHForExactTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactETHForTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactETHForTokensSupportingFeeOnTransferTokens",
              "outputs": [],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForETH",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForETHSupportingFeeOnTransferTokens",
              "outputs": [],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForTokensSupportingFeeOnTransferTokens",
              "outputs": [],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountInMax",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapTokensForExactETH",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountInMax",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapTokensForExactTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "stateMutability": "payable",
              "type": "receive"
            }], "0xeB98E6e5D34c94F56708133579abB8a6A2aC2F26");
            _context21.next = 11;
            return sparkSwapContract.methods.getAmountsIn(price, ["0x7665CB7b0d01Df1c9f9B9cC66019F00aBD6959bA", "0xbb4cdb9cbd36b01bd1cbaebf2de08d9173bc095c"]).call().then( /*#__PURE__*/function () {
              var _ref20 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee19(amounts) {
                var ownPrice, buyingPriceContainerBnbToOwn, discountedOwnPrice;
                return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee19$(_context19) {
                  while (1) {
                    switch (_context19.prev = _context19.next) {
                      case 0:
                        ownPrice = mainWeb3.utils.fromWei(amounts[0], "ether");
                        buyingPriceContainerBnbToOwn = $(".buying-price-container[data-currency='BNB-OWN']");
                        buyingPriceContainerBnbToOwn.find(".bnb-price").text(mainWeb3.utils.fromWei(price, "ether"));
                        buyingPriceContainerBnbToOwn.find(".own-price").text(numberFormat(ownPrice, 2));
                        discountedOwnPrice = (BigInt(amounts[0]) * BigInt(8) / BigInt(10)).toString();
                        $("#discounted-own-price").text(numberFormat(mainWeb3.utils.fromWei(discountedOwnPrice, "ether"), 2));
                        $("#discounted-own-price").attr("data-price", discountedOwnPrice);
                        buyingPriceContainerBnbToOwn.removeClass("d-none");

                      case 8:
                      case "end":
                        return _context19.stop();
                    }
                  }
                }, _callee19);
              }));

              return function (_x8) {
                return _ref20.apply(this, arguments);
              };
            }());

          case 11:
            _context21.next = 27;
            break;

          case 13:
            if (!(currency === "BNB" && token === "BNB")) {
              _context21.next = 18;
              break;
            }

            $("#bnb-price").text(numberFormat(mainWeb3.utils.fromWei(price, "ether"), 3));
            $(".buying-price-container[data-currency='BNB-BNB']").removeClass("d-none");
            _context21.next = 27;
            break;

          case 18:
            if (!(currency === "OWN" && token === "OWN")) {
              _context21.next = 23;
              break;
            }

            $("#own-price").text(numberFormat(mainWeb3.utils.fromWei(price, "ether"), 2));
            $(".buying-price-container[data-currency='OWN-OWN']").removeClass("d-none");
            _context21.next = 27;
            break;

          case 23:
            if (!(currency === "OWN" && token === "BNB")) {
              _context21.next = 27;
              break;
            }

            _sparkSwapContract = new new Web3("https://bsc-dataseed.binance.org/").eth.Contract([{
              "inputs": [{
                "internalType": "address",
                "name": "_factory",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "_WETH",
                "type": "address"
              }],
              "stateMutability": "nonpayable",
              "type": "constructor"
            }, {
              "inputs": [],
              "name": "WETH",
              "outputs": [{
                "internalType": "address",
                "name": "",
                "type": "address"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "tokenA",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "tokenB",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "amountADesired",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBDesired",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountAMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "addLiquidity",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "amountTokenDesired",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "addLiquidityETH",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountToken",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [],
              "name": "factory",
              "outputs": [{
                "internalType": "address",
                "name": "",
                "type": "address"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveOut",
                "type": "uint256"
              }],
              "name": "getAmountIn",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }],
              "stateMutability": "pure",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveOut",
                "type": "uint256"
              }],
              "name": "getAmountOut",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }],
              "stateMutability": "pure",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }],
              "name": "getAmountsIn",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }],
              "name": "getAmountsOut",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "view",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "reserveB",
                "type": "uint256"
              }],
              "name": "quote",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }],
              "stateMutability": "pure",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "tokenA",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "tokenB",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountAMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "removeLiquidity",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "removeLiquidityETH",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountToken",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "removeLiquidityETHSupportingFeeOnTransferTokens",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }, {
                "internalType": "bool",
                "name": "approveMax",
                "type": "bool"
              }, {
                "internalType": "uint8",
                "name": "v",
                "type": "uint8"
              }, {
                "internalType": "bytes32",
                "name": "r",
                "type": "bytes32"
              }, {
                "internalType": "bytes32",
                "name": "s",
                "type": "bytes32"
              }],
              "name": "removeLiquidityETHWithPermit",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountToken",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "token",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountTokenMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountETHMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }, {
                "internalType": "bool",
                "name": "approveMax",
                "type": "bool"
              }, {
                "internalType": "uint8",
                "name": "v",
                "type": "uint8"
              }, {
                "internalType": "bytes32",
                "name": "r",
                "type": "bytes32"
              }, {
                "internalType": "bytes32",
                "name": "s",
                "type": "bytes32"
              }],
              "name": "removeLiquidityETHWithPermitSupportingFeeOnTransferTokens",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountETH",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "address",
                "name": "tokenA",
                "type": "address"
              }, {
                "internalType": "address",
                "name": "tokenB",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "liquidity",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountAMin",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountBMin",
                "type": "uint256"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }, {
                "internalType": "bool",
                "name": "approveMax",
                "type": "bool"
              }, {
                "internalType": "uint8",
                "name": "v",
                "type": "uint8"
              }, {
                "internalType": "bytes32",
                "name": "r",
                "type": "bytes32"
              }, {
                "internalType": "bytes32",
                "name": "s",
                "type": "bytes32"
              }],
              "name": "removeLiquidityWithPermit",
              "outputs": [{
                "internalType": "uint256",
                "name": "amountA",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountB",
                "type": "uint256"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapETHForExactTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactETHForTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactETHForTokensSupportingFeeOnTransferTokens",
              "outputs": [],
              "stateMutability": "payable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForETH",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForETHSupportingFeeOnTransferTokens",
              "outputs": [],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountIn",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountOutMin",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapExactTokensForTokensSupportingFeeOnTransferTokens",
              "outputs": [],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountInMax",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapTokensForExactETH",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "inputs": [{
                "internalType": "uint256",
                "name": "amountOut",
                "type": "uint256"
              }, {
                "internalType": "uint256",
                "name": "amountInMax",
                "type": "uint256"
              }, {
                "internalType": "address[]",
                "name": "path",
                "type": "address[]"
              }, {
                "internalType": "address",
                "name": "to",
                "type": "address"
              }, {
                "internalType": "uint256",
                "name": "deadline",
                "type": "uint256"
              }],
              "name": "swapTokensForExactTokens",
              "outputs": [{
                "internalType": "uint256[]",
                "name": "amounts",
                "type": "uint256[]"
              }],
              "stateMutability": "nonpayable",
              "type": "function"
            }, {
              "stateMutability": "payable",
              "type": "receive"
            }], "0xeB98E6e5D34c94F56708133579abB8a6A2aC2F26");
            _context21.next = 27;
            return _sparkSwapContract.methods.getAmountsOut(price, ["0x7665CB7b0d01Df1c9f9B9cC66019F00aBD6959bA", "0xbb4cdb9cbd36b01bd1cbaebf2de08d9173bc095c"]).call().then( /*#__PURE__*/function () {
              var _ref21 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee20(amounts) {
                var ownPrice, buyingPriceContainerBnbToOwn;
                return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee20$(_context20) {
                  while (1) {
                    switch (_context20.prev = _context20.next) {
                      case 0:
                        ownPrice = mainWeb3.utils.fromWei(amounts[0], "ether");
                        buyingPriceContainerBnbToOwn = $(".buying-price-container[data-currency='BNB-OWN']");
                        buyingPriceContainerBnbToOwn.find(".bnb-price").text(mainWeb3.utils.fromWei(price, "ether"));
                        buyingPriceContainerBnbToOwn.find(".own-price").text(numberFormat(ownPrice, 2));
                        $("#bnb-price").text(numberFormat(mainWeb3.utils.fromWei(amounts[1], "ether"), 2));
                        $(".buying-price-container[data-currency='OWN-BNB']").removeClass("d-none");

                      case 6:
                      case "end":
                        return _context20.stop();
                    }
                  }
                }, _callee20);
              }));

              return function (_x9) {
                return _ref21.apply(this, arguments);
              };
            }());

          case 27:
            buyingPriceLoadingContainer.addClass("d-none");

          case 28:
          case "end":
            return _context21.stop();
        }
      }
    }, _callee21);
  }));

  return function updateBuyingToken() {
    return _ref19.apply(this, arguments);
  };
}();

$(document).on("click", ".create-market-sale-confirmation", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee22() {
  var tokenForm, chainId, price, itemId, currency, marketplaceContractAddress, marketplaceContractAbi, createMarketSale;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee22$(_context22) {
    while (1) {
      switch (_context22.prev = _context22.next) {
        case 0:
          tokenForm = $(this).closest(".token-action-buttons").find(".token-form");
          chainId = tokenForm.find("input[name='chain_id']").val();
          price = tokenForm.find("input[name='price']").val();
          itemId = tokenForm.find("input[name='item_id']").val();
          currency = tokenForm.find("input[name='currency']").val();
          marketplaceContractAddress = tokenForm.find("input[name='marketplace_contract_address']").val();
          marketplaceContractAbi = tokenForm.find("input[name='marketplace_contract_abi']").val();
          createMarketSale = $(".create-market-sale");
          createMarketSale.attr("data-price", price);
          createMarketSale.attr("data-item-id", itemId);
          createMarketSale.attr("data-currency", currency);
          createMarketSale.attr("data-marketplace-contract-address", marketplaceContractAddress);
          createMarketSale.attr("data-marketplace-contract-abi", marketplaceContractAbi);
          _context22.next = 15;
          return checkNetwork(parseInt(chainId));

        case 15:
          if (_context22.sent) {
            _context22.next = 17;
            break;
          }

          return _context22.abrupt("return", false);

        case 17:
          $("#modal-buy-select-currency").modal("show");
          _context22.next = 20;
          return updateBuyingToken();

        case 20:
        case "end":
          return _context22.stop();
      }
    }
  }, _callee22, this);
})));
$(document).on("change", "input[name='buy_through_token']", function () {
  var token = $("input[name='buy_through_token']:checked").val();
  $(".buy-through-token-label").removeClass("active");
  $(".buy-through-token-label[data-token='" + token + "']").addClass("active");
  $(".buy-through-token-image").addClass("d-none");
  $(".buy-through-token-image[data-token='" + token + "']").removeClass("d-none");
  updateBuyingToken();
});
$(document).on("click", ".create-market-sale", function () {
  var price = $(this).attr("data-price");
  var item_id = $(this).attr("data-item-id");
  var selectedCurrency = $("input[name='buy_through_token']:checked").val();
  var marketplaceContractAddress = $(this).attr("data-marketplace-contract-address");
  var marketplaceContractAbi = $(this).attr("data-marketplace-contract-abi");
  var marketplaceContract = new mainWeb3.eth.Contract(JSON.parse(marketplaceContractAbi), marketplaceContractAddress);
  var ownContractAddress = $("input[name='own_contract_address']").val();
  var ownContractAbi = $("input[name='own_contract_abi']").val();
  var ownContract = new mainWeb3.eth.Contract(JSON.parse(ownContractAbi), ownContractAddress);

  var createMarketSaleFunction = /*#__PURE__*/function () {
    var _ref23 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee23(_price) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee23$(_context23) {
        while (1) {
          switch (_context23.prev = _context23.next) {
            case 0:
              marketplaceContract.methods.createMarketSale(item_id, selectedCurrency).send({
                from: mainWeb3.utils.toChecksumAddress(address),
                value: _price
              }).on('transactionHash', function (transactionHash) {
                $("#modal-processing").modal("show");
              }).on('error', function (error) {
                $("#modal-processing").modal("hide");
                $("#modal-error .message").text(error.code + ": " + error.message);
                $("#modal-error").modal("show");
              }).then(function (receipt) {
                $("#modal-processing").modal("hide");
                initializeReloadButton("");
                $("#modal-success .message").html("Congratulations!<br>You have successfully purchased your token.");
                $("#modal-success").modal("show");
              });

            case 1:
            case "end":
              return _context23.stop();
          }
        }
      }, _callee23);
    }));

    return function createMarketSaleFunction(_x10) {
      return _ref23.apply(this, arguments);
    };
  }();

  if ($(this).attr("data-currency") === "OWN" && selectedCurrency === "OWN") {
    ownContract.methods.allowance(address, marketplaceContractAddress).call().then( /*#__PURE__*/function () {
      var _ref24 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee24(allowance) {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee24$(_context24) {
          while (1) {
            switch (_context24.prev = _context24.next) {
              case 0:
                if (allowance !== price) {
                  ownContract.methods.approve(marketplaceContractAddress, price).send({
                    from: mainWeb3.utils.toChecksumAddress(address)
                  }).on('transactionHash', function (transactionHash) {
                    $("#modal-processing").modal("show");
                  }).on('error', function (error) {
                    $("#modal-processing").modal("hide");
                    $("#modal-error .message").text(error.code + ": " + error.message);
                    $("#modal-error").modal("show");
                  }).then(function (receipt) {
                    $("#modal-processing").modal("hide");
                    createMarketSaleFunction(0);
                  });
                } else {
                  createMarketSaleFunction(0);
                }

              case 1:
              case "end":
                return _context24.stop();
            }
          }
        }, _callee24);
      }));

      return function (_x11) {
        return _ref24.apply(this, arguments);
      };
    }());
  } else if ($(this).attr("data-currency") === "BNB" && selectedCurrency === "OWN") {
    ownContract.methods.allowance(address, marketplaceContractAddress).call().then( /*#__PURE__*/function () {
      var _ref25 = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee25(allowance) {
        var priceWithSlippage;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee25$(_context25) {
          while (1) {
            switch (_context25.prev = _context25.next) {
              case 0:
                priceWithSlippage = (BigInt($("#discounted-own-price").attr("data-price")) * BigInt(100001) / BigInt(100000)).toString();

                if (allowance < priceWithSlippage) {
                  ownContract.methods.approve(marketplaceContractAddress, priceWithSlippage).send({
                    from: mainWeb3.utils.toChecksumAddress(address)
                  }).on('transactionHash', function (transactionHash) {
                    $("#modal-processing").modal("show");
                  }).on('error', function (error) {
                    $("#modal-processing").modal("hide");
                    $("#modal-error .message").text(error.code + ": " + error.message);
                    $("#modal-error").modal("show");
                  }).then(function (receipt) {
                    $("#modal-processing").modal("hide");
                    createMarketSaleFunction(0);
                  });
                } else {
                  createMarketSaleFunction(0);
                }

              case 2:
              case "end":
                return _context25.stop();
            }
          }
        }, _callee25);
      }));

      return function (_x12) {
        return _ref25.apply(this, arguments);
      };
    }());
  } else {
    createMarketSaleFunction(price);
  }

  $("#modal-buy-select-currency").modal("hide");
}); // Favorites

$(document).on("click", ".add-to-favorites", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee26() {
  var message, signature, button, url, contract_address, token_id, status, new_status, count, formData;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee26$(_context26) {
    while (1) {
      switch (_context26.prev = _context26.next) {
        case 0:
          _context26.next = 2;
          return connectWallet();

        case 2:
          message = $(this).attr("data-message");
          _context26.next = 5;
          return mainWeb3.eth.personal.sign(message, address);

        case 5:
          signature = _context26.sent;
          // var signing_address = await mainWeb3.eth.personal.ecRecover(message, signature)
          button = $(this);
          url = button.attr("data-url");
          contract_address = button.attr("data-contract-address");
          token_id = button.attr("data-token-id");
          status = parseInt(button.attr("data-status"));

          if (signature) {
            new_status = status ? 0 : 1;
            count = parseInt(button.closest(".add-to-favorites-container").find(".favorites-count").text());

            if (new_status === 1) {
              button.find("i").removeClass("far");
              button.find("i").addClass("fas");
              button.closest(".add-to-favorites-container").find(".favorites-count").text(count + 1);
            } else {
              button.find("i").removeClass("fas");
              button.find("i").addClass("far");
              button.closest(".add-to-favorites-container").find(".favorites-count").text(count - 1);
            }

            button.attr("data-status", new_status);
            formData = new FormData();
            formData.append('address', address);
            formData.append('signature', signature);
            formData.append('contract_address', contract_address);
            formData.append('token_id', token_id);
            formData.append('status', new_status);
            $.ajax({
              url: url,
              method: "POST",
              cache: false,
              contentType: false,
              processData: false,
              data: formData
            }).fail(function (error) {
              console.log(error);
            });
          }

        case 12:
        case "end":
          return _context26.stop();
      }
    }
  }, _callee26, this);
}))); // Sales

$(document).on("change", ".sales-date", /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee27() {
  var periodical, salesYear, salesQuarter, salesMonth, year, quarter, month;
  return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee27$(_context27) {
    while (1) {
      switch (_context27.prev = _context27.next) {
        case 0:
          periodical = $("#periodical").val();
          salesYear = $("#sales-year");
          salesQuarter = $("#sales-quarter");
          salesMonth = $("#sales-month");
          year = salesYear.val();
          quarter = salesQuarter.val();
          month = salesMonth.val();
          salesQuarter.closest("div").addClass("d-none");
          salesMonth.closest("div").addClass("d-none");

          if (periodical === "Annual") {
            $("#sales-button").attr("href", appUrl + "/sales?year=" + year);
          } else if (periodical === "Quarterly") {
            salesQuarter.closest("div").removeClass("d-none");
            $("#sales-button").attr("href", appUrl + "/sales?year=" + year + "&quarter=" + quarter);
          } else if (periodical === "Monthly") {
            salesMonth.closest("div").removeClass("d-none");
            $("#sales-button").attr("href", appUrl + "/sales?year=" + year + "&month=" + month);
          }

        case 10:
        case "end":
          return _context27.stop();
      }
    }
  }, _callee27);
})));
$(document).on("click", ".view-token-properties", function () {
  var properties = $(this).data("properties");
  var content = ' <div class="d-flex justify-content-center mt-2 mb-3">';
  content += $(this).closest("tr").find(".token-name").html();
  content += '    </div>';

  for (var i = 0; i < properties.length; i++) {
    content += '    <div class="col-6 col-xl-4 p-2">';
    content += '        <div class="card bg-light h-100">';
    content += '            <div class="card-body h-100">';
    content += '                <div class="d-flex justify-content-center align-items-center h-100">';
    content += '                    <div class="text-center">';
    content += '                        <p class="neo-bold font-size-80 mb-1 text-uppercase text-decoration-none link-color-4">' + properties[i].trait_type + '</p>';
    content += '                        <div class="neo-bold font-size-100 text-color-6 mb-1">' + properties[i].value + '</div>';
    content += '                        <p class="font-size-80 text-color-7 mb-0">' + properties[i].percentage.toFixed(0) + '% have this trait</p>';
    content += '                    </div>';
    content += '                </div>';
    content += '            </div>';
    content += '        </div>';
    content += '    </div>';
  }

  $("#token-properties-container").html(content);
  $("#modal-token-properties").modal("show");
}); // Cookie Popup

$(document).on("click", "#remove-cookie-popup", function () {
  $("#cookie-popup").addClass("d-none");
});
$(document).on("click", "#accept-cookies", function () {
  localStorage.setItem("acceptCookie", '1');
  $("#cookie-popup").addClass("d-none");
});

/***/ }),

/***/ 0:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\Codes\marketplace\resources\js\app.js */"./resources/js/app.js");


/***/ })

/******/ });