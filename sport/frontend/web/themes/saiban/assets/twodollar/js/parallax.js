(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define([], factory(root));
    } else if (typeof exports === 'object') {
        module.exports = factory(root);
    } else {
        root.SmoothParallax = factory(root);
    }
})(typeof global !== 'undefined' ? global : this.window || this.global, function (root) {
    'use strict';
    var window = root;
    var _container;
    var _width, _height, _scrollHeight, _viewPortHeight;
    var _scrollPercent = 0;
    var _scrollOffset = 0;
    var _movingElements = [];
    var _positions = [];
    var _basePercentageOnOptions = ['containerVisibility', 'pageScroll'];
    var _settings;
    var publicMethods = {};
    var defaults = {
        basePercentageOn: 'containerVisibility',
        decimalPrecision: 2
    };
    var extend = function () {
        var extended = {};
        var deep = false;
        var i = 0;
        var length = arguments.length;
        if (Object.prototype.toString.call(arguments[0]) === '[object Boolean]') {
            deep = arguments[0];
            i++;
        }
        var merge = function (obj) {
            for (var prop in obj) {
                if (Object.prototype.hasOwnProperty.call(obj, prop)) {
                    if (deep && Object.prototype.toString.call(obj[prop]) === '[object Object]') {
                        extended[prop] = extend(true, extended[prop], obj[prop]);
                    } else {
                        extended[prop] = obj[prop];
                    }
                }
            }
        };
        for (; i < length; i++) {
            var obj = arguments[i];
            merge(obj);
        }
        return extended;
    };
    var getElementContainer = function (element) {
        var containerSelector = element.getAttribute('container');
        _container = element.parentNode;
        if (containerSelector != '' && document.querySelector(containerSelector)) {
            _container = document.querySelector(containerSelector);
        }
        return _container;
    };
    var calculatePageScrollPercent = function () {
        var documentElement = document.documentElement || document.body;
        _height = documentElement.scrollHeight;
        _scrollOffset = window.pageYOffset || documentElement.scrollTop;
        return _scrollOffset / (_height - documentElement.clientHeight);
    };
    var calculatePercent = function (positionData) {
        _viewPortHeight = window.innerHeight;
        if (_settings.basePercentageOn == 'containerVisibility') {
            _height = positionData.container.scrollHeight;
            _scrollOffset = _viewPortHeight - positionData.container.getBoundingClientRect().top;
            _scrollPercent = _scrollOffset / _height;
        }
        if (_settings.basePercentageOn == 'pageScroll') {
            _scrollPercent = calculatePageScrollPercent();
        }
        if (_scrollPercent < 0) {
            _scrollPercent = 0;
        } else if (_scrollPercent > 1) {
            _scrollPercent = 1;
        }
    };
    var getPositionDataByElement = function (el) {
        for (var i = 0; i < _positions.length; i++) {
            if (_positions[i].element == el) {
                return _positions[i];
            }
        }
        return false;
    }
    var initializeMovingElementsPosition = function () {
        var startPercent, startX, startY, endPercent, endX, endY, baseSizeOn, baseSizeOnOptions = ['elementsize', 'containerSize'];
        _movingElements = document.querySelectorAll('[smooth-parallax]');
        for (var i = 0; i < _movingElements.length; i++) {
            startPercent = parseFloat(_movingElements[i].getAttribute('start-movement')) || 0;
            startX = parseFloat(_movingElements[i].getAttribute('start-position-x')) || 0;
            startY = parseFloat(_movingElements[i].getAttribute('start-position-y')) || 0;
            endPercent = parseFloat(_movingElements[i].getAttribute('end-movement')) || 1;
            endX = parseFloat(_movingElements[i].getAttribute('end-position-x')) || 0;
            endY = parseFloat(_movingElements[i].getAttribute('end-position-y')) || 0;
            baseSizeOn = _movingElements[i].getAttribute('base-size');
            if (baseSizeOnOptions.indexOf(baseSizeOn) == -1) {
                baseSizeOn = 'elementSize';
            }
            var elementPosition = {
                element: _movingElements[i],
                container: getElementContainer(_movingElements[i]),
                baseSizeOn: baseSizeOn,
                start: {
                    percent: startPercent,
                    x: startX,
                    y: startY
                },
                end: {
                    percent: endPercent,
                    x: endX,
                    y: endY
                },
                diff: {
                    percent: endPercent - startPercent,
                    x: endX - startX,
                    y: endY - startY,
                },
                target: {},
                current: {}
            };
            _positions.push(elementPosition);
        }
    };
    var updateElementsPosition = function () {
        for (var i = 0; i < _movingElements.length; i++) {
            var p = _positions[i],
                baseWidth, baseHeight, transformValue;
            if (p.baseSizeOn == 'elementSize') {
                baseWidth = _movingElements[i].scrollWidth || parseFloat(window.getComputedStyle(_movingElements[i]).width);
                baseHeight = _movingElements[i].scrollHeight || parseFloat(window.getComputedStyle(_movingElements[i]).height);
            } else if (p.baseSizeOn == 'containerSize') {
                baseWidth = p.container.scrollWidth - (_movingElements[i].scrollWidth || parseFloat(window.getComputedStyle(_movingElements[i]).width));
                baseHeight = p.container.scrollHeight - (_movingElements[i].scrollHeight || parseFloat(window.getComputedStyle(_movingElements[i]).height));
            }
            calculatePercent(p);
            if (_scrollPercent <= p.start.percent) {
                p.target.x = p.start.x * baseWidth;
                p.target.y = p.start.y * baseHeight;
            } else if (_scrollPercent >= p.end.percent) {
                p.target.x = p.end.x * baseWidth;
                p.target.y = p.end.y * baseHeight;
            } else {
                p.target.x = p.start.x * baseWidth + (p.diff.x * (_scrollPercent - p.start.percent) / p.diff.percent * baseWidth);
                p.target.y = p.start.y * baseHeight + (p.diff.y * (_scrollPercent - p.start.percent) / p.diff.percent * baseHeight);
            }
            if (!p.current.x || !p.current.y) {
                p.current.x = p.target.x;
                p.current.y = p.target.y;
            } else {
                p.current.x = p.current.x + (p.target.x - p.current.x) * 0.1;
                p.current.y = p.current.y + (p.target.y - p.current.y) * 0.1;
            }
            p.current.x = parseFloat(p.current.x.toFixed(_settings.decimalPrecision));
            p.current.y = parseFloat(p.current.y.toFixed(_settings.decimalPrecision));
            _movingElements[i].style.transform = 'translate3d(' + p.current.x + 'px, ' + p.current.y + 'px, 0)';
        }
    };
    var loopUpdatePositions = function () {
        updateElementsPosition();
        requestAnimationFrame(loopUpdatePositions);
    };
    var isSupported = function () {
        var supported = true;
        if (_basePercentageOnOptions.indexOf(_settings.basePercentageOn) == -1) {
            supported = false;
            console.error('Value not supported for setting basePercentageOn: ' + _settings.basePercentageOn);
        }
        return supported;
    };
    publicMethods.init = function (options) {
        _settings = extend(defaults, options || {});
        _settings.decimalPrecision = parseInt(_settings.decimalPrecision) || defaults.decimalPrecision;
        if (!isSupported()) {
            return;
        }
        initializeMovingElementsPosition();
        loopUpdatePositions();
    };
    publicMethods.getScrollPercent = function (selector) {
        if (selector == undefined) {
            return calculatePageScrollPercent();
        }
        var el = document.querySelector(selector);
        if (el == null) return false;
        var positionData = getPositionDataByElement(el);
        if (positionData) {
            calculatePercent(positionData);
            return _scrollPercent;
        }
        return false;
    };
    return publicMethods;
});